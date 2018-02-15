<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<section class="col-md-3">
		      <div class="box box-success box-solid control-panel-data-tbl">
		        <div class="box-header with-border">
		          	<h3 class="box-title">Control Panel</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
		        </div>
		        <!-- /.box-header -->
		        <div class="box-body">
					<div class="row" style="margin-bottom:-15px">
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  <label for="thn_angkatan">Tampilkan</label>
			                  <!-- <input class="form-control" type="text" name="wali_kelas"> -->
			                  <select class="form-control select2 select2_tamp" style="width: 100%;">
			                  	<option value="5">5 Data</option>
			                  	<option value="10">10 Data</option>
			                  	<option value="15">15 Data</option>
			                  	<option value="20">20 Data</option>
			                  </select>
			                </div>
						</div>
						<div class="col-md-12 col-xs-6">
							<div class="form-group">
			                  	<label>Cari</label>
			                  	<div class="input-group">
					                <input type="text" class="form-control cari-data-tbl" name="cari" placeholder="Cari Data Pengguna">
				                    <span class="input-group-btn">
				                      <button type="button" class="btn btn-success btn-flat" style="cursor: default;"><span class="fa fa-search"></span></button>
				                    </span>
					            </div>
			                </div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 semua-data" style="display: none;">
			      			<div class="form-group">
			                  <a href="" class="btn btn-success btn-block" id="semua-data"><i class="fa fa-list"></i> Tampilkan Semua Data</a>
			                </div>
			            </div>
					</div>
					<hr style="border-bottom: 2px solid grey">
					<form id="form-print-u">
						<div class="row" style="margin-bottom:-15px">
							<?php if ($user_lvl == 'mhs'): ?>
			            	<div class="col-md-12 col-xs-6">
				      			<div class="form-group">
				                  <label>Tahun Angkatan</label>
				                  <select class="form-control select2 select2_thn_angkatan filter-dt" name="thn_angkatan" style="width: 100%;"></select>
				                </div>
				            </div>
				            <?php endif ?>
				            <div class="col-md-12 col-xs-6">
				      			<div class="form-group">
				                  <label>Program Studi</label>
				                  <select class="form-control select2 select2_prodi filter-dt" name="prodi" style="width: 100%;"></select>
				                </div>
				            </div>
				            <div class="col-md-12 col-sm-12 col-xs-12">
				            	<div class="form-group">
				                  <a class="btn btn-success btn-block disabled" id="created-pass" style="pointer-events:"><i class="fa fa-key"></i> Buat Password</a>
				                </div>
				            </div>
			            </div>
		            </form>
		            <hr style="border-bottom: 2px solid grey">
		            <div class="row" style="margin-bottom:-15px">
		            	<div class="col-md-12">
		            		<div class="form-group">
			                	<label>Status User</label>
			                	<div class="row">
			                		<div class="col-md-6 col-sm-12 col-xs-6">
					            		<button type="button" class="btn btn-success btn-block btn-status-user" title="Tampilkan Data Pengguna Yang Sudah Aktif" value="1" data-search=""><li class="fa fa-check-circle"></li> Aktif</button>
					            	</div>
					            	<div class="col-md-6 col-sm-12 col-xs-6">
					            		<button type="button" class="btn btn-danger btn-block btn-status-user" title="Tampilkan Data Pengguna Yang Nonaktif" value="0" data-search=""><li class="fa fa-ban"></li> Nonaktif</button>
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
				<div class="box box-solid box-success" id="box-content">
			        <div class="box-header">
						<h3 class="box-title">Data Pengguna <?php echo $pengguna; ?></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" id="refresh-table-user" title="Refresh Data"><i class="glyphicon glyphicon-refresh"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
			        </div><!-- /.box-header -->
			        <div class="box-body">			        	
			        	<div class="row">
			        		<div class="col-md-12">			        			
			        			<table class="table table-bordered table-striped table-hover datatable-dt" id="tbl-user" table-dt="#tbl-user" table-box="#box-content">
					                <thead>
					                <tr>
										<th>Username</th>
										<th>Nama</th>
										<th>Status</th>
										<th>Terakhir Online</th>
										<th>Aksi</th>
					                </tr>
					                </thead>
					                <tbody>
					                <tr>
					                	<td colspan="5" align="center">Memproses Data</td>
					                </tr>					                					                
					                </tbody>
					                <tfoot>
					                <tr>
										<th>Username</th>
										<th>Nama</th>
										<th>Status</th>
										<th>Terakhir Online</th>
										<th>Aksi</th>
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
			</section>
		</div>		
	</section>

	<!-- modal open -->
    <div class="modal modal-info fade" id="myModal" role="dialog" data-keyboard="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>

          <div class="modal-body">  
          	<div class="row centered-content">
          		<div class="col-xs-5">		            
		            <div id="alert-place">		                	               
					</div>
	            </div>
            </div>
            <div class="data-message">
            	<div class="centered-content"></div>
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