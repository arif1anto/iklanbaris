<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('useradmin_model','Log_model'));
        $this->load->library('form_validation');
    }

public function index($act ='', $id ='') {
            $this->load->library('Ajax_pagination');
            $config['target']      = '#tbl_data';
            $config['base_url']    = base_url().'admin/user_admin/search';
            $this->ajax_pagination->initialize($config);
            $data = array(
                'act'       => $act,
                'id_sct'    => $id, 
                'user_admin_data' => NULL,
                'q'         => NULL,
                'pagination'=> $this->ajax_pagination->create_script(),
                'total_rows'=> NULL,
                'start'     => NULL,
            );

            $this->load->view('admin/template');
            $this->load->view('admin/user_admin/User_admin_home', $data);
            $this->load->view('admin/footer');
            $this->session->unset_userdata('message');
        }

public function search($pg=0)
    {
        $this->load->library('Ajax_pagination');
        $this->perPage = 10;
        $page = $this->input->post('page');

        if(!$page){
            $start = $pg;
        }else{
            $start = $page;
        }
        $q = $this->input->post('keyword');
        $field = $this->input->post('name');
        $value = $this->input->post('value');
        $param = array($field[0] => $value[0]);
        for ($i=0; $i < count($field); $i++) { 
            $param[$field[$i]] = $value[$i];
        }
        
        $totalRec = 20;
        if ($this->input->post('limit')=='true') {
            $start = 0;
            if ($totalRec > $this->perPage) {
                $totalRec = $this->perPage;
            }
        } else {
            $totalRec = $this->useradmin_model->total_rows($q, $param);
        }
            $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->useradmin_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'admin/user_admin/search';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        $data = array(
            'user_admin_data' => $dat,
            'q' => $q,
            'pagination' => $this->ajax_pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            );

        $this->load->view('admin/user_admin/ajax', $data, FALSE);
    }

public function read() 
    {
        $id = $this->input->post("admin_username");
        $row = $this->useradmin_model->get_by_id($id);

        $data = array(
                'button' => '',
                'action' => '',
				'admin_username' => isset($row->admin_username) ? $row->admin_username : "",
				'admin_pass' => isset($row->admin_pass) ? $row->admin_pass : "",
				'admin_email' => isset($row->admin_email) ? $row->admin_email : "",
				'admin_name' => isset($row->admin_name) ? $row->admin_name : "",
				'admin_foto' => isset($row->admin_foto) ? $row->admin_foto : "",
	    );
        $this->load->view('admin/user_admin/User_admin_read', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => 'create_action',
            'admin_username'    => $this->useradmin_model->nourut(),
			'admin_pass' => set_value('admin_pass'),
			'admin_email' => set_value('admin_email'),
			'admin_name' => set_value('admin_name'),
			'admin_foto' => set_value('admin_foto'),
	);

            $this->load->view('admin/user_admin/User_admin_form', $data);
        }

    public function create_action() {

        $data = array(
        "admin_username" => $this->input->post("admin_username"),
				'admin_pass' => $this->input->post('admin_pass',TRUE),
				'admin_email' => $this->input->post('admin_email',TRUE),
				'admin_name' => $this->input->post('admin_name',TRUE),
				'admin_foto' => $this->input->post('admin_foto',TRUE),
	    );

        if ($this->input->post("btn")=="Simpan") {
            $this->useradmin_model->insert($data);
            $this->Log_model->log("CREATE User_admin No. ".$this->input->post('admin_username',TRUE)." ");
            echo "simpan";
        } else {
            $this->useradmin_model->update($this->input->post('admin_username', TRUE), $data);
            $this->Log_model->log("EDIT User_admin No. ".$this->input->post('admin_username',TRUE)." ");
            echo "edit";
        }

        }

        public function update() 
        {
            $id = $this->input->post("admin_username");
            $row = $this->useradmin_model->get_by_id($id);

            $data = array(
                'button' => 'Update',
                'action' => 'update_action',
				'admin_username' => set_value('admin_username', $row->admin_username),
				'admin_pass' => set_value('admin_pass', $row->admin_pass),
				'admin_email' => set_value('admin_email', $row->admin_email),
				'admin_name' => set_value('admin_name', $row->admin_name),
				'admin_foto' => set_value('admin_foto', $row->admin_foto),
	    );
            $this->load->view('admin/user_admin/User_admin_form', $data);
            }

            public function update_action() 
            {
                $data = array(
				'admin_pass' => $this->input->post('admin_pass',TRUE),
				'admin_email' => $this->input->post('admin_email',TRUE),
				'admin_name' => $this->input->post('admin_name',TRUE),
				'admin_foto' => $this->input->post('admin_foto',TRUE),
	    );

                $this->useradmin_model->update($this->input->post('admin_username', TRUE), $data);
                $this->Log_model->log("EDIT User_admin No. ".$this->input->post('admin_username',TRUE)." ");
                echo "edit";
            }

            public function delete() 
            {
                $id = $this->input->post("admin_username");
                $row = $this->useradmin_model->get_by_id($id);
                if (count($row)>0) {
                    $this->useradmin_model->delete($id);
                    echo "OK";
                } else {
                    echo "notfound";
                }
            }

}

