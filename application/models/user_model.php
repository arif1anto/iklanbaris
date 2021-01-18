<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('user_email', $id);
        return $this->db->get('msuser')->row();
    }
    
    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
        ->from('msuser');
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
        ->from('msuser')
        ->limit($limit, $start)
        ->order_by($param['kolom'] ,$order);
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('msuser', $data);
    }

    function update($id, $data)
    {
        $this->db->where('user_email', $id);
        $this->db->update('msuser', $data);
    }

    function delete($id)
    {
        $this->db->where('user_email', $id);
        $this->db->delete('msuser');
    }

}
