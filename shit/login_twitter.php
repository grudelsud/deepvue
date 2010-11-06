<?php

require_once( 'load.php' );

$now = date( "c" );
$msg = $now." -- ";

// The TwitterOAuth instance
$twitteroauth = new TwitterOAuth( CONS_KEY, CONS_SECR );  

// Requesting authentication tokens, the parameter is the URL we will be redirected to (or null to use default as set in twitter)
$request_token = $twitteroauth->getRequestToken( ABSDOMAIN.'oauth_twitter.php');

// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// If everything goes well..
if($twitteroauth->http_code==200){
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
	$msg .= "all done, going to ".$url." now -- ";
	log_req( $msg, "ajax_fe.log" );
    header('Location: '. $url);
} else {
	$msg .= "died bad -- ";
	log_req( $msg, "login_twitter.log" );
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    dv_die('Something wrong happened while authenticating with twitter');
}

?>