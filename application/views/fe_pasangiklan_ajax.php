<div class="table-responsive">
	<table class="table table-bordered table-middle table-lilac">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Iklan</th>
				<th>Judul</th>
				<th>Isi Iklan</th>
				<th>Email User</th>
				<th>No. WA</th>
				<th>Situs</th>
				<th>Status</th>
				<th>Draft</th>
			</tr>
		</thead>
		<tbody><?php
		foreach ($iklan_data as $row)
		{
			?>
			<tr>
				<td width="20px"><?php echo ++$start ?></td>
				<td><?php echo $row->ads_id ?></td>
				<td><?php echo $row->ads_title ?></td>
				<td><?php echo $row->ads_konten ?></td>
				<td><?php echo $row->ads_user_email ?></td>
				<td><?php echo $row->ads_wa ?></td>
				<td><?php echo $row->ads_situs ?></td>
				<td><?php echo $row->ads_status ?></td>
				<td><?php echo $row->ads_draft ?></td>
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
