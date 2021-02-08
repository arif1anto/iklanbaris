<div class="table-responsive">
    <table class="table table-bordered table-middle table-lilac">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Wilayah</th>
                <th>Nama Wilayah</th>
            </tr>
        </thead>
        <tbody><?php
        foreach ($wilayah_data as $row)
        {
            ?>
            <tr ondblclick="show_detail('<?php echo $row->wil_id ?>')">
               <td width="20px"><?php echo ++$start ?></td>
               <td><?php echo $row->wil_id ?></td>
               <td><?php echo $row->wil_name ?></td>
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
