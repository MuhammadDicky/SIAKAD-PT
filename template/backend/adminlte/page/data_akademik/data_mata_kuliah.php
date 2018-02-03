<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
    		<div class="col-md-12">
    			<div class="box box-solid box-warning">
		            <div class="box-header with-border">
		              <h3 class="box-title">Control Panel</h3>
		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		              <!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body box-mk-control">
		            	<div class="row">
		            		<div class="col-md-12">
		            			<div class="control-panel-data">
	            					<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
			            			<a href="#tambah" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Mata Kuliah</a> 
			            			<a href="#edit" class="btn btn-success edit-mk disabled"><i class="fa fa-pencil-square"></i> Edit Mata Kuliah</a>
			            			<a href="#delete_selected" class="btn btn-danger disabled hapus"><i class="fa fa-trash"></i> hapus</a> |
		            				<select class="form-control select2 select2_prodi mk-prodi" name="mk-prodi" style="width: 220px;"></select>
			            			<a href="" class="btn btn-success disabled tamp-mk"><i class="fa fa-list"></i> Tampilkan Mata Kuliah</a>
		            			</div>
		            		</div>
		            	</div>
		            </div>
		            <!-- /.box-body -->
				</div>
    		</div>
    	</div>

    	<div class="row">
    		<div class="col-md-12">
        		<div class="box box-solid box-warning box-daftar-mk" style="display: none;" data-search>
		            <div class="box-header with-border">
		              <h3 class="box-title">Daftar Mata Kuliah</h3>
		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool remove" data-widget="remove"><i class="fa fa-times"></i></button>
		              </div>
		              <!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body daftar-mp">
		            	<div class="row">
		            		<div class="col-md-12">
				            	<div class="box">
				            		<div class="box-body">
					            		<div class="row">
							                <div class="col-sm-4 col-xs-4 border-right hidden-phone">
							                  <div class="description-block">
							                    <h5 class="description-header">Fakultas</h5>
							                    <span class="description-text detail-prodi-mk detail-prodi-nama_fakultas"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							                <div class="col-sm-4 col-xs-6 border-right">
							                  <div class="description-block">
							                    <h5 class="description-header">Program Studi</h5>
							                    <span class="description-text detail-prodi-mk detail-prodi-nama_prodi"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							                <div class="col-sm-4 col-xs-6">
							                  <div class="description-block">
							                    <h5 class="description-header">Jenjang</h5>
							                    <span class="description-text detail-prodi-mk detail-prodi-jenjang_prodi"></span>
							                  </div>
							                  <!-- /.description-block -->
							                </div>
							            </div>	
				            		</div>
				            	</div>			
			            	</div>
				            <div class="col-md-12">
				            	<table class="table table-bordered table-striped table-hover tbl-data-mk">
					                <thead>
					                <tr>
					                  <th class="text-center" style="width: 37px"><input type="checkbox" class="check-all-data check-all-mk" data-selected="check-mk" data-all-selected="check-all-mk" data-toggle=".edit-mk,.hapus"></th>
					                  <th class="text-center" style="width: 80px">Kode MK</th>
					                  <th style="width: 370px">Mata Kuliah</th>
					                  <th class="text-center" style="width: 50px">Kategori</th>
					                  <th>Konsentrasi</th>
					                  <th class="text-center" style="width: 45px">SKS</th>
					                  <th class="text-center" style="width: 85px">Aksi</th>
					                </tr>
					                </thead>
					                <tbody>
					                <tr>
					                	<td colspan="7" align="center">Memproses Data</td>
					                </tr>					                					                
					                </tbody>
					                <tfoot>
					                <tr>
					                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-mk" data-selected="check-mk" data-all-selected="check-all-mk" data-toggle=".edit-mk,.hapus"></th>
					                  <th class="text-center">Kode MK</th>
					                  <th>Mata Kuliah</th>
					                  <th class="text-center">Kategori</th>
					                  <th>Konsentrasi</th>
					                  <th class="text-center">SKS</th>
					                  <th class="text-center">Aksi</th>
					                </tr>
					                </tfoot>
					            </table>
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
        			<table class="table table-bordered list-mhs-selected" style="width: 100%">
		                <thead>
			                <tr>
			                	<th class="text-center" style="width: 10%">No</th>
								<th class="text-center" style="width: 20%">Kode MK</th>
								<th style="width: 70%">Mata Kuliah</th>
			                </tr>
		                </thead>
		                <tbody>
		                </tbody>
		                <tfoot>
			                <tr>
			                	<th class="text-center">No</th>
			                	<th class="text-center">Kode MK</th>
								<th>Mata Kuliah</th>
			                </tr>
		                </tfoot>
		            </table>
        		</div>
        	</div>
            <form action="" id="form-input" style="display: none;">
	            <div class="row">
	            	<div class="col-md-6 col-xs-6">
		            	<div class="form-group" id="nama_mk">
							<label for="nama_mk">Mata Kuliah</label>
							<input type="text" class="form-control nama_mk" name="nama_mk" placeholder="Masukkan mata kuliah">
		                </div>
		                <div class="row">
		            		<div class="col-md-6 col-xs-6">
		            			<div class="form-group" id="kode_mk">
									<label for="kode_mk">Kode Mata Kuliah</label>
									<input type="text" class="form-control kode_mk" name="kode_mk" placeholder="Masukkan kode mata kuliah">
				                </div>
		            		</div>
		            		<div class="col-md-6 col-xs-6">
		            			<div class="form-group" id="jml_sks">
									<label for="jml_sks">Jumlah SKS</label>
									<input type="number" class="form-control jml_sks" name="jml_sks" placeholder="Masukkan jumlah sks">
				                </div>
		            		</div>
		            	</div>
	            	</div>
		            <div class="col-md-6 col-xs-6">
		            	<div class="form-group" id="id_pd_mk">
							<label for="id_pd_mk">Program Studi</label>
							<select class="form-control select2 select2-remote-dt select2_prodi id_pd_mk" style="width: 100%;" name="id_pd_mk"></select>
		                </div>
		                <div class="form-group" id="jenis_jdl">
							<label for="jenis_jdl">Konsentrasi</label>
			               	<select class="form-control select2 select2_konsentrasi_mk jenis_jdl" style="width: 100%;" name="jenis_jdl"></select>
		                  	<!-- <select class="form-control select2 select2_jenismk jenis_jdl" style="width: 100%;" name="jenis_jdl">
			                  	<option value=""></option>
			                  	<option value="0">Umum</option>
			                  	<option value="1">Skripsi</option>
			                  	<option value="2">Tesis</option>
			                  	<option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (Konsentrasi)</option>
			                  	<option value="Jaringan">Jaringan (Konsentrasi)</option>
			                  	<option value="Desain WEB">Desain WEB (Konsentrasi)</option>
			                  	<option value="Sistem Informasi Geografi">Sistem Informasi Geografi (Konsentrasi)</option>
			                  	<option value="Multimedia">Multimedia (Konsentrasi)</option>
		                  	</select> -->
		                </div>
			        </div>
		        </div>		        
		        <input type="hidden" id="data" name="data_mk">              		        
		        <input type="hidden" class="id_pd_mk">
		        <input type="hidden" class="id_mk" name="id_mk">
		        <input type="hidden" class="kode_mk" name="kode_mk_s">
		        <input type="hidden" class="nama_mk" name="mk_s">
		        <input type="hidden" class="nama_mk" name="mk_s">
            </form>
            <form action="" id="form-edit-mk" style="display: none;">
	            <div class="row">
		            <div class="col-md-4 col-xs-4">
		      			<div class="form-group">
			      			<label for="jml_sks">Program Studi</label>
		                  	<select class="form-control select2 select2-remote-dt select2_prodi id_pd_mk" style="width: 100%;" name="id_pd_mk"></select>
		                </div>
		            </div>
		            <div class="col-md-3 col-xs-3">
		      			<div class="form-group">
							<label for="jml_sks">Jumlah SKS</label>
							<input type="number" class="form-control jml_sks" name="jml_sks" placeholder="Masukkan jumlah sks">
		                </div>
		            </div>
		            <div class="col-md-5 col-xs-5">
		      			<div class="form-group">
		                  <label for="jenis_jdl">Konsentrasi</label>
		                  <select class="form-control select2 select2_konsentrasi_mk jenis_jdl" style="width: 100%;" name="jenis_jdl"></select>
		                  <!-- <select class="form-control select2 select2_jenismk jenis_jdl" style="width: 100%;" name="jenis_jdl">
		                  	<option value=""></option>
		                  	<option value="0">Umum</option>
		                  	<option value="1">Skripsi</option>
		                  	<option value="2">Tesis</option>
		                  	<option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (Konsentrasi)</option>
		                  	<option value="Jaringan">Jaringan (Konsentrasi)</option>
		                  	<option value="Desain WEB">Desain WEB (Konsentrasi)</option>
		                  	<option value="Sistem Informasi Geografi">Sistem Informasi Geografi (Konsentrasi)</option>
		                  	<option value="Multimedia">Multimedia (Konsentrasi)</option>
		                  </select> -->
		                </div>
		            </div>
	            </div>
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