<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Element
 *
 * @author TMA
 * @version 1.0 2011.01.10
 */
class Element extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('element_model');
	}

	function read( $id_element = SET )
	{
		if( SET != $id_element ) {
			$element_array = $this->element_model->read( $id_element, OBJECT );
			if( !empty($element_array) ) {
				/**
				 * we see a user centered fruition, where navigation is redirected to whatever the 
				 * actions of a specific user are, so even a read element action is redirected to
				 * the specific day of the user that generated the requested element of content
				 */
				$element = $element_array[0];
				$timecode = strtotime( $element->created.' GMT' ) + 3600 * $element->timezone;
				$this->load->model('user_model');
				$user_array = $this->user_model->read( $element->id_user );
				$user = $user_array[0];
				$controller = '/user/show/'.$user->user_login.'/'.$timecode.'/'.$element->id_element;
				redirect( $controller );
			}
		}
		/**
		 * stop playing with urls, motherfucker!
		 */
	}

	function page( $page = 0 )
	{
		if( !is_numeric($page) ) {
			$offset = 0;
		} else {
			$offset = $page * PAGE_SIZE;
		}

		$result = $this->element_model->read( SET, JSON, 1, PAGE_SIZE, $offset );
		echo $result;
	}
}

/* end of element */