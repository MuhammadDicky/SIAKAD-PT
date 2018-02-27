<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo web_detail('_web_name'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo get_templete_dir('','assets/web-images/'.web_detail('_web_icon').'?'.rand_val()) ?>"/>
  <!-- Font -->
  <!-- <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/font/Source Sans Pro/stylesheet.css') ?>">
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/font/Montserrat/stylesheet.css') ?>"> -->
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/font/Raleway/stylesheet.css') ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo get_template_assets('bootstrap/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo get_plugin('fontawesome','css') ?>">
  <!-- AdminLTE style -->
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/AdminLTE.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/skins/_all-skins.min.css') ?>">
  <link rel="stylesheet" href="<?php echo get_template_assets('dist/css/animated.min.css') ?>">
  <link rel="stylesheet" href="<?php echo get_templete_dir(dirname(__FILE__),'dist/css/style.css',TRUE) ?>">  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-yellow layout-top-nav fixed style-2">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand"><b>SIAKAD</b> <?php echo web_detail('_logo_lg'); ?></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">

          </ul>
          <form class="navbar-form navbar-left" role="search">            

          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url('login'); ?>"><span class="fa fa-sign-in"></span> Login</a></li>
            <li><a href="#" class="show-about"><span class="fa fa-exclamation-circle"></span> Tentang</a></li>            
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <div class="content-wrapper">
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <center>
                    <img src="<?php echo get_templete_dir('','assets/web-images/'.web_detail('_web_icon').'?'.rand_val()) ?>" alt="PT Icon Profile" style="width: 196px;height: 194px">
                    <h4>
                      Selamat Datang Di Sistem Informasi Akademik
                    </h4>
                    <h4>
                       <?php echo web_detail('_pt_name'); ?>
                    </h4>
                  </center>                
                </div>
              </div>

              <div class="row">
                <section class="col-md-6">
                  <div class="box box-warning box-solid">
                    <div class="box-body">
                      <div id="home-image" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#home-image" data-slide-to="0" class="active"></li>
                          <li data-target="#home-image" data-slide-to="1" class=""></li>
                          <li data-target="#home-image" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="<?php echo get_template_assets('dist/img/header-background.jpg',TRUE) ?>" alt="First slide">

                            <div class="carousel-caption">
                              First Slide
                            </div>
                          </div>
                          <div class="item">
                            <img src="<?php echo get_template_assets('dist/img/photo1.png',TRUE) ?>" alt="Second slide">

                            <div class="carousel-caption">
                              Second Slide
                            </div>
                          </div>
                          <div class="item">
                            <img src="<?php echo get_template_assets('dist/img/header-background.jpg',TRUE) ?>" alt="Third slide">

                            <div class="carousel-caption">
                              Third Slide
                            </div>
                          </div>
                        </div>
                        <a class="left carousel-control" href="#home-image" data-slide="prev">
                          <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#home-image" data-slide="next">
                          <span class="fa fa-angle-right"></span>
                        </a>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="col-md-6">
                  <div class="row">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                      <div class="callout callout-warning">
                        <h4><li class="fa fa-exclamation-circle"></li> Perhatian</h4>
                        <p>Untuk bisa mengakses sistem, anda harus login terlebih dahulu. Jika belum memiliki username dan password silahkan menghadap ke <b>Administrator SIAKAD</b> dengan membawa surat keterangan mahasiswa/dosen.</p>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-12">
                      <div class="box box-solid box-warning" id="box-quick-news">
                        <div class="box-header with-border">
                          <h3 class="box-title"><li class="fa fa-newspaper-o"></li> Qiuck Info</h3>
                        </div>
                        <div class="box-body" style="height: 252px" id="container-quick-news">
                          <ul class="timeline">
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-blue">10 Feb. 2017</span>
                            </li>
                            <!-- /.timeline-label -->

                            <!-- timeline item -->
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-newspaper-o bg-green"></i>
                                <div class="timeline-item box box-success" style="width: 90%">
                                  <div class="box-header with-border">
                                    <h3 class="box-title">News 1</h3>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> 12:05</span>
                                  </div>
                                  <div class="box-body">
                                    Content goes here...
                                    Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at

                                    the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                                  </div>
                                </div>
                                <!-- <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                
                                    <h3 class="timeline-header"><a href="#">News 1</a> ...</h3>
                                
                                    <div class="timeline-body">
                                        ...
                                        Content goes here
                                    </div>
                                
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">...</a>
                                    </div>
                                </div> -->
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-sticky-note bg-yellow"></i>
                                <div class="timeline-item box box-warning" style="width: 90%">
                                  <div class="box-header with-border">
                                    <h3 class="box-title">News 2</h3>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> 12:05</span>
                                  </div>
                                  <div class="box-body">
                                    Content goes here...
                                    Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at

                                    the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                                  </div>
                                </div>
                                <!-- <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                
                                    <h3 class="timeline-header"><a href="#">News 2</a> ...</h3>
                                
                                    <div class="timeline-body">
                                        ...
                                        Content goes here
                                    </div>
                                
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">...</a>
                                    </div>
                                </div> -->
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-globe bg-purple"></i>
                                <div class="timeline-item box box-purple" style="width: 90%">
                                  <div class="box-header with-border">
                                    <h3 class="box-title">News 3</h3>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> 12:05</span>
                                  </div>
                                  <div class="box-body">
                                    Content goes here...
                                    Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at

                                    the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                                  </div>
                                </div>
                                <!-- <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                
                                    <h3 class="timeline-header"><a href="#">News 3</a> ...</h3>
                                
                                    <div class="timeline-body">
                                        ...
                                        Content goes here
                                    </div>
                                
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">...</a>
                                    </div>
                                </div> -->
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-minus bg-gray"></i>
                            </li>
                            <!-- END timeline item -->
                          </ul>

                          <!-- <dl>
                            <dt>Description lists</dt>
                            <dd>A description list is perfect for defining terms.</dd>
                            <dt>Euismod</dt>
                            <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                            <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt>Malesuada porta</dt>
                            <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                          </dl> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </div>
            <!-- /.box-body -->        
          </div>
        </div>
      </div>

      <div class="modal fade style-2" id="about" role="dialog">
        <div class="modal-dialog">
          <div class="row centered-content">
            <div class="col-md-12">
              <div class="box box-widget widget-user">          
                <div class="widget-user-header bg-yellow" style="background: url('<?php echo get_templete_dir(dirname(__FILE__),'dist/img/header-backgroun.jpg') ?>') center center ;">
                  <h3 class="widget-user-username"><?php echo web_detail('_dev_name'); ?></h3>
                  <h5 class="widget-user-desc"><!-- Web Developer -->Dev... <li class="fa fa-html5"></li> <li class="fa fa-css3"></li></h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo get_template_assets('dist/img/profil.jpg') ?>" alt="User Avatar">
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12 col-xs-12" style="margin-top: 35px">
                      <div class="box box-solid box-warning">
                        <div class="box-header with-border">
                          <i class="fa fa-info-circle"></i>
                          <h3 class="box-title">Tentang Aplikasi</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <dl class="dl-horizontal">
                            <dt>Version</dt>
                            <dd><li class="fa fa-chevron-right"></li> <?php echo web_detail('_app_version'); ?></dd>

                            <dt>Komponen Aplikasi</dt>
                            <dd><li class="fa fa-chevron-right"></li> CodeIgniter <?php echo web_detail('_CI_version').CI_VERSION ?> (Framework) <li class="glyphicon glyphicon-fire"></li></dd>
                            <dd><li class="fa fa-chevron-right"></li> AdminLTE <?php echo web_detail('_AdminLTE_version') ?> (Template) <li class="fa fa-html5"></li> <li class="fa fa-css3"></li></dd>
                            <dd><li class="fa fa-chevron-right"></li> Dll...</dd>

                            <dt>Umpan Balik</dt>
                            <dd><li class="fa fa-chevron-right"></li> muh.dickyhidayat@gmail.com <li class="fa fa-envelope"></li></dd>
                            <dd><li class="fa fa-chevron-right"></li> muh.dickyhidayat@outlook.com <li class="fa fa-envelope"></li></dd>
                          </dl>
                        </div>
                        <div class="box-footer">
                          <div class="row" style="margin-top: -35px">
                            <div class="col-md-12">
                                <center style="margin-bottom: -15px"><h3><?php echo web_detail('_app_name'); ?></h3></center>
                                <center><h3><?php echo web_detail('_pt_name'); ?></h3></center>
                                <center>Aplikasi berbasis web ini ditujukan untuk pengolahan data akademik perguruan tinggi mulai dari data kemahasiswaan, data tenaga pedidik dan data akademik lainnya.</center>
                            </div>
                          </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <div class="box box-solid box-warning">
                        <div class="box-header with-border">
                          <i class="fa fa-users"></i>
                          <h3 class="box-title">Kontribusi</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <dl class="dl-horizontal">
                            <dt>Terima Kasih Kepada</dt>
                            <dd><li class="fa fa-chevron-right"></li> <?php echo web_detail('_pt_name'); ?></dd>
                            <dd><li class="fa fa-chevron-right"></li> Fadly Abrianto (Si pendekar anime <li class="fa fa-smile-o"></li>)</dd>
                            <dd><li class="fa fa-chevron-right"></li> Teman-teman yang saya tidak bisa sebutkan semua...</dd>
                          </dl>
                        </div>                        
                        <!-- /.box-body -->
                    </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 col-xs-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">
                          <strong>
                            <a href="http://plus.google.com/114776876179599774585" target="blank" style="background-color:#d33724" class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a>
                            <a href="http://plus.google.com/114776876179599774585" target="blank" style="color:#d33724">
                        </h5>
                        <span class="description-text">Follow me on Google+</a></strong></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-xs-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">
                          <strong>
                            <a href="http://www.facebook.com/GhostUSS" target="blank" class="btn btn-social-icon btn-facebook" style="background-color: #3c8dbc"><i class="fa fa-facebook"></i></a>
                            <a href="http://www.facebook.com/GhostUSS" target="blank" style="color:#3c8dbc">
                        </h5>
                        <span class="description-text">Find me on Facebook</a></strong></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-xs-4">
                      <div class="description-block">
                        <h5 class="description-header">
                          <strong>
                            <a href="http://www.instagram.com/muhammad.dicky.hidayat/" target="blank" style="background-color:#D81B60" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                            <a href="http://www.instagram.com/muhammad.dicky.hidayat/" target="blank" style="color:#D81B60">
                        </h5>
                        <span class="description-text">Follow me on Instagram</a></strong></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
            </div>    
          </div>
        </div>
      </div>
    </section>
  </div>
<!-- ./div content wrapper -->        

  <footer class="main-footer">
    <div class="row">
      <div class="col-md-5 col-xs-5">
        <div class="pull-left">
          <strong>AdminLTE Is Designed By <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong>
        </div>
      </div>
      <div class="col-md-7 col-xs-7">
        <div class="pull-right">
          <strong>Developed By <a href="#" class="text-orange show-about"><?php echo web_detail('_dev_name') ?></a></strong>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 col-xs-5">
        <div class="pull-left">
          <b>Version</b> <?php echo web_detail('_AdminLTE_ver'); ?>
        </div>
      </div>
      <div class="col-md-7 col-xs-7">
        <div class="pull-right">
        <strong>        
          <a href="http://plus.google.com/114776876179599774585" target="blank" style="color:#d33724"><i class="fa fa-google-plus-square"></i> Follow me on Google+</a> <i class="glyphicon glyphicon-option-vertical"></i> <a href="http://www.facebook.com/GhostUSS" target="blank" style="color:#3c8dbc"><i class="fa fa-facebook-square"></i> Find me on Facebook</a> <i class="glyphicon glyphicon-option-vertical"></i> <a href="http://www.instagram.com/muhammad.dicky.hidayat/" target="blank" style="color:#D81B60"><i class="fa fa-instagram"></i> Follow me on Instagram</a>          
        </div>
        </strong>
      </div>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script type="application/javascript" src="<?php echo get_plugin('jquery','js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script type="application/javascript" src="<?php echo get_plugin('jquery-ui','js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
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
<!-- Slimscroll -->
<script type="application/javascript" src="<?php echo get_plugin('slimscroll','js')?>"></script>
<!-- AdminLTE App -->
<script type="application/javascript" src="<?php echo get_template_assets('dist/js/adminlte.min.js') ?>"></script>
<script type="text/javascript">
    var skins = [
      "skin-blue",
      "skin-black",
      "skin-red",
      "skin-yellow",
      "skin-purple",
      "skin-green",
      "skin-blue-light",
      "skin-black-light",
      "skin-red-light",
      "skin-yellow-light",
      "skin-purple-light",
      "skin-green-light"
    ];

    var callouts = [
      "callout-danger",
      "callout-info",
      "callout-warning",
      "callout-success"
    ];

    var boxs = [
      "box-danger",
      "box-info",
      "box-warning",
      "box-success"
    ];

  $(function(){
  
    if (typeof (Storage) != "undefined") {
      if (get('skin') != undefined && get('skin') == null) {
        change_skin(get('skin'));
      }
      else{
        change_skin('skin-yellow');
      }
    }

    $(document).on('click','.show-about', function(eve){
      eve.preventDefault();
      $('#about').modal('show');
    });
    $('.modal').on('show.bs.modal',function(e){
      $('body').addClass('modal-show');
    });
    $('#container-quick-news').slimScroll({
      position: 'right',
      height: '252px',
    });
  });

  function change_skin(cls) {
    $.each(skins, function (i) {
      $("body").removeClass(skins[i]);
    });

    $.each(callouts, function (i) {
      $('.'+callouts[i]).removeClass(callouts[i]);
    });

    $.each(boxs, function (i) {
      $('.'+boxs[i]).removeClass(boxs[i]);
    });

    if (cls.search('red') > 0) {
      $('.callout').addClass('callout-danger');
      $('.box').addClass('box-danger');
    }
    else if (cls.search('yellow') > 0) {
      $('.callout').addClass('callout-warning');
      $('.box').addClass('box-warning');
    }
    else if (cls.search('green') > 0) {
      $('.callout').addClass('callout-success');
      $('.box').addClass('box-success');
    }
    else if (cls.search('blue') > 0) {
      $('.callout').addClass('callout-info');
      $('.box').addClass('box-info');
    }

    $("body").addClass(cls);
    store('skin', cls);
    return false;
  }

  function store(name, val) {
    if (typeof (Storage) !== "undefined") {
      localStorage.setItem(name, val);
    }
  }

  function get(name) {
    if (typeof (Storage) !== "undefined") {
      return localStorage.getItem(name);
    }
  }
</script>
</body>
</html>
