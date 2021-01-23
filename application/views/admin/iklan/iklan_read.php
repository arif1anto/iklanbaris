<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="ads_id" value="<?php echo $ads_id; ?>" /> 
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Kode Iklan</label>
          <div class="col-sm-5">
            <input type="text" readonly class="form-control required" name="ads_id" id="ads_id" value="<?php echo $ads_id; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Judul Iklan</label>
          <div class="col-sm-5">
            <input type="text" readonly class="form-control required" name="ads_title" value="<?php echo $ads_title; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Isi Iklan</label>
          <div class="col-sm-5">
            <textarea readonly class="form-control required" name="ads_konten" id="ads_konten" rows="3"><?php echo $ads_konten; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Email User</label>
          <div class="col-sm-5">
            <input type="text" readonly class="form-control required" name="ads_user_email" id="ads_user_email" value="<?php echo $ads_user_email; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">No. WA</label>
          <div class="col-sm-5">
            <input type="text" readonly class="form-control required" name="ads_wa" id="ads_wa" value="<?php echo $ads_wa; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Situs</label>
          <div class="col-sm-5">
            <input type="text" readonly class="form-control required" name="ads_situs" id="ads_situs" value="<?php echo $ads_situs; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label text-left">Status</label>
          <div class="col-sm-5">
            <input type="text" readonly class="form-control required" name="ads_status" id="ads_status" value="<?php echo $ads_status; ?>" />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>