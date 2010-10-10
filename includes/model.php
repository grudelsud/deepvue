<?php
class DVModel {
	
	var $id;

	function DVModel() {
		return $this->__construct();
	}
	function __construct() {
		return true;
	}
	function __destruct() {
		return true;
	}
}

class DVUser extends DVModel {
	function DVUser() {
		return $this->__construct();
	}
	function __construct() {
		return true;
	}
	function __destruct() {
		return true;
	}
}
?>