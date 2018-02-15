<?php echo get_templete_part('template_part/header'); ?>
	<section class="content">
		<div class="row">
			<section class="col-md-3">
		      <div class="box box-warning box-solid control-panel-data-tbl">
		        <div class="box-header with-border">
		          	<h3 class="box-title">Control Panel</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
		        </div>
		        <!-- /.box-header -->
		        <div class="box-body">
					<div class="row" style="margin-bottom:-15px;">
						<div class="col-md-12 col-sm-6 col-xs-6">
			            	<div class="form-group">
			                  	<div class="btn-group-vertical btn-block">
					                <div class="btn-group">
					                	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><li class="fa fa-plus"></li> Tambah Data</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#tambah?data=alumni"><span class="fa fa-graduation-cap"></span> Alumni</a></li>
											<li><a href="#tambah?data=mhs_do"><span class="fa fa-times"></span> Mahasiswa Drop Out</a></li>
										</ul>
					                </div>
				                </div>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			      			<div class="form-group">
			                  <a href="#edit?data-selected=alumni-mhs-do" class="btn btn-success btn-block disabled aksi"><li class="fa fa-pencil-square"></li> Edit Data</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			      			<div class="form-group">
			                  <a href="#delete_selected" class="btn btn-danger btn-block disabled aksi"><li class="fa fa-trash"></li> Hapus</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			            	<div class="form-group">
			            		<a href="#data?statistik" class="btn btn-warning btn-block"><li class="fa fa-bar-chart"></li> Data Statistik</a>
			                </div>
			            </div>
					</div>
					<hr style="border-bottom: 2px solid grey">
					<div class="row" style="margin-bottom:-15px">
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  <label for="thn_angkatan">Data</label>
			                  <!-- <input class="form-control" type="text" name="wali_kelas"> -->
			                  <select class="form-control select2 select2_data" style="width: 100%;">
			                  	<option value="0">Alumni</option>
			                  	<option value="1">Mahasiswa Drop Out</option>
			                  </select>
			                </div>
						</div>
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  <label for="thn_angkatan">Tampilkan</label>
			                  <!-- <input class="form-control" type="text" name="wali_kelas"> -->
			                  <select class="form-control select2 select2_tamp" style="width: 100%;">
			                  	<option value="10">10 Data</option>
			                  	<option value="20">20 Data</option>
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
					                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Data Alumni">
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-warning btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
				                    </span>
					            </div>
			                </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 semua-data" style="display: none;">
			      			<div class="form-group">
			                  <a href="" class="btn btn-success btn-block" id="semua-data" table-refresh=".tbl-data-alumni-do"><i class="fa fa-list"></i> Tampilkan Semua Data</a>
			                </div>
			            </div>
					</div>
					<hr style="border-bottom: 2px solid grey">
					<div class="row" style="margin-bottom:-15px">
		            	<div class="col-md-12 col-xs-6">
			      			<div class="form-group">
			                  <label>Tahun Angkatan</label>
			                  <select class="form-control select2 select2_thn_angkatan filter-dt" style="width: 100%;"></select>
			                </div>
			            </div>
			            <div class="col-md-12 col-xs-6">
			      			<div class="form-group">
			                  <label>Program Studi</label>
			                  <select class="form-control select2 select2_prodi filter-dt" style="width: 100%;"></select>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-12 col-xs-12">
			            	<div class="form-group">
			                  <a href="" class="btn btn-success btn-block disabled" id="tamp-data" table-refresh=".tbl-data-alumni-do"><i class="fa fa-list"></i> Tampilkan Data</a>
			                </div>
			            </div>
		            </div>
		        </div>
		        <!-- /.box-body -->
		      </div>			              	
			</section>
			<section class="col-md-9">
				<div class="box box-warning box-solid box-alumni-do" id="box-content">
					<div class="box-header with-border">
						<h3 class="box-title">Data Alumni</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool refresh-data" data-refresh='data-alumni-do' data-box=".box-alumni-do" title="Refresh Data"><i class="glyphicon glyphicon-refresh refresh-icon"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
			        			<table class="table table-bordered table-striped table-hover tbl-data-alumni-do style-2 datatable-dt" style="width: 100%" table-dt=".tbl-data-alumni-do" data-tbl-selected="check-all-mhs-dt check-mhs-dt" table-box="#box-content">
					                <thead>
						                <tr>
											<th style="width: 5px"></th>
											<th style="width: 5px"><input type="checkbox" class="check-all-data check-all-mhs-dt" data-selected="check-mhs-dt" data-all-selected="check-all-mhs-dt" data-toggle=".aksi"></th>
											<th style="width: 70px">NIM</th>
											<th style="width: 220px">Nama</th>					                  
											<th style="width: 100px">Program Studi</th>
											<th style="width: 20px">Angkatan</th>
						                </tr>
					                </thead>
					                <tbody>
						                <tr>
						                	<td colspan="6" align="center">Memproses Data</td>
						                </tr>					                					                
					                </tbody>
					                <tfoot>
						                <tr>
						                	<th style="width: 5px"></th>
											<th style="width: 5px"><input type="checkbox" class="check-all-data check-all-mhs-dt" data-selected="check-mhs-dt" data-all-selected="check-all-mhs-dt" data-toggle=".aksi"></th>
											<th style="width: 70px">NIM</th>
											<th style="width: 220px">Nama</th>					                  
											<th style="width: 100px">Program Studi</th>
											<th style="width: 20px">Angkatan</th>
						                </tr>
					                </tfoot>
					            </table>
				        	</div>
			        	</div>
					</div>
					<!-- /.box-body -->
					<div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
			</section>		
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning box-solid" id="box-detail-mhs" style="display: none;" data-search>
					<div class="box-header with-border">
						<h3 class="box-title">Detail Data Mahasiswa</h3>
						<div class="box-tools pull-right">							
							<button type="button" class="btn btn-box-tool remove" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
					          <!-- Profile Image -->
						        <div class="box box-warning">
						            <div class="box-body box-profile">
						              <img class="profile-user-img img-responsive img-circle photo-mhs-detail" src="<?php echo get_templete_dir(dirname(__FILE__),'dist/img/user-image.png') ?>" alt="User profile picture">

						              <h3 class="profile-username text-center detail-data-mhs detail-nama" style="font-size: 17px"></h3>
						              <p class="text-muted text-center detail-data-mhs detail-nisn"></p>

						              <ul class="list-group list-group-unbordered">
						                <li class="list-group-item">
						                  <b>Program Studi</b> <p class="pull-right detail-data-mhs detail-nama_prodi"></p>
						                </li>
						                <li class="list-group-item">
						                  <b>Tahun Angkatan</b> <p class="pull-right detail-data-mhs detail-tahun_angkatan"></p>
						                </li>
						                <li class="list-group-item">
						                  <b>Agama</b> <p class="pull-right detail-data-mhs detail-agama"></p>
						                </li>
						                <li class="list-group-item">
						                  <b>Status</b> <p class="pull-right detail-data-mhs detail-status"></p>
						                </li>
						                <li class="list-group-item list-tgl-kelulusan-mhs" style="display: none;">
						                  <b>Tanggal Kelulusan</b> <p class="pull-right detail-data-mhs detail-tgl_lulus"></p>
						                </li>
						                <li class="list-group-item list-tgl-do-mhs" style="display: none;">
						                  <b>Tanggal Drop Out</b> <p class="pull-right detail-data-mhs detail-tgl_drop_out"></p>
						                </li>
						              </ul>
						              <button type="button" class="btn btn-block detail-status-data"></button>
						            </div>
						            <!-- /.box-body -->
						        </div>
						          <!-- /.box -->		      
					        </div>
							<div class="col-md-8">
								<div class="nav-tabs-custom nav-warning" id="detail-mhs">
						            <ul class="nav nav-tabs">
						              <li class="active tab_mhs open-tab"><a href="#detail_mhs" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Data Mahasiswa</a></li>
						              <li class="tab_riwayat_kuliah close-tab"><a href="#detail_riwayat_kuliah" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Riwayat Status Kuliah</a></li>
						              <li class="tab_riwayat_studi close-tab"><a href="#detail_riwayat_studi" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Riwayat Studi</a></li>
						              <li class="tab_pengguna close-tab"><a href="#detail_pengguna_tab" data-toggle="tab" aria-expanded="false"><span class="fa fa-lock"></span> Data Pengguna</a></li>
						            </ul>
						            <div class="tab-content">
										<div class="tab-pane active open-dt-tab" id="detail_mhs">
											<div class="row">
							              		<div class="col-md-12">
							              			<strong>Biodata Mahasiswa</strong>
							              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
							              		</div>
							              	</div>
											<div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>NIM</dt>
										                <dd class="detail-data-mhs detail-nisn"></dd>

										                <dt>Nama</dt>
										                <dd class="detail-data-mhs detail-nama"></dd>

										                <dt>Program Studi</dt>
										                <dd class="detail-data-mhs detail-nama_prodi"></dd>

										                <dt>Tahun Angkatan</dt>
										                <dd class="detail-data-mhs detail-tahun_angkatan"></dd>

										                <dt>Jenis Kelamin</dt>
										                <dd class="detail-data-mhs detail-jk"></dd>

										                <dt>Tempat Lahir</dt>
										                <dd class="detail-data-mhs detail-tmp_lhr"></dd>

										                <dt>Tanggal Lahir</dt>
										                <dd class="detail-data-mhs detail-tgl_lhr"></dd>

										                <dt>NIK</dt>
										                <dd class="detail-data-mhs detail-nik"></dd>

										                <dt>Agama</dt>
										                <dd class="detail-data-mhs detail-agama"></dd>

										                <dt>Alamat</dt>
										                <dd class="detail-data-mhs detail-alamat"></dd>
									              	</dl>
												</section>
								                <section class="col-md-6 col-xs-6">
								                	<dl class="dl-horizontal">
								                		<dt>RT/RW</dt>
										                <dd class="detail-rt-rw"><font class="detail-data-mhs detail-rt"></font>/<font class="detail-data-mhs detail-rw"></font></dd>

														<dt>Dusun</dt>
										                <dd class="detail-data-mhs detail-dusun"></dd>

										                <dt>Kelurahan</dt>
										                <dd class="detail-data-mhs detail-kelurahan"></dd>

										                <dt>Kecamatan</dt>
										                <dd class="detail-data-mhs detail-kecamatan"></dd>

										                <dt>Kode Pos</dt>
										                <dd class="detail-data-mhs detail-kode_pos"></dd>

										                <dt>Jenis Tinggal</dt>
										                <dd class="detail-data-mhs detail-jns_tinggal"></dd>

										                <dt>Alat Transportasi</dt>
										                <dd class="detail-data-mhs detail-alt_trans"></dd>

										                <dt>No. Telepon</dt>
										                <dd class="detail-data-mhs detail-tlp"></dd>

										                <dt>No. HP</dt>
										                <dd class="detail-data-mhs detail-hp"></dd>

										                <dt>Email</dt>
										                <dd class="detail-data-mhs detail-email"></dd>
									              	</dl>
												</section>
							                </div>

							                <div class="row">
							              		<div class="col-md-12">
							              			<strong>Biodata Ayah</strong>
							              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
							              		</div>
							              	</div>							              	
							                <div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>Nama Ayah</dt>
										                <dd class="detail-data-mhs detail-nm_ayah"></dd>

										                <dt>Tahun Lahir</dt>
										                <dd class="detail-data-mhs detail-thn_lhr_ayah"></dd>

										                <dt>Jenjang Pendidikan</dt>
										                <dd class="detail-data-mhs detail-pendi_ayah"></dd>
									              	</dl>
												</section>
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">						                
										                <dt>Pekerjaan</dt>
										                <dd class="detail-data-mhs detail-pekerjaan_ayah"></dd>

										                <dt>Penghasilan</dt>
										                <dd class="detail-data-mhs detail-penghasilan_ayah"></dd>

										                <dt>NIK</dt>
										                <dd class="detail-data-mhs detail-nik_ayah"></dd>
									              	</dl>
												</section>
											</div>

											<div class="row">
							              		<div class="col-md-12">
							              			<strong>Biodata Ibu</strong>
							              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
							              		</div>
							              	</div>
											<div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>Nama Ibu</dt>
										                <dd class="detail-data-mhs detail-nm_ibu"></dd>

										                <dt>Tahun Lahir</dt>
										                <dd class="detail-data-mhs detail-thn_lhr_ibu"></dd>

										                <dt>Jenjang Pendidikan</dt>
										                <dd class="detail-data-mhs detail-pendi_ibu"></dd>
									              	</dl>
												</section>
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">						                
										                <dt>Pekerjaan</dt>
										                <dd class="detail-data-mhs detail-pekerjaan_ibu"></dd>

										                <dt>Penghasilan</dt>
										                <dd class="detail-data-mhs detail-penghasilan_ibu"></dd>

										                <dt>NIK</dt>
										                <dd class="detail-data-mhs detail-nik_ibu"></dd>
									              	</dl>
												</section>
											</div>

											<div class="row">
							              		<div class="col-md-12">
							              			<strong>Biodata Wali</strong>
							              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
							              		</div>
							              	</div>
											<div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>Nama Wali</dt>
										                <dd class="detail-data-mhs detail-nm_wali"></dd>

										                <dt>Tahun Lahir</dt>
										                <dd class="detail-data-mhs detail-thn_lhr_wali"></dd>

										                <dt>Jenjang Pendidikan</dt>
										                <dd class="detail-data-mhs detail-pendi_wali"></dd>
									              	</dl>
												</section>
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">						                
										                <dt>Pekerjaan</dt>
										                <dd class="detail-data-mhs detail-pekerjaan_wali"></dd>

										                <dt>Penghasilan</dt>
										                <dd class="detail-data-mhs detail-penghasilan_wali"></dd>

										                <dt>NIK</dt>
										                <dd class="detail-data-mhs detail-nik_wali"></dd>
									              	</dl>
												</section>
											</div>
						              	</div> 
										<!-- /.tab-pane -->
										<div class="tab-pane fade close-dt-tab" id="detail_riwayat_kuliah">
											<div class="row">
												<div class="col-md-12">
													<table class="table table-bordered table-striped table-hover tbl-detail-mhs tbl-riwayat-kuliah-mhs">
										                <thead>
											                <tr>
											                  <th class="text-center" style="width: 50px">No</th>
											                  <th class="text-center" style="width: 130px">Tahun Akademik</th>
											                  <th class="text-center" style="width: 80px">Status</th>
											                  <th class="text-center" style="width: 45px">SKS</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="4" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center">No</th>
											                  <th class="text-center">Tahun Akademik</th>
											                  <th class="text-center">Status</th>
											                  <th class="text-center">SKS</th>
											                </tr>
										                </tfoot>
										            </table>
												</div>
											</div>
										</div>
						              	<!-- /.tab-pane -->
										<div class="tab-pane fade close-dt-tab" id="detail_riwayat_studi">
											<div class="row">
												<div class="col-md-12">
													<table class="table table-bordered table-striped table-hover tbl-detail-mhs tbl-riwayat-studi-mhs">
										                <thead>
											                <tr>
											                  <th class="text-center" style="width: 50px">No</th>
											                  <th class="text-center" style="width: 130px">Tahun Akademik</th>
											                  <th class="text-center" style="width: 80px">Kode MK</th>
											                  <th>Mata Kuliah</th>
											                  <th class="text-center" style="width: 45px">SKS</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="5" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center">No</th>
											                  <th class="text-center">Tahun Akademik</th>
											                  <th class="text-center">Kode MK</th>
											                  <th>Mata Kuliah</th>
											                  <th class="text-center">SKS</th>
											                </tr>
										                </tfoot>
										            </table>
												</div>
											</div>
						              	</div>
						              	<div class="tab-pane fade close-dt-tab" id="detail_pengguna_tab">
											<div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>Username</dt>
										                <dd class="detail-data-mhs detail-nisn"></dd>

										                <dt>Password</dt>
										                <dd id="password">
										                	<!-- <div class="pass password-cry pull-left"></div>
										                	<div class="password pull-left detail-uncrypt_password detail-data-mhs"></div>
										                	<div class="pull-right show-password" title="Tampilkan password"><span class="glyphicon glyphicon-eye-close"></span><div> -->
										                	<button type="button" class="btn btn-success btn-sm change-pass-user" title="Reset password" value=""><li class="fa fa-key"></li> Reset Password</button>
										                </dd>
									              	</dl>
												</section>
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>Status</dt>
										                <dd class="detail-data-mhs detail-active_status"></dd>

										                <dt>Terakhir Online</dt>
										                <dd class="detail-data-mhs detail-last_online"></dd>
									              	</dl>
												</section>				                
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
	</section>

	<!-- modal open -->
    <div class="modal fade style-2" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">

	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title"></h4>
	        </div>

          	<div class="modal-body">
	          	<div class="row list-selected hide-modal-content" style="display: none;">
	        		<div class="col-md-12">
	        			<h5 class="no-padding"></h5>
	        			<table class="table table-bordered list-mhs-selected" style="width: 100%">
			                <thead>
				                <tr>
				                	<th class="text-center" style="width: 10%">No</th>
									<th class="text-center" style="width: 20%">NIM</th>
									<th style="width: 70%">Nama</th>
				                </tr>
			                </thead>
			                <tbody>
			                </tbody>
			                <tfoot>
				                <tr>
				                	<th class="text-center">No</th>
				                	<th class="text-center">NIM</th>
									<th>Nama</th>
				                </tr>
			                </tfoot>
			            </table>
	        		</div>
	        	</div>
	            <form action="" class="hide-modal-content" id="form-input" style="display: none;">
		            <div class="row">
		            	<div class="col-md-12">
		            		<div class="form-group" id="alumni">
			                  <label for="alumni">Mahasiswa</label>
			                  <select class="form-control select2 select2-remote-dt select2_mhs" name="id[]" multiple="multiple"  data-placeholder="Pilih mahasiswa" style="width: 100%;"></select>
			                </div>
		            	</div>
			        </div>
			        <div class="row">
			            <div class="col-md-6 col-xs-6">
			            	<div class="form-group" id="tgl_yudisium">
								<label for="tgl_yudisium">Tanggal Yudisium</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right datepicker tgl_yudisium" name="tgl_yudisium" placeholder="Contoh: 1995-08-14">
								</div>
			                </div>
				        </div>
				        <div class="col-md-6 col-xs-6">
			            	<div class="form-group" id="tgl_lulus">
								<label for="tgl_lulus">Tanggal Kelulusan</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right datepicker tgl_lulus" name="tgl_lulus" placeholder="Contoh: 1995-08-14">
								</div>
			                </div>
				        </div>
			        </div>
			        <input type="hidden" id="data" name="data_alumni">
			        <input type="hidden" class="in_mhs" name="in_mhs">
	            </form>
	            <form action="" class="hide-modal-content" id="form-input-mhs-do" style="display: none;">
		            <div class="row">
		            	<div class="col-md-12">
		            		<div class="form-group" id="mhs-do">
			                  <label for="mhs-do">Mahasiswa</label>
			                  <select class="form-control select2 select2-remote-dt select2_mhs" name="mhs-data[]" multiple="multiple"  data-placeholder="Pilih mahasiswa" style="width: 100%;"></select>
			                </div>
		            	</div>
			        </div>
			        <div class="row">
			            <div class="col-md-6 col-xs-6">
			            	<div class="form-group" id="tgl_drop_out">
								<label for="tgl_drop_out">Tanggal Drop Out</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right datepicker tgl_drop_out" name="tgl_drop_out" placeholder="Contoh: 1994-05-29">
								</div>
			                </div>
				        </div>
				        <div class="col-md-6 col-xs-6">
			            	<div class="form-group" id="drop_out_reason">
								<label for="drop_out_reason">Keterangan</label>
								<input type="text" class="form-control drop_out_reason" name="drop_out_reason" placeholder="Keterangan Drop Out">
			                </div>
				        </div>
			        </div>
			        <input type="hidden" id="data" name="data_mhs_do">
			        <input type="hidden" class="in_mhs" name="in_mhs">
	            </form>
	            <div class="row data-statistik-mhs hide-modal-content" style="display: none;">
	        		<div class="col-md-12">
		            	<div class="nav-tabs-custom nav-warning no-margin">
				            <ul class="nav nav-tabs">
								<li class="active open-tab"><a href="#statistik-alumni" data-toggle="tab" aria-expanded="true"><span class="fa fa-bar-chart"></span> Statistik Alumni</a></li>
								<li class="close-tab"><a href="#statistik-mhs-do" data-toggle="tab" aria-expanded="false"><span class="fa fa-bar-chart"></span> Statistik Mahasiswa Drop Out</a></li>></li>
								<li class="pull-right">
									<a href="" class="text-muted refresh-data" title="Refresh Data" data-refresh='statistik-alumni-mhs-do'><i class="fa fa-refresh refresh-icon"></i></a>
								</li>
				            </ul>
				            <div class="tab-content">
								<div class="tab-pane active open-dt-tab" id="statistik-alumni">
									<div class="row">
						                <div class="col-md-8 col-sm-8">
						                  <div class="pad">
						                  	<p class="text-center"><strong>Data Statistik Alumni</strong></p>
						                    <div class="chart">
								                <canvas id="barchart-alumni" class="chart" style="height: 300px; width: 510px;"></canvas>
								            </div>
						                  </div>
						                </div>
						                <div class="col-md-4 col-sm-4">
						                  	<div class="pad content-responsive style-2 detail-jml-alumni" style="height: 355px">
							                </div>
						                </div>
					              	</div>
				              	</div> 
								
								<div class="tab-pane fade close-dt-tab" id="statistik-mhs-do">
									<div class="row">
						                <div class="col-md-8 col-sm-8">
						                  <div class="pad">
						                  	<p class="text-center"><strong>Data Statistik Mahasiswa Drop Out</strong></p>
						                    <div class="chart">
								                <canvas id="barchart-mhs-do" class="chart" style="height: 300px; width: 510px;"></canvas>
								            </div>
						                  </div>
						                </div>
						                <div class="col-md-4 col-sm-4">
						                  	<div class="pad content-responsive style-2 detail-jml-mhs-do" style="height: 355px">
							                </div>
						                </div>
					              	</div>
								</div>
				            </div>
						</div>
	        		</div>
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