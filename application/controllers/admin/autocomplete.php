 <?php

 if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autocomplete extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function cari_karyawan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("SELECT a.*, c.jbnama, b.dvnama, b.dvkode, a.kyano id, concat(a.kyano,' ',a.kynm) as text FROM mskaryawan a 
                LEFT JOIN msdivisi b ON a.kydivisi=b.dvano 
                LEFT JOIN msjabatan c ON a.kyjabatan=c.jbano
                WHERE a.kystatus_kerja!='RESIGN' AND (kyano like '%".$keyword."%' or kynm like '%".$keyword."%') ORDER BY kyano ASC");
            $items = $q->result_array();

            $data["items"] = $items;
            $data["total_count"] = $q->num_rows();

            echo json_encode($data);
        }
    } 

    function cari_shift()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("select 
                CONCAT(TIME_FORMAT(a.shift1_jam1, '%H:%i'),' - ',TIME_FORMAT(a.shift1_jam2, '%H:%i')) shift1,
                CONCAT(TIME_FORMAT(a.shift2_jam1, '%H:%i'),' - ',TIME_FORMAT(a.shift2_jam2, '%H:%i')) shift2,
                CONCAT(TIME_FORMAT(a.shift3_jam1, '%H:%i'),' - ',TIME_FORMAT(a.shift3_jam2, '%H:%i')) shift3,
                a.id_jadwal id, a.nama_jadwal text, a.ket_jadwal from msjadwal a where a.nama_jadwal like '%$keyword%' OR a.ket_jadwal like '%$keyword%' ORDER BY nama_jadwal ASC");
            $items = $q->result_array();

            $data["items"] = $items;
            $data["total_count"] = $q->num_rows();

            echo json_encode($data);
        }
    } 

    function get_shift()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->post("id",TRUE);
            $q = $this->db->query("select 
                CONCAT(TIME_FORMAT(a.shift1_jam1, '%H:%i'),' - ',TIME_FORMAT(a.shift1_jam2, '%H:%i')) shift1,
                CONCAT(TIME_FORMAT(a.shift2_jam1, '%H:%i'),' - ',TIME_FORMAT(a.shift2_jam2, '%H:%i')) shift2,
                CONCAT(TIME_FORMAT(a.shift3_jam1, '%H:%i'),' - ',TIME_FORMAT(a.shift3_jam2, '%H:%i')) shift3,
                a.id_jadwal id, a.nama_jadwal text, a.ket_jadwal from msjadwal a where a.id_jadwal = '$keyword'");
            $row = $q->row();
            echo "Shift 1 : $row->shift1<br>Shift 2 : $row->shift2<br>Shift 3 : $row->shift3";
        }
    }

    function cari_divisi()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("SELECT a.dvano id, a.dvnama as text FROM msdivisi a
                where (dvano like '%".$keyword."%' or dvkode like '%".$keyword."%' or dvnama like '%".$keyword."%' ) ORDER BY dvano ASC");
            $items = $q->result_array();

            echo json_encode($items);

        }
    } 

    function cari_jabatan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("SELECT a.jbano id, a.jbnama as text FROM msjabatan a
                where (jbano like '%".$keyword."%' or jbnama like '%".$keyword."%') ORDER BY jbano ASC");
            $items = $q->result_array();

            echo json_encode($items);

        }
    } 

    function cari_pendidikan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("SELECT a.pend id, a.pend as text FROM mspend a
                where (pend like '%".$keyword."%') ORDER BY pend ASC");
            $items = $q->result_array();

            if (count($items)>0) {
                echo json_encode($items);
            } else {
                echo '[{"text":"'.$keyword.' *","id":"'.$keyword.'"}]';
            }
        }
    }

    function cari_usergroup()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $keyword = $this->input->get("q",TRUE);
            $q = $this->db->query("SELECT a.UsrGrpANo id, a.UsrGrpNm as text FROM msusergroup a
                where (a.UsrGrpANo like '%".$keyword."%' or a.UsrGrpNm like '%".$keyword."%') ORDER BY a.UsrGrpNm ASC");
            $items = $q->result_array();
            echo json_encode($items);
        }
    } 

    function get_sisahakcuti()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->model('karyawan_model');
            $nip = $this->input->post("nip",TRUE);
            $q = $this->karyawan_model->get_by_id($nip);
            if (isset($q->kymulai)) {
                $dvano = $q->dvano;
                $dvnama = $q->dvnama;
                $jbano = $q->jbano;
                $jbnama = $q->jbnama;
                $tglmasuk = tgl($q->kymulai);
                $ex = explode("/", $tglmasuk);
                if (date('m')<$ex[1]) {
                    $periode = $ex[1]."/".(date('Y')-1);
                } else {
                    $periode = $ex[1]."/".date('Y');
                }
                $q = $this->db->query("SELECT 12 - IFNULL(SUM(b.ctlama),0) sisa, a.kynm, a.kyhp FROM mskaryawan a
                    LEFT JOIN trcuti b ON a.kyano=b.kyano
                    WHERE a.kyano='$nip' AND b.ctjenis='Cuti Tidak Ditanggung' AND b.status='Y'
                    AND b.ctperiode='$periode'")->row();
                if (isset($q->sisa)) {
                    $data = array(
                        'hp' => $q->kyhp, 
                        'nm' => $q->kynm, 
                        'periode' => $periode, 
                        'sisa' => $q->sisa, 
                        'dvano' => $dvano, 
                        'dvnama' => $dvnama, 
                        'jbano' => $jbano, 
                        'jbnama' => $jbnama, 
                    );
                    echo json_encode($data);
                } 
            } 
        }
    }

    function get_karyawan()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->model('karyawan_model');
            $nip = $this->input->post("nip",TRUE);
            $q = $this->karyawan_model->get_by_id($nip);
            if (isset($q->kyano)) {

                $data = array(
                    'kyano' => $q->kyano, 
                    'nama' => $q->kynm,
                    'dvano' => $q->dvano, 
                    'dvnama' => $q->dvnama, 
                    'jbano' => $q->kyjabatan, 
                    'jbnama' => $q->jbnama, 
                    'glano' => $q->GlANo, 
                    'glnama' => $q->GlNama, 
                    'kyhp' => $q->kyhp, 
                    'headnama' => $q->head_nama, 
                    'head_id' => $q->head_id, 
                    'status_kerja' => $q->kystatus_kerja, 
                    'mulai' => tgl($q->kymulai), 
                    'selesai' => tgl($q->kyselesai), 
                    'jenis' => $q->kyjenis, 
                );
                echo json_encode($data);
            } 
        }
    }

    function get_sisapinjaman()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->model('pinjaman_model');
            $nip = $this->input->post("nip",TRUE);
            $q = $this->pinjaman_model->get_sisa($nip);
            if (isset($q->kyano)) {
                $data = array(
                    'kyano' => $q->kyano, 
                    'nama' => $q->kynm,
                    'sisa_pinjaman' => rp($q->sisa_pinjaman),
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'kyano' => "", 
                    'nama' => "",
                    'sisa_pinjaman' => 0,
                );
                echo json_encode($data);
            }
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

    function cari_variabel()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->model('setgaji_model');
            $SgAno = $this->input->post("SgAno",TRUE);
            $q = $this->setgaji_model->get_by_id($SgAno);
            if (isset($q->SgAno)) {

                $data = array(
                    'SgAno' => $q->SgAno, 
                    'SgVariabel' => $q->SgVariabel,
                );
                echo json_encode($data);
            } 
        }
    }

}

