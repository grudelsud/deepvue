<div id="login_form" class="modal" style="display: none;">
<div class="form_wrapper">
<?php
$attributes = array( 'id' => 'login_form' );

$form_field['username'] = array('name' => 'username', 'id' => 'username');
$form_field['password'] = array('name' => 'password', 'id' => 'password');

echo form_open('authorizer/login', $attributes);

echo form_label('Username / Email', 'username');
echo form_input( $form_field['username'] );
echo "<br />";

echo form_label('Password', 'password');
echo form_password( $form_field['password'] );
echo "<br />";
?>
<a onclick="$('#login_form').hide(); $('#forgot_form').show(); return false;" href="#">Forgot password?</a>
<a class="button disabled fit" onclick="$('.modal').hide(); return false" href="#">Cancel</a>
<?php
echo form_submit('submit', 'Login!');
echo form_close();
?>
</div>
</div>

<div id="forgot_form" class="modal" style="display: none;">
<div class="form_wrapper">
<p class="info">Enter your email address and we'll send you a link to reset your password.</p>
<?php
$attributes = array( 'id' => 'forgot_form' );

$form_field['username'] = array('name' => 'username', 'id' => 'username');

echo form_open('authorizer/forgot', $attributes);

echo form_label('Email', 'username');
echo form_input( $form_field['username'] );
echo "<br />";
?>
<a class="button disabled fit" onclick="$('.modal').hide(); return false" href="#">Cancel</a>
<?php
echo form_submit('submit', 'Send!');
echo form_close();
?>
</div>
</div>