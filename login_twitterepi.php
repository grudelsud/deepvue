<?php

require_once( 'load.php' );

$now = date( "c" );
$msg = $now." -- ";

try {
	$twitterObj = new EpiTwitter(CONS_KEY, CONS_SECR);
	$url = $twitterObj->getAuthenticationUrl();
	$msg .= "redirect: ".$url." -- ";
	log_req( $msg, "login_twitterepi.log" );
	header('Location: '. $url);

} catch (Exception $e) {

	$msg .= "caught exc: ".$e->getMessage()." -- ";
	log_req( $msg, "login_twitterepi.log" );
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    dv_die('Something wrong happened while authenticating with twitter');
}
?>