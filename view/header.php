<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Deepvue</title>
<link href="css/deepvue.css" rel="stylesheet" type="text/css" />
<link href="<?php siteinfo('theme_dir'); ?>/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="lib/jquery-1.4.2.min.js"></script>
<script type="text/javascript">

function getComments() {
	$("#comments ul").empty();
	$.ajax({
		url: "ajax_fe.php",
		data: {"action": "read"},
		dataType: "json",
		type: "POST",
		success: function( data ) {
			$.each(data, function(key, value) {
				$("#comments ul").append( "<li><h6>from: "+value.user_login+"<h6><p>"+value.comment_content+"</p></li>" );
			});
		}
	});
}

function addComment() {
	$.ajax({
		url: "ajax_fe.php",
		data: {"action": "create", "content": $("#comment_content").val()},
		dataType: "json",
		type: "POST",
		success: getComments()
	});
}

$(document).ready(function() {
	getComments();
	$("#addcomment #button").click( function(e) {
		e.preventDefault();
		addComment();
	});
});
</script>
</head>
<body>

<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="?">Deepvue</a></h1>
		</div>
		<div id="top-nav">
<?php 
	if( get_dv_globals('user_auth') ) {
		
?>
			<ul>
				<li><a href="?action=profile">profile</a></li>
				<li><a href="?action=logout">logout</a></li>
			</ul>
<?php 
	}
?>
		</div>
	</div><!-- end of #header -->