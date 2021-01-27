<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model','Log_model'));
        $this->load->library('form_validation');
        cek_session_admin();
    }

    public function index($act ='', $id ='') {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'admin/user/search';
        $this->ajax_pagination->initialize($config);
        $data = array(
            'act'       => $act,
            'id_sct'    => $id, 
            'user_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
        );

        $this->load->view('admin/template');
        $this->load->view('admin/user/User_home', $data);
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

        $totalRec = $this->User_model->total_rows($q, $param);
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->User_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'admin/user/search';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        $data = array(
            'user_data' => $dat,
            'q' => $q,
            'pagination' => $this->ajax_pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/user/ajax', $data, FALSE);
    }

    public function read() 
    {
        $id = $this->input->post("user_email");
        $row = $this->User_model->get_by_id($id);

        $data = array(
            'button' => '',
            'action' => '',
            'user_email' => isset($row->user_email) ? $row->user_email : "",
            'user_firstname' => isset($row->user_firstname) ? $row->user_firstname : "",
            'user_lastname' => isset($row->user_lastname) ? $row->user_lastname : "",
            'user_pass' => isset($row->user_pass) ? $row->user_pass : "",
            'user_hp' => isset($row->user_hp) ? $row->user_hp : "",
            'user_last_login' => isset($row->user_last_login) ? $row->user_last_login : "",
            'user_status' => isset($row->user_status) ? $row->user_status : "",
            'user_email_verified' => isset($row->user_email_verified) ? $row->user_email_verified : "",
        );
        $this->load->view('admin/user/User_read', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => 'create_action',
            'user_email'    => "",
            'user_firstname' => set_value('user_firstname'),
            'user_lastname' => set_value('user_lastname'),
            'user_pass' => set_value('user_pass'),
            'user_hp' => set_value('user_hp'),
            'user_last_login' => set_value('user_last_login'),
            'user_status' => set_value('user_status'),
            'user_email_verified' => set_value('user_email_verified'),
        );

        $this->load->view('admin/user/User_form', $data);
    }

    public function create_action() {

        $data = array(
            "user_email" => $this->input->post("user_email"),
            'user_firstname' => $this->input->post('user_firstname',TRUE),
            'user_lastname' => $this->input->post('user_lastname',TRUE),
            'user_pass' => $this->input->post('user_pass',TRUE),
            'user_hp' => $this->input->post('user_hp',TRUE),
            'user_last_login' => $this->input->post('user_last_login',TRUE),
            'user_status' => $this->input->post('user_status',TRUE),
            'user_email_verified' => $this->input->post('user_email_verified',TRUE),
        );

        if ($this->input->post("btn")=="Simpan") {
            $this->User_model->insert($data);
            $this->Log_model->log("CREATE User No. ".$this->input->post('user_email',TRUE)." ");
            echo "simpan";
        } else {
            $this->User_model->update($this->input->post('user_email', TRUE), $data);
            $this->Log_model->log("EDIT User No. ".$this->input->post('user_email',TRUE)." ");
            echo "edit";
        }

    }

    public function update() 
    {
        $id = $this->input->post("user_email");
        $row = $this->User_model->get_by_id($id);

        $data = array(
            'button' => 'Update',
            'action' => 'update_action',
            'user_email' => set_value('user_email', $row->user_email),
            'user_firstname' => set_value('user_firstname', $row->user_firstname),
            'user_lastname' => set_value('user_lastname', $row->user_lastname),
            'user_pass' => set_value('user_pass', $row->user_pass),
            'user_hp' => set_value('user_hp', $row->user_hp),
            'user_last_login' => set_value('user_last_login', $row->user_last_login),
            'user_status' => set_value('user_status', $row->user_status),
            'user_email_verified' => set_value('user_email_verified', $row->user_email_verified),
        );
        $this->load->view('admin/user/User_form', $data);
    }

    public function update_action() 
    {
        $data = array(
            'user_firstname' => $this->input->post('user_firstname',TRUE),
            'user_lastname' => $this->input->post('user_lastname',TRUE),
            'user_pass' => $this->input->post('user_pass',TRUE),
            'user_hp' => $this->input->post('user_hp',TRUE),
            'user_last_login' => $this->input->post('user_last_login',TRUE),
            'user_status' => $this->input->post('user_status',TRUE),
            'user_email_verified' => $this->input->post('user_email_verified',TRUE),
        );

        $this->User_model->update($this->input->post('user_email', TRUE), $data);
        $this->Log_model->log("EDIT User No. ".$this->input->post('user_email',TRUE)." ");
        echo "edit";
    }

    public function delete() 
    {
        $id = $this->input->post("user_email");
        $row = $this->User_model->get_by_id($id);
        if (count($row)>0) {
            $this->User_model->delete($id);
            echo "OK";
        } else {
            echo "notfound";
        }
    }

}

