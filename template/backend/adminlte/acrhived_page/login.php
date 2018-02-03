<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo title(); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo get_template_assets('bootstrap/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo get_plugin('fontawesome','css') ?>">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?php echo get_plugin('sweetalert2','css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo get_plugin('icheck','css','square_blue')?>">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->  
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/AdminLTE.css') ?>">
  <link rel="stylesheet" href="<?php echo get_templete_dir(dirname(__FILE__),'dist/css/style.css',TRUE) ?>">  
  <style type="text/css">
    body{
      height: 0;
    }
    .login-box{            
      background: #f9f9f9;
      padding: 10px;
      border: 1px solid #d5d5d5;
      border-radius: 5px;
      box-shadow: 0px 0px 2px #dadada;      
    }
    .login-box-body{
      background: #f9f9f9;
    }
    .login-logo{
      margin-bottom: -15px;
    }
    .login-page{      
      background: url("<?php echo get_template_assets('dist/img/body-bg.png') ?>");
    }
    .input-group{
      margin-bottom: 10px;
    }    
    .centered-content{ 
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 8% auto;
    }
    .lockscreen .lockscreen-name {
      margin-bottom: 25px;
    }
    .lockscreen .lockscreen-wrapper {
      margin-top: -10px;
    }
    .lockscreen-image, .lockscreen-credentials, .lockscreen-item, .lockscreen-credentials input, .input-group-btn .btn{
      
    }
  </style>
</head>
<body class="hold-transition login-page lockscreen style-2">
  <section class="content centered-content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="login-box">
          <div class="login-logo">
            <b style="font-size: 20pt">Sistem Informasi Akademik</b>
            <b style="font-size: 20pt"><?php echo web_detail('_pt_name'); ?></b>
            <hr>
          </div>  
          <!-- /.login-logo -->
          <div class="login-box-body">
          <?php if ($login == 'login_again'): ?>
            <p class="login-box-msg">Silahkan masukkan username dan password yang valid</p>

            <form action="login_auth" role="form" id="form-login">
            <div class="row">
              <div class="col-md-6 col-xs-6 input-user">
                <div class="form-group username">
                  <div class="input-group username">
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-6 input-pass">
                <div class="form-group password-input">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                  </div>
                </div>
              </div>
            </div>
              <div class="row">
                <div class="col-md-8 col-xs-7">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-xs-5">
                  <button class="btn btn-success btn-block btn-flat" id="login"><span class="fa fa-sign-in"></span> Masuk</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          <?php endif ?>
          <?php if ($login == 'lockscreen'): ?>
            <div action="login_auth" id="form-login">
              <div class="lockscreen-wrapper">
                <div class="lockscreen-name"><?php echo $last_log->nama ?></div>
                <div class="lockscreen-item">
                  <div class="lockscreen-image">
                    <?php if ($last_log->photo !=''): ?>
                    <img src="<?php echo $photo ?>" alt="User Image">
                    <?php endif ?>
                    <?php if ($last_log->photo ==''): ?>
                    <img src="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User Image">
                    <?php endif ?>
                  </div>

                  <form class="lockscreen-credentials">
                    <div class="input-group">
                      <input type="password" class="form-control" placeholder="Password" name="password" id="password">

                      <div class="input-group-btn">
                        <button type="submit" class="btn" id="login"><i class="fa fa-arrow-right text-muted log-in"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="help-block text-center">
                  Masukkan password anda <a href="<?php echo base_url('logout'); ?>">atau login dengan akun lain</a>
                </div>
              </div>
            </div>
          <?php endif ?>
          </div>
          <!-- /.login-box-body -->
        </div>
      </div>
    </div>    
  </section>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo get_plugin('jquery','js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script type="application/javascript" src="<?php echo get_template_assets('bootstrap/js/bootstrap.min.js') ?>"></script>
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
<script type="application/javascript" src="<?php echo get_template_assets('dist/js/app.min.js') ?>"></script>
<script src="<?php echo get_templete_dir(dirname(__FILE__),'dist/js/js_conf.min.js',TRUE) ?>"></script>
<?php if (isset($_SESSION['user_change_info'])): ?>
  <script type="text/javascript">
    $(function(){
      swal({
        title:'Info',
        text:'<?php echo $_SESSION['user_change_info']; ?>',
        type:'info',
      });
    });
  </script>
<?php endif ?>
</body>
</html>