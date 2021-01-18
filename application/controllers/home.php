<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//cek_session();
	}
	public function index()
	{
		$this->load->view('fe_home');
		$data = null;
	}

	function register()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script allowed');
		}
		$data_in = [
		    'user_email' => $this->input->post('email'),
		    'user_firstname' => $this->input->post('firstname'),
		    'user_lastname' => $this->input->post('lastname'),
		    'user_pass' => $this->input->post('password'),
		    'user_hp' => $this->input->post('hp'),
		    'user_last_login' => null,
		    'user_status' => 'Aktif',
		    'user_email_verified' => false,
		];
		$cek = $this->db->insert('msuser',$data_in);
		if ($cek) {
			$data = [
			    'status'=> 200,
			    'msg'	=> "Registrasi Suskses, hapar cek inbox email anda untuk verifikasi"
			];
		} else {
			$data = [
			    'status'=> 500,
			    'msg'	=> "Registrasi Gagal"
			];
		}
		echo json_encode($data);
	}

	function login()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script allowed');
		}

	    $user_email = $this->input->post('email_login');
	    $user_pass = $this->input->post('password_login');

	    $cek = $this->db->get_where('msuser',['user_email' => $user_email])->row();
	    $status = 404;
	    if (!isset($cek->user_email)) {
	    	$msg = "Email anda belum terdaftar";
	    } elseif ($cek->user_status!="Aktif") {
	    	$msg = "Akun anda sudah tidak aktif";
	    } elseif ($cek->user_pass!=$user_pass) {
	    	$msg = "Email / Password yang anda masukan salah";
	    } elseif ($cek->user_pass==$user_pass) {
	    	$msg = "Login Berhasil";
	    	$status = 200;
	    	$data_up = [
	    	    'user_last_login' => date('Y-m-d H:i:s')
	    	];
	    	$this->db->where(['user_email' => $user_email])->update('msuser',$data_up);
	    	$sess_data = [
	    		'user_loged_in' => 'TRUE',
	    		'user_email' => $user_email,
	    		'firstname' => $cek->user_firstname,
	    		'lastname' => $cek->user_lastname,
	    	];
	    	
	    	$this->session->set_userdata( $sess_data );
	    }

		$data = [
		    'status'=> $status,
		    'msg'	=> $msg,
		];
		echo json_encode($data);
	}

	function logout()
	{
		$this->session->unset_userdata("user_loged_in");
		$this->session->unset_userdata("user_email");
		$this->session->unset_userdata("firstname");
		$this->session->unset_userdata("lastname");
		redirect('home','refresh');
	}

}

?>