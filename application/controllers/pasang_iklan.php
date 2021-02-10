<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasang_iklan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model(array('iklan_model','Log_model'));
		cek_session_user();
	}

	public function index() {
        $this->load->library('Ajax_pagination');
        $config['target']      = '#tbl_data';
        $config['base_url']    = base_url().'pasang_iklan/search';
        $this->ajax_pagination->initialize($config);

        $tema_data = $this->db->query('select * from msads_style')->result();
        $data_ktg = $this->db->query("SELECT CONCAT(ktg_id,'-') ktg_id, ktg_name FROM mskategori 
UNION ALL
select CONCAT(a.ktg_id,'-',b.subktg_id), CONCAT(a.ktg_name,' - ',b.subktg_name) from mskategori a
inner join mssubkategori b ON a.ktg_id=b.ktg_id")->result();
        $data_wil = $this->db->query('select * from mswilayah')->result();
        $data_bank = $this->db->query('select * from msbank')->result();
        $data_point = $this->db->query('select * from trpoint')->result();
        $data = array(
            'iklan_data' => NULL,
            'q'         => NULL,
            'pagination'=> $this->ajax_pagination->create_script(),
            'total_rows'=> NULL,
            'start'     => NULL,
            'tema_data' => $tema_data,
            'data_ktg' => $data_ktg,
            'data_wil' => $data_wil,
            'data_bank' => $data_bank,
            'data_point' => $data_point,
        );

        $this->load->view('fe_pasangiklan', $data);
    }

    public function search($pg=0)
    {
        $this->load->library('Ajax_pagination');
        $this->perPage = 20;
        $page = $this->input->post('page');

        if(!$page){
            $start = $pg;
        }else{
            $start = $page;
        }
        $q = $this->input->post('keyword');
        $field = $this->input->post('name');
        $value = $this->input->post('value');
        // var_dump($_POST); die;
        $param = array();
        for ($i=0; $i < count($field); $i++) { 
            $param[$field[$i]] = $value[$i];
        }
        $param['user'] = $this->session->userdata('user_email');
        
        $totalRec = $this->iklan_model->total_rows($q, $param);
        $order = 'ASC';
        if ($this->input->post('desc')=='true') {
            $order = 'DESC';
        }
        $dat = $this->iklan_model->get_limit_data($this->perPage, $start, $q, $param, $order);
        
        $config['target']      = '#tbl_data';
        $config['keyword']     = '#keyword';
        $config['num_links']   = 3;
        $config['base_url']    = base_url().'pasang_iklan/search';
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

        $this->load->view('fe_pasangiklan_ajax', $data, FALSE);
    }

    public function simpan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script allowed');
        }
        $ktg = $this->input->post('ads_ktg');
        $ktg = explode("-",$ktg);
        $draft = "Y";
        $result = $this->input->post('result');
        if ($result==null || $result=="") {
            $draft = "Y";
        }
        $data = [
            'ads_id'         => $this->iklan_model->nourut(),
            'ads_title'      => $this->input->post('judul'),
            'ads_konten'     => $this->input->post('isi_iklan'),
            'ads_user_email' => $this->input->post('email'),
            'ads_wa'         => $this->input->post('wa'),
            'ads_situs'      => $this->input->post('situs'),
            'ads_status'     => $this->input->post('status'),
            'ads_draft'      => $draft,
            'ads_lama'       => $this->input->post('hari_tayang'),
            'ads_tgl_aju'    => date('Y/m/d h:i:s'),
            'ads_tgl_byr'    => null,
            'ads_style'      => $this->input->post('pilih_tema'),
            'ads_ktg'        => $ktg[0],
            'ads_subktg'     => $ktg[1],
            'ads_wil'        => $this->input->post('wil_id'),
            'ads_byrtipe'    => $this->input->post('metode_bayar'),
            'ads_nominal'    => convert_rp($this->input->post('total')),
            'ads_midtrans'   => null,
            'ads_byrnama'    => null,
            'ads_byrtgltrf'  => null,
            'ads_byrrek'     => null,
            'ads_byrbank'    => null,
            'ads_buktitrf'   => null,
            'ads_byrkonfirm' => "N",
        ];


        $cek = $this->iklan_model->insert($data);
        if ($cek) {
            echo json_encode([
                'status' => TRUE,
                'draft'     => $draft,
                'pesan' => 'Iklan Anda Berhasil Disimpan',
            ]);
        } else {
            echo json_encode([
                'status' => FALSE,
                'pesan' => 'Iklan Anda Gagal Disimpan',
            ]);
        }
    }

}

?>