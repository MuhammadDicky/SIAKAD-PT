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
                        <dd><li class="fa fa-chevron-right"></li> </li> <?php echo web_detail('_email_feedback_1'); ?> <li class="fa fa-envelope"></li></dd>
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

  <!-- Footer -->
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
  <!-- ./Footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar style-2 control-sidebar-dark" style="">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active">
        <a href="#control-layout-setting" data-toggle="tab" aria-expanded="true" title="Pengaturan Layout">
        <i class="fa fa-wrench"></i>
        </a>
      </li>
      <li>
        <a href="#control-main-setting" data-toggle="tab" title="Pengaturan Umum"><i class="fa fa-gear"></i></a>
      </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-layout-setting">
        <h4 class="control-sidebar-heading">Pengaturan Layout
          <!-- <span class="pull-right-container">
            <i class="fa fa-refresh pull-right default-layout-set" title="Pengaturan Default Layout"></i>
            <span class="label label-success pull-right">Soon</span>
          </span> -->
        </h4>
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-layout="fixed" class="pull-right"> Fixed layout</label>
          <p>Aktifkan fixed layout pada header dan footer. Tidak bisa menggunakan fixed dan boxed layout bersamaan</p>
        </div>
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-layout="layout-boxed" class="pull-right"> Boxed Layout</label>
          <p>Aktifkan boxed layout. Tidak bisa menggunakan fixed dan boxed layout bersamaan</p>
        </div>
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-layout="sidebar-collapse" class="pull-right"> Toggle Sidebar</label>
          <p>Toggle sidebar/menu saat memuat halaman</p>
        </div>        
        <div class="form-group">
          <label class="control-sidebar-subheading">
          <input type="checkbox" data-controlsidebar="control-sidebar-open" data-layout="control-sidebar-open" class="pull-right"> Toggle Right Sidebar Slide</label>
          <p>Toggle sidebar/menu sebelah kanan saat memuat halaman</p>
        </div>
      </div>
      <!-- /.tab-pane -->      
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-main-setting">
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
  $(function(){
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
<!-- AngularJS -->
<script type="application/javascript" src="<?php echo get_plugin('angular','js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script type="application/javascript" src="<?php echo get_template_assets('bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- PACE -->
<script type="application/javascript" src="<?php echo get_plugin('pace','js')?>"></script>
<!-- Bluebird -->
<script type="application/javascript" src="<?php echo get_plugin('bluebird','js') ?>"></script>
<!-- Jquery Loading Overlay -->
<script type="application/javascript" src="<?php echo get_plugin('jquery-loading-overlay','js') ?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('jquery-loading-overlay','js','progress') ?>"></script>
<script type="text/javascript">
    var image_overlay_path = "<?php echo get_plugin('jquery-loading-overlay','image','Ellipsis.gif'); ?>";
    $(document).ready(function(){
      $('.content-wrapper').LoadingOverlay("show",{
        color: "rgba(255, 255, 255, 2)",
        /*fade: [500,1000],*/
        zIndex: 1000,    
        image:image_overlay_path,
        custom:$("<div>",{
          id:"loading-overlay-text",
          css:{
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
      },400);
    });
</script>
<!-- FastClick -->
<script type="application/javascript" src="<?php echo get_plugin('fastclick','js')?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    window.addEventListener('load', function(){
      new FastClick(document.body);
    }, false);
  });
</script>
<!-- Data Table -->
<script type="application/javascript" src="<?php echo get_plugin('datatables','js','jquery')?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('datatables','js','bs')?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('datatables','js','responsive')?>"></script>
<!-- Select2 -->
<script type="application/javascript" src="<?php echo get_plugin('select2','js')?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('select2','js','lang')?>"></script>
<!-- HashChange -->
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
<!-- Jquery File Select -->
<script type="application/javascript" src="<?php echo get_plugin('jquery-file-select','js') ?>"></script>
<script type="application/javascript" src="<?php echo get_plugin('jquery-file-select','js','lang') ?>"></script>
<?php if (isset($settings)): ?>
<!-- Sortable Master -->
<script type="application/javascript" src="<?php echo get_plugin('sortable-master','js') ?>"></script>
<?php endif ?>
<!-- AdminLTE App -->
<script type="application/javascript" src="<?php echo get_template_assets('dist/js/adminlte.min.js') ?>"></script>
<script type="text/javascript">
    <?php $token = $this->security->get_csrf_hash(); ?>
    var data_dashboard_path = '<?php echo web_detail('_data_dashboard_path') ?>',
    data_master_path        = '<?php echo web_detail('_data_master_path') ?>',
    data_pengguna_path      = '<?php echo web_detail('_data_pengguna_path') ?>',
    data_akademik_path      = '<?php echo web_detail('_data_akademik_path') ?>',
    admin_url               = '<?php echo set_url() ?>',
    base_url                = '<?php echo base_url() ?>',
    token                   = '<?php if($token) {echo $token;} else {echo rand_val();} ?>',
    my_colors               = [],
    my_layout_settings      = [];

    $(document).ready(function(){
      /*$('.content-wrapper').slimScroll({
        position: 'right',
        height: '566px',
        railColor: '#333333',
        railOpacity:2
      });*/

      $.each($('#control-layout-setting a[data-skin]'), function(i){
        my_colors.push($(this).attr('data-skin'));
      });
      $.each($('#control-layout-setting input[type=checkbox]'), function(i){
        my_layout_settings.push($(this).attr('data-layout'));
      });

      if (typeof (Storage) == "undefined") {
        $('#control-layout-setting').prepend(
          '<div class="row" style="margin-bottom:-20px">'
          +'  <div class="col-md-12">'
          +'    <div class="callout callout-danger">'
          +'      <h4><i class="fa fa-exclamation-circle"></i> Perhatian!</h4>'
          +'      <p>Browser yang anda pakai tidak mendukung untuk pengaturan layout, tolong gunakan browser modern untuk bisa menggunakan pengaturan layout!</p>'
          +'    </div>'
          +'  </div>'
          +'</div>'
        );
        $.each(my_layout_settings, function(i,data_layout){
          if (data_layout == 'fixed') {
            $('body').addClass(data_layout);
          }
          else{
            $('body').removeClass(data_layout);
          }
        });
        change_skin('skin-yellow');
      }
      else{
        $.each(my_layout_settings, function(i,data_layout){
          if (data_layout != undefined) {
            if (get(data_layout) == 'true') {
              $('body').addClass(data_layout);
            }
            else{
              $('body').removeClass(data_layout);
            }
          }
        });
        if (get('skin') != undefined && get('skin') == null) {
          change_skin(get('skin'));
        }
        else{
          change_skin('skin-yellow');
        }
      }

      Pace.once('done', function(){
        if (typeof (Storage) == "undefined") {
          $.each(my_layout_settings, function(i,data_layout){
            if (data_layout == 'fixed') {
              $('#control-layout-setting input[data-layout='+data_layout+'], #settings-layout input[data-layout='+data_layout+']').iCheck('check');
            }
            else{
              $('#control-layout-setting input[data-layout='+data_layout+'], #settings-layout input[data-layout='+data_layout+']').iCheck('uncheck');
            }
            $('#control-layout-setting input[data-layout='+data_layout+'], #settings-layout input[data-layout='+data_layout+']').iCheck('disable');
          });
          $.each(my_colors, function(i,layout_color){
            if (layout_color == 'skin-yellow') {
              $('#settings-layout input[layout-skin='+layout_color+']').iCheck('check');
              $('#settings-layout input[layout-skin='+layout_color+']').parent('div').css('pointer-events','none');
            }
            else{
              $('#settings-layout input[layout-skin='+layout_color+']').iCheck('uncheck');
            }
            $('#settings-layout input[layout-skin='+layout_color+']').iCheck('disable');
          });
        }
        else{
          $.each(my_layout_settings, function(i,data_layout){
            if (data_layout != undefined) {
              if (get(data_layout) == 'true') {
                $('#control-layout-setting input[data-layout='+data_layout+'], #settings-layout input[data-layout='+data_layout+']').iCheck('check');
              }
              else{
                $('#control-layout-setting input[data-layout='+data_layout+'], #settings-layout input[data-layout='+data_layout+']').iCheck('uncheck');
              }
            }
          });
          if (get('skin') != undefined || get('skin') == null) {
            $.each(my_colors, function(i,layout_color){
              if (layout_color == get('skin')) {
                $('#settings-layout input[layout-skin='+layout_color+']').iCheck('check');
                $('#settings-layout input[layout-skin='+layout_color+']').parent('div').css('pointer-events','none');
              }
              else{
                $('#settings-layout input[layout-skin='+layout_color+']').iCheck('uncheck');
              }
            });
          }
          else{
            $('#settings-layout input[layout-skin=skin-yellow]').iCheck('check');
          }
        }

        setTimeout(function(){
          $('.content-wrapper').css('background','#ecf0f5');
          $('section.content-header').show();
          $('section.content').slideDown('slow');
        },100);
        setTimeout(function(){
          $('.content-wrapper').LoadingOverlay("hide");
        },500);
      });

      $(document).on('click', '#control-layout-setting a[data-skin], #settings-layout a[data-skin]', function(){
        var skin_c = $(this).attr('data-skin');
        change_skin(skin_c);
        $.each(my_colors, function(i,layout_color){
          $('#settings-layout input[layout-skin='+layout_color+']').parent('div').css('pointer-events','');
          $('#settings-layout input[layout-skin='+layout_color+']').iCheck('uncheck');
        });
        $('#settings-layout input[layout-skin='+skin_c+']').parent('div').css('pointer-events','none');
        $('#settings-layout input[layout-skin='+get('skin')+']').iCheck('check');
      });

      $(document).on('ifClicked', '#settings-layout input[layout-skin]', function(){
        var skin_c = $(this).attr('layout-skin');
        change_skin(skin_c);
        $.each(my_colors, function(i,layout_color){
          if (layout_color != skin_c) {
            $('#settings-layout input[layout-skin='+layout_color+']').parent('div').css('pointer-events','');
            $('#settings-layout input[layout-skin='+layout_color+']').iCheck('uncheck');
          }
        });
        $('#settings-layout input[layout-skin='+skin_c+']').parent('div').css('pointer-events','none');
      });
        
      $(document).on('ifClicked', '#control-layout-setting input[type=checkbox], #settings-layout input[type=checkbox]', function(){
        var data_layout = $(this).attr('data-layout');
        if (data_layout == 'layout-boxed') {
          $('body').removeClass('fixed');
          $('#control-layout-setting input[data-layout=fixed], #settings-layout input[data-layout=fixed]').iCheck('uncheck');
          change_settings('fixed',false);
        }
        else if (data_layout == 'fixed') {
          $('body').removeClass('layout-boxed');
          $('#control-layout-setting input[data-layout=layout-boxed], #settings-layout input[data-layout=layout-boxed]').iCheck('uncheck');
          change_settings('layout-boxed',false);
        }
        else if (data_layout == 'control-sidebar-open') {
          $('.control-sidebar').removeClass('control-sidebar-open');
        }

        if ($('body').hasClass(data_layout)) {
          change_settings(data_layout,false);
          $('body').removeClass(data_layout);
        }
        else{
          change_settings(data_layout,true);
          $('body').addClass(data_layout);
        }
        $('#control-layout-setting input[data-layout='+data_layout+'], #settings-layout input[data-layout='+data_layout+']').iCheck('toggle');
      });

      $(document).on('click', '#settings-layout .default-layout-set, #control-layout-setting .default-layout-set', function(eve){
        /*Change skin*/
        var default_skin = 'skin-yellow';
        change_skin(default_skin);
        $.each(my_colors, function(i,layout_color){
          if (layout_color != default_skin) {
            $('#settings-layout input[layout-skin='+layout_color+']').parent('div').css('pointer-events','');
            $('#settings-layout input[layout-skin='+layout_color+']').iCheck('uncheck');
          }
        });
        $('#settings-layout input[layout-skin='+default_skin+']').parent('div').css('pointer-events','none');
        $('#settings-layout input[layout-skin='+default_skin+']').iCheck('check');
        /*END -- Change skin*/

        /*Change Layout*/
        $.each(my_layout_settings, function(index,layout){
          $('body').removeClass(layout);
          change_settings(layout,false);
          $('#control-layout-setting input[data-layout='+layout+'], #settings-layout input[data-layout='+layout+']').iCheck('uncheck');
        });

        var default_layout = ["fixed"];
        $.each(default_layout, function(index,def_lay){
          if (!$('body').hasClass(def_lay)) {
            $('body').addClass(def_lay);
          }
          change_settings(def_lay,true);
          $('#control-layout-setting input[data-layout='+def_lay+'], #settings-layout input[data-layout='+def_lay+']').iCheck('check');
        });
        /*END -- Change Layout*/
      });

      $('.btn-sidebar-set button[url-target]').on('click', function(){
        window.location.href= $(this).attr('url-target');
      });

      $(window).scroll(function(eve){

      });

    });

    var skin_container = $("div#control-layout-setting");
    var skins_list = $("<ul />", {"class": 'list-unstyled clearfix'});

    //Dark sidebar skins
    var skin_blue =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin'>Blue</p>");
    skins_list.append(skin_blue);
    var skin_black =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-black' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin'>Black</p>");
    skins_list.append(skin_black);
    var skin_purple =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-purple' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin'>Purple</p>");
    skins_list.append(skin_purple);
    var skin_green =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-green' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin'>Green</p>");
    skins_list.append(skin_green);
    var skin_red =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-red' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin'>Red</p>");
    skins_list.append(skin_red);
    var skin_yellow =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-yellow' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin'>Yellow</p>");
    skins_list.append(skin_yellow);

    //Light sidebar skins
    var skin_blue_light =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-blue-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin' style='font-size: 12px'>Blue Light</p>");
    skins_list.append(skin_blue_light);
    var skin_black_light =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-black-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin' style='font-size: 12px'>Black Light</p>");
    skins_list.append(skin_black_light);
    var skin_purple_light =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-purple-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin' style='font-size: 12px'>Purple Light</p>");
    skins_list.append(skin_purple_light);
    var skin_green_light =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-green-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin' style='font-size: 12px'>Green Light</p>");
    skins_list.append(skin_green_light);
    var skin_red_light =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-red-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin' style='font-size: 12px'>Red Light</p>");
    skins_list.append(skin_red_light);
    var skin_yellow_light =
        $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
            .append("<a href='javascript:void(0);' data-skin='skin-yellow-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
            + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
            + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
            + "</a>"
            + "<p class='text-center no-margin' style='font-size: 12px;'>Yellow Light</p>");
    skins_list.append(skin_yellow_light);

    skin_container.append("<h4 class='control-sidebar-heading'>Warna Layout</h4>");
    skin_container.append(skins_list);

    skin_container.append(
      '<div class="form-group">'
      +'  <div class="btn-group centered-content btn-sidebar-set" style="margin-top:20px">'
      +'    <button class="btn btn-sm btn-block btn-default default-layout-set"><span class="fa fa-refresh"></span> Reset To Default</button>'
      +'  </div>'
      +'</div>'
      );

    function change_skin(cls) {
      $.each(my_colors, function (i) {
        $("body").removeClass(my_colors[i]);
      });

      $("body").addClass(cls);
      store('skin', cls);
      return false;
    }

    function change_settings(settings,val) {
      store(settings, val);
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
<?php if (isset($dashboard)): ?>
<script type="application/javascript" src="<?php echo get_custom_assets('dist/js/app_chart.js','nC') ?>"></script> 
<?php endif ?>
<script type="application/javascript" src="<?php echo get_custom_assets('dist/js/js_app_conf.js','nC') ?>"></script>

</body>
</html>
