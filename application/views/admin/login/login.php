<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework. Included are multiple example pages, elements styles, and javascript widgets to get your project started.">
  <meta name="keywords" content="admin, admin template, bootstrap3, clean, fontawesome4, good documentation, lightweight admin, responsive dashboard, webapp">
  <meta name="author" content="Djava UI">
  <title>HRIS BJHome Jogja | SIGN IN</title>
  <?php echo $this->load->view('get_css'); ?>
</head>

<body class="page-sound page-backstretch body-bg">
  <div class="bg-cover">
  <div id="sign-wrapper">
    <?php echo form_open("login/login_aksi"); ?>
    <div class="sign-header">
      <div class="form-group">
        <div class="sign-text">
          <span>Login HRIS BJHome Jogja</span>
        </div>
      </div><!-- /.form-group -->
    </div><!-- /.sign-header -->
    <div class="sign-body">
      <?php if($this->session->userdata("pesan")!=""): ?>
      <div class="alert alert-danger">
        <span class="alert-icon"><i class="fa fa-warning"></i></span>
        <div class="notification-info">
          <ul class="clearfix notification-meta">
            <li class="pull-left notification-sender">Login Gagal!</li>
            <li class="pull-right notification-time"><button type="button" class="btn btn-sm pull-right" data-toggle="tooltip" data-placement="top" data-title="Remove" style="position: absolute;right: 0;top: 0;" onclick="$(this).closest('.alert').remove();"><i class="fa fa-times"></i></button></li>
          </ul>
          <p><?php echo $this->session->userdata("pesan"); ?></p>
        </div>
      </div>
      <?php endif; $this->session->unset_userdata("pesan") ?>
      <div class="form-group">
        <div class="input-group input-group-lg rounded no-overflow">
          <input type="text" class="form-control input-sm" placeholder="Username" name="username" required>
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>
      </div><!-- /.form-group -->
      <div class="form-group">
        <div class="input-group input-group-lg rounded no-overflow">
          <input type="password" class="form-control input-sm" placeholder="Password" name="password" required>
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        </div>
      </div><!-- /.form-group -->
    </div><!-- /.sign-body -->
    <div class="sign-footer">
      <div class="form-group">
        <button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded" id="login-btn">Masuk</button>
      </div>
    </div>
    <?php echo form_close() ; ?>
    <p class="text-muted text-center sign-link">HRIS BJHome Jogja &copy; 2018</p>
  </div>
  </div>

  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/jquery/dist/jquery.min.js"></script>
  </body>
</html>