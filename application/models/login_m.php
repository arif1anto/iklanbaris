<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model
{

	var $table = '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table = 'msuserid';
    }
	function datamenu()
	{
        $this->db->select('*');
        $this->db->from('menu'); 
        return $this->db->get()->result();
	}

		function menu()
	{
         $query=$this->db->query("select * from menu");
        return $query->row();
	}

	function login_aksi($arg, $arg2)
	{
		$query	= $this->db->get_where($this->table, array ('UsrKd' => $arg, 'UsrPswd' => $arg2))->num_rows();
		return $query;
	}

	function get_user_data($arg, $arg2)
	{
		$query	= $this->db->get_where($this->table, array('UsrKd' => $arg, 'UsrPswd' => $arg2))->row();
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