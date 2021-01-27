<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasang_iklan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model(array('iklan_model','Log_model'));
		cek_session_user();
	}

	public function index() {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'pasang_iklan/search';
        $this->ajax_pagination->initialize($config);
        $data = array(
            'iklan_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
        );

        $this->load->view('fe_pasangiklan', $data);
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
        $param['user'] = $this->session->userdata('user_email');
        
        $totalRec = $this->iklan_model->total_rows($q, $param);
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->iklan_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'pasang_iklan/search';
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

        $this->load->view('fe_pasangiklan_ajax', $data, FALSE);
    }

}

?>