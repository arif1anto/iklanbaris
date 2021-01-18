<div class="header-content">
  <h2><i class="fa fa-home"></i>Users <span></span></h2>
  <div class="action-container">
    <button type="button" id="btn_baru" class="btn btn-primary btn-block" title="Data Baru" onclick="baru()"><i class="fa fa-file fa-2x"></i></button>
    <button type="button" id="btn_edit" class="btn btn-success btn-block" title="Ubah Data" onclick="edit()"><i class="fa fa-pencil fa-2x"></i></button>
    <button type="button" id="btn_hapus" class="btn btn-danger btn-block" title="Hapus Data" onclick="hapus()"><i class="fa fa-trash-o fa-2x"></i></button>
    <button type="button" id="btn_cetak" class="btn btn-default btn-block" title="Cetak" onclick="cetak()" ><i class="fa fa-print fa-2x"></i></button>
    <button type="button" id="btn_simpan" class="btn btn-primary btn-block" title="Simpan" onclick="simpan()" disabled><i class="fa fa-check fa-2x"></i></button>
    <button type="button" id="btn_batal" class="btn btn-danger btn-block" title="Batal" onclick="batal()" disabled><i class="fa fa-times fa-2x"></i></button>
  </div>
</div>

<div class="body-content animated fadeIn">
  <div class="panel panel-tab panel-tab-double shadow">
    <div class="panel-heading no-padding" style="background-color: #eeeeef;">
      <ul class="nav nav-tabs">
        <li class="nav-border nav-border-top-danger"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail Users</a></li>
        <li class="active nav-border nav-border-top-danger"><a href="#daftar" aria-controls="daftar" role="tab" data-toggle="tab">Daftar Users</a></li>
      </ul>
    </div>
    <div class="panel-body no-padding">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="detail" style="min-height: 350px;">

        </div>
        <div role="tabpanel" class="tab-pane active" id="daftar" style="min-height: 350px;">
          <div class="panel rounded shadow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-sm-6">
                  <div class="checkbox-inline ckbox ckbox-theme">
                    <input id="ckdesc" name="ckdesc" type="checkbox" checked>
                    <label for="ckdesc">Descending</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="col-sm-6"> 
                    <select class="form-control input-sm" name="kolom" id="kolom">
                      <option value='user_email'>Email</option>
                      <option value='user_firstname'>Nama Depan</option>
                      <option value='user_lastname'>Nama Belakang</option>
                      <option value='user_pass'>Password</option>
                      <option value='user_hp'>No. HP</option>
                      <option value='user_last_login'>Last Login</option>
                      <option value='user_status'>Status</option>
                      <option value='user_email_verified'>Email Verified</option></select>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group input-group-sm">
                        <?php 
                        $q = "";
                        if ($this->input->get('q')) {
                          $q = $this->input->get('q');
                          $q = str_replace_first("_","/",$q);
                        }
                        ?>
                        <input type="text" placeholder="Search" class="form-control" name="q" value="<?php echo $q ?>" id="keyword"> 
                        <div class="input-group-btn">
                          <button class="btn btn-danger" type="button" onclick="getData(0)"><i class="fa fa-refresh"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php echo $this->ajax_pagination->create_script() ?>
              <div class="panel-body rounded-bottom no-padding" id="tbl_data">
                <div class="table-responsive" >
                  <table class="table table-striped table-primary">
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
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

  <div class="modal fade bs-example-modal-sm" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="konfirmHapus">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o"></i> Konfirmasi Hapus</h4>
        </div>
        <div class="modal-body">
          <p>Yakin hapus Data Users dengan nomor <strong><span id="hps_id"></span></strong>?</p>
          <p class="text-right">
            <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
            <button type="submit" name="hapus" id="btnhapus" value="" class="btn btn-danger" onclick="hapus_ya($(this).val())"><i class="fa fa-trash-o"></i> Hapus</button>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var site = "<?php echo site_url();?>";

    $(document).ready(function() {
      <?php if ($act=="create" && $id_sct!=null) : ?>
        baru('<?php echo $id_sct ?>');
        <?php else : ?>
          show_detail("",false);
        <?php endif ?>

        <?php if ($q!=""): ?>
          getData(0);
        <?php endif ?>
      });function valid(paren) {
      input = $(paren).find("input.required, input[required], textarea.required, textarea[required]");
      $('.form-group').removeClass("has-error");
      is_valid = true;
      for (var i = 0; i < input.length; i++) {
        label = $(input[i]).closest('.form-group').find('label').text();
        if ($(input[i]).val()=='') {
          showMsg("Peringatan","Kolom "+label+" wajib diisi");
          $(input[i]).closest(".form-group").addClass("has-error");
          $(input[i]).focus();
          if(!$(input[i]).is(":visible")){
            $(".isi-container a[href='#tab1']").tab('show');
          }
          is_valid = false;
          break;
        }
        if ($(input[i]).attr('type')=="number" && $(input[i]).val()!='') {
          if (parseFloat($(input[i]).val())<=0) {
            showMsg("Peringatan","Kolom "+label+" tidak boleh 0");
            $(input[i]).closest(".form-group").addClass("has-error");
            $(input[i]).focus();
            is_valid = false;
            break;
          }
        }
      } 
      return is_valid;
    }

    function ganti_tab(tab) {
      $('.nav-tabs a[href="#'+tab+'"]').tab('show');
    }

    function show_detail(user_email = "", tab = true) {
      if (tab) {
        ganti_tab("detail");
      }
      $('#btn_baru').removeAttr("disabled");
      $('#btn_edit').removeAttr("disabled");
      $('#btn_hapus').removeAttr("disabled");
      $('#btn_bk').removeAttr("disabled");
      $('#btn_cetak').removeAttr("disabled");
      $('#btn_simpan').attr("disabled",true);
      $('#btn_batal').attr("disabled",true);
      $.ajax({
        url: site+"user/read",
        type: "post",
        data: {'user_email':user_email}
      })
      .done(function (data){
        $("#detail").html(data);
      })
      .fail(function (jqXHR, textStatus, errorThrown){
        console.error("The following error occurred: "+textStatus, errorThrown);
        console.log(jqXHR.responseText);
      });
    }

    function baru(id = "") {
      ganti_tab('detail');
      $('#btn_baru').attr("disabled",true);
      $('#btn_edit').attr("disabled",true);
      $('#btn_hapus').attr("disabled",true);
      $('#btn_bk').attr("disabled",true);
      $('#btn_cetak').attr("disabled",true);
      $('#btn_simpan').removeAttr("disabled");
      $('#btn_batal').removeAttr("disabled");
      if (id!="") {id = "/"+id}
        $.ajax({
          url: site+"user/create"+id,
          type: "post"
        })
      .done(function (data){
        $("#detail").html(data);
      })
      .fail(function (jqXHR, textStatus, errorThrown){
        console.error("The following error occurred: "+textStatus, errorThrown);
        console.log(jqXHR.responseText);
      });
    }

    function edit() {
      user_email = $("#detail input#user_email").val();
      if (user_email.trim()=="") {
        showMsg("Peringatan","Silahkan pilih data dahulu");
      } else {
        ganti_tab('detail');
        $('#btn_baru').attr("disabled",true);
        $('#btn_edit').attr("disabled",true);
        $('#btn_hapus').attr("disabled",true);
        $('#btn_bk').attr("disabled",true);
        $('#btn_cetak').attr("disabled",true);
        $('#btn_simpan').removeAttr("disabled");
        $('#btn_batal').removeAttr("disabled");
        $.ajax({
          url: site+"user/update",
          type: "post",
          data: {'user_email':user_email}
        })
        .done(function (data){
          if (data.trim()!="notfound") {
            $("#detail").html(data);
          } else {
            showMsg("Peringatan","Data tidak ditemukan");
          }
        })
        .fail(function (jqXHR, textStatus, errorThrown){
          console.error("The following error occurred: "+textStatus, errorThrown);
          console.log(jqXHR.responseText);
        });
      }
    }

    function hapus(){
      user_email = $("#detail input#user_email").val();
      if (user_email.trim()==""){
        showMsg("Peringatan","Silahkan pilih data dahulu");
      } else {
        $('#modalHapus #hps_id').text(user_email);
        $('#modalHapus #btnhapus').val(user_email);
        $('#modalHapus').modal('show');
      }
    }

    function hapus_ya(user_email) {
      $.ajax({
        url: site+"user/delete",
        type: "post",
        data: {'user_email':user_email}
      })
      .done(function (data){
        $('#modalHapus').modal('hide');
        if (data.trim()=="OK") {
          showMsg('Informasi','Data User <strong>'+user_email+'</strong> berhasil dihapus');
          show_detail();
        } else if(data.trim()=="notfound"){
          showMsg("Peringatan","Data tidak ditemukan");
          show_detail();
        }
      })
      .fail(function (jqXHR, textStatus, errorThrown){
        console.error("The following error occurred: "+textStatus, errorThrown);
        console.log(jqXHR.responseText);
      });
    }

    function batal() {
      show_detail();
    }

    function simpan() {
      if(valid('#detail')){
        form = $('#detail form');
        inp = $(form).find('input,textarea,select');
        var post = {};
        for (var i = 0; i < inp.length; i++) {
          post[$(inp[i]).attr('name')] = $(inp[i]).val();
        }
        $.ajax({
          url: site+"user/create_action",
          type: "post",
          data : post
        })
        .done(function (data){
          console.log(data);
          if (data.trim()=="simpan") {
            showMsg('Informasi','Data Users <strong>'+post.user_email+'</strong> berhasil disimpan');
            show_detail(post.user_email);
          } else if(data.trim()=='edit') {
            showMsg('Informasi','Data Users <strong>'+post.user_email+'</strong> berhasil diubah');
            show_detail(post.user_email);
          } else {
            showMsg("Peringatan",data);
          }
          history.pushState(null, null, '<?php echo base_url() ?>user');
        })
        .fail(function (jqXHR, textStatus, errorThrown){
          console.error("The following error occurred: "+textStatus, errorThrown);
          console.log(jqXHR.responseText);
        });
      }
    }
  </script>