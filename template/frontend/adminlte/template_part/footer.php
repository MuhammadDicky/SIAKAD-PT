<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                        <dd><li class="fa fa-chevron-right"></li> <?php echo web_detail('_email_feedback_1'); ?> <li class="fa fa-envelope"></li></dd>
                        <dd><li class="fa fa-chevron-right"></li> <?php echo web_detail('_email_feedback_2'); ?> <li class="fa fa-envelope"></li></dd>
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
          <strong>Developed By <a href="<?php echo set_url('about'); ?>" class="text-orange"><?php echo web_detail('_dev_name'); ?></a></strong>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark style-2">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-setting" data-toggle="tab" aria-expanded="true"><i class="fa fa-wrench"></i></a></li>
      <li><a href="#control-sidebar-theme-setting" data-toggle="tab"><i class="fa fa-tint"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-setting">
        <h4 class="control-sidebar-heading">Pengaturan Layout</h4>
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-layout="fixed" class="pull-right"> Fixed layout</label>
          <p>Aktifkan fixed layout. Kamu tidak bisa menggunakan fixed dan boxed layout bersamaan</p>
        </div>
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-layout="layout-boxed" class="pull-right"> Boxed Layout</label>
          <p>Aktifkan boxed layout</p>
        </div>
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-layout="sidebar-collapse" class="pull-right"> Toggle Sidebar</label>
          <p>Toggle the left sidebar's state (open or collapse)</p>
        </div>        
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-controlsidebar="control-sidebar-open" class="pull-right"> Toggle Right Sidebar Slide</label>
          <p>Toggle between slide over content and push content effects</p>
        </div>
      </div>
      <!-- /.tab-pane -->      
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-theme-setting">
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script type="application/javascript" src="<?php echo get_plugin('jquery','js') ?>"></script>
<script type="text/javascript">
  jQuery.browser = {};
  (function(){
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9] +)\ . /)) {
      jQuery.browser.msie = true;
      jQuery.browser.version = RegExp.$1;
    }
  });
</script>
<!-- jQuery UI 1.11.4 -->
<script type="application/javascript" src="<?php echo get_plugin('jquery-ui','js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script type="application/javascript" src="<?php echo get_template_assets('bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- PACE -->
<script type="application/javascript" src="<?php echo get_plugin('pace','js')?>"></script>
<!-- Jquery Loading Overlay -->
<script type="application/javascript" src="<?php echo get_plugin('jquery-loading-overlay','js') ?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('jquery-loading-overlay','js','progress') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.content-wrapper').LoadingOverlay("show",{
        color: "rgba(255, 255, 255, 2)",
        /*fade: [500,1000],*/
        zIndex: 1000,    
        image:"<?php echo get_plugin('jquery-loading-overlay','image','Ellipsis.gif'); ?>",
        custom:$("<div>",{
          id:"loading-overlay-text",
          css:{
            "margin-top":"50px",
            "font-weight":"bold"
          },
          text:"Memuat Halaman",
        }),
      });
      var loading_text = $('#loading-overlay-text').text();
      var i = 0;
      setInterval(function(){
        $('#loading-overlay-text').append('. ');
        i++;
        if (i == 4) {
          $('#loading-overlay-text').html(loading_text);
          i = 0;
        }
      },200);
    });
</script>
<!-- FastClick -->
<script type="application/javascript" src="<?php echo get_plugin('fastclick','js')?>"></script>
<script type="text/javascript">
  $(function(){
    window.addEventListener('load', function(){
      new FastClick(document.body);
    }, false);
  });
</script>
<!-- Data Table -->
<!-- <script type="application/javascript" src="<?php echo get_plugin('datatables','js','jquery')?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('datatables','js','bs')?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('datatables','js','responsive')?>"></script> -->
<!-- Select2 -->
<script type="application/javascript" src="<?php echo get_plugin('select2','js')?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('select2','js','lang')?>"></script>
<!-- JQuery Hash -->
<script type="application/javascript" src="<?php echo get_plugin('jquery-hashchange','js') ?>"></script>
<!-- datepicker -->
<script type="application/javascript" src="<?php echo get_plugin('datepicker','js') ?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('datepicker','js','lang') ?>"></script>
<!-- iCheck 1.0.1 -->
<script type="application/javascript" src="<?php echo get_plugin('icheck','js')?>"></script>
<!-- Slimscroll -->
<script type="application/javascript" src="<?php echo get_plugin('slimscroll','js')?>"></script>
<!-- sweetalert2 -->
<script type="application/javascript" src="<?php echo get_plugin('sweetalert2','js')?>"></script>
<!-- momentjs -->
<script type="application/javascript" src="<?php echo get_plugin('momentjs','js')?>"></script>
<!-- chart.js -->
<script type="application/javascript" src="<?php echo get_plugin('chartjs','js')?>"></script>
<!-- boostrap-toogle -->
<script type="application/javascript" src="<?php echo get_plugin('bs-toogle-master','js') ?>"></script>
<!-- boostrap-timepicker -->
<script type="application/javascript" src="<?php echo get_plugin('timepicker','js') ?>"></script>
<!-- AdminLTE App -->
<script type="application/javascript" src="<?php echo get_template_assets('dist/js/adminlte.min.js') ?>"></script>
<script type="text/javascript">
<?php global $Config; ?>
    var path_home    = '<?php echo web_detail('_path_home') ?>',
    index_path       = '<?php echo web_detail('_index_path') ?>',
    path_profil_pt   = '<?php echo web_detail('_path_profil_pt') ?>',
    beranda_mhs_path = '<?php echo web_detail('_beranda_mhs_path') ?>',
    beranda_ptk_path = '<?php echo web_detail('_beranda_ptk_path') ?>',
    token            = '<?php echo $this->security->get_csrf_hash(); ?>',
    user_last_online = '<?php echo $_SESSION['last_online']; ?>/<?php echo $_SESSION['level_akses']; ?>';
    $(document).ready(function(){
      /*$(window).load(function(){
        setTimeout(function(){
          $('.content-wrapper').css('background','#ecf0f5');
          $('section.content-header').show();
          $('section.content').slideDown('slow');
        },500);
        setTimeout(function(){
          $('.content-wrapper').LoadingOverlay("hide");
        },1000);
      });*/

      Pace.once('done', function(){
        setTimeout(function(){
          $('.content-wrapper').css('background','#ecf0f5');
          $('section.content-header').show();
          $('section.content').slideDown('slow');
        },100);
        setTimeout(function(){
          $('.content-wrapper').LoadingOverlay("hide");
        },500);
      });

      $('.btn-sidebar-set button[url-target]').on('click', function(){
        window.location.href= $(this).attr('url-target');
      });
    });
</script>
<?php if ($_SESSION['level_akses'] == 'ptk'): ?>
<script type="application/javascript" src="<?php echo get_custom_assets('dist/js/js_app_conf.js','nC') ?>"></script>
<?php endif ?>
<?php if ($_SESSION['level_akses'] == 'mhs'): ?>
<script type="application/javascript" src="<?php echo get_custom_assets('dist/js/js_app_config.js','nC') ?>"></script>
<?php endif ?>
<script type="application/javascript" src="<?php echo get_custom_assets('dist/js/js_main_conf.js','nC') ?>"></script>
</body>
</html>
