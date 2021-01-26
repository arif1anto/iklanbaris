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
            <h1>Iklan Baris<small>Get the latest Ads</small></h1>
          </div>
          <div class="col-md-6 col-lg-5 offset-lg-3 admin-bar hidden-sm-down">
            <nav class="nav nav-inline"> 
              <?php if ($this->session->userdata('user_loged_in')=="TRUE"): ?>
              <a href="#" class="nav-link"><span class="ping"></span><i class="fa fa-envelope-o"></i></a>
              <a href="#" class="nav-link">Hai, <?= $this->session->userdata('firstname') ?></a>  
              <a href="<?= site_url() ?>home/logout" class="nav-link"><i class="fa fa-sign-out"></i></a> 
              <?php else : ?> 
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
        <ul class="nav navbar-nav ">
          <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">Category</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">Location</a> </li>
        </ul>
        <form class="pull-xs-right">
          <div class="search">
            <input type="text" class="form-control filter" id="keyword" name="keyword" maxlength="64" placeholder="Search" />
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <section class="banner-sec" id="tbl_data">
    <div class="container">
      <div class="row">
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

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <h6 class="heading-footer">ABOUT US</h6>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
          <p><i class="fa fa-phone"></i> <span>Call Us :</span> +91 9999 878 398</p>
          <p><i class="fa fa-envelope"></i> <span>Send Email :</span> info@webenlance.com</p>
        </div>
        <div class="col-lg-2 col-md-4">
          <h6 class="heading-footer">QUICK LINKS</h6>
          <ul class="footer-ul">
            <li><a href="#"> Career</a></li>
            <li><a href="#"> Privacy Policy</a></li>
            <li><a href="#"> Terms & Conditions</a></li>
            <li><a href="#"> Client Gateway</a></li>
            <li><a href="#"> Ranking</a></li>
            <li><a href="#"> Case Studies</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 social-icons">
          <h6 class="heading-footer">FOLLOW</h6>
          <ul class="footer-ul">
            <li><a href="#"><i class=" fa fa-facebook"></i> Facebook</a></li>
            <li><a href="#"><i class=" fa fa-twitter"></i> Twitter</a></li>
            <li><a href="#"><i class=" fa fa-google-plus"></i> Google+</a></li>
            <li><a href="#"><i class=" fa fa-linkedin"></i> Linkedin</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
        </div>
      </div>
    </div>
  </footer>
  <!--footer start from here-->

  <div class="copyright">
    <div class="container">
      <div class="col-lg-6 col-md-4">
        <p>Project arif1anto</a>
        </p>
      </div>
      <div class="col-lg-6 col-md-8">
        
      </div>
    </div>
  </div>

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

  <?php echo $this->ajax_pagination->create_script() ?>
  <script src="js/jquery.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/core.js"></script> 
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> -->
  <!-- <script src="js/lightbox-plus-jquery.min.js"></script>  -->

</body>
</html>
