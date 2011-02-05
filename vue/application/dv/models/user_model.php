<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class User_model
 *
 * @author TMA
 * @version 1.0 2011.01.12
 */
class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function create( $user_name, $user_login, $user_pass, $user_email )
	{
		$data = array( 'user_name' => $user_name, 'user_login' => $user_login, 'user_pass' => $user_pass, 'user_email' => $user_email, 'user_status' => REGISTER );
		$this->db->insert( 'user', $data );
	}
	
	function read( $id_user, $encoding = OBJECT )
	{
		/**
		 * $id_user can be:
		 * - numeric id dv_user.id_user
		 * - email dv_user.user_email
		 * - login dv_user.user_login
		 */
		if( is_numeric($id_user) ) {
			$this->db->where( 'id_user', $id_user );
		} else if( strpos($id_user, '@') ) {
			$this->db->where( 'user_email', $id_user );
		} else {
			$this->db->where( 'user_login', $id_user );
		}

		$query = $this->db->get( 'user' );

		if( 0 == strcasecmp($encoding, OBJECT) ) {
			return $query->result();
		} else if( 0 == strcasecmp($encoding, ARRAY_K ) ) { 
			return $query->result_array();
		} else {
			return json_encode( $query->result() );
		}
	}
	
	function update( $id_user, $data )
	{
		$this->db->where( 'id_user', $id_user );
		$this->db->update( 'user', $data );
	}
	
}

/* end of element_model.php */