<?php

require_once('load.php');

if( !empty($_REQUEST['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret']) ){

	// TwitterOAuth instance, with two new parameters we got in twitter_login.php
	$twitteroauth = new TwitterOAuth( CONS_KEY, CONS_SECR, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
	// Let's request the access token
	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
	// Save it in a session var
	$_SESSION['access_token'] = $access_token;
	// Let's get the user's info
	$user_info = $twitteroauth->get('account/verify_credentials');

	if(isset($user_info->error)){
	    // Something's wrong, go back to square 1
	    header('Location: login_twitter.php');
	} else {
	    // Let's find the user by its ID
		$table = $table_prefix."user";
		$result = $dvdb->get_row( "SELECT * FROM ".$table." WHERE oauth_id = ". $user_info->id );
		
		// If not, let's add it to the database
		if( empty($result) ) {
			$dvdb->insert( $table, array('oauth_id' => $user_info->id, 'oauth_token' => $access_token['oauth_token'], 'oauth_secret' => $access_token['oauth_token_secret'], 'user_login' => $user_info->screen_name));
			$result = $dvdb->get_row( "SELECT * FROM ".$table." WHERE id_user = ".$dvdb->insert_id );
			mail( "thomasalisi@gmail.com", "[deepVue] new user", "new user ".print_r( $result, true ) );
		} else {
		// Update the tokens
			$dvdb->update( $table, array('oauth_token' => $access_token['oauth_token'], 'oauth_secret' => $access_token['oauth_token_secret']), array('oauth_id' => $user_info->id) );
		}
		$_SESSION['user_id'] = $result->id_user;
		$_SESSION['user_login'] = $access_token['screen_name'];

		// TODO: check here
		$_SESSION['real_name'] = "puppaaaaaa";

		$_SESSION['oauth_id'] = $access_token['user_id'];
		$_SESSION['oauth_token'] = $access_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
		
		unset( $_SESSION['access_token'] );

		// TODO: check security
		$best_before = time() + 3600 * 24 * 7;
		foreach( $_SESSION as $key => $value ) {
			setcookie( $key, $value, $best_before );
		}

		header('Location: index.php');
	}

} else {
	header('Location: login_twitter.php');
}

/*
echo "<pre>";
print_r( $_REQUEST );
print_r( $_SESSION );
print_r( $_COOKIE );
echo "</pre>";
*/
?>