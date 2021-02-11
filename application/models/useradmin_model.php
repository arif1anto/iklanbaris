<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class useradmin_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('admin_username', $id);
        return $this->db->get('msuser_admin')->row();
    }
    
    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
                  ->from('msuser_admin');
	if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
          }
	return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
                  ->from('msuser_admin')
                  ->limit($limit, $start)
                  ->order_by($param['kolom'] ,$order);
	if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
          }
	return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('msuser_admin', $data);
    }

    function update($id, $data)
    {
        $this->db->where('admin_username', $id);
        $this->db->update('msuser_admin', $data);
    }

    function delete($id)
    {
        $this->db->where('admin_username', $id);
        $this->db->delete('msuser_admin');
    }

    function nourut()
    {
        $pre = getconfig("pre");
        $pre = ($pre!=""?$pre:"yk");
        $no = $this->db->query("select MAX(RIGHT(admin_username,3)) as admin_username from msuser_admin limit 1");
        $autoId = (int) $no->row()->admin_username;
        $autoId++;
        $NewID = $pre."".sprintf("%03s",$autoId);
        return $NewID;
    }

}
