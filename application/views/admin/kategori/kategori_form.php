
	<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="ktg_id" value="<?php echo $ktg_id; ?>" /> 
	<div class="form-group">
            <label class="col-sm-2 control-label text-left">Kode Kategori</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" name="ktg_id" id="ktg_id" value="<?php echo $ktg_id; ?>" />
            </div>
        </div>
	<div class="form-group">
            <label class="col-sm-2 control-label text-left">Nama Kategori</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" name="ktg_name" id="ktg_name" value="<?php echo $ktg_name; ?>" />
            </div>
        </div>
	</div>
    </form>
  </div>
</div>