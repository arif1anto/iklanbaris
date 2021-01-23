<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model
{

	var $table = '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table = 'msuser_admin';
    }

	function login_aksi($arg, $arg2)
	{
		$query	= $this->db->get_where($this->table, array ('admin_username' => $arg, 'admin_pass' => $arg2))->num_rows();
		return $query;
	}

	function get_user_data($arg, $arg2)
	{
		$query	= $this->db->get_where($this->table, array('admin_username' => $arg, 'admin_pass' => $arg2))->row();
		return $query;
	}

	function check()
	{
		if ($this->session->userdata('logged_in') != 'TRUE')
		{
            echo '<script>window.location.href = "'.base_url().'login";</script>';
			die("hak akses ditolak") ; 
		}
	}



}