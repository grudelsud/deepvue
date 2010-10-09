<?php
require_once('load.php');

$dv_globals['action'] = $_GET['action'];

$dvfe->get_header();

if ( get_dv_globals('user_auth') ) {
	// user authenticated, now check if registered
	if ( get_dv_globals('user_reg') ) {
		
	}
} else {
	// user not authenticated, show login button
	$dvfe->get_login();
}

$dvfe->get_footer();

switch( $dv_globals['action'] ) {
case 'logout':
	logout();
}
?>