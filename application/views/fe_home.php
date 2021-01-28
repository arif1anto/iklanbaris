<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('fe_header.php'); ?>
  <title>IB</title>

  <!--Bootstrap core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/custom.css" rel="stylesheet">
  <link href="css/responsive-style.css" rel="stylesheet">  
  <link href="css/weather-icons.min.css" rel="stylesheet">
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
          <div class="col-md-6 col-lg-4 ">
            <img src="<?= getconfig('logo') ?>" class="logo">
            <h1><small><?= getconfig('tagline') ?></small></h1>
          </div>
          <div class="col-md-6 col-lg-5 offset-lg-3 admin-bar hidden-sm-down">
            <nav class="nav nav-inline"> 
              <?php if ($this->session->userdata('user_loged_in')=="TRUE"): ?>
                <button type="button" id="btniklan" class="btn btn-md btn-primary" style="margin-right: 20px">Pasang Iklan</button>
                <a href="#" class="nav-link">Hai, <span id="name_login"><?= $this->session->userdata('firstname') ?></span></a>  
                <a href="<?= site_url() ?>home/logout" class="nav-link"><i class="fa fa-sign-out"></i></a> 
                <?php else : ?> 
                  <button type="button" id="btniklan" class="btn btn-md btn-primary" style="margin-right: 20px">Pasang Iklan</button>
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
              <div class="form-group">
                <select class="form-control filter" name="kategori" id="kategori">
                  <option>Pilih Kategori</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control filter" name="lokasi" id="lokasi">
                  <option>Pilih Lokasi</option>
                </select>
              </div>
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
    <section class="banner-sec" id="tbl_data">
      <div class="container">
        <!-- <div class="col-md-3">
          <div class="iklan-container">
            <div class="iklan-title with-border"><h5>JUDUL</h5></div>
            <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            <div class="iklan-foot">
              <p class="pull-right">#878471</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="iklan-container">
            <div class="iklan-title with-border with-bg-black"><h5>JUDUL</h5></div>
            <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            <div class="iklan-foot">
              <p class="pull-right">#878471</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="iklan-container border-red">
            <div class="iklan-title with-border with-bg-red"><h5>JUDUL</h5></div>
            <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            <div class="iklan-foot">
              <p class="pull-right">#878471</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="iklan-container font-color-blue">
            <div class="iklan-title with-border"><h5>JUDUL</h5></div>
            <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            <div class="iklan-foot">
              <p class="pull-right">#878471</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="iklan-container">
            <div class="iklan-title with-border"><h5>JUDUL</h5></div>
            <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            <div class="iklan-foot">
              <p class="pull-right">#878471</p>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>

  <?= $this->load->view('fe_footer.php') ?>

  <!-- modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="mregister">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Register</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="firstname" class="form-control" id="firstname" name="firstname" placeholder="John">
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="lastname" class="form-control" id="lastname" name="lastname" placeholder="Doe">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label for="hp">No. HP / Telp</label>
              <input type="text" class="form-control" id="hp" name="hp" placeholder="">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnreg"><i id="mreg_loading" class="fa fa-spin fa-spinner" style="display: none"></i>Register</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="mlogin">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Login</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="email_login">Email address</label>
              <input type="email" required class="form-control" id="email_login" name="email_login" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label for="password_login">Password</label>
              <input type="password" required name="password_login" class="form-control" id="password_login">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnlogin">Login</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<!-- Bootstrap core JavaScript
  ================================================== --> 
  <!-- Placed at the end of the document so the pages load faster --> 

  <script src="js/jquery.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/core.js"></script> 
  <script>
    
$(document).ready(function() {
  getData();
})

$('#btnreg').click(function() {
  $('#mreg_loading').show();
    var formdata = new FormData($('#mregister form')[0]);
  $.ajax({
    url: 'home/register',
    type: 'POST',
    dataType: 'json',
    data: formdata,
    processData: false,
    contentType: false,
  })
  .done(function(data) {
    $('#mreg_loading').hide();
    alert(data.msg);
    if (data.status==200) {
      $('#mregister').modal('hide');
    }
  })
  .fail(function(e) {
    $('#mreg_loading').hide();
    console.log("error");
  });
});

$('#btnlogin').click(function() {  
  // if($("#mlogin form").validate()){      
      var formdata = new FormData($('#mlogin form')[0]);
    $.ajax({
      url: 'home/login',
      type: 'POST',
      dataType: 'json',
      data: formdata,
      processData: false,
      contentType: false
    })
    .done(function(data) {
      $('#mreg_loading').hide();
      alert(data.msg);
      if (data.status==200) {
        $('#mregister').modal('hide');
        location.reload();
      }
    })
    .fail(function(e) {
      console.log(e);
    });
  // }
});

$('#btniklan').click(function() {
  let name = $('#name_login').text()
  if (name.trim()!="") {
    window.location = "pasang_iklan"
  } else {
    $('#mregister').modal('show')
  }
});
  </script>
  <?php echo $this->ajax_pagination->create_script() ?>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> -->
  <!-- <script src="js/lightbox-plus-jquery.min.js"></script>  -->

</body>
</html>
