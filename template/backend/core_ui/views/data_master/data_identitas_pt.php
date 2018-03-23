<script type="text/javascript">
  var requireJS = [
  	{
  		'name': 'datepicker',
  		'link': "<?php echo get_plugin('datepicker','js') ?>",
  		'state': true
  	},
  	{
  		'name': 'datepicker lang',
  		'link': "<?php echo get_plugin('datepicker','js','lang') ?>",
  		'state': true
  	},
  	{
  		'name': 'App Config JS',
  		'link': "<?php echo get_configJS('js_views/config.js') ?>",
  		'state': false
  	},
  	{
  		'name': 'select2',
  		'link': "<?php echo get_plugin('select2','js')?>",
  		'state': true
  	},
  	{
  		'name': 'select2 lang',
  		'link': "<?php echo get_plugin('select2','js','lang')?>",
  		'state': true
  	},
  	{
  		'name': 'jquery-file-select',
  		'link': "<?php echo get_plugin('jquery-file-select','js') ?>",
  		'state': true
  	},
  	{
  		'name': 'jquery-file-select lang',
  		'link': "<?php echo get_plugin('jquery-file-select','js','lang') ?>",
  		'state': true
  	},
  	{
  		'name': 'Page JS',
  		'link': "<?php echo get_configJS('js_views/mod_dt_identitas_pt.js') ?>",
  		'state': false
  	}
  ];
  var requireCSS = [
  	{
  		'name': 'datepicker',
  		'link': "<?php echo get_plugin('datepicker','css')?>",
  		'state': true
  	},
  	{
  		'name': 'select2',
  		'link': "<?php echo get_plugin('select2','css') ?>",
  		'state': true
  	},
  	{
  		'name': 'jquery-file-select',
  		'link': "<?php echo get_plugin('jquery-file-select','css')?>",
  		'state': true
  	},
  	{
  		'name': 'jquery-file-select',
  		'link': "<?php echo get_plugin('jquery-file-select','css','rtl')?>",
  		'state': true
  	}
  ];
  loadCSS(requireCSS);
  // loadJS(requireJS);
  requestJS(requireJS);
</script>
<div class="animated fadeIn">
  <div class="row">

    <div class="col-md-12 mb-4" id="tab-identitas-pt">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile-pt"><i class="fa fa-university"></i> Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#kontak" role="tab" aria-controls="kontak-pt"><i class="fa fa-phone"></i> Kontak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="form-identitas-pt"><i class="fa fa-pencil-square"></i></a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="profile" role="tabpanel">
        	<div class="row">
          	<section class="col-md-6">
          		<div class="row">
    						<div class="col-md-12" style="">
    							<img src="<?php echo get_templete_dir('','assets/web-images/'.web_detail('_web_icon')).'?'.$_SESSION['n_val'] ?>" class="logo-pt-element" alt="PT Icon Profile" style="width: 30%;display: block;margin-bottom: 10px;margin-right: auto;margin-left: auto;">
    							<div class="form-group">
    								<label>Ganti Logo Perguruan Tinggi</label>
    								<input type="file" class="form-control" name="logo-pt" id="file-select-logo-pt">
    			        </div>
	                <p><b>Note</b>:
	                	<ol>
	                		<li>Dimensi / ukuran logo:
	                			<ul style="list-style: disc;margin-left: -24px">
	                				<li>Lebar maks. 387px - min. 285px</li>
	                				<li>Tinggi maks. 385px - min. 283px</li>
	                				<li>Rek. lebar 287px - 290px dan tinggi 285px - 288px </li>
	                			</ul>
	                		</li>
	                		<li>Ukuran file maks. 1MB</li>
	                		<li>Format logo harus png</li>
	                	</ol>
	                </p>
    						</div>
    					</div>
    					<div class="card border-danger">
				        <div class="card-header bg-red text-white">
				          Data Rinci
				        </div>
				        <div class="card-body">
				          	<dl class="row">
  					        	<dt class="col-sm-5 text-truncate">Sertifikasi ISO</dt>
					          	<dd class="col-sm-7 detail-data-pt sertifikat_iso">-</dd>

					          	<dt class="col-sm-5 text-truncate">Akses Internet</dt>
					          	<dd class="col-sm-7 detail-data-pt akses_internet">-</dd>

					          	<dt class="col-sm-5 text-truncate">Sumber Listrik</dt>
					          	<dd class="col-sm-7 detail-data-pt sumber_listrik">-</dd>

					          	<dt class="col-sm-5 text-truncate">Daya Listrik</dt>
					          	<dd class="col-sm-7 detail-data-pt daya_listrik">-</dd>
  					        </dl>
				        </div>
			      	</div>
  			    </section>
  			    <section class="col-md-6">
			      	<div class="card border-danger">
				        <div class="card-header bg-red text-white">
				          Identitas Perguruan Tinggi
				        </div>
				        <div class="card-body">
				          	<dl class="row">
					        	<dt class="col-sm-5 text-truncate">Nama Perguruan Tinggi</dt>
					          	<dd class="col-sm-7 detail-data-pt nama">-</dd>

					          	<dt class="col-sm-5 text-truncate">Kode Perguruan Tinggi</dt>
					          	<dd class="col-sm-7 detail-data-pt kpt">-</dd>

					          	<dt class="col-sm-5 text-truncate">Kategori</dt>
					          	<dd class="col-sm-7 detail-data-pt kategori">-</dd>

					          	<dt class="col-sm-5 text-truncate">Status Perguruan Tinggi</dt>
					          	<dd class="col-sm-7 detail-data-pt status">-</dd>

					          	<dt class="col-sm-5 text-truncate">Bentuk Perguruan Tinggi</dt>
					          	<dd class="col-sm-7 detail-data-pt btk_pendi">-</dd>

					          	<dt class="col-sm-5 text-truncate">Status Kepemilikan</dt>
					          	<dd class="col-sm-7 detail-data-pt status_milik">-</dd>

					          	<dt class="col-sm-5 text-truncate">Tanggal Berdiri</dt>
					          	<dd class="col-sm-7 detail-data-pt tgl_berdiri">-</dd>

					          	<dt class="col-sm-5 text-truncate">SK Pendirian PT</dt>
					          	<dd class="col-sm-7 detail-data-pt sk_pend_sekolah">-</dd>

					          	<dt class="col-sm-5 text-truncate">Tanggal SK Pendirian PT</dt>
					          	<dd class="col-sm-7 detail-data-pt tgl_sk_pend">-</dd>
					        </dl>
				        </div>
			      	</div>
			      	<div class="card border-danger">
				        <div class="card-header bg-red text-white">
				          Data Pelengkap
				        </div>
				        <div class="card-body">
				          	<dl class="row">
  					        	<dt class="col-sm-5 text-truncate">Kebutuhan Khusus Dilayani</dt>
					          	<dd class="col-sm-7 detail-data-pt kebutu_khusus">-</dd>

					          	<dt class="col-sm-5 text-truncate">Nama Bank</dt>
					          	<dd class="col-sm-7 detail-data-pt bank">-</dd>

					          	<dt class="col-sm-5 text-truncate">Cabang KCP/Unit</dt>
					          	<dd class="col-sm-7 detail-data-pt cabang_kcp_unit">-</dd>

					          	<dt class="col-sm-5 text-truncate">Rekening Atas Nama</dt>
					          	<dd class="col-sm-7 detail-data-pt rekening_nama">-</dd>

					          	<dt class="col-sm-5 text-truncate">Luas Tanah Milik</dt>
					          	<dd class="col-sm-7 detail-data-pt luas_tanah_m">-</dd>

					          	<dt class="col-sm-5 text-truncate">Luas Tanah Bukan Milik</dt>
					          	<dd class="col-sm-7 detail-data-pt luas_tanah_bm">-</dd>
					        </dl>
				        </div>
			      	</div>
  			    </section>
        	</div>
        </div>
        <div class="tab-pane" id="kontak" role="tabpanel">
        	<div class="row">
        		<section class="col-md-6">
  		      	<div class="card border-danger">
  			        <div class="card-header bg-red text-white">
  			          Kontak Utama
  			        </div>
  			        <div class="card-body">
  			          	<dl class="row">
    				        	<dt class="col-sm-5 text-truncate">Alamat</dt>
  				          	<dd class="col-sm-7 detail-data-pt alamat">-</dd>

  				          	<dt class="col-sm-5 text-truncate">RT / RW</dt>
  				          	<dd class="col-sm-7"><font class="detail-data-pt rt"></font> / <font class="detail-data-pt rw"></font></dd>

  				          	<dt class="col-sm-5 text-truncate">Dusun</dt>
  				          	<dd class="col-sm-7 detail-data-pt dusun">-</dd>

  				          	<dt class="col-sm-5 text-truncate">Desa / Kelurahan</dt>
  				          	<dd class="col-sm-7 detail-data-pt desa_kelurahan">-</dd>

  				          	<dt class="col-sm-5 text-truncate">Kecamatan</dt>
  				          	<dd class="col-sm-7 detail-data-pt kecamatan">-</dd>

  				          	<dt class="col-sm-5 text-truncate">Kabupaten</dt>
  				          	<dd class="col-sm-7 detail-data-pt kabupaten">-</dd>

  				          	<dt class="col-sm-5 text-truncate">Provinsi</dt>
  				          	<dd class="col-sm-7 detail-data-pt provinsi">-</dd>

  				          	<dt class="col-sm-5 text-truncate">Kode Pos</dt>
  				          	<dd class="col-sm-7 detail-data-pt kode_pos">-</dd>
    				        </dl>
  			        </div>
  		      	</div>
  			    </section>
  			    <section class="col-md-6">
			      	<div class="card border-danger">
				        <div class="card-header bg-red text-white">
				          Kontak Yang Bisa Dihubungi
				        </div>
				        <div class="card-body">
				          	<dl class="row">
  					        	<dt class="col-sm-5 text-truncate">Telepon</dt>
					          	<dd class="col-sm-7 detail-data-pt telepon">-</dd>

					          	<dt class="col-sm-5 text-truncate">Fax</dt>
					          	<dd class="col-sm-7 detail-data-pt fax">-</dd>

					          	<dt class="col-sm-5 text-truncate">Email</dt>
					          	<dd class="col-sm-7 detail-data-pt email">-</dd>

					          	<dt class="col-sm-5 text-truncate">Website</dt>
                      <dd class="col-sm-7"><a href="" target="blank" class="detail-data-pt website"></a></dd>
  					        </dl>
				        </div>
			      	</div>
  			    </section>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="modal fade style-2" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

      	<form action="" class="hide-modal-content" id="form-input">
	        <div class="row">
	            <div class="col-md-12">
	            	<div id="tab-identitas-pt">
			        	<ul class="nav nav-tabs" role="tablist">
			                <li class="nav-item">
			                  <a class="nav-link active open-tab" data-toggle="tab" href="#form-profil" role="tab" aria-controls="form-profil"><i class="fa fa-university"></i> Profil</a>
			                </li>
			                <li class="nav-item">
			                  <a class="nav-link close-tab" data-toggle="tab" href="#form-kontak" role="tab" aria-controls="form-kontak"><i class="fa fa-phone"></i> Kontak</a>
			                </li>
			                <li class="nav-item">
			                  <a class="nav-link refresh-modal-form" role="tab" title="Reset Form Input"><i class="fa fa-refresh"></i></a>
			                </li>
			            </ul>
			            <div class="tab-content">
			                <div class="tab-pane active open-dt-tab" id="form-profil" role="tabpanel">
			                	<div id="container-form-profil" class="tab-overflow-container">
								  	<div class="row">
					              		<div class="col-md-12">
					              			<div class="tab-content-head">
					              				<strong>Data Identitas Perguruan Tinggi</strong>
					              			</div>
					              		</div>
					              	</div>
									<div class="row">
										<section class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group" id="nama">
												<label for="nama">Nama Perguruan Tinggi</label>
												<input type="text" class="form-control" name="nama" placeholder="Masukkan nama perguruan tinggi">
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
												<div class="input-group">
								                  <div class="input-group-prepend">
								                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
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
							                  	<div class="input-group">
													<div class="input-group-prepend">
									                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
									                  </div>
													<input type="text" class="form-control pull-right datepicker" name="tgl_sk_pend" placeholder="Contoh: 1995-08-14">
												</div>
							                </div>
							            </section>
									</div>

									<div class="row">
					              		<div class="col-md-12">
					              			<div class="tab-content-head">
						              			<strong>Data Pelengkap</strong>
						              		</div>
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

									<div class="row">
					              		<div class="col-md-12">
					              			<div class="tab-content-head">
						              			<strong>Data Rinci</strong>
						              		</div>
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

			                <div class="tab-pane close-dt-tab" id="form-kontak" role="tabpanel">
			                	<div id="container-form-kontak" class="tab-overflow-container">
					              	<div class="row">
					              		<div class="col-md-12">
					              			<div class="tab-content-head">
						              			<strong>Kontak Utama</strong>
						              		</div>
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

									<div class="row">
					              		<div class="col-md-12">
					              			<div class="tab-content-head">
						              			<strong>Kontak yang Bisa Dihubungi</strong>
						              		</div>
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
			            </div>
			        </div>
			    </div>
	        </div>		        
	        <input type="hidden" id="data" name="data_identitas_pt">
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
