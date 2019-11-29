<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.10
 * @link http://coreui.io
 * Copyright (c) 2018 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
  <link rel="shortcut icon" href="<?php echo base_url('assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>" class="logo-pt-element"/>
  <title><?php echo title(); ?></title>

  <!-- Font -->
  <!-- <link rel="stylesheet" href="<?php echo get_template_assets('css/font/Source Sans Pro/stylesheet.css') ?>"> -->
  <link rel="stylesheet" href="<?php echo get_template_assets('css/font/Montserrat/stylesheet.css') ?>">
  <!-- <link rel="stylesheet" href="<?php echo get_template_assets('css/font/Raleway/stylesheet.css') ?>"> -->
  <!-- Bootstrap -->
  <!-- <script type="application/javascript" src="<?php echo get_template_assets('bootstrap/dist/css/bootstrap.min.css') ?>"></script> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo get_plugin('fontawesome','css') ?>">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo get_plugin('pace','css')?>">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?php echo get_plugin('sweetalert2','css') ?>">
  <!-- Animated CSS -->
  <link rel="stylesheet" href="<?php echo get_plugin_url('animated-css/animated.min.css') ?>">

  <!-- Main styles for this application -->
  <link rel="stylesheet" href="<?php echo get_template_assets('css/style.css') ?>" id="main-style">
  <link rel="stylesheet" href="<?php echo get_custom_assets('css/app-style.css','nC') ?>">
  <style type="text/css">
    @media (min-width: 992px){
      .brand-minimized .app-header.navbar .navbar-brand {
        background-image: url(<?php echo base_url('assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>);
      }
    }
    .pace .pace-activity {
      border-top-color: #20a8d8;
      border-left-color: #20a8d8;
    }
  </style>
</head>
<body class="app header-fixed sidebar-fixed footer-fixed aside-menu-fixed aside-menu-hidden style-2">
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url('admin') ?>">
      <img src="<?php echo base_url('assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>" class="hidden-xs logo-pt-element" alt="PT Icon Profile" style="width: 20%;margin-top: -6px">
      <font><b>SIAKAD</b> <?php echo web_detail('_logo_lg'); ?></font>
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
      <!-- <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#"><i class="fa fa-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
      </li>
      <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#"><i class="fa fa-list"></i></a>
      </li>
      <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#"><i class="fa fa-map-marker"></i></a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="<?php echo get_template_assets('img/user-image.png') ?>" class="img-avatar" alt="User Images">
          <strong><?php echo $_SESSION['username']; ?></strong>
        </a>
        <div class="dropdown-menu dropdown-menu-right" id="user-widget-detail">
          <div class="dropdown-header text-center">
            <strong>Akun</strong>
          </div>
          <p class="text-center" style="padding-top: 20px">
            <img src="<?php echo get_template_assets('img/user-image.png') ?>" class="img-avatar" alt="User Images" style="width: 45%"><br>
            <?php echo $_SESSION['username']; ?><br>
            Administrator<br>
            <small class="user-last-time-login" data-time="<?php echo $_SESSION['last_online']; ?>"></small>
          </p>
          <div class="dropdown-header text-center">
            <strong>Lainnya</strong>
          </div>
          <a class="dropdown-item" href="#"><i class="fa fa-user-circle"></i> Profile</a>
          <a class="dropdown-item" href="<?php echo set_url('pengaturan') ?>"><i class="fa fa-gears"></i> Pengaturan</a>
          <a class="dropdown-item" href="<?php echo base_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

  </header>

  <div class="app-body">
    <div class="sidebar">
      <nav class="sidebar-nav">
        <ul class="nav">
          <li class="nav-title">
            MENU UTAMA
          </li>
          <?php if (isset($_SESSION['menu']) && $_SESSION['menu'] != ''): ?>

          <?php foreach ($_SESSION['menu'] as $key): ?>
            <?php if ($key['level_access_menu'] == 'admin'): ?>
              <?php if (count($key['sub_menu']) > 0): ?>
              <li class="nav-item nav-dropdown <?php echo active_page_print($key['sort_link'],'open'); ?>">
                <a class="nav-link nav-dropdown-toggle text-truncate" href="#" style="">
                  <i class="<?php echo $key['icon_menu']; ?>" style=""></i> <?php echo $key['nm_menu']; ?>
                </a>
                <ul class="nav-dropdown-items">
                  <?php foreach ($key['sub_menu'] as $key_sub): ?>

                  <?php if ($key_sub['status_access_sub_menu'] == 1): ?>
                  <li class="nav-item <?php echo active_page_print($key['sort_link'],'open'); ?>">
                    <a class="nav-link text-truncate <?php echo active_page_print($key['sort_link'],'active'); ?>" href="<?php echo $key_sub['link_sub_menu'] ?>">
                      <i class="fa fa-circle-o"></i> <?php echo $key_sub['nm_sub_menu']; ?>
                    </a>
                  </li>
                  <?php endif ?>

                  <?php if ($key_sub['status_access_sub_menu'] != 1): ?>
                  <?php
                    if ($key_sub['status_access_sub_menu'] == 0) {
                      $strlen = 20;
                      $end_str = 21;
                      $menu_attr = array('text' => 'Soon', 'color' => 'badge-success');
                    }
                    elseif ($key_sub['status_access_sub_menu'] == 2) {
                      $strlen = 20;
                      $end_str = 21;
                      $menu_attr = array('text' => 'BETA', 'color' => 'badge-primary');
                    }
                    elseif ($key_sub['status_access_sub_menu'] == 3) {
                      $strlen = 19;
                      $end_str = 20;
                      $menu_attr = array('text' => 'Repair', 'color' => 'badge-danger');
                    }
                  ?>
                  <li class="nav-item <?php echo active_page_print($key['sort_link'],'open'); ?>">
                    <a class="nav-link text-truncate <?php echo active_page_print($key['sort_link'],'active'); ?>" href="<?php echo $key_sub['link_sub_menu'] ?>">
                      <i class="fa fa-circle-o"></i> <?php echo $key_sub['nm_sub_menu']; ?> <span class="badge <?php echo $menu_attr['color']; ?>"><?php echo $menu_attr['text']; ?></span>
                    </a>
                  </li>
                  <?php endif ?>

                  <?php endforeach ?>
                </ul>
              </li>
              <?php endif ?>

              <?php if (count($key['sub_menu']) == 0): ?>
                <?php
                if ($key['sort_link'] == '') {
                  $key['sort_link'] = 'admin';
                }
                 ?>
                <?php if ($key['status_access_menu'] == 1): ?>
                <li class="nav-item">
                  <a class="nav-link text-truncate <?php echo active_page_print($key['sort_link'],'active'); ?>" href="<?php echo $key['link_menu']; ?>" style="">
                    <i class="<?php echo $key['icon_menu'] ?>" style=""></i> <?php echo $key['nm_menu'] ?>
                  </a>
                </li>
                <?php endif ?>

                <?php if ($key['status_access_menu'] != 1): ?>
                <?php
                  if ($key['status_access_menu'] == 0) {
                    $menu_attr = array('text' => 'Soon', 'color' => 'badge-success');
                  }
                  elseif ($key['status_access_menu'] == 2) {
                    $menu_attr = array('text' => 'BETA', 'color' => 'badge-primary');
                  }
                  elseif ($key['status_access_menu'] == 3) {
                    $menu_attr = array('text' => 'Repair', 'color' => 'badge-danger');
                  }
                 ?>
                <li class="nav-item">
                  <a class="nav-link text-truncate <?php echo active_page_print($key['sort_link'],'active'); ?>" href="<?php echo $key['link_menu']; ?>" style="">
                    <i class="<?php echo $key['icon_menu'] ?>" style=""></i> <?php echo $key['nm_menu'] ?> <span class="badge <?php echo $menu_attr['color']; ?>"><?php echo $menu_attr['text']; ?></span>
                  </a>
                </li>
                <?php endif ?>

              <?php endif ?>
            <?php endif ?>
          <?php endforeach ?>

          <?php endif ?>
          <?php if (!isset($_SESSION['menu']) || $_SESSION['menu'] == ''): ?>
          <li class="nav-item">
            <a href="" class="nav-link text-truncate">
              <i class="fa fa-exclamation-circle"></i> Gagal memproses menu <i class="fa fa-refresh" id="refresh-menu"></i>
            </a>
          </li>
          <?php endif ?>
          <li class="divider"></li>
          <li class="nav-title">
            LAINNYA
          </li>
          <li class="nav-item <?php echo active_page_print('pengaturan','nav-dropdown open'); ?>">
            <a class="nav-link text-truncate <?php echo active_page_print('pengaturan','nav-dropdown-toggle active'); ?>" href="<?php if (!isset($settings)) { echo set_url('pengaturan'); }else{ echo "#";}?>">
              <i class="fa fa-gears"></i> Pengaturan
            </a>
            <?php if (isset($settings)): ?>
            <ul class="nav-dropdown-items">
              <li class="nav-item">
                <a class="nav-link" href="#set=config-set">
                  <i class="fa fa-circle-o"></i> Konfigurasi Umum
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#set=choose-layout">
                  <i class="fa fa-circle-o"></i> Pilihan Layout
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#set=layout-color">
                  <i class="fa fa-circle-o"></i> Warna Layout
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#set=template-set">
                  <i class="fa fa-circle-o"></i> Template
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#set=menu-set">
                  <i class="fa fa-circle-o"></i> Menu
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#set=backup-db">
                  <i class="fa fa-circle-o"></i> Pengolahan Database
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#set=akun-set">
                  <i class="fa fa-circle-o"></i> Akun
                </a>
              </li>
            </ul>
            <?php endif ?>
          </li>
          <li class="nav-item <?php echo active_page_print('feedback','open'); ?>">
            <a href="<?php echo set_url('feedback'); ?>" class="nav-link text-truncate <?php echo active_page_print('feedback','active'); ?>">
              <i class="fa fa-comments-o"></i> Feedback <span class="badge badge-success">Soon</span>
            </a>
          </li>
          <li class="nav-item <?php echo active_page_print('about','open'); ?>">
            <a href="<?php echo set_url('about'); ?>" class="nav-link text-truncate <?php echo active_page_print('about','active'); ?>">
              <i class="fa fa-exclamation-circle"></i> Tentang
            </a>
          </li>
        </ul>
      </nav>
      <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item first-breadcrumb-item">
          <a href="<?php echo base_url('admin'); ?>" class="ajax-load-page">
            <i class="fa fa-cubes"></i> SIAKAD <?php echo web_detail('_logo_lg'); ?>
          </a>
        </li>
        <?php foreach (content_path() as $key): ?>
        <li class="breadcrumb-item">
          <a href="<?php echo $key['link'] ?>" class="ajax-load-page">
            <?php echo $key['icon'] ?> <?php echo $key['title']; ?>
          </a>
        </li>
        <?php endforeach; ?>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn ajax-load-page" href="<?php echo set_url('pengaturan'); ?>"><i class="fa fa-gears"></i> Pengaturan</a>
            <a class="btn ajax-load-page" href="<?php echo set_url('about'); ?>"><i class="fa fa-exclamation-circle"></i> Tentang</a>
          </div>
        </li>
      </ol>

      <div class="container-fluid">
        <div id="ui-view"></div>
      </div>
      <!-- /.conainer-fluid -->
    </main>

    <aside class="aside-menu">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="fa fa-list"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="fa fa-envelope"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="fa fa-gear"></i></a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="timeline" role="tabpanel">
          <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
            <small><b>Today</b></small>
          </div>
          <hr class="transparent mx-3 my-0">
          <div class="callout callout-warning m-0 py-3">
            <div class="avatar float-right">
              <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
            </div>
            <div>Meeting with
              <strong>Lucas</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
            <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
          </div>
          <hr class="mx-3 my-0">
          <div class="callout callout-info m-0 py-3">
            <div class="avatar float-right">
              <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
            </div>
            <div>Skype with
              <strong>Megan</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
            <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line </small>
          </div>
          <hr class="transparent mx-3 my-0">
          <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
            <small><b>Tomorrow</b></small>
          </div>
          <hr class="transparent mx-3 my-0">
          <div class="callout callout-danger m-0 py-3">
            <div>New UI Project -
              <strong>deadline</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
            <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
            <div class="avatars-stack mt-2">
              <div class="avatar avatar-xs">
                <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
            </div>
          </div>
          <hr class="mx-3 my-0">
          <div class="callout callout-success m-0 py-3">
            <div>
              <strong>#10 Startups.Garden</strong> Meetup</div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
            <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
          </div>
          <hr class="mx-3 my-0">
          <div class="callout callout-primary m-0 py-3">
            <div>
              <strong>Team meeting</strong>
            </div>
            <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
            <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
            <div class="avatars-stack mt-2">
              <div class="avatar avatar-xs">
                <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
              <div class="avatar avatar-xs">
                <img src="img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
              </div>
            </div>
          </div>
          <hr class="mx-3 my-0">
        </div>
        <div class="tab-pane p-3" id="messages" role="tabpanel">
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
          <hr>
          <div class="message">
            <div class="py-3 pb-5 mr-3 float-left">
              <div class="avatar">
                <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                <span class="avatar-status badge-success"></span>
              </div>
            </div>
            <div>
              <small class="text-muted">Lukasz Holeczek</small>
              <small class="text-muted float-right mt-1">1:52 PM</small>
            </div>
            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
          </div>
        </div>
        <div class="tab-pane p-3" id="settings" role="tabpanel">
          <h6>Settings</h6>

          <div class="aside-options">
            <div class="clearfix mt-4">
              <small><b>Option 1</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
            <div>
              <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
            </div>
          </div>

          <div class="aside-options">
            <div class="clearfix mt-3">
              <small><b>Option 2</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
            <div>
              <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
            </div>
          </div>

          <div class="aside-options">
            <div class="clearfix mt-3">
              <small><b>Option 3</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
          </div>

          <div class="aside-options">
            <div class="clearfix mt-3">
              <small><b>Option 4</b></small>
              <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
              </label>
            </div>
          </div>

          <hr>
          <h6>System Utilization</h6>

          <div class="text-uppercase mb-1 mt-4">
            <small><b>CPU Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">348 Processes. 1/4 Cores.</small>

          <div class="text-uppercase mb-1 mt-2">
            <small><b>Memory Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">11444GB/16384MB</small>

          <div class="text-uppercase mb-1 mt-2">
            <small><b>SSD 1 Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">243GB/256GB</small>

          <div class="text-uppercase mb-1 mt-2">
            <small><b>SSD 2 Usage</b></small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">25GB/256GB</small>
        </div>
      </div>
    </aside>

  </div>

  <footer class="app-footer">
    <span class="pull-left mr-auto">
      Powered by <a href="http://coreui.io">CoreUI</a> Designed By &copy; 2018 creativeLabs.
    </span>
    <span class="pull-right ml-auto">
      <strong class="pull-right">Developed By <a href="<?php echo set_url('about'); ?>"><?php echo web_detail('_dev_name'); ?></a></strong>
    </span>
  </footer>

  <!-- Bootstrap and necessary plugins -->
  <script type="application/javascript" src="<?php echo get_plugin('jquery','js') ?>"></script>
  <script type="text/javascript">
    jQuery.browser = {};
    $(function(){
      jQuery.browser.msie = false;
      jQuery.browser.version = 0;
      if (navigator.userAgent.match(/MSIE ([0-9] +)\ . /)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
      }
    });
  </script>
  <script type="application/javascript" src="<?php echo get_template_assets('js/popper.js/dist/umd/popper.min.js') ?>"></script>
  <script type="application/javascript" src="<?php echo get_template_assets('bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <script type="application/javascript" src="<?php echo get_plugin('pace','js')?>"></script>

  <!-- Plugins and scripts required by all views -->
  <!-- Bluebird -->
  <script type="application/javascript" src="<?php echo get_plugin('bluebird','js') ?>"></script>
  <!-- FastClick -->
  <script type="application/javascript" src="<?php echo get_plugin('fastclick','js')?>"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      window.addEventListener('load', function(){
        new FastClick(document.body);
      }, false);
    });
  </script>
  <!-- Jquery Loading Overlay -->
  <script type="application/javascript" src="<?php echo get_plugin('jquery-loading-overlay','js') ?>"></script>
  <script type="application/javascript" src="<?php echo get_plugin('jquery-loading-overlay','js','progress') ?>"></script>
  <script type="text/javascript">
      var image_overlay_path = "<?php echo get_plugin('jquery-loading-overlay','image','Ellipsis.gif'); ?>";
      $(document).ready(function(){
        $('main.main').LoadingOverlay("show",{
          color: "rgba(255, 255, 255, 2)",
          zIndex: 1000,
          image:image_overlay_path,
          custom:$("<div>",{
            id:"loading-overlay-text",
            css:{
              "font-weight":"bold",
              "margin-top": "40px"
            },
            text:"Memuat Halaman",
          }),
        });
        var loading_text = $('#loading-overlay-text').text();
        var i = 0;
        loading_interval = setInterval(function(){
          $('#loading-overlay-text').append('. ');
          i++;
          if (i == 4) {
            $('#loading-overlay-text').html(loading_text);
            i = 0;
          }
        },400);
      });
  </script>
  <!-- momentjs -->
  <script type="application/javascript" src="<?php echo get_plugin('momentjs','js')?>"></script>
  <!-- Slimscroll -->
  <script type="application/javascript" src="<?php echo get_plugin('slimscroll','js')?>"></script>
  <!-- HashChange -->
  <script type="application/javascript" src="<?php echo get_plugin('jquery-hashchange','js') ?>"></script>
  <!-- sweetalert2 -->
  <script type="application/javascript" src="<?php echo get_plugin('sweetalert2','js')?>"></script>

  <!-- CoreUI main scripts -->
  <script type="text/javascript">
    <?php $token = $this->security->get_csrf_hash(); ?>
    var data_dashboard_path = '<?php echo web_detail('_data_dashboard_path') ?>',
    data_master_path        = '<?php echo web_detail('_data_master_path') ?>',
    data_pengguna_path      = '<?php echo web_detail('_data_pengguna_path') ?>',
    data_akademik_path      = '<?php echo web_detail('_data_akademik_path') ?>',
    admin_url               = '<?php echo set_url() ?>',
    base_url                = '<?php echo base_url() ?>',
    page_not_found          = '<?php echo base_url('page_error') ?>',
    page_error              = '<?php echo base_url('page_error/error_500') ?>',
    token                   = '<?php if($token) {echo $token;} else {echo rand_val();} ?>';
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
  <script type="application/javascript" src="<?php echo get_template_assets('js/app.js', 'nC') ?>"></script>
  <script type="application/javascript" src="<?php echo get_custom_assets('js_views/main_config.js','nC') ?>"></script>
  <!-- Live Reload : Only for development -->
  <script type="text/javascript" src="http://localhost:35729/livereload.js"></script>

</body>
</html>
