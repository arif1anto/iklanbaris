<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class bank_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('bank_id', $id);
        return $this->db->get('msbank')->row();
    }
    
    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
                  ->from('msbank');
	if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
          }
	return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
                  ->from('msbank')
                  ->limit($limit, $start)
                  ->order_by($param['kolom'] ,$order);
	if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
          }
	return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('msbank', $data);
    }

    function update($id, $data)
    {
        $this->db->where('bank_id', $id);
        $this->db->update('msbank', $data);
    }

    function delete($id)
    {
        $this->db->where('bank_id', $id);
        $this->db->delete('msbank');
    }

    function nourut()
    {
        $pre = getconfig("pre");
        $pre = ($pre!=""?$pre:"yk");
        $no = $this->db->query("select MAX(RIGHT(bank_id,3)) as bank_id from msbank limit 1");
        $autoId = (int) $no->row()->bank_id;
        $autoId++;
        $NewID = $pre."".sprintf("%03s",$autoId);
        return $NewID;
    }

}
