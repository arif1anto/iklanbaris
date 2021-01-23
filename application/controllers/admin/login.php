<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->model('login_m');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == 'TRUE')
		{
			redirect('admin/home');
		}
		$this->load->view("admin/login/login"); 
	}

	function login_aksi() 
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password"); 
		
		if ( $this->login_m->login_aksi($username, $password) == 1 )
		{	
			$data		= $this->login_m->get_user_data($username,$password);
			$session_data	= array 
			(
				'username'		=> $data->admin_name,
				'user_id'		=> $data->admin_username,
				'logged_in'		=> 'TRUE',
				'date'			=> date('Y-m-d H:i:s'),
			);
			$this->session->set_userdata($session_data);

			redirect("admin/home") ; 
		}else{
			$this->session->set_userdata("pesan","Username / Password salah");
			redirect("admin/login") ; 
		}
	}


	function logout_post()
	{
		$this->session->unset_userdata("logged_in");
		$this->session->sess_destroy();
		redirect("admin/login") ; 
	}

}
