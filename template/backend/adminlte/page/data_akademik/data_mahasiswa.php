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
			        <!-- <div class="btn-group-vertical btn-block">
	                  <a href="#tambah" class="btn btn-warning" id="tambah-data">Tambah Data</a>
	                   <div class="btn-group">
	                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
	                      <span class="caret"></span> Tampilkan Data
	                    </button>
	                    <ul class="dropdown-menu">
                    	  <li><a href="" id="semua-data">Semua Data</a></li>
	                      <li><a href="#pilih_data" id="pilih_data">Berdasarkan Tahun dan Program Studi</a></li>
	                    </ul>
	                  </div>
	                  <div class="btn-group">
	                    <button type="button" class="btn btn-warning dropdown-toggle disabled aksi" data-toggle="dropdown">
	                      <span class="caret"></span> Aksi
	                    </button>
	                    <ul class="dropdown-menu">
	                      <li><a href="#delete_selected">Hapus</a></li>
	                      <li><a href="#pindah_prodi">Pindah Program Studi</a></li>
	                      <li><a href="#mhs_alm">Alumni</a></li>
	                    </ul>
	                  </div>
					</div> -->
					<div class="row" style="margin-bottom:-15px;">
						<div class="col-md-12 col-sm-6 col-xs-6">
			            	<div class="form-group">
			                  <a href="#tambah" class="btn btn-info btn-block" id="tambah-data"><li class="fa fa-plus"></li> Tambah Data</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6 hide">
			            	<div class="form-group">
			                  <a class="btn bg-light-blue btn-block selected-data-btn" data-selected="selected-data-mhs" state="0"><li class="fa fa-check-square"></li> Pilih Data</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			      			<div class="form-group">
			                  <a href="#delete_selected" class="btn btn-danger btn-block disabled aksi"><li class="fa fa-trash"></li> Hapus</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-12">
			      			<div class="form-group">
			                  <a href="#pindah_prodi?data=mahasiswa" class="btn btn-success btn-block disabled aksi"><li class="fa fa-pencil-square"></li> Pindah Program Studi</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			      			<div class="form-group">
			                  <a href="#tambah?data=alumni" class="btn btn-warning btn-block disabled aksi"><li class="fa fa-graduation-cap"></li> Alumni</a>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			      			<div class="form-group">
			                  <a href="#tambah?data=drop_out" class="btn bg-navy btn-block disabled aksi"><li class="fa fa-times"></li> Drop Out</a>
			                </div>
			            </div>
					</div>
					<hr style="border-bottom: 2px solid grey">
					<div class="row" style="margin-bottom:-15px">
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
					                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Data Mahasiswa" data-table=".tbl-data-mhs">
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-warning btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
				                    </span>
					            </div>
					        </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 semua-data" style="display: none;">
			      			<div class="form-group">
			                  <a href="" class="btn btn-success btn-block" id="semua-data" table-refresh=".tbl-data-mhs"><i class="fa fa-list"></i> Tampilkan Semua Data</a>
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
			                  <a href="" class="btn btn-success btn-block disabled" id="tamp-data" table-refresh=".tbl-data-mhs"><i class="fa fa-list"></i> Tampilkan Data</a>
			                </div>
			            </div>
		            </div>
		            <hr style="border-bottom: 2px solid grey">
		            <div class="row" style="margin-bottom:-15px">
		            	<div class="col-md-12">
		            		<div class="form-group">
			                	<label>Status Data</label>
			                	<div class="row">
			                		<div class="col-md-4 col-sm-4 col-xs-4">
					            		<button type="button" class="btn btn-success btn-block btn-status-data" title="Tampilkan Data Yang Sudah Diverifikasi" value="1" data-search=""><li class="fa fa-check-square-o"></li></button>
					            	</div>
					            	<div class="col-md-4 col-sm-4 col-xs-4">
					            		<button type="button" class="btn btn-danger btn-block btn-status-data" title="Tampilkan Data Yang Salah" value="2" data-search=""><li class="fa fa-times"></li></button>
					            	</div>
					            	<div class="col-md-4 col-sm-4 col-xs-4">
					            		<button type="button" class="btn btn-gray btn-block btn-status-data" title="Tampilkan Data Yang Belum Diverifikasi" value="0" data-search=""><li class="fa fa-warning"></li></button>
					            	</div>
			                	</div>
			                </div>
		            	</div>
		            </div>
		        </div>
		        <!-- /.box-body -->
		      </div>			              	
			</section>
			<section class="col-md-9">
				<div class="box box-warning box-solid" id="box-siswa">
					<div class="box-header with-border">
						<h3 class="box-title">Data Mahasiswa</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" id="refresh-table-mhs" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
			        			<table class="table table-bordered table-striped table-hover tbl-data-mhs style-2 datatable-dt" style="width: 100%" table-dt=".tbl-data-mhs" data-tbl-selected="check-all-siswa check-siswa" data-checked="selected-data-mhs_done" table-box="#box-siswa">
					                <thead>
						                <tr>
											<th style="width: 5px"></th>
											<th style="width: 5px"><input type="checkbox" class="check-all-data check-all-siswa selected-data-mhs" data-selected="check-siswa" data-all-selected="check-all-siswa" data-toggle=".aksi"></th>
											<th style="width: 70px">NIM</th>
											<th style="width: 220px">Nama</th>					                  
											<th style="width: 100px">Program Studi</th>
											<th style="width: 20px">Angkatan</th>
											<th style="width: 10px">Status</th>
						                </tr>
					                </thead>
					                <tbody>
						                <tr>
						                	<td colspan="7" align="center">Memproses Data</td>
						                </tr>					                					                
					                </tbody>
					                <tfoot>
						                <tr>
						                	<th style="width: 5px"></th>
											<th style="width: 5px"><input type="checkbox" class="check-all-data check-all-siswa selected-data-mhs" data-selected="check-siswa" data-all-selected="check-all-siswa" data-toggle=".aksi"></th>
											<th style="width: 70px">NIM</th>
											<th style="width: 220px">Nama</th>					                  
											<th style="width: 100px">Program Studi</th>
											<th style="width: 20px">Angkatan</th>
											<th style="width: 10px">Status</th>
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
						              <img class="profile-user-img img-responsive img-circle photo-mhs-detail" src="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User profile picture">

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
						                <li class="list-group-item list-tgl-masuk" style="display: none;">
						                  <b>Tanggal Masuk</b> <p class="pull-right detail-data-mhs detail-tgl_masuk_angkatan"></p>
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
	        	<div class="form-container">
		            <form action="" class="hide-modal-content" id="form-input" enctype="multipart/form-data" style="display: none;">
			            <div class="row">
			            	<div class="col-md-4 col-xs-5">
				      			<div class="form-group" id="thn_angkatan">
				                  <label for="thn_angkatan">Tahun Angkatan</label>
				                  <select class="form-control select2 select2-remote-dt select2_thn_angkatan thn_angkatan" style="width: 100%;" name="thn_angkatan"></select>
				                </div>		            		            
				            </div>
				            <div class="col-md-6 col-xs-7">
				      			<div class="form-group" id="id_pd_mhs">
				                  <label for="id_pd_mhs">Program Studi</label>
				                  <select class="form-control select2 select2-remote-dt select2_prodi id_pd_mhs" style="width: 100%;" name="id_pd_mhs"></select>
				                </div>
				            </div>
			            </div>
			            <div class="row">
				            <div class="col-md-12">
					          <!-- Custom Tabs -->
						        <div class="nav-tabs-custom nav-info">
						            <ul class="nav nav-tabs">
						              <li class="active open-tab"><a href="#tab_dt_mhs" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Data Mahasiswa</a></li>
						              <li class="tab_ortu close-tab"><a href="#tab_ortu" data-toggle="tab" aria-expanded="false"><span class="fa fa-male"></span><span class="fa fa-female"></span> Data Orang Tua & Wali</a></li>
						              <li class="close-tab"><a href="#tab_media" data-toggle="tab" aria-expanded="false"><span class="fa fa-image"></span> Data Media</a></li>
						              <li class="pull-right"><a href="" class="text-muted" id="refresh-form"><i class="glyphicon glyphicon-refresh"></i></a></li>
						            </ul>
						            <div class="tab-content">
										<div class="tab-pane active open-dt-tab" id="tab_dt_mhs">
											<div class="tab-overflow-container container-form-mhs">
												<div class="row">
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="nisn">
															<label for="nisn">NIM</label>
															<input type="number" class="form-control nisn" name="nisn" placeholder="Masukkan NIM mahasiswa">
										                </div>
										                <div class="form-group" id="nama">
															<label for="nama">Nama</label>
															<input type="text" class="form-control nama" name="nama" placeholder="Masukkan nama mahasiswa">
										                </div>
										                <div class="form-group" id="jk">
										                	<label for="jk">Jenis Kelamin</label>
										                	<div class="form-group">
															<label>
											                  <input type="radio" class="L" name="jk" value="L">
											                  Laki-Laki
											                </label>&nbsp&nbsp
											                <label>
											                  <input type="radio" class="P" name="jk" value="P">
											                  Perempuan
											                </label>
											                </div>
														</div>
										                <div class="form-group" id="tmp_lhr">
															<label for="tmp_lhr">Tempat Lahir</label>
															<input type="text" class="form-control tmp_lhr" name="tmp_lhr" placeholder="Masukkan tempat lahir">
										                </div>
										                <div class="form-group" id="tgl_lhr">
															<label for="tgl_lhr">Tanggal Lahir</label>
															<div class="input-group date">
																<div class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</div>
																<input type="text" class="form-control pull-right datepicker tgl_lhr" name="tgl_lhr" placeholder="Contoh: 1995-08-14">
															</div>
										                </div>
										                <div class="form-group" id="agama">
										                  <label for="agama">Agama</label>				                  
										                  <select class="form-control select2 select2_agama agama" style="width: 100%;" name="agama">
										                  	<option value=""></option>
										                  	<option value="Islam">Islam</option>
										                  	<option value="Kristen">Kristen</option>
										                  	<option value="Katholik">Katholik</option>
										                  	<option value="Budha">Budha</option>
										                  	<option value="Hindu">Hindu</option>
										                  	<option value="Konghucu">Konghucu</option>
										                  	<option value="Lainnya">Lainnya</option>
										                  </select>
										                </div>
										                <div class="form-group" id="alamat">
															<label for="alamat">Alamat</label>
															<input type="text" class="form-control alamat" name="alamat" id="alamat" placeholder="Masukkan alamat">
										                </div>
										                <div class="form-group">
															<label for="nik">NIK</label>
															<input type="number" class="form-control nik" name="nik" id="nik" placeholder="Masukkan NIK mahasiswa">
										                </div>
										                <div class="form-group">
										                	<div class="row">
											                	<div class="col-md-6 col-xs-6">
																	<label for="rt">RT</label>
																	<input type="number" class="form-control rt" name="rt" id="rt" placeholder="Contoh 04">
																</div>
																<div class="col-md-6 col-xs-6">
																	<label for="rw">RW</label>
																	<input type="number" class="form-control rw" name="rw" id="rw" placeholder="Contoh 01">
																</div>
															</div>
										                </div>
													</section>
									                <section class="col-md-6 col-xs-6">
										                <div class="form-group">
															<label for="dusun">Dusun</label>
															<input type="text" class="form-control dusun" name="dusun" id="dusun" placeholder="Masukkan dusun">
										                </div>
										                <div class="form-group">
															<label for="kelurahan">Kelurahan</label>
															<input type="text" class="form-control kelurahan" name="kelurahan" id="kelurahan" placeholder="Masukkan kelurahan">
										                </div>
										                <div class="form-group">
															<label for="kecamatan">Kecamatan</label>
															<input type="text" class="form-control kecamatan" name="kecamatan" id="kecamatan" placeholder="Masukkan kecamatan">
										                </div>
										                <div class="form-group">
															<label for="kode_pos">Kode Pos</label>
															<input type="number" class="form-control kode_pos" name="kode_pos" id="kode_pos" placeholder="Contoh: 91921">
										                </div>
										                <div class="form-group">
										                  <label for="jns_tinggal">Jenis Tinggal</label>				                  
										                  <select class="form-control select2 select2_jns_tinggal jns_tinggal" style="width: 100%;" name="jns_tinggal">
										                  	<option value=""></option>
										                  	<option value="Bersama orang tua">Bersama orang tua</option>
										                  	<option value="Wali">Wali</option>
										                  	<option value="Asrama">Asrama</option>
										                  	<option value="Lainnya">Lainnya</option>				                  	
										                  </select>
										                </div>
										                <div class="form-group">
										                  <label for="alt_trans">Alat Transportasi</label>				                  
										                  <select class="form-control select2 select2_alt_trans alt_trans" style="width: 100%;" name="alt_trans">
										                  	<option value=""></option>
										                  	<option value="Sepeda motor">Sepeda motor</option>
										                  	<option value="Kendaraan pribadi">Kendaraan pribadi</option>
										                  	<option value="Ojek">Ojek</option>
										                  	<option value="Angkutan umum/bus/pete-pete">Angkutan umum/bus/pete-pete</option>
										                  	<option value="Andong/bendi/sado/dokar/delman/becak">Andong/bendi/sado/dokar/delman/becak</option>
										                  	<option value="Mobil/bus antar jemput">Mobil/bus antar jemput</option>
										                  	<option value="Sepeda">Sepeda</option>
										                  	<option value="Jalan kaki">Jalan kaki</option>				                  	
										                  	<option value="Lainnya">Lainnya</option>				                  	
										                  </select>
										                </div>
										                <div class="form-group">
															<label for="tlp">Telepon</label>
															<input type="number" class="form-control tlp" name="tlp" id="tlp" placeholder="Masukkan nomor telepon">
										                </div>
										                <div class="form-group" id="hp">
															<label for="hp">Nomor HP</label>
															<input type="number" class="form-control hp" name="hp" placeholder="Contoh: 082336826***">
										                </div>
										                <div class="form-group" id="email">
															<label for="email">Email</label>
															<input type="email" class="form-control email" name="email" placeholder="Contoh: muh.di****@gma**.com">
										                </div>
													</section>
								                </div>
								            </div>
							            </div>
						              	<div class="tab-pane close-dt-tab" id="tab_ortu">
						              		<div class="tab-overflow-container container-form-mhs">
								              	<div class="row tab-content-head">
								              		<div class="col-md-12">
								              			<strong>Data Ayah</strong>
								              		</div>
								              	</div>
								                <div class="row">
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="nm_ayah">
															<label for="nm_ayah">Nama Ayah</label>
															<input type="text" class="form-control nm_ayah" name="nm_ayah" placeholder="Masukkan nama ayah mahasiswa">
										                </div>
										                <div class="form-group" id="thn_lhr_ayah">
															<label for="thn_lhr_ayah">Tahun Lahir</label>
															<input type="number" class="form-control thn_lhr_ayah" name="thn_lhr_ayah" placeholder="Contoh: 1984">
										                </div>
										                <div class="form-group" id="pendi_ayah">
										                  <label for="pendi_ayah">Jenjang Pendidikan</label>				                  
										                  <select class="form-control select2 select2_jenjang_pendi pendi_ayah" style="width: 100%;" name="pendi_ayah">
										                  	<option value=""></option>
										                  	<option value="SD / sederajat">SD / sederajat</option>					                  	
										                  	<option value="SMP / sederajat">SMP / sederajat</option>
										                  	<option value="SMA / sederajat">SMA / sederajat</option>
										                  	<option value="D1">D1</option>
										                  	<option value="D3">D3</option>
										                  	<option value="S1">S1</option>
										                  	<option value="S2">S2</option>
										                  	<option value="S3">S3</option>
										                  	<option value="Putus SD">Putus SD</option>
										                  	<option value="Tidak sekolah">Tidak sekolah</option>
										                  	<option value="Lainnya">Lainnya</option>				                  	
										                  </select>
										                </div>					                
													</section>
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="pekerjaan_ayah">
										                  <label for="pekerjaan_ayah">Pekerjaan</label>				                  
										                  <select class="form-control select2 select2_pekerjaan pekerjaan_ayah" style="width: 100%;" name="pekerjaan_ayah">
										                  	<option value=""></option>
										                  	<option value="Buruh">Buruh</option>
										                  	<option value="Petani">Petani</option>
										                  	<option value="Wiraswata">Wiraswata</option>
										                  	<option value="Wirausaha">Wirausaha</option>
										                  	<option value="Karyawan swasta">Karyawan swasta</option>
										                  	<option value="PNS/TNI/Porli">PNS/TNI/Porli</option>					                  	
										                  	<option value="Nelayan">Nelayan</option>
										                  	<option value="Pedagang kecil">Pedagang kecil</option>					                  	
										                  	<option value="Tidak bekerja">Tidak bekerja</option>
										                  	<option value="Sudah meninggal">Sudah meninggal</option>
										                  	<option value="Lainnya">Lainnya</option>				                  	
										                  </select>
										                </div>
										                <div class="form-group" id="penghasilan_ayah">
										                  <label for="penghasilan_ayah">Penghasilan</label>				                  
										                  <select class="form-control select2 select2_penghasilan penghasilan_ayah" style="width: 100%;" name="penghasilan_ayah">
										                  	<option value=""></option>
										                  	<option value="Kurang dari Rp. 500.000">Kurang dari Rp. 500.000</option>
										                  	<option value="Kurang dari Rp. 1000.000">Kurang dari Rp. 1.000.000</option>
										                  	<option value="Rp. 500.000 - Rp. 1.000.000">Rp. 500.000 - Rp. 1.000.000</option>
										                  	<option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
										                  	<option value="Rp. 2.000.000 - Rp. 5.000.000">Rp. 2.000.000 - Rp. 5.000.000</option>
										                  	<option value="Lebih dari Rp. 5.000.000">Lebih dari Rp. 5.000.000</option>
										                  </select>
										                </div>
										                <div class="form-group" id="nik_ayah">
															<label for="nik_ayah">NIK</label>
															<input type="number" class="form-control nik_ayah" name="nik_ayah" placeholder="Masukkan NIK">
										                </div>
													</section>
												</div>
												<div class="row tab-content-head">
								              		<div class="col-md-12">
								              			<strong>Data Ibu</strong>
								              		</div>
								              	</div>
												<div class="row">
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="nm_ibu">
															<label for="nm_ibu">Nama Ibu</label>
															<input type="text" class="form-control nm_ibu" name="nm_ibu" placeholder="Masukkan nama ibu mahasiswa">
										                </div>
										                <div class="form-group" id="thn_lhr_ibu">
															<label for="thn_lhr_ibu">Tahun Lahir</label>
															<input type="number" class="form-control thn_lhr_ibu" name="thn_lhr_ibu" placeholder="Contoh: 1984">
										                </div>
										                <div class="form-group" id="pendi_ibu">
										                  <label for="pendi_ibu">Jenjang Pendidikan</label>				                  
										                  <select class="form-control select2 select2_jenjang_pendi pendi_ibu" style="width: 100%;" name="pendi_ibu">
										                  	<option value=""></option>
										                  	<option value="SD / sederajat">SD / sederajat</option>					                  	
										                  	<option value="SMP / sederajat">SMP / sederajat</option>
										                  	<option value="SMA / sederajat">SMA / sederajat</option>
										                  	<option value="D1">D1</option>
										                  	<option value="D3">D3</option>
										                  	<option value="S1">S1</option>
										                  	<option value="S2">S2</option>
										                  	<option value="S3">S3</option>
										                  	<option value="Putus SD">Putus SD</option>
										                  	<option value="Tidak sekolah">Tidak sekolah</option>
										                  	<option value="Lainnya">Lainnya</option>				                  	
										                  </select>
										                </div>					                
													</section>
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="pekerjaan_ibu">
										                  <label for="pekerjaan_ibu">Pekerjaan</label>				                  
										                  <select class="form-control select2 select2_pekerjaan pekerjaan_ibu" style="width: 100%;" name="pekerjaan_ibu">
										                  	<option value=""></option>
										                  	<option value="Buruh">Buruh</option>
										                  	<option value="Petani">Petani</option>
										                  	<option value="Wiraswata">Wiraswata</option>
										                  	<option value="Wirausaha">Wirausaha</option>
										                  	<option value="Karyawan swasta">Karyawan swasta</option>
										                  	<option value="PNS/TNI/Porli">PNS/TNI/Porli</option>					                  	
										                  	<option value="Nelayan">Nelayan</option>
										                  	<option value="Pedagang kecil">Pedagang kecil</option>					                  	
										                  	<option value="Tidak bekerja">Tidak bekerja</option>
										                  	<option value="Sudah meninggal">Sudah meninggal</option>
										                  	<option value="Lainnya">Lainnya</option>				                  	
										                  </select>
										                </div>
										                <div class="form-group" id="penghasilan_ibu">
										                  <label for="penghasilan_ibu">Penghasilan</label>				                  
										                  <select class="form-control select2 select2_penghasilan penghasilan_ibu" style="width: 100%;" name="penghasilan_ibu">
										                  	<option value=""></option>
										                  	<option value="Kurang dari Rp. 500.000">Kurang dari Rp. 500.000</option>
										                  	<option value="Kurang dari Rp. 1000.000">Kurang dari Rp. 1.000.000</option>
										                  	<option value="Rp. 500.000 - Rp. 1.000.000">Rp. 500.000 - Rp. 1.000.000</option>
										                  	<option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
										                  	<option value="Rp. 2.000.000 - Rp. 5.000.000">Rp. 2.000.000 - Rp. 5.000.000</option>
										                  	<option value="Lebih dari Rp. 5.000.000">Lebih dari Rp. 5.000.000</option>
										                  </select>
										                </div>
										                <div class="form-group" id="nik_ibu">
															<label for="nik_ibu">NIK</label>
															<input type="number" class="form-control nik_ibu" name="nik_ibu" placeholder="Masukkan NIK">
										                </div>
													</section>
												</div>
												<div class="row tab-content-head">
								              		<div class="col-md-12">
								              			<strong>Data Wali</strong>
								              		</div>
								              	</div>
								              	<div class="row">
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="nm_wali">
															<label for="nm_wali">Nama Wali</label>
															<input type="text" class="form-control nm_wali" name="nm_wali" placeholder="Masukkan nama wali mahasiswa">
												        </div>
												        <div class="form-group" id="thn_lhr_wali">
															<label for="thn_lhr_wali">Tahun Lahir</label>
															<input type="number" class="form-control thn_lhr_wali" name="thn_lhr_wali" placeholder="Contoh: 1984">
												        </div>
												        <div class="form-group" id="pendi_wali">
												          <label for="pendi_wali">Jenjang Pendidikan</label>				                  
												          <select class="form-control select2 select2_jenjang_pendi pendi_wali" style="width: 100%;" name="pendi_wali">
												          	<option value=""></option>
												          	<option value="SD / sederajat">SD / sederajat</option>					                  	
												          	<option value="SMP / sederajat">SMP / sederajat</option>
												          	<option value="SMA / sederajat">SMA / sederajat</option>
												          	<option value="D1">D1</option>
												          	<option value="D3">D3</option>
												          	<option value="S1">S1</option>
												          	<option value="S2">S2</option>
												          	<option value="S3">S3</option>
												          	<option value="Putus SD">Putus SD</option>
												          	<option value="Tidak sekolah">Tidak sekolah</option>
												          	<option value="Lainnya">Lainnya</option>				                  	
												          </select>
												        </div>					                
													</section>
													<section class="col-md-6 col-xs-6">
														<div class="form-group" id="pekerjaan_wali">
												          <label for="pekerjaan_wali">Pekerjaan</label>				                  
												          <select class="form-control select2 select2_pekerjaan pekerjaan_wali" style="width: 100%;" name="pekerjaan_wali">
												          	<option value=""></option>
												          	<option value="Buruh">Buruh</option>
												          	<option value="Petani">Petani</option>
												          	<option value="Wiraswata">Wiraswata</option>
												          	<option value="Wirausaha">Wirausaha</option>
												          	<option value="Karyawan swasta">Karyawan swasta</option>
												          	<option value="PNS/TNI/Porli">PNS/TNI/Porli</option>					                  	
												          	<option value="Nelayan">Nelayan</option>
												          	<option value="Pedagang kecil">Pedagang kecil</option>					                  	
												          	<option value="Tidak bekerja">Tidak bekerja</option>
												          	<option value="Sudah meninggal">Sudah meninggal</option>
												          	<option value="Lainnya">Lainnya</option>				                  	
												          </select>
												        </div>
												        <div class="form-group" id="penghasilan_wali">
												          <label for="penghasilan_wali">Penghasilan</label>				                  
												          <select class="form-control select2 select2_penghasilan penghasilan_wali" style="width: 100%;" name="penghasilan_wali">
												          	<option value=""></option>
												          	<option value="Kurang dari Rp. 500.000">Kurang dari Rp. 500.000</option>
												          	<option value="Kurang dari Rp. 1000.000">Kurang dari Rp. 1.000.000</option>
												          	<option value="Rp. 500.000 - Rp. 1.000.000">Rp. 500.000 - Rp. 1.000.000</option>
												          	<option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
												          	<option value="Rp. 2.000.000 - Rp. 5.000.000">Rp. 2.000.000 - Rp. 5.000.000</option>
												          	<option value="Lebih dari Rp. 5.000.000">Lebih dari Rp. 5.000.000</option>
												          </select>
												        </div>
												        <div class="form-group" id="nik_wali">
															<label for="nik_wali">NIK</label>
															<input type="number" class="form-control nik_wali" name="nik_wali" placeholder="Masukkan NIK">
										                </div>
													</section>
												</div>
											</div>
						              	</div>
						              	<div class="tab-pane close-dt-tab" id="tab_media">
						              		<div class="tab-overflow-container container-form-mhs">
							              		<div class="row ft-mhs-form" style="display: none;">
								                	<div class="col-md-6 col-xs-6">
												        <div class="box box-success">
												            <div class="box-body box-profile">
												              <img class="profile-user-img img-responsive img-circle photo-usr-edit-n" src="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User profile picture" default-photo="<?php echo get_template_assets('dist/img/user-image.png') ?>">
												              <h3 class="profile-username text-center" style="font-size: 17px">Foto Sekarang</h3>
												              <p class="text-muted text-center photo-file-name"></p>
												              <div class="text-center"><a class="btn btn-danger remove-photo" style="display: none;"><span class="fa fa-trash"></span> Hapus Foto</a></div>
												            </div>
												            <!-- /.box-body -->
												        </div>
								                	</div>
								                	<div class="col-md-6 col-xs-6">
												        <div class="box box-success">
												            <div class="box-body box-profile">
												              <img class="profile-user-img img-responsive img-circle new-photo-usr" src="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User profile picture" default-photo="<?php echo get_template_assets('dist/img/user-image.png') ?>">
												              <h3 class="profile-username text-center" style="font-size: 17px">Foto Baru</h3>
												              <p class="text-muted text-center new-photo-file-name">Nama File: -</p>
												            </div>
												            <!-- /.box-body -->
												        </div>
								                	</div>
								                </div>
								                <div class="row">
								                	<div class="col-md-12">
								                		<div class="form-group">
															<label for="photo_mhs">Upload File Foto</label>
															<input type="file" class="form-control file-select-foto photo_mhs" name="photo_mhs">
															<p class="help-block validation-ft-inp"></p>
										                </div>
										                <p><b>Note</b>:
										                	<ol>
										                		<li>Dimensi / ukuran foto: 
										                			<ul style="list-style: disc;margin-left: -24px">
										                				<li>Lebar maks. 512px - min. 312px</li>
										                				<li>Tinggi maks. 512px - min. 312px</li>
										                				<li>Rek. lebar 398px - 400px dan tinggi 408px - 410px </li>
										                			</ul>
										                		</li>
										                		<li>Ukuran file maks. 1MB</li>
										                		<li>Format foto harus jpg atau png</li>
										                	</ol>
										                </p>
								                	</div>
								                </div>
								            </div>
						              	</div>
						            </div>
						            <!-- /.tab-content -->
						        </div>
						        <!-- nav-tabs-custom -->
					        </div>
				        </div>		        
				        <input type="hidden" id="data" name="data_mhs">
				        <input type="hidden" class="id" name="id_mhs">
				        <input type="hidden" class="id_ortu" name="id_ortu">
				        <input type="hidden" class="nisn" name="nisn_sebelumnya">
				        <input type="hidden" class="thn_angkatan" name="thn_angkatan_sekarang">
				        <input type="hidden" class="jk" name="jk_sekarang">
				        <input type="hidden" class="photo-plc" name="photo_mhs">
		            </form>
		            <form action="" class="hide-modal-content" id="form-get" style="display: none;">
		            	<div class="row centered-content">
			            	<div class="col-md-4 col-xs-5">
				      			<div class="form-group thn_angkatan">
				                  <label for="thn_angkatan">Tahun Angkatan</label>		                  
				                  <select class="form-control select2 select2_thn_angkatan thn_angkatan" style="width: 100%;" name="thn_angkatan"></select>
				                </div>		            		            
				            </div>
				            <div class="col-md-5 col-xs-6">
				      			<div class="form-group prodi">
				                  <label for="prodi">Program Studi</label>		                  
				                  <select class="form-control select2 select2_prodi prodi" style="width: 100%;" name="prodi"></select>
				                </div>		            		            
				            </div>
				            <input type="hidden" name="cari_thn_angkatan" id="cari_thn_angkatan">
				            <input type="hidden" name="cari_prodi" id="cari_prodi">
			            </div>
		            </form>
		            <form action="" class="hide-modal-content" id="form-pindah-kelas" style="display: none;">
		            	<div class="row centered-content">
			            	<div class="col-md-12">
				      			<div class="centered-text jumlah"></div>
				            </div>
			            </div>
			            <div class="row centered-content">
				            <div class="col-md-6 col-xs-10">
				      			<div class="form-group id_pd_mhs">
				                  <select class="form-control select2 select2_prodi id_pd_mhs" style="width: 100%;" name="id_pd_mhs"></select>
				                </div>		            		            
				            </div>		            
			            </div>
		            </form>
		            <form action="" class="hide-modal-content" id="form-input-alumni" style="display: none;">
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
				        <input type="hidden" name="data_alumni">
		            </form>
		            <form action="" class="hide-modal-content" id="form-input-mhs-do" style="display: none;">
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
				        <input type="hidden" name="data_mhs_do">
		            </form>
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