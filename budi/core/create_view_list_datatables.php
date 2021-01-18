<?php 

$string = "<div class=\"content-wrapper\" style=\"background: #dde2e2;\">
      <section class=\"content-header\">
        <h1>
          Data ".ucfirst($controller)."
        </h1>
        
        <ol class=\"breadcrumb\">
          <li><a href=\"#\"><i class=\"fa fa-dashboard\"></i> Home</a></li>
          <li><a href=\"user\">Data ".ucfirst($controller)."</a></li>
        </ol>
      </section>


<section class=\"content\">
          <div class=\"box box-primary\">
            <div class=\"box-header\">

                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
  
                <?php echo anchor(site_url('administrator/".$c_url."/create'), 'Tambah Baru', 'class=\"btn btn-primary\"'); ?>";
                             
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-success\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-success\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-success\"'); ?>";
}
$string .= "\n\t    </div>
<div class=\"box-body table-responsive\">
        <table class=\"table table-bordered table-striped\" id=\"example\">
            <thead>
                <tr>
                    <th width=\"20px\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t    <th style=\"min-width: 175px;max-width: 175px\">Action</th>
                </tr>
            </thead>";
$string .= "\n\t    <tbody>
            <?php
            \$start = 0;
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t    <td><?php echo ++\$start ?></td>";

foreach ($non_pk as $row) {
    $string .= "\n\t\t    <td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}

$string .= "\n\t\t\t<td width=\"280px>\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('administrator/".$c_url."/read/'.$".$c_url."->".$pk."),'<i class=\"fa fa-eye\"></i> Lihat','class=\"btn btn-primary btn-xs\"'); "

        . "\n\t\t\t\techo anchor(site_url('administrator/".$c_url."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-pencil\"></i> Edit','class=\"btn btn-success btn-xs\"'); "

        . "\n\t\t\t\techo anchor(site_url('administrator/".$c_url."/delete/'.$".$c_url."->".$pk."),'<i class=\"fa fa-trash-o\"></i> Hapus','class=\"btn btn-danger btn-xs\"','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>
</div>
    </div>
    </section>
    </section>
    </div>";


$hasil_view_list = createFile($string, $target."views/admin/" . $c_url . "/" . $v_list_file);

?>