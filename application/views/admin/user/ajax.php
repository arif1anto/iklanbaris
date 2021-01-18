<div class="table-responsive">
	<table class="table table-bordered table-middle table-lilac">
		<thead>
			<tr>
				<th>No</th>
				<th>Email</th>
				<th>Nama Depan</th>
				<th>Nama Belakang</th>
				<th>Password</th>
				<th>No. HP</th>
				<th>Last Login</th>
				<th>Status</th>
				<th>Email Verified</th>
				
			</tr>
		</thead>
		<tbody><?php
		foreach ($user_data as $row)
		{
			?>
			<tr ondblclick="show_detail('<?php echo $row->user_email ?>')">
				<td width="20px"><?php echo ++$start ?></td>
				<td><?php echo $row->user_email ?></td>
				<td><?php echo $row->user_firstname ?></td>
				<td><?php echo $row->user_lastname ?></td>
				<td><?php echo $row->user_pass ?></td>
				<td><?php echo $row->user_hp ?></td>
				<td><?php echo $row->user_last_login ?></td>
				<td><?php echo $row->user_status ?></td>
				<td><?php echo $row->user_email_verified ?></td>
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
