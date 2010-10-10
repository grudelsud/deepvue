<div id="main">
<?php
if( get_dv_globals('action') == 'profile' ) {
?>
	<p>profile</p>
<?php 
} else {
	$view_elem = get_dv_globals('view_elem');
	$view_user = get_dv_globals('view_user');

	$dvfe = get_dv_globals('dvfe');
	$public_only = $view_user == $_SESSION['user_login'] ? 0 : 1; 
	
	if( $view_elem == 0 ) {
		$images = $dvfe->get_images( "", $view_user, $public_only, 'OBJECT' );
?>
<div id="content">
<?php
		foreach( $images as $image ) {
			?><a href="?user=<?php echo $view_user; ?>&amp;view=<?php echo $image['id_element'] ?>"><img src="<?php echo $image['thumb'] ?>"/></a><?php 
		}
	} else {
		$images = $dvfe->get_images( $view_elem, $view_user, $public_only, 'OBJECT' );
		foreach( $images as $image ) {
			?><img src="<?php echo $image['name'] ?>"/><?php 
			
			// TODO: insert comments template here!
		}
	}
?>
</div>
<?php
}
?>
</div><!-- end of #main -->
