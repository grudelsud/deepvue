<?php

require_once('../includes/functions.php');

$prima = $_SESSION['user_login'];

logout();

$dopo = $_SESSION['user_login'];

?>

<!DOCTYPE HTML>
<html>
<head>
<title>DeepVue Alpha | Logout</title>
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

echo "<h3><br>&nbsp; You are now logged out.</h3>";	

?>


</body>
</html>
