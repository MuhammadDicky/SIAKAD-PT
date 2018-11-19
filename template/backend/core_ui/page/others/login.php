<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
  <title><?php echo title(); ?></title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/web-images/'.web_detail('_web_icon')).'?'.@$_SESSION['n_val'] ?>" class="logo-pt-element"/>

  <!-- Font -->
  <!-- <link rel="stylesheet" href="<?php echo get_template_assets('css/font/Source Sans Pro/stylesheet.css') ?>"> -->
  <link rel="stylesheet" href="<?php echo get_template_assets('css/font/Montserrat/stylesheet.css') ?>">
  <!-- <link rel="stylesheet" href="<?php echo get_template_assets('css/font/Raleway/stylesheet.css') ?>"> -->
  <!-- Bootstrap -->
  <!-- <script type="application/javascript" src="<?php echo get_template_assets('bootstrap/dist/css/bootstrap.min.css') ?>"></script> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo get_plugin('fontawesome','css') ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo get_plugin('icheck','css','all')?>">
  <link rel="stylesheet" href="<?php echo get_plugin('icheck','css','flat_blue') ?>">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?php echo get_plugin('sweetalert2','css') ?>">

  <!-- Main styles for this application -->
  <link rel="stylesheet" href="<?php echo get_template_assets('css/style.css') ?>">
  <link rel="stylesheet" href="<?php echo get_custom_assets('css/app-style.css','nC') ?>">
  <style type="text/css">
    @media (max-width: 991.98px){
      .login-box-left{
        border-radius: 5px;
      }
    }
    .login-box{
      box-shadow: 0px 0px 2px #dadada;      
    }
    .login-box-left{
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
    }
    .login-box-right{
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
    }
  </style>

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4 login-box login-box-left">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Silahkan masukkan username dan password yang valid</p>
              <form action="login_auth" role="form" id="form-login">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="checkbox icheck" style="margin-top: 8px">
                      <label>
                        <input type="checkbox" name="remember"> Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-6 text-right">
                    <button type="button" class="btn btn-success px-4" id="login"><span class="fa fa-sign-in"></span> Masuk</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card text-white bg-warning py-5 d-md-down-none login-box login-box-right" style="width:44%">
            <div class="card-body text-center">
              <div>
                <img src="<?php echo base_url('assets/web-images/'.web_detail('_web_icon')).'?'.@$_SESSION['n_val']; ?>" class="logo-pt-element" alt="PT Icon Profile" style="width: 30%;display: block;margin-bottom: 10px;margin-right: auto;margin-left: auto;">
                <h4><?php echo web_detail('_app_name'); ?></h4>
                <h5><?php echo web_detail('_pt_name'); ?></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
  <!-- FastClick -->
  <script type="application/javascript" src="<?php echo get_plugin('fastclick','js')?>"></script>
  <script type="text/javascript">
    $(function(){
      window.addEventListener('load', function(){
        new FastClick(document.body);
      }, false);
    });
  </script>
  <!-- sweetalert2 -->
  <script src="<?php echo get_plugin('sweetalert2','js')?>"></script>
  <!-- iCheck -->
  <script src="<?php echo get_plugin('icheck','js')?>"></script>

  <script src="<?php echo get_custom_assets('js_views/login-config.js',TRUE) ?>"></script>
  <script type="text/javascript">
    var url_login = "<?php echo web_detail('_site_url'); ?>";
    $(function(){
      <?php if (isset($_SESSION['user_change_info'])): ?>
      swal({
        title:'Info',
        text:'<?php echo $_SESSION['user_change_info']; ?>',
        type:'info',
      });
      <?php endif ?>
    });
  </script>

</body>
</html>