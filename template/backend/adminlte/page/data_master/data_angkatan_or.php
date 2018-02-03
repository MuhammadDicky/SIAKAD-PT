<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid box-danger box-thn-angkatan" id="box-content">
			        <div class="box-header">
						<h3 class="box-title">Data Tahun Angkatan</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" id="refresh-table-thn-angkatan" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">
			        	<div class="row">
			        		<div class="col-md-12">
			        			<div class="box box-danger">
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
							            			<a href="#tambah" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Tahun Angkatan</a>
							            			<a href="#delete_selected" class="btn btn-danger disabled aksi"><li class="fa fa-trash-o"></li> Hapus</a> | 
							            			<b style="vertical-align: middle;font-weight: normal;">Tampilkan</b> 
							            			<select class="form-control select2 select2_tamp" style="width: 100px;">
									                  	<option value="4">4 Data</option>
									                  	<option value="10">10 Data</option>
									                  	<option value="15">15 Data</option>
									                  	<option value="20">20 Data</option>
									                </select>
									                <div class="input-group" style="width: 160px;">
										                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Tahun Angkatan" style="width: 160px;">
									                    <span class="input-group-btn">
									                      <button type="button" class="btn btn-danger btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
									                    </span>
										            </div>
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
			        			<table id="tbl-thn-angkatan" class="table table-bordered table-striped table-hover datatable-dt" table-dt="#tbl-thn-angkatan" table-box="#box-content">
				        			<!-- <thead style="background-color: #dd4b39;color: white"> -->
					                <thead>
					                <tr>					                  
					                  <th>Tahun Angkatan</th>
					                  <th class="text-center">Tanggal Masuk</th>
					                  <th class="text-center">Mahasiswa Terdaftar</th>
					                  <th>Aksi</th>
					                </tr>
					                </thead>
					                <tbody>
					                <tr>
					                	<td colspan="4" align="center">Memproses Data</td>
					                </tr>					                					                
					                </tbody>
					                <!-- <tfoot style="background-color: #dd4b39;color: white"> -->
					                <tfoot>
					                <tr>					                  
					                  <th>Tahun Angkatan</th>
					                  <th class="text-center">Tanggal Masuk</th>
					                  <th class="text-center">Mahasiswa Terdaftar</th>
					                  <th>Aksi</th>
					                </tr>
					                </tfoot>
					            </table>					            
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
						                                <th style="width: 50px">Agama</th>
						                                <td style="width: 200px;font-weight: bold;">Alamat</td>
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
						                                <th>Agama</th>
						                                <th>Alamat</th>      
						                              </tr>
						                              </tfoot>
						                        </table>
						                  	</div>
					                    </div>
						              </div> 
						              <!-- /.tab-pane -->
						              <div class="tab-pane fade static-tab">
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

	<!-- modal open -->
    <div class="modal style-2 modal-info fade" id="myModal" role="dialog" data-keyboard="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">  
          	<form action="" id="form-input">
	          	<div class="row">
	          		<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="form-group" id="thn_angkatan">	              	
							<label for="thn_angkatan">Tahun Angkatan</label>
							<input type="number" class="form-control" placeholder="Contoh: 2008" name="thn_angkatan">
						</div>
		            </div>
	          		<div class="col-md-6 col-sm-6 col-xs-6">
	          			<div class="form-group" id="tgl_masuk_angkatan">
							<label for="tgl_masuk_angkatan">Tanggal Masuk</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right datepicker tgl_masuk_angkatan" name="tgl_masuk_angkatan" placeholder="Contoh: 1995-08-14">
							</div>
		                </div>
	          		</div>
	            </div>
	            <input type="hidden" id="data" name="data_thn_angkatan">
				<input type="hidden" id="id_thn_angkatan" name="id_thn_angkatan">
            </form>
            <div id="alert-place">
			</div>
            <div class="data-message">
            	<div class="centered-content content-message"></div>
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