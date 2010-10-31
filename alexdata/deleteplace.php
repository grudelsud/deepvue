<?php

require_once('../load.php');
$now = date( "c" );

$cancellato = 0;
$lat=-1;
$lon=-1;

if( !empty( $_POST["submitdeleteplace"]) ) {

	$user = $_POST["user"]; // => liquene o altro

	// TODO: change to reflect last method signature
	$user_result = chk_credentials( "user_login", $user );

	if( $user_result != null ) {
		$id_user = $user_result->id_user;

		list( $lat, $lon ) = explode( " ", $_POST['dellatlon'] );
		$dvdb->del_place( $lat , $lon );
		$cancellato = 1;
	}
	
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Delete Places</title>
<link type="text/css" rel="stylesheet" href="http://deepvue.com/alpha/css/deepvue.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">

<meta http-equiv="refresh" content="2;url=<?php echo $_POST["dp_page"] ?> ">

<meta name="Author" content="Alex Valli, av@deepvue.com">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="viewport" content="width=1024" />
</head>
</head>
<body  id="main">


<?php
if ($cancellato == 1)
{
	//echo "<h3><br>LAT=".$lat." LON=".$lon." &nbsp; Thank you! Place name deleted.</h3>";
	echo "<h3><br> &nbsp; Thank you! Place name deleted.</h3>";
}
else
{
	echo "<h3><br>&nbsp; Nothing happened.</h3>";
}


?>


</body>
</html>
