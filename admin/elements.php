<?php
require_once('../load.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>deepvue - admin</title>
<link href="./style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
Select stream: <?php 
$users = $dvdb->get_users();
foreach( $users as $user ) {
	echo "<a href=\"?user=".$user->user_login."\">".$user->user_login."</a> ";
}
if( isset( $_GET['user'] ) ) {
	$elements = $dvdb->get_elements("", $_GET['user'], false);

?>
<table>
	<tr>
		<th colspan="2">user, event data</th>
		<th>element data</th>
		<th>is new</th>
		<th>public</th>
		<th>metric</th>
		<th>file</th>
		<th>caption</th>
	</tr>
<?php
} else {
	$elements = array();
}
echo $dvdb->last_query;

foreach ($elements as $element) {
	if ( !empty($element->filename) ) {
		$img_src = ABSDOMAIN.UPLOAD_FOLDER."/".$element->filename.".".$element->ext;
		$img_thumb_src = ABSDOMAIN.UPLOAD_FOLDER."/".$element->filename."-".THUMB_SUFFIX.".".$element->ext;
		$print_img = true;
	} else {
		$print_img = false;
	}
?>
	<tr>
		<td>e:<?php echo $element->id_event.", p:".$element->has_photos.", u:".$element->user_login; ?></td>
		<td>S: <?php echo $element->lat_start." ".$element->lon_start." @ ".$element->time_start; ?><br />
		E: <?php echo $element->lat_end." ".$element->lon_end." @ ".$element->time_end; ?> <br />TZ: <?php echo $element->timezone; ?></td>
		<td><?php echo $element->lat." ".$element->lon." @ ".$element->created; ?></td>
		<td><?php echo $element->is_new; ?></td>
		<td><?php echo $element->is_public; ?></td>
		<td><?php echo $element->metric; ?></td>
		<td><?php if( $print_img ) { ?><a href="<?php echo $img_src; ?>"><img src="<?php echo $img_thumb_src; ?>" /></a><?php } ?></td>
		<td><?php echo $element->caption; ?></td>
	</tr>
<?php
}
?>
</table>

</div><!-- end of #wrapper -->

<?php
include('debug.php');
?>
</body>
</html>