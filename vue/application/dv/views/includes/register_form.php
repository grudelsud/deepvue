<div class="row">
<div id="register_form" class="twelverow last">
<?php
echo validation_errors('<div class="error">', '</div>');
$attributes = array( 'id' => 'register_form' );

$form_field['userlogin'] = array('name' => 'userlogin', 'id' => 'userlogin');
$form_field['username'] = array('name' => 'username', 'id' => 'username');
$form_field['useremail'] = array('name' => 'useremail', 'id' => 'useremail');
$form_field['password'] = array('name' => 'password', 'id' => 'password');
$form_field['passconf'] = array('name' => 'passconf', 'id' => 'passconf');

echo form_open('authorizer/register', $attributes);

echo form_label('Login', 'userlogin');
echo form_input( $form_field['userlogin'], set_value('userlogin') );
echo "<br />";

echo form_label('Real name', 'username');
echo form_input( $form_field['username'], set_value('username') );
echo "<br />";

echo form_label('Email', 'useremail');
echo form_input( $form_field['useremail'], set_value('useremail') );
echo "<br />";

echo form_label('Password', 'password');
echo form_password( $form_field['password'] );
echo "<br />";

echo form_label('Twice', 'passconf');
echo form_password( $form_field['passconf'] );
echo "<br />";

echo $recaptcha;

echo form_submit('submit', 'Register!');
echo form_close();
?>
</div><!-- end of #register_form -->
</div><!-- end of .row -->
