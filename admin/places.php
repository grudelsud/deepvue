<?php
require_once('../load.php');

$now = date( "c" );
$msg = $now." -- ";

if( !empty( $_POST["submit"]) ) {

	$user = $_POST["user"]; // => liquene

	// TODO: change to reflect last method signature
	$user_result = chk_credentials( "user_login", $user );

	if( $user_result != null ) {
		$id_user = $user_result->id_user;
		$msg .= "uid=".$id_user." -- ";

		list( $lat, $lon ) = explode( " ", $_POST['latlon'] );
		$place_data['id_user'] = $id_user;
		$place_data['lat'] = $lat;
		$place_data['lon'] = $lon;
		$place_data['text'] = $_POST['text'];

		$tbl_place = $table_prefix."place";
		$dvdb->insert( $tbl_place, $place_data );
	}
}

if( !empty( $_GET["exlat"]) && !empty( $_GET["exlon"]) ) {
	$dvdb->del_place( $_GET["exlat"], $_GET["exlon"] );
}

if( !empty( $_GET["del"]) ) {
	$sql = "DELETE FROM dv_place WHERE id_place=".$_GET["del"];
	$dvdb->query( $sql );
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

<form id="form1" name="form1" method="post" action="">
<table>
	<tr>
		<td><label for="user">user</label></td>
		<td><input type="text" name="user" id="user" value="liquene" /></td>
	</tr>
	<tr>
		<td><label for="latlon">[lat lon]</label></td>
		<td><input name="latlon" type="text" id="latlon" /></td>
	</tr>
	<tr>
		<td><label for="text">text</label></td>
		<td><input name="text" type="text" id="text" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="submit" id="submit"
			value="deepvue" /></td>
	</tr>
</table>
</form>


<table>
	<tr>
		<th>user</th>
		<th>lat</th>
		<th>lon</th>
		<th>text</th>
		<th>&nbsp;</th>
	</tr>
	<?php
	$places = $dvdb->get_places();

	foreach ($places as $place) {
		?>
	<tr>
		<td><?php echo $place->id_user.", ".$place->user_login; ?></td>
		<td><?php echo $place->lat; ?></td>
		<td><?php echo $place->lon; ?></td>
		<td><?php echo stripslashes( $place->text ); ?></td>
		<td><a href="?del=<?php echo $place->id_place; ?>">[X]</a><a href="?exlat=<?php echo $place->lat; ?>&exlon=<?php echo $place->lon; ?>">[eX]</a></td>
	</tr>
	<?php
	}
	?>

	<?php
	log_req( $msg, "places.log" );
	?>
</table>
</body>
</html>
