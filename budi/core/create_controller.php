<?php

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ".$c." extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        \$this->load->model(array('$m','Log_model'));
        \$this->load->library('form_validation');
    }";

    if ($jenis_tabel == 'reguler_table') {

        $string .= "\n\npublic function index(\$act ='', \$id ='') {
            \$this->load->library('Ajax_pagination');
            \$config['target']      = '#tbl_data';
            \$config['base_url']    = base_url().'".$c_url."/search';
            \$this->ajax_pagination->initialize(\$config);
            \$data = array(
                'act'       => \$act,
                'id_sct'    => \$id, 
                '".$c_url."_data' => NULL,
                'q'         => NULL,
                'pagination'=> \$this->ajax_pagination->create_script(),
                'total_rows'=> NULL,
                'start'     => NULL,
            );

            \$this->load->view('template');
            \$this->load->view('$c_url/$v_list', \$data);
            \$this->load->view('footer');
            \$this->session->unset_userdata('message');
        }";

    $string .="\n\npublic function search(\$pg=0)
    {
        \$this->load->library('Ajax_pagination');
        \$this->perPage = 10;
        \$page = \$this->input->post('page');

        if(!\$page){
            \$start = \$pg;
        }else{
            \$start = \$page;
        }
        \$q = \$this->input->post('keyword');
        \$field = \$this->input->post('name');
        \$value = \$this->input->post('value');
        \$param = array(\$field[0] => \$value[0]);
        for (\$i=0; \$i < count(\$field); \$i++) { 
            \$param[\$field[\$i]] = \$value[\$i];
        }
        
        \$totalRec = 20;
        if (\$this->input->post('limit')=='true') {
            \$start = 0;
            if (\$totalRec > \$this->perPage) {
                \$totalRec = \$this->perPage;
            }
        } else {
            \$totalRec = \$this->".$m."->total_rows(\$q, \$param);
        }
            \$order = 'ASC';
        if (\$this->input->post('desc')=='true') {
            \$order = 'DESC';
        }
        \$dat = \$this->".$m."->get_limit_data(\$this->perPage, \$start, \$q, \$param, \$order);
        
        \$config['target']      = '#tbl_data';
        \$config['keyword']     = '#keyword';
        \$config['num_links']   = 3;
        \$config['base_url']    = base_url().'".$c_url."/search';
        \$config['total_rows']  = \$totalRec;
        \$config['per_page']    = \$this->perPage;
        \$this->ajax_pagination->initialize(\$config);
        
        \$data = array(
            '".$c_url."_data' => \$dat,
            'q' => \$q,
            'pagination' => \$this->ajax_pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
            );

        \$this->load->view('".$c_url."/ajax', \$data, FALSE);
    }";

// akhir seting page tanpa data table
    } else {
        $string .="\n\n public function index()
        {
            \$$c_url = \$this->" .$m. "->get_all();
            \$data = array(
                '".$c_url."_data' => \$$c_url
            );
            \$this->load->view('template');
            \$this->load->view('$c_url/$v_list', \$data);
            \$this->load->view('footer');
        }";
    }

    
    $string .= "\n\npublic function read() 
    {
        \$id = \$this->input->post(\"".$pk."\");
        \$row = \$this->".$m."->get_by_id(\$id);

        \$data = array(
                'button' => '',
                'action' => '',";
            foreach ($all as $row) {
                $string .= "\n\t\t\t\t'".$row['column_name']."' => isset(\$row->".$row['column_name'].") ? \$row->".$row['column_name']." : \"\",";
            }
            $string .= "\n\t    );
        \$this->load->view('$c_url/$v_read', \$data);
    }

    public function create() 
    {
        \$data = array(
            'button' => 'Simpan',
            'action' => 'create_action',
            '$pk'    => \$this->".$m."->nourut(),";
            foreach ($non_pk as $row) {
                $string .= "\n\t\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
            }
            $string .= "\n\t);

            \$this->load->view('$c_url/$v_form', \$data);
        }

    public function create_action() {

        \$data = array(
        \"$pk\" => \$this->input->post(\"".$pk."\"),";
        foreach ($non_pk as $row) {
        $string .= "\n\t\t\t\t'".$row['column_name']."' => \$this->input->post('".$row['column_name']."',TRUE),";
                }
                $string .= "\n\t    );

        if (\$this->input->post(\"btn\")==\"Simpan\") {
            \$this->".$m."->insert(\$data);
            \$this->Log_model->log(\"CREATE ".$c." No. \".\$this->input->post('$pk',TRUE).\" \");
            echo \"simpan\";
        } else {
            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->Log_model->log(\"EDIT ".$c." No. \".\$this->input->post('$pk',TRUE).\" \");
            echo \"edit\";
        }

        }

        public function update() 
        {
            \$id = \$this->input->post(\"".$pk."\");
            \$row = \$this->".$m."->get_by_id(\$id);

            \$data = array(
                'button' => 'Update',
                'action' => 'update_action',";
                foreach ($all as $row) {
                $string .= "\n\t\t\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
                }
                $string .= "\n\t    );
            \$this->load->view('$c_url/$v_form', \$data);
            }

            public function update_action() 
            {
                \$data = array(";
                    foreach ($non_pk as $row) {
                    $string .= "\n\t\t\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
                    }    
                    $string .= "\n\t    );

                \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
                \$this->Log_model->log(\"EDIT ".$c." No. \".\$this->input->post('$pk',TRUE).\" \");
                echo \"edit\";
            }

            public function delete() 
            {
                \$id = \$this->input->post(\"".$pk."\");
                \$row = \$this->".$m."->get_by_id(\$id);
                if (count(\$row)>0) {
                    \$this->".$m."->delete(\$id);
                    echo \"OK\";
                } else {
                    echo \"notfound\";
                }
            }";

        $string .= "\n\n}\n\n";

        $hasil_controller = createFile($string, $target."controllers/".$c_file);

        ?>