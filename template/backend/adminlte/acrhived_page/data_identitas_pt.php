<?php echo get_templete_part('template_part/header'); ?>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="nav-tabs-custom nav-danger" id="tab-identitas-pt">
		            <ul class="nav nav-tabs">
		              <li class="active"><a href="#profil" data-toggle="tab" aria-expanded="true"><span class="fa fa-university"></span> Profil</a></li>
		              <li><a href="#kontak" data-toggle="tab" aria-expanded="false"><span class="fa fa-phone"></span> Kontak</a></li>
		              <li class="pull-right"><a href="" class="text-muted" id="form-identitas-pt"><i class="fa fa-pencil-square"></i></a></li>
		            </ul>
		            <div class="tab-content">
					  	<div class="tab-pane active style-1" id="profil">
						  	<div class="row">
							  	<section class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<div class="box box-solid box-danger">
									            <div class="box-header with-border">
									              <h3 class="box-title">Identitas Perguruan Tinggi</h3>
									              <div class="box-tools pull-right">
									                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									                </button>
									              </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body">
									            	<dl class="dl-horizontal dl-profil">
										                <dt>Nama Perguruan Tinggi</dt>
										                <dd class="detail-data-pt nama"></dd>

										                <dt>Kode PT</dt>
										                <dd class="detail-data-pt kpt"></dd>

										                <dt>Kategori</dt>
										                <dd class="detail-data-pt kategori"></dd>

										                <dt>Status Perguruan Tinggi</dt>
										                <dd class="detail-data-pt status"></dd>

										                <dt>Bentuk Perguruan Tinggi</dt>
										                <dd class="detail-data-pt btk_pendi"></dd>

										                <dt>Status Kepemilikan</dt>
										                <dd class="detail-data-pt status_milik"></dd>

										                <dt>Tanggal Berdiri</dt>
										                <dd class="detail-data-pt tgl_berdiri"></dd>

										                <dt>SK Pendirian PT</dt>
										                <dd class="detail-data-pt sk_pend_sekolah"></dd>

										                <dt>Tanggal SK Pendirian</dt>
										                <dd class="detail-data-pt tgl_sk_pend"></dd>

										                <!-- <dt>SK Izin Operasional</dt>
										                <dd class="detail-data-pt sk_izin_op"></dd>
										                
										                <dt>Tanggal SK Izin Operasional</dt>
										                <dd class="detail-data-pt tgl_sk_izin_op"></dd> -->
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
									              <h3 class="box-title">Data Rinci</h3>
									              <div class="box-tools pull-right">
									                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									                </button>
									              </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body">
									            	<dl class="dl-horizontal dl-profil">     
										                <dt>Sertifikasi ISO</dt>
										                <dd class="detail-data-pt sertifikat_iso"></dd>

										                <dt>Akses Internet</dt>
										                <dd class="detail-data-pt akses_internet"></dd>

										                <dt>Sumber Listrik</dt>
										                <dd class="detail-data-pt sumber_listrik"></dd>

										                <dt>Daya Listrik</dt>
										                <dd class="detail-data-pt daya_listrik"></dd>									                
										            </dl>
									            </div>
									            <!-- /.box-body -->
									        </div>
										</div>
									</div>
								</section>
								<section class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<div class="box box-solid box-danger">
									            <div class="box-header with-border">
									              <h3 class="box-title">Data Pelengkap</h3>
									              <div class="box-tools pull-right">
									                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									                </button>
									              </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body">
									            	<dl class="dl-horizontal dl-profil">
										                <dt>Kebutuhan Khusus Dilayani</dt>
										                <dd class="detail-data-pt kebutu_khusus"></dd>

										                <dt>Nama Bank</dt>
										                <dd class="detail-data-pt bank"></dd>

										                <dt>Cabang KCP/Unit</dt>
										                <dd class="detail-data-pt cabang_kcp_unit"></dd>

										                <dt>Rekening Atas Nama</dt>
										                <dd class="detail-data-pt rekening_nama"></dd>

										                <dt>Luas Tanah Milik</dt>
										                <dd class="detail-data-pt luas_tanah_m"></dd>

										                <dt>Luas Tanah Bukan Milik</dt>
										                <dd class="detail-data-pt luas_tanah_bm"></dd>
										            </dl>
									            </div>
									            <!-- /.box-body -->
									        </div>
										</div>						
									</div>
								</section>
							</div>
		             	</div> 
		              	<!-- /.tab-pane -->
		              	<div class="tab-pane style-1" id="kontak">
		              		<div class="row">
								<div class="col-md-6">
									<div class="box box-solid box-danger">
							            <div class="box-header with-border">
							              <h3 class="box-title">Kontak Utama</h3>
							              <div class="box-tools pull-right">
							                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							                </button>
							              </div>
							            </div>
							            <!-- /.box-header -->
							            <div class="box-body">
							            	<dl class="dl-horizontal">
								                <dt>Alamat</dt>
								                <dd class="detail-data-pt alamat"></dd>

								                <dt>RT / RW</dt>
								                <dd><font class="detail-data-pt rt"></font> / <font class="detail-data-pt rw"></font></dd>

								                <dt>Dusun</dt>
								                <dd class="detail-data-pt dusun"></dd>

								                <dt>Desa / Kelurahan</dt>
								                <dd class="detail-data-pt desa_kelurahan"></dd>

								                <dt>Kecamatan</dt>
								                <dd class="detail-data-pt kecamatan"></dd>

								                <dt>Kabupaten</dt>
								                <dd class="detail-data-pt kabupaten"></dd>

								                <dt>Provinsi</dt>
								                <dd class="detail-data-pt provinsi"></dd>

								                <dt>Kode Pos</dt>
								                <dd class="detail-data-pt kode_pos"></dd>
								            </dl>
							            </div>
							            <!-- /.box-body -->
							        </div>
								</div>
								<div class="col-md-6">
									<div class="box box-solid box-danger">
							            <div class="box-header with-border">
							              <h3 class="box-title">Kontak yang Bisa Dihubungi</h3>
							              <div class="box-tools pull-right">
							                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							                </button>
							              </div>
							            </div>
							            <!-- /.box-header -->
							            <div class="box-body">
							            	<dl class="dl-horizontal">
								                <dt>Telepon</dt>
								                <dd class="detail-data-pt telepon"></dd>

								                <dt>Fax</dt>
								                <dd class="detail-data-pt fax"></dd>

								                <dt>Email</dt>
								                <dd class="detail-data-pt email"></dd>

								                <dt>Website</dt>
								                <a href="" target="blank"><dd class="detail-data-pt website"></dd></a>
								            </dl>
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
	</section>

	<div class="modal style-2 fade modal-danger" id="myModal-pt" role="dialog">
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
		            <div class="col-md-12">
			        <!-- Custom Tabs -->
				        <div class="nav-tabs-custom nav-danger" id="tab-identitas-sekolah">
				            <ul class="nav nav-tabs">
				              <li class="active tab-form-profil open-tab"><a href="#form-profil" data-toggle="tab" aria-expanded="true"><span class="fa fa-university"></span> Profil</a></li>
				              <li class="tab-form-kontak close-tab"><a href="#form-kontak" data-toggle="tab" aria-expanded="false"><span class="fa fa-phone"></span> Kontak</a></li>
				            </ul>
				            <div class="tab-content">
							  	<div class="tab-pane active open-dt-tab" id="form-profil">
							  		<div id="container-form-profil" class="tab-overflow-container">
									  	<div class="row tab-content-head">
						              		<div class="col-md-12">
						              			<strong>Data Identitas Perguruan Tinggi</strong>
						              		</div>
						              	</div>
										<div class="row">
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="nama">
													<label for="nama">Nama Perguruan Tinggi</label>
													<input type="text" class="form-control" name="nama" placeholder="Masukkan nama sekolah">
								                </div>
												<div class="form-group" id="kpt">
													<label for="kpt">Kode PT</label>
													<input type="number" class="form-control" name="kpt" placeholder="Masukkan kode perguruan tinggi">
								                </div>
								                <div class="form-group" id="kategori">
													<label for="kategori">Kategori</label>
													<select class="form-control select2 select2_kategori" style="width: 100%;" name="kategori">
									                  	<option value=""></option>
									                  	<option value="Negeri">Negeri</option>
									                  	<option value="Swasta">Swasta</option>							                  	
									                  	<option value="Lainnya">Lainnya</option>							                  	
									                </select>
								                </div>
								                <div class="form-group" id="status">
													<label for="status">Status Perguruan Tinggi</label>
													<select class="form-control select2 select2_status" style="width: 100%;" name="status">
									                  	<option value=""></option>
									                  	<option value="Aktif">Aktif</option>
									                  	<option value="Alih Bentuk">Alih Bentuk</option>
									                  	<option value="Tutup">Tutup</option>
									                  	<option value="Alih Kelolah">Alih Kelolah</option>
									                  	<option value="Pembinaan">Pembinaan</option>
									                </select>
								                </div>
								                <div class="form-group" id="btk_pendi">
								                	<label for="btk_pendi">Bentuk Perguruan Tinggi</label>
								                	<select class="form-control select2 select2_bentuk_pendi btk_pendi" style="width: 100%;" name="btk_pendi">
									                  	<option value=""></option>							                  	
									                  	<option value="Universitas">Universitas</option>
									                  	<option value="Institut">Institut</option>
									                  	<option value="Sekolah Tinggi">Sekolah Tinggi</option>
									                  	<option value="Lainnya">Lainnya</option>							                  	
									                </select>
												</div>						                
											</section>
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="status_milik">
													<label for="status_milik">Status Kepemilikan</label>
													<select class="form-control select2 select2_status_milik" style="width: 100%;" name="status_milik">
									                  	<option value=""></option>
									                  	<option value="Pemerintah Pusat">Pemerintah Pusat</option>
									                  	<option value="Pemerintah Daerah">Pemerintah Daerah</option>
									                  	<option value="Swasta">Swasta</option>							                  	
									                  	<option value="Lainnya">Lainnya</option>							                  	
									                </select>
								                </div>
												<div class="form-group" id="tgl_berdiri">
													<label for="tgl_berdiri">Tanggal Berdiri</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right datepicker" name="tgl_berdiri" placeholder="Contoh: 1995-08-14">
													</div>
								                </div>
												<div class="form-group" id="sk_pend_sekolah">
													<label for="sk_pend_sekolah">Nomor SK Perguruan Tinggi</label>
													<input type="text" class="form-control" name="sk_pend_sekolah" placeholder="Masukkan SK pendirian sekolah">
								                </div>						                
								                <div class="form-group" id="tgl_sk_pend">
								                  	<label for="tgl_sk_pend">Tanggal SK Perguruan Tinggi</label>
								                  	<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right datepicker" name="tgl_sk_pend" placeholder="Contoh: 1995-08-14">
													</div>
								                </div>
								                <!-- <div class="form-group" id="sk_izin_op">
													<label for="sk_izin_op">SK Izin Operasional</label>
													<input type="text" class="form-control" name="sk_izin_op" placeholder="Masukkan SK izin operasional">
								                </div>
								                <div class="form-group" id="tgl_sk_izin_op">
													<label for="tgl_sk_izin_op">Tanggal SK Izin Operasional</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right datepicker" name="tgl_sk_izin_op" placeholder="Contoh: 1995-08-14">
													</div>
								                </div> -->
								            </section>
										</div>

										<div class="row tab-content-head">
						              		<div class="col-md-12">
						              			<strong>Data Pelengkap</strong>
						              		</div>
						              	</div>
										<div class="row">
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="kebutu_khusus">
													<label for="kebutu_khusus">Kebutuhan Khusus Dilayani</label>
													<input type="text" class="form-control" name="kebutu_khusus" placeholder="Masukkan kebutuhan khusus yang dilayani sekolah">
								                </div>
								                <div class="form-group" id="bank">
													<label for="bank">Nama Bank</label>
													<input type="text" class="form-control" name="bank" placeholder="Masukkan nama bank sekolah">
								                </div>
								                <div class="form-group" id="cabang_kcp_unit">
								                	<label for="cabang_kcp_unit">Cabang KCP/Unit</label>
								                	<input type="text" class="form-control" name="cabang_kcp_unit" placeholder="Masukkan cabang KCP/Unit">
												</div>						                
											</section>
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="rekening_nama">
													<label for="rekening_nama">Rekening Atas Nama</label>
													<input type="text" class="form-control" name="rekening_nama" placeholder="Masukkan nama rekening">
								                </div>						                
								                <div class="form-group" id="luas_tanah_m">
								                  	<label for="luas_tanah_m">Luas Tanah Milik</label>
													<input type="number" class="form-control" name="luas_tanah_m" placeholder="Masukkan luas tanah sekolah">
								                </div>
								                <div class="form-group" id="luas_tanah_bm">
													<label for="luas_tanah_bm">Luas Tanah Bukan Milik</label>
													<input type="number" class="form-control" name="luas_tanah_bm" placeholder="Masukkan luas tanah bukan milik sekolah">
								                </div>						                
								            </section>
										</div>

										<div class="row tab-content-head">
						              		<div class="col-md-12">
						              			<strong>Data Rinci</strong>
						              		</div>
						              	</div>
										<div class="row">
											<section class="col-md-6 col-sm-6 col-xs-12">										
								                <div class="form-group" id="sertifikat_iso">
								                	<label for="sertifikat_iso">Sertifikasi ISO</label>
								                	<select class="form-control select2 select2_sertifikat_iso" style="width: 100%;" name="sertifikat_iso">
									                  	<option value=""></option>
									                  	<option value="Sudah Bersertifikat">Sudah Bersertifikat</option>
									                  	<option value="Belum Bersertifikat">Belum Bersertifikat</option>
									                </select>
												</div>
												<div class="form-group" id="akses_internet">
													<label for="akses_internet">Akses Internet</label>
													<input type="text" class="form-control" name="akses_internet" placeholder="Masukkan jenis akses internet sekolah">
								                </div>						                
											</section>
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="sumber_listrik">
													<label for="sumber_listrik">Sumber Listrik</label>
													<input type="text" class="form-control" name="sumber_listrik" placeholder="Masukkan sumber listrik sekolah">
								                </div>						                
								                <div class="form-group" id="daya_listrik">
								                  	<label for="daya_listrik">Daya Listrik</label>
													<input type="number" class="form-control" name="daya_listrik" placeholder="Masukkan daya listrik yang digunakan sekolah">
								                </div>						                
								            </section>
										</div>
									</div>
				              	</div> 
				              	<!-- /.tab-pane -->
				              	<div class="tab-pane close-dt-tab" id="form-kontak">
				              		<div id="container-form-kontak" class="tab-overflow-container">
						              	<div class="row tab-content-head">
						              		<div class="col-md-12">
						              			<strong>Kontak Utama</strong>
						              		</div>
						              	</div>
						              	<div class="row">
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="alamat">
													<label for="alamat">Alamat</label>
													<input type="text" class="form-control" name="alamat" placeholder="Masukkan alamat sekolah">
								                </div>
								                <div class="form-group">
								                	<div class="row">
									                	<div class="col-md-6 col-xs-6">
															<label for="rt">RT</label>
															<input type="number" class="form-control" name="rt" placeholder="Contoh 04">
														</div>
														<div class="col-md-6 col-xs-6">
															<label for="rw">RW</label>
															<input type="number" class="form-control" name="rw" placeholder="Contoh 01">
														</div>
													</div>
								                </div>
								                <div class="form-group">
													<label for="dusun">Dusun</label>
													<input type="text" class="form-control" name="dusun" placeholder="Masukkan dusun">
								                </div>
								                <div class="form-group">
													<label for="desa_kelurahan">Desa / Kelurahan</label>
													<input type="text" class="form-control" name="desa_kelurahan" placeholder="Masukkan kelurahan">
								                </div>
											</section>
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label for="kecamatan">Kecamatan</label>
													<input type="text" class="form-control" name="kecamatan" placeholder="Masukkan kecamatan">
								                </div>
								                <div class="form-group">
													<label for="kabupaten">Kabupaten</label>
													<input type="text" class="form-control" name="kabupaten" placeholder="Masukkan kabupaten">
								                </div>
								                <div class="form-group">
													<label for="provinsi">Provinsi</label>
													<input type="text" class="form-control" name="provinsi" placeholder="Masukkan provinsi">
								                </div>
								                <div class="form-group">
													<label for="kode_pos">Kode Pos</label>
													<input type="number" class="form-control" name="kode_pos" placeholder="Contoh: 91921">
								                </div>										
								            </section>
										</div>

										<div class="row tab-content-head">
						              		<div class="col-md-12">
						              			<strong>Kontak yang Bisa Dihubungi</strong>
						              		</div>
						              	</div>
						              	<div class="row">
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group" id="telepon">
													<label for="telepon">Telepon</label>
													<input type="number" class="form-control" name="telepon" placeholder="Masukkan nomor telepon sekolah">
								                </div>						                
								                <div class="form-group">
													<label for="fax">FAX</label>
													<input type="number" class="form-control" name="fax" placeholder="Masukkan nomor FAX sekolah">
								                </div>						                
											</section>
											<section class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label for="email">Email</label>
													<input type="email" class="form-control" name="email" placeholder="Masukkan email sekolah">
								                </div>
								                <div class="form-group">
													<label for="website">Website</label>
													<input type="text" class="form-control" name="website" placeholder="Masukkan website sekolah">
								                </div>						                
								            </section>
										</div>
									</div>
				              	</div>
				              	<!-- /.tab-pane -->			              
				            </div>
				            <!-- /.tab-content -->
					    </div>
				    </div>
		        </div>		        
		        <input type="hidden" id="data" name="data_identitas_pt">
		        <input type="hidden" name="id">		        
            </form>
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