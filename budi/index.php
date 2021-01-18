<?php
require_once 'core/harviacode.php';
require_once 'core/helper.php';
require_once 'core/process.php';
?>
<!doctype html>
<html>
<head>
    <title>budi CRUD Generator</title>
    <link rel="stylesheet" href="core/bootstrap.min.css"/>
    <style>
    body{
        padding: 15px;
    }
</style>
</head>
<body>
    <div class="row">
        <div class="col-md-3">
            <form action="index.php" method="POST">

                <div class="form-group">
                    <label>Select Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                    <select id="table_name" name="table_name" class="form-control" onchange="setname()" onclick="ambilkolom(<?php ?>)">
                        <option value="">Please Select</option>
                        <?php
                        $table_list = $hc->table_list();
                        $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                        foreach ($table_list as $table) {
                            ?>
                            <option value="<?php echo $table['table_name'] ?>" <?php echo $table_list_selected == $table['table_name'] ? 'selected="selected"' : ''; ?>><?php echo $table['table_name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    <div class="row">
                        <?php $jenis_tabel = isset($_POST['jenis_tabel']) ? $_POST['jenis_tabel'] : 'reguler_table'; ?>
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="jenis_tabel" value="reguler_table" <?php echo $jenis_tabel == 'reguler_table' ? 'checked' : ''; ?>>
                                    Reguler Table
                                </label>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="jenis_tabel" value="datatables" <?php echo $jenis_tabel == 'datatables' ? 'checked' : ''; ?>>
                                    Datatables
                                </label>
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="form-group">
                    <label> Controller</label>
                    <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                </div>
                <div class="form-group">
                    <label>Judul Halaman</label>
                    <input type="text" id="judul" name="judul" value="<?php echo isset($_POST['judul']) ? $_POST['judul'] : '' ?>" class="form-control" placeholder="judul" />
                </div>
                <div class="form-group">
                    <label> Model</label>
                    <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                </div>

                <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />

                <input type="submit" value="Generate laporan" name="laporan" class="btn btn-danger" onclick="javascript: return confirm('Laporan akan di buat,, siap??')" />
            </form>
            <br>

            <?php
            foreach ($hasil as $h) {
                echo '<p>' . $h . '</p>';
            }
            ?>
        </div>

        <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name != '') {
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                    document.getElementById('judul').value = capitalize(table_name);
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                    document.getElementById('judul').value = '';
                }
            }
            function ambilkolom() {
              document.getElementById('kol').value = 'sdf';
          }
      </script>
  </body>
  </html>
