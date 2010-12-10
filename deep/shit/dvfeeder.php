<?php
require_once('load.php');

$now = date( "c" );
$msg = $now." -- ";
$msg .= print_r( $_REQUEST, true );
log_req( $msg, "dvfeeder.log" );

echo $dvfe->get_data( $_REQUEST['user_login'] );

?>