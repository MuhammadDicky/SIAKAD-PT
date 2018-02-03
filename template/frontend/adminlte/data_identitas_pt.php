<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="nav-tabs-custom nav-danger" id="tab-identitas-pt">
		            <ul class="nav nav-tabs">
						<li class="active"><a href="#profil" data-toggle="tab" aria-expanded="true"><span class="fa fa-university"></span> Profil</a></li>
						<li><a href="#kontak" data-toggle="tab" aria-expanded="false"><span class="fa fa-phone"></span> Kontak</a></li>
						<li><a href="#prodi" data-toggle="tab" aria-expanded="false"><span class="fa fa-building-o"></span> Program Studi <?php echo $_SESSION['prodi']; ?></a></li>
						<li class="pull-right">
							<a href="" class="text-muted refresh-data" title="Refresh Data" data-refresh='data-identitas-pt'><i class="fa fa-refresh refresh-icon"></i></a>
						</li>
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
		              	<div class="tab-pane style-1" id="prodi">
		              		<div class="row">
								<section class="col-md-6">
									<div class="row">
										<div class="col-md-12">
											<div class="box box-solid box-danger">
									            <div class="box-header with-border">
									              <h3 class="box-title">Informasi Umum</h3>
									              <div class="box-tools pull-right">
									                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									                </button>
									              </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body">
									            	<dl class="dl-horizontal">
										                <dt>Fakultas</dt>
										                <dd class="nama_fakultas"></dd>

										                <dt>Kode Program Studi</dt>
										                <dd class="kode_prodi"></dd>

										                <dt>Nama Program Studi</dt>
										                <dd class="nama_prodi"></dd>

										                <dt>Nama Ketua Prodi</dt>
										                <dd class="nama_kprodi"></dd>

										                <dt>Jenjang</dt>
										                <dd class="jenjang_prodi"></dd>

										                <dt>Akreditas</dt>
										                <dd class="akreditasi_prodi"></dd>

										                <dt>Status</dt>
										                <dd class="status"></dd>

										                <dt>SK Penyelenggaraan</dt>
										                <dd class="sk_peny_prodi"></dd>

										                <dt>Tanggal SK</dt>
										                <dd class="tgl_sk_prodi"></dd>

										                <dt>Tanggal Berdiri</dt>
										                <dd class="tgl_berdiri_prodi"></dd>

										                <dt>Jumlah Mahasiswa</dt>
										                <dd>
										                	<span>
											                	<span class="fa fa-users"></span> 
											                	<span class="jml_mhs"></span>
										                	</span>
										                </dd>

										                <dt>Mahasiswa Laki-Laki</dt>
										                <dd>
										                	<span>
											                	<span class="fa fa-male"></span> 
											                	<span class="jml_lk"></span>
										                	</span>
										                </dd>

										                <dt>Mahasiswa Perempuan</dt>
										                <dd>
										                	<span>
											                	<span class="fa fa-female"></span> 
											                	<span class="jml_pr"></span>
										                	</span>
										                </dd>
										            </dl>
									            </div>
									            <!-- /.box-body -->
									        </div>
										</div>
									</div>
									<div class="row kons-pd-box">
										<div class="col-md-12">
									        <div class="box box-solid box-danger">
									            <div class="box-header with-border">
									              <h3 class="box-title">Konsentrasi Program Studi</h3>
									              <div class="box-tools pull-right">
									                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									                </button>
									              </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body">
									            	<table class="table table-bordered table-striped table-hover tbl-data-konst-pd">
										                <thead>
											                <tr>
											                  <th class="text-center" style="width: 5px">No</th>
											                  <th style="width: 300px">Nama Konsentrasi</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="2" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center">No</th>
											                  <th>Nama Konsentrasi</th>
											                </tr>
										                </tfoot>
										            </table>
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
									              <h3 class="box-title">Kontak</h3>
									              <div class="box-tools pull-right">
									                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									                </button>
									              </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body">
									            	<dl class="dl-horizontal">
									            		<dt>Alamat</dt>
										                <dd class="alamat_prodi"></dd>

										                <dt>Kode POS</dt>
										                <dd class="kode_pos_prodi"></dd>

										                <dt>Telepon</dt>
										                <dd class="telpon_prodi"></dd>

										                <dt>Fax</dt>
										                <dd class="fax_prodi"></dd>

										                <dt>Email</dt>
										                <dd class="email_prodi"></dd>

										                <dt>Website</dt>
										                <a href="" target="blank"><dd class="website_prodi"></dd></a>
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
		            </div>
		            <!-- /.tab-content -->
			    </div>
			</div>
		</div>		
	</section>

<?php echo get_templete_part('template_part/footer'); ?>