<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
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
    <div class="small-top">
      <div class="container">
        <div class="col-lg-4 date-sec hidden-sm-down">
          <div id="Date"></div>
        </div>
        <div class="col-lg-3 offset-lg-5">
          <div class="social-icon"> <a target="_blank" href="#" class=" fa fa-facebook"></a> <a target="_blank" href="#" class=" fa fa-twitter"></a> <a target="_blank" href="#" class=" fa fa-google-plus"></a> <a target="_blank" href="#" class=" fa fa-linkedin"></a> <a target="_blank" href="#" class=" fa fa-youtube"></a> <a target="_blank" href="#" class=" fa fa-vimeo-square"></a> </div>
        </div>
      </div>
    </div>
    <div class="top-head left">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 text-center">
            <h1>Mata Iklan<small>Get the latest Ads</small></h1>
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
              <button class="btn btn-primary" type="button"><i class="fa fa-plus fa-fw"></i> Pasang Iklan</button>
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
      <div class="container" id="tbl_data">
        <div class="table-responsive" >
          <table class="table table-striped table-primary">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Iklan</th>
                <th>Judul</th>
                <th>Isi Iklan</th>
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
  </section>

<?= $this->load->view('fe_footer.php') ?>


<!-- Bootstrap core JavaScript
  ================================================== --> 
  <!-- Placed at the end of the document so the pages load faster --> 

  <script src="js/jquery.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/core.js"></script> 

</body>
</html>
