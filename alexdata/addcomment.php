<?php

require_once('../load.php');
$now = date( "c" );

$aggiunto = 0;

if( !empty( $_POST["submitcomment"]) && strlen($_POST['commentcontent'])>0 ) {

	$user = $_POST["user"]; // => liquene o altro

	// TODO: change to reflect last method signature
	$user_result = chk_credentials( "user_login", $user );

	if( $user_result != null ) {
		
		$dvdb->add_comment( $_POST['element'] , $user_result->id_user, $comment_status, $_POST['commentcontent'] );
		$aggiunto = 1;
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Add Comment</title>
<link type="text/css" rel="stylesheet" href="http://deepvue.com/alpha/css/deepvue.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<meta http-equiv="refresh" content="2;url=<?php echo $_POST["ac_page"] ?> ">

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
	echo "<h3><br>&nbsp; Thank you! Comment added.</h3>";
}
else
{
	echo "<h3><br>&nbsp; Nothing happened.</h3>";
}

?>


</body>
</html>
