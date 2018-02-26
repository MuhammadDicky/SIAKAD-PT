<script type="text/javascript">
  var requireJS = [
    {
      'name': 'App Config JS',
      'link': "<?php echo get_configJS('js_views/config.js') ?>",
      'state': false
    },
    {
      'name': 'chartJS',
      'link': "<?php echo get_plugin('chartjs','js',' 2.7.1')?>",
      'state': true
    },
    {
      'name': 'Page JS',
      'link': "<?php echo get_configJS('js_views/mod_dashboard.js') ?>",
      'state': false
    }
  ];
  // loadJS(requireJS);
  requestJS(requireJS);
</script>
<div class="animated fadeIn">

  <div class="card-group mb-4">
    <div class="card bg-success text-white">
      <div class="card-body">
        <div class="h1 text-muted text-right mb-0" style="font-size: 50px">
          <?php if (@$tahun_akademik != '-'): ?>
          <i class="fa fa-calendar-check-o"></i>
          <?php endif ?>
          <?php if (@$tahun_akademik == '-'): ?>
          <i class="fa fa-calendar-minus-o"></i>
          <?php endif ?>
        </div>
        <div class="h1 mb-0"><?php echo @$tahun_akademik; ?></div>
        <small class="text-muted text-uppercase font-weight-bold">Tahun Akademik</small>
      </div>
      <div class="card-footer bg-success px-4 py-2">
        <a class="font-weight-bold font-xs btn-block text-muted" href="<?php echo set_url('data_master/data_thn_akademik'); ?>">
          Info Detail <i class="fa fa-angle-right float-right font-lg"></i>
        </a>
      </div>
    </div>
    <div class="card bg-danger text-white">
      <div class="card-body">
        <div class="h1 text-muted text-right mb-0" style="font-size: 50px">
          <i class="fa fa-user-secret"></i>
        </div>
        <div class="h1 mb-0"><?php echo @$count_ptk; ?></div>
        <small class="text-muted text-uppercase font-weight-bold">Jumlah Tenaga Pendidik</small>
      </div>
      <div class="card-footer bg-danger px-4 py-2">
        <a class="font-weight-bold font-xs btn-block text-muted" href="<?php echo set_url('data_akademik/data_ptk'); ?>">
          Info Detail <i class="fa fa-angle-right float-right font-lg"></i>
        </a>
      </div>
    </div>
    <div class="card bg-warning text-white">
      <div class="card-body">
        <div class="h1 text-muted text-right mb-0" style="font-size: 50px">
          <i class="fa fa-users"></i>
        </div>
        <div class="h1 mb-0"><?php echo @$count_mhs; ?></div>
        <small class="text-muted text-uppercase font-weight-bold">Jumlah Mahasiswa</small>
      </div>
      <div class="card-footer bg-warning px-4 py-2">
        <a class="font-weight-bold font-xs btn-block text-muted" href="<?php echo set_url('data_akademik/data_mahasiswa'); ?>">
          Info Detail <i class="fa fa-angle-right float-right font-lg"></i>
        </a>
      </div>
    </div>
    <div class="card bg-primary text-white">
      <div class="card-body">
        <div class="h1 text-muted text-right mb-0" style="font-size: 50px">
          <i class="fa fa-graduation-cap"></i>
        </div>
        <div class="h1 mb-0"><?php echo @$count_alumni; ?></div>
        <small class="text-muted text-uppercase font-weight-bold">Jumlah Alumni</small>
      </div>
      <div class="card-footer bg-primary px-4 py-2">
        <a class="font-weight-bold font-xs btn-block text-muted" href="<?php echo set_url('data_akademik/data_alumni'); ?>">
          Info Detail <i class="fa fa-angle-right float-right font-lg"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card card-accent-warning card-border-warning grafik-mhs">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> Data Statistik Mahasiswa
          <div class="card-actions">
            <a href="#" class="btn" id="refresh-statik-mhs" title="Refresh Data Statistik Mahasiswa"><i class="fa fa-refresh"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="data-container">
                <div class="row">
                  <div class="col-md-8 col-sm-8">
                    <div class="pad">
                      <p class="text-center"><strong>Data Statistik Mahasiswa Berdasarkan Program Studi</strong></p>
                      <div class="chart-container">
                        <canvas id="barchart-mhs-pd" style="height: 330px; width: 510px;"></canvas>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4 col-sm-4">
                      <div class="pad content-responsive detail-jml-mhs">
                      </div>
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <div class="data-empty-container" style="display: none;padding: 10px"></div>
            </div>
          </div>
          <hr class="mt-0">
          <div class="row grafik-mhs-dt">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="card border-warning">
                <div class="card-header bg-warning text-white">
                  <i class="fa fa-bar-chart"></i> Berdasarkan Tahun Angkatan
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <p class="text-center text-black"><strong>Data Statistik Mahasiswa Berdasarkan 4 Tahun Angkatan Terakhir</strong></p>
                      <div class="chart">
                          <canvas id="barchart-mhs-thn" height="137"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mt-0">
                <div class="row">
                  <div class="col-md-12">
                    <ul class="horizontal-bars type-2 daftar-thn content-responsive style-3 ml-3 mr-3 mb-3 mt-0"">
                      <li class="text-center"><a>Memproses Data...</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="card bg-warning border-warning text-white">
                <div class="card-header">
                  <i class="fa fa-pie-chart"></i> Grafik Data Mahasiswa
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <div class="chart-container-pie-mhs" style="height: 255px;">
                          <canvas id="pieChart-data-mhs" ></canvas>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="list-group daftar-pd">
                      <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                        <center>Memproses Data...</center>
                      </li>
                    </ul>
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
    <section class="col-md-4 col-sm-12">
      <div class="card bg-success text-white grafik-ptk">
        <div class="card-header">
          <i class="fa fa-pie-chart"></i> Grafik Data Tenaga Pendidik
          <div class="card-actions">
            <a href="#" class="btn text-white" id="refresh-statik-ptk" title="Refresh Data StatiX   stik Mahasiswa"><i class="fa fa-refresh"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="chart-responsive">
                  <canvas id="pieChart-data-ptk" height="180"></canvas>
                </div>
            </div>
          </div>
          <div class="data-empty-container" style="display: none;padding: 10px"></div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <ul class="list-group daftar-pd">
              <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                <center>Memproses Data...</center>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="col-md-8">
      <div class="card card-accent-primary card-border-primary box-grafik-pengguna">
        <div class="card-header">
          <i class="fa fa-pie-chart"></i> Grafik Data Pengguna
          <div class="card-actions">
            <a href="#" class="btn" id="refresh-statik-pengguna" title="Refresh Grafik Data Pengguna"><i class="fa fa-refresh"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="card grafik-data-pengguna">
                <div class="card-header bg-primary text-white">Data Jumlah Pengguna</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-container-pie-pengguna" style="height: 140px;">
                        <canvas id="pieChart-data-pengguna"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mt-0">
                <div class="row">
                  <div class="col-md-12">
                    <ul class="horizontal-bars type-2 content-responsive style-3 ml-3 mr-3 mb-3 mt-0"">
                      <li class="progress-mhs-u">
                        <span class="title">Mahasiswa</span>
                        <span class="value"></span>
                        <div class="bars">
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-pengguna-siswa" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #f39c12;"></div>
                          </div>
                        </div>
                      </li>
                      <li class="progress-ptk-u">
                        <span class="title">Tenaga Pendidik</span>
                        <span class="value"></span>
                        <div class="bars">
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-pengguna-guru" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #00c0ef"></div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="card grafik-status-pengguna">
                <div class="card-header bg-primary text-white">Data Pengguna Aktif & Nonaktif</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-container-pie-status-pengguna" style="height: 140px;">
                        <canvas id="pieChart-data-pengguna-status"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mt-0">
                <div class="row">
                  <div class="col-md-12">
                    <ul class="horizontal-bars type-2 content-responsive style-3 ml-3 mr-3 mb-3 mt-0"">
                      <li class="progress-aktif-u">
                        <span class="title">Pengguna Aktif</span>
                        <span class="value"></span>
                        <div class="bars">
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-pengguna-aktif" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #00a65a;"></div>
                          </div>
                        </div>
                      </li>
                      <li class="progress-non-u">
                        <span class="title">Pengguna Nonaktif</span>
                        <span class="value"></span>
                        <div class="bars">
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-pengguna-nonaktif" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #dd4b39"></div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <table class="table table-striped no-margin tbl-user-last-online">
                <thead>
                <tr>
                  <th colspan="4" class="text-center"><li class="fa fa-user-circle"></li> Daftar pengguna yang terakhir kali login</th>
                </tr>
                <tr>
                  <th>Username</th>
                  <th class="text-center">Level Akses</th>
                  <th class="text-center">Terakhir Login</th>
                  <th class="text-center">Detail Pengguna</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                      <td colspan="4" class="text-center">Memproses data</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <div class="data-empty-container" style="display: none;"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
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

        <div id="rincian-mhs" style="display: none;">
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#detail-mhs" role="tab" aria-controls="detail-mhs"><i class="fa fa-user"></i> Data Mahasiswa</a>
                </li>
              </ul>
              <div class="tab-content">

                <div class="tab-pane active" id="detail-mhs" role="tabpanel">
                  <div id="container-detail-user-mhs" class="tab-overflow-container">
                    <div class="row">
                      <section class="col-md-6 col-xs-6">
                        <dl>
                          <dt>NIM</dt>
                          <dd id="detail-nisn"></dd>

                          <dt>Nama</dt>
                          <dd id="detail-nama"></dd>

                          <dt>Program Studi</dt>
                          <dd id="detail-nama_prodi"></dd>

                          <dt>Tahun Angkatan</dt>
                          <dd id="detail-tahun_angkatan"></dd>

                          <dt>Jenis Kelamin</dt>
                          <dd id="detail-jk"></dd>

                          <dt>Tempat Lahir</dt>
                          <dd id="detail-tmp_lhr"></dd>

                          <dt>Tanggal Lahir</dt>
                          <dd id="detail-tgl_lhr"></dd>

                          <dt>NIK</dt>
                          <dd id="detail-nik"></dd>

                          <dt>Agama</dt>
                          <dd id="detail-agama"></dd>

                          <dt>Alamat</dt>
                          <dd id="detail-alamat"></dd>
                        </dl>
                      </section>
                      <section class="col-md-6 col-xs-6">
                        <dl>
                          <dt>RT/RW</dt>
                          <dd id="detail-rt-rw"><font id="detail-rt"></font>/<font id="detail-rw"></font></dd>

                          <dt>Dusun</dt>
                          <dd id="detail-dusun"></dd>

                          <dt>Kelurahan</dt>
                          <dd id="detail-kelurahan"></dd>

                          <dt>Kecamatan</dt>
                          <dd id="detail-kecamatan"></dd>

                          <dt>Kode Pos</dt>
                          <dd id="detail-kode_pos"></dd>

                          <dt>Jenis Tinggal</dt>
                          <dd id="detail-jns_tinggal"></dd>

                          <dt>Alat Transportasi</dt>
                          <dd id="detail-alt_trans"></dd>

                          <dt>No. Telepon</dt>
                          <dd id="detail-tlp"></dd>

                          <dt>No. HP</dt>
                          <dd id="detail-hp"></dd>

                          <dt>Email</dt>
                          <dd id="detail-email"></dd>
                        </dl>
                      </section>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div id="rincian-ptk" style="display: none;">
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#detail-ptk" role="tab" aria-controls="detail-mhs"><i class="fa fa-user-secret"></i> Data Tenaga Pendidik</a>
                </li>
              </ul>
              <div class="tab-content">

                <div class="tab-pane active" id="detail-ptk" role="tabpanel">
                  <div id="container-detail-user-ptk" class="tab-overflow-container">
                    <div class="row">
                      <section class="col-md-6 col-xs-6">
                        <dl>
                          <dt>Nama</dt>
                          <dd id="detail-nama_ptk"></dd>

                          <dt>NIDN</dt>
                          <dd id="detail-nuptk"></dd>

                          <dt>NIP</dt>
                          <dd id="detail-nip"></dd>

                          <dt>Program Studi</dt>
                          <dd id="detail-nama_prodi"></dd>

                          <dt>Jenis Kelamin</dt>
                          <dd id="detail-jk_ptk"></dd>
                        </dl>
                      </section>
                      <section class="col-md-6 col-xs-6">
                        <dl>
                          <dt>Tempat Lahir</dt>
                          <dd id="detail-tmp_lhr_ptk"></dd>

                          <dt>Tanggal Lahir</dt>
                          <dd id="detail-tgl_lhr_ptk"></dd>

                          <dt>Status Ikatan Kerja</dt>
                          <dd id="detail-status_ptk"></dd>

                          <dt>Status Keaktifan</dt>
                          <dd id="detail-status_aktif_ptk"></dd>

                          <dt>Pendidikan Tertinggi</dt>
                          <dd id="detail-jenjang"></dd>
                        </dl>
                      </section>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

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
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
