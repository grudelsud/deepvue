<?php
require_once('../load.php');

$now = date( "c" );
$msg = $now." -- ";


if( !empty( $_GET["del"]) ) {
	$sql = "DELETE FROM dv_user WHERE id_user=".$_GET["del"];
	$dvdb->query( $sql );
}
if( !empty( $_GET["send"]) ) {
	$users = $dvdb->get_users( $_GET['send'] );
	if( !empty( $users )) {
		$user = $users[0];

		$email = $user->user_email;
		$auth = substr( md5( $email ), 0, 4 );
		$login = $user->user_login;
		$name = $user->user_name;

		send_authcode( $name, $auth, $email );

		$table_us = $table_prefix."user";
		$dvdb->update( $table_us, array( 'user_code' => $auth ), array( 'id_user' => $user->id_user ) );
		$msg .= "msg sent to ".$email." -- ";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>deepvue - admin</title>
<link href="../css/deepvue.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../lib/jquery-1.4.2.min.js"></script>
<script type="text/javascript">                                         
$(document).ready(function() {
});
</script>
</head>

<body>

<table>
	<tr>
		<th>user</th>
		<th>email</th>
		<th>auth</th>
		<th>&nbsp;</th>
	</tr>
	<?php
	$users = $dvdb->get_users();

	foreach ($users as $user) {
		$auth = substr( md5($user->user_email), 0, 4 );
	?>
	<tr>
		<td><?php echo $user->id_user; ?> - <a href="http://twitter.com/<?php echo $user->user_login; ?>"><?php echo $user->user_login; ?></a></td>
		<td><?php echo $user->user_email; ?></td>
		<td><?php echo $user->user_code; ?> [computed: <?php echo $auth; ?>]</td>
		<td><a href="?send=<?php echo $user->id_user; ?>">[->]</a><a href="?del=<?php echo $user->id_user; ?>">[X]</a></td>
	</tr>
	<?php
	}
	?>

	<?php
	log_req( $msg, "users.log" );
	?>
</table>
</body>
</html>
