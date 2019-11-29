<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error 404 | Page Not Found</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>"/>
    <!-- Bootstrap -->
    <link href="<?php echo get_template_assets('adminlte/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo get_plugin('fontawesome','css') ?>">
    <!-- Custom Theme Style -->
    <link href="<?php echo get_template_assets('adminlte/dist/css/custom.min.css') ?>" rel="stylesheet">
    <style type="text/css">     
      .centered-content{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 130px;
      }
    </style>
  </head>

  <body class="nav-md bg-red">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12 col-xs-12 centered-content">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number"><li class="fa fa-times"></li> Error 404</h1>
              <h2>Maaf tapi halaman yang anda cari tidak ditemukan</h2>
              <p>Halaman ini tidak pernah ada. 
              <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==TRUE): ?>
              Kembali ke <a href="<?php if ($_SESSION['level_akses']=='admin') {
                  echo base_url('admin');
                }
                else{
                  echo base_url();
                }
                 ?>" class="btn btn-info btn-sm">Halaman Utama</a>                
              </p>
              <?php endif ?>
              <?php if (!isset($_SESSION['logged_in'])): ?>
              Silahkan <a href="<?php echo base_url('login'); ?>" class="btn btn-success">Login</a>
              </p>
              <?php endif ?>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

  </body>
</html>
