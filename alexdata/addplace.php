<?php

require_once('../load.php');
$now = date( "c" );
$msg = $now." -- ";

$aggiunto = 0;

if( !empty( $_POST["submitplace"]) ) {

	$user = $_POST["user"]; // => liquene o altro

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
		
		$aggiunto = 1;
	}
	
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Places</title>
<link type="text/css" rel="stylesheet" href="http://deepvue.com/alpha/css/deepvue.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">
<meta name="Author" content="Alex Valli, av@deepvue.com">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="viewport" content="width=1024" />
</head>
</head>
<body  id="main">


<?php
if ($aggiunto == 1)
{
	echo "<h3><br>&nbsp; Thank you! Place name added.</h3>";
}
else
{
	echo "<h3><br>&nbsp; Nothing happened.</h3>";
}


?>


</body>
</html>
