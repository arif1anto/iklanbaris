<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('bank_model','Log_model'));
        $this->load->library('form_validation');
        cek_session_admin();
    }

    public function index($act ='', $id ='') {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'admin/bank/search';
        $this->ajax_pagination->initialize($config);
        $data = array(
            'act'       => $act,
            'id_sct'    => $id, 
            'bank_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
        );

        $this->load->view('admin/template');
        $this->load->view('admin/bank/Bank_home', $data);
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
            $totalRec = $this->bank_model->total_rows($q, $param);
        }
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->bank_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'admin/bank/search';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        $data = array(
            'bank_data' => $dat,
            'q' => $q,
            'pagination' => $this->ajax_pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/bank/ajax', $data, FALSE);
    }

    public function read() 
    {
        $id = $this->input->post("bank_id");
        $row = $this->bank_model->get_by_id($id);

        $data = array(
            'button' => '',
            'action' => '',
            'bank_id' => isset($row->bank_id) ? $row->bank_id : "",
            'bank_nama' => isset($row->bank_nama) ? $row->bank_nama : "",
            'bank_norek' => isset($row->bank_norek) ? $row->bank_norek : "",
            'bank_an' => isset($row->bank_an) ? $row->bank_an : "",
        );
        $this->load->view('admin/bank/Bank_read', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => 'create_action',
            'bank_id'    => $this->bank_model->nourut(),
            'bank_nama' => set_value('bank_nama'),
            'bank_norek' => set_value('bank_norek'),
            'bank_an' => set_value('bank_an'),
        );

        $this->load->view('admin/bank/Bank_form', $data);
    }

    public function create_action() {

        $data = array(
            "bank_id" => $this->input->post("bank_id"),
            'bank_nama' => $this->input->post('bank_nama',TRUE),
            'bank_norek' => $this->input->post('bank_norek',TRUE),
            'bank_an' => $this->input->post('bank_an',TRUE),
        );

        if ($this->input->post("btn")=="Simpan") {
            $this->bank_model->insert($data);
            $this->Log_model->log("CREATE Bank No. ".$this->input->post('bank_id',TRUE)." ");
            echo "simpan";
        } else {
            $this->bank_model->update($this->input->post('bank_id', TRUE), $data);
            $this->Log_model->log("EDIT Bank No. ".$this->input->post('bank_id',TRUE)." ");
            echo "edit";
        }

    }

    public function update() 
    {
        $id = $this->input->post("bank_id");
        $row = $this->bank_model->get_by_id($id);

        $data = array(
            'button' => 'Update',
            'action' => 'update_action',
            'bank_id' => set_value('bank_id', $row->bank_id),
            'bank_nama' => set_value('bank_nama', $row->bank_nama),
            'bank_norek' => set_value('bank_norek', $row->bank_norek),
            'bank_an' => set_value('bank_an', $row->bank_an),
        );
        $this->load->view('admin/bank/Bank_form', $data);
    }

    public function update_action() 
    {
        $data = array(
            'bank_nama' => $this->input->post('bank_nama',TRUE),
            'bank_norek' => $this->input->post('bank_norek',TRUE),
            'bank_an' => $this->input->post('bank_an',TRUE),
        );

        $this->bank_model->update($this->input->post('bank_id', TRUE), $data);
        $this->Log_model->log("EDIT Bank No. ".$this->input->post('bank_id',TRUE)." ");
        echo "edit";
    }

    public function delete() 
    {
        $id = $this->input->post("bank_id");
        $row = $this->bank_model->get_by_id($id);
        if (count($row)>0) {
            $this->bank_model->delete($id);
            echo "OK";
        } else {
            echo "notfound";
        }
    }

}

