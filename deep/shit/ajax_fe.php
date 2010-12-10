<?php 
require_once( 'load.php' );

$now = date( "c" );
$msg = $now." -- ";

$action = empty( $_REQUEST['action'] ) ? "" : $_REQUEST['action'];
// $msg .= "session: ". print_r( $_SESSION, true ) . " -- ";
// $msg .= "post: ". print_r( $_POST, true ) . " -- ";
$msg .= "action: ".$action." -- ";

$resp = json_encode( array('status' => 'ok') );

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
} else if( $action == "setpublic" ) {
	
	/**
	 * riceve una form cosi' formattata
	 * 
	 * action = setpublic: necessario per settare l'if di linea 27
	 * id_element = xxx: parametro usato per $dvdb->set_public
	 * public checkbox: visualization purposes only
	 * public hidden: stesso valore della checkbox, impostato per $dvdb->set_public

<form id="setpublic" name="setpublic" method="post" action="ajax_fe.php">
	<input name="action" type="hidden" value="setpublic" />
	<input name="id_element" type="hidden" value="<?php echo $image['id_element']; ?>" />
	<input name="public" type="checkbox" id="public" <?php echo $check_status; ?> />
	<input name="public" type="hidden" value="<?php echo $image['is_public']; ?>" />
	<label for="public">public</label>
</form>

	 * 
	 * @var unknown_type
	 */
	$is_public = !$_POST['public'];
	$dvdb->set_public( $_POST['id_element'], $is_public );
	$msg .= "set is_public=".$is_public." id_element=".$_POST['id_element']." -- ";
	header( 'Location: '.ABSDOMAIN.'index.php?view='.$_POST['id_element'] );
}

log_req( $msg, "ajax_fe.log" );

echo $resp;
?>