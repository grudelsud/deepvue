<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class User
 * 
 * @author TMA
 * @version 1.0 2010.12.28
 */
class User extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
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