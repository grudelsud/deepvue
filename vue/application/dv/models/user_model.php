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

	function read( $id_user, $encoding = OBJECT )
	{
		if( is_numeric($id_user) ) {
			$this->db->where( 'id_user', $id_user );
		} else {
			$this->db->where( 'user_login', $id_user );
		}

		$query = $this->db->get( 'user' );

		if( 0 == strcasecmp($encoding, OBJECT) ) {
			return $query->result();
		} else {
			return json_encode( $query->result() );
		}
	}
}

/* end of element_model.php */