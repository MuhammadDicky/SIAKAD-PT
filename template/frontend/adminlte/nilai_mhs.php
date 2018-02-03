<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-warning" id="box-content">
			        <div class="box-header">
						<h3 class="box-title">Data Kelas Didik</h3>
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
							            			<a href="" class="btn btn-success disabled tamp-kls"><i class="fa fa-list"></i> Tampilkan Kelas Didik</a>
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
							                    <h5 class="description-header">Jumlah Jadwal Mengajar</h5>
							                    <span class="description-text jumlah-jadwal-jad"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							                <!-- /.col -->
							                <div class="col-sm-4 col-xs-4">
							                  <div class="description-block">
							                    <h5 class="description-header">Jumlah Kelas Didik</h5>
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
						                  <th class="text-center" style="width: 80px">Smtr/Kls</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 50px">SKS</th>
						                  <th>Program Studi</th>
						                  <th class="text-center" style="width: 125px">Jumlah Mhs</th>
						                  <th class="text-center" style="width: 50px">Aksi</th>
						                </tr>
					                </thead>
					                <tbody>
						                <tr>
						                	<td colspan="6" align="center">Memproses Data</td>
						                </tr>
					                </tbody>
					                <tfoot>
						                <tr>										                  
						                  <th class="text-center" style="width: 80px">Smtr/Kls</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 50px">SKS</th>
						                  <th>Program Studi</th>
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
						<h3 class="box-title">Data Nilai Mahasiswa</h3>
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
						            				<dd><font class="detail-dt-kelas detail-kelas-semester"></font>/<font class="detail-dt-kelas detail-kelas-kelas"></font></dd>

						            				<dt>Mata Kuliah</dt>
						            				<dd class="detail-dt-kelas detail-kelas-nama_mk"></dd>

						            				<dt>Dosen</dt>
						            				<dd class="detail-dt-kelas detail-kelas-nama_ptk"></dd>

						            				<dt>Hari</dt>
						            				<dd class="detail-dt-kelas detail-kelas-hari_jdl"></dd>

						            				<dt>Waktu</dt>
						            				<dd><font class="detail-dt-kelas detail-kelas-jam_mulai_jdl"></font> - <font class="detail-dt-kelas detail-kelas-jam_akhir_jdl"></font></dd>

						            				<dt>Ruang</dt>
						            				<dd class="detail-dt-kelas detail-kelas-ruang"></dd>
						            			</dl>
						            		</div>
						            	</div>
						            </div>
						            <!-- /.box-body -->
								</div>
			            	</div>
			            	<div class="col-md-8">
			            		<div class="row">
			            			<div class="col-md-12 col-xs-6 row-input">
			            				<div class="form-group btn-input-nilai">
				            			</div>
			            			</div>
			            		</div>
			            		<div class="row">
					        		<div class="col-md-12">
					        			<form action="" id="form-input">
						        			<table class="table table-bordered table-striped table-hover tbl-daftar-kelas-mhs">
								                <thead>
									                <tr>
									                	<th class="text-center" style="width: 50px;">No</td>
									                  	<th class="text-center" style="width: 120px;">NIM</th>
									                  	<th>Nama</th>
									                  	<th class="text-center" style="width: 100px;">Nilai Akhir</th>
									                  	<th class="text-center pdk-nilai" style="width: 50px;">HM</td>
								                	</tr>
								                </thead>
								                <tbody>
									                <tr>
									                	<td colspan="4" class="text-center">Memproses Data</td>
									                </tr>					                					                
								                </tbody>
								                <tfoot>
									                <tr>
									                  	<th class="text-center" style="width: 50px;">No</td>
									                  	<th class="text-center" style="width: 120px;">NIM</th>
									                  	<th>Nama</th>
									                  	<th class="text-center" style="width: 100px;">Nilai Akhir</th>
									                  	<th class="text-center pdk-nilai" style="width: 50px;">HM</td>
									                </tr>
								                </tfoot>
								            </table>
								            <input type="hidden" name="data" value="nilai_mhs">
								            <input type="hidden" name="c_kelas">
							            </form>
					        		</div>
					        	</div>
			            	</div>
		            	</div>     	
		            </div>
			        <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
			    </div>
			</div>		
		</div>	
	</section>

<?php echo get_templete_part('template_part/footer'); ?>