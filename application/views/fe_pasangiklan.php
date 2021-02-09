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
                <span class="label label-danger" id="btntopup" style="cursor: pointer;"><i class="fa fa-gift fa-fw" onclick="show_point()"></i>Point Anda <strong><?= get_total_point() ?></strong></span>
                <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
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
          <div class="form-inline pull-xs-left">
            <div class="filter-container">
              <button class="btn btn-primary" type="button" data-target="#mpasang" data-toggle="modal"><i class="fa fa-plus fa-fw"></i> Pasang Iklan</button>
            </div> 
          </div>
          <div class="pull-xs-right form-inline">
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
            </div>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="mpoint">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">My Point</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-5">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Point Anda</h3>
                    <hr>
                  </div>
                  <div class="panel-body">
                    <div class="alert alert-info" style="font-size: 28px">
                      <i class="fa fa-gift fa-fw"></i><strong><?= get_total_point() ?></strong> Point
                    </div>
                    <button type="button" class="btn btn-primary btn-block" onclick="topup()">Top UP Point</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-7" style="max-height: 400px; overflow-y: auto;">
                <h3>Mutasi Point Anda</h3>
                <hr>
                <?php if (count($data_point)<=0): ?>
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Top UP Point</h5>
                      <span class="badge badge-default pull-right"><strong>+20.000</strong></span>
                    </div>
                    <p class="mb-1"><i class="fa fa-clock-o fa-fw"></i>21/22/2021 20:22</p>
                  </a>
                <?php endif ?>
                <?php foreach ($data_point as $row): ?>
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><?= $row->point_ket ?></h5>
                      <span class="badge badge-default pull-right"><strong><?= $row->point_nominal ?></strong></span>
                    </div>
                    <p class="mb-1"><?= $row->point_tgl ?></p>
                  </a>
                <?php endforeach ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mtopup">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Top UP Point</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="situs">Jumlah Point</label>
              <div class="input-group">
                <input type="number" name="jml_point" id="jml_point" class="form-control">
                <span class="input-group-addon">Point</span>
              </div>
            </div>
            <h4>Rincian Pembayaran</h4>
            <table style="width: 100%">
              <tr>
                <td>#1</td>
                <td><strong id="rb_point">0</strong> Point Top Up</td>
                <td class="text-right"><strong id="rb_hasat_p">1000</strong></td>
                <td class="text-right"><strong id="rb_htotal_p">0</strong></td>
              </tr>
              <tr style="border-top:1px solid #000">
                <td class="text-right" colspan="3" style="font-size: 16px"><strong>Total : </strong></td>
                <td class="text-right" id="rb_gtotal_p" style="font-size: 20px"><strong>0</strong> / Hari</td>
              </tr>
            </table>

            <div class="form-group">
              <label for="situs">Metode Pembayaran</label>
              <select class="form-control" name="metode_bayar_point" id="metode_bayar_point">
                <option value="Otomatis">Otomatis</option>
                <option value="Manual">Cek Manual</option>
              </select>
            </div>
            <div class="list-group" id="list_bank_point" style="display: none">
              <?php foreach ($data_bank as $row): ?>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?= $row->bank_nama ?></h5>
                  </div>
                  <p class="mb-1"><?= $row->bank_norek." a.n ".$row->bank_an ?></p>
                </a>
              <?php endforeach ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnbyr_p">Bayar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mselesai_p">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Top UP Point</h5>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Top Up Point Berhasil</h3>
            <div class="msg_otomatis">
              <p>Point ada bertambah <strong id="point_s">1</strong> Point</p>
            </div>
            <div id="msg_manual" style="display: none;">
              <p>Silahkan transfer ke salah satu rekening di bawah ini, dan lakukan pembayaran agar point anda bertambah.</p>
              <div class="list-group">
                <?php foreach ($data_bank as $row): ?>
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><?= $row->bank_nama ?></h5>
                    </div>
                    <p class="mb-1"><?= $row->bank_norek." a.n ".$row->bank_an ?></p>
                  </a>
                <?php endforeach ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mselesai">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title">Pasang Iklan Saya</h5>
          </div>
          <div class="modal-body">
            <h3 class="text-center">Pesanan Pemasangan Iklan Anda Berhasil</h3>
            <div class="msg_otomatis">
              <p>Iklan anda akan tampil sampai <strong id="hari_s">1</strong> Hari kedapan</p>
            </div>
            <div id="msg_manual" style="display: none;">
              <p>Silahkan transfer ke salah satu rekening di bawah ini, dan lakukan pembayaran agar iklan anda aktif.</p>
              <div class="list-group">
                <?php foreach ($data_bank as $row): ?>
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1"><?= $row->bank_nama ?></h5>
                    </div>
                    <p class="mb-1"><?= $row->bank_norek." a.n ".$row->bank_an ?></p>
                  </a>
                <?php endforeach ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
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
            <div>
              <div class="row">
                <div class="col-sm-8 wrapper" style="max-height: 400px; overflow-y: auto;">
                  <div class="form-group">
                    <label for="hari_tayang">Kategori: </label>
                    <div class="input-group">
                      <select class="form-control" id="ads_ktg" name="ads_ktg">
                        <?php foreach ($data_ktg as $row): ?>
                          <option value="<?= $row->ktg_id ?>"><?= $row->ktg_name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="hari_tayang">Wilayah: </label>
                    <div class="input-group">
                      <select class="form-control" id="ads_wil" name="ads_wil">
                        <?php foreach ($data_wil as $row): ?>
                          <option value="<?= $row->wil_id ?>"><?= $row->wil_name ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
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
                      <td class="text-right" colspan="3" style="font-size: 16px"><strong>Sub Total : </strong></td>
                      <td class="text-right" id="rb_total" style="font-size: 20px"><strong>0</strong> / Hari</td>
                    </tr>
                    <tr style="border-top:1px solid #000">
                      <td id="rb_nmtema" colspan="2">X <strong id="hari">1</strong> Hari Penayangan </td>
                      <td class="text-right" style="font-size: 16px"><strong>Total : </strong></td>
                      <td class="text-right" id="rb_gtotal" style="font-size: 20px"><strong>0</strong> / Hari</td>
                    </tr>
                  </table>

                  <div class="form-group">
                    <label for="situs">Metode Pembayaran</label>
                    <select class="form-control" name="metode_bayar" id="metode_bayar">
                      <option value="Otomatis">Otomatis</option>
                      <option value="Manual">Cek Manual</option>
                      <option value="Point">Point</option>
                    </select>
                  </div>
                  <div class="list-group" id="list_bank" style="display: none">
                    <?php foreach ($data_bank as $row): ?>
                      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1"><?= $row->bank_nama ?></h5>
                        </div>
                        <p class="mb-1"><?= $row->bank_norek." a.n ".$row->bank_an ?></p>
                      </a>
                    <?php endforeach ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnprev">Kembali</button>
            <button type="button" class="btn btn-primary" id="btnbyr">Bayar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

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
            <div>
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
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnnext">Next</button>
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

    $('#jml_point').change(function() {
      jml = $(this).val();
      $('#rb_point').text(rp(jml))
      total = rp(jml*1000);
      $('#rb_htotal_p').text(rp(total))
      $('#rb_gtotal_p').text(rp(total))
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
      $('#hari').text($('#hari_tayang').val());
      $('#rb_gtotal').text(rp(total*$('#hari_tayang').val()));
    })

    $('#metode_bayar').change(function() {
      if ($(this).val().trim()=="Manual") {
        $('#list_bank').show();
        $('#btnbyr').text('Simpan')
      } else {
        $('#list_bank').hide();
        $('#btnbyr').text('Bayar')
      }
    })

    $('#hari_tayang').change(function() {
      $('#hari').text($(this).val());
      total = $('#rb_total').text().replace(/[.]/g, "");
      $('#rb_gtotal').text(rp(total*$(this).val()));
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
      $('#rb_gtotal').text(rp(total))

      $('#mbayar').modal('show')
    })

    $('#btnprev').click(function () {
      $('#mbayar').modal('hide')
      $('#mpasang').modal('show')
    })

    function bayar_otomatis_p(event) {
      event.preventDefault();
      var fd = new FormData();    
      fd.append( 'total', $('#rb_gtotal_p').text().replace(/[.]/g, ""));
      fd.append( 'jml', $('#rb_point').text().replace(/[.]/g, ""));

      $.ajax({
        url: '<?=site_url()?>snap/token_point',
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
            simpan_p(result);
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            simpan_p(result);
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            simpan_p(result);
          }
        });
      }
    });
    }

    function bayar_otomatis(event) {
      event.preventDefault();
      var fd = new FormData();    
      fd.append( 'total', $('#rb_gtotal').text().replace(/[.]/g, ""));
      fd.append( 'qty_huruf', $('#rb_huruf').text().replace(/[.]/g, ""));
      fd.append( 'hrg_huruf', $('#rb_hasat').text().replace(/[.]/g, ""));
      fd.append( 'hrg_tema', $('#rb_htema').text().replace(/[.]/g, ""));
      fd.append( 'hari_tayang', $('#hari_tayang').val().replace(/[.]/g, ""));
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

    $('#btnbyr_p').click(function (event) {
      if ($('#metode_bayar_point').val().trim()=='otomatis') {
        bayar_otomatis_p(event)
      } else {
        simpan_p(event)
      }
    })

    $('#btnbyr').click(function (event) {
      if ($('#metode_bayar').val().trim()=='otomatis') {
        bayar_otomatis(event)
      } else {
        simpan(event)
      }
    })

    function simpan_p(event) {
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
      post['total'] = $('#rb_gtotal_p').text();
      $.ajax({
        url: 'pasang_iklan/simpan_point',
        type: 'POST',
        dataType: 'json',
        data: post,
      })
      .done(function(data) {
        console.log('data: ')
        console.log(data)
        console.log('event: ')
        console.log(event)
        if (data.draft=="Y") {
          $('#mselesai_p #msg_manual').show();
          $('#mselesai_p #msg_otomatis').hide();
        } else {
          $('#mselesai_p #msg_manual').hide();
          $('#mselesai_p #msg_otomatis').show();
        }
        $('#mtopup').modal('hide')
        $('#mselesai_p').modal('show')
      })
      .fail(function(e) {
        console.log(e);
      });
      
    }

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
      post['total'] = $('#rb_gtotal').text();
      $.ajax({
        url: 'pasang_iklan/simpan',
        type: 'POST',
        dataType: 'json',
        data: post,
      })
      .done(function(data) {
        console.log('data: ')
        console.log(data)
        console.log('event: ')
        console.log(event)
        if (data.draft=="Y") {
          $('#mselesai #msg_manual').show();
          $('#mselesai #msg_otomatis').hide();
        } else {
          $('#mselesai #msg_manual').hide();
          $('#mselesai #msg_otomatis').show();
        }
        $('#mbayar').modal('hide')
        $('#mselesai').modal('show')
      })
      .fail(function(e) {
        console.log(e);
      });
      
    }

    function show_point() {
      $('#mpoint').modal('show');
    }

    function topup() {
      $('#mtopup').modal('show');
    }
  </script>

</body>
</html>
