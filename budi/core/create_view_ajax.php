<?php 
$string = "<div class=\"table-responsive\">
    <table class=\"table table-bordered table-middle table-lilac\">
        <thead>
        <tr>
        <th>No</th>";
foreach ($all as $row) {
    $string .= "\n\t\t<th>" . ($row['COLUMN_COMMENT']) . "</th>";
}
    $string .= "\n\t\t
        </tr>
        </thead>
    <tbody>";
$string .= "<?php
foreach ($".$c_url."_data as \$row)
{
    ?>
    <tr ondblclick=\"show_detail('<?php echo \$row->$pk ?>')\">";

    $string .= "\n\t\t\t<td width=\"20px\"><?php echo ++\$start ?></td>";
    foreach ($all as $row) {
        $string .= "\n\t\t\t<td><?php echo \$row->".$row['column_name']." ?></td>";
    }
    $string .=  "\n\t\t</tr>
    <?php
}
?>
    </tbody>
</table>
</div>

  <div class=\"col-md-8\">
    <?php echo \$pagination ?>
  </div>
";

$hasil_view_ajax = createFile($string, $target."views/".$c_url."/".$v_ajax_file);

?>