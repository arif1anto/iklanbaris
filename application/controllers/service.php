<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//cek_session();
		if (!$this->input->is_ajax_request()) {
			exit('No Direct Script Allowed');
		}
	}

	function get_ads()
	{
		
	}

}

?>