<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row centered-content">			
			<div class="col-md-7 col-xs-12">
				<div class="box box-widget widget-user">
		            <!-- Add the bg color to the header using any of the bg-* classes -->
		            <div class="widget-user-header bg-yellow" style="background: url('<?php echo get_template_assets('dist/img/header-sbackground.jpg') ?>') center center;">
		              <h3 class="widget-user-username"><?php echo web_detail('_dev_name'); ?></h3>
		              <h5 class="widget-user-desc"><!-- Web Developer -->Dev... <li class="fa fa-html5"></li> <li class="fa fa-css3"></li></h5>
		            </div>
		            <div class="widget-user-image">
		              <img class="img-circle" src="<?php echo get_template_assets('dist/img/profil.jpg') ?>" alt="User Avatar" id="secret-function">
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
								                <center style="margin-bottom: -15px"><h3>Sistem Informasi Akademik</h3></center>
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
	</section>

	<!-- modal open -->
    <div class="modal modal-info style-2 fade" id="myModal" role="dialog" data-keyboard="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Password Admin</h4>
          </div>

          <div class="modal-body">
          	<form action="update">
          		<div class="row">
	          		<div class="col-md-6">
	          			<div class="form-group">
		          			<label for="password_lama">Password Lama</label>
							<input type="password" class="form-control" name="password_lama" placeholder="Masukkan password lama">
		          		</div>
	          		</div>
	          		<div class="col-md-6">
	          			<div class="form-group">
		          			<label for="password_baru">Password Baru</label>
							<input type="password" class="form-control" name="password_baru" placeholder="Masukkan password baru">
		          		</div>
	          		</div>
          		</div>		          		
          	</form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-dismiss="modal" id="batal">Batal</button>
            <button type="button" class="btn btn-outline" id="submit-password">Update</button>            
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- modal end -->

<?php echo get_templete_part('template_part/footer'); ?>