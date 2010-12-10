<?php
require_once('load.php');

$now = date( "c" );
$msg = $now." -- ";
$msg .= print_r( $_REQUEST, true );
log_req( $msg, "test.log" );

echo $dvfe->get_images( $_REQUEST['user_login'] );

?>