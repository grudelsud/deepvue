<?php
require_once('shit/functions_removed.php');
require_once('load.php');

$dv_globals['action'] = empty($_GET['action']) ? '' : $_GET['action'];

// TODO: switch to session only, easier to handle ajax requests
$dv_globals['view_elem'] = empty($_GET['view']) ? 0 : $_GET['view'];
$_SESSION['view_elem'] = $dv_globals['view_elem'];

$dv_globals['view_user'] = empty($_GET['user']) ? $dv_globals['user_login'] : $_GET['user'];

if( !empty( $dv_globals['action'] ) ) {
	switch( $dv_globals['action'] ) {
		case 'logout':
			header( 'Location: '.ABSDOMAIN.'clearsession.php' );
			break;
	}
}

$dvfe->get_header();

if ( get_dv_globals('user_auth') ) {
	// user authenticated, now check if registered
	if ( get_dv_globals('user_reg') ) {
		$dvfe->get_navigation();
		$dvfe->get_main();
	} else {
		$dvfe->get_reg();
	}
} else {
	// user not authenticated, show login button
	$dvfe->get_login();
}

$dvfe->get_footer();
?>