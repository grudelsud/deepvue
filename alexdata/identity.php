<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Identity</title>
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

require_once('../load.php');


echo "<!-- ".get_dv_globals('user_auth')." */";
echo "/* ".get_dv_globals('user_reg')." */";
echo "/* ".$_SESSION['user_login']." */";
echo "/* ".$_SESSION['real_name']." -->";


if ( get_dv_globals('user_auth') ) 
{
	//autenticato su twitter
	//echo "<h3>Autenticato!<br></h3>";
	if ( get_dv_globals('user_reg') ) 
	{       
		//registrato su deepvue
		//echo "<h3>Registrato!<br></h3>";
		echo "<h3>You are ".$_SESSION['real_name']." (".$_SESSION['user_login'].")<br></h3>";
	}
	else 
	{
		// user authenticated, not registered (email not present in db)
		//echo "<h3>Non registrato!<br></h3>";
	}
}
else
{
	// user not authenticated
	echo "<h3>Guest<br></h3>";	
}




//<a href="http://deepvue.com/dv/alexdata/login_tom.php?prev_page=http://deepvue.com/dv/alexdata/identity.php">Login Tom</a><br>


?>
<h3>
<a href="http://deepvue.com/dv/alexdata/logout.php?prev_page=http://deepvue.com/dv/alexdata/identity.php">Logout</a><br>
<a href="http://deepvue.com/dv/alexdata/login_alex.php?prev_page=http://deepvue.com/dv/alexdata/identity.php">Login</a><br>
</h3>
</body>
</html>
