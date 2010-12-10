<?php
require_once('load.php');
include('IXR_Library.php');

define( LOGFILE_XMLRPC, "xmlrpc.log" );

class DVFE_XMLRPC extends IXR_Server {

	var $dvfe;
	var $methods;
	
	public function DVFE_XMLRPC( &$dvdb ) {
		$this->dvfe = new DVFE( $dvdb );
		$this->methods = array(
	        'dvfe.get_images' => 'this:get_images'
	    );
	}
	
	public function get_images( $user_login ) {
		log_req( "getImages: ".$user_login." -- ", LOGFILE_XMLRPC );
		return $dvfe->get_images( $user_login );
	}
	
	public function serve_request() {
		$this->IXR_Server( $this->methods );
	}

}

$now = date( "c" );
$msg = $now." -- ";
log_req( $msg );

$dvfe_xmlrpc = new DVFE_XMLRPC( $dvdb );
$dvfe_xmlrpc->serve_request();
?>