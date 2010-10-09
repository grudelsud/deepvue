<?php
require_once('load.php');

// $dv_globals[''] = '';
$dv_globals['dv_theme'] = 'view'; // name of the folder containing the view template
$dv_globals['user_auth'] = false; // authenticated on twitter, allowed to browse and register
$dv_globals['user_reg'] = false; // authenticated and registered, allowed to browse and post
$dv_globals['user_login'] = '';
$dv_globals['user_id'] = '';
$dv_globals['action'] = $_GET['action'];

$dvfe->set_theme( $dv_globals['dv_theme'] );
$dvfe->get_header();

if ( $dv_globals['user_auth'] ) {
	// user authenticated, now check if registered
	if ( $dv_globals['user_reg'] ) {
		
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