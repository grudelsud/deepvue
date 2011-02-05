<div class="row">
<div id="user_form" class="eightrow">
<?php

if( FALSE == $user_restricted ) {

	echo validation_errors('<div class="error">', '</div>');
	$attributes = array( 'id' => 'update_form' );

	$form_field['userlogin'] = array('name' => 'userlogin', 'id' => 'userlogin');
	$form_field['username'] = array('name' => 'username', 'id' => 'username');
	$form_field['useremail'] = array('name' => 'useremail', 'id' => 'useremail');
	$form_field['password'] = array('name' => 'password', 'id' => 'password');
	$form_field['passconf'] = array('name' => 'passconf', 'id' => 'passconf');

	echo form_open('user/update', $attributes);

	echo form_label('Login', 'userlogin');
	echo form_input( $form_field['userlogin'], $user_profile['user_login'] );
	echo "<br />";

	echo form_label('Real name', 'username');
	echo form_input( $form_field['username'], $user_profile['user_name'] );
	echo "<br />";

	echo form_label('Email', 'useremail');
	echo form_input( $form_field['useremail'], $user_profile['user_email'] );
	echo "<br />";

	echo form_label('Password', 'password');
	echo form_password( $form_field['password'] );
	echo "<br />";

	echo form_label('Twice', 'passconf');
	echo form_password( $form_field['passconf'] );
	echo "<br />";

	// TODO: add CAPTCHA and form validation here

	echo form_submit('submit', 'Update fields!');
	echo form_close();
} else {
?>
	<dl>
	<dt>User</dt>
	<dd><?php echo $user_profile['user_login']; ?></dd>
	<dt>Real name</dt>
	<dd><?php echo $user_profile['user_name']; ?></dd>
	</dl>
<?php 
}

?></div><!-- end of #user_form -->
<div id="user_meta" class="fourrow last">
</div>
</div><!-- end of .row -->
