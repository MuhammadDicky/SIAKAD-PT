<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-danger" id="box-content">
			        <div class="box-header">
						<h3 class="box-title">Data Fakultas dan Program Studi</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" id="refresh-table-fk" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">
			        	<div class="row">
			        		<div class="col-md-12">
			        			<div class="box box-danger box-mp-controlp">
						            <div class="box-header with-border">
						              <h3 class="box-title">Control Panel</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						                </button>
						              </div>
						              <!-- /.box-tools -->
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body" style="display: block;">
						            	<div class="row">
						            		<div class="col-md-12">
						            			<div class="control-panel-data">
							            			<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
							            			<a href="#tambah" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Fakultas</a> 
							            			<a href="#delete_selected?fk" class="btn btn-danger disabled hapus"><i class="fa fa-trash"></i> hapus</a> | 
							            			<a href="#tambah?prodi" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Program Studi</a> 
							            			<a href="#" class="btn btn-warning refresh-table-pd"><i class="fa fa-list"></i> Daftar Program Studi</a> 
							            			<a href="#delete_selected?pd" class="btn btn-danger hapus-prodi disabled"><i class="fa fa-trash"></i> hapus</a>
						            			</div>
						            		</div>
						            	</div>
						            </div>
						            <!-- /.box-body -->
								</div>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-md-12">
					            <div class="nav-tabs-custom nav-danger">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#daftar-fk" data-toggle="tab" aria-expanded="true"><span class="fa fa-list"></span> Daftar Fakultas</a></li>
						              <li><a href="#statik-fk" data-toggle="tab" aria-expanded="false"><span class="fa fa-bar-chart"></span> Statistik Fakultas</a></li>
						            </ul>
						            <div class="tab-content">
									  <div class="tab-pane active" id="daftar-fk">
									  	<div class="row">
									  		<div class="col-md-12">
									  			<table class="table table-bordered table-striped table-hover tbl-data-fk datatable-dt" table-dt=".tbl-data-fk" data-tbl-selected="check-all-fk check-fk" table-box="#box-content">
									                <thead>
										                <tr>
										                  <th style="width: 10px"><input type="checkbox" class="check-all-data check-all-fk" data-selected="check-fk" data-all-selected="check-all-fk" data-toggle=".hapus"></th>
										                  <th>Nama Fakultas</th>
										                  <th>Dekan</th>					                  
										                  <th style="width: 130px">Tanggal Berdiri</th>
										                  <th style="width: 50px">Akreditasi</th>
										                  <th style="width: 160px">Aksi</th>
										                </tr>
									                </thead>
									                <tbody>
										                <tr>
										                	<td colspan="7" align="center">Memproses Data</td>
										                </tr>					                					                
									                </tbody>
									                <tfoot>
										                <tr>			
										                  <th><input type="checkbox" class="check-all-data check-all-fk" data-selected="check-fk" data-all-selected="check-all-fk" data-toggle=".hapus"></th>
										                  <th>Nama Fakultas</th>
										                  <th>Dekan</th>					                  
										                  <th>Tanggal Berdiri</th>
										                  <th>Akreditasi</th>
										                  <th>Aksi</th>
										                </tr>
									                </tfoot>
									            </table>
									  		</div>
										</div>
						              </div> 
						              <!-- /.tab-pane -->
						              <div class="tab-pane fade" id="statik-fk">
					              		<div class="row chart-container">
					              			<div class="col-md-8 col-sm-8">
							                  <div class="pad">
							                  	<p class="text-center"><strong class="title-thn-ak-static">Data Statistik Mahasiswa Berdasarkan Fakultas</strong></p>
							                    <div class="chart">
									                <canvas id="barchart-mhs-master-dt" style="height: 315px; width: 510px;"></canvas>
									            </div>
							                  </div>
							                </div>
							                <div class="col-md-4 col-sm-4">
							                  	<div class="pad content-responsive style-2 detail-jml-mhs-dt" style="height: 375px">
								                </div>
							                </div>
										</div>
						              </div>
						              <!-- /.tab-pane -->			              
						            </div>
						            <!-- /.tab-content -->
							    </div>
			        		</div>			        		
			        	</div>

			        	<div class="row">
			        		<div class="col-md-12">
			        			<div class="box box-danger" id="box-detail-fk" style="display: none;">
						            <div class="box-header with-border">
						              <h3 class="box-title">Detail Data Fakultas</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool remove" data-widget="remove"><i class="fa fa-times"></i></button>
						              </div>
						              <!-- /.box-tools -->
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body">
						            	<div class="row">
							            	<div class="col-md-4">
								            	<div class="box box-widget widget-user">										            
										            <div class="widget-user-header bg-red" style="height: 93px">
										              <h3 class="widget-user-username">Fakultas</h3>
										              <h4 class="widget-user-desc detail-fak-nama_fakultas detail-fak"></h4>
										            </div>
										            <div class="box-footer no-padding">
										              <ul class="nav nav-stacked">										                
										                <li><a>Dekan <span class="pull-right detail-fak-dekan detail-fak"></span></a></li>
										                <li><a>Tanggal Berdiri <span class="pull-right detail-fak-tgl_berdiri detail-fak"></span></a></li>
										                <li><a>Akreditasi <span class="pull-right detail-fak-akreditasi_fk detail-fak"></span></a></li>
										                <li><a>Jumlah Mahasiswa <span class="pull-right"><span><span class="fa fa-users"></span> <span class="detail-fak-jml_mhs"></span></span></span>
										                	</a>
									                	</li>
									                	<li><a>Mahasiswa Laki-Laki <span class="pull-right"><span><span class="fa fa-male"></span> <span class="detail-fak-jml_lk"></span></span></span>
										                	</a>
									                	</li>
									                	<li><a>Mahasiswa Perempuan<span class="pull-right"><span><span class="fa fa-female"></span> <span class="detail-fak-jml_pr"></span></span></span>
										                	</a>
									                	</li>
										              </ul>
										            </div>
										        </div>
							            	</div>
							            	<div class="col-md-8">
							            		<div class="nav-tabs-custom nav-danger" id="tab-detail-fk">
										            <ul class="nav nav-tabs">
										              <li class="active open-tab daftar-prodi"><a href="#daftar-prodi" data-toggle="tab" aria-expanded="true"><span class="fa fa-building-o"></span> Program Studi</a></li>
										              <li class="detail-prodi close-tab" style="display: none;"><a href="#detail-prodi" data-toggle="tab" aria-expanded="false">Detail Prodi</a></li>
										              <li class="close-dt-pd-bt" style="margin-left: -10px; display: none;"><a><span class="fa fa-times close-detail-pd" style="line-height: 20px" title="Tutup tab detail prodi"></span></a></li>
										            </ul>
										            <div class="tab-content">
													  	<div class="tab-pane open-dt-tab active style-1" id="daftar-prodi">
														  	<div class="row">
											            		<div class="col-md-12">
											            			<table class="table table-bordered tbl-data-prodi">
														                <thead>
															                <tr>
															                  <!-- <th><center><input type="checkbox" class="check-all-prodi"></center></th> -->
															                  <th class="text-center">No.</th>
															                  <th class="text-center" style="width: 100px">Kode Prodi</th>
															                  <th style="width: 200px">Nama Program Studi</th>
															                  <th class="text-center">Status</th>
															                  <th class="text-center">Jenjang</th>
															                  <th class="text-center" style="width: 165px">Aksi</th>
															                </tr>
														                </thead>
														                <tbody>
															                <tr>
															                	<td colspan="6" align="center">Memproses Data</td>
															                </tr>
														                </tbody>
														                <tfoot>
															                <tr>
															                  <!-- <th><center><input type="checkbox" class="check-all-prodi"></center></th> -->
															                  <th class="text-center">No.</th>
															                  <th class="text-center">Kode Prodi</th>
															                  <th>Nama Program Studi</th>
															                  <th class="text-center">Status</th>
															                  <th class="text-center">Jenjang</th>
															                  <th class="text-center">Aksi</th>
															                </tr>
														                </tfoot>
														            </table>
											            		</div>
											            	</div>
										              	</div> 
										              	<!-- /.tab-pane -->
										              	<div class="tab-pane close-dt-tab style-1" id="detail-prodi">
										              		<div class="row">
																<div class="col-md-12">
																	<div class="box box-solid box-danger">
															            <div class="box-header with-border">
															              <h3 class="box-title">Informasi Umum</h3>
															              <div class="box-tools pull-right">
															                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
															                </button>
															              </div>
															            </div>
															            <!-- /.box-header -->
															            <div class="box-body">
															            	<dl class="dl-horizontal">
																                <dt>Fakultas</dt>
																                <dd class="nama_fakultas"></dd>

																                <dt>Kode Program Studi</dt>
																                <dd class="kode_prodi"></dd>

																                <dt>Nama Program Studi</dt>
																                <dd class="nama_prodi"></dd>

																                <dt>Nama Ketua Prodi</dt>
																                <dd class="nama_kprodi"></dd>

																                <dt>Jenjang</dt>
																                <dd class="jenjang_prodi"></dd>

																                <dt>Akreditas</dt>
																                <dd class="akreditasi_prodi"></dd>

																                <dt>Status</dt>
																                <dd class="status"></dd>

																                <dt>SK Penyelenggaraan</dt>
																                <dd class="sk_peny_prodi"></dd>

																                <dt>Tanggal SK</dt>
																                <dd class="tgl_sk_prodi"></dd>

																                <dt>Tanggal Berdiri</dt>
																                <dd class="tgl_berdiri_prodi"></dd>

																                <dt>Jumlah Mahasiswa</dt>
																                <dd>
																                	<span>
																	                	<span class="fa fa-users"></span> 
																	                	<span class="jml_mhs"></span>
																                	</span>
																                </dd>

																                <dt>Mahasiswa Laki-Laki</dt>
																                <dd>
																                	<span>
																	                	<span class="fa fa-male"></span> 
																	                	<span class="jml_lk"></span>
																                	</span>
																                </dd>

																                <dt>Mahasiswa Perempuan</dt>
																                <dd>
																                	<span>
																	                	<span class="fa fa-female"></span> 
																	                	<span class="jml_pr"></span>
																                	</span>
																                </dd>
																            </dl>
															            </div>
															            <!-- /.box-body -->
															        </div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<div class="box box-solid box-danger">
															            <div class="box-header with-border">
															              <h3 class="box-title">Kontak</h3>
															              <div class="box-tools pull-right">
															                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
															                </button>
															              </div>
															            </div>
															            <!-- /.box-header -->
															            <div class="box-body">
															            	<dl class="dl-horizontal">
															            		<dt>Alamat</dt>
																                <dd class="alamat_prodi"></dd>

																                <dt>Kode POS</dt>
																                <dd class="kode_pos_prodi"></dd>

																                <dt>Telepon</dt>
																                <dd class="telpon_prodi"></dd>

																                <dt>Fax</dt>
																                <dd class="fax_prodi"></dd>

																                <dt>Email</dt>
																                <dd class="email_prodi"></dd>

																                <dt>Website</dt>
																                <a href="" target="blank"><dd class="website_prodi"></dd></a>
																            </dl>
															            </div>
															            <!-- /.box-body -->
															        </div>
																</div>
															</div>
															<div class="row" >
																<div class="col-md-12">
																	<div class="box box-solid box-danger box-konsentrasi-pd" style="display: none">
															            <div class="box-header with-border">
															              <h3 class="box-title">Konsentrasi Program Studi</h3>
															              <div class="box-tools pull-right">
															                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
															                </button>
															              </div>
															            </div>
															            <!-- /.box-header -->
															            <div class="box-body">
															            	<table class="table table-bordered table-striped table-hover tbl-data-konst-pd">
																                <thead>
																	                <tr>
																	                  <th class="text-center" style="width: 5px">No</th>
																	                  <th style="width: 300px">Nama Konsentrasi</th>
																	                  <th class="text-center" style="width: 110px">Aksi</th>
																	                </tr>
																                </thead>
																                <tbody>
																	                <tr>
																	                	<td colspan="3" align="center">Memproses Data</td>
																	                </tr>
																                </tbody>
																                <tfoot>
																	                <tr>
																	                  <th class="text-center">No</th>
																	                  <th>Nama Konsentrasi</th>
																	                  <th class="text-center">Aksi</th>
																	                </tr>
																                </tfoot>
																            </table>
															            </div>
															            <!-- /.box-body -->
															        </div>
																</div>
															</div>
										              	</div>
										              	<!-- /.tab-pane -->			              
										            </div>
										            <!-- /.tab-content -->
											    </div>
							            	</div>
						            	</div>     	
						            </div>
						            <!-- /.box-body -->		
						            <div class="overlay">
									  <i class="fa fa-refresh fa-spin"></i>
									</div>				            
								</div>
			        		</div>
			        	</div>
			        </div><!-- /.box-body -->
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
			    </div>
			</div>		
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-danger" id="box-prodi" style="display: none;">
			        <div class="box-header">
						<h3 class="box-title">Daftar Program Studi</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool refresh-table-pd" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">
			        	<table class="table table-bordered table-striped table-hover tbl-data-pd datatable-dt" table-dt=".tbl-data-pd" data-tbl-selected="check-all-prodi check-prodi" table-box="#box-prodi">
			                <thead>
				                <tr>
				                  <th style="width: 5px"></th>
				                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-prodi" data-selected="check-prodi" data-all-selected="check-all-prodi" data-toggle=".hapus-prodi"></th>
				                  <th class="text-center" style="width: 100px">Kode Prodi</th>
				                  <th style="width: 300px">Nama Program Studi</th>
				                  <th class="text-center">Status</th>
				                  <th class="text-center">Jenjang</th>
				                  <th class="text-center">Mahasiswa</th>
				                  <th class="text-center" style="width: 110px">Aksi</th>
				                </tr>
			                </thead>
			                <tbody>
				                <tr>
				                	<td colspan="8" align="center">Memproses Data</td>
				                </tr>
			                </tbody>
			                <tfoot>
				                <tr>
				                  <th></th>
				                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-prodi" data-selected="check-prodi" data-all-selected="check-all-prodi" data-toggle=".hapus-prodi"></th>
				                  <th class="text-center">Kode Prodi</th>
				                  <th>Nama Program Studi</th>
				                  <th class="text-center">Status</th>
				                  <th class="text-center">Jenjang</th>
				                  <th class="text-center">Mahasiswa</th>
				                  <th class="text-center">Aksi</th>
				                </tr>
			                </tfoot>
			            </table>
			        </div><!-- /.box-body -->
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
			    </div>
			</div>		
		</div>
	</section>

	<div class="modal style-2 fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">            
            <form action="" id="form-input" style="display: none;">
		        <div class="row">
	            	<section class="col-md-6 col-xs-6">
		                <div class="form-group" id="nama_fakultas">
		                  <label for="nama_fakultas">Fakultas</label>
		                  <input type="text" class="form-control nama_fakultas" name="nama_fakultas" placeholder="Masukkan nama fakultas">
		                </div>
		                <div class="form-group" id="dekan">
		                  <label for="dekan">Dekan</label>
		                  <input type="text" class="form-control dekan" name="dekan" placeholder="Masukkan nama dekan">
		                </div>		                
					</section>
	                <section class="col-md-6 col-xs-6">
		                <div class="form-group" id="tgl_berdiri">
							<label for="tgl_berdiri">Tanggal Berdiri</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right datepicker tgl_berdiri" name="tgl_berdiri" placeholder="Contoh: 1995-08-14">
							</div>
		                </div>
		                <div class="form-group" id="akreditasi_fk">
		                  <label for="akreditasi_fk">Akreditas</label>
		                  <select class="form-control select2 select2_akreditasi_fk akreditasi_fk" style="width: 100%;" name="akreditasi_fk">
		                  	<option value=""></option>
		                  	<option value="A">A</option>
		                  	<option value="B">B</option>
		                  	<option value="C">C</option>		                  	
		                  </select>
		                </div>
					</section>
		        </div>
		        <input type="hidden" id="data" name="data_fakultas">              		        
		        <input type="hidden" class="id_fk" name="id_fk">		        
            </form>
            <form action="" id="form-input-pstudi" style="display: none;">
	            <div class="row">
	            	<div class="col-md-12">
			          <!-- Custom Tabs -->
				        <div class="nav-tabs-custom nav-info">
				            <ul class="nav nav-tabs">
				              <li class="active tab_umum_prodi open-tab"><a href="#tab_umum_prodi" data-toggle="tab" aria-expanded="true">Umum</a></li>
				              <li class="tab_kontak_prodi close-tab"><a href="#tab_kontak_prodi" data-toggle="tab" aria-expanded="false">Kontak</a></li>
				              <li class="pull-right"><a href="" class="text-muted" id="refresh-form"><i class="glyphicon glyphicon-refresh"></i></a></li>
				            </ul>
				            <div class="tab-content">
								<div class="tab-pane active open-dt-tab" id="tab_umum_prodi">
									<div class="tab-overflow-container default-overflow-container">
										<div class="row">
											<section class="col-md-6 col-xs-6">
												<div class="form-group" id="id_fk_pd">
								                  <label for="id_fk_pd">Fakultas</label>
								                  <select class="form-control select2 select2-remote-dt select2_fk id_fk_pd" style="width: 100%;" name="id_fk_pd">
								                  </select>
								                </div>
												<div class="form-group" id="kode_prodi">
													<label for="kode_prodi">Kode Program Studi</label>
													<input type="number" class="form-control kode_prodi" name="kode_prodi" placeholder="Masukkan kode program studi">
								                </div>
								                <div class="form-group" id="nama_prodi">
													<label for="nama_prodi">Nama Program Studi</label>
													<input type="text" class="form-control nama_prodi" name="nama_prodi" placeholder="Masukkan nama program studi">
								                </div>
								                <div class="form-group" id="nama_kprodi">
													<label for="nama_kprodi">Nama Ketua Prodi</label>
													<input type="text" class="form-control nama_kprodi" name="nama_kprodi" placeholder="Masukkan nama ketua prodi">
								                </div>
								                <div class="form-group" id="jenjang_prodi">
								                  <label for="jenjang_prodi">Jenjang</label>
								                  <select class="form-control select2 select2_jenjang jenjang_prodi" style="width: 100%;" name="jenjang_prodi">
								                  	<option value=""></option>
								                  	<option value="S1">S1</option>
								                  	<option value="S2">S2</option>
								                  	<option value="S3">S3</option>		                  	
								                  </select>
								                </div>							                
											</section>
							                <section class="col-md-6 col-xs-6">
							                	<div class="form-group" id="akreditasi_prodi">
								                  <label for="akreditasi_prodi">Akreditasi</label>
								                  <select class="form-control select2 select2_akreditasi_prodi akreditasi_prodi" style="width: 100%;" name="akreditasi_prodi">
								                  	<option value=""></option>
								                  	<option value="A">A</option>
								                  	<option value="B">B</option>
								                  	<option value="C">C</option>		                  	
								                  </select>
								                </div>
								                <div class="form-group" id="status_prodi">
								                  <label for="status_prodi">Status Prodi</label>
								                  <select class="form-control select2 select2_status_prodi status_prodi" style="width: 100%;" name="status_prodi">
								                  	<option value=""></option>
								                  	<option value="1">Aktif</option>
								                  	<option value="0">Tidak Aktif</option>							                  	
								                  </select>
								                </div>
								                <div class="form-group" id="sk_peny_prodi">
													<label for="sk_peny_prodi">SK Penyelenggaraan</label>
													<input type="text" class="form-control sk_peny_prodi" name="sk_peny_prodi" placeholder="Masukkan nomor SK">
								                </div>
								                <div class="form-group" id="tgl_sk_prodi">
													<label for="tgl_sk_prodi">Tanggal SK</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right datepicker tgl_sk_prodi" name="tgl_sk_prodi" placeholder="Contoh: 1995-08-14">
													</div>
								                </div>
								                <div class="form-group" id="tgl_berdiri_prodi">
													<label for="tgl_berdiri_prodi">Tanggal Berdiri</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right datepicker tgl_berdiri_prodi" name="tgl_berdiri_prodi" placeholder="Contoh: 1995-08-14">
													</div>
								                </div>
											</section>
						                </div>
						            </div>
				              	</div> 
				              <!-- /.tab-pane -->
								<div class="tab-pane close-dt-tab" id="tab_kontak_prodi">				              	
									<div class="row">
										<section class="col-md-6 col-xs-6">
											<div class="form-group">
												<label for="alamat_prodi">Alamat</label>
												<input type="text" class="form-control alamat_prodi" name="alamat_prodi" placeholder="Masukkan alamat prodi">
										    </div>
										    <div class="form-group">
												<label for="kode_pos_prodi">Kode POS</label>
												<input type="number" class="form-control kode_pos_prodi" name="kode_pos_prodi" placeholder="Contoh: 91921">
										    </div>
										    <div class="form-group">
												<label for="telpon_prodi">Telepon</label>
												<input type="number" class="form-control telpon_prodi" name="telpon_prodi" placeholder="Contoh: 91921">
										    </div>
										</section>
										<section class="col-md-6 col-xs-6">
											<div class="form-group">
												<label for="fax_prodi">FAX</label>
												<input type="text" class="form-control fax_prodi" name="fax_prodi" placeholder="Masukkan FAX prodi">
										    </div>
										    <div class="form-group">
												<label for="email_prodi">Email</label>
												<input type="email" class="form-control email_prodi" name="email_prodi" placeholder="Masukkan alamat email prodi">
										    </div>
										    <div class="form-group">
												<label for="website_prodi">Website</label>
												<input type="text" class="form-control website_prodi" name="website_prodi" placeholder="Masukkan alamat website prodi">
										    </div>
										</section>
									</div>								
								</div>				              
				            </div>
				            <!-- /.tab-content -->
				        </div>
				        <!-- nav-tabs-custom -->
			        </div>	            	
		        </div>		        
		        <input type="hidden" id="data_prodi" name="data_prodi">
		        <input type="hidden" class="id_prodi" name="id_prodi">
		        <input type="hidden" class="kode_prodi" name="kd_pds">
            </form>
            <form action="" id="form-input-konsentrasi-pd" style="display: none;">
		        <div class="row">
	            	<div class="col-md-6 col-xs-6">
		                <div class="form-group" id="id_pd_konst">
		                  	<label for="id_pd_konst">Program Studi</label>
			                <select class="form-control select2 select2-remote-dt select2_prodi id_pd_konst" style="width: 100%;" name="id_pd_konst"></select>
		                </div>
		            </div>	
	                <div class="col-md-6 col-xs-6">
		                <div class="form-group" id="nm_konsentrasi">
		                  <label for="nm_konsentrasi">Konsentrasi</label>
		                  <input type="text" class="form-control nm_konsentrasi" name="nm_konsentrasi" placeholder="Masukkan nama konsentrasi">
		                </div>		                
					</div>
		        </div>
		        <input type="hidden" id="data" name="data_konsentrasi_pd">              		        
		        <input type="hidden" class="id_konst" name="id_konst">
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
            <button type="button" class="btn btn-outline" data-dismiss="modal" id="batal">Batal</button>
            <button type="button" class="btn btn-outline submit-btn" id="submit"></button>
            <button type="button" class="btn btn-outline submit-again-btn" id="submit-again">Simpan dan Tambah</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


<?php echo get_templete_part('template_part/footer'); ?>