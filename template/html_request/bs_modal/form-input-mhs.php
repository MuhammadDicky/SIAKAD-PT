<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form action="" class="hide-modal-content" id="form-input" enctype="multipart/form-data">
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
	              <li class="active tab_siswa open-tab"><a href="#tab_siswa" data-toggle="tab" aria-expanded="true">Data Mahasiswa</a></li>
	              <li class="tab_ortu close-tab"><a href="#tab_ortu" data-toggle="tab" aria-expanded="false">Data Orang Tua</a></li>
	              <li class="tab_wali close-tab"><a href="#tab_wali" data-toggle="tab" aria-expanded="false">Data Wali</a></li>	
	              <li class="pull-right"><a href="" class="text-muted" id="refresh-form"><i class="glyphicon glyphicon-refresh"></i></a></li>
	            </ul>
	            <div class="tab-content">
					<div class="tab-pane active style-1 overflow-tab open-dt-tab" id="tab_siswa">
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
		                <div class="row ft-mhs-form">
		                	<div class="col-md-6">
						        <div class="box box-success">
						            <div class="box-body box-profile">
						              <img class="profile-user-img img-responsive img-circle photo-mhs-edit-n" src="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User profile picture">
						              <h3 class="profile-username text-center" style="font-size: 17px">Foto Sekarang</h3>
						              <p class="text-muted text-center photo-file-name"></p>
						            </div>
						            <!-- /.box-body -->
						        </div>
		                	</div>
		                	<div class="col-md-6">
						        <div class="box box-success">
						            <div class="box-body box-profile">
						              <img class="profile-user-img img-responsive img-circle" src="<?php echo get_template_assets('dist/img/user-image.png') ?>" alt="User profile picture">
						              <h3 class="profile-username text-center" style="font-size: 17px">Foto Baru</h3>
						              <p class="text-muted text-center">file name: test.jpg</p>
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
		                	</div>
		                </div>
		            </div> 
	              	<!-- /.tab-pane -->
	              	<div class="tab-pane style-1 overflow-tab close-dt-tab" id="tab_ortu">
		              	<div class="row tab-content-head">
		              		<div class="col-md-12">
		              			<strong>Data Ayah</strong>
		              		</div>
		              	</div>
		                <div class="row">
							<section class="col-md-6 col-xs-6">
								<div class="form-group">
									<label for="nm_ayah">Nama Ayah</label>
									<input type="text" class="form-control nm_ayah" name="nm_ayah" id="nm_ayah" placeholder="Masukkan nama ayah mahasiswa">
				                </div>
				                <div class="form-group">
									<label for="thn_lhr_ayah">Tahun Lahir</label>
									<input type="number" class="form-control thn_lhr_ayah" name="thn_lhr_ayah" id="thn_lhr_ayah" placeholder="Contoh: 1984">
				                </div>
				                <div class="form-group">
				                  <label for="pendi_ayah">Jenjang Pendidikan</label>				                  
				                  <select class="form-control select2 select2_jenjang_pendi pendi_ayah" style="width: 100%;" name="pendi_ayah" id="pendi_ayah">
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
								<div class="form-group">
				                  <label for="pekerjaan_ayah">Pekerjaan</label>				                  
				                  <select class="form-control select2 select2_pekerjaan pekerjaan_ayah" style="width: 100%;" name="pekerjaan_ayah" id="pekerjaan_ayah">
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
				                  	<option value="Sudah meningal">Sudah meningal</option>
				                  	<option value="Lainnya">Lainnya</option>				                  	
				                  </select>
				                </div>
				                <div class="form-group">
				                  <label for="penghasilan_ayah">Penghasilan</label>				                  
				                  <select class="form-control select2 select2_penghasilan penghasilan_ayah" style="width: 100%;" name="penghasilan_ayah" id="penghasilan_ayah">
				                  	<option value=""></option>
				                  	<option value="Kurang dari Rp. 500.000">Kurang dari Rp. 500.000</option>
				                  	<option value="Kurang dari Rp. 1000.000">Kurang dari Rp. 1.000.000</option>
				                  	<option value="Rp. 500.000 - Rp. 1.000.000">Rp. 500.000 - Rp. 1.000.000</option>
				                  	<option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
				                  	<option value="Rp. 2.000.000 - Rp. 5.000.000">Rp. 2.000.000 - Rp. 5.000.000</option>
				                  	<option value="Lebih dari Rp. 5.000.000">Lebih dari Rp. 5.000.000</option>
				                  </select>
				                </div>
				                <div class="form-group">
									<label for="nik_ayah">NIK</label>
									<input type="number" class="form-control nik_ayah" name="nik_ayah" id="nik_ayah" placeholder="Masukkan NIK">
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
								<div class="form-group">
									<label for="nm_ibu">Nama Ibu</label>
									<input type="text" class="form-control nm_ibu" name="nm_ibu" id="nm_ibu" placeholder="Masukkan nama ibu mahasiswa">
				                </div>
				                <div class="form-group">
									<label for="thn_lhr_ibu">Tahun Lahir</label>
									<input type="number" class="form-control thn_lhr_ibu" name="thn_lhr_ibu" id="thn_lhr_ibu" placeholder="Contoh: 1984">
				                </div>
				                <div class="form-group">
				                  <label for="pendi_ibu">Jenjang Pendidikan</label>				                  
				                  <select class="form-control select2 select2_jenjang_pendi pendi_ibu" style="width: 100%;" name="pendi_ibu" id="pendi_ibu">
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
								<div class="form-group">
				                  <label for="pekerjaan_ibu">Pekerjaan</label>				                  
				                  <select class="form-control select2 select2_pekerjaan pekerjaan_ibu" style="width: 100%;" name="pekerjaan_ibu" id="pekerjaan_ibu">
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
				                  	<option value="Sudah meningal">Sudah meningal</option>
				                  	<option value="Lainnya">Lainnya</option>				                  	
				                  </select>
				                </div>
				                <div class="form-group">
				                  <label for="penghasilan_ibu">Penghasilan</label>				                  
				                  <select class="form-control select2 select2_penghasilan penghasilan_ibu" style="width: 100%;" name="penghasilan_ibu" id="penghasilan_ibu">
				                  	<option value=""></option>
				                  	<option value="Kurang dari Rp. 500.000">Kurang dari Rp. 500.000</option>
				                  	<option value="Kurang dari Rp. 1000.000">Kurang dari Rp. 1.000.000</option>
				                  	<option value="Rp. 500.000 - Rp. 1.000.000">Rp. 500.000 - Rp. 1.000.000</option>
				                  	<option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
				                  	<option value="Rp. 2.000.000 - Rp. 5.000.000">Rp. 2.000.000 - Rp. 5.000.000</option>
				                  	<option value="Lebih dari Rp. 5.000.000">Lebih dari Rp. 5.000.000</option>
				                  </select>
				                </div>
				                <div class="form-group">
									<label for="nik_ibu">NIK</label>
									<input type="number" class="form-control nik_ibu" name="nik_ibu" id="nik_ibu" placeholder="Masukkan NIK">
				                </div>
							</section>
						</div>
	              	</div>
	              	<!-- /.tab-pane -->
	              	<div class="tab-pane close-dt-tab" id="tab_wali">
						<div class="row">
							<section class="col-md-6 col-xs-6">
								<div class="form-group">
									<label for="nm_wali">Nama Wali</label>
									<input type="text" class="form-control nm_wali" name="nm_wali" id="nm_wali" placeholder="Masukkan nama wali mahasiswa">
						        </div>
						        <div class="form-group">
									<label for="thn_lhr_wali">Tahun Lahir</label>
									<input type="number" class="form-control thn_lhr_wali" name="thn_lhr_wali" id="thn_lhr_wali" placeholder="Contoh: 1984">
						        </div>
						        <div class="form-group">
						          <label for="pendi_wali">Jenjang Pendidikan</label>				                  
						          <select class="form-control select2 select2_jenjang_pendi pendi_wali" style="width: 100%;" name="pendi_wali" id="pendi_wali">
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
								<div class="form-group">
						          <label for="pekerjaan_wali">Pekerjaan</label>				                  
						          <select class="form-control select2 select2_pekerjaan pekerjaan_wali" style="width: 100%;" name="pekerjaan_wali" id="pekerjaan_wali">
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
						          	<option value="Sudah meningal">Sudah meningal</option>
						          	<option value="Lainnya">Lainnya</option>				                  	
						          </select>
						        </div>
						        <div class="form-group">
						          <label for="penghasilan_wali">Penghasilan</label>				                  
						          <select class="form-control select2 select2_penghasilan penghasilan_wali" style="width: 100%;" name="penghasilan_wali" id="penghasilan_wali">
						          	<option value=""></option>
						          	<option value="Kurang dari Rp. 500.000">Kurang dari Rp. 500.000</option>
						          	<option value="Kurang dari Rp. 1000.000">Kurang dari Rp. 1.000.000</option>
						          	<option value="Rp. 500.000 - Rp. 1.000.000">Rp. 500.000 - Rp. 1.000.000</option>
						          	<option value="Rp. 1.000.000 - Rp. 2.000.000">Rp. 1.000.000 - Rp. 2.000.000</option>
						          	<option value="Rp. 2.000.000 - Rp. 5.000.000">Rp. 2.000.000 - Rp. 5.000.000</option>
						          	<option value="Lebih dari Rp. 5.000.000">Lebih dari Rp. 5.000.000</option>
						          </select>
						        </div>
						        <div class="form-group">
									<label for="nik_wali">NIK</label>
									<input type="number" class="form-control nik_wali" name="nik_wali" id="nik_wali" placeholder="Masukkan NIK">
				                </div>
							</section>
						</div>
	              	</div>
	              <!-- /.tab-pane -->
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
<!-- <script type="application/javascript" src="http://localhost/siakad-uncp//template/backend/adminlte/template_part/../dist/js/app_elementJS.js?nC=7LGNy1bf7YmH5iBfzhdo"></script> -->
<script type="text/javascript">
	$(document).ready(function(){
		/*$.getScript("http://localhost/siakad-uncp/template/backend/adminlte/dist/js/app_elementJS.js");*/
		$.getScript({
			type:'POST',
			url:'http://localhost/siakad-uncp/template/backend/adminlte/dist/js/app_elementJS.js',
			data:{csrf_key:token}
		});
	});
</script>