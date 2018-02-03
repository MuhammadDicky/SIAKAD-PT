<?php echo get_templete_part('template_part/header'); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="box box-solid box-warning" id="box-nilai">
			        <div class="box-header">
						<h3 class="box-title">Daftar Nilai Akhir Mahasiswa</h3>
						<div class="box-tools pull-right">
		              		<button type="button" class="btn btn-box-tool remove" data-widget="collapse"><i class="fa fa-minus"></i></button>	
			            </div>
			        </div><!-- /.box-header -->
			        <div class="box-body">
		            	<div class="row">
			            	<div class="col-md-4">
				            	<div class="row">
				            		<div class="col-md-12">	
								        <div class="box box-widget widget-user-2">
								            <div class="widget-user-header bg-yellow">
								              <div class="widget-user-image">
								                <img class="img-circle" src="<?php echo $_SESSION['photo_u']; ?>" alt="User profile picture">
								              </div>						              
								              <h3 class="widget-user-username nama-ket" style="font-size: 15pt"><?php echo $_SESSION['nama']; ?></h3>
								              <h5 class="widget-user-desc nisn-ket"><?php echo $_SESSION['nim']; ?></h5>
								            </div>
								            <div class="box-footer no-padding">
								              <ul class="nav nav-stacked">
								              	<li><a><b>Fakultas</b> <span class="pull-right nama-fakultas-ket"><?php echo $_SESSION['fk']; ?></span></a></li>
								              	<li><a><b>Program Studi</b> <span class="pull-right nama-prodi-ket"><?php echo $_SESSION['prodi']; ?></span></a></li>
								              	<li><a><b>Jenjang</b> <span class="pull-right nama-prodi-ket"><?php echo $_SESSION['jenjang_prodi']; ?></span></a></li>
								                <li><a><b>Tahun Akademik</b> <span class="pull-right tahun-ajaran-ket"><?php echo $_SESSION['thn_ajaran']; ?></span></a></li>
								              </ul>
								            </div>
								        </div>
				            		</div>
				            	</div>
				            	<div class="row">
					            	<div class="col-md-12">
						            	<div class="box box-warning">
						            		<div class="box-body">
				            					<div class="form-group">
				            						<select class="form-control select2 select2_jadwal" style="width: 100%"></select>
				            					</div>
				            					<div class="form-group">
				            						<div class="row">
				            							<div class="col-md-12 col-xs-12">
				            								<a href="" class="btn btn-success btn-block disabled tamp-nilai"><i class="fa fa-file-text-o"></i> Tampilkan Nilai</a>
				            							</div>
				            						</div>
						            			</div>
						            		</div>
						            	</div>			
					            	</div>			       
				            	</div>
			            	</div>
		            		<div class="col-md-8">
		            			<table class="table table-bordered tbl-nilai-mhs table-striped">
					                <thead>
						                <tr>										                  
						                  <th class="text-center" style="width: 40px">No</th>
						                  <th class="text-center" style="width: 80px">Kode MK</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 50px;">SKS</td>
						                  <th class="text-center" style="width: 50px;">HM</td>
						                  <th class="text-center" style="width: 60px;">AM</th>
						                  <th class="text-center" style="width: 60px;">Mutu</th>
						                </tr>
					                </thead>
					                <tbody>
					                	<tr>
					                		<td colspan="7" class="text-center">Memproses data...</td>
					                	</tr>
					                </tbody>
					                <tfoot>
						                <tr>
						                  <th class="text-center" style="width: 40px">No</th>
						                  <th class="text-center" style="width: 80px">Kode MK</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 50px;">SKS</td>
						                  <th class="text-center" style="width: 50px;">HM</td>
						                  <th class="text-center" style="width: 60px;">AM</th>
						                  <th class="text-center" style="width: 60px;">Mutu</th>
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
	</section>

<?php echo get_templete_part('template_part/footer'); ?>