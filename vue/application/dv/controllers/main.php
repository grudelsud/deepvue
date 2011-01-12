<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Main
 * 
 * @author TMA
 * @version 1.0 2010.12.28
 */
class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('welcome');
	}
}

/* End of file main.php */
