<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
		      	<div class="box box-solid set-section" id="config-set" settings-section="config" settings-box="#config-set">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-gear"></span> Konfigurasi Umum</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool info" data-info="config-set"><i class="fa fa-exclamation-circle"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body body-database-set">
			        	<div class="row">
		              		<div class="col-md-6">
		              			<strong>Backup Database</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              		</div>

		              		<div class="col-md-6">
		              			<strong>Backup Tabel Database</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
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
		      	<div class="box box-solid set-section" id="menu-set" settings-section="menu-set" settings-box="#menu-set" collapse-filter="true">
			        <div class="box-header">
			          	<h3 class="box-title setting-label"><span class="fa fa-list"></span> Menu</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool info" data-info="backup-db"><i class="fa fa-exclamation-circle"></i></button>
							<button type="button" class="btn btn-box-tool refresh-data" data-refresh="list-menu" title="Refresh List Menu"><i class="fa fa-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus collapse-icon"></i></button>
						</div>
			        </div>
			        <!-- /.box-header -->
			        <div class="box-body body-menu-set">
			        	<div class="row">
		              		<div class="col-md-6">
		              			<strong>Administrator</strong>
		              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
		              			<ul class="todo-list list-menu-container" style="margin-bottom: 10px" id="admin-list-menu">
				              	</ul>
		              		</div>

		              		<div class="col-md-6">
		              			<strong>User</strong>
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
						            	<a class="btn btn-default pull-right backup_db"><i class="fa fa-download"></i> Backup Database</a>
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
						            	<a class="btn btn-default pull-right backup_db_tbl disabled"><i class="fa fa-download"></i> Backup Tabel</a>
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
            <h4 class="modal-title">Backup Database</h4>
          </div>

          <div class="modal-body">
          	<form action="" form-data='backup-db'>
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
          	<div class="row centered-content">
	            <div class="col-md-12 col-xs-12">
	            	<div id="alert-place">
					</div>
				</div>
			</div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline cancel" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-outline submit submit-btn" id="backup_db">Backup Database</button>            
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

<?php echo get_templete_part('template_part/footer'); ?>