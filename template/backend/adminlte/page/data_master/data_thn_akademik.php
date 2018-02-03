<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
    		<div class="col-md-12">
    			<div class="box box-solid box-danger" id="box-content">
		            <div class="box-header with-border">
		              <h3 class="box-title">Control Panel</h3>
		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		              <!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body box-jadwal-mk-control">
		            	<div class="row">
		            		<div class="col-md-12">
		            			<div class="control-panel-data">
	            					<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
			            			<a href="#tambah" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Tahun Akademik</a>
			            			<?php 
			            			if ($tahun_akademik == '-') {
			            				$status = 'disabled ';
			            			}
			            			else{
			            				$status = '';
			            			}
			            			 ?>
			            			<a href="#" class="btn btn-danger <?php echo $status ?>non-aktif-thn-ajaran"><i class="fa fa-ban"></i> Tutup Tahun Akademik</a> | 
			            			<b style="vertical-align: middle;font-weight: normal;">Tampilkan</b> 
			            			<select class="form-control select2 select2_tamp" style="width: 100px;">
					                  	<option value="4">4 Data</option>
					                  	<option value="10">10 Data</option>
					                  	<option value="15">15 Data</option>
					                  	<option value="20">20 Data</option>
					                </select>
					                <div class="input-group" style="width: 160px;">
						                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Tahun Akademik" style="width: 160px;">
					                    <span class="input-group-btn">
					                      <button type="button" class="btn btn-danger btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
					                    </span>
						            </div>
		            			</div>
		            		</div>
		            	</div>
		            </div>
		            <div class="box-footer">
		            	<div class="row">
				    		<div class="col-md-12">
					            <div class="nav-tabs-custom nav-danger">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#daftar-thn-ak" data-toggle="tab" aria-expanded="true"><span class="fa fa-list"></span> Daftar Tahun Akademik</a></li>
						              <li><a href="#statik-thn-ak" data-toggle="tab" aria-expanded="false"><span class="fa fa-bar-chart"></span> Statistik Tahun Akademik</a></li>
						              <li class="pull-right"><a href="" class="text-muted" id="refresh-thn-ak"><i class="fa fa-refresh"></i></a></li>
						            </ul>
						            <div class="tab-content">
									  <div class="tab-pane active" id="daftar-thn-ak">
									  	<div class="row">
									  		<div class="col-md-12">
									  			<table class="table table-bordered table-striped table-hover datatable-dt" id="tbl-thn-akademik" table-dt="#tbl-thn-akademik" table-box="#box-content">
									                <thead>
										                <tr>
										                  <th>Tahun Akademik</th>
										                  <th class="text-center">Mulai - Berakhir</th>
										                  <th class="text-center">Mahasiswa Terdaftar</th>
										                  <th class="text-center">Status</th>
										                  <th class="text-center">Aksi</th>
										                </tr>
									                </thead>
									                <tbody>
										                <tr>
										                	<td colspan="5" class="text-center">Memproses Data</td>
										                </tr>					                					                
									                </tbody>
									                <tfoot>
										                <tr>
										                  <th>Tahun Akademik</th>
										                  <th class="text-center">Mulai - Berakhir</th>
										                  <th class="text-center">Mahasiswa Terdaftar</th>
										                  <th class="text-center">Status</th>
										                  <th class="text-center">Aksi</th>
										                </tr>
									                </tfoot>
									            </table>
									  		</div>
										</div>
						              </div> 
						              <!-- /.tab-pane -->
						              <div class="tab-pane fade" id="statik-thn-ak">
					              		<div class="row">
					              			<div class="col-md-8 col-sm-8">
							                  <div class="pad">
							                  	<p class="text-center"><strong class="title-thn-ak-static">Data Statistik Mahasiswa Berdasarkan Tahun Akademik</strong></p>
							                    <div class="chart">
									                <canvas id="barchart-mhs-thn-ak" style="height: 315px; width: 510px;"></canvas>
									            </div>
							                  </div>
							                </div>
							                <div class="col-md-4 col-sm-4">
							                	<div class="form-group" style="padding: 10px 10px 0 10px">
								                  <label for="id_thn_ak_jdl">Tahun Akademik</label>
								                  <select class="form-control select2 select2_thn_akademik id_thn_ak_jdl" style="width: 100%;"></select>
								                </div>
							                  	<div class="pad content-responsive style-2 detail-jml-mhs" style="height: 275px">
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
		            <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
    		</div>
    	</div>

		<div class="row">
			<div class="col-md-12 table-siswa">
				<div class="box box-danger box-solid" id="box-mhs" style="display: none">
					<div class="box-header with-border">
						<h3 class="box-title"></h3>
						<div class="box-tools pull-right">                  
							<button type="button" class="btn btn-box-tool remove" data-widget="remove"><i class="fa fa-times"></i>
							</button>
						</div>              
					</div>              
		            <div class="box-body">
		                <div class="row">
				    		<div class="col-md-12">
					            <div class="nav-tabs-custom nav-danger">
						            <ul class="nav nav-tabs">
						              <li class="active tab-daftar-mhs-thn-ak"><a href="#daftar-mhs-thn-ak" data-toggle="tab" aria-expanded="true"><span class="fa fa-list"></span> Daftar Mahasiswa</a></li>
						              <li><a href="#statik-mhs-thn-ak" data-toggle="tab" aria-expanded="false" class="static-mhs-tab"><span class="fa fa-bar-chart"></span> Statistik Mahasiswa</a></li>
						            </ul>
						            <div class="tab-content">
									  <div class="tab-pane active" id="daftar-mhs-thn-ak">
									  	<div class="row">
						                  	<div class="col-md-12">
						                        <table class="table table-bordered table-striped table-hover tbl-data-mhs-master">
						                              <thead>
						                              <tr>
						                                <td style="width: 10px;font-weight: bold">No</td>
						                                <th style="width: 50px">NIM</th>
						                                <th>Nama</th>
						                                <th>Program Studi</th>
						                                <th style="width: 50px">Angkatan</th>
						                                <td style="width: 85px;font-weight: bold;">Agama</td>
						                              </tr>
						                              </thead>
						                              <tbody>
						                              <tr>
						                                <td colspan="6" align="center">Memproses Data</td>
						                              </tr>
						                              </tbody>
						                              <tfoot>
						                              <tr>
						                                <th>No</th>
						                                <th>NIM</th>
						                                <th>Nama</th>
						                                <th>Program Studi</th>
						                                <th>Angkatan</th>
						                                <th>Agama</th>      
						                              </tr>
						                              </tfoot>
						                        </table>
						                  	</div>
					                    </div>
						              </div> 
						              <!-- /.tab-pane -->
						              <div class="tab-pane fade static-tab" id="statik-mhs-thn-ak">
					              		<div class="row chart-container">
					              			<div class="col-md-8 col-sm-8">
							                  <div class="pad">
							                  	<p class="text-center"><strong class="title-master-dt">Data Statistik Mahasiswa Tahun Akademik</strong></p>
							                    <div class="chart">
									                <canvas id="barchart-mhs-master-dt" style="height: 315px; width: 510px;"></canvas>
									            </div>
							                  </div>
							                </div>
							                <div class="col-md-4 col-sm-4">
							                  	<div class="pad content-responsive style-2 detail-jml-mhs-dt" style="height: 335px">
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
	              	<div class="overlay">
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
	            	<div class="col-md-6">
	            		<div class="form-group" id="smstr">
		                	<div class="row">
		                		<div class="col-md-12 col-xs-12">
		                			<label for="thn_ajar">Tahun Akademik</label>
	                			</div>
		                	</div>
		                	<div class="row">
		                		<section class="col-md-6 col-xs-6">
									<input type="number" class="form-control thn_ajar" name="thn_ajar" placeholder="Contoh: 2009">
								</section>
								<section class="col-md-6 col-xs-6">
									<select class="form-control select2 select2_smstr smstr" name="smstr" style="width: 100%;">
										<option value=""></option>
					                  	<option value="1">Ganjil</option>
					                  	<option value="2">Genap</option>
				                  	</select>
								</section>							
		                	</div>							
		                </div>
	            	</div>
		            <div class="col-md-3 col-xs-6">
		            	<div class="form-group" id="tgl_mulai_thn_ajar">
							<label for="tgl_mulai_thn_ajar">Tanggal Mulai</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right datepicker tgl_mulai_thn_ajar" name="tgl_mulai_thn_ajar" placeholder="Contoh: 1995-08-14">
							</div>
		                </div>
			        </div>
			        <div class="col-md-3 col-xs-6">
		            	<div class="form-group" id="tgl_akhir_thn_ajar">
							<label for="tgl_akhir_thn_ajar">Tanggal Berakhir</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right datepicker tgl_akhir_thn_ajar" name="tgl_akhir_thn_ajar" placeholder="Contoh: 1995-08-14">
							</div>
		                </div>
			        </div>
		        </div>		        
		        <input type="hidden" id="data" name="data_thn_akademik">
		        <input type="hidden" class="id_thn_ak" name="id_thn_ak">
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
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


<?php echo get_templete_part('template_part/footer'); ?>