<?php
/**
 * @file
 * Clears PHP sessions and redirects to the index page.
 */
define( 'SUBPATH', '/deepvue' );
define( 'ABSDOMAIN', 'http://'.$_SERVER['SERVER_NAME'].SUBPATH.'/' );

require_once('includes/functions.php');


/* Load and clear sessions */
logout();

/* Redirect to page with the connect to Twitter option. */
header( 'Location: '.ABSDOMAIN );

?>