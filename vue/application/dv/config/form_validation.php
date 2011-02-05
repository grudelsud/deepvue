<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'user/update' => array(
		array(
			'field' => 'userlogin',
			'label' => 'login',
			'rules' => 'trim|required|min_length[5]|alpha_dash|callback_user_login_check|xss_clean'
		),
		array(
			'field' => 'username',
			'label' => 'real name',
			'rules' => 'trim|required|min_length[5]'
		),
		array(
			'field' => 'useremail',
			'label' => 'email',
			'rules' => 'trim|required|valid_email|callback_user_email_check'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|min_length[5]'
		),
		array(
			'field' => 'passconf',
			'label' => 'password confirmation',
			'rules' => 'trim|matches[password]'
		)
	),
	'authorizer/register' => array(
		array(
			'field' => 'userlogin',
			'label' => 'login',
			'rules' => 'trim|required|min_length[5]|alpha_dash|callback_user_login_check|xss_clean'
		),
		array(
			'field' => 'username',
			'label' => 'real name',
			'rules' => 'trim|required|min_length[5]'
		),
		array(
			'field' => 'useremail',
			'label' => 'email',
			'rules' => 'trim|required|valid_email|callback_user_email_check'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required|min_length[5]'
		),
		array(
			'field' => 'passconf',
			'label' => 'password confirmation',
			'rules' => 'trim|required|matches[password]'
		),
	    array(
			'field' => 'recaptcha_response_field',
			'label' => 'lang:recaptcha_field_name',
			'rules' => 'required|callback_captcha_check'
		)
	)
);