
	<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="subktg_id" value="<?php echo $subktg_id; ?>" /> 
	 <div class="form-group">
            <label class="col-sm-2 control-label text-left">Kode Sub Kategori</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="subktg_id" id="subktg_id" value="<?php echo $subktg_id; ?>" />
            </div>
        </div>
	 <div class="form-group">
            <label class="col-sm-2 control-label text-left">Sub Kategori</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" name="subktg_name" id="subktg_name" value="<?php echo $subktg_name; ?>" />
            </div>
        </div>
	 <div class="form-group">
            <label class="col-sm-2 control-label text-left">Kategori</label>
            <div class="col-sm-5">
                <input readonly type="hidden" class="form-control" name="ktg_id" id="ktg_id" value="<?php echo $ktg_id; ?>" />
                <input readonly type="text" class="form-control" name="ktg_name" id="ktg_name" value="<?php echo $ktg_name; ?>" />
            </div>
        </div>
	</div>
    </form>
  </div>
</div>