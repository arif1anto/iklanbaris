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
				<th class="text-center">Aksi</th>
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
				<td><?php echo $row->wil_name ?></td>
				<td><?php echo $row->ktg_name ?></td>
				<td class="text-success"><?= $row->ads_status ?></td>
				<td class="text-center" nowrap>
					<button type="button" class="btn btn-sm btn-success" title="Konfirmasi Pembayaran"><i class="fa fa-money fa-fw"></i></button>
					<button type="button" class="btn btn-sm btn-success" title="Perpanjang Penayangan"><i class="fa fa-eye fa-fw"></i></button>
					<button type="button" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></button>
					<button type="button" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash-o fa-fw"></i></button>
				</td>
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
