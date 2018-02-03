<?php echo get_templete_part('template_part/header'); ?>

	<?php if ($_SESSION['level_akses'] == 'mhs'): ?>	
	<section class="content">
		<div class="row">
			<div class="col-md-5">
				<div class="box box-widget widget-user-2">
		            <div class="widget-user-header bg-yellow">
		              <div class="widget-user-image">
		                <img class="img-circle" src="<?php echo $_SESSION['photo_u'] ?>" alt="User profile picture">
		              </div>						              
		              <h3 class="widget-user-username"><?php echo $_SESSION['nama']; ?></h3>
		              <h5 class="widget-user-desc"><?php echo $_SESSION['nim']; ?></h5>
		            </div>
		            <div class="box-footer no-padding">
		              <ul class="nav nav-stacked">
			            <li><a><b>Fakultas</b> <span class="pull-right"><?php echo $_SESSION['fk']; ?></span></a></li>
		              	<li><a><b>Program Studi</b> <span class="pull-right"><?php echo $_SESSION['prodi']; ?> (<?php echo $_SESSION['jenjang_prodi']; ?>)</span></a></li>
		                <li><a><b>Tahun Angkatan</b> <span class="pull-right"><?php echo $_SESSION['thn_angkatan']; ?></span></a></li>
		                <li><a><b>Agama</b> <span class="pull-right"><?php echo $_SESSION['agama']; ?></span></a></li>
		              </ul>
		            </div>
		        </div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
					          <!-- small box -->
					          <div class="small-box bg-green">
					            <div class="inner">
					              <h3><?php echo $_SESSION['thn_ajaran'];?></h3>

					              <p>Tahun Akademik</p>
					            </div>
					            <div class="icon">
					            	<?php if ($_SESSION['thn_ajaran'] != '-'): ?>
					            	<i class="fa fa-calendar-check-o"></i>
					            	<?php endif ?>
					            	<?php if ($_SESSION['thn_ajaran'] == '-'): ?>
					            	<i class="fa fa-calendar-minus-o"></i>
					            	<?php endif ?>
					            </div>
					            <a href="<?php echo base_url('beranda_mhs/data_jadwal'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>	        
						</div>						
					</div>
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
					          <!-- small box -->
					          <div class="small-box bg-aqua">
					            <div class="inner">
					              <h3><?php echo $count_all_jadwal; ?></h3>

					              <p>Jumlah Jadwal Kuliah</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-list"></i>
					            </div>
					            <a href="<?php echo base_url('beranda_mhs/data_jadwal'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>	           
						</div>						
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
					          <!-- small box -->
					          <div class="small-box bg-yellow">
					            <div class="inner">
					              <h3><?php echo $count_thn_ak_mhs; ?></h3>

					              <p>Jumlah Tahun Akademik Yang Diikuti</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-users"></i>
					            </div>
					            <a href="<?php echo base_url('beranda_mhs/data_mhs'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>	     
						</div>						
					</div>
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
					          <!-- small box -->
					          <div class="small-box bg-red">
					            <div class="inner">
					              <h3><?php echo $count_studi; ?></h3>

					              <p>Jumlah Riwayat Studi</p>
					            </div>
					            <div class="icon">
					              <i class="fa fa-book"></i>
					            </div>
					            <a href="<?php echo base_url('beranda_mhs/data_mhs'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info" id="box-jadwal">
		            <div class="box-header with-border">
		              	<h3 class="box-title">Jadwal Kuliah Hari</h3>
		              	<div class="box-tools pull-right">
		              		<button type="button" class="btn btn-box-tool refresh-data-mhs"><i class="fa fa-refresh"></i></button>
		                	<button type="button" class="btn btn-box-tool remove" data-widget="collapse"><i class="fa fa-minus"></i></button>
		              	</div>
		              <!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="row">
		            		<div class="col-md-12">
		            			<table class="table table-bordered tbl-data-jadwal">
					                <thead>
						                <tr>
						                  <th class="text-center">Smtr/Kls</th>
						                  <th class="text-center">Waktu</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center">SKS</th>
						                  <th class="text-center">Ruang</th>
						                  <th>Dosen</th>							                  
						                </tr>
					                </thead>
					                <tbody>
					                </tbody>
					                <tfoot>
						                <tr>
						                  <th class="text-center">Smtr/Kls</th>
						                  <th class="text-center">Waktu</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center">SKS</th>
						                  <th class="text-center">Ruang</th>
						                  <th>Dosen</th>
						                </tr>
					                </tfoot>
					            </table>
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
	</section>
	<?php endif ?>

	<?php if ($_SESSION['level_akses'] == 'ptk'): ?>	
	<section class="content">
		<div class="row">
	        <div class="col-lg-3 col-md-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-green">
	            <div class="inner">
	              <h3><?php echo $_SESSION['thn_ajaran'];?></h3>

	              <p>Tahun Akademik</p>
	            </div>
	            <div class="icon">
	            	<?php if ($_SESSION['thn_ajaran'] != '-'): ?>
	            	<i class="fa fa-calendar-check-o"></i>
	            	<?php endif ?>
	            	<?php if ($_SESSION['thn_ajaran'] == '-'): ?>
	            	<i class="fa fa-calendar-minus-o"></i>
	            	<?php endif ?>
	            </div>
	            <a href="<?php echo base_url(''); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <div class="col-lg-3 col-md-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3><?php echo $count_mengajar; ?></h3>

	              <p>Jumlah Riwayat Mengajar</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-book"></i>
	            </div>
	            <a href="<?php echo base_url(''); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        
	        <div class="col-lg-3 col-md-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-yellow">
	            <div class="inner">
	              <h3><?php echo $count_jadwal; ?></h3>

	              <p>Jumlah Jadwal Mengajar</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-list"></i>
	            </div>
	            <a href="<?php echo base_url('beranda_ptk/jadwal_mengajar'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <div class="col-lg-3 col-md-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?php echo $count_kelas_ajar; ?></h3>

	              <p>Jumlah Kelas Yang Didik</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-building-o"></i>
	            </div>
	            <a href="<?php echo base_url('beranda_ptk/jadwal_mengajar'); ?>" class="small-box-footer">Info detail <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="box box-info" id="box-jadwal">
		            <div class="box-header with-border">
		              	<h3 class="box-title"><li class="fa fa-list"></li> Jadwal Mengajar Hari</h3>
		              	<div class="box-tools pull-right">
		                	<button type="button" class="btn btn-box-tool refresh-data-ptk"><i class="fa fa-refresh"></i></button>
		                	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		              	</div>
		              <!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">		            	
		            	<div class="row">
		            		<div class="col-md-12">
		            			<table class="table table-bordered tbl-data-jadwal">
					                <thead>
						                <tr>
						                  <th class="text-center" style="width: 80px">Smtr/Kls</th>
						                  <th class="text-center" style="width: 100px">Jam</th>
						                  <th class="text-center" style="width: 80px">Ruang</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 50px">SKS</th>
						                </tr>
					                </thead>
					                <tbody>
					                </tbody>
					                <tfoot>
						                <tr>
						                  <th class="text-center" style="width: 80px">Smtr/Kls</th>
						                  <th class="text-center" style="width: 100px">Jam</th>
						                  <th class="text-center" style="width: 80px">Ruang</th>
						                  <th>Mata Kuliah</th>
						                  <th class="text-center" style="width: 50px">SKS</th>
						                </tr>
					                </tfoot>
					            </table>
		            		</div>
		            	</div>
		            </div>
		            <!-- /.box-body -->						            
		            <div class="overlay" style="display: none;">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-solid bg-green-gradient grafik-ptk">
				            <div class="box-header">
				              <i class="fa fa-pie-chart"></i>

				              <h3 class="box-title">Grafik Data Tenaga Pendidik</h3>

				              <div class="box-tools pull-right">
				              	<button type="button" class="btn bg-green btn-sm" id="refresh-statik-ptk"><i class="fa fa-refresh"></i>
				                </button>
				                <button type="button" class="btn bg-green btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				                </button>				                
				              </div>
				            </div>
				            <div class="box-body border-radius-none">
				            	<div class="row">
				            		<div class="col-md-12 col-xs-12">
				            			<div class="chart-responsive">
					                		<canvas id="pieChart-data-ptk" height="180"></canvas>
						                </div>
				            		</div>
				            	</div>				            	
				            </div>
				            <!-- /.box-body -->
				            <div class="box-footer no-padding">
				              <ul class="nav nav-pills nav-stacked daftar-pd content-responsive style-3">
				              	<li class="text-center"><a>Memproses Data...</a></li>
				              </ul>
				            </div>
				            <!-- /.box-footer -->
				        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif ?>

<?php echo get_templete_part('template_part/footer'); ?>