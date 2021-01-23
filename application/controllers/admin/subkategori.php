<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subkategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Subkategori_model','Log_model'));
        $this->load->library('form_validation');
    }

    public function index($act ='', $id ='') {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'admin/subkategori/search';
        $this->ajax_pagination->initialize($config);
        $data = array(
            'act'       => $act,
            'id_sct'    => $id, 
            'subkategori_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
        );

        $this->load->view('admin/template');
        $this->load->view('admin/subkategori/Subkategori_home', $data);
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
            $totalRec = $this->Subkategori_model->total_rows($q, $param);
        }
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->Subkategori_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'admin/subkategori/search';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        $data = array(
            'subkategori_data' => $dat,
            'q' => $q,
            'pagination' => $this->ajax_pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('admin/subkategori/ajax', $data, FALSE);
    }

    public function read() 
    {
        $id = $this->input->post("subktg_id");
        $row = $this->Subkategori_model->get_by_id($id);

        $data = array(
            'button' => '',
            'action' => '',
            'subktg_id' => isset($row->subktg_id) ? $row->subktg_id : "",
            'subktg_name' => isset($row->subktg_name) ? $row->subktg_name : "",
            'ktg_id' => isset($row->ktg_id) ? $row->ktg_id : "",
            'ktg_name' => isset($row->ktg_name) ? $row->ktg_name : "",
        );
        $this->load->view('admin/subkategori/Subkategori_read', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => 'create_action',
            'subktg_id'    => $this->Subkategori_model->nourut(),
            'subktg_name' => set_value('subktg_name'),
            'ktg_id' => set_value('ktg_id'),
            'ktg_name' => set_value('ktg_name'),
        );

        $this->load->view('admin/subkategori/Subkategori_form', $data);
    }

    public function create_action() {

        $data = array(
            "subktg_id" => $this->input->post("subktg_id"),
            'subktg_name' => $this->input->post('subktg_name',TRUE),
            'ktg_id' => $this->input->post('ktg_id',TRUE),
        );

        if ($this->input->post("btn")=="Simpan") {
            $this->Subkategori_model->insert($data);
            $this->Log_model->log("CREATE Subkategori No. ".$this->input->post('subktg_id',TRUE)." ");
            echo "simpan";
        } else {
            $this->Subkategori_model->update($this->input->post('subktg_id', TRUE), $data);
            $this->Log_model->log("EDIT Subkategori No. ".$this->input->post('subktg_id',TRUE)." ");
            echo "edit";
        }

    }

    public function update() 
    {
        $id = $this->input->post("subktg_id");
        $row = $this->Subkategori_model->get_by_id($id);

        $data = array(
            'button' => 'Update',
            'action' => 'update_action',
            'subktg_id' => set_value('subktg_id', $row->subktg_id),
            'subktg_name' => set_value('subktg_name', $row->subktg_name),
            'ktg_id' => set_value('ktg_id', $row->ktg_id),
            'ktg_name' => set_value('ktg_name', $row->ktg_name),
        );
        $this->load->view('admin/subkategori/Subkategori_form', $data);
    }

    public function update_action() 
    {
        $data = array(
            'subktg_name' => $this->input->post('subktg_name',TRUE),
            'ktg_id' => $this->input->post('ktg_id',TRUE),
        );

        $this->Subkategori_model->update($this->input->post('subktg_id', TRUE), $data);
        $this->Log_model->log("EDIT Subkategori No. ".$this->input->post('subktg_id',TRUE)." ");
        echo "edit";
    }

    public function delete() 
    {
        $id = $this->input->post("subktg_id");
        $row = $this->Subkategori_model->get_by_id($id);
        if (count($row)>0) {
            $this->Subkategori_model->delete($id);
            echo "OK";
        } else {
            echo "notfound";
        }
    }

}

