<?php

$hasil = array();

if (isset($_POST['generate']))
{
    // get form data
    $table_name = safe($_POST['table_name']);
    $jenis_tabel = safe($_POST['jenis_tabel']);
    $controller = safe($_POST['controller']);
    $model = safe($_POST['model']);
    $judul = safe($_POST['judul']);

    if ($table_name <> '')
    {
        // set data
        $table_name = $table_name;
        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
        $m = $model<>''?$model: ucfirst($controller).'_model';
        $v_list = $controller . "_home";
        $v_read = $controller . "_read";
        $v_form = $controller . "_form";
        $v_ajax = "ajax";
        
        // url
        $c_url = strtolower($c);

        // filename
        $c_file = $c_url.'.php';
        $m_file = strtolower($m).'.php';
        $v_list_file = strtolower($v_list) . '.php';
        $v_read_file = strtolower($v_read) . '.php';
        $v_form_file = strtolower($v_form) . '.php';
        $v_ajax_file = 'ajax.php';


        $target='../application/';
        if (!file_exists("../application/views/" . $c_url))
        {
            mkdir("../application/views/" . $c_url, 0777, true);
        }

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // generate
        include 'core/create_controller.php';
        include 'core/create_model.php';
        $jenis_tabel == 'reguler_table' ? include 'core/create_view_list.php' : include 'core/create_view_list_datatables.php';
        include 'core/create_view_form.php';
        include 'core/create_view_ajax.php';
        include 'core/create_view_read.php';
        
        $hasil[] = $hasil_controller;
        $hasil[] = $hasil_model;
        $hasil[] = $hasil_view_list;
        $hasil[] = $hasil_view_form;
        $hasil[] = $hasil_view_ajax;
        $hasil[] = $hasil_view_read;
        
    } else{
        $hasil[] = 'No table selected.';
    }
}


?>