<?php 
require_once( 'load.php' );

$now = date( "c" );
$msg = $now." -- ";

$action = empty( $_REQUEST['action'] ) ? "" : $_REQUEST['action'];
// $msg .= "session: ". print_r( $_SESSION, true ) . " -- ";
$msg .= "action: ".$action." -- ";

if( $action == "read" ) {
	$resp = $dvdb->get_comments( $_SESSION['view_elem'], JSON );
//	$msg .= "q: ".$dvdb->last_query." -- ";
	$msg .= $resp;
} else if( $action == "create" ) {

	$id_element = $_SESSION['view_elem'];
	$id_user = $_SESSION['user_id'];
	$comment_status = "ACCEPTED";
	$comment_content = $_REQUEST['content'];

	$dvdb->add_comment( $id_element, $id_user, $comment_status, $comment_content );
	$msg .= "content: ".$_REQUEST['content']." -- ";	
}

log_req( $msg, "ajax_fe.log" );

echo $resp;
?>