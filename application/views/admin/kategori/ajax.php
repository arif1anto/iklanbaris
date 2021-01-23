<div class="table-responsive">
    <table class="table table-bordered table-middle table-lilac">
        <thead>
        <tr>
        <th>No</th>
		<th>Kode Kategori</th>
		<th>Nama Kategori</th>
		
        </tr>
        </thead>
    <tbody><?php
foreach ($kategori_data as $row)
{
    ?>
    <tr ondblclick="show_detail('<?php echo $row->ktg_id ?>')">
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $row->ktg_id ?></td>
			<td><?php echo $row->ktg_name ?></td>
		</tr>
    <?php
}
?>
    </tbody>
</table>
</div>

  <div class="col-md-8">
    <?php echo $pagination ?>
  </div>
