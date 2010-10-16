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

	//
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
		$image = $images[0];
		?><img src="<?php echo $image['name'] ?>"/><?php 
			
		$comments = $dvdb->get_comments( $image['id_element'] );

		foreach( $comments as $comment ) {
		// TODO: check all comments parameters and BEWARE that if 0 results, it is still showing last_result, which is an image!
		
?>
	<div class="comment"><h1>from: <?php echo $comment->user_login; ?></h1><p><?php echo $comment->comment_content; ?></p></div>
<?php
			}
			?><form id="form1" name="form1" method="post" action="">
			<p>
				<label for="textarea">comment</label>
				<textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>
			</p>
			<p>
				<input type="submit" name="button" id="button" value="Submit" />
			</p>
		</form>
			<?php 
	}
?>
</div>
<?php
}
?>
</div><!-- end of #main -->
