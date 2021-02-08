
	<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="wil_id" value="<?php echo $wil_id; ?>" /> 
	 <div class="form-group">
            <label class="col-sm-2 control-label text-left">Kode Wilayah</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="wil_id" id="wil_id" value="<?php echo $wil_id; ?>" />
            </div>
        </div>
	 <div class="form-group">
            <label class="col-sm-2 control-label text-left">Nama Wilayah</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="wil_name" id="wil_name" value="<?php echo $wil_name; ?>" />
            </div>
        </div>
	</div>
    </form>
  </div>
</div>