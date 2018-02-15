<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-4">
	          	<!-- Profile Image -->
	          	<div class="box box-widget widget-user box-profile">
		            <!-- Add the bg color to the header using any of the bg-* classes -->
		            <div class="widget-user-header bg-yellow">
		              <h3 class="widget-user-username profil-nama"></h3>
		              <h5 class="widget-user-desc profil-nisn"></h5>
		            </div>
		            <div class="widget-user-image">
		              <img class="img-circle" src="<?php echo $_SESSION['photo_u']; ?>" alt="User profile picture">
		            </div>
		            <div class="box-footer">
		              	<div class="row">
			                <div class="col-md-4 col-sm-4 col-xs-4 border-right">
			                  <div class="description-block" title="Jumlah riwayat tahun akademik mahasiswa">
			                  	<span class="description-text"><i class="fa fa-calendar-check-o"></i></span>
			                    <h5 class="description-header profil-rwt-akademik">-</h5>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			                <div class="col-md-4 col-sm-4 col-xs-4 border-right">
			                  <div class="description-block" title="Jumlah riwayat studi mahasiswa">
			                  	<span class="description-text"><i class="fa fa-book"></i></span>
			                    <h5 class="description-header profil-rwt-studi">-</h5>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			                <div class="col-md-4 col-sm-4 col-xs-4">
			                  <div class="description-block" title="Jumlah">
			                  	<span class="description-text"><i class="fa fa-list"></i></span>
			                    <h5 class="description-header">-</h5>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
		              	</div>
		              	<!-- /.row -->
		              	<div class="row" style="margin-top: 10px">
		              		<div class="col-md-12">
		              			<ul class="list-group list-group-unbordered">
					                <li class="list-group-item">
					                  <b>Program Studi</b> <p class="pull-right profil-nama_prodi"></p>
					                </li>
					                <li class="list-group-item">
					                  <b>Tahun Angkatan</b> <p class="pull-right profil-tahun_angkatan"></p>
					                </li>
					                <li class="list-group-item">
					                  <b>Agama</b> <p class="pull-right profil-agama"></p>
					                </li>
					                <li class="list-group-item">
					                  <b>Status</b> <p class="pull-right profil-status_mhs"></p>
					                </li>
					                <li class="list-group-item tgl-mhs">
					                  <b></b> <p class="pull-right detail-data-mhs"></p>
					                </li>
				              	</ul>
		              		</div>
		              	</div>

		              	<?php if ($_SESSION['status_verifikasi'] == 0 || $_SESSION['status_verifikasi'] == 2): ?>
		              	<a href="" class="btn btn-success btn-block verifikasi-data"><b><i class="fa fa-check"></i> Verifikasi Data</b></a>
		              	<a href="" class="btn btn-danger btn-block verifikasi-salah"><b><i class="fa fa-times"></i> Data Salah</b></a>
		              	<?php endif ?>
		              	<?php if ($_SESSION['status_verifikasi'] == 1): ?>
		              	<button class="btn btn-success btn-block" style="cursor: default;pointer-events: none;"><b><i class="fa fa-check-square-o"></i> Data Terverifikasi</b></button>
		              	<?php endif ?>
		            </div>
		        </div>

		        <!-- <div class="box box-warning">
		            <div class="box-body box-profile">
		              <img class="profile-user-img img-responsive img-circle" src="<?php echo $_SESSION['photo_u']; ?>" alt="User profile picture">
		        
		              <h3 class="profile-username text-center profil-nama" style="font-size: 17px"></h3>
		              <p class="text-muted text-center profil-nisn"></p>
		        
		              <ul class="list-group list-group-unbordered">
		                <li class="list-group-item">
		                  <b>Program Studi</b> <p class="pull-right profil-nama_prodi"></p>
		                </li>
		                <li class="list-group-item">
		                  <b>Tahun Angkatan</b> <p class="pull-right profil-tahun_angkatan"></p>
		                </li>
		                <li class="list-group-item">
		                  <b>Agama</b> <p class="pull-right profil-agama"></p>
		                </li>
		                <li class="list-group-item">
		                  <b>Status</b> <p class="pull-right profil-status_mhs"></p>
		                </li>
		                <li class="list-group-item tgl-mhs">
		                  <b></b> <p class="pull-right detail-data-mhs"></p>
		                </li>
		              </ul>
		        
		              <?php if ($_SESSION['status_verifikasi'] == 0 || $_SESSION['status_verifikasi'] == 2): ?>
		              <a href="" class="btn btn-success btn-block verifikasi-data"><b><i class="fa fa-check"></i> Verifikasi Data</b></a>
		              <a href="" class="btn btn-danger btn-block verifikasi-salah"><b><i class="fa fa-times"></i> Data Salah</b></a>
		              <?php endif ?>
		              <?php if ($_SESSION['status_verifikasi'] == 1): ?>
		              <button class="btn btn-success btn-block" style="cursor: default;"><b><i class="fa fa-check-square-o"></i> Data Terverifikasi</b></button>
		              <?php endif ?>
		              
		            </div>
		            /.box-body
		        </div> -->
	          	<!-- /.box -->
	        </div>
			<div class="col-md-8">
				<div class="nav-tabs-custom nav-warning" id="detail-mhs">
		            <ul class="nav nav-tabs">
		              <li class="active tab_mhs"><a href="#detail_mhs" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Data Mahasiswa</a></li>
		              <li class="tab_riwayat_kuliah"><a href="#detail_riwayat_kuliah" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Riwayat Status Kuliah</a></li>
		              <li class="tab_riwayat_studi"><a href="#detail_riwayat_studi" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Riwayat Studi</a></li>
		              <li class="tab_info_akun"><a href="#tab_info_akun" data-toggle="tab" aria-expanded="false"><span class="fa fa-user-circle"></span> Info Akun</a></li>
		            </ul>
		            <div class="tab-content">
						<div class="tab-pane active" id="detail_mhs">
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
				                	<dl class="dl-horizontal">
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
						                <dd id="detail-nm_ayah"></dd>

						                <dt>Tahun Lahir</dt>
						                <dd id="detail-thn_lhr_ayah"></dd>

						                <dt>Jenjang Pendidikan</dt>
						                <dd id="detail-pendi_ayah"></dd>
					              	</dl>
								</section>
								<section class="col-md-6 col-xs-6">
									<dl class="dl-horizontal">						                
						                <dt>Pekerjaan</dt>
						                <dd id="detail-pekerjaan_ayah"></dd>

						                <dt>Penghasilan</dt>
						                <dd id="detail-penghasilan_ayah"></dd>

						                <dt>NIK</dt>
						                <dd id="detail-nik_ayah"></dd>
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
						                <dd id="detail-nm_ibu"></dd>

						                <dt>Tahun Lahir</dt>
						                <dd id="detail-thn_lhr_ibu"></dd>

						                <dt>Jenjang Pendidikan</dt>
						                <dd id="detail-pendi_ibu"></dd>
					              	</dl>
								</section>
								<section class="col-md-6 col-xs-6">
									<dl class="dl-horizontal">						                
						                <dt>Pekerjaan</dt>
						                <dd id="detail-pekerjaan_ibu"></dd>

						                <dt>Penghasilan</dt>
						                <dd id="detail-penghasilan_ibu"></dd>

						                <dt>NIK</dt>
						                <dd id="detail-nik_ibu"></dd>
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
						                <dd id="detail-nm_wali"></dd>

						                <dt>Tahun Lahir</dt>
						                <dd id="detail-thn_lhr_wali"></dd>

						                <dt>Jenjang Pendidikan</dt>
						                <dd id="detail-pendi_wali"></dd>
					              	</dl>
								</section>
								<section class="col-md-6 col-xs-6">
									<dl class="dl-horizontal">						                
						                <dt>Pekerjaan</dt>
						                <dd id="detail-pekerjaan_wali"></dd>

						                <dt>Penghasilan</dt>
						                <dd id="detail-penghasilan_wali"></dd>

						                <dt>NIK</dt>
						                <dd id="detail-nik_wali"></dd>
					              	</dl>
								</section>
							</div>
		              	</div> 
						<!-- /.tab-pane -->
						<div class="tab-pane fade" id="detail_riwayat_kuliah">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover tbl-riwayat-kuliah-mhs">
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
						<div class="tab-pane fade" id="detail_riwayat_studi">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover tbl-riwayat-studi-mhs">
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
		              	<div class="tab-pane fade" id="tab_info_akun">
							<div class="row">
								<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									<div class="box box-warning box-mp-controlp">
							            <div class="box-header with-border">
							              <h3 class="box-title">Detail Akun</h3>
							            </div>
							            <!-- /.box-header -->
							            <div class="box-body">
											<dl class="dl-horizontal">
								                <dt>Username</dt>
								                <dd><?php echo $_SESSION['nim']; ?></dd>

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
								                <dd class="detail-nim"></dd>
							              	</dl>
						                </div>
					                </div>
								</div>
								<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									<div class="box box-warning box-mp-controlp">
							            <div class="box-header with-border">
							              <h3 class="box-title">Ganti Password</h3>
							            </div>
							            <!-- /.box-header -->
							            <div class="box-body">
											<div class="form-group" id="old-password">
												<label for="old-password">Password Lama</label>
												<input type="password" class="form-control old-password" name="old-password" placeholder="Masukkan password lama">
							                </div>
							                <div class="form-group" id="new-password">
												<label for="new-password">Password Baru</label>
												<input type="password" class="form-control new-password" name="new-password" placeholder="Masukkan password baru">
							                </div>
							                <div class="form-group" id="renew-password">
												<label for="renew-password">Masukkan Ulang Password Baru</label>
												<input type="password" class="form-control renew-password" name="renew-password" placeholder="Masukkan ulang password baru">
							                </div>
							                <div class="form-group">
												<a href="" class="btn btn-success pull-right" id="change-pass"><i class="fa fa-key"></i> Simpan Password</a>
							                </div>
						                </div>
					                </div>
								</div>
							</div>
		              	</div>
		              <!-- /.tab-pane -->
		            </div>
		            <!-- /.tab-content -->
		            <?php if ($_SESSION['status_verifikasi'] != 1): ?>
		            <div class="box-footer">
		            	<div class="row">
		            		<div class="col-md-12">
		            			<h5 class="text-center"><li class="fa fa-info-circle"></li> Tolong check data anda!, jika ada informasi yang tidak sesuai silahkan klik tombol 
		            			<button class="btn btn-danger"><b><i class="fa fa-times"></i> Data Salah</b></button> dan klik tombol 
		            			<button class="btn btn-success"><b><i class="fa fa-check"></i> Verifikasi Data</b></button> sebagai tanda bahwa data yang ada sudah valid.
		            			</h5>
		            		</div>
		            	</div>
		            </div>
		            <?php endif ?>
				</div>
			</div>		
		</div>		
	</section>

<?php echo get_templete_part('template_part/footer'); ?>