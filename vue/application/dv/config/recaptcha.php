<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
The reCaptcha server keys and API locations

Obtain your own keys from:
http://www.recaptcha.net
*/
$config['recaptcha'] = array(
  'public'=>'6LdXPcESAAAAAAIcXKT7Fq3_2jhsLQzclsY38yY9',
  'private'=>'6LdXPcESAAAAAIiOSTx3HrWbLcB4Ra-FvWC5lbSH',
  'RECAPTCHA_API_SERVER' =>'http://www.google.com/recaptcha/api',
  'RECAPTCHA_API_SECURE_SERVER'=>'https://www.google.com/recaptcha/api',
  'RECAPTCHA_VERIFY_SERVER' =>'www.google.com',
  'RECAPTCHA_SIGNUP_URL' => 'https://www.google.com/recaptcha/admin/create',
  'theme' => 'red'
);
