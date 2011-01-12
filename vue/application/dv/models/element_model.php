<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Element_model
 *
 * @author TMA
 * @version 1.0 2011.01.10
 */
class Element_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function read_day( $id_user, $timecode, $encoding = OBJECT )
	{
		$date_start = date( 'Y-m-d', $timecode ).' 00:00:00 GMT';
		$date_end = date( 'Y-m-d', $timecode + 24 * 3600 ).' 00:00:00 GMT';

		$where_conditions = array( 'id_user' => $id_user, 'created >' => $date_start, 'created <' => $date_end );
		$this->db->where( $where_conditions );
		$this->db->order_by( 'created', 'desc' );

		$query = $this->db->get( 'element' );
//		log_message('debug', 'read_day: user '.$id_user.' ['.$date_start.','.$date_end.'] sql: '.$this->db->last_query());
		
		if( 0 == strcasecmp($encoding, OBJECT) ) {
			return $query->result();
		} else {
			return json_encode( $query->result() );
		}
	}

	function read( $id_element = SET, $encoding = OBJECT, $is_public = 1, $number = PAGE_SIZE, $offset = 0 )
	{
		if( SET == $id_element ) {
			$this->db->where( 'is_public', $is_public );
			$this->db->where( 'filename !=', 'NULL' );
		} else {
			$this->db->where( 'id_element', $id_element );
		}

		$this->db->order_by( 'created', 'desc' );

		$query = $this->db->get( 'element', $number, $offset );

		if( 0 == strcasecmp($encoding, OBJECT) ) {
			return $query->result();
		} else {
			return json_encode( $query->result() );
		}
	}
}

/* end of element_model.php */