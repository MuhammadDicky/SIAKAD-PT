<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<section class="col-md-6">
		        <div class="box box-success box-solid">
		            <div class="box-header with-border">
		              <h3 class="box-title">Backup Database</h3>
		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <div class="box-body">
		            	Gunakan tombol dibawah ini untuk melakukan backup database, silahkan pilih akan membackup bersama dengan data atau membackup tanpa data yang sudah ada.
		            	<table class="table no-margin table-backup-db">
		                	<thead>
								<tr>
									<th style="width: 100px">Backup File</th>
									<th class="text-center">Dibuat</th>
									<th class="text-center">Aksi</th>
								</tr>
		                  	</thead>
		                  	<tbody>
			                  	<tr>
				                    <td colspan="3" class="text-center">Memproses...</td>
			                  	</tr>
		                  	</tbody>
		                </table>
		            </div>
		            <div class="box-footer">
		            	<a class="btn btn-success pull-right backup_db"><i class="fa fa-download"></i> Backup Database</a>
		            </div>
		        </div>
			</section>
			<section class="col-md-6">
				<div class="box box-warning box-solid">
		            <div class="box-header with-border">
		              <h3 class="box-title">Backup Tabel Database</h3>
		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <div class="box-body">
			            Gunakan tombol dibawah ini untuk melakukan backup table database, silahkan pilih akan membackup bersama dengan data atau membackup tanpa data yang sudah ada.
			            <div class="form-group" style="margin-top: 5px">
		                  <label>Table Database</label>
		                  <select class="form-control select2 select2_tbl_db" style="width: 100%;" name="tbl_db[]" multiple="multiple" data-placeholder="Pilih tabel database"></select>
		                </div>
		                <table class="table no-margin table-backup-tbl-db">
		                	<thead>
								<tr>
									<th style="width: 100px">Backup File</th>
									<th class="text-center">Dibuat</th>
									<th class="text-center">Aksi</th>
								</tr>
		                  	</thead>
		                  	<tbody>
			                  	<tr>
				                    <td colspan="3" class="text-center">Memproses...</td>
			                  	</tr>
		                  	</tbody>
		                </table>
		            </div>
		            <div class="box-footer">
		            	<a class="btn btn-warning pull-right backup_db_tbl disabled"><i class="fa fa-download"></i> Backup Tabel</a>
		            </div>
		        </div>
			</section>
		</div>		
	</section>

	<!-- modal open -->
    <div class="modal style-2 modal-success fade" id="myModal" role="dialog" data-keyboard="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Backup Database</h4>
          </div>

          <div class="modal-body">
          	<form action="" form-data="backup-db">
          		<table>
          			<tr>
          				<td valign="top"><li class="fa fa-exclamation-circle"></li></td>
          				<td>&nbsp</td>
          				<td>Silahkan masukkan username dan password admin anda untuk melakukan backup.</td>
          			</tr>
          			<tr>
          				<td valign="top"><li class="fa fa-exclamation-circle"></li></td>
          				<td>&nbsp</td>
          				<td>Tidak memilih opsi backup data akan dianggap membackup dengan data.</td>
          			</tr>
          			<tr>
          				<td valign="top"><li class="fa fa-exclamation-circle"></li></td>
          				<td>&nbsp</td>
          				<td>Jika database memiliki data yang sangat banyak, sebaiknya melakukan backup langsung di SQL Server via command line.</td>
          			</tr>
          		</table>
          		<div class="form-group centered-content" style="margin-top: 5px">
                	<div class="form-group">
					<label>
	                  <input type="radio" class="backup_db_opsi" name="backup_db_option" value="TRUE">
	                  Backup dengan data
	                </label>&nbsp&nbsp
	                <label>
	                  <input type="radio" class="backup_db_opsi" name="backup_db_option" value="FALSE">
	                  Backup tanpa data
	                </label>
	                </div>
				</div>
          		<hr style="margin-top: -25px">
          		<div class="row">
	          		<div class="col-md-6 col-xs-6">
	          			<div class="form-group">
		                  <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
		                    <input type="text" class="form-control" placeholder="Username" name="username">
		                  </div>
		                </div>
	          		</div>
	          		<div class="col-md-6 col-xs-6">
	          			<div class="form-group">
		                  <div class="input-group">
		                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
		                    <input type="password" class="form-control" placeholder="Password" name="password">
		                  </div>
		                </div>
	          		</div>
          		</div>		          		
          	</form>
          	<div class="row centered-content">
	            <div class="col-md-12 col-xs-12">
	            	<div id="alert-place">
					</div>
				</div>
			</div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-outline cancel" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-outline submit" id="backup_db">Backup Database</button>            
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- modal end -->

<?php echo get_templete_part('template_part/footer'); ?>