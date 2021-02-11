
<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="admin_username" value="<?php echo $admin_username; ?>" /> 
        <div class="form-group">
            <label class="col-sm-2 control-label text-left">Username</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="admin_username" id="admin_username" value="<?php echo $admin_username; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label text-left">Password</label>
            <div class="col-sm-5">
                <input readonly type="password" class="form-control" name="admin_pass" id="admin_pass" value="<?php echo $admin_pass; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label text-left">Email</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="admin_email" id="admin_email" value="<?php echo $admin_email; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label text-left">Full Name</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="admin_name" id="admin_name" value="<?php echo $admin_name; ?>" />
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="col-sm-2 control-label text-left"></label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="admin_foto" id="admin_foto" value="<?php echo $admin_foto; ?>" />
            </div>
        </div> -->
    </div>
</form>
</div>
</div>