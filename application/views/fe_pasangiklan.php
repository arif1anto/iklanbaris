<!DOCTYPE html>
<html lang="en">
<head>

  <?php $this->load->view('fe_header.php'); ?>
  <title>IB</title>

  <!--Bootstrap core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/custom.css" rel="stylesheet">
  <link href="css/responsive-style.css" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link href="css/lightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/loaders.css"/>
  <style></style>
</head>

<body>
  <div class="loader loader-bg">
    <div class="loader-inner ball-pulse-rise">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <header>
    <?= $this->load->view('fe_topbar.php'); ?>
    <div class="top-head left">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 text-center">
            <img src="<?= getconfig('logo') ?>" class="logo">
            <h1><small><?= getconfig('tagline') ?></small></h1>
          </div>
          <div class="col-md-6 col-lg-5 offset-lg-3 admin-bar hidden-sm-down">
            <nav class="nav nav-inline"> 
              <?php if ($this->session->userdata('user_loged_in')=="TRUE"): ?>
                <a href="#" class="nav-link">Hai, <span id="name_login"><?= $this->session->userdata('firstname') ?></span></a>  
                <a href="<?= site_url() ?>home/logout" class="nav-link"><i class="fa fa-sign-out"></i></a> 
                <?php else : ?> 
                  <span id="name_login"></span>
                  <a href="#" class="nav-link" data-toggle="modal" data-target="#mregister">Register</a> 
                  <a href="#" class="nav-link" data-toggle="modal" data-target="#mlogin">Login</a> 
                <?php endif ?>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <nav class="navbar top-nav">
      <div class="container">
        <button class="navbar-toggler hidden-lg-up " type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation"> &#9776; </button>
        <div class="collapse navbar-toggleable-md" id="exCollapsingNavbar2"> <a class="navbar-brand" href="#">Responsive navbar</a>
          <form class="form-inline pull-xs-left">
            <div class="filter-container">
              <button class="btn btn-primary" type="button" data-target="#mpasang" data-toggle="modal"><i class="fa fa-plus fa-fw"></i> Pasang Iklan</button>
            </div> 
          </form>
          <form class="pull-xs-right form-inline">
            <div class="filter-container">
              <input type="hidden" class="filter" name="kolom" id="kolom" value="a.ads_id">
              <div class="form-group">
                <label>Tampilkan :</label>
                <select class="form-control filter" name="limit" id="limit">
                  <option value="20">20</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="0">Show All</option>
                </select>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control filter" id="keyword" name="keyword" maxlength="64" placeholder="Search" />
                  <span class="input-group-btn" style="float: left">
                    <button type="button" onclick="getData()" class="btn btn-danger"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </nav>
      <section class="banner-sec">
        <div class="container">
          <h3>Daftar Iklan Saya</h3>
          <hr>
          <div id="tbl_data">
            <div class="table-responsive" >
              <table class="table table-striped table-primary">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Iklan</th>
                    <th>Judul</th>
                    <th>Email User</th>
                    <th>No. WA</th>
                    <th>Situs</th>
                    <th>Status</th>
                    <th>Draft</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?= $this->load->view('fe_footer.php') ?>


    <div class="modal fade" tabindex="-1" role="dialog" id="mpasang">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Pasang Iklan Saya</h5>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="judul">Judul Iklan</label>
                <input type="text" class="form-control" id="judul" name="judul" maxlength="25" placeholder="Judul Iklan">
              </div>
              <div class="form-group">
                <label for="isi_iklan">Isi Iklan</label>
                <textarea class="form-control" id="isi_iklan" name="isi_iklan" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
              </div>
              <div class="form-group">
                <label for="wa">No. HP / Wa</label>
                <input type="text" class="form-control" id="wa" name="wa" placeholder="">
              </div>
              <div class="form-group">
                <label for="situs">Situs</label>
                <input type="text" class="form-control" id="situs" name="situs" placeholder="">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnnext">Next</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mbayar">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Pasang Iklan Saya</h5>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-sm-8 wrapper" style="max-height: 400px; overflow-y: auto;">
                  <div class="form-group">
                    <label for="hari_tayang">Jumlah Hari Penayangan Iklan: </label>
                    <div class="input-group">
                      <input type="number" min="1" value="1" class="form-control" id="hari_tayang" name="hari_tayang" placeholder="">
                      <span class="input-group-addon">Hari</span>
                    </div>
                    <p class="help-block">Iklan akan ditayangkan setelah pembayaran terkonfirmasi</p>
                  </div>
                  <h4>Pilih Tema</h4>
                  <div class="row">
                    <?php foreach ($tema_data as $row): ?>
                      <div class="col-md-6">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" name="pilih_tema" type="radio" value="<?= $row->style_id ?>" data-name="<?= $row->style_name ?>" data-price="<?= $row->style_price ?>" <?= $row->style_id=='1'?"checked":"" ?>>
                            <?= $row->style_name ?> + <strong>Rp <?= rp($row->style_price) ?></strong>
                          </label>
                        </div>
                        <div class="iklan-container <?= $row->container_class ?>">
                          <div class="iklan-title <?= $row->title_class ?>"><h5>JUDUL</h5></div>
                          <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
                          <div class="iklan-foot">
                            <p class="pull-right">#IDIKLAN</p>
                          </div>
                        </div>
                      </div>
                    <?php endforeach ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <h4>Rincian Pembayaran</h4>
                  <table style="width: 100%">
                    <tr>
                      <td>#1</td>
                      <td><strong id="rb_huruf">0</strong> huruf</td>
                      <td class="text-right"><strong id="rb_hasat">150</strong></td>
                      <td class="text-right"><strong id="rb_htotal">0</strong></td>
                    </tr>
                    <tr>
                      <td>#2</td>
                      <td id="rb_nmtema">Tema Default</td>
                      <td class="text-right" id="rb_htema"><strong>0</strong></td>
                      <td class="text-right" id="rb_httotal"><strong>0</strong></td>
                    </tr>
                    <tr style="border-top:1px solid #000">
                      <td class="text-right" colspan="3" style="font-size: 18px"><strong>Total : </strong></td>
                      <td class="text-right" id="rb_total" style="font-size: 24px"><strong>0</strong></td>
                    </tr>
                  </table>

                  <div class="form-group">
                    <label for="situs">Metode Pembayaran</label>
                    <select class="form-control" name="metode_bayar" id="metode_bayar">
                      <option value="otomatis">Otomatis</option>
                      <option value="manual">Cek Manual</option>
                    </select>
                  </div>
                    <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">List group item heading</h5>
                          <small>3 days ago</small>
                        </div>
                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <small>Donec id elit non mi porta.</small>
                      </a>
                    </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnprev">Kembali</button>
            <button type="button" class="btn btn-primary" id="btnbyr">Bayar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

<!-- Bootstrap core JavaScript
  ================================================== --> 
  <!-- Placed at the end of the document so the pages load faster --> 

  <script src="js/jquery.min.js"></script> 
  <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
  <script type="text/javascript"
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="SB-Mid-client-hjMPsu8ypRJM3uy1"></script>
  <script src="js/core.js"></script>
  <?php echo $this->ajax_pagination->create_script() ?>
  <script type="text/javascript">
    $(document).ready(function() {
      getData();
    })

    $('input[name=pilih_tema]').click(function() {
      jmlhrf = $('#isi_iklan').val().length
      hsat = <?= getconfig('hsat') ?>;
      nama_tema = $('input[name=pilih_tema]:checked').data('name');
      hrg_tema = $('input[name=pilih_tema]:checked').data('price');
      $('#rb_nmtema').text(nama_tema)
      $('#rb_htema').text(rp(hrg_tema))
      $('#rb_httotal').text(rp(hrg_tema))

      total = (hsat*jmlhrf)+hrg_tema;
      $('#rb_total').text(rp(total))
    })

    $('#btnnext').click(function() {
      $('#mpasang').modal('hide')
      $('.iklan-body').text($('#isi_iklan').val())
      $('.iklan-title>h5').text($('#judul').val())
      jmlhrf = $('#isi_iklan').val().length
      $('#rb_huruf').text(jmlhrf)
      hsat = <?= getconfig('hsat') ?>;
      $('#rb_hasat').text(hsat)
      $('#rb_htotal').text(rp(hsat*jmlhrf))
      nama_tema = $('input[name=pilih_tema]:checked').data('name');
      hrg_tema = $('input[name=pilih_tema]:checked').data('price');
      $('#rb_nmtema').text(nama_tema)
      $('#rb_htema').text(rp(hrg_tema))
      $('#rb_httotal').text(rp(hrg_tema))

      total = (hsat*jmlhrf)+hrg_tema;
      $('#rb_total').text(rp(total))

      $('#mbayar').modal('show')
    })

    $('#btnprev').click(function () {
      $('#mbayar').modal('hide')
      $('#mpasang').modal('show')
    })

    function bayar_otomatis(event) {
      event.preventDefault();
      var fd = new FormData();    
      fd.append( 'total', $('#rb_total').text().replace(/[.]/g, ""));
      fd.append( 'qty_huruf', $('#rb_huruf').text().replace(/[.]/g, ""));
      fd.append( 'hrg_huruf', $('#rb_hasat').text().replace(/[.]/g, ""));
      fd.append( 'hrg_tema', $('#rb_htema').text().replace(/[.]/g, ""));
      fd.append( 'nama_tema', $('#rb_nmtema').text());
      fd.append( 'email', $('#email').val());
      fd.append( 'wa', $('#wa').val());

      $.ajax({
        url: '<?=site_url()?>snap/token',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
        }

        snap.pay(data, {
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            simpan(result);
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            simpan(result);
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            simpan(result);
          }
        });
      }
    });
    }

    $('#btnbyr').click(function (event) {
      if ($('#metode_bayar').val().trim()=='otomatis') {
        bayar_otomatis(event)
      } else {
        simpan(event)
      }
    })

    function simpan(event) {
      inp = $('.modal').find('input,textarea,select');
      var post = {};
      for (var i = 0; i < inp.length; i++) {
        if ($(inp[i]).attr("type")=="checkbox") {
          post[$(inp[i]).attr('name')] = ($(inp[i]).is(":checked") ? $(inp[i]).val() : "");
        } else {
          post[$(inp[i]).attr('name')] = $(inp[i]).val();
        }
      }
      post['result'] = event;
      $.ajax({
        url: 'pasang_iklan/simpan',
        type: 'POST',
        dataType: 'json',
        data: post,
      })
      .done(function(data) {
        alert(data);
        console.log('data: ')
        console.log(data)
        console.log('event: ')
        console.log(event)
        $('#mbayar').modal('hide')
      })
      .fail(function(e) {
        console.log(e);
      });
      
    }
  </script>

</body>
</html>
