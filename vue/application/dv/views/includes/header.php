<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Deepvue</title>
  
	<script type="text/javascript" src="<?php echo assets_url('assets/lib') ?>/jquery-1.4.4.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!-- The 1140px Grid -->
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/1140.css" type="text/css" media="screen" />
	
	<!--[if lte IE 9]>
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/ie.css" type="text/css" media="screen" />
	<![endif]-->
	
	<!-- Type and image presets - NOT ESSENTIAL -->
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/typeimg.css" type="text/css" media="screen" />
	<!-- Make minor type adjustments for 1024 monitors -->
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/smallerscreen.css" media="only screen and (max-width: 1023px)" />
	<!-- Resets grid for mobile -->
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/mobile.css" media="handheld, only screen and (max-width: 767px)" />
	<!-- Put your layout here -->
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/layout.css" type="text/css" media="screen" />

	<!-- DV style -->
	<link rel="stylesheet" href="<?php echo assets_url('assets/css') ?>/dv_style.css" type="text/css" media="screen" />
</head>

<body>
<?php 
	$logged = FALSE;
	$name = NULL;
?>
<?php $this->load->view('includes/login_form'); ?>

<div class="container">
	<div class="row">

		<div id="header" class="threecol">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo assets_url('assets/img') ?>/deepvue_small.png" alt="Deepvue"/></a>
		</div><!-- end of #header -->
		<div id="navigation" class="ninecol last">
			<ul>
				<?php if( $logged ): ?>
				<li>Hi, <a href="<?php echo site_url('profile') ?>" title="profile"><?php echo $name; ?>!</a></li>
				<li><a href="<?php echo site_url('friends') ?>" title="friends">friends</a></li>
				<li><a href="<?php echo site_url('authorizer/logout') ?>" title="logout">logout</a></li>
				<?php else: ?>
				<li><a onclick="$('#login_form').show(); $('#username').focus(); return false;" href="#">Sign In</a></li>
				<?php endif; ?>
			</ul>
		</div><!-- end of #navigation -->

	</div><!-- end of .row -->
