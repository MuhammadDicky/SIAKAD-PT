<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo title(); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo get_templete_dir('','assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>" class="logo-pt-element"/>
  <!-- Font -->
  <!-- <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/font/Source Sans Pro/stylesheet.css') ?>">
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/font/Montserrat/stylesheet.css') ?>"> -->
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/font/Raleway/stylesheet.css') ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo get_template_assets('bootstrap/css/bootstrap.min.css') ?>">  
  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo get_plugin('pace','css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo get_plugin('fontawesome','css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo get_plugin('select2','css') ?>">  
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo get_plugin('icheck','css','all')?>">  
  <link rel="stylesheet" href="<?php echo get_plugin('icheck','css','flat_blue') ?>">  
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo get_plugin('datepicker','css')?>">
  <!-- Fresh Table Boostrap -->
  <!-- <link rel="stylesheet" href="assets/css/fresh-bootstrap-table.css"  /> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo get_plugin('datatables','css','bs')?>">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?php echo get_plugin('sweetalert2','css') ?>">  
  <!-- boostrap-toogle -->
  <link rel="stylesheet" href="<?php echo get_plugin('bs-toogle-master','css') ?>">  
  <!-- boostrap-timepicker -->
  <link rel="stylesheet" href="<?php echo get_plugin('timepicker','css')?>">
  <!-- Jquery File Select -->  
  <link rel="stylesheet" href="<?php echo get_plugin('jquery-file-select','css')?>">
  <link rel="stylesheet" href="<?php echo get_plugin('jquery-file-select','css','rtl')?>">
  <!-- AdminLTE style -->
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/AdminLTE.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/skins/_all-skins.min.css') ?>">
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/animated.min.css') ?>">
  <link rel="stylesheet" href="<?php echo get_templete_dir(dirname(__FILE__),'../dist/css/style.css','nC') ?>">
  <style>
    .content-wrapper{
      background: #fff;
    }
    section.content, section.content-header{
      display: none;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-yellow sidebar-mini fixed style-2">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('admin') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <b><?php echo web_detail('_logo_mini'); ?></b>
        <!-- <img src="<?php echo get_templete_dir('','assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>" class="logo-pt-element" alt="PT Icon Profile" style="width: 80%;margin-top: -5px"> -->
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="<?php echo get_templete_dir('','assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>" class="hidden-xs logo-pt-element" alt="PT Icon Profile" style="width: 15%;margin-top: -6px">
        <b>SIAKAD</b> <?php echo web_detail('_logo_lg'); ?>
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo get_template_assets('dist/img/user-image.png') ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" id="user-widget-detail">
                <img src="<?php echo get_template_assets('dist/img/user-image.png') ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['username']; ?><br>
                  Administrator
                  <small class="user-last-time-login"><?php echo $_SESSION['last_online']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>                
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <?php if ($_SESSION['level_akses']=='admin'): ?>
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
                </div>
                <?php endif ?>
                <div class="pull-right">
                  <a href="<?php echo base_url('logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Log Out</a>
                </div>                
              </li>
            </ul>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar">
              <i class="fa fa-gears"></i>
              <span class="label label-info">BETA</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo get_template_assets('dist/img/user-image.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" style="background: rgba(0,0,0,0);">
          <div class="btn-group centered-content btn-sidebar-set" style="margin-left: 10px;margin-top: -10px">
            <button class="btn btn-sm btn-default" url-target="#"><span class="fa fa-user-circle"></span> Profile</button>
            <button class="btn btn-sm btn-default" url-target="<?php echo base_url('logout') ?>"><span class="fa fa-sign-out"></span> Log Out</button>
            <button class="btn btn-sm btn-default" url-target="<?php echo set_url('pengaturan'); ?>" data-toggle="control-sidebar-1"><span class="fa fa-gears"></span></button>
          </div>
        </li>
        <li class="header">MENU UTAMA</li>
        <div id="menu-container" class="sidebar-menu">
          <?php if (isset($_SESSION['menu']) && $_SESSION['menu'] != ''): ?>

          <?php foreach ($_SESSION['menu'] as $key): ?>
            <?php if ($key['level_access_menu'] == 'admin'): ?>
              <?php if (count($key['sub_menu']) > 0): ?>
              <li class="<?php echo active_page_print($key['sort_link'],'active'); ?> treeview">
                <a href="#">
                  <i class="<?php echo $key['icon_menu']; ?>" style="color: <?php echo $key['color_menu']; ?>"></i> <span style="color: <?php echo $key['color_menu']; ?>"><?php echo $key['nm_menu']; ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                  <ul class="treeview-menu">
                    <?php foreach ($key['sub_menu'] as $key_sub): ?>
                    <?php if ($key_sub['status_access_sub_menu'] == 1): ?>
                    <li class="<?php echo active_page_print($key_sub['sort_link'],'active'); ?>">
                      <a href="<?php echo $key_sub['link_sub_menu'] ?>">
                        <i class="fa fa-circle-o"></i> 
                        <?php
                        if (strlen($key_sub['nm_sub_menu']) <= 29) {
                          echo $key_sub['nm_sub_menu'];
                        }
                        else{
                          echo substr($key_sub['nm_sub_menu'],0,28).'...';
                        }
                        ?>
                      </a>
                    </li>  
                    <?php endif ?>

                    <?php if ($key_sub['status_access_sub_menu'] != 1): ?>
                    <?php 
                      if ($key_sub['status_access_sub_menu'] == 0) {
                        $strlen = 20;
                        $end_str = 21;
                        $menu_attr = array('text' => 'Soon', 'color' => 'bg-green');
                      }
                      elseif ($key_sub['status_access_sub_menu'] == 2) {
                        $strlen = 20;
                        $end_str = 21;
                        $menu_attr = array('text' => 'BETA', 'color' => 'bg-blue');
                      }
                      elseif ($key_sub['status_access_sub_menu'] == 3) {
                        $strlen = 19;
                        $end_str = 20;
                        $menu_attr = array('text' => 'Repair', 'color' => 'bg-red');
                      }
                     ?>
                    <li class="<?php echo active_page_print($key_sub['sort_link'],'active'); ?>">
                      <a href="<?php echo $key_sub['link_sub_menu'] ?>"><i class="fa fa-circle-o"></i> 
                        <?php
                        if (strlen($key_sub['nm_sub_menu']) <= $strlen) {
                          echo $key_sub['nm_sub_menu'];
                        }
                        else{
                          echo substr($key_sub['nm_sub_menu'],0,$end_str).'...';
                        }
                        ?>
                      <span class="pull-right-container">
                        <small class="label pull-right <?php echo $menu_attr['color'] ?>"><?php echo $menu_attr['text'] ?></small>
                      </span>
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
                <li class="<?php echo active_page_print($key['sort_link'],'active'); ?> treeview">
                  <a href="<?php echo $key['link_menu']; ?>" style="color: <?php echo $key['color_menu'] ?>">
                    <i class="<?php echo $key['icon_menu'] ?>"></i> <span><?php echo $key['nm_menu'] ?></span>
                  </a>          
                </li>
                <?php endif ?>

                <?php if ($key['status_access_menu'] != 1): ?>
                <?php 
                  if ($key['status_access_menu'] == 0) {
                    $menu_attr = array('text' => 'Soon', 'color' => 'bg-green');
                  }
                  elseif ($key['status_access_menu'] == 2) {
                    $menu_attr = array('text' => 'BETA', 'color' => 'bg-blue');
                  }
                  elseif ($key['status_access_menu'] == 3) {
                    $menu_attr = array('text' => 'Repair', 'color' => 'bg-red');
                  }
                 ?>
                <li class="<?php echo active_page_print($key['sort_link'],'active'); ?> treeview">
                  <a href="<?php echo $key['link_menu']; ?>" style="color: <?php echo $key['color_menu'] ?>">
                    <i class="<?php echo $key['icon_menu']; ?>"></i>
                    <span><?php echo $key['nm_menu']; ?></span>
                    <span class="pull-right-container">
                      <small class="label pull-right <?php echo $menu_attr['color'] ?>"><?php echo $menu_attr['text'] ?></small>
                    </span>
                  </a>          
                </li>
                <?php endif ?>

              <?php endif ?>
            <?php endif ?>
          <?php endforeach ?>
          
          <?php endif ?>
          <?php if (!isset($_SESSION['menu']) || $_SESSION['menu'] == ''): ?>
          <li class="treeview">
            <a>
              <i class="fa fa-exclamation-circle"></i> <span>Gagal memproses menu</span>            
            </a>          
          </li>
          <?php endif ?>
          <!-- <li class="<?php echo active_page_print('admin','active'); ?> treeview">
            <a href="<?php echo base_url('admin'); ?>" class="text-aqua">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
            </a>          
          </li>
          <li class="<?php echo active_page_print('data_master','active'); ?> treeview">
            <a href="#">
              <i class="fa fa-archive text-red"></i> <span class="text-red">Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
              <ul class="treeview-menu">
                <li class="<?php echo active_page_print('data_identitas_pt','active'); ?>"><a href="<?php echo set_url('data_master/data_identitas_pt'); ?>"><i class="fa fa-circle-o"></i> Data Identitas Perguruan Tinggi</a></li>
                <li class="<?php echo active_page_print('data_fakultas_pstudi','active'); ?>"><a href="<?php echo set_url('data_master/data_fakultas_pstudi'); ?>"><i class="fa fa-circle-o"></i> Data Fakultas & Program Studi</a></li>
                <li class="<?php echo active_page_print('data_thn_akademik','active'); ?>"><a href="<?php echo set_url('data_master/data_thn_akademik'); ?>"><i class="fa fa-circle-o"></i> Data Tahun Akademik</a></li>
                <li class="<?php echo active_page_print('data_angkatan','active'); ?>"><a href="<?php echo set_url('data_master/data_angkatan'); ?>"><i class="fa fa-circle-o"></i> Data Tahun Angkatan</a></li>
              </ul>
            </a>
          </li>
          <li class="<?php echo active_page_print('data_pengguna','active'); ?> treeview">
            <a href="#">
              <i class="fa fa-users text-green"></i> <span class="text-green">Data Pengguna</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php echo active_page_print('data_pengguna_mahasiswa','active'); ?>"><a href="<?php echo set_url('data_pengguna/data_pengguna_mahasiswa'); ?>"><i class="fa fa-circle-o"></i> Mahasiswa</a></li>
              <li class="<?php echo active_page_print('data_pengguna_ptk','active'); ?>"><a href="<?php echo set_url('data_pengguna/data_pengguna_ptk'); ?>"><i class="fa fa-circle-o"></i> Tenaga Pendidik</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Data Administrator</a></li>
              <li class="<?php echo active_page_print('data_pengunjung','active'); ?>">
                <a href="<?php echo set_url('data_pengguna/data_pengunjung'); ?>"><i class="fa fa-circle-o"></i> Data Pengunjung
                <span class="pull-right-container">
                  <small class="label pull-right bg-blue">BETA</small>
                </span>
                </a>
              </li>
            </ul>
          </li>
          <li class="<?php echo active_page_print('data_akademik','active'); ?> treeview">
            <a href="#" >
              <i class="fa fa-list-alt text-yellow"></i> <span class="text-yellow">Data Akademik</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php echo active_page_print('data_mahasiswa','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_mahasiswa'); ?>"><i class="fa fa-circle-o"></i> Data Mahasiswa</a>
              </li>
              <li class="<?php echo active_page_print('data_ptk','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_ptk'); ?>"><i class="fa fa-circle-o"></i> Data Tenaga Pendidik</a>
              </li>
              <li class="<?php echo active_page_print('data_kurikulum','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_kurikulum'); ?>"><i class="fa fa-circle-o"></i> Data Kurikulum
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">Soon</small>
                </span>
                </a>
              </li>
              <li class="<?php echo active_page_print('data_mata_kuliah','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_mata_kuliah'); ?>"><i class="fa fa-circle-o"></i> Data Mata Kuliah</a>
              </li>
              <li class="<?php echo active_page_print('data_jadwal_kuliah','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_jadwal_kuliah'); ?>"><i class="fa fa-circle-o"></i> Data Jadwal Kuliah & Kelas</a>
              </li>
              <li class="<?php echo active_page_print('data_nilai_mhs','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_nilai_mhs'); ?>"><i class="fa fa-circle-o"></i> Data Nilai Mahasiswa</a>
              </li>
              <li class="<?php echo active_page_print('data_alumni_do','active'); ?>">
                <a href="<?php echo set_url('data_akademik/data_alumni_do'); ?>"><i class="fa fa-circle-o"></i> Data Alumni & Drop Out</a>
              </li>
            </ul>
          </li>
          <li class="<?php echo active_page_print('data_content','active'); ?> treeview">
            <a href="<?php echo set_url('data_content'); ?>">
              <i class="fa fa-file-text text-teal"></i>
              <span class="text-teal">Data Content</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">Soon</small>
              </span>
            </a>          
          </li>
          <li class="<?php echo active_page_print('pusat_unggahan','active'); ?> treeview">
            <a href="<?php echo set_url('pusat_unggahan'); ?>">
              <i class="fa fa-cloud-upload text-light-blue"></i>
              <span class="text-light-blue">Pusat Unggahan</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">Soon</small>
              </span>
            </a>          
          </li> -->
          <!-- <li class="<?php echo active_page_print('pengolahan_database','active'); ?> treeview">
            <a href="<?php echo set_url('pengolahan_database'); ?>">
              <i class="fa fa-database text-muted"></i>
              <span class="text-muted">Pengolahan Database</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-blue">BETA</small>
              </span>
            </a>          
          </li> -->
        </div>
        <li class="header">LAINNYA</li>
        <li class="<?php echo active_page_print('pengaturan','active'); ?> treeview">
          <a href="<?php echo set_url('pengaturan'); ?>">
            <i class="fa fa-gears"></i>
            <span>Pengaturan</span>
            <span class="pull-right-container">
              <?php if (isset($settings)): ?>
              <i class="fa fa-angle-left pull-right"></i>
              <?php endif ?>
              <small class="label pull-right bg-blue">BETA</small>
            </span>
          </a>
          <?php if (isset($settings)): ?>
          <ul class="treeview-menu">
            <li class="">
              <a href="#set=config-set">
                <i class="fa fa-circle-o"></i>
                <span>Konfigurasi Umum</span>
              </a>
            </li>
            <li class="">
              <a href="">
                <i class="fa fa-circle-o"></i>
                <span>Layout</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="">
                  <a href="#set=choose-layout"><i class="fa fa-circle-o"></i> Pilihan Layout</a>
                </li>
                <li class="">
                  <a href="#set=layout-color"><i class="fa fa-circle-o"></i> Warna Layout</a>
                </li>
              </ul>
            </li>
            <li class="">
              <a href="#set=template-set">
                <i class="fa fa-circle-o"></i>
                <span>Template</span>
              </a>
            </li>
            <li class="">
              <a href="#set=menu-set">
                <i class="fa fa-circle-o"></i>
                <span>Menu</span>
              </a>
            </li>
            <li class="">
              <a href="#set=backup-db">
                <i class="fa fa-circle-o"></i>
                <span>Pengolahan Database</span>
              </a>
            </li>
            <li class="">
              <a href="#set=akun-set">
                <i class="fa fa-circle-o"></i>
                <span>Akun</span>
              </a>
            </li>
          </ul>
          <?php endif ?>
        </li>
        <li class="<?php echo active_page_print('feedback','active'); ?> treeview">
          <a href="<?php echo set_url('feedback'); ?>">
            <i class="fa fa-comments-o"></i>
            <span>Feedback</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Soon</small>
            </span>
          </a>          
        </li>
        <li class="<?php echo active_page_print('about','active'); ?> treeview">
          <a href="<?php echo set_url('about'); ?>" class="about">
            <i class="fa fa-exclamation-circle"></i>
            <span>Tentang</span>
          </a>          
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
        <h1>
          <?php 
          echo content_header(); 
          if (content_header() != 'Tentang') {
            echo "<small>Control panel</small>";
          }
          ?>        
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('admin'); ?>" class="text-aqua"><i class="fa fa-cubes"></i>SIAKAD <?php echo web_detail('_logo_lg'); ?></a></li>
          <?php echo content_path(); ?>
        </ol>
    </section>