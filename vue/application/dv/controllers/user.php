<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class User
 *
 * @author TMA
 * @version 1.0 2010.12.28
 */
class User extends CI_Controller {

	/**
	 * Used to store user data while calling update callbacks
	 * @var array
	 */
	var $update_data;
	
	function __construct()
	{
		parent::__construct();
	}

	function user_login_check( $user_login )
	{
		/**
		 * don't even check if user is not changing data
		 */
		if( $user_login == $this->session->userdata('user_login') ) {
			return TRUE;
		}

		$this->load->model('user_model');
		$user_array = $this->user_model->read( $user_login );
		if( !empty($user_array) ) {
			$this->form_validation->set_message('user_login_check', 'User login taken');
			return FALSE;
		} else {
			$this->update_data['user_login'] = $user_login;
			return TRUE;
		}
	}

	function user_email_check( $user_email )
	{
		/**
		 * don't even check if user is not changing data
		 */
		if( $user_email == $this->session->userdata('user_email') ) {
			return TRUE;
		}

		$this->load->model('user_model');
		$user_array = $this->user_model->read( $user_email );
		if( !empty($user_array) ) {
			$this->form_validation->set_message('user_email_check', 'User email taken');
			return FALSE;
		} else {
			$this->update_data['user_email'] = $user_email;
			$this->update_data['user_status'] = REGISTER;
			return TRUE;
		}
	}

	function update() {
		
		$this->load->model('user_model');
		$this->update_data = array();
		$this->load->library('form_validation');
		$id_user = $this->session->userdata('id_user');
		
		if( TRUE == $this->form_validation->run() ) {

			$user_name = $this->input->post('username');
			if( FALSE != $user_name ) $this->update_data['user_name'] = $user_name;

			$user_pass = $this->input->post('password');
			if( FALSE != $user_pass ) $this->update_data['user_pass'] = md5( $user_pass );

			$this->user_model->update( $id_user, $this->update_data );
		}
		
		$data['view'] = 'includes/user_form';
		$data['user_restricted'] = FALSE;

		/**
		 * and load user_form with (updated) details
		 */
		$user_array = $this->user_model->read( $id_user, ARRAY_K );
		$this->session->set_userdata($user_array[0]);
		$data['user_profile'] = $user_array[0];
		$this->load->view('main_template', $data);
		
	}
	
	function profile( $user_profile )
	{
		if( empty( $user_profile ) ) {
			redirect('/');
		} else {
			$user_login = $this->session->userdata('user_login');
			$data['view'] = 'includes/user_form';
				
			$this->load->model('user_model');
			$user_array = $this->user_model->read( $user_profile, ARRAY_K );

			/**
			 * I am browsing my own profile page or someone else's
			 */
			if( $user_profile == $user_login ) {
				$data['user_restricted'] = FALSE;
			} else {
				$data['user_restricted'] = TRUE;
			}

			if( !empty($user_array) ) {
				$data['user_profile'] = $user_array[0];
				$this->load->view('main_template', $data);
			} else {
				/* dear user, please stop messing around with urls */
				// TODO: add a smart 404 here
				redirect('/');
			}
		}
	}

	function friends()
	{

	}

	function show( $id_user, $timecode, $id_element )
	{
		$this->load->model('user_model');
		/**
		 * we don't know the kind of variable contained in $id_user a priori
		 * doublechecking here
		 */
		$user_array = $this->user_model->read( $id_user );
		if( !empty($user_array) ) {
			$user = $user_array[0];

			$this->load->model('element_model');
			$data['element'] = $id_element;
			$data['elements'] = $this->element_model->read_day( $user->id_user, $timecode, JSON );

			$this->load->view('single', $data);
		}
		/**
		 * stop playing with urls, motherfucker!
		 */
	}
}

/* end of user.php */