<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Iklan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('iklan_model','Log_model'));
        $this->load->library('form_validation');
    }

    public function index($act ='', $id ='') {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'admin/iklan/search';
        $this->ajax_pagination->initialize($config);
        $data = array(
            'act'       => $act,
            'id_sct'    => $id, 
            'iklan_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
        );

        $this->load->view('admin/template');
        $this->load->view('admin/iklan/iklan_home', $data);
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
            $totalRec = $this->iklan_model->total_rows($q, $param);
        }
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->iklan_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'admin/iklan/search';
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

        $this->load->view('admin/iklan/ajax', $data, FALSE);
    }

    public function read() 
    {
        $id = $this->input->post("ads_id");
        $row = $this->iklan_model->get_by_id($id);

        $data = array(
            'button' => '',
            'action' => '',
            'ads_id' => isset($row->ads_id) ? $row->ads_id : "",
            'ads_title' => isset($row->ads_title) ? $row->ads_title : "",
            'ads_konten' => isset($row->ads_konten) ? $row->ads_konten : "",
            'ads_user_email' => isset($row->ads_user_email) ? $row->ads_user_email : "",
            'ads_wa' => isset($row->ads_wa) ? $row->ads_wa : "",
            'ads_situs' => isset($row->ads_situs) ? $row->ads_situs : "",
            'ads_status' => isset($row->ads_status) ? $row->ads_status : "",
            'ads_draft' => isset($row->ads_draft) ? $row->ads_draft : "",
        );
        $this->load->view('admin/iklan/iklan_read', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => 'create_action',
            'ads_id'    => $this->iklan_model->nourut(),
            'ads_title' => set_value('ads_title'),
            'ads_konten' => set_value('ads_konten'),
            'ads_user_email' => set_value('ads_user_email'),
            'ads_wa' => set_value('ads_wa'),
            'ads_situs' => set_value('ads_situs'),
            'ads_status' => set_value('ads_status'),
            'ads_draft' => set_value('ads_draft'),
        );

        $this->load->view('admin/iklan/iklan_form', $data);
    }

    public function create_action() {

        $data = array(
            "ads_id" => $this->input->post("ads_id"),
            'ads_title' => $this->input->post('ads_title',TRUE),
            'ads_konten' => $this->input->post('ads_konten',TRUE),
            'ads_user_email' => $this->input->post('ads_user_email',TRUE),
            'ads_wa' => $this->input->post('ads_wa',TRUE),
            'ads_situs' => $this->input->post('ads_situs',TRUE),
            'ads_status' => $this->input->post('ads_status',TRUE),
            'ads_draft' => ($this->input->post('draft',TRUE)=="draft"?"Y":"N"),
        );

        if ($this->input->post("btn")=="Simpan") {
            $this->iklan_model->insert($data);
            $this->Log_model->log("CREATE Iklan No. ".$this->input->post('ads_id',TRUE)." ");
            echo "simpan";
        } else {
            $this->iklan_model->update($this->input->post('ads_id', TRUE), $data);
            $this->Log_model->log("EDIT Iklan No. ".$this->input->post('ads_id',TRUE)." ");
            echo "edit";
        }

    }

    public function update() 
    {
        $id = $this->input->post("ads_id");
        $row = $this->iklan_model->get_by_id($id);

        $data = array(
            'button' => 'Update',
            'action' => 'update_action',
            'ads_id' => set_value('ads_id', $row->ads_id),
            'ads_title' => set_value('ads_title', $row->ads_title),
            'ads_konten' => set_value('ads_konten', $row->ads_konten),
            'ads_user_email' => set_value('ads_user_email', $row->ads_user_email),
            'ads_wa' => set_value('ads_wa', $row->ads_wa),
            'ads_situs' => set_value('ads_situs', $row->ads_situs),
            'ads_status' => set_value('ads_status', $row->ads_status),
            'ads_draft' => set_value('ads_draft', $row->ads_draft),
        );
        $this->load->view('admin/iklan/iklan_form', $data);
    }

    public function update_action() 
    {
        $data = array(
            'ads_title' => $this->input->post('ads_title',TRUE),
            'ads_konten' => $this->input->post('ads_konten',TRUE),
            'ads_user_email' => $this->input->post('ads_user_email',TRUE),
            'ads_wa' => $this->input->post('ads_wa',TRUE),
            'ads_situs' => $this->input->post('ads_situs',TRUE),
            'ads_status' => $this->input->post('ads_status',TRUE),
            'ads_draft' => ($this->input->post('draft',TRUE)=="draft"?"Y":"N"),
        );

        $this->iklan_model->update($this->input->post('ads_id', TRUE), $data);
        $this->Log_model->log("EDIT Iklan No. ".$this->input->post('ads_id',TRUE)." ");
        echo "edit";
    }

    public function delete() 
    {
        $id = $this->input->post("ads_id");
        $row = $this->iklan_model->get_by_id($id);
        if (count($row)>0) {
            $this->iklan_model->delete($id);
            echo "OK";
        } else {
            echo "notfound";
        }
    }

}

