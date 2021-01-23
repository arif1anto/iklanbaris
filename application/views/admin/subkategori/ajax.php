<div class="table-responsive">
    <table class="table table-bordered table-middle table-lilac">
        <thead>
        <tr>
        <th>No</th>
		<th>Kode Sub Kategori</th>
		<th>Sub Kategori</th>
		<th>Kategori</th>
		
        </tr>
        </thead>
    <tbody><?php
foreach ($subkategori_data as $row)
{
    ?>
    <tr ondblclick="show_detail('<?php echo $row->subktg_id ?>')">
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $row->subktg_id ?></td>
			<td><?php echo $row->subktg_name ?></td>
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
