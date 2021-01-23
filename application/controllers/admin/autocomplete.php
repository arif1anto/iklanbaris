 <?php

 if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autocomplete extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    
    function cari_kategori()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("SELECT a.ktg_id id, a.ktg_name as text FROM mskategori a
                where (ktg_id like '%".$keyword."%' or ktg_name like '%".$keyword."%') ORDER BY ktg_id ASC");
            $items = $q->result_array();

            echo json_encode($items);

        }
    } 

    function get_notif()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $user_email = $this->session->userdata("user_email");
            $q = $this->db->query("SELECT * FROM notif 
                WHERE user_email='$user_email'
                AND waktu<=now() ORDER BY waktu DESC");
            $data = $q->result_array();
            echo json_encode($data);
        }
    }

    function get_newnotif()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $user_email = $this->session->userdata("user_email");
            $jml = $this->input->post("jml");
            $q = $this->db->query("SELECT * FROM notif 
                WHERE user_email='$user_email'
                AND waktu<=now() ORDER BY waktu ASC
                LIMIT $jml,100");
            $data = $q->result_array();
            echo json_encode($data);
        }
    }

    function set_read()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $id = $this->input->post("id");
            $this->db->query("UPDATE notif SET `read`=`read`+1, read_time=now() WHERE id='$id'");
            echo $id." readed";
        }
    }


}

