<script type="text/javascript">
  var requireJS = [
  	{
  		'name': 'datepicker',
  		'link': "<?php echo get_plugin('datepicker','js') ?>",
  		'state': true
  	},
  	{
      'name': 'chartJS',
      'link': "<?php echo get_plugin('chartjs','js',' 2.7.1')?>",
      'state': true
    },
    {
  		'name': 'datatables',
  		'link': "<?php echo get_plugin('datatables','js','jquery')?>",
  		'state': true
  	},
  	{
  		'name': 'datatables bs',
  		'link': "<?php echo get_plugin('datatables','js','bs')?>",
  		'state': true
  	},
  	{
  		'name': 'datatables responsive',
  		'link': "<?php echo get_plugin('datatables','js','responsive')?>",
  		'state': true
  	},
  	{
  		'name': 'iCheck',
  		'link': "<?php echo get_plugin('icheck','js')?>",
  		'state': true
  	},
  	{
  		'name': 'select2',
  		'link': "<?php echo get_plugin('select2','js')?>",
  		'state': true
  	},
  	{
  		'name': 'select2 language',
  		'link': "<?php echo get_plugin('select2','js','lang')?>",
  		'state': true
  	},
  	{
      'name': 'App Config JS',
      'link': "<?php echo get_configJS('js_views/config.js') ?>",
      'state': false
    },
    {
  		'name': 'Page JS',
  		'link': "<?php echo get_configJS('js_views/mod_dt_fakultas_pstudi.js') ?>",
  		'state': false
  	}
  ];
  var requireCSS = [
  	{
  		'name': 'datepicker',
  		'link': "<?php echo get_plugin('datepicker','css')?>",
  		'state': true
  	},
  	{
  		'name': 'datatables',
  		'link': "<?php echo get_plugin('datatables','css','bs')?>",
  		'state': true
  	},
  	{
  		'name': 'iCheck Color',
  		'link': "<?php echo get_plugin('icheck','css','flat_blue') ?>",
  		'state': true
  	},
  	{
  		'name': 'select2',
  		'link': "<?php echo get_plugin('select2','css') ?>",
  		'state': true
  	},
  	{
  		'name': 'iCheck',
  		'link': "<?php echo get_plugin('icheck','css','all')?>",
  		'state': true
  	}
  ];
  loadCSS(requireCSS);
  requestJS(requireJS);
</script>
<div class="animated fadeIn">
  	<div class="row">
	    <div class="col-md-12 mb-2">
	      	<div class="card border-danger box-mp-controlp" id="box-content">
		        <div class="card-header bg-red text-white">
		          Control Panel
		        </div>
		        <div class="card-body">
		          	<div class="row">
		        		<div class="col-md-12">
		        			<div class="control-panel-data">
		            			<button type="button" class="btn btn-primary info"><i class="fa fa-info-circle"></i></button> | 
		            			<a href="#tambah" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Fakultas</a> 
		            			<a href="#delete_selected?fk" class="btn btn-danger disabled hapus"><i class="fa fa-trash"></i> hapus</a> | 
		            			<a href="#tambah?prodi" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Program Studi</a> 
		            			<a href="#" class="btn btn-warning refresh-table-pd datatables-refresh-btn"><i class="fa fa-list"></i> Daftar Program Studi</a> 
		            			<a href="#delete_selected?pd" class="btn btn-danger hapus-prodi disabled"><i class="fa fa-trash"></i> hapus</a>
		        			</div>
		        		</div>
		        	</div>
			        <hr>
			      	<div class="row">
			    		<div class="col-md-12">
			    			<ul class="nav nav-tabs" role="tablist">
						        <li class="nav-item">
						          <a class="nav-link active" data-toggle="tab" href="#daftar-fk" role="tab" aria-controls="daftar-fk"><i class="fa fa-list"></i> Daftar Fakultas</a>
						        </li>
						        <li class="nav-item">
						          <a class="nav-link" data-toggle="tab" href="#statik-fk" role="tab" aria-controls="statik-fk"><i class="fa fa-bar-chart"></i> Statistik Fakultas</a>
						        </li>
					      	</ul>

						    <div class="tab-content">
						        <div class="tab-pane active" id="daftar-fk" role="tabpanel">
						        	<table class="table table-responsive-sm table-bordered table-striped tbl-data-fk datatable-dt" table-dt=".tbl-data-fk" data-tbl-selected="check-all-fk check-fk" table-box="#box-content">
						                <thead>
							                <tr>
							                  <th style="width: 10px"><input type="checkbox" class="check-all-data check-all-fk icheck-input-checkbox" data-selected="check-fk" data-all-selected="check-all-fk" data-toggle=".hapus"></th>
							                  <th>Nama Fakultas</th>
							                  <th>Dekan</th>					                  
							                  <th style="width: 150px">Tanggal Berdiri</th>
							                  <th style="width: 20px">Akreditasi</th>
							                  <th style="width: 160px" class="text-center">Aksi</th>
							                </tr>
						                </thead>
						                <tbody>
							                <tr>
							                	<td colspan="7" align="center">Memproses Data</td>
							                </tr>					                					                
						                </tbody>
						                <tfoot>
							                <tr>			
							                  <th><input type="checkbox" class="check-all-data check-all-fk icheck-input-checkbox" data-selected="check-fk" data-all-selected="check-all-fk" data-toggle=".hapus"></th>
							                  <th>Nama Fakultas</th>
							                  <th>Dekan</th>					                  
							                  <th>Tanggal Berdiri</th>
							                  <th>Akreditasi</th>
							                  <th class="text-center">Aksi</th>
							                </tr>
						                </tfoot>
						            </table>
						        </div>
						        <div class="tab-pane" id="statik-fk" role="tabpanel">
						        	<div class="row chart-container">
				              			<div class="col-md-8 col-sm-8">
						                  	<p class="text-center"><strong class="title-thn-ak-static">Data Statistik Mahasiswa Berdasarkan Fakultas</strong></p>
						                    <div class="chart">
								                <canvas id="barchart-mhs-master-dt" style="height: 315px; width: 510px;"></canvas>
								            </div>
						                </div>
						                <div class="col-md-4 col-sm-4">
						                  	<div class="pad content-responsive style-2 detail-jml-mhs-dt" style="height: 375px">
							                </div>
						                </div>
									</div>
						        </div>
						    </div>
			    		</div>
			    	</div>
			    	<div class="row">
		        		<div class="col-md-12">
		        			<div class="card card-accent-danger mb-0 mt-4" id="box-detail-fk" style="display: none;">
						        <div class="card-header">Detail Data Fakultas
						          <div class="card-actions">
						            <a href="#" class="btn remove" data-remove="detail-fk" data-card="#box-detail-fk" data-widget="remove"><i class="fa fa-times"></i></a>
						          </div>
						        </div>
						        <div class="card-body">
						        	<div class="row">
						        		<div class="col-md-4">
									        <ul class="list-group">
									            <li class="list-group-item bg-danger">Fakultas 
									            	<span class="pull-right detail-fak-nama_fakultas detail-fak">-</span>
									            </li>
									            <li class="list-group-item">Dekan 
									            	<span class="pull-right detail-fak-dekan detail-fak">-</span>
									            </li>
									            <li class="list-group-item">Tanggal Berdiri 
									            	<span class="pull-right detail-fak-tgl_berdiri detail-fak">-</span>
									            </li>
									            <li class="list-group-item">Akreditasi 
									            	<span class="pull-right detail-fak-akreditasi_fk detail-fak">-</span>
									            </li>
									        	<li class="list-group-item">Jumlah Mahasiswa 
									        		<span class="pull-right">
									        			<i class="fa fa-users"></i>
									        			<span class="detail-fak-jml_mhs detail-fak">-</span>
									        		</span>
									        	</li>
									        	<li class="list-group-item">Mahasiswa Laki-Laki 
									        		<span class="pull-right">
									        			<i class="fa fa-male"></i>
									        			<span class="detail-fak-jml_lk detail-fak">-</span>
									        		</span>
									        	</li>
									        	<li class="list-group-item">Mahasiswa Perempuan 
									        		<span class="pull-right">
									        			<i class="fa fa-female"></i>
									        			<span class="detail-fak-jml_pr detail-fak">-</span>
									        		</span>
									        	</li>
									        </ul>
						        		</div>
						        		<div class="col-md-8">
						        			<ul class="nav nav-tabs" role="tablist" id="tab-detail-fk">
										        <li class="nav-item">
										          <a class="nav-link active open-tab daftar-prodi" data-toggle="tab" href="#daftar-prodi" role="tab" aria-controls="daftar-fk">Program Studi</a>
										        </li>
										        <li class="nav-item">
										          <a class="nav-link close-tab detail-prodi" data-toggle="tab" href="#detail-prodi" role="tab" aria-controls="detail-prodi" style="display: none;">Detail Prodi</a>
										        </li>
										        <li class="nav-item">
										          <a class="nav-link close-dt-pd-bt remove" data-remove="detail-prodi" style="display: none;"><i class="fa fa-times"></i></a>
										        </li>
									      	</ul>

										    <div class="tab-content">
										        <div class="tab-pane open-dt-tab active" id="daftar-prodi" role="tabpanel">
										        	<table class="table table-bordered tbl-data-prodi mb-0">
										                <thead>
											                <tr>
											                  <th class="text-center">No.</th>
											                  <th class="text-center" style="width: 105px">Kode Prodi</th>
											                  <th style="width: 200px">Nama Program Studi</th>
											                  <th class="text-center">Jenjang</th>
											                  <th class="text-center" style="width: 160px">Aksi</th>
											                </tr>
										                </thead>
										                <tbody>
											                <tr>
											                	<td colspan="5" align="center">Memproses Data</td>
											                </tr>
										                </tbody>
										                <tfoot>
											                <tr>
											                  <th class="text-center">No.</th>
											                  <th class="text-center">Kode Prodi</th>
											                  <th>Nama Program Studi</th>
											                  <th class="text-center">Jenjang</th>
											                  <th class="text-center">Aksi</th>
											                </tr>
										                </tfoot>
										            </table>
										        </div>
										        <div class="tab-pane close-dt-tab" id="detail-prodi" role="tabpanel">
										        	<div class="row">
										        		<div class="col-md-12">
												        	<div class="card border-danger">
														        <div class="card-header bg-red text-white">
														          Informasi Umum
														        </div>
														        <div class="card-body pb-0">
														        	<dl class="row">
														                <dt class="col-sm-5 text-truncate">Fakultas</dt>
														                <dd class="col-sm-7 detail-dt-prodi nama_fakultas"></dd>

														                <dt class="col-sm-5 text-truncate">Kode Program Studi</dt>
														                <dd class="col-sm-7 detail-dt-prodi kode_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Nama Program Studi</dt>
														                <dd class="col-sm-7 detail-dt-prodi nama_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Nama Ketua Prodi</dt>
														                <dd class="col-sm-7 detail-dt-prodi nama_kprodi"></dd>

														                <dt class="col-sm-5 text-truncate">Jenjang</dt>
														                <dd class="col-sm-7 detail-dt-prodi jenjang_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Akreditas</dt>
														                <dd class="col-sm-7 detail-dt-prodi akreditasi_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Status</dt>
														                <dd class="col-sm-7 detail-dt-prodi status"></dd>

														                <dt class="col-sm-5 text-truncate">SK Penyelenggaraan</dt>
														                <dd class="col-sm-7 detail-dt-prodi sk_peny_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Tanggal SK</dt>
														                <dd class="col-sm-7 detail-dt-prodi tgl_sk_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Tanggal Berdiri</dt>
														                <dd class="col-sm-7 detail-dt-prodi tgl_berdiri_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Jumlah Mahasiswa</dt>
														                <dd class="col-sm-7">
														                	<dl class="row mb-0">
																                <dt class="col-sm-5 text-truncate">
																                	<span class="fa fa-male"></span> Laki-Laki
																	            </dt>
																                <dd class="col-sm-7 detail-dt-prodi jml_lk"></dd>

																                <dt class="col-sm-5 text-truncate">
																                	<span class="fa fa-female"></span> Perempuan
																	            </dt>
																                <dd class="col-sm-7 detail-dt-prodi jml_pr"></dd>

																                <dt class="col-sm-5 text-truncate">
																                	<span class="fa fa-users"></span> Jumlah
																	            </dt>
																                <dd class="col-sm-7 detail-dt-prodi jml_mhs"></dd>
																            </dl>
														                </dd>
														            </dl>
														        </div>
														    </div>	
										        		</div>
										        		<div class="col-md-12">
												        	<div class="card border-danger mb-0">
														        <div class="card-header bg-red text-white">
														          Kontak
														        </div>
														        <div class="card-body pb-0">
														        	<dl class="row">
													            		<dt class="col-sm-5 text-truncate">Alamat</dt>
														                <dd class="col-sm-7 detail-dt-prodi alamat_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Kode POS</dt>
														                <dd class="col-sm-7 detail-dt-prodi kode_pos_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Telepon</dt>
														                <dd class="col-sm-7 detail-dt-prodi telpon_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Fax</dt>
														                <dd class="col-sm-7 detail-dt-prodi fax_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Email</dt>
														                <dd class="col-sm-7 detail-dt-prodi email_prodi"></dd>

														                <dt class="col-sm-5 text-truncate">Website</dt>
														                <a href="" target="blank"><dd class="col-sm-7 detail-dt-prodi website_prodi"></dd></a>
														            </dl>
														        </div>
														    </div>	
										        		</div>
										        		<div class="col-md-12">
												        	<div class="card border-danger box-konsentrasi-pd mt-4 mb-0" style="display: none;">
														        <div class="card-header bg-red text-white">
														          Konsentrasi Program Studi
														        </div>
														        <div class="card-body">
														        	<table class="table table-bordered table-striped table-hover tbl-data-konst-pd mb-0">
														                <thead>
															                <tr>
															                  <th class="text-center" style="width: 5px">No</th>
															                  <th style="width: 300px">Nama Konsentrasi</th>
															                  <th class="text-center" style="width: 110px">Aksi</th>
															                </tr>
														                </thead>
														                <tbody>
															                <tr>
															                	<td colspan="3" align="center">Memproses Data</td>
															                </tr>
														                </tbody>
														                <tfoot>
															                <tr>
															                  <th class="text-center">No</th>
															                  <th>Nama Konsentrasi</th>
															                  <th class="text-center">Aksi</th>
															                </tr>
														                </tfoot>
														            </table>
														        </div>
														    </div>	
										        		</div>
										        	</div>
										        </div>
							        		</div>
							        	</div>
							        </div>
							    </div>
						    </div>
						</div>
					</div>
		    	</div>
	      	</div>
	    </div>
	</div>

  	<div class="row">
	  	<div class="col-md-12">
	  		<div class="card border-danger box-mp-controlp" id="box-prodi" style="display: none;">
		        <div class="card-header bg-red text-white">
		          Daftar Program Studi
		          <div class="card-actions">
		            <a href="#" class="btn remove text-white" data-widget="remove"><i class="fa fa-times"></i></a>
		          </div>
		        </div>
		        <div class="card-body">
		        	<table class="table table-bordered table-striped table-hover tbl-data-pd datatable-dt" table-dt=".tbl-data-pd" data-tbl-selected="check-all-prodi check-prodi" table-box="#box-prodi">
		                <thead>
			                <tr>
			                  <th style="width: 5px"></th>
			                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-prodi icheck-input-checkbox" data-selected="check-prodi" data-all-selected="check-all-prodi" data-toggle=".hapus-prodi"></th>
			                  <th class="text-center" style="width: 120px">Kode Prodi</th>
			                  <th style="width: 300px">Nama Program Studi</th>
			                  <th class="text-center">Status</th>
			                  <th class="text-center">Jenjang</th>
			                  <th class="text-center">Mahasiswa</th>
			                  <th class="text-center" style="width: 110px">Aksi</th>
			                </tr>
		                </thead>
		                <tbody>
			                <tr>
			                	<td colspan="8" align="center">Memproses Data</td>
			                </tr>
		                </tbody>
		                <tfoot>
			                <tr>
			                  <th></th>
			                  <th class="text-center"><input type="checkbox" class="check-all-data check-all-prodi icheck-input-checkbox" data-selected="check-prodi" data-all-selected="check-all-prodi" data-toggle=".hapus-prodi"></th>
			                  <th class="text-center">Kode Prodi</th>
			                  <th>Nama Program Studi</th>
			                  <th class="text-center">Status</th>
			                  <th class="text-center">Jenjang</th>
			                  <th class="text-center">Mahasiswa</th>
			                  <th class="text-center">Aksi</th>
			                </tr>
		                </tfoot>
		            </table>
		        </div>
		    </div>
	  	</div>
  	</div>
</div>

<div class="modal fade style-2" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" id="form-input" style="display: none;">
	        <div class="row">
            	<section class="col-md-6 col-xs-6">
	                <div class="form-group" id="nama_fakultas">
	                  <label for="nama_fakultas">Fakultas</label>
	                  <input type="text" class="form-control nama_fakultas" name="nama_fakultas" placeholder="Masukkan nama fakultas">
	                </div>
	                <div class="form-group" id="dekan">
	                  <label for="dekan">Dekan</label>
	                  <input type="text" class="form-control dekan" name="dekan" placeholder="Masukkan nama dekan">
	                </div>		                
				</section>
                <section class="col-md-6 col-xs-6">
	                <div class="form-group" id="tgl_berdiri">
						<label for="tgl_berdiri">Tanggal Berdiri</label>
						<div class="input-group">
							<div class="input-group-prepend">
			                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
			                </div>
							<input type="text" class="form-control pull-right datepicker tgl_berdiri" name="tgl_berdiri" placeholder="Contoh: 1995-08-14">
						</div>
	                </div>
	                <div class="form-group" id="akreditasi_fk">
	                  <label for="akreditasi_fk">Akreditas</label>
	                  <select class="form-control select2 select2_akreditasi_fk akreditasi_fk" style="width: 100%;" name="akreditasi_fk">
	                  	<option value=""></option>
	                  	<option value="A">A</option>
	                  	<option value="B">B</option>
	                  	<option value="C">C</option>		                  	
	                  </select>
	                </div>
				</section>
	        </div>
	        <input type="hidden" id="data" name="data_fakultas">              		        
	        <input type="hidden" class="id_fk" name="id_fk">		        
        </form>
        <form action="" id="form-input-pstudi" style="display: none;">
            <div class="row">
            	<div class="col-md-12">
		          	<!-- Custom Tabs -->
		            <ul class="nav nav-tabs" role="tablist">
		            	<li class="nav-item">
		                  <a class="nav-link active tab_umum_prodi open-tab" data-toggle="tab" href="#tab_umum_prodi" role="tab" aria-controls="form-profil">Umum</a>
		                </li>
		                <li class="nav-item">
		                  <a class="nav-link tab_kontak_prodi close-tab" data-toggle="tab" href="#tab_kontak_prodi" role="tab" aria-controls="form-profil">Kontak</a>
		                </li>
		              	<li class="nav-item">
		                  <a class="nav-link refresh-modal-form" role="tab" title="Reset Form Input"><i class="fa fa-refresh"></i></a>
		                </li>
		            </ul>
		            <div class="tab-content">
		            	<div class="tab-pane active open-dt-tab" id="tab_umum_prodi" role="tabpanel">
							<div class="tab-overflow-container default-overflow-container">
								<div class="row">
									<section class="col-md-6 col-xs-6">
										<div class="form-group" id="id_fk_pd">
						                  <label for="id_fk_pd">Fakultas</label>
						                  <select class="form-control select2 select2-remote-dt select2_fk id_fk_pd" style="width: 100%;" name="id_fk_pd">
						                  </select>
						                </div>
										<div class="form-group" id="kode_prodi">
											<label for="kode_prodi">Kode Program Studi</label>
											<input type="number" class="form-control kode_prodi" name="kode_prodi" placeholder="Masukkan kode program studi">
						                </div>
						                <div class="form-group" id="nama_prodi">
											<label for="nama_prodi">Nama Program Studi</label>
											<input type="text" class="form-control nama_prodi" name="nama_prodi" placeholder="Masukkan nama program studi">
						                </div>
						                <div class="form-group" id="nama_kprodi">
											<label for="nama_kprodi">Nama Ketua Prodi</label>
											<input type="text" class="form-control nama_kprodi" name="nama_kprodi" placeholder="Masukkan nama ketua prodi">
						                </div>
						                <div class="form-group" id="jenjang_prodi">
						                  <label for="jenjang_prodi">Jenjang</label>
						                  <select class="form-control select2 select2_jenjang jenjang_prodi" style="width: 100%;" name="jenjang_prodi">
						                  	<option value=""></option>
						                  	<option value="S1">S1</option>
						                  	<option value="S2">S2</option>
						                  	<option value="S3">S3</option>		                  	
						                  </select>
						                </div>							                
									</section>
					                <section class="col-md-6 col-xs-6">
					                	<div class="form-group" id="akreditasi_prodi">
						                  <label for="akreditasi_prodi">Akreditasi</label>
						                  <select class="form-control select2 select2_akreditasi_prodi akreditasi_prodi" style="width: 100%;" name="akreditasi_prodi">
						                  	<option value=""></option>
						                  	<option value="A">A</option>
						                  	<option value="B">B</option>
						                  	<option value="C">C</option>		                  	
						                  </select>
						                </div>
						                <div class="form-group" id="status_prodi">
						                  <label for="status_prodi">Status Prodi</label>
						                  <select class="form-control select2 select2_status_prodi status_prodi" style="width: 100%;" name="status_prodi">
						                  	<option value=""></option>
						                  	<option value="1">Aktif</option>
						                  	<option value="0">Tidak Aktif</option>							                  	
						                  </select>
						                </div>
						                <div class="form-group" id="sk_peny_prodi">
											<label for="sk_peny_prodi">SK Penyelenggaraan</label>
											<input type="text" class="form-control sk_peny_prodi" name="sk_peny_prodi" placeholder="Masukkan nomor SK">
						                </div>
						                <div class="form-group" id="tgl_sk_prodi">
											<label for="tgl_sk_prodi">Tanggal SK</label>
											<div class="input-group">
												<div class="input-group-prepend">
								                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
								                </div>
												<input type="text" class="form-control pull-right datepicker tgl_sk_prodi" name="tgl_sk_prodi" placeholder="Contoh: 1995-08-14">
											</div>
						                </div>
						                <div class="form-group" id="tgl_berdiri_prodi">
											<label for="tgl_berdiri_prodi">Tanggal Berdiri</label>
											<div class="input-group">
												<div class="input-group-prepend">
								                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
								                </div>
												<input type="text" class="form-control pull-right datepicker tgl_berdiri_prodi" name="tgl_berdiri_prodi" placeholder="Contoh: 1995-08-14">
											</div>
						                </div>
									</section>
				                </div>
				            </div>
		              	</div> 
		              	<!-- /.tab-pane -->
		              	<div class="tab-pane close-dt-tab" id="tab_kontak_prodi" role="tabpanel">
							<div class="row">
								<section class="col-md-6 col-xs-6">
									<div class="form-group">
										<label for="alamat_prodi">Alamat</label>
										<input type="text" class="form-control alamat_prodi" name="alamat_prodi" placeholder="Masukkan alamat prodi">
								    </div>
								    <div class="form-group">
										<label for="kode_pos_prodi">Kode POS</label>
										<input type="number" class="form-control kode_pos_prodi" name="kode_pos_prodi" placeholder="Contoh: 91921">
								    </div>
								    <div class="form-group">
										<label for="telpon_prodi">Telepon</label>
										<input type="number" class="form-control telpon_prodi" name="telpon_prodi" placeholder="Contoh: 91921">
								    </div>
								</section>
								<section class="col-md-6 col-xs-6">
									<div class="form-group">
										<label for="fax_prodi">FAX</label>
										<input type="text" class="form-control fax_prodi" name="fax_prodi" placeholder="Masukkan FAX prodi">
								    </div>
								    <div class="form-group">
										<label for="email_prodi">Email</label>
										<input type="email" class="form-control email_prodi" name="email_prodi" placeholder="Masukkan alamat email prodi">
								    </div>
								    <div class="form-group">
										<label for="website_prodi">Website</label>
										<input type="text" class="form-control website_prodi" name="website_prodi" placeholder="Masukkan alamat website prodi">
								    </div>
								</section>
							</div>								
						</div>				              
		            </div>
		        </div>	            	
	        </div>		        
	        <input type="hidden" id="data_prodi" name="data_prodi">
	        <input type="hidden" class="id_prodi" name="id_prodi">
	        <input type="hidden" class="kode_prodi" name="kd_pds">
        </form>
        <form action="" id="form-input-konsentrasi-pd" style="display: none;">
	        <div class="row">
            	<div class="col-md-6 col-xs-6">
	                <div class="form-group" id="id_pd_konst">
	                  	<label for="id_pd_konst">Program Studi</label>
		                <select class="form-control select2 select2-remote-dt select2_prodi id_pd_konst" style="width: 100%;" name="id_pd_konst"></select>
	                </div>
	            </div>	
                <div class="col-md-6 col-xs-6">
	                <div class="form-group" id="nm_konsentrasi">
	                  <label for="nm_konsentrasi">Konsentrasi</label>
	                  <input type="text" class="form-control nm_konsentrasi" name="nm_konsentrasi" placeholder="Masukkan nama konsentrasi">
	                </div>		                
				</div>
	        </div>
	        <input type="hidden" id="data" name="data_konsentrasi_pd">              		        
	        <input type="hidden" class="id_konst" name="id_konst">
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
