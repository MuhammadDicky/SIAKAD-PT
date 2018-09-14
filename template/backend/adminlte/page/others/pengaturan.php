<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section" id="config-set" settings-section="config-set" settings-box="#config-set">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-gear"></span> Konfigurasi Umum</h3>
						<div class="box-tools pull-right">
							<!-- <button type="button" class="btn btn-box-tool info" data-info="config-set"><i class="fa fa-exclamation-circle"></i></button> -->
							<a href="#edit?data=config" class="btn btn-box-tool" title="Edit Konfigurasi Umum"><i class="fa fa-pencil-square"></i></a>
							<button type="button" class="btn btn-box-tool refresh-data" data-refresh="config-app" data-box="#config-set" title="Refresh"><i class="fa fa-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body body-database-set">
			        	<div class="row">
		              		<section class="col-md-6">
              					<strong><span class="fa fa-list"></span> Detail Sistem</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div>
		              				<dl class="dl-horizontal">
						                <dt>Nama Web</dt>
						                <dd class="detail-config-siakad detail_web_name"></dd>

						                <dt>Nama Perguruan Tinggi</dt>
						                <dd class="detail-config-siakad detail_pt_name"></dd>

						                <dt>Developer</dt>
						                <dd class="detail-config-siakad detail_dev_name"></dd>

						                <dt>App Version</dt>
						                <dd class="detail-config-siakad detail_app_version"></dd>

						                <dt>Email Feedback 1</dt>
						                <dd class="detail-config-siakad detail_email_feedback_1"></dd>

						                <dt>Email Feedback 2</dt>
						                <dd class="detail-config-siakad detail_email_feedback_2"></dd>
					              	</dl>
						        </div>

						        <strong><span class="fa fa-file"></span> Assets Path</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div>
		              				<dl class="dl-horizontal">
						                <dt>Template</dt>
						                <dd class="detail-config-siakad detail_template_assets"></dd>

						                <dt>Plugin</dt>
						                <dd class="detail-config-siakad detail_plugin_path"></dd>
					              	</dl>
						        </div>

						        <strong><span class="fa fa-image"></span> Gambar</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div>
		              				<dl class="dl-horizontal">
						                <dt>Nama File Logo Perguruan Tinggi</dt>
						                <dd class="detail-config-siakad detail_web_icon"></dd>
					              	</dl>
						        </div>
		              		</section>

		              		<section class="col-md-6">
		              			<strong><span class="fa fa-fire"></span> CodeIgniter</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div>
		              				<dl class="dl-horizontal">
		              					<dt>Version</dt>
						                <dd><?php echo CI_VERSION; ?></dd>

														<dt>Status</dt>
						                <dd class="detail-config-siakad detail_app_environment"></dd>
					              	</dl>
						        </div>

              					<strong><span class="fa fa-database"></span> Database</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div>
		              				<dl class="dl-horizontal">
						                <dt>Hostname</dt>
						                <dd class="detail-config-siakad detail_hostname"></dd>

						                <dt>Database Username</dt>
						                <dd class="detail-config-siakad detail_database_user"></dd>

						                <dt>Database Password</dt>
						                <dd class="detail-config"><i class="fa fa-asterisk"></i><i class="fa fa-asterisk"></i><i class="fa fa-asterisk"></i><i class="fa fa-asterisk"></i><i class="fa fa-asterisk"></i><i class="fa fa-asterisk"></i></dd>

						                <dt>Database Name</dt>
						                <dd class="detail-config-siakad detail_database_name"></dd>

						                <dt>Table Prefix</dt>
						                <dd class="detail-config-siakad detail_table_prefix"></dd>

						                <dt>Database Driver</dt>
						                <dd class="detail-config-siakad detail_dbdriver"></dd>

						                <dt>Table Swap Prefix</dt>
						                <dd class="detail-config-siakad detail_table_swap_prefix"></dd>
					              	</dl>
						        </div>
		              		</section>
		              	</div>
			        </div>
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
		      	</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid" id="settings-layout">
			        <div class="box-header">
			          	<h3 class="box-title"><span class="fa fa-list-alt"></span> Layout</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool default-layout-set"><i class="fa fa-refresh"></i> Reset To Default</button> |
							<button type="button" class="btn btn-box-tool info" data-info="layout-setting"><i class="fa fa-exclamation-circle"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body body-settings-layout">
			        	<div class="row set-section" settings-section="choose-layout" settings-box="#settings-layout">
		              		<div class="col-md-12">
		              			<strong class="setting-label"><span class="fa fa-window-maximize"></span> Pilihan Layout</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              		</div>
		              	</div>
			        	<div class="row" id="row-layout-settings">
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/default_set.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" data-layout="fixed" class="pull-right"></td>
						            			<td style="padding-left: 10px">
							            			<label>Fixed Layout</label>
							            			<p>Aktifkan fixed layout pada header dan footer. Tidak bisa menggunakan fixed dan boxed layout bersamaan</p>
						            			</td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/boxed-layout.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						              <table>
						            		<tr>
						            			<td><input type="checkbox" data-layout="layout-boxed" class="pull-right"></td>
						            			<td style="padding-left: 10px">
							            			<label>Boxed Layout</label>
							            			<p>Aktifkan boxed layout. Tidak bisa menggunakan fixed dan boxed layout bersamaan</p>
						            			</td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/sidebar-layout.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						              	<table>
						            		<tr>
						            			<td><input type="checkbox" data-layout="sidebar-collapse" class="pull-right"></td>
						            			<td style="padding-left: 10px">
							            			<label>Toggle Sidebar</label>
							            			<p>Toggle sidebar/menu saat memuat halaman</p>
						            			</td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/sidebar-slide-layout.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						              	<table>
						            		<tr>
						            			<td><input type="checkbox" data-layout="control-sidebar-open" class="pull-right"></td>
						            			<td style="padding-left: 10px">
							            			<label>Toggle Right Sidebar Slide</label>
							            			<p>Toggle sidebar/menu sebelah kanan saat memuat halaman</p>
						            			</td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        	</div>

			        	<div class="row set-section" settings-section="layout-color" settings-box="#settings-layout">
		              		<div class="col-md-12">
		              			<strong class="setting-label"><span class="fa fa-tint"></span> Warna Layout</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              		</div>
		              	</div>
		              	<div class="row">
		              		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-blue" style="display: block;" class="clearfix full-opacity-hover">
									    		<div>
									    			<span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span>
									    			<span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
									    		</div>
									    		<div>
									    			<span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span>
									    			<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
									    		</div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-blue" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Blue</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-black" style="display: block;" class="clearfix full-opacity-hover">
									    		<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-black" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Black</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-purple" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-purple" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Purple</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-green" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-green" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Green</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-red" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-red" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Red</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-yellow" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-yellow" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Yellow</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>

			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-blue-light" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-blue-light" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Blue Light</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-black-light" style="display: block;" class="clearfix full-opacity-hover">
									    		<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-black-light" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Black Light</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-purple-light" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-purple-light" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Purple Light</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-green-light" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-green-light" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Green Light</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-red-light" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-red-light" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Red Light</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
			        		<div class="col-md-2 col-sm-3 col-xs-4">
			        			<div class="box box-solid">
						            <div class="box-body">
									    <div style="">
									    	<a href="javascript:void(0);" data-skin="skin-yellow-light" style="display: block;" class="clearfix full-opacity-hover">
									    		<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>
									    		<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span></div>
									    	</a>
									    </div>
									</div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-yellow-light" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Yellow Light</strong></td>
						            		</tr>
						            	</table>
						            </div>
						            <!-- /.box-footer -->
						        </div>
			        		</div>
		              	</div>
		              	<!-- <div class="row">
		              		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/skin-blue.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-blue" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Blue</strong></td>
						            		</tr>
						            	</table>
						            </div>
						        </div>
			        		</div>
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/skin-black.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-black" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Black</strong></td>
						            		</tr>
						            	</table>
						            </div>
						        </div>
			        		</div>
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/skin-purple.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-purple" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Purple</strong></td>
						            		</tr>
						            	</table>
						            </div>
						        </div>
			        		</div>
			        		<div class="col-md-3 col-sm-6 col-xs-6">
			        			<div class="box box-solid">
						            <div class="box-body">
						            	<img src="<?php echo get_template_assets('dist/img/skin-green.png') ?>" alt="layout-setting" class="img-responsive" style="padding: 2px">
						            </div>
						            <div class="box-footer">
						            	<table>
						            		<tr>
						            			<td><input type="checkbox" layout-skin="skin-green" class="pull-right"></td>
						            			<td style="padding-left: 10px;"><strong>Green</strong></td>
						            		</tr>
						            	</table>
						            </div>
						        </div>
			        		</div>
		              	</div> -->
			        </div>
			        <!-- /.box-body -->
		      	</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section" id="template-set" settings-section="template-set" settings-box="#template-set" collapse-filter="true">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-dashboard"></span> Template</h3>
						<div class="box-tools pull-right">
							<!-- <button type="button" class="btn btn-box-tool info" data-info="backup-db"><i class="fa fa-exclamation-circle"></i></button> -->
							<button type="button" class="btn btn-box-tool refresh-data" data-refresh="list-template" data-box="#template-set" title="Refresh List Template"><i class="fa fa-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus collapse-icon"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body">
			        	<div class="row">
			        		<div class="col-md-3">
			        			<strong>Template Aktif</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
			        			<dl id="detail_aktif_template_container">
	              					<dt>Nama</dt>
					                <dd class="detail_aktif_template detail_template_template_name"></dd>

					                <dt>Developer</dt>
					                <dd class="detail_aktif_template detail_template_template_dev"></dd>

					                <dt>Versi</dt>
					                <dd class="detail_aktif_template detail_template_template_version"></dd>

					                <dt>Deskripsi</dt>
					                <dd class="detail_aktif_template detail_template_template_description"></dd>

					                <dd><img src="" alt="Template Example Image" class="detail_template_template_image" style="width: 100%"></dd>
				              	</dl>
			        		</div>
		              		<div class="col-md-9">
		              			<strong>Daftar Template <span class="pull-right"><a href="#tambah?data=template"><i class="fa fa-plus text-aqua"></i></a></span></strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<table class="table table-striped" id="table-list-tamplate">
	              					<thead>
	              						<tr>
	              							<th class="text-center">No.</th>
	              							<th>Template</th>
	              							<th class="text-center">Developer</th>
	              							<th class="text-center">Versi</th>
	              							<th class="text-center">Status</th>
	              							<th class="text-center">Aksi</th>
	              						</tr>
	              					</thead>
					                <tbody>
					             	</tbody>
					             	<tfoot>
	              						<tr>
	              							<th class="text-center">No.</th>
	              							<th>Template</th>
	              							<th class="text-center">Developer</th>
	              							<th class="text-center">Versi</th>
	              							<th class="text-center">Status</th>
	              							<th class="text-center">Aksi</th>
	              						</tr>
	              					</tfoot>
					          	</table>
		              			<div class="row" id="<!-- list-template-container -->">
							    </div>
		              		</div>
		              	</div>
			        </div>
			        <!-- /.box-body -->
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
		      	</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section" id="menu-set" settings-section="menu-set" settings-box="#menu-set" collapse-filter="true">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-list"></span> Menu</h3>
						<div class="box-tools pull-right">
							<!-- <button type="button" class="btn btn-box-tool info" data-info="backup-db"><i class="fa fa-exclamation-circle"></i></button> -->
							<button type="button" class="btn btn-box-tool refresh-data" data-refresh="list-menu" data-box="#menu-set" title="Refresh List Menu"><i class="fa fa-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus collapse-icon"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body body-menu-set">
			        	<div class="row">
		              		<div class="col-md-6">
		              			<strong>Administrator <span class="pull-right"><a href="#tambah?data=menu&lvl=admin"><i class="fa fa-plus text-aqua"></i></a></span></strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<ul class="todo-list list-menu-container" style="margin-bottom: 10px" id="admin-list-menu">
				              	</ul>
		              		</div>

		              		<div class="col-md-6">
		              			<strong>User <span class="pull-right"><a href="#tambah?data=menu&lvl=user"><i class="fa fa-plus text-aqua"></i></a></span></strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<ul class="todo-list list-menu-container" style="margin-bottom: 10px" id="user-list-menu">
		              			</ul>
		              		</div>
		              	</div>
			        </div>
			        <!-- /.box-body -->
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
		      	</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section" id="database-set" settings-section="backup-db" settings-box="#database-set">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-database"></span> Pengolahan Database</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool info" data-info="backup-db"><i class="fa fa-exclamation-circle"></i></button>
							<button type="button" class="btn btn-box-tool refresh-data" data-refresh="backup-db" data-box="#database-set" title="Refresh"><i class="fa fa-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body body-database-set">
			        	<div class="row">
		              		<div class="col-md-6">
		              			<strong>Backup Database</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div class="box box-default">
						            <div class="box-body">
						            	<table class="table no-margin table-backup-db">
						                	<thead>
												<tr>
													<th style="width: 100px">Backup File</th>
													<th class="text-center">Dibuat</th>
													<th class="text-center">Aksi</th>
												</tr>
						                  	</thead>
						                  	<tbody>
							                  	<tr>
								                    <td colspan="3" class="text-center">Memproses...</td>
							                  	</tr>
						                  	</tbody>
						                </table>
						            </div>
						            <div class="box-footer">
						            	<a href="#backup?dt=database" id="backup-db-btn" class="btn btn-default pull-right"><i class="fa fa-download"></i> Backup Database</a>
						            </div>
						        </div>
		              		</div>

		              		<div class="col-md-6">
		              			<strong>Backup Tabel Database</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<div class="box box-default">
						            <div class="box-body">
							            <div class="form-group" style="margin-top: 5px">
						                  <label>Table Database</label>
						                  <select class="form-control select2 select2_tbl_db" style="width: 100%;" name="tbl_db[]" multiple="multiple" data-placeholder="Pilih tabel database"></select>
						                </div>
						                <table class="table no-margin table-backup-tbl-db">
						                	<thead>
												<tr>
													<th style="width: 100px">Backup File</th>
													<th class="text-center">Dibuat</th>
													<th class="text-center">Aksi</th>
												</tr>
						                  	</thead>
						                  	<tbody>
							                  	<tr>
								                    <td colspan="3" class="text-center">Memproses...</td>
							                  	</tr>
						                  	</tbody>
						                </table>
						            </div>
						            <div class="box-footer">
						            	<a href="#backup?dt=table_db" id="backup-tbl-db-btn" class="btn btn-default pull-right disabled"><i class="fa fa-download"></i> Backup Tabel</a>
						            </div>
						        </div>
		              		</div>
		              	</div>
			        </div>
			        <!-- /.box-body -->
			        <div class="box-footer">
			        	<div class="row">
		            		<div class="col-md-12">
		            			<h5 class="text-center"><li class="fa fa-info-circle"></li>
		            				Jika database memiliki data yang sangat banyak, sebaiknya melakukan backup langsung di SQL Server via command line.
		            			</h5>
		            		</div>
		            	</div>
			        </div>
		      	</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section" id="akun-set" settings-section="akun-set" settings-box="#akun-set">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-user-circle"></span> Akun</h3>
						<div class="box-tools pull-right">
							<a href="<?php echo base_url('logout') ?>" class="btn btn-box-tool" title="Log Out"><i class="fa fa-sign-out"></i></a>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body">
			        	<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
								<strong>Detail Akun</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
								<dl class="dl-horizontal">
					                <dt>Username</dt>
					                <dd><?php echo $_SESSION['username']; ?></dd>

					                <dt>Status</dt>
					                <dd>
					                <?php if ($_SESSION['active_status'] == 1): ?>
					                	Aktif
					                <?php endif ?>
					                <?php if ($_SESSION['active_status'] == 0): ?>
					                	Tidak Aktif
					                <?php endif ?>
					                </dd>

					                <dt>Terakhir Online</dt>
					                <dd class="last-online-user-text"></dd>
				              	</dl>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
								<strong>Ganti Password</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
								<div class="form-group" id="old-password">
									<label for="old-password">Password Lama</label>
									<input type="password" class="form-control old-password" name="old-password" placeholder="Masukkan password lama">
				                </div>
				                <div class="form-group" id="new-password">
									<label for="new-password">Password Baru</label>
									<input type="password" class="form-control new-password" name="new-password" placeholder="Masukkan password baru">
				                </div>
				                <div class="form-group" id="confirm-password">
									<label for="confirm-password">Masukkan Ulang Password Baru</label>
									<input type="password" class="form-control confirm-password" name="confirm-password" placeholder="Masukkan ulang password baru">
				                </div>
				                <div class="form-group">
									<a href="" class="btn btn-success pull-right" id="update-pass-admin"><i class="fa fa-save"></i> Simpan Password</a>
				                </div>
							</div>
						</div>
			        </div>
		      	</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section">
			        <div class="box-body">
			        	<center>More settings soon...</center>
			        </div>
			        <!-- /.box-body -->
		      	</div>
			</div>
		</div>
	</section>

	<div class="modal style-2 modal-default fade" id="myModal" role="dialog" data-keyboard="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">
          	<form action="" class="hide-modal-content" id="form-input" form-data="config">
          		<div class="row">
		            <div class="col-md-6 col-xs-6">
		            	<div class="form-group" id="_web_name">
							<label for="_web_name">Nama Web</label>
							<input type="text" class="form-control _web_name" name="_web_name" placeholder="Masukkan nama web">
		                </div>
		                <div class="form-group" id="_pt_name">
							<label for="_pt_name">Nama Perguruan Tinggi</label>
							<input type="text" class="form-control _pt_name" name="_pt_name" placeholder="Masukkan nama perguruan tinggi">
		                </div>
		                <div class="form-group" id="_app_version">
							<label for="_app_version">App Version</label>
							<input type="text" class="form-control _app_version" name="_app_version" placeholder="Masukkan versi aplikasi">
		                </div>
			        </div>
			        <div class="col-md-6 col-xs-6">
			        	<div class="form-group" id="_template_assets">
							<label for="_template_assets">Template Assets Path</label>
							<input type="text" class="form-control _template_assets" name="_template_assets" placeholder="Masukkan alamat direktori aset template">
		                </div>
			        	<div class="form-group" id="_plugin_path">
							<label for="_plugin_path">Plugin Path</label>
							<input type="text" class="form-control _plugin_path" name="_plugin_path" placeholder="Masukkan alamat direktori plugin">
		                </div>
		                <div class="form-group" id="_app_environment">
							<label for="_app_environment">Status</label>
							<select class="form-control select2 select2_app_environment _app_environment" style="width: 100%;" name="_app_environment">
								<option value=""></option>
								<option value="Development">Development</option>
								<option value="Testing">Testing</option>
								<option value="Production">Production</option>
							</select>
		                </div>
			        </div>
			    </div>
			    <input type="hidden" name="data_konfigurasi">
          	</form>
          	<form action="" class="hide-modal-content" id="form-input-template">
          		<div class="row">
      				<section class="col-md-6">
      					<div class="form-group" id="template_name">
							<label for="template_name">Nama Template</label>
							<input type="text" class="form-control template_name" name="template_name" placeholder="Masukkan nama template">
		                </div>
		                <div class="form-group" id="template_directory">
							<label for="template_directory">Direktori Template</label>
							<input type="text" class="form-control template_directory" name="template_directory" placeholder="Masukkan direktori template">
		                </div>
      				</section>
      				<section class="col-md-6">
      					<div class="form-group" id="template_dev">
							<label for="template_dev">Pengembang Template</label>
							<input type="text" class="form-control template_dev" name="template_dev" placeholder="Masukkan nama pengembang template">
		                </div>
		                <div class="form-group" id="template_version">
							<label for="template_version">Versi Template</label>
							<input type="text" class="form-control template_version" name="template_version" placeholder="Masukkan versi template">
		                </div>
      				</section>
      				<div class="col-md-12">
      					<div class="form-group" id="template_description">
							<label for="template_description">Deskripsi Template</label>
							<textarea class="form-control template_description" name="template_description" placeholder="Masukkan deskripsi/keterangan template" rows="5"></textarea>
		                </div>
						<div class="form-group" id="template_image">
							<label for="template_image">Gambar Template</label>
							<input type="file" class="form-control" name="template_image" id="file-select-image-template">
						</div>
      				</div>
      			</div>
      			<input type="hidden" class="template_id" name="template_id">
      			<input type="hidden" name="data_template">
          	</form>
          	<form action="" class="hide-modal-content" id="form-input-menu">
          		<div class="row">
		            <div class="col-md-6 col-xs-6">
		            	<div class="form-group" id="nm_menu">
							<label for="nm_menu">Nama Menu</label>
							<input type="text" class="form-control nm_menu" name="nm_menu" placeholder="Masukkan nama menu">
		                </div>
		                <div class="form-group" id="level_access_menu">
							<label for="level_access_menu">Akses Menu</label>
							<select class="form-control select2 select2_lvl_access_menu level_access_menu" style="width: 100%;" name="level_access_menu">
								<option value=""></option>
								<option value="admin">Admin</option>
								<option value="user">User</option>
								<option value="mhs">Mahasiswa</option>
								<option value="ptk">Tenaga Pendidik</option>
							</select>
		                </div>
			        </div>
			        <div class="col-md-6 col-xs-6">
			        	<div class="row">
			        		<div class="col-md-12">
			        			<div class="form-group" id="status_access_menu">
									<label for="status_access_menu">Status Akses Menu</label>
									<select class="form-control select2 select2_status_access_menu status_access_menu" style="width: 100%;" name="status_access_menu">
										<option value=""></option>
										<option value="0">Dalam Pengembangan</option>
										<option value="1">Aktif</option>
										<option value="2">Beta</option>
										<option value="3">Dalam Perbaikan</option>
									</select>
				                </div>
			        		</div>
				        	<div class="col-md-6">
					        	<div class="form-group" id="color_menu">
									<label for="color_menu">Color Menu</label>
									<input type="text" class="form-control color_menu color-input-text" name="color_menu" placeholder="Masukkan kode warna, Contoh: #39cccc">
				                </div>
				        	</div>
				        	<div class="col-md-6">
					        	<div class="form-group" id="icon_menu">
									<label for="icon_menu">Icon Menu</label>
									<div class="input-group">
						                <input type="text" class="form-control icon_menu icon-input-text" name="icon_menu" placeholder="Contoh: fa fa-dashboard">
						                <span class="input-group-addon icon_menu_review"><i class=""></i></span>
						            </div>
				                </div>
				        	</div>
				        </div>
			        </div>
			        <div class="col-md-12">
			        	<div class="form-group" id="link_menu">
							<label for="link_menu" style="word-wrap: break-word;">Link Menu</label>
							<input type="text" class="form-control link_menu" name="link_menu" placeholder="Contoh: data_menu">
							<!-- <p class="help-block link_preview" style="color:white"></p> -->
		                </div>
			        </div>
		        </div>
		        <input type="hidden" class="id_menu" name="id_menu">
		        <input type="hidden" name="data_menu">
          	</form>
          	<form action="" class="hide-modal-content" id="form-input-sub-menu">
          		<div class="row">
		            <div class="col-md-6 col-xs-6">
		            	<div class="form-group" id="id_parent_menu">
							<label for="id_parent_menu">Parent Menu</label>
							<select class="form-control select2 select2-remote-dt select2_parent_menu id_parent_menu" style="width: 100%;" name="id_parent_menu"></select>
		                </div>
		            	<div class="form-group" id="nm_sub_menu">
							<label for="nm_sub_menu">Nama Sub Menu</label>
							<input type="text" class="form-control nm_sub_menu" name="nm_sub_menu" placeholder="Masukkan nama sub menu">
		                </div>
			        </div>
			        <div class="col-md-6 col-xs-6">
			        	<div class="form-group" id="status_access_sub_menu">
							<label for="status_access_sub_menu">Status Akses Sub Menu</label>
							<select class="form-control select2 select2_status_access_sub_menu status_access_sub_menu" style="width: 100%;" name="status_access_sub_menu">
								<option value=""></option>
								<option value="0">Dalam Pengembangan</option>
								<option value="1">Aktif</option>
								<option value="2">Beta</option>
								<option value="3">Dalam Perbaikan</option>
							</select>
		                </div>
		                <div class="form-group" id="icon_sub_menu">
							<label for="icon_sub_menu">Icon Sub Menu</label>
							<div class="input-group">
				                <input type="text" class="form-control icon_sub_menu icon-sub-input-text" name="icon_sub_menu" placeholder="Contoh: fa fa-dashboard">
				                <span class="input-group-addon icon_sub_menu_review"><i class=""></i></span>
				            </div>
		                </div>
			        </div>
			        <div class="col-md-12">
			        	<div class="form-group" id="link_sub_menu">
							<label for="link_sub_menu" style="word-wrap: break-word;">Link Sub Menu</label>
							<input type="text" class="form-control link_sub_menu" name="link_sub_menu" placeholder="Contoh: data_menu">
							<!-- <p class="help-block link_preview" style="color:white"></p> -->
		                </div>
			        </div>
		        </div>
		        <input type="hidden" class="id_sub_menu" name="id_sub_menu">
		        <input type="hidden" name="data_sub_menu">
          	</form>
          	<form action="" class="hide-modal-content" id="backup-form" form-data='backup-db'>
          		<table>
          			<tr>
          				<td valign="top"><li class="fa fa-exclamation-circle"></li></td>
          				<td>&nbsp</td>
          				<td>Silahkan masukkan username dan password admin anda untuk melakukan backup.</td>
          			</tr>
          			<tr>
          				<td valign="top"><li class="fa fa-exclamation-circle"></li></td>
          				<td>&nbsp</td>
          				<td>Tidak memilih opsi backup data akan dianggap membackup dengan data.</td>
          			</tr>
          			<tr>
          				<td valign="top"><li class="fa fa-exclamation-circle"></li></td>
          				<td>&nbsp</td>
          				<td>Jika database memiliki data yang sangat banyak, sebaiknya melakukan backup langsung di SQL Server via command line.</td>
          			</tr>
          		</table>
          		<div class="form-group centered-content" style="margin-top: 5px">
                	<div class="form-group">
					<label>
	                  <input type="radio" class="backup_db_opsi" name="backup_db_option" value="TRUE">
	                  Backup dengan data
	                </label>&nbsp&nbsp
	                <label>
	                  <input type="radio" class="backup_db_opsi" name="backup_db_option" value="FALSE">
	                  Backup tanpa data
	                </label>
	                </div>
				</div>
          		<hr style="margin-top: -25px">
          		<div class="row">
	          		<div class="col-md-6 col-xs-6">
	          			<div class="form-group">
		                  <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
		                    <input type="text" class="form-control" placeholder="Username" name="username">
		                  </div>
		                </div>
	          		</div>
	          		<div class="col-md-6 col-xs-6">
	          			<div class="form-group">
		                  <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
		                    <input type="password" class="form-control" placeholder="Password" name="password">
		                  </div>
		                </div>
	          		</div>
          		</div>
          	</form>
          	<div class="data-message">
            	<div class="centered-content content-message"></div>
            </div>
          	<div class="row centered-content">
	            <div class="col-md-12 col-xs-12">
	            	<div id="alert-place">
					</div>
				</div>
			</div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline cancel" id="batal" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-outline submit submit-btn" id="submit">Backup Database</button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

<?php echo get_templete_part('template_part/footer'); ?>
