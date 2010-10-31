<?php

require_once('../load.php');

$_SESSION['user_id'] = 3;
$_SESSION['user_login'] = "liquene";
$_SESSION['real_name'] = "Alex";
$_SESSION['oauth_id'] = 18936853;
$_SESSION['oauth_token'] = "unused";
$_SESSION['oauth_token_secret'] = "unused";
$best_before = time() + 3600 * 24 * 7;
foreach( $_SESSION as $key => $value ) {
 setcookie( $key, $value, $best_before );
}



?>

<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Login Alex</title>
<link type="text/css" rel="stylesheet" href="http://deepvue.com/alpha/css/deepvue.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">

<meta http-equiv="refresh" content="2;url=<?php echo $_GET["prev_page"] ?> ">

<meta name="Author" content="Alex Valli, av@deepvue.com">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="viewport" content="width=1024" />
</head>
</head>
<body  id="main">


<?php

echo "<h3><br>&nbsp; You are now logged in as Alex.</h3>";	

?>


</body>
</html>
