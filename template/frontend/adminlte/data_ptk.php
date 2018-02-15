<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-3 col-sm-4">
	          	<div class="box box-widget widget-user box-profile">
		            <!-- Add the bg color to the header using any of the bg-* classes -->
		            <div class="widget-user-header bg-yellow" style="height: 145px">
		              <h3 class="widget-user-username profil-nama_ptk"></h3>
		              <h5 class="widget-user-desc profil-nuptk"></h5>
		            </div>
		            <div class="widget-user-image" style="margin-top: 30px;">
		              <img class="img-circle" src="<?php echo $_SESSION['photo_u']; ?>" alt="User profile picture">
		            </div>
		            <div class="box-footer">
		              	<div class="row">
			                <div class="col-md-4 col-sm-4 col-xs-4 border-right">
			                  <div class="description-block" title="Jumlah riwayat pendidikan tenaga pendidik">
			                  	<span class="description-text"><i class="fa fa-university"></i></span>
			                    <h5 class="description-header profil-rwt-pendidikan-ptk">-</h5>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			                <div class="col-md-4 col-sm-4 col-xs-4 border-right">
			                  <div class="description-block" title="Jumlah riwayat mengajar">
			                  	<span class="description-text"><i class="fa fa-book"></i></span>
			                    <h5 class="description-header profil-rwt-mengajar-ptk">-</h5>
			                  </div>
			                  <!-- /.description-block -->
			                </div>
			                <!-- /.col -->
			                <div class="col-md-4 col-sm-4 col-xs-4">
			                  <div class="description-block" title="Jumlah riwayat penelitian">
			                  	<span class="description-text"><i class="fa fa-flask"></i></span>
			                    <h5 class="description-header profil-rwt-penelitian-ptk">-</h5>
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
					                  <b>Status Ikatan Kerja</b> <p class="pull-right profil-status_ptk"></p>
					                </li>
					                <li class="list-group-item">
					                  <b>Status Keaktifan</b> <p class="pull-right profil-status_aktif_ptk"></p>
					                </li>
					                <li class="list-group-item">
					                  <b>Pendidikan Tertinggi</b> <p class="pull-right profil-jenjang"></p>
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
		        
		              <h3 class="profile-username text-center profil-nama_ptk" style="font-size: 17px"></h3>
		        
		              <p class="text-muted text-center profil-nuptk"></p>
		        
		              <p class="text-muted text-center"></p>
		        
		              <ul class="list-group list-group-unbordered">
		                <li class="list-group-item">
		                  <b>Status Ikatan Kerja</b> <p class="pull-right profil-status_ptk"></p>
		                </li>
		                <li class="list-group-item">
		                  <b>Status Keaktifan</b> <p class="pull-right profil-status_aktif_ptk"></p>
		                </li>
		                <li class="list-group-item">
		                  <b>Pendidikan Tertinggi</b> <p class="pull-right profil-jenjang"></p>
		                </li>
		              </ul>
		        
		              <?php if ($_SESSION['status_verifikasi'] == 0 || $_SESSION['status_verifikasi'] == 2): ?>
		              <a href="" class="btn btn-success btn-block verifikasi-data"><b><i class="fa fa-check"></i> Verifikasi Data</b></a>
		              <a href="" class="btn btn-danger btn-block verifikasi-salah"><b><i class="fa fa-times"></i> Data Salah</b></a>
		              <?php endif ?>
		              <?php if ($_SESSION['status_verifikasi'] == 1): ?>
		              <button class="btn btn-success btn-block" style="pointer-events: none;"><b><i class="fa fa-check-square-o"></i> Data Terverifikasi</b></button>
		              <?php endif ?>
		              
		            </div>
		            /.box-body
		        </div> -->
		          <!-- /.box -->		      
	        </div>
			<div class="col-md-9 col-sm-8">
				<div class="nav-tabs-custom nav-warning" id="detail-ptk">
		            <ul class="nav nav-tabs">
		              <li class="active tab_ptk"><a href="#detail_ptk" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Data Tenaga Pendidik</a></li>	
		              <!-- <li class="false tab_riwayat_pend"><a href="#riwayat_pend_ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-book"></span> Pendidikan</a></li> -->
		              <li class="false tab_riwayat_ajar"><a href="#riwayat_ajar_ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Riwayat Mengajar</a></li>
		              <li class="false tab_penelitian"><a href="#penelitian_ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-flask"></span> Riwayat Penelitian</a></li>
		              <li class="tab_info_akun"><a href="#tab_info_akun" data-toggle="tab" aria-expanded="false"><span class="fa fa-user-circle"></span> Info Akun</a></li>
		            </ul>
		            <div class="tab-content">
						<div class="tab-pane active" id="detail_ptk">
							<div class="row">
			              		<div class="col-md-12">
			              			<strong>Biodata Tenaga Pendidik</strong>
			              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
			              		</div>
			              	</div>
							<div class="row">
								<section class="col-md-6 col-xs-6">
									<dl class="dl-horizontal">
										<dt>NIDN</dt>
						                <dd id="detail-nuptk"></dd>

						                <dt>Nama</dt>
						                <dd id="detail-nama_ptk"></dd>

						                <dt>Program Studi</dt>
						                <dd id="detail-nama_prodi"></dd>

						                <dt>NIP</dt>
						                <dd id="detail-nip"></dd>

						                <dt>NIK</dt>
						                <dd id="detail-nik_ptk"></dd>

						                <dt>Jenis Kelamin</dt>
						                <dd id="detail-jk_ptk"></dd>

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
				                <section class="col-md-6 col-xs-6">
				                	<dl class="dl-horizontal">
				                		<dt>Agama</dt>
						                <dd id="detail-agama_ptk"></dd>

						                <dt>Alamat</dt>
						                <dd id="detail-alamat_ptk"></dd>

						                <dt>RT/RW</dt>
						                <dd id="detail-rt-rw"><font id="detail-rt_ptk"></font>/<font id="detail-rw_ptk"></font></dd>

				                		<dt>Dusun</dt>
						                <dd id="detail-dusun_ptk"></dd>

										<dt>Kelurahan</dt>
						                <dd id="detail-kelurahan_ptk"></dd>

						                <dt>Kecamatan</dt>
						                <dd id="detail-kecamatan_ptk"></dd>

						                <dt>Kode Pos</dt>
						                <dd id="detail-kode_pos_ptk"></dd>

						                <dt>No. Telepon</dt>
						                <dd id="detail-tlp_ptk"></dd>

						                <dt>No. HP</dt>
						                <dd id="detail-hp_ptk"></dd>

						                <dt>Email</dt>
						                <dd id="detail-email_ptk"></dd>
					              	</dl>
								</section>
			                </div>

			                <div class="row">
			              		<div class="col-md-12">
			              			<strong>Pendidikan</strong>
			              			<div style="margin-top:3px;margin-bottom: 10px;border-bottom: 2px solid grey"></div>
			              		</div>
			              	</div>
			              	<div class="row">
			              		<div class="col-md-12">
			              			<table class="table table-bordered table-striped table-hover tbl-pend-ptk">
						                <thead>
							                <tr>
							                  <th class="text-center" style="width: 50px">No</th>
							                  <th>Perguruan Tinggi</th>
							                  <th>Gelar Akademik</th>
							                  <th class="text-center hideClass" style="width: 150px">Tanggal Ijazah</th>
							                  <th class="text-center" style="width: 10px">Jejang</th>
							                </tr>
						                </thead>
						                <tbody>
						                </tbody>
						                <tfoot>
							                <tr>
							                  <th class="text-center" style="width: 50px">No</th>
							                  <th>Perguruan Tinggi</th>
							                  <th>Gelar Akademik</th>
							                  <th class="text-center hideClass" style="width: 150px">Tanggal Ijazah</th>
							                  <th class="text-center" style="width: 10px">Jejang</th>
							                </tr>
						                </tfoot>
						            </table>
			              		</div>
			              	</div>
		              	</div>
		              	<div class="tab-pane fade" id="riwayat_pend_ptk">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover tbl-pend-ptk">
						                <thead>
							                <tr>
							                  <th class="text-center" style="width: 50px">No</th>
							                  <th>Perguruan Tinggi</th>
							                  <th>Gelar Akademik</th>
							                  <th class="text-center hideClass" style="width: 150px">Tanggal Ijazah</th>
							                  <th class="text-center" style="width: 10px">Jejang</th>
							                </tr>
						                </thead>
						                <tbody>
						                </tbody>
						                <tfoot>
							                <tr>
							                  <th class="text-center" style="width: 50px">No</th>
							                  <th>Perguruan Tinggi</th>
							                  <th>Gelar Akademik</th>
							                  <th class="text-center hideClass" style="width: 150px">Tanggal Ijazah</th>
							                  <th class="text-center" style="width: 10px">Jejang</th>
							                </tr>
						                </tfoot>
						            </table>
								</div>
			                </div>
		              	</div>
		              	<div class="tab-pane fade" id="riwayat_ajar_ptk">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover tbl-riwayat-ptk">
						                <thead>
							                <tr>
							                  <th class="text-center" style="width: 50px">No</th>
							                  <th class="text-center" style="width: 130px">Tahun Akademik</th>
							                  <th class="text-center" style="width: 80px">Kode MK</th>
							                  <th style="width: 250px">Nama Mata Kuliah</th>
							                  <th class="text-center" style="width: 80px">Kelas</th>
							                  <th>Program Studi</th>
							                </tr>
						                </thead>
						                <tbody>
						                </tbody>
						                <tfoot>
							                <tr>
							                  <th class="text-center">No</th>
							                  <th class="text-center">Tahun Akademik</th>
							                  <th class="text-center">Kode MK</th>
							                  <th>Nama Mata Kuliah</th>
							                  <th class="text-center">Kelas</th>
							                  <th>Program Studi</th>
							                </tr>
						                </tfoot>
						            </table>
								</div>
			                </div>
		              	</div>
		              	<div class="tab-pane fade" id="penelitian_ptk">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover tbl-penelitian-ptk">
						                <thead>
							                <tr>
							                  <th class="text-center" style="width: 50px">No</th>
							                  <th style="width: 250px">Judul Penelitian</th>
							                  <th class="text-center" style="width: 150px">Bidang Ilmu</th>
							                  <th style="width: 230px">Lembaga</th>
							                </tr>
						                </thead>
						                <tbody>
						                </tbody>
						                <tfoot>
							                <tr>
							                  <th class="text-center">No</th>
							                  <th>Judul Penelitian</th>
							                  <th class="text-center">Bidang Ilmu</th>
							                  <th>Lembaga</th>
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
								                <dd><?php echo $_SESSION['nuptk']; ?></dd>

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
								                <dd class="detail-nidn"></dd>
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
											<div class="form-group">
												<label for="nama">Password Lama</label>
												<input type="password" class="form-control old-password" name="old-password" placeholder="Masukkan password lama">
							                </div>
							                <div class="form-group">
												<label for="nama">Password Baru</label>
												<input type="password" class="form-control new-password" name="new-password" placeholder="Masukkan password baru">
							                </div>
							                <div class="form-group">
												<label for="nama">Masukkan Ulang Password Baru</label>
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

				<!-- <div class="box box-warning box-solid" id="box-ptk">
					<div class="box-header with-border">
						<h3 class="box-title">Data Tenaga Pendidik</h3>
						<div class="box-tools pull-right">							
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>														
						</div>
					/.box-tools
					</div>
					/.box-header
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								
							</div>
						</div>
					</div>
					/.box-body
					<div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
				</div> -->
			</div>		
		</div>		
	</section>

<?php echo get_templete_part('template_part/footer'); ?>