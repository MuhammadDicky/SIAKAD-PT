<?php
defined('BASEPATH') OR exit(header('Location: http://localhost/siakad-uncp/page_error/no_direct_access'));
?>
<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
	        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	          <!-- small box -->
	          <div class="small-box bg-green">
	            <div class="inner">
	              <h3><?php echo $tahun_akademik; ?></h3>

	              <p>Tahun Akademik</p>
	            </div>
	            <div class="icon">
		            <?php if ($tahun_akademik != '-'): ?>
	            	<i class="fa fa-calendar-check-o"></i>
	            	<?php endif ?>
	            	<?php if ($tahun_akademik == '-'): ?>
	            	<i class="fa fa-calendar-minus-o"></i>
	            	<?php endif ?>
	            </div>
	            <a href="<?php echo set_url('data_master/data_thn_akademik'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>	        
	        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3><?php echo $count_ptk; ?></h3>

	              <p>Jumlah Tenaga Pendidik</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-user-secret"></i>
	            </div>
	            <a href="<?php echo set_url('data_akademik/data_ptk'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>	        
	        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-yellow">
	            <div class="inner">
	              <h3><?php echo $count_mhs; ?></h3>

	              <p>Jumlah Mahasiswa Yang Terdata</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-users"></i>
	            </div>
	            <a href="<?php echo set_url('data_akademik/data_mahasiswa'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>	     
	        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php echo $count_alumni; ?></h3>

	              <p>Jumlah Alumni</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-graduation-cap"></i>
	            </div>
	            <a href="<?php echo set_url('data_akademik/data_alumni'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>	           
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning grafik-mhs">
		            <div class="box-header with-border">
			          <i class="fa fa-bar-chart"></i>
		              <h3 class="box-title">Data Statistik Mahasiswa</h3>

		              <div class="box-tools pull-right">
		              	<button type="button" class="btn bg-yellow btn-sm" id="refresh-statik-mhs"><i class="fa fa-refresh"></i>
		                </button>
		                <button type="button" class="btn bg-yellow btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>				                
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body no-padding">
		            	<div class="data-container">
			              	<div class="row">
				                <div class="col-md-8 col-sm-8">
				                  <div class="pad">
				                  	<p class="text-center"><strong>Data Statistik Mahasiswa Berdasarkan Program Studi</strong></p>
				                    <div class="chart">
						                <canvas id="barchart-mhs-pd" style="height: 330px; width: 510px;"></canvas>
						            </div>
				                  </div>
				                </div>
				                <!-- /.col -->
				                <div class="col-md-4 col-sm-4">
				                  	<div class="pad content-responsive detail-jml-mhs" style="height: 385px">
					                </div>
				                </div>
				                <!-- /.col -->
			              	</div>
			              	<!-- /.row -->
		              	</div>
		              	<div class="data-empty-container" style="display: none;padding: 10px"></div>
		            </div>
		            <!-- /.box-body -->
		            <div class="box-footer">
		            	<div class="data-container">
			              	<div class="row">
				              	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="box box-solid bg-yellow-gradient">
							            <div class="box-header">
							              <i class="fa fa-bar-chart"></i>
							              <h3 class="box-title">Berdasarkan Tahun Angkatan</h3>
							            </div>
							            <div class="box-body border-radius-none" style="background-color: #ffffff">
							            	<div class="row">
							            		<div class="col-md-12 col-xs-12">
							            			<p class="text-center text-black"><strong>Data Statistik Mahasiswa Berdasarkan 4 Tahun Angkatan Terakhir</strong></p>
							            			<div class="chart">
										                <canvas id="barchart-mhs-thn" height="137"></canvas>
										            </div>
							            		</div>
							            	</div>				            	
							            </div>
							            <!-- /.box-body -->
							            <div class="box-footer no-padding">
							              <ul class="nav nav-pills nav-stacked daftar-thn content-responsive style-3">
							              	<li class="text-center"><a>Memproses Data...</a></li>
							              </ul>
							            </div>
							            <!-- /.box-footer -->
							        </div>
				                </div>
				                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="box box-solid bg-yellow-gradient">
							            <div class="box-header">
							              <i class="fa fa-pie-chart"></i>
							              <h3 class="box-title">Grafik Data Mahasiswa</h3>
							            </div>
							            <div class="box-body border-radius-none">
							            	<div class="row">
							            		<div class="col-md-12 col-xs-12">
							            			<div class="chart-responsive">
								                		<canvas id="pieChart-data-mhs" height="250"></canvas>
									                </div>
							            		</div>
							            	</div>				            	
							            </div>
							            <!-- /.box-body -->
							            <div class="box-footer no-padding">
							              <ul class="nav nav-pills nav-stacked daftar-pd content-responsive">
							              	<li class="text-center"><a>Memproses Data...</a></li>
							              </ul>
							            </div>
							            <!-- /.box-footer -->
							        </div>
				                </div>
			              	</div>
			              	<!-- /.row -->
			           	</div>
		            </div>
		            <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
		        </div>
	        </div>
		</div>

		<div class="row">
			<section class="col-md-4 col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-solid bg-green-gradient grafik-ptk">
				            <div class="box-header">
				              <i class="fa fa-pie-chart"></i>

				              <h3 class="box-title">Grafik Data Tenaga Pendidik</h3>

				              <div class="box-tools pull-right">
				              	<button type="button" class="btn bg-green btn-sm" id="refresh-statik-ptk"><i class="fa fa-refresh"></i>
				                </button>
				                <button type="button" class="btn bg-green btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				                </button>				                
				              </div>
				            </div>
				            <div class="box-body border-radius-none">
				            	<div class="data-container">
					            	<div class="row">
					            		<div class="col-md-12 col-xs-12">
					            			<div class="chart-responsive">
						                		<canvas id="pieChart-data-ptk" height="180"></canvas>
							                </div>
					            		</div>
					            	</div>
					            </div>
					            <div class="data-empty-container" style="display: none;padding: 10px"></div>
				            </div>
				            <!-- /.box-body -->
				            <div class="box-footer no-padding">
				              <ul class="nav nav-pills nav-stacked daftar-pd content-responsive style-3">
				              	<li class="text-center"><a>Memproses Data...</a></li>
				              </ul>
				            </div>
				            <!-- /.box-footer -->
				        </div>
					</div>
				</div>
			</section>
			<section class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info box-grafik-pengguna">
				            <div class="box-header with-border">
				            	<i class="fa fa-pie-chart"></i>
				              	<h3 class="box-title">Grafik Data Pengguna</h3>

				              	<div class="box-tools pull-right">
				              		<button type="button" class="btn bg-aqua btn-sm" id="refresh-statik-pengguna"><i class="fa fa-refresh"></i></button>
				                	<button type="button" class="btn bg-aqua btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				                	</button>				                
				              	</div>
				            </div>
				            <!-- /.box-header -->
				            <div class="box-body" style="display: block;">
				            	<div class="data-container">
					            	<div class="row">
					            		<section class="col-md-6 col-xs-12">
											<div class="box box-solid box-info grafik-data-pengguna">
												<div class="box-header">
									              <h3 class="box-title">Data Jumlah Pengguna</h3>									              
									            </div>
									            <div class="box-body border-radius-none">
									            	<div class="row">
									            		<div class="col-md-12 col-xs-12">
									            			<div class="chart-responsive">
										                		<canvas id="pieChart-data-pengguna" height="140"></canvas>
											                </div>
									            		</div>
								            		</div>											            	
									            </div>
									            <!-- /.box-body -->
									            <div class="box-footer text-black" style="display: block;">
									              <div class="row">
									                <div class="col-sm-6 col-md-6">
									                  <!-- Progress bars -->
									                  <div class="clearfix">
									                    <span class="pull-left"><i class="fa fa-circle-o" style="color: #f39c12;"></i> Mahasiswa</span>
									                    <small class="pull-right"></small>
									                  </div>
									                  <div class="progress xs">
									                    <div class="progress-bar progress-pengguna-siswa" style="background-color: #f39c12;"></div>
									                  </div>
									                </div>
									                <!-- /.col -->
									                <div class="col-sm-6 col-md-6">
									                  <div class="clearfix">
									                    <span class="pull-left"><i class="fa fa-circle-o" style="color: #00c0ef;"></i> Tenaga Pendidik</span>
									                    <small class="pull-right"></small>
									                  </div>
									                  <div class="progress xs">
									                    <div class="progress-bar progress-pengguna-guru" style="background-color: #00c0ef;"></div>
									                  </div>
									                </div>
									                <!-- /.col -->
									              </div>
									              <!-- /.row -->
									            </div>
									            <!-- /.box-footer -->
									        </div>
										</section>
										<section class="col-md-6 col-xs-12">
											<div class="box box-solid box-info grafik-status-pengguna">
												<div class="box-header">
									              <h3 class="box-title">Data Pengguna Aktif & Nonaktif</h3>									              
									            </div>
									            <div class="box-body border-radius-none">
									            	<div class="row">
									            		<div class="col-md-12 col-xs-12">
									            			<div class="chart-responsive">
										                		<canvas id="pieChart-data-pengguna-status" height="140"></canvas>
											                </div>
									            		</div>
								            		</div>											            	
									            </div>
									            <!-- /.box-body -->
									            <div class="box-footer text-black" style="display: block;">
									              <div class="row">
									                <div class="col-sm-6 col-md-6">
									                  <!-- Progress bars -->
									                  <div class="clearfix">
									                    <span class="pull-left"><i class="fa fa-circle-o" style="color:#00a65a;"></i> Pengguna Aktif</span>
									                    <small class="pull-right text-progress-pns"></small>
									                  </div>
									                  <div class="progress xs">
									                    <div class="progress-bar progress-pengguna-aktif" style="background-color: #00a65a;"></div>
									                  </div>
									                </div>
									                <!-- /.col -->
									                <div class="col-sm-6 col-md-6">
									                  <div class="clearfix">
									                    <span class="pull-left"><i class="fa fa-circle-o" style="color: #dd4b39;"></i> Pengguna Non</span>
									                    <small class="pull-right text-progress-tenaga-honor"></small>
									                  </div>
									                  <div class="progress xs">
									                    <div class="progress-bar progress-pengguna-nonaktif" style="background-color: #dd4b39;"></div>
									                  </div>
									                </div>
									                <!-- /.col -->
									              </div>
									              <!-- /.row -->
									            </div>
									            <!-- /.box-footer -->
									        </div>
										</section>
					            	</div>				            	
									<div class="row">
										<div class="col-md-12">
											<table class="table table-striped no-margin tbl-user-last-online">
							                  <thead>
							                  <tr>
							                  	<th colspan="4" class="text-center"><li class="fa fa-user-circle"></li> Daftar pengguna yang terakhir kali login</th>
							                  </tr>
							                  <tr>
							                    <th>Username</th>
							                    <th class="text-center">Level Akses</th>
							                    <th class="text-center">Terakhir Login</th>
							                    <th class="text-center">Detail Username</th>
							                  </tr>
							                  </thead>
							                  <tbody>
								                	<tr>
								                    	<td colspan="4" class="text-center">Memproses data</td>
								                	</tr>
							                  </tbody>
							                </table>
										</div>
									</div>
								</div>
								<div class="data-empty-container" style="display: none;"></div>
				            </div>
				            <!-- /.box-body -->
				            <div class="overlay" style="display: none;">
							  <i class="fa fa-refresh fa-spin"></i>
							</div>
				        </div>
					</div>					
				</div>
			</section>			
		</div>
	</section>

	<!-- modal open -->
    <div class="modal style-2 fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">                        
            <div id="rincian-mhs" style="display: none;">
            	<div class="nav-tabs-custom nav-warning">
		            <ul class="nav nav-tabs">
		              <li class="active tab_siswa"><a href="#detail_siswa" data-toggle="tab" aria-expanded="true">Data mahasiswa</a></li>		              
		            </ul>
		            <div class="tab-content">
						<div class="tab-pane active" id="detail_siswa">
							<div id="container-detail-user-mhs" class="tab-overflow-container">
								<div class="row">
									<section class="col-md-6 col-xs-6">
										<dl>
							                <dt>NIM</dt>
							                <dd id="detail-nisn"></dd>

							                <dt>Nama</dt>
							                <dd id="detail-nama"></dd>

							                <dt>Program Studi</dt>
							                <dd id="detail-nama_prodi"></dd>

							                <dt>Tahun Angkatan</dt>
							                <dd id="detail-tahun_angkatan"></dd>

							                <dt>Jenis Kelamin</dt>
							                <dd id="detail-jk"></dd>

							                <dt>Tempat Lahir</dt>
							                <dd id="detail-tmp_lhr"></dd>

							                <dt>Tanggal Lahir</dt>
							                <dd id="detail-tgl_lhr"></dd>

							                <dt>NIK</dt>
							                <dd id="detail-nik"></dd>

							                <dt>Agama</dt>
							                <dd id="detail-agama"></dd>

							                <dt>Alamat</dt>
							                <dd id="detail-alamat"></dd>
						              	</dl>
									</section>
					                <section class="col-md-6 col-xs-6">
					                	<dl>
					                		<dt>RT/RW</dt>
							                <dd id="detail-rt-rw"><font id="detail-rt"></font>/<font id="detail-rw"></font></dd>

											<dt>Dusun</dt>
							                <dd id="detail-dusun"></dd>

							                <dt>Kelurahan</dt>
							                <dd id="detail-kelurahan"></dd>

							                <dt>Kecamatan</dt>
							                <dd id="detail-kecamatan"></dd>

							                <dt>Kode Pos</dt>
							                <dd id="detail-kode_pos"></dd>

							                <dt>Jenis Tinggal</dt>
							                <dd id="detail-jns_tinggal"></dd>

							                <dt>Alat Transportasi</dt>
							                <dd id="detail-alt_trans"></dd>

							                <dt>No. Telepon</dt>
							                <dd id="detail-tlp"></dd>

							                <dt>No. HP</dt>
							                <dd id="detail-hp"></dd>

							                <dt>Email</dt>
							                <dd id="detail-email"></dd>
						              	</dl>
									</section>
				                </div>
				            </div>
		              	</div> 
						<!-- /.tab-pane -->						
		            </div>
		            <!-- /.tab-content -->
				</div>
				<!-- nav-tabs-custom -->
            </div>
            <div id="rincian-ptk" style="display: none;">
            	<div class="nav-tabs-custom nav-warning">
		            <ul class="nav nav-tabs">
		              <li class="active tab_guru"><a href="#detail_guru" data-toggle="tab" aria-expanded="true">Data Tenaga Pendidik</a></li>
		            </ul>
		            <div class="tab-content">
						<div class="tab-pane active" id="detail_guru">
							<div id="container-detail-user-ptk" class="tab-overflow-container">
								<div class="row">
									<section class="col-md-6 col-xs-6">
										<dl>
							                <dt>Nama</dt>
							                <dd id="detail-nama_ptk"></dd>

							                <dt>NIDN</dt>
							                <dd id="detail-nuptk"></dd>

							                <dt>NIP</dt>
							                <dd id="detail-nip"></dd>

							                <dt>Program Studi</dt>
							                <dd id="detail-nama_prodi"></dd>

							                <dt>Jenis Kelamin</dt>
							                <dd id="detail-jk_ptk"></dd>
						              	</dl>
									</section>
					                <section class="col-md-6 col-xs-6">
					                	<dl>
					                		<dt>Tempat Lahir</dt>
							                <dd id="detail-tmp_lhr_ptk"></dd>

							                <dt>Tanggal Lahir</dt>
							                <dd id="detail-tgl_lhr_ptk"></dd>

					                		<dt>Status Ikatan Kerja</dt>
							                <dd id="detail-status_ptk"></dd>

											<dt>Status Keaktifan</dt>
							                <dd id="detail-status_aktif_ptk"></dd>

							                <dt>Pendidikan Tertinggi</dt>
							                <dd id="detail-jenjang"></dd>
						              	</dl>
									</section>
				                </div>
				            </div>
		              	</div> 
						<!-- /.tab-pane -->						
		            </div>
		            <!-- /.tab-content -->
				</div>
				<!-- nav-tabs-custom -->
            </div>
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
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- modal end -->

<?php echo get_templete_part('template_part/footer'); ?>