<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework. Included are multiple example pages, elements styles, and javascript widgets to get your project started.">
  <meta name="keywords" content="admin, admin template, bootstrap3, clean, fontawesome4, good documentation, lightweight admin, responsive dashboard, webapp">
  <meta name="author" content="Djava UI">
  <title>Admin Ilkan Baris</title>
  <link rel="shortcut icon" href="<?= base_url('favicon.png')?>">
  <?php echo $this->load->view('admin/get_css'); ?>
  <link href="<?php echo base_url() ?>assets/global/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet" >
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/jquery-cookie/jquery.cookie.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/typehead.js/dist/handlebars.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/typehead.js/dist/typeahead.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/jquery-nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/jquery.sparkline.min/index.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/ionsound/js/ion.sound.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/bootbox/bootbox.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/retina.js/dist/retina.min.js"></script>
  <!-- START @PAGE LEVEL PLUGINS -->
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/bootstrap-fileupload/js/bootstrap-fileupload.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/chosen_v1.2.0/chosen.jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/swal/sweet-alert.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/bower_components/select2/dist/js/select2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo base_url() ?>assets/global/plugins/jasny/jasny-bootstrap.min.js"></script>
  <!--/ END PAGE LEVEL PLUGINS -->
</head>
<body class="page-header-fixed page-sidebar-fixed page-footer-fixed">
  <section id="wrapper">
    <header id="header">
      <div class="header-left">
        <div class="navbar-minimize-mobile left">
          <i class="fa fa-bars"></i>
        </div>
        <div class="navbar-header" style="background: red;">
          <a class="navbar-brand" href="<?php echo site_url() ?>" style="padding: 5px 10px;">
            <!-- <img class="logo" src="<?php echo base_url() ?>assets/img/logo.png" alt="brand logo"/> -->
          </a>
        </div>
        <div class="navbar-minimize-mobile right">
          <i class="fa fa-cog"></i>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="header-right">
        <div class="navbar navbar-toolbar">
          <ul class="nav navbar-nav navbar-left">
            <li class="navbar-minimize">
              <a href="javascript:void(0);" class="bars-menu" title="Minimize sidebar">
                <i class="fa fa-bars"></i>
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown navbar-message">
              <li class="dropdown navbar-notification">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" onclick="read_notif()"><i class="fa fa-bell-o"></i><span class="rounded count label label-danger" id="ntf_unread">0</span></a>
                <!-- Start dropdown menu -->
                <div class="dropdown-menu animated flipInX">
                  <div class="dropdown-header">
                    <span class="title">Notifikasi <strong id="ntf_count">(0)</strong></span>
                  </div>
                  <div class="dropdown-body niceScroll" tabindex="6" style="overflow: hidden; outline: none;">
                    <div class="media-list small" id="ntf_container">
                            <!-- <a href="#" class="media indicator inline">
                                <span class="spinner">Load more notifications...</span>
                              </a> -->
                            </div>
                          </div>
                          <div class="dropdown-footer">
                            <a href="#">See All</a>
                          </div>
                          <div id="ascrail2006" class="nicescroll-rails" style="width: 10px; z-index: 1000; cursor: default; position: absolute; top: 37px; left: 290px; height: 281px; display: block; opacity: 0;"><div style="position: relative; top: 0px; float: right; width: 10px; height: 169px; background-color: rgb(66, 66, 66); border: 0px; background-clip: padding-box; border-radius: 5px;"></div></div><div id="ascrail2006-hr" class="nicescroll-rails" style="height: 10px; z-index: 1000; top: 308px; left: 0px; position: absolute; cursor: default; display: none; opacity: 0; width: 290px;"><div style="position: absolute; top: 0px; height: 10px; width: 300px; background-color: rgb(66, 66, 66); border: 0px; background-clip: padding-box; border-radius: 5px; left: 0px;"></div></div></div>
                          <!--/ End dropdown menu -->

                        </li>
                        <li class="dropdown navbar-profile">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                              <span class="has-notif avatar"><img class="logo img-circle" src="<?php echo get_foto($this->session->userdata('user_id')); ?>" width="35px" height="35px" alt="user foto"/></span>
                              <span class="text hidden-xs hidden-sm text-muted">Admin</span>
                              <span class="caret"></span>
                            </span>
                          </a>
                          <!-- Start dropdown menu -->
                          <ul class="dropdown-menu animated flipInX">
                            <li class="dropdown-header">Account</li>
                            <li><a href="<?php echo base_url() ?>admin/user/profile"><i class="fa fa-user"></i>View profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url() ?>admin/login/logout_post"><i class="fa fa-sign-out"></i>Logout</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </header>
                <aside id="sidebar-left" class="sidebar-circle">
                  <!-- Start left navigation - profile shortcut -->
                  <div class="sidebar-content">
                    <div class="media">
                      <a class="pull-left has-notif avatar" href="<?php echo base_url() ?>admin/user/profile">
                        <img src="<?php echo get_foto($this->session->userdata('user_id')); ?>" alt="admin">
                        <i class="online"></i>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading">Hello, <span>Admin</span></h4>
                      </div>
                    </div>
                  </div>
                  <!-- Start left navigation - menu -->
                  <ul class="sidebar-menu">
                    <li class="active">
                      <a href="<?php echo site_url() ?>admin">
                        <span class="icon"><i class="fa fa-home"></i></span>
                        <span class="text">Dashboard</span>
                        <span class="selected"></span>
                      </a>
                    </li>
                    <li class="submenu">
                      <a href="javascript:void(0);">
                        <span class="icon"><i class="fa fa-file-o"></i></span>
                        <span class="text"> Master</span>
                        <span class="arrow"></span>
                      </a>
                      <ul>
                        <li class="submenu">
                          <a href="<?php echo site_url() ?>admin/user"> Users</a>
                        </li>
                        <li class="submenu">
                          <a href="<?php echo site_url() ?>admin/kategori"> Kategori</a>
                        </li>
                        <li class="submenu">
                          <a href="<?php echo site_url() ?>admin/subkategori"> Sub Kategori</a>
                        </li>
                      </ul>
                    </li>
                    <li class="submenu">
                      <a href="<?php echo site_url() ?>admin/iklan">
                        <span class="icon"><i class="fa fa-file-o"></i></span>
                        <span class="text"> Iklan</span>
                      </a>
                    </li>
                    <li class="submenu">
                      <a href="<?php echo site_url() ?>admin/chat">
                        <span class="icon"><i class="fa fa-file-o"></i></span>
                        <span class="text"> Chat</span>
                      </a>
                    </li>

                </ul>
                <div class="sidebar-footer hidden-xs hidden-sm hidden-md">
                  <a id="setting" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Setting"><i class="fa fa-cog"></i></a>
                  <a id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
                  <a id="lock-screen" data-url="<?php echo site_url() ?>admin/login/logout_post" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Lock Screen"><i class="fa fa-lock"></i></a>
                  <a id="logout" data-url="<?php echo site_url() ?>admin/login/logout_post" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Logout"><i class="fa fa-power-off"></i></a>
                </div>
              </aside>
              <section id="page-content">
