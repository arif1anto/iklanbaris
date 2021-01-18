<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class log_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db->_protect_identifiers=false;
    }

    function get_by_id($id)
    {
        $this->db->where('LogSeq', $id);
        return $this->db->get('trlog')->row();
    }

    function total_rows($key = NULL, $param=NULL) {
        $q = $this->db->select('*')
        ->from('trlog');
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE \"%".$key."%\")",NULL,FALSE);
        }
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $key = NULL, $param=NULL, $order = "DESC") {
        $q = $this->db->select('*')
        ->from('trlog t')
        ->join("msuser_adm u","u.user_id=t.LogLsUsr")
        ->limit($limit, $start)
        ->order_by($param['kolom'] ,$order);
        if (isset($param['kolom']) && $param['kolom']!="") {
            $q = $q->where("(".$param['kolom']." LIKE \"%".$key."%\")",NULL,FALSE);
        }
        return $this->db->get()->result();
    }


    function insert($data)
    {
        $this->db->insert('trlog', $data);
    }

    function update($id, $data)
    {
        $this->db->where('LogSeq', $id);
        $this->db->update('trlog', $data);
    }

    function delete($id)
    {
        $this->db->where('LogSeq', $id);
        $this->db->delete('trlog');
    }

    function log($ket = null){
        if ($ket!=null) {
            $data = array(
                'LogLsUpd'  => date('Y-m-d h:i:s'),
                'LogLsUsr'  => $this->session->userdata('user_id'),
                'LogKet'    => $ket
            );
            $this->db->insert("trlog",$data);
        }
    }

}
