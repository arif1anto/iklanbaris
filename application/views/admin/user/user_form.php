<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="user_email" value="<?php echo $user_email; ?>" /> 
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Email</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_email" id="user_email" value="<?php echo $user_email; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Nama Depan</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_firstname" id="user_firstname" value="<?php echo $user_firstname; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Nama Belakang</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_lastname" id="user_lastname" value="<?php echo $user_lastname; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Password</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_pass" id="user_pass" value="<?php echo $user_pass; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">No. HP</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_hp" id="user_hp" value="<?php echo $user_hp; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Last Login</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_last_login" id="user_last_login" value="<?php echo $user_last_login; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Status</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_status" id="user_status" value="<?php echo $user_status; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Email Verified</label>
          <div class="col-sm-5">
            <input type="text" class="form-control required" name="user_email_verified" id="user_email_verified" value="<?php echo $user_email_verified; ?>" />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>