<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-warning" id="box-jadwal">
			        <div class="box-header">
						<h3 class="box-title">Data Jadwal Kuliah</h3>
						<div class="box-tools pull-right">							
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">
						<div class="row">
			            	<div class="col-md-12">
				            	<div class="box box-warning">
				            		<div class="box-body">
				            			<div class="row">
				            				<div class="col-md-12">
				            					<div class="control-panel-data">
							            			<select class="form-control select2 select2_jadwal" style="width: 260px;"></select>
							            			<a href="" class="btn btn-success disabled tamp-jadwal"><i class="fa fa-list"></i> Tampilkan Jadwal Kuliah Saya</a>
							            			<a href="" class="btn btn-success disabled tamp-all-jadwal"><i class="fa fa-list"></i> Tampilkan Jadwal Kuliah</a>
						            			</div>
					            			</div>
				            			</div>
				            		</div>
				            		<div class="box-footer">
					            		<div class="row">
							                <div class="col-sm-4 col-xs-4 border-right">
							                  <div class="description-block">
							                    <h5 class="description-header">Tahun Akademik</h5>
							                    <span class="description-text tahun-ajaran-jad"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							                <!-- /.col -->
							                <div class="col-sm-4 col-xs-4 border-right">
							                  <div class="description-block">
							                    <h5 class="description-header">Jumlah Jadwal Kuliah</h5>
							                    <span class="description-text jumlah-jadwal-jad"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							                <!-- /.col -->
							                <div class="col-sm-4 col-xs-4">
							                  <div class="description-block">
							                    <h5 class="description-header">Jumlah Kelas</h5>
							                    <span class="description-text jumlah-kls-jad"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							                <!-- /.col -->											                
							            </div>
						            </div>
				            	</div>			
			            	</div>			       
		            	</div>
		            	<div class="row">
		            		<div class="col-md-12">
		            			<table class="table table-bordered tbl-data-jadwal">
					                <thead>
						                <tr>
						                  <th class="text-center" style="width: 50px">Smtr/Kls</th>
						                  <th class="text-center">Hari</th>
						                  <th class="text-center" style="width: 100px">Waktu</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 40px">SKS</th>
						                  <th class="text-center">Ruang</th>
						                  <th>Nama Dosen</th>
						                  <th class="text-center" style="width: 125px">Jumlah Mhs</th>
						                  <th class="text-center" style="width: 50px">Aksi</th>
						                </tr>
					                </thead>
					                <tbody>
						                <tr>
						                	<td colspan="9" align="center">Memproses Data</td>
						                </tr>
					                </tbody>
					                <tfoot>
						                <tr>
						                  <th class="text-center" style="width: 50px">Smtr/Kls</th>
						                  <th class="text-center">Hari</th>
						                  <th class="text-center" style="width: 100px">Waktu</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 40px">SKS</th>
						                  <th class="text-center">Ruang</th>
						                  <th>Nama Dosen</th>
						                  <th class="text-center" style="width: 125px">Jumlah Mhs</th>
						                  <th class="text-center" style="width: 50px">Aksi</th>
						                </tr>
					                </tfoot>
					            </table>
		            		</div>
		            	</div>
			        </div><!-- /.box-body -->
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
			    </div>
			</div>		
		</div>		

		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-warning" id="box-kelas-mhs" style="display: none;">
			        <div class="box-header">
						<h3 class="box-title">Data Kelas</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool remove-kelas" data-widget="remove"><i class="fa fa-times"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">
			        	<div class="row">
				        	<div class="col-md-4">
				            	<div class="box box-warning">
						            <div class="box-header with-border">
						              <h3 class="box-title">Detail</h3>
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body box-kelas-control">
						            	<div class="row">
						            		<div class="col-md-12">
						            			<dl class="detail-kelas">
						            				<dt>Kelas</dt>
						            				<dd><font class="detail-kelas-mhs detail-kelas-semester"></font>/<font class="detail-kelas-mhs detail-kelas-kelas"></font></dd>

						            				<dt>Mata Kuliah</dt>
						            				<dd class="detail-kelas-mhs detail-kelas-nama_mk"></dd>

						            				<dt>Dosen</dt>
						            				<dd class="detail-kelas-mhs detail-kelas-nama_ptk"></dd>

						            				<dt>Hari</dt>
						            				<dd class="detail-kelas-mhs detail-kelas-hari_jdl"></dd>

						            				<dt>Waktu</dt>
						            				<dd><font class="detail-kelas-mhs detail-kelas-jam_mulai_jdl"></font> - <font class="detail-kelas-mhs detail-kelas-jam_akhir_jdl"></font></dd>

						            				<dt>Ruang</dt>
						            				<dd class="detail-kelas-mhs detail-kelas-ruang"></dd>
						            			</dl>
						            		</div>
						            	</div>
						            </div>
						            <!-- /.box-body -->
								</div>
			            	</div>
			            	<div class="col-md-8">
			            		<div class="row">
					        		<div class="col-md-12">
					        			<table class="table table-bordered table-striped table-hover tbl-daftar-kelas-mhs">
							                <thead>
								                <tr>
								                	<th class="text-center" style="width: 50px;">No</td>
								                  	<th class="text-center">NIM</th>
								                  	<th>Nama</th>
								                  	<th class="text-center">Jenis Kelamin</th>
								                  	<th class="text-center">Angkatan</th>
							                	</tr>
							                </thead>
							                <tbody>
								                <tr>
								                	<td colspan="5" class="text-center">Memproses Data</td>
								                </tr>					                					                
							                </tbody>
							                <tfoot>
								                <tr>
								                  	<th class="text-center" style="width: 50px;">No</td>
								                  	<th class="text-center">NIM</th>
								                  	<th>Nama</th>
								                  	<th class="text-center">Jenis Kelamin</th>
								                  	<th class="text-center">Angkatan</th>
								                </tr>
							                </tfoot>
							            </table>
					        		</div>
					        	</div>
			            	</div>
		            	</div>     	
		            </div>
			        <div class="overlay">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
			    </div>
			</div>		
		</div>
	</section>	

<?php echo get_templete_part('template_part/footer'); ?>