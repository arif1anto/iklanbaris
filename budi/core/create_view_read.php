<?php 

$string = "\n\t<div class=\"panel rounded shadow\">
  <div class=\"panel-body no-padding rounded-bottom\">
    <form action=\"<?php echo \$action; ?>\" class=\"form-horizontal form-bordered\" method=\"post\">
      <div class=\"form-body\">
        <input type=\"hidden\" name=\"btn\" value=\"<?php echo \$button; ?>\" />
        <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo \$".$pk."; ?>\" /> ";
foreach ($all as $row) {
    if ($row["data_type"] == 'text'){
$string .= "\n\t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label text-left\">".label($row["COLUMN_COMMENT"])."</label>
            <div class=\"col-sm-5\">
                <textarea readonly class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\"><?php echo $".$row["column_name"]."; ?></textarea>
            </div>
        </div>";
    } else{
$string .= "\n\t <div class=\"form-group\">
            <label class=\"col-sm-2 control-label text-left\">".label($row["COLUMN_COMMENT"])."</label>
            <div class=\"col-sm-5\">
                <input readonly type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
            </div>
        </div>";
    }
}

$string .= "\n\t</div>
    </form>
  </div>
</div>";

$hasil_view_read = createFile($string, $target."views/".$c_url."/".$v_read_file);

?>