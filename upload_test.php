<?php
require_once('load.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" rel="stylesheet" href="css/deepvue.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>deepvue upload form</title>
</head>

<body>
<?php 
$format = "Y-m-d G:i:s \\G\M\T 0";
?>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="upload_remote.php">
	<table>
		<tr>
			<td><label for="user">user</label></td>
			<td><input type="text" name="user" id="user" value="grudelsud" /></td>

			<td><label for="app_version">app_version</label></td>
			<td><input name="app_version" type="text" id="app_version" value="0" /></td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6">Element</td>
		</tr>
		<tr>
			<td><label for="is_public">is_public</label></td>
			<td><input name="is_public" type="text" id="is_public" value="0" /></td>
			<td><label for="metric">metric</label></td>
			<td><input name="metric" type="text" id="metric" value="666.666" /></td>
		</tr>
		<tr>
			<td><label for="lat">lat</label></td>
			<td><input name="lat" type="text" id="lat" value="51.56712" /></td>
			<td><label for="lon">lon</label></td>
			<td><input name="lon" type="text" id="lon" value="-0.121235" /></td>
			<td><label for="time">time</label></td>
			<td><input name="time" type="text" id="time" value="<?php echo date($format); ?>" /></td>
		</tr>
		<tr>
			<td><label for="caption">caption</label></td>
			<td><input type="text" name="caption" id="caption" value="[test, apologies]" /></td>
			<td><label for="notify">notify</label></td>
			<td><input name="notify" type="text" id="notify" value="0" /></td>
			<td><label for="fileContents">fileContents</label></td>
			<td colspan="3"><input type="file" name="fileContents" id="fileContents" /></td>
		</tr>
		<tr>
			<td colspan="6">Event</td>
		</tr>
		<tr>
			<td><label for="is_new">is_new</label></td>
			<td><input name="is_new" type="text" id="is_new" value="0" /></td>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td><label for="lat_start">lat_start</label></td>
			<td><input name="lat_start" type="text" id="lat_start" value="51.5" /></td>
			<td><label for="lon_start">lon_start</label></td>
			<td><input name="lon_start" type="text" id="lon_start" value="-0.1" /></td>
			<td><label for="time_start">time_start</label></td>
			<td><input name="time_start" type="text" id="time_start" value="<?php echo date($format, time() - 3600*24 ); ?>" /></td>
		</tr>
		<tr>
			<td><label for="lat_end">lat_end</label></td>
			<td><input name="lat_end" type="text" id="lat_end" value="51.6" /></td>
			<td><label for="lon_end">lon_end</label></td>
			<td><input name="lon_end" type="text" id="lon_end" value="-0.2" /></td>
			<td><label for="time_end">time_end</label></td>
			<td><input name="time_end" type="text" id="time_end" value="<?php echo date($format, time() + 3600*24 ); ?>" /></td>
		</tr>
		<tr>
			<td colspan="6"><input type="submit" name="deepvue_upload" id="deepvue_upload" value="deepvue" /></td>
		</tr>
	</table>
</form>
</body>
</html>