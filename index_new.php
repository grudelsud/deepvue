<?php 
require_once('load.php');

/**
 * the following is a list of session values stored after correct authentication on twitter
 * 
	$_SESSION['user_id'] = $result->id_user;
	$_SESSION['user_login'] = $access_token['screen_name'];
	$_SESSION['oauth_id'] = $access_token['user_id'];
	$_SESSION['oauth_token'] = $access_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
 * 
 */

// session is initiated in load.php, now ready for use
$_SESSION['action'] = empty($_GET['action']) ? '' : $_GET['action'];
$_SESSION['view_elem'] = empty($_GET['view']) ? 0 : $_GET['view'];
$_SESSION['view_user'] = empty($_GET['user']) ? (empty($_SESSION['user_login']) ? '' : $_SESSION['user_login'] ) : $_GET['user'];

if( !empty( $_POST['submit'] ) ) {
	$dvdb->update( $table_prefix."user", array( 'user_email' => $_POST['email'] ), array( 'id_user' => $_POST['id_user'] ) );
}

// execute action, depends on get parameter 'action'
if( !empty( $_SESSION['action'] ) ) {

	switch( $_SESSION['action'] ) {
		case 'logout':
			header( 'Location: '.ABSDOMAIN.'clearsession.php' );
			break;
	}
}

// following parameters set by set_dv_globals right after session_start in load.php
if ( get_dv_globals('user_auth') ) {

	// user authenticated, now check if registered
	if ( get_dv_globals('user_reg') ) {
		
		// user authenticated and registered, show normal navigation here
?>
	<a href="?action=logout">logout</a>
<?php
	} else {

		// user authenticated, not registered (email not present in db) show registration form
?>
	<a href="?action=logout">logout</a>

	<form id="registration" name="registration" method="post" action="">
		<label for="email">email</label>
		<input type="text" name="email" id="email" />
		<input name="id_user" type="hidden" id="id_user" value="<?php echo $_SESSION['user_id']; ?>" />
		<input type="submit" name="submit" id="button" value="submit" />
	</form>

<?php
	}
} else {

	// user not authenticated, show login button
?>
	<a href="login_twitter.php">twitter oauth</a>
<?php
}
?>