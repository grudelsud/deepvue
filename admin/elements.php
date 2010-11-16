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

echo "<p>";
foreach( $users as $user ) {
	echo "<a href=\"?user=".$user->user_login."\">".$user->user_login."</a> ";
}
echo "</p>";

if( isset( $_GET['user'] ) ) {
	$page_size = 100;
	$user_login = $_GET['user'];
	if( isset( $_GET['offset']) ) {
		$limit = $_GET['offset'].", ".$page_size;
		$lows = $_GET['offset'] - 5 * $page_size;
		$low = $_GET['offset'] - $page_size;
		$high = $_GET['offset'] + $page_size;
		$highs = $_GET['offset'] + 5 * $page_size;
	} else {
		$limit = "0, ".$page_size;
		$lows = 0;
		$low = 0;
		$high = $page_size;
		$highs = 5 * $page_size;
	}
	$elements = $dvdb->get_elements("", $_GET['user'], false, $limit);
	echo "<p>displaying " .
	"<a href=\"?user=".$user_login."&offset=".$lows."\">&lt;&lt;</a> " .
	"<a href=\"?user=".$user_login."&offset=".$low."\">&lt;</a> " .
	"<a href=\"?user=".$user_login."\">".$user_login."</a> " .
	"<a href=\"?user=".$user_login."&offset=".$high."\">&gt;</a>" .
	"<a href=\"?user=".$user_login."&offset=".$highs."\">&gt;&gt;</a></p>";
	
?>
<table>
	<tr>
		<th colspan="2">user, event data</th>
		<th>element data</th>
		<th>id, new, public</th>
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
		
		$time_stamp = strtotime( $element->created." GMT" ) + 3600 * $element->tz_elem;
		$dv_url = SERVER."/?time=".$time_stamp."&image=".$element->filename."&story=".$element->user_login;

		$print_img = true;
	} else {
		$print_img = false;
	}
	
?>
	<tr>
		<td>ev:<?php echo $element->id_event.", p:".$element->has_photos.", u:".$element->user_login; ?></td>

		<td>S: <?php echo $element->lat_start." ".$element->lon_start." @ ".$element->time_start; ?><br />
		E: <?php echo $element->lat_end." ".$element->lon_end." @ ".$element->time_end; ?> <br />TZ: <?php echo $element->timezone; ?></td>

		<td><?php echo $element->lat." ".$element->lon." @ ".$element->created; ?> TZ: <?php echo $element->tz_elem; ?><br />
		TS:<?php echo strtotime( $element->created." GMT" ); ?> MOD:<?php echo 3600 * $element->tz_elem; ?></td>

		<td>id:<?php echo $element->id_element; ?><br />new:<?php echo $element->is_new; ?><br />pub:<?php echo $element->is_public; ?></td>

		<td><?php echo $element->metric; ?></td>

		<td><?php if( $print_img ) { ?><a href="<?php echo $dv_url; ?>"><img src="<?php echo $img_thumb_src; ?>" /></a><br />
			<a href="<?php echo $img_src; ?>">src</a>
		<?php } ?></td>

		<td><?php echo $element->caption." (".strlen($element->caption).")"; ?></td>
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