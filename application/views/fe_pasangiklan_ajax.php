<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Iklan</th>
				<th>Judul</th>
				<th>Email User</th>
				<th>No. WA</th>
				<th>Situs</th>
				<th>Wilayah</th>
				<th>Kategori</th>
				<th>Status</th>
				<th>Draft</th>
			</tr>
		</thead>
		<tbody><?php $start=0;
		foreach ($iklan_data as $row)
		{
			?>
			<tr data-konten="<?php echo $row->ads_konten ?>">
				<td width="20px"><?php echo ++$start ?></td>
				<td><?php echo $row->ads_id ?></td>
				<td><?php echo $row->ads_title ?></td>
				<td><?php echo $row->ads_user_email ?></td>
				<td><?php echo $row->ads_wa ?></td>
				<td><?php echo $row->ads_situs ?></td>
				<td class="text-success"><?php echo "Aktif" ?></td>
				<td><?php echo style_yn($row->ads_draft) ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
</div>

<div class="col-md-12">
	<?php echo $pagination ?>
</div>
