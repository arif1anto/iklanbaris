
	<div class="panel rounded shadow">
  <div class="panel-body no-padding rounded-bottom">
    <form action="<?php echo $action; ?>" class="form-horizontal form-bordered" method="post">
      <div class="form-body">
        <input type="hidden" name="btn" value="<?php echo $button; ?>" />
        <input type="hidden" name="bank_id" value="<?php echo $bank_id; ?>" /> 
	<div class="form-group">
            <label class="col-sm-2 control-label text-left">Kode Bank</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" name="bank_id" id="bank_id" value="<?php echo $bank_id; ?>" />
            </div>
        </div>
	<div class="form-group">
            <label class="col-sm-2 control-label text-left">Nama Bank</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" name="bank_nama" id="bank_nama" value="<?php echo $bank_nama; ?>" />
            </div>
        </div>
	<div class="form-group">
            <label class="col-sm-2 control-label text-left">No. Rekening</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" name="bank_norek" id="bank_norek" value="<?php echo $bank_norek; ?>" />
            </div>
        </div>
	<div class="form-group">
            <label class="col-sm-2 control-label text-left">Nama Pemilik</label>
            <div class="col-sm-5">
              <input type="text" class="form-control required" name="bank_an" id="bank_an" value="<?php echo $bank_an; ?>" />
            </div>
        </div>
	</div>
    </form>
  </div>
</div>