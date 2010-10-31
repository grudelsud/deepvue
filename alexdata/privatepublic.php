<?php

require_once('../load.php');
$now = date( "c" );
$msg = $now." -- ";

$cambiato = 0;
$vecchiovalore = -1;
$nuovovalore = -1;

if( !empty( $_POST["submitpublic"]) ) {

		$vecchiovalore = $_POST['public'];
		$nuovovalore = 0;
		if ($vecchiovalore==0)
		{
			$nuovovalore=1;
		}		
		
		$cambiato = $_POST['id_element'];
		
		$dvdb->set_public( $cambiato, $nuovovalore );	
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Private/Public</title>
<link type="text/css" rel="stylesheet" href="http://deepvue.com/alpha/css/deepvue.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">

<meta http-equiv="refresh" content="2;url=<?php echo $_POST["pp_page"] ?> ">

<meta name="Author" content="Alex Valli, av@deepvue.com">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="viewport" content="width=1024" />
</head>
</head>
<body  id="main">


<?php
if ($cambiato != 0)
{
	//echo "<h3><br>&nbsp; ".$vecchiovalore." xxxxxxxx ".$cambiato."  ".$nuovovalore."</h3>";
	if ($nuovovalore)
	{
		echo "<h3><br>&nbsp; Thank you! It's now public.</h3>";	
	}
	else
	{
		echo "<h3><br>&nbsp; Thank you! It's now private.</h3>";		
	}
}
else
{
	echo "<h3><br>&nbsp; Nothing happened.</h3>";
}


?>


</body>
</html>
