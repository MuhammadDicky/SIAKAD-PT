<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<section class="col-md-3">
		      <div class="box box-success box-solid control-panel-data-tbl">
		        <div class="box-header with-border">
		          	<h3 class="box-title">Control Panel</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
		        </div>
		        <!-- /.box-header -->
		        <div class="box-body">
					<div class="row" style="margin-bottom:-15px">
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  <label for="thn_angkatan">Tampilkan</label>
			                  <!-- <input class="form-control" type="text" name="wali_kelas"> -->
			                  <select class="form-control select2 select2_tamp" style="width: 100%;">
			                  	<option value="5">5 Data</option>
			                  	<option value="10">10 Data</option>
			                  	<option value="25">25 Data</option>
			                  	<option value="30">30 Data</option>
			                  	<option value="45">45 Data</option>
			                  	<option value="50">50 Data</option>
			                  </select>
			                </div>
						</div>
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  <label>Cari</label>
			                  <div class="input-group">
					                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Data Pengunjung">
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-success btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
				                    </span>
					            </div>
			                </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 semua-data" style="display: none;">
			      			<div class="form-group">
			                  <a href="" class="btn btn-success btn-block" id="semua-data" table-refresh=".tbl-pengunjung-mhs, .tbl-pengunjung-ptk"><i class="fa fa-list"></i> Tampilkan Semua Data</a>
			                </div>
			            </div>
					</div>
					<hr style="border-bottom: 2px solid grey">
					<div class="row" style="margin-bottom:-15px">
		            	<div class="col-md-12 col-xs-6">
			      			<div class="form-group">
			                  <label>Browser</label>
			                  <select class="form-control select2 select2_browser select2_src_dt" name="browser" style="width: 100%;">
			                  	<option value=""></option>
			                  	<option value="Chrome">Chrome</option>
			                  	<option value="Mozilla">Mozilla Firefox</option>
			                  	<option value="Edge">Microsoft Edge</option>
			                  	<option value="Internet Explorer">Internet Explorer</option>
			                  	<option value="Safari">Safari</option>
			                  	<option value="Opera">Opera</option>
			                  	<option value="other-browser">Lainnya</option>
			                  </select>
			                </div>
			            </div>
			            <div class="col-md-12 col-xs-6">
			      			<div class="form-group">
			                  <label>Platform</label>
			                  <select class="form-control select2 select2_platform select2_src_dt" name="platform" style="width: 100%;">
			                  	<option value=""></option>
			                  	<option value="Windows">Windows</option>
			                  	<option value="Linux">Linux</option>
			                  	<option value="Android">Android</option>
			                  	<option value="IOS">IOS</option>
			                  	<option value="MAC OS X">MAC OS X</option>
			                  	<option value="other-platform">Lainnya</option>
			                  </select>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-12 col-xs-12">
			            	<div class="form-group">
			                  <a href="" class="btn btn-success btn-block disabled" id="tamp-data" table-refresh=".tbl-pengunjung-mhs, .tbl-pengunjung-ptk"><i class="fa fa-list"></i> Tampilkan Data</a>
			                </div>
			            </div>
		            </div>
		        </div>
		        <!-- /.box-body -->
		      </div>			              	
			</section>
			<section class="col-md-9">
				<div class="box box-solid box-success box-data-visitors" id="box-content">
			        <div class="box-header">
						<h3 class="box-title">Data Pengunjung</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" id="refresh-table-visitors" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">			        	
			        	<div class="row">
			        		<div class="col-md-12">
					            <div class="nav-tabs-custom nav-success">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#visitors-mhs" data-toggle="tab" aria-expanded="true"><span class="fa fa-list"></span> Mahasiswa</a></li>
						              <li><a href="#visitors-ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Tenaga Pendidik</a></li>
						            </ul>
						            <div class="tab-content">
									  	<div class="tab-pane active" id="visitors-mhs">
										  	<div class="row">
							                  	<div class="col-md-12">
							                        <table class="table table-bordered table-striped table-hover datatable-dt tbl-pengunjung-mhs" table-dt=".tbl-pengunjung-mhs" table-box="#box-content" data-search="mhs">
										                <thead>
											                <tr>
											                	<th style="width: 5px"></th>
																<th>Username</th>
																<th>Nama</th>
																<th>Browser</th>
																<th>Terakhir Online</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="5" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                	<th></th>
																<th>Username</th>
																<th>Nama</th>
																<th>Browser</th>
																<th>Terakhir Online</th>
											                </tr>
										                </tfoot>
										            </table>
							                  	</div>
						                    </div>
						              	</div>
						              	<!-- /.tab-pane -->
						              	<div class="tab-pane fade" id="visitors-ptk">
						              		<div class="row">
						              			<div class="col-md-12">
								                	<table class="table table-bordered table-striped table-hover datatable-dt tbl-pengunjung-ptk" table-dt=".tbl-pengunjung-ptk" table-box="#box-content" data-search="ptk">
										                <thead>
											                <tr>
											                	<th style="width: 5px"></th>
																<th>Username</th>
																<th>Nama</th>
																<th>Browser</th>
																<th>Terakhir Online</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="5" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                	<th></th>
																<th>Username</th>
																<th>Nama</th>
																<th>Browser</th>
																<th>Terakhir Online</th>
											                </tr>
										                </tfoot>
										            </table>
								                </div>
											</div>
						              	</div>
						              	<!-- /.tab-pane -->			              
						            </div>
						            <!-- /.tab-content -->
							    </div>
			        		</div>
			        	</div>				        	
			        </div><!-- /.box-body -->
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
			    </div>
			</section>
		</div>		
	</section>

	<!-- modal open -->
    <div class="modal modal-info fade" id="myModal" role="dialog" data-keyboard="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">  
          	<div class="row centered-content">
          		<div class="col-xs-5">		            
		            <div id="alert-place">		                	               
					</div>
	            </div>
            </div>
            <div class="data-message">
            	<div class="centered-content"></div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-dismiss="modal" id="batal">Batal</button>
            <button type="button" class="btn btn-outline submit-btn" id="submit"></button>
            <button type="button" class="btn btn-outline submit-again-btn" id="submit-again">Simpan dan Tambah</button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- modal end -->

<?php echo get_templete_part('template_part/footer'); ?>