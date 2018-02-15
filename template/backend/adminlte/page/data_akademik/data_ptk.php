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
	                    <button type="button" class="btn btn-warning dropdown-toggle disabled aksi" data-toggle="dropdown">
	                      <span class="caret"></span> Aksi
	                    </button>
	                    <ul class="dropdown-menu">
	                      <li><a href="#delete_selected" >Hapus</a></li>
	                    </ul>
	                  </div>
					</div> -->
					<div class="row" style="margin-bottom:-15px;">
						<div class="col-md-12 col-sm-6 col-xs-6">
			            	<div class="form-group">
			                  	<!-- <a href="#tambah" class="btn btn-info btn-block" id="tambah-data"><li class="fa fa-plus"></li>Tambah Data</a> -->
			                  	<div class="btn-group-vertical btn-block">
					                <div class="btn-group">
					                	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><li class="fa fa-plus"></li> Tambah Data</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#tambah" id="tambah-data"><span class="fa fa-user-secret"></span> Tenaga Pendidik</a></li>
											<li class="divider"></li>
											<li><a href="#tambah?data=pend_ptk"><span class="fa fa-book"></span> Riwayat Pendidikan</a></li>
											<li><a href="#tambah?data=research_ptk"><span class="fa fa-flask"></span> Penelitian</a></li>
										</ul>
					                </div>
				                </div>
			                </div>
			            </div>
			            <div class="col-md-12 col-sm-6 col-xs-6">
			      			<div class="form-group">
			                  <a href="#delete_selected" class="btn btn-danger btn-block disabled aksi"><li class="fa fa-trash"></li> Hapus</a>
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
					                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Data Tenaga Pendidik">
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-warning btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
				                    </span>
					            </div>
			                </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 semua-data" style="display: none;">
			      			<div class="form-group">
			                  <a href="" class="btn btn-success btn-block" id="semua-data" table-refresh=".tbl-data-ptk"><i class="fa fa-list"></i> Tampilkan Semua Data</a>
			                </div>
			            </div>
					</div>
					<hr style="border-bottom: 2px solid grey">
					<div class="row" style="margin-bottom:-15px">
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  <label>Status Keaktifan</label>
			                  <select class="form-control select2 select2_status_aktif_ptk filter-dt" style="width: 100%;">
			                  	<option value=""></option>
			                  	<option value="1">Aktif</option>
			                  	<option value="2">Tidak Aktif</option>
			                  	<option value="3">Tugas Belajar</option>
			                  	<option value="4">Ijin Belajar</option>
			                  	<option value="5">Lainnya</option>
			                  </select>
			                </div>
		                </div>
			            <div class="col-md-12 col-xs-6">
			      			<div class="form-group">
			                  <label>Program Studi</label>
			                  <select class="form-control select2 select2_prodi filter-dt" style="width: 100%;"></select>
			                </div>
			            </div>
			            <div class="col-md-12 col-xs-12">
			            	<div class="form-group">
			                  <a href="" class="btn btn-success btn-block disabled" id="tamp-data" table-refresh=".tbl-data-ptk"><i class="fa fa-list"></i> Tampilkan Data</a>
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
				<div class="box box-warning box-solid" id="box-guru">
					<div class="box-header with-border">
						<h3 class="box-title">Data Tenaga Pendidik</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" id="refresh-table-guru" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>														
						</div>
					<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-hover tbl-data-ptk datatable-dt" table-dt=".tbl-data-ptk" data-tbl-selected="check-all-guru check-guru" table-box="#box-guru">
					                <thead>
						                <tr>
						                	<th style="width: 5px"></th>
											<th style="width: 5px"><input type="checkbox" class="check-all-data check-all-guru" data-selected="check-guru" data-all-selected="check-all-guru" data-toggle=".aksi"></th>
											<th style="width: 100px">NIDN</th>
											<th style="width: 220px">Nama</th>
											<th style="width: 100px">Status Keaktifan</th>
											<th style="width: 10px">Status</th>
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
											<th style="width: 5px"><input type="checkbox" class="check-all-data check-all-guru" data-selected="check-guru" data-all-selected="check-all-guru" data-toggle=".aksi"></th>
											<th style="width: 100px">NIDN</th>
											<th style="width: 220px">Nama</th>
											<th style="width: 100px">Status Keaktifan</th>
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
				<div class="box box-warning box-solid" id="box-ptk" style="display: none;" data-search>
					<div class="box-header with-border">
						<h3 class="box-title">Detail Tenaga Pendidik</h3>
						<div class="box-tools pull-right">							
							<button type="button" class="btn btn-box-tool remove" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					<!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-3">
								<div class="box box-warning">
						            <div class="box-body box-profile">
						              <img class="profile-user-img img-responsive img-circle phot photo-ptk-detail" src="<?php echo get_templete_dir(dirname(__FILE__),'dist/img/user-image.png') ?>" alt="User profile picture">

						              <h3 class="profile-username text-center detail-nama_ptk" style="font-size: 17px"></h3>
						              <p class="text-muted text-center detail-nuptk"></p>
						              <p class="text-muted text-center"></p>
						              <ul class="list-group list-group-unbordered">
						                <li class="list-group-item">
						                  <b>Status Ikatan Kerja</b> <p class="pull-right detail-data-ptk detail-status_ptk"></p>
						                </li>
						                <li class="list-group-item">
						                  <b>Status Keaktifan</b> <p class="pull-right detail-data-ptk detail-status_aktif_ptk"></p>
						                </li>
						                <li class="list-group-item">
						                  <b>Pendidikan Tertinggi</b> <p class="pull-right detail-data-ptk detail-jenjang"></p>
						                </li>
						              </ul>
						              <button type="button" class="btn btn-block detail-status-data"></button>
						            </div>
						            <!-- /.box-body -->
						        </div>
							</div>
							<div class="col-md-9">
								<div class="nav-tabs-custom nav-warning" id="detail-ptk">
						            <ul class="nav nav-tabs">
						              <li class="active tab_ptk open-tab"><a href="#detail_ptk" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Biodata Tenaga Pendidik</a></li>	
						              <li class="false tab_riwayat_pend close-tab"><a href="#riwayat_pend_ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-book"></span> Pendidikan</a></li>
						              <li class="false tab_riwayat_ajar close-tab"><a href="#riwayat_ajar_ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-list"></span> Riwayat Mengajar</a></li>
						              <li class="false tab_penelitian close-tab"><a href="#penelitian_ptk" data-toggle="tab" aria-expanded="false"><span class="fa fa-flask"></span> Penelitian</a></li>
						              <li class="tab_pengguna close-tab"><a href="#detail_pengguna" data-toggle="tab" aria-expanded="false"><span class="fa fa-lock"></span> Data Pengguna</a></li>
						            </ul>
						            <div class="tab-content">
										<div class="tab-pane active open-dt-tab" id="detail_ptk">
											<div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
														<dt>NIDN</dt>
										                <dd class="detail-data-ptk detail-nuptk"></dd>

										                <dt>Nama</dt>
										                <dd class="detail-data-ptk detail-nama_ptk"></dd>

										                <dt>Program Studi</dt>
										                <dd class="detail-data-ptk detail-nama_prodi"></dd>

										                <dt>NIP</dt>
										                <dd class="detail-data-ptk detail-nip"></dd>

										                <dt>NIK</dt>
										                <dd class="detail-data-ptk detail-nik_ptk"></dd>

										                <dt>Jenis Kelamin</dt>
										                <dd class="detail-data-ptk detail-jk_ptk"></dd>

										                <dt>Tempat Lahir</dt>
										                <dd class="detail-data-ptk detail-tmp_lhr_ptk"></dd>

										                <dt>Tanggal Lahir</dt>
										                <dd class="detail-data-ptk detail-tgl_lhr_ptk"></dd>

								                		<dt>Status Ikatan Kerja</dt>
										                <dd class="detail-data-ptk detail-status_ptk"></dd>

														<dt>Status Keaktifan</dt>
										                <dd class="detail-data-ptk detail-status_aktif_ptk"></dd>

										                <dt>Pendidikan Tertinggi</dt>
										                <dd class="detail-data-ptk detail-jenjang"></dd>
									              	</dl>
												</section>
								                <section class="col-md-6 col-xs-6">
								                	<dl class="dl-horizontal">
								                		<dt>Agama</dt>
										                <dd class="detail-data-ptk detail-agama_ptk"></dd>

										                <dt>Alamat</dt>
										                <dd class="detail-data-ptk detail-alamat_ptk"></dd>

										                <dt>RT/RW</dt>
										                <dd class="detail-rt-rw"><font class="detail-data-ptk detail-rt_ptk"></font>/<font class="detail-data-ptk detail-rw_ptk"></font></dd>

								                		<dt>Dusun</dt>
										                <dd class="detail-data-ptk detail-dusun_ptk"></dd>

														<dt>Kelurahan</dt>
										                <dd class="detail-data-ptk detail-kelurahan_ptk"></dd>

										                <dt>Kecamatan</dt>
										                <dd class="detail-data-ptk detail-kecamatan_ptk"></dd>

										                <dt>Kode Pos</dt>
										                <dd class="detail-data-ptk detail-kode_pos_ptk"></dd>

										                <dt>No. Telepon</dt>
										                <dd class="detail-data-ptk detail-tlp_ptk"></dd>

										                <dt>No. HP</dt>
										                <dd class="detail-data-ptk detail-hp_ptk"></dd>

										                <dt>Email</dt>
										                <dd class="detail-data-ptk detail-email_ptk"></dd>
									              	</dl>
												</section>
							                </div>
						              	</div>
						              	<div class="tab-pane fade close-dt-tab" id="riwayat_pend_ptk">
											<div class="row">
												<div class="col-md-12">
													<table class="table table-bordered table-striped table-hover tbl-detail-ptk tbl-pend-ptk">
										                <thead>
											                <tr>
											                  <th class="text-center" style="width: 50px">No</th>
											                  <th>Perguruan Tinggi</th>
											                  <th class="text-center">Gelar Akademik</th>
											                  <th class="text-center hideClass" style="width: 150px">Tanggal Ijazah</th>
											                  <th class="text-center" style="width: 10px">Jejang</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="6" align="center">Memproses Data</td>
											                </tr>					                					                
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center" style="width: 50px">No</th>
											                  <th>Perguruan Tinggi</th>
											                  <th class="text-center">Gelar Akademik</th>
											                  <th class="text-center hideClass" style="width: 150px">Tanggal Ijazah</th>
											                  <th class="text-center" style="width: 10px">Jejang</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </tfoot>
										            </table>
												</div>
							                </div>
						              	</div>
						              	<div class="tab-pane fade close-dt-tab" id="riwayat_ajar_ptk">
											<div class="row">
												<div class="col-md-12">
													<table class="table table-bordered table-striped table-hover tbl-detail-ptk tbl-riwayat-ptk">
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
											                <tr>
											                	<td colspan="6" align="center">Memproses Data</td>
											                </tr>					                					                
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
						              	<div class="tab-pane fade close-dt-tab" id="penelitian_ptk">
											<div class="row">
												<div class="col-md-12">
													<table class="table table-bordered table-striped table-hover tbl-detail-ptk tbl-penelitian-ptk">
										                <thead>
											                <tr>
											                  <th class="text-center" style="width: 50px">No</th>
											                  <th style="width: 250px">Judul Penelitian</th>
											                  <th class="text-center" style="width: 150px">Bidang Ilmu</th>
											                  <th style="width: 230px">Lembaga</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="6" align="center">Memproses Data</td>
											                </tr>					                					                
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center">No</th>
											                  <th>Judul Penelitian</th>
											                  <th class="text-center">Bidang Ilmu</th>
											                  <th>Lembaga</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </tfoot>
										            </table>
												</div>
							                </div>
						              	</div> 
						              	<div class="tab-pane fade close-dt-tab" id="detail_pengguna">
											<div class="row">
												<section class="col-md-6 col-xs-6">
													<dl class="dl-horizontal">
										                <dt>Username</dt>
										                <dd class="detail-data-ptk detail-nuptk"></dd>

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
										                <dd class="detail-data-ptk detail-active_status"></dd>

										                <dt>Terakhir Online</dt>
										                <dd class="detail-data-ptk detail-last_online"></dd>
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
    <div class="modal style-2 fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">
          	<div class="row list-selected" style="display: none;">
        		<div class="col-md-12">
        			<h5 class="no-padding"></h5>
        			<table class="table table-bordered list-ptk-selected" style="width: 100%">
		                <thead>
			                <tr>
			                	<th class="text-center" style="width: 10%">No</th>
								<th class="text-center" style="width: 20%">NIDN</th>
								<th style="width: 70%">Nama</th>
			                </tr>
		                </thead>
		                <tbody>
		                </tbody>
		                <tfoot>
			                <tr>
			                	<th class="text-center">No</th>
			                	<th class="text-center">NIDN</th>
								<th>Nama</th>
			                </tr>
		                </tfoot>
		            </table>
        		</div>
        	</div>
            <form action="" class="hide-modal-content" id="form-input" style="display: none;">
	            <div class="row">
		            <div class="col-md-12">
			          <!-- Custom Tabs -->
				        <div class="nav-tabs-custom nav-info">
				            <ul class="nav nav-tabs">
				              <li class="active open-tab tab_siswa"><a href="#tab_guru" data-toggle="tab" aria-expanded="true"><span class="fa fa-user"></span> Data Tenaga Pendidik</a></li>
				              <li class="close-tab"><a href="#tab_media" data-toggle="tab" aria-expanded="false"><span class="fa fa-image"></span> Data Media</a></li>
				              <li class="pull-right"><a href="" class="text-muted" id="refresh-form"><i class="glyphicon glyphicon-refresh"></i></a></li>
				            </ul>
				            <div class="tab-content">
								<div class="tab-pane active open-dt-tab" id="tab_guru">
									<div class="tab-overflow-container default-overflow-container">
										<div class="row">
											<section class="col-md-6 col-xs-6">
												<div class="form-group" id="jurusan_prodi">
								                  <label for="jurusan_prodi">Program Studi</label>
								                  <select class="form-control select2 select2_prodi jurusan_prodi" style="width: 100%;" name="jurusan_prodi"></select>
								                </div>
								                <div class="form-group" id="nuptk">
													<label for="nuptk">NIDN</label>
													<input type="number" class="form-control nuptk" name="nuptk" placeholder="Masukkan NIDN">
								                </div>
								                <div class="form-group" id="nama_ptk">
													<label for="nama_ptk">Nama</label>
													<input type="text" class="form-control nama_ptk" name="nama_ptk" placeholder="Masukkan nama">
								                </div>
								                <div class="form-group" id="nip">
													<label for="nip">NIP</label>
													<input type="number" class="form-control nip" name="nip" placeholder="Masukkan NIP">
								                </div>
								                <div class="form-group">
													<label for="nik_ptk">NIK</label>
													<input type="number" class="form-control nik_ptk" name="nik_ptk" id="nik_ptk" placeholder="Masukkan NIK">
								                </div>
								                <div class="form-group" id="jk_ptk">
								                	<label for="jk_ptk">Jenis Kelamin</label>
								                	<div class="form-group">
													<label>
									                  <input type="radio" class="L" name="jk_ptk" value="L">
									                  Laki-Laki
									                </label>&nbsp&nbsp
									                <label>
									                  <input type="radio" class="P" name="jk_ptk" value="P">
									                  Perempuan
									                </label>
									                </div>					                					                
												</div>
												<div class="form-group" id="tmp_lhr_ptk">
													<label for="tmp_lhr_ptk">Tempat Lahir</label>
													<input type="text" class="form-control tmp_lhr_ptk" name="tmp_lhr_ptk" placeholder="Masukkan tempat lahir">
								                </div>
								                <div class="form-group" id="tgl_lhr_ptk">
													<label for="tgl_lhr_ptk">Tanggal Lahir</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right datepicker tgl_lhr_ptk" name="tgl_lhr_ptk" placeholder="Contoh: 1995-08-14">
													</div>
								                </div>
								                <div class="form-group" id="status_ptk">
								                  <label for="status_ptk">Status Ikatan Kerja</label>
								                  <select class="form-control select2 select2_status_ptk status_ptk" style="width: 100%;" name="status_ptk">
								                  	<option value=""></option>
								                  	<option value="1">Dosen Tetap</option>
								                  	<option value="2">Dosen Tidak Tetap</option>
								                  	<option value="3">Lainnya</option>
								                  </select>
								                </div>
								                <div class="form-group" id="status_aktif_ptk">
								                  <label for="status_aktif_ptk">Status Keaktifan</label>
								                  <select class="form-control select2 select2_status_aktif_ptk status_aktif_ptk" style="width: 100%;" name="status_aktif_ptk">
								                  	<option value=""></option>
								                  	<option value="1">Aktif</option>
								                  	<option value="2">Tidak Aktif</option>
								                  	<option value="3">Tugas Belajar</option>
								                  	<option value="4">Ijin Belajar</option>
								                  	<option value="5">Lainnya</option>
								                  </select>
								                </div>
								                <div class="form-group" id="jenjang">
								                  <label for="jenjang">Pendidikan Tertinggi</label>
								                  <select class="form-control select2 select2_jenjang jenjang" style="width: 100%;" name="jenjang">
								                  	<option value=""></option>
								                  	<option value="1">S1</option>
								                  	<option value="2">S2</option>
								                  	<option value="3">S3</option>							                  	
								                  	<option value="4">Lainnya</option>
								                  </select>
								                </div>
											</section>
							                <section class="col-md-6 col-xs-6">
							                	<div class="form-group" id="agama_ptk">
								                  <label for="agama_ptk">Agama</label>				                  
								                  <select class="form-control select2 select2_agama agama_ptk" style="width: 100%;" name="agama_ptk">
								                  	<option value=""></option>
								                  	<option value="1">Islam</option>
								                  	<option value="2">Kristen</option>
								                  	<option value="3">Katholik</option>
								                  	<option value="4">Budha</option>
								                  	<option value="5">Hindu</option>
								                  	<option value="6">Konghucu</option>
								                  	<option value="7">Lainnya</option>
								                  </select>
								                </div>
								                <div class="form-group" id="alamat_ptk">
													<label for="alamat_ptk">Alamat</label>
													<input type="text" class="form-control alamat_ptk" name="alamat_ptk" id="alamat_ptk" placeholder="Masukkan alamat">
								                </div>
								                <div class="form-group">
								                	<div class="row">
									                	<div class="col-md-6 col-xs-6">
															<label for="rt">RT</label>
															<input type="number" class="form-control rt_ptk" name="rt_ptk" id="rt_ptk" placeholder="Contoh 04">
														</div>
														<div class="col-md-6 col-xs-6">
															<label for="rw">RW</label>
															<input type="number" class="form-control rw_ptk" name="rw_ptk" id="rw_ptk" placeholder="Contoh 01">
														</div>
													</div>
								                </div>
								                <div class="form-group">
													<label for="dusun_ptk">Dusun</label>
													<input type="text" class="form-control dusun_ptk" name="dusun_ptk" id="dusun_ptk" placeholder="Masukkan dusun">
								                </div>
								                <div class="form-group">
													<label for="kelurahan_ptk">Kelurahan</label>
													<input type="text" class="form-control kelurahan_ptk" name="kelurahan_ptk" id="kelurahan_ptk" placeholder="Masukkan kelurahan">
								                </div>
								                <div class="form-group">
													<label for="kecamatan_ptk">Kecamatan</label>
													<input type="text" class="form-control kecamatan_ptk" name="kecamatan_ptk" id="kecamatan_ptk" placeholder="Masukkan kecamatan">
								                </div>
								                <div class="form-group">
													<label for="kode_pos_ptk">Kode Pos</label>
													<input type="number" class="form-control kode_pos_ptk" name="kode_pos_ptk" id="kode_pos_ptk" placeholder="Contoh: 91921">
								                </div>
								                <div class="form-group">
													<label for="tlp_ptk">Telepon</label>
													<input type="number" class="form-control tlp_ptk" name="tlp_ptk" id="tlp_ptk" placeholder="Masukkan nomor telepon">
								                </div>
								                <div class="form-group" id="hp_ptk">
													<label for="hp_ptk">Nomor HP</label>
													<input type="number" class="form-control hp_ptk" name="hp_ptk" placeholder="Contoh: 082336826***">
								                </div>
								                <div class="form-group" id="email_ptk">
													<label for="email_ptk">Email</label>
													<input type="email" class="form-control email_ptk" name="email_ptk" placeholder="Contoh: muh.di****@gma**.com">
								                </div>
											</section>
						                </div>
						            </div>
				              	</div>
				              	<div class="tab-pane close-dt-tab" id="tab_media">
				              		<div class="tab-overflow-container default-overflow-container">
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
										              <img class="profile-user-img img-responsive img-circle new-photo-usr" src="<?php echo get_template_assets('dist/img/user-image.png') ?>" default-photo="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User profile picture">
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
													<input type="file" class="form-control file-select-foto photo_ptk" name="photo_ptk">
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
		        <input type="hidden" id="data" name="data_ptk">              		        
		        <input type="hidden" class="id_ptk" name="id_ptk">
		        <input type="hidden" class="nuptk" name="nuptk_sebelumnya">
		        <input type="hidden" class="nip" name="nip_sebelumnya">
		        <input type="hidden" class="nama" name="nama_sebelumnya">
            </form>
            <form action="" class="hide-modal-content" id="form-input-studi-ptk" style="display: none;">
				<div class="row">
					<div class="col-md-12">
	            		<div class="form-group" id="id_ptk_studi">
		                  <label for="id_ptk_studi">Tenaga Pendidik</label>
		                  <select class="form-control select2 select2-remote-dt select2_ptk id_ptk_studi" name="id_ptk_studi" style="width: 100%;"></select>
		                </div>
		            </div>
	            	<div class="col-md-6 col-xs-6">
		                <div class="form-group" id="nama_pt_studi">
		                  <label for="nama_pt_studi">Perguruan Tinggi</label>
		                  <input type="text" class="form-control nama_pt_studi" name="nama_pt_studi" placeholder="Masukkan nama perguruan tinggi">
		                </div>
						<div class="form-group" id="studi_ptk">
		                  <label for="studi_ptk">Program Studi</label>
		                  <input type="text" class="form-control studi_ptk" name="studi_ptk" placeholder="Masukkan program studi">
		                </div>
	            	</div>
		            <div class="col-md-6 col-xs-6">
		                <div class="row">
		                	<div class="col-md-6 col-sm-6 col-xs-6">
		                		<div class="form-group" id="jenjang_studi_ptk">
				                  <label for="jenjang_studi_ptk">Jenjang Studi</label>
				                  <input type="text" class="form-control jenjang_studi_ptk" name="jenjang_studi_ptk" placeholder="Masukkan jenjang studi">
				                </div>
		                	</div>
		                	<div class="col-md-6 col-sm-6 col-xs-6">
		                		<div class="form-group" id="gelar_ak_ptk">
				                  <label for="gelar_ak_ptk">Gelar</label>
				                  <input type="text" class="form-control gelar_ak_ptk" name="gelar_ak_ptk" placeholder="Masukkan gelar">
				                </div>
		                	</div>
		                </div>
		                <div class="form-group" id="tgl_ijazah_ptk">
		                  	<label for="tgl_ijazah_ptk">Tanggal Ijazah</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right datepicker tgl_ijazah_ptk" name="tgl_ijazah_ptk" placeholder="Contoh: 1995-08-14">
							</div>
		                </div>
			        </div>
		        </div>
		        <input type="hidden" id="data" name="data_studi_ptk">              		        
		        <input type="hidden" class="id_studi" name="id_studi">
            </form>
            <form action="" class="hide-modal-content" id="form-input-penelitian-ptk" style="display: none;">
				<div class="row">
					<div class="col-md-12">
	            		<div class="form-group" id="id_ptk_rsch">
		                  <label for="id_ptk_rsch">Tenaga Pendidik</label>
		                  <select class="form-control select2 select2-remote-dt select2_ptk id_ptk_rsch" name="id_ptk_rsch" style="width: 100%;"></select>
		                </div>
		            </div>
	            	<div class="col-md-6 col-xs-6">
		                <div class="form-group" id="judul_penelitian">
		                  <label for="judul_penelitian">Judul Penelitian</label>
		                  <input type="text" class="form-control judul_penelitian" name="judul_penelitian" placeholder="Masukkan judul penelitian">
		                </div>
		                <div class="form-group" id="bidang_ilmu">
		                  <label for="bidang_ilmu">Bidang Ilmu</label>
		                  <input type="text" class="form-control bidang_ilmu" name="bidang_ilmu" placeholder="Masukkan bidang ilmu">
		                </div>
	            	</div>
		            <div class="col-md-6 col-xs-6">
                		<div class="form-group" id="lembaga">
		                  <label for="bidang_ilmu">Lembaga</label>
		                  <input type="text" class="form-control lembaga" name="lembaga" placeholder="Masukkan lembaga lokasi penelitian">
		                </div>
			        </div>
		        </div>
		        <input type="hidden" id="data" name="data_penelitian_ptk">              		        
		        <input type="hidden" class="id_penelitian_ptk" name="id_penelitian_ptk">
            </form>
            <!-- <div id="rincian-guru">
            	<div class="nav-tabs-custom nav-warning">
		            <ul class="nav nav-tabs">
		              <li class="active tab_guru"><a href="#detail_guru" data-toggle="tab" aria-expanded="true">Data Tenaga Pendidik</a></li>
		              <li class="tab_pengguna"><a href="#detail_pengguna" data-toggle="tab" aria-expanded="false">Data Pengguna</a></li>
		            </ul>
		            <div class="tab-content">
						<div class="tab-pane active style-1 overflow-tab" id="detail_guru">
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
		              	<div class="tab-pane" id="detail_pengguna">
							<div class="row">
								<section class="col-md-6 col-xs-6">
									<dl>
						                <dt>Username</dt>
						                <dd id="detail-username"></dd>

						                <dt>Password</dt>
						                <dd id="password">
						                	<div class='pass password-cry pull-left'></div>
						                	<div class='password pull-left' id="detail-uncrypt_password"></div>
						                	<div class='pull-right show-password' title='Tampilkan password'><span class='glyphicon glyphicon-eye-close'></span><div>
						                </dd>
						                <br>
						                <dt>Status</dt>
						                <dd id="detail-active_status"></dd>
					              	</dl>
								</section>				                
			                </div>
		              	</div>
		            </div>
				</div>
            </div> -->
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