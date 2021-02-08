<div class="table-responsive">
    <table class="table table-bordered table-middle table-lilac">
        <thead>
        <tr>
        <th>No</th>
		<th>Kode Bank</th>
		<th>Nama Bank</th>
		<th>No. Rekening</th>
		<th>Nama Pemilik</th>
		
        </tr>
        </thead>
    <tbody><?php
foreach ($bank_data as $row)
{
    ?>
    <tr ondblclick="show_detail('<?php echo $row->bank_id ?>')">
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $row->bank_id ?></td>
			<td><?php echo $row->bank_nama ?></td>
			<td><?php echo $row->bank_norek ?></td>
			<td><?php echo $row->bank_an ?></td>
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
