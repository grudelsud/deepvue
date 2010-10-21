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
	$dvdb = get_dv_globals('dvdb');
	$public_only = $view_user == $_SESSION['user_login'] ? 0 : 1; 
?>
<div id="content">
<?php

	// LIST VIEW
	if( $view_elem == 0 ) {
		$images = $dvfe->get_images( "", $view_user, $public_only, 'OBJECT' );
		foreach( $images as $image ) {
			?><a href="?user=<?php echo $view_user; ?>&amp;view=<?php echo $image['id_element'] ?>"><img src="<?php echo $image['thumb'] ?>"/></a><?php 
		}

	// SINGLE IMAGE
	} else {
		
		// FIXME: orrendo spreco di variabili inutili, non lo posso vedereeeee! controllare
		$images = $dvfe->get_images( $view_elem, $view_user, $public_only, 'OBJECT' );
		$image = $images[0];
		$check_status = $image['is_public'] ? "checked=\"checked\"" : "";
		?><img src="<?php echo $image['name'] ?>"/><?php 		

?>
<form id="setpublic" name="setpublic" method="post" action="ajax_fe.php">
	<input name="action" type="hidden" value="setpublic" />
	<input name="id_element" type="hidden" value="<?php echo $image['id_element']; ?>" />
	<input name="public" type="checkbox" id="public" <?php echo $check_status; ?> />
	<input name="public" type="hidden" value="<?php echo $image['is_public']; ?>" />
	<label for="public">public</label>
</form>

	<form id="addcomment" name="addcomment" method="post" action="">
	<p>
	<label for="comment_content">comment</label>
	<textarea name="comment_content" id="comment_content" cols="45" rows="5"></textarea>
	</p>
	<p>
	<input type="submit" name="button" id="button" value="Submit" />
	</p>
	</form>
	<div id="comments"><ul></ul>
	</div><!-- end of #comments  -->
</div><!-- end of #content -->
			<?php 
	}
?>
</div>
<?php
}
?>
</div><!-- end of #main -->
