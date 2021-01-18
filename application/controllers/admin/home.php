<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_m');
		//cek_session();
	}
	public function index()
	{
		$this->load->view('admin/template');
		$data = null;
		$this->load->view('admin/konten',$data);
		$this->load->view('admin/footer');
	}

}

?>