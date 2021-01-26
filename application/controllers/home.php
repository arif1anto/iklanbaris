<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model(array('iklan_model','Log_model'));
		cek_session();
	}

	public function index() {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'home/search';
        $this->ajax_pagination->initialize($config);
        $data = array(
            'iklan_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
        );

        $this->load->view('fe_home', $data);
    }

    public function search($pg=0)
    {
        $this->load->library('Ajax_pagination');
        $this->perPage = 20;
        $page = $this->input->post('page');

        if(!$page){
            $start = $pg;
        }else{
            $start = $page;
        }
        $q = $this->input->post('keyword');
        $field = $this->input->post('name');
        $value = $this->input->post('value');
        // var_dump($_POST); die;
        $param = array();
        for ($i=0; $i < count($field); $i++) { 
            $param[$field[$i]] = $value[$i];
        }
        
        $totalRec = $this->iklan_model->total_rows($q, $param);
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->iklan_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'home/search';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        $data = array(
            'iklan_data' => $dat,
            'q' => $q,
            'pagination' => $this->ajax_pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('fe_home_ajax', $data, FALSE);
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