<?php

require_once( 'load.php' );

$now = date( "c" );
$msg = $now." -- ";

try {
	if( !empty($_COOKIE['oauth_token']) && !empty($_COOKIE['oauth_token_secret']) ) {
		
		$msg .= "auth via cookie -- ";
		$oauth_token = $_COOKIE['oauth_token'];
		$oauth_token_secret = $_COOKIE['oauth_token_secret'];
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);

	} else if( !empty($_GET['oauth_token']) ) {

		$msg .= "auth via get -- ";
		$twitterObj = new EpiTwitter(CONS_KEY, CONS_SECR);
		
		$twitterObj->setToken($_GET['oauth_token']);
		$token = $twitterObj->getAccessToken();
		
		$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
		
		$oauth_token = $token->oauth_token;
		$oauth_token_secret = $token->oauth_token_secret;
	} else {

		$msg .= "noauth: retry -- ";
		log_req( $msg, "oauth_twitterepi.log" );
		header('Location: login_twitterepi.php');
	}

	$user_info = $twitterObj->get_accountVerify_credentials();

	if( !isset($user_info->error) ) {
		
		// find user by its ID
		$msg .= "fetching user ".$user_info->id." -- ";
		$table = $table_prefix."user";
		$result = $dvdb->get_row( "SELECT * FROM ".$table." WHERE oauth_id = ". $user_info->id );
	
		// If not, add it to the database
		if( empty($result) ) {
	
			$values['oauth_id'] = $user_info->id;
			$values['oauth_token'] = $oauth_token;
			$values['oauth_secret'] = $oauth_token_secret;
			$values['user_login'] = $user_info->screen_name;
			$values['user_name'] = $user_info->name;
	
			$dvdb->insert( $table, $values );
			$result = $dvdb->get_row( "SELECT * FROM ".$table." WHERE id_user = ".$dvdb->insert_id );
			
			$message = "new user ".print_r( $result, true );
			$email = "thomasalisi@gmail.com";
			$subj = "[DV] new user";
			$from = "info@deepvue.com";
			$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			
			mail( $email, $subj, $message, $headers );

		} else {
			$values['oauth_token'] = $oauth_token;
			$values['oauth_secret'] = $oauth_token_secret;
				
			$values['user_login'] = $user_info->screen_name;
			$values['user_name'] = $user_info->name;
			
			$dvdb->update( $table, $values, array('oauth_id' => $user_info->id) );
		}
		$_SESSION['user_id'] = $result->id_user;
		$_SESSION['user_login'] = $user_info->screen_name;
		$_SESSION['real_name'] = $user_info->name;
	
		$_SESSION['oauth_id'] = $user_info->id;
		$_SESSION['oauth_token'] = $oauth_token;
		$_SESSION['oauth_token_secret'] = $oauth_token_secret;
		
		$best_before = time() + 3600 * 24 * 365;
		foreach( $_SESSION as $key => $value ) {
			setcookie( $key, $value, $best_before, '/' );
		}
	}

	log_req( $msg, "oauth_twitterepi.log" );
	header('Location: /');

} catch (Exception $e) {

	$msg .= "caught exc: ".$e->getMessage()." -- ";
	log_req( $msg, "oauth_twitterepi.log" );
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    dv_die('Something wrong happened while authenticating with twitter');
}
?>