<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model','Log_model'));
        $this->load->library('form_validation');
        cek_session_admin();
    }

    public function index() {
        $data = array(
            'user_data' => NULL,
        );

        $this->load->view('admin/template');
        $this->load->view('admin/chat', $data);
        $this->load->view('admin/footer');
    }


}

