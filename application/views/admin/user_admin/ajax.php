<div class="table-responsive">
    <table class="table table-bordered table-middle table-lilac">
        <thead>
            <tr>
                <th>No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Full Name</th>
                
            </tr>
        </thead>
        <tbody><?php
        foreach ($user_admin_data as $row)
        {
            ?>
            <tr ondblclick="show_detail('<?php echo $row->admin_username ?>')">
             <td width="20px"><?php echo ++$start ?></td>
             <td><?php echo $row->admin_username ?></td>
             <td><?php echo $row->admin_email ?></td>
             <td><?php echo $row->admin_name ?></td>
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
