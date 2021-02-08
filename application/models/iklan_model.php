<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class iklan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('ads_id', $id)
        ->join('msads_style b','a.ads_style=b.style_id','left');
        return $this->db->get('triklan a')->row();
    }
    
    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
        ->from('triklan a');
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
        ->from('triklan a')
        ->join('msads_style b','a.ads_style=b.style_id','left')
        ->limit($limit, $start);
        if ($param['kolom']!="") {
            $q = $q->order_by($param['kolom'] ,$order);
        }
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE '%".$key."%')",NULL,FALSE);
        }
        return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('triklan', $data);
    }

    function update($id, $data)
    {
        $this->db->where('ads_id', $id);
        $this->db->update('triklan', $data);
    }

    function delete($id)
    {
        $this->db->where('ads_id', $id);
        $this->db->delete('triklan');
    }

    function nourut()
    {
        $pre = getconfig("pre");
        $pre = ($pre!=""?$pre:"AD");
        $no = $this->db->query("select MAX(RIGHT(ads_id,7)) as ads_id from triklan limit 1");
        $autoId = (int) $no->row()->ads_id;
        $autoId++;
        $NewID = $pre."".sprintf("%07s",$autoId);
        return $NewID;
    }

}
