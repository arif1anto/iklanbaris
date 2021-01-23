<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subkategori_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('subktg_id', $id)
                ->join('mskategori b','a.ktg_id=b.ktg_id');
        return $this->db->get('mssubkategori a')->row();
    }
    
    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
        ->from('mssubkategori');
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
        ->from('mssubkategori a')
        ->join('mskategori b','a.ktg_id=b.ktg_id')
        ->limit($limit, $start)
        ->order_by($param['kolom'] ,$order);
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('mssubkategori', $data);
    }

    function update($id, $data)
    {
        $this->db->where('subktg_id', $id);
        $this->db->update('mssubkategori', $data);
    }

    function delete($id)
    {
        $this->db->where('subktg_id', $id);
        $this->db->delete('mssubkategori');
    }

    function nourut()
    {
        $pre = getconfig("pre");
        $pre = ($pre!=""?$pre:"yk");
        $no = $this->db->query("select MAX(RIGHT(subktg_id,3)) as subktg_id from mssubkategori limit 1");
        $autoId = (int) $no->row()->subktg_id;
        $autoId++;
        $NewID = $pre."".sprintf("%03s",$autoId);
        return $NewID;
    }

}