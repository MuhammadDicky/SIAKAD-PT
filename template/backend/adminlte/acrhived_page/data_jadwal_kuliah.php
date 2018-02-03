<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-warning" id="box-content">
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
						            <div class="box-header with-border">
						              <h3 class="box-title">Control Panel</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						                </button>
						              </div>
						              <!-- /.box-tools -->
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body box-jadwal-mk-control">
				            			<div class="row">
				            				<div class="col-md-12">
				            					<div class="control-panel-data">
					            					<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
							            			<a href="#tambah" class="btn btn-info"><i class="fa fa-plus"></i> Buat Jadwal Kuliah</a>
							            			<a href="#delete_selected?jdl&data=jadwal" class="btn btn-danger disabled hapus"><i class="fa fa-trash"></i> hapus</a> |
							            			<select class="form-control select2 select2_jadwal" style="width: 260px;"></select>
							            			<a href="" class="btn btn-success disabled tamp-jadwal"><i class="fa fa-list"></i> Tampilkan Jadwal Kuliah</a>
						            			</div>
					            			</div>
				            			</div>
				            			<!-- <hr>
				            			<div class="row">
				            				<div class="col-md-12">
				            					<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
						            			<a href="#tambah?jadwal" class="btn btn-info"><i class="fa fa-plus"></i> Buat Jadwal</a> 
					            				<select class="form-control select2 select2_kelas kelas" name="jadwal-kelas"></select>
						            			<a href="" class="btn btn-success disabled tamp-jadwal"><i class="fa fa-eye"></i> Tampilkan jadwal</a>
						            			<a href="#delete_selected" class="btn btn-danger hapus-jadwal disabled"><i class="fa fa-trash"></i> hapus</a>
					            			</div>
				            			</div> -->
						            </div>
						            <!-- /.box-body -->
						            <div class="box-footer">
						            	<div class="row">
							        		<div class="col-md-12">
							        			<table class="table table-bordered table-striped table-hover tbl-daftar-thn-ajar datatable-dt" table-dt=".tbl-daftar-thn-ajar">
									                <thead>
										                <tr>
										                  <th>Tahun Akademik</th>
										                  <th class="text-center">Mahasiswa Yang Terdaftar</th>
										                  <th class="text-center">Status</th>
										                </tr>
									                </thead>
									                <tbody>
										                <tr>
										                	<td colspan="3" class="text-center">Memproses Data</td>
										                </tr>					                					                
									                </tbody>
									                <tfoot>
										                <tr>
										                  <th>Tahun Akademik</th>
										                  <th class="text-center">Mahasiswa Yang Terdaftar</th>
										                  <th class="text-center">Status</th>
										                </tr>
									                </tfoot>
									            </table>
							        		</div>
							        	</div>
						            </div>
								</div>
			        		</div>
			        	</div>

			        	<div class="row">
			        		<div class="col-md-12">
			        			<div class="box box-warning" id="box-jadwal" style="display: none;">
						            <div class="box-header with-border">
						              <h3 class="box-title">Jadwal Kuliah</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool remove" data-widget="remove"><i class="fa fa-times"></i></button>
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						              </div>
						              <!-- /.box-tools -->
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body">
						            	<div class="row">
							            	<div class="col-md-12">
								            	<div class="box">
								            		<div class="box-body">
									            		<div class="row">
											                <div class="col-sm-6 col-xs-6 border-right">
											                  <div class="description-block">
											                    <h5 class="description-header">Tahun Akademik</h5>
											                    <span class="description-text thn-ajaran-jad"></span>
											                  </div>
											                  <!-- /.description-block -->
											                </div>
											                <!-- /.col -->
											                <div class="col-sm-6 col-xs-6">
											                  <div class="description-block">
											                    <h5 class="description-header">Program Studi</h5>
											                    <span class="description-text prodi-jad"></span>
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
						            			<div class="tbl-responsive style-2">
							            			<table class="table table-bordered tbl-data-jadwal">
										                <thead>
											                <tr>
											                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-jadwal" data-selected="check-jadwal" data-all-selected="check-all-jadwal" data-toggle=".box-jadwal-mk-control .hapus"></th>
											                  <th class="text-center" style="width: 50px">Smtr/Kls</th>
											                  <th class="text-center">Hari</th>
											                  <th class="text-center" style="width: 105px">Waktu</th>
											                  <th>Mata Kuliah</th>
											                  <th class="text-center" style="width: 40px">SKS</th>
											                  <th class="text-center">Ruang</th>
											                  <th>Nama Dosen</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="9" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-jadwal" data-selected="check-jadwal" data-all-selected="check-all-jadwal" data-toggle=".box-jadwal-mk-control .hapus"></th>
											                  <th class="text-center" style="width: 50px">Smtr/Kls</th>
											                  <th class="text-center">Hari</th>
											                  <th class="text-center" style="width: 105px">Waktu</th>
											                  <th>Mata Kuliah</th>
											                  <th class="text-center" style="width: 40px">SKS</th>
											                  <th class="text-center">Ruang</th>
											                  <th>Nama Dosen</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </tfoot>
										            </table>
									            </div>
						            		</div>
						            	</div>
						            </div>
						            <!-- /.box-body -->
						            <div class="overlay" style="display: none;">
									  <i class="fa fa-refresh fa-spin"></i>
									</div>
								</div>
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
			        		<div class="col-md-12">
			        			<div class="box box-warning kelas-mhs-cp">
						            <div class="box-header with-border">
						              <h3 class="box-title">Control Panel</h3>
						            </div>
						            <!-- /.box-header -->
						            <div class="box-body box-kelas-control">
				            			<div class="row">
				            				<div class="col-md-12">
				            					<div class="control-panel-data">
					            					<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
							            			<a href="#tambah?kls_mhs" class="btn btn-info tambah-mhs-kls"><i class="fa fa-plus"></i> Tambah Mahasiswa</a>
							            			<a href="#edit?kls_mhs" class="btn btn-success disabled pindah-kelas hapus-mhs"><i class="fa fa-pencil-square"></i> Pindah Kelas</a>
							            			<a href="#delete_selected?kls_mhs" class="btn btn-danger disabled hapus-mhs"><i class="fa fa-trash"></i> hapus</a>
						            			</div>
					            			</div>
				            			</div>
						            </div>
						            <!-- /.box-body -->
								</div>
			        		</div>
			        	</div>
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
						            				<dd><font class="detail-kelas-semester"></font>/<font class="detail-kelas-kelas"></font></dd>

						            				<dt>Mata Kuliah</dt>
						            				<dd class="detail-kelas-nama_mk"></dd>

						            				<dt>Dosen</dt>
						            				<dd class="detail-kelas-nama_ptk"></dd>

						            				<dt>Hari</dt>
						            				<dd class="detail-kelas-hari_jdl"></dd>

						            				<dt>Waktu</dt>
						            				<dd><font class="detail-kelas-jam_mulai_jdl"></font> - <font class="detail-kelas-jam_akhir_jdl"></font></dd>

						            				<dt>Ruang</dt>
						            				<dd class="detail-kelas-ruang"></dd>
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
								                	<th class="text-center" style="width: 10px;"><input type="checkbox" class="check-all-data check-all-mhs-kelas" data-selected="check-mhs-kls" data-all-selected="check-all-mhs-kelas" data-toggle=".box-kelas-control .pindah-kelas,.box-kelas-control .hapus-mhs"></th>
								                  	<th class="text-center" style="width: 50px;">NIM</th>
								                  	<th>Nama</th>
								                  	<th class="text-center" style="width: 50px;">Angkatan</th>
								                  	<th class="text-center" style="width: 85px;">Status</th>
								                  	<th class="text-center action-kelas" style="width: 90px;">Aksi</th>
							                	</tr>
							                </thead>
							                <tbody>
								                <tr>
								                	<td colspan="7" class="text-center">Memproses Data</td>
								                </tr>					                					                
							                </tbody>
							                <tfoot>
								                <tr>
								                  	<th class="text-center"><input type="checkbox" class="check-all-data check-all-mhs-kelas" data-selected="check-mhs-kls" data-all-selected="check-all-mhs-kelas" data-toggle=".box-kelas-control .pindah-kelas,.box-kelas-control .hapus-mhs"></th>
								                  	<th class="text-center">NIM</th>
								                  	<th>Nama</th>
								                  	<th class="text-center">Angkatan</th>
								                  	<th class="text-center">Status</th>
								                  	<th class="text-center action-kelas">Aksi</th>
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

	<div class="modal style-2 fade" id="myModal" role="dialog">
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
            <form action="" id="form-input" style="display: none;">
	            <div class="row">
	            	<div class="col-md-6 col-xs-6">
						<div class="form-group" id="id_thn_ak_jdl">
		                  <label for="id_thn_ak_jdl">Tahun Akademik</label>
		                  <select class="form-control select2 select2-remote-dt select2_thn_akademik id_thn_ak_jdl" name="id_thn_ak_jdl" style="width: 100%;"></select>
		                </div>
	            		<div class="form-group" id="id_mk_jdl">
		                  <label for="id_mk_jdl">Mata Kuliah</label>
		                  <select class="form-control select2 select2-remote-dt select2_mk id_mk_jdl" name="id_mk_jdl" style="width: 100%;"></select>
		                </div>
		                <div class="row">
	            			<div class="col-md-6 col-xs-6">
		            			<div class="form-group" id="semester">
		            				<label for="semester">Semester</label>
									<select class="form-control select2 select2_semester semester" name="semester" style="width: 100%;">
					                  	<option value=""></option>
					                  	<option value="1">Semester 1</option>
					                  	<option value="2">Semester 2</option>
					                  	<option value="3">Semester 3</option>
					                  	<option value="4">Semester 4</option>
					                  	<option value="5">Semester 5</option>
					                  	<option value="6">Semester 6</option>
					                  	<option value="7">Semester 7</option>
					                  	<option value="8">Semester 8</option>
				                  	</select>
				                </div>
	            			</div>
	            			<div class="col-md-6 col-xs-6">
	            				<div class="form-group" id="kelas">
		            				<label for="kelas">Kelas</label>
									<select class="form-control select2 select2_kelas kelas" name="kelas" style="width: 100%;">
					                  	<option value=""></option>
					                  	<option value="A">A</option>
					                  	<option value="B">B</option>
					                  	<option value="C">C</option>
					                  	<option value="D">D</option>
					                  	<option value="E">E</option>
					                  	<option value="F">F</option>
					                  	<option value="G">G</option>
					                  	<option value="H">H</option>
					                  	<option value="I">I</option>
					                  	<option value="J">J</option>
					                  	<option value="K">K</option>
					                  	<option value="L">L</option>
					                  	<option value="M">M</option>
					                  	<option value="N">N</option>
					                  	<option value="O">O</option>
					                  	<option value="V">V</option>
					                  	<option value="GAB.1">GAB.1</option>
					                  	<option value="GAB.2">GAB.2</option>
					                  	<option value="GAB.3">GAB.3</option>
					                  	<option value="GAB.4">GAB.4</option>
					                  	<option value="GAB.5">GAB.5</option>
					                  	<option value="GAB.6">GAB.6</option>
					                  	<option value="GAB.7">GAB.7</option>
					                  	<option value="GAB.8">GAB.8</option>
					                  	<option value="GAB.9">GAB.9</option>
					                  	<option value="GAB.10">GAB.10</option>
				                  	</select>
				                </div>
	            			</div>
	            		</div>
	            	</div>
		            <div class="col-md-6 col-xs-6">
		            	<div class="form-group" id="hari_jdl">
		                  <label for="hari_jdl">Hari</label>
		                  <select class="form-control select2 select2_hari hari_jdl" style="width: 100%;" name="hari_jdl">
		                  	<option value=""></option>
		                  	<option value="Senin">Senin</option>
		                  	<option value="Selasa">Selasa</option>
		                  	<option value="Rabu">Rabu</option>
		                  	<option value="Kamis">Kamis</option>
		                  	<option value="Jumat">Jumat</option>
		                  	<option value="Sabtu">Sabtu</option>
		                  	<option value="Minggu">Minggu</option>
		                  </select>
		                </div>
		                <div class="form-group" id="jam_akhir_jdl">
		                	<div class="row">
		                		<div class="col-md-12 col-xs-12">
		                			<label for="jam">Jam</label>
	                			</div>
		                	</div>
		                	<div class="row">
		                		<section class="col-md-6 col-xs-6">
		                			<div class="input-group">
										<input type="text" class="form-control timepicker jam_mulai_jdl" name="jam_mulai_jdl" placeholder="Jam mulai">
										<div class="input-group-addon">
					                    	<i class="fa fa-clock-o"></i>
					                    </div>
				                    </div>
								</section>
								<section class="col-md-6 col-xs-6">
									<div class="input-group">
										<input type="text" class="form-control timepicker jam_akhir_jdl" name="jam_akhir_jdl" placeholder="Jam akhir">
										<div class="input-group-addon">
					                    	<i class="fa fa-clock-o"></i>
					                    </div>
				                    </div>
								</section>							
		                	</div>							
		                </div>
		                <div class="form-group" id="ruang">
		                  <label for="ruang">Ruang</label>
		                  <input type="text" class="form-control ruang" name="ruang" placeholder="Contoh: A8.LT3"></select>
		                </div>
			        </div>
			        <div class="col-md-12">
			        	<div class="form-group" id="id_ptk_jdl">
		                  <label for="id_ptk_jdl">Dosen</label>
		                  <select class="form-control select2 select2-remote-dt select2_ptk id_ptk_jdl" name="id_ptk_jdl" style="width: 100%;"></select>
		                </div>
			        </div>
		        </div>
		        <input type="hidden" id="data" name="data_jadwal_kuliah">
		        <input type="hidden" class="id_jdl" name="id_jdl">
            </form>
            <form action="" id="form-input-kls-mhs" style="display: none;">
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group" id="mhs-kelas">
		                  <label for="mhs-kelas">Mahasiswa</label>
		                  <select class="form-control select2 select2-remote-dt select2_mhs mhs-kelas" name="mhs-kelas[]" multiple="multiple"  data-placeholder="Pilih mahasiswa" style="width: 100%;"></select>
		                </div>
	            	</div>
		        </div>		        
		        <input type="hidden" id="data" name="data_mhs_kls">
		        <input type="hidden" id="kelas_mhs" name="kelas_mhs">
            </form>
            <form action="" id="form-pindah-kelas" style="display: none;">
            	<div class="row">
	            	<div class="col-md-12">
		      			<div class="centered-text jumlah"></div>
		            </div>
	            </div>
	            <div class="row centered-content">
		            <div class="col-md-7 col-xs-10">
		      			<div class="form-group id_pd_mhs">
		                  <select class="form-control select2 select2-remote-dt select2_kls_mhs kls_mhs" style="width: 100%;" name="kls_mhs"></select>
		                </div>		            		            
		            </div>		            
	            </div>
	            <input type="hidden" id="data" name="update_kelas">
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
            <button type="button" class="btn btn-outline submit-again-btn" id="submit-again">Simpan dan Tambah</button>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


<?php echo get_templete_part('template_part/footer'); ?>