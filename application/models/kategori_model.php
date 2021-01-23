<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('ktg_id', $id);
        return $this->db->get('mskategori')->row();
    }
    
    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
                  ->from('mskategori');
	if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
          }
	return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
                  ->from('mskategori')
                  ->limit($limit, $start)
                  ->order_by($param['kolom'] ,$order);
	if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
          }
	return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('mskategori', $data);
    }

    function update($id, $data)
    {
        $this->db->where('ktg_id', $id);
        $this->db->update('mskategori', $data);
    }

    function delete($id)
    {
        $this->db->where('ktg_id', $id);
        $this->db->delete('mskategori');
    }

    function nourut()
    {
        $pre = getconfig("pre");
        $pre = ($pre!=""?$pre:"yk");
        $no = $this->db->query("select MAX(RIGHT(ktg_id,3)) as ktg_id from mskategori limit 1");
        $autoId = (int) $no->row()->ktg_id;
        $autoId++;
        $NewID = $pre."".sprintf("%03s",$autoId);
        return $NewID;
    }

}
