<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_akademik extends Backend_Controller {

	protected $id_mhs;
	protected $id_mk;
	protected $mk_pd;
	protected $konsentrasi;
	protected $konst_add;
	protected $hari;
	protected $id_ptk;
	protected $jadwal_field = array();
	protected $jam_awal;

	public function __construct(){
		parent::__construct();
		$this->site->login_status_check();
	}

	public function index(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_mahasiswa(){
		/*$this->page_on_repair('Data Mahasiswa','fa-users');*/
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_ptk(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_kurikulum(){
		$this->page_soon('Data Kurikulum','fa-book');
	}

	public function data_mata_kuliah(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_jadwal_kuliah(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_nilai_mhs(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_alumni_do(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function action($param){
		global $Config;
		$result = array();
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$post = $this->input->post(NULL, TRUE);
			if ($param == 'tambah') {
				if (isset($post['data_mhs'])) {
					$rules = $this->mahasiswa_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$nama_mhs = strtoupper($post['nama']);
						$tmp_lhr = ucwords($post['tmp_lhr']);
						$alamat = ucwords($post['alamat']);
						$dusun = ucwords($post['dusun']);
						$kelurahan = ucwords($post['kelurahan']);
						$kecamatan = ucwords($post['kecamatan']);
						$email = strtolower($post['email']);
						$data_mhs = array(
							'nisn' => $post['nisn'],
							'nama' => $nama_mhs,
							'thn_angkatan' => $post['thn_angkatan'],
							'id_pd_mhs' => $post['id_pd_mhs'],
							'jk' => $post['jk'],
							'tmp_lhr' => $tmp_lhr,
							'tgl_lhr' => $post['tgl_lhr'],
							'nik' => $post['nik'],
							'agama' => $post['agama'],
							'alamat' => $alamat,
							'rt' => $post['rt'],
							'rw' => $post['rw'],
							'dusun' => $dusun,
							'kelurahan' => $kelurahan,
							'kecamatan' => $kecamatan,
							'kode_pos' => $post['kode_pos'],
							'jns_tinggal' => $post['jns_tinggal'],
							'alt_trans' => $post['alt_trans'],
							'tlp' => $post['tlp'],
							'hp' => $post['hp'],
							'email' => $email,
							);
						$save_data_mhs = $this->mahasiswa_model->insert($data_mhs);
						if ($save_data_mhs) {
							$nm_ayah = strtoupper($post['nm_ayah']);
							$nm_ibu = strtoupper($post['nm_ibu']);
							$nm_wali = strtoupper($post['nm_wali']);
							$data_ortu_wali = array(
								'id_mhs_ortu' => $save_data_mhs,
								'nm_ayah' => $nm_ayah,
								'thn_lhr_ayah' => $post['thn_lhr_ayah'],
								'pendi_ayah' => $post['pendi_ayah'],
								'pekerjaan_ayah' => $post['pekerjaan_ayah'],
								'penghasilan_ayah' => $post['penghasilan_ayah'],
								'nik_ayah' => $post['nik_ayah'],
								'nm_ibu' => $nm_ibu,
								'thn_lhr_ibu' => $post['thn_lhr_ibu'],
								'pendi_ibu' => $post['pendi_ibu'],
								'pekerjaan_ibu' => $post['pekerjaan_ibu'],
								'penghasilan_ibu' => $post['penghasilan_ibu'],
								'nik_ibu' => $post['nik_ibu'],
								'nm_wali' => $nm_wali,
								'thn_lhr_wali' => $post['thn_lhr_wali'],
								'pendi_wali' => $post['pendi_wali'],
								'pekerjaan_wali' => $post['pekerjaan_wali'],
								'penghasilan_wali' => $post['penghasilan_wali'],
								'nik_wali' => $post['nik_wali'],
								);
							$save_data_ortu = $this->ortu_model->insert($data_ortu_wali);
							$password = $this->user_model->password_generate();
							$encrypt_password = bCrypt($password,12);
							$data_user = array(
								'id_user_detail' => $save_data_mhs,
								'password' => $encrypt_password,
								'level_akses' => 'mhs',
								'active_status' => 1,
								);
							$save_data_user = $this->user_model->insert($data_user);

							if ($save_data_user && $save_data_ortu) {
								$data = 'data_mhs';
								$result = array(
									'status' => 'success',
									'data' => $data,
									'in' => $save_data_mhs
									);
							}
							else{
								$result = array('status' => 'failed_db');
							}
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_ptk'])) {
					$rules = $this->ptk_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$nama_ptk = ucwords(strtolower($post['nama_ptk']));
						$tmp_lhr = ucwords($post['tmp_lhr_ptk']);
						$data_ptk = array(
							'nama_ptk' => $nama_ptk,
							'nuptk' => $post['nuptk'],
							'nip' => $post['nip'],
							'jk_ptk' => $post['jk_ptk'],
							'tmp_lhr_ptk' => $tmp_lhr,
							'tgl_lhr_ptk' => $post['tgl_lhr_ptk'],
							'status_ptk' => $post['status_ptk'],
							'status_aktif_ptk' =>$post['status_aktif_ptk'],
							'jenjang' => $post['jenjang'],
							'jurusan_prodi' => $post['jurusan_prodi'],
							'nik_ptk' => $post['nik_ptk'],
							'agama_ptk' => $post['agama_ptk'],
							'alamat_ptk' => ucwords($post['alamat_ptk']),
							'rt_ptk' => $post['rt_ptk'],
							'rw_ptk' => $post['rw_ptk'],
							'dusun_ptk' => ucwords($post['dusun_ptk']),
							'kelurahan_ptk' => ucwords($post['kelurahan_ptk']),
							'kecamatan_ptk' => ucwords($post['kecamatan_ptk']),
							'kode_pos_ptk' => $post['kode_pos_ptk'],
							'tlp_ptk' => $post['tlp_ptk'],
							'hp_ptk' => $post['hp_ptk'],
							'email_ptk' => $post['email_ptk'],
							);
						$save_data_ptk = $this->ptk_model->insert($data_ptk);
						if ($save_data_ptk) {
							$password = $this->user_model->password_generate();
							$encrypt_password = bCrypt($password,12);
							if (!empty($post['nuptk'])) {
								$data_user = array(
									'id_user_detail' => $save_data_ptk,
									'password' => $encrypt_password,
									'level_akses' => 'ptk',
									'active_status' => 1,
								);
							}
							else{
								for ($i=0; $i <= 1; $i++) {
									$user = rand(10000000000000,99999999999999).$save_data_ptk;
									$check_user = array('username' => $user);
									$total_rows = $this->user_model->count($check_user);
									if ($total_rows > 0) {
										$i = 0;
									}
									else{
										$i = 1;
									}
								}
								$data_user = array(
									'id_user_detail' => $save_data_ptk,
									'password' => $encrypt_password,
									'level_akses' => 'ptk',
									'active_status' => 1,
								);
							}
							$save_data_user = $this->user_model->insert($data_user);
							if ($save_data_user) {
								$data = 'data_ptk';
								$result = array(
									'status' => 'success',
									'data' => $data,
									'in'=>$save_data_ptk,
									);
							}
							else{
								$result = array('status' => 'failed_db');
							}
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_studi_ptk'])) {
					$rules = $this->ptk_studi_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$in_ptk = $post['id_ptk_studi'];
						$data_studi = array(
							'id_ptk_studi' => $in_ptk,
							'nama_pt_studi' => ucwords($post['nama_pt_studi']),
							'studi_ptk' => ucwords($post['studi_ptk']),
							'jenjang_studi_ptk' => $post['jenjang_studi_ptk'],
							'gelar_ak_ptk' => $post['gelar_ak_ptk'],
							'tgl_ijazah_ptk' => $post['tgl_ijazah_ptk'],
							);
						$save_data_studi = $this->ptk_studi_model->insert($data_studi);
						if ($save_data_studi) {
							$record_studi = array();
							/*if (isset($post['ptk_detail']) && $in_ptk == $post['ptk_detail']) {
								$data_studi = $this->ptk_studi_model->get_detail_data('get',NULL,NULL,array('id_ptk_studi' => $in_ptk),NULL,array('id_studi AS in_studi','nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk'),NULL,'tgl_ijazah_ptk ASC');
								$record_studi = array();
								foreach ($data_studi as $key) {
									$arr = array('tgl_ijazah_ptk' => date_convert($key->tgl_ijazah_ptk));
									$record_studi[] = array_merge((array)$key,$arr);
								}
							}*/
							$data = 'data_studi_ptk';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in_ptk' => $in_ptk,
								'studi_ptk' => $record_studi
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_penelitian_ptk'])) {
					$rules = $this->ptk_penelitian_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$in_ptk = $post['id_ptk_rsch'];
						$data_penelitian = array(
							'id_ptk_rsch' => $in_ptk,
							'judul_penelitian' => ucwords($post['judul_penelitian']),
							'bidang_ilmu' => ucwords($post['bidang_ilmu']),
							'lembaga' => $post['lembaga'],
							);
						$save_data_penelitian = $this->ptk_penelitian_model->insert($data_penelitian);
						if ($save_data_penelitian) {
							$record_penelitian = array();
							/*if (isset($post['ptk_detail']) && $in_ptk == $post['ptk_detail']) {
								$record_penelitian = $this->ptk_penelitian_model->get_detail_data('get',NULL,NULL,array('id_ptk_rsch' => $in_ptk),NULL,array('id_penelitian_ptk AS in_research','judul_penelitian','bidang_ilmu','lembaga'));
							}*/
							$data = 'data_penelitian_ptk';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in_ptk' => $in_ptk,
								'penelitian_ptk' => $record_penelitian
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_mk'])) {
					if (isset($post['id_pd_mk'])) {
						$this->mk_pd = $post['id_pd_mk'];
					}

					if (isset($post['jenis_jdl']) && $post['jenis_jdl'] != '') {
						$this->konst_add = $post['jenis_jdl'];
						$jenis_jdl = $post['jenis_jdl'];
					}
					else{
						$this->konst_add = 0;
						$jenis_jdl = 0;
					}
					$rules = $this->mata_kuliah_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data_mk = array(
							'kode_mk' => strtoupper($post['kode_mk']),
							'nama_mk' => ucwords($post['nama_mk']),
							'id_pd_mk' => $post['id_pd_mk'],
							'jml_sks' => $post['jml_sks'],
							'jenis_jdl' => $jenis_jdl,
							);
						$save_data_mk = $this->mata_kuliah_model->insert($data_mk);
						if ($save_data_mk) {
							$data = 'data_mata_kuliah';
							$result = array(
								'status' => 'success',
								'data' => $data
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_jadwal_kuliah'])) {
					$this->jam_awal = $post['jam_mulai_jdl'];
					$rules = $this->jadwal_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data_jadwal = array(
							'id_mk_jdl' => $post['id_mk_jdl'],
							'id_ptk_jdl' => $post['id_ptk_jdl'],
							'id_thn_ak_jdl' => $post['id_thn_ak_jdl'],
							'hari_jdl' => $post['hari_jdl'],
							'jam_mulai_jdl' => $post['jam_mulai_jdl'],
							'jam_akhir_jdl' => $post['jam_akhir_jdl'],
							'semester' => $post['semester'],
							'kelas' => $post['kelas'],
							'ruang' => strtoupper($post['ruang']),
							);
						$save_data_jadwal = $this->jadwal_model->insert($data_jadwal);
						if ($save_data_jadwal) {
							$thn= $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','prodi_mk','ptk'),NULL,array('id_thn_ak_jdl' => $post['id_thn_ak_jdl'],'id_mk_jdl' => $post['id_mk_jdl']),NULL,array('id_thn_ak_jdl AS thn_ajaran_jdl','id_pd_mk'),array('thn_ajaran_jdl','id_pd_mk'));
							$data = 'data_jadwal';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'thn' => $thn,
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_mhs_kls'])) {
					if (isset($post['mhs-kelas'])) {
						$status_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $post['kelas_mhs']),TRUE,array('status_jdl'));
						$status = @$status_kelas->status_jdl;
						if ($status == 1) {
							foreach ($post['mhs-kelas'] as $key => $value) {
								$count = $this->kelas_model->count(array('id_jdl_kls' => $post['kelas_mhs'], 'id_mhs_kls' => $value));
								if ($count == 0) {
									$batch[] = array(
										'id_jdl_kls' => $post['kelas_mhs'],
										'id_mhs_kls' => $value,
										'status_mhs_kls' => 1
										);
								}
							}
							if (isset($batch)) {
								$insert_mhs = $this->kelas_model->insert($batch,TRUE);
								if ($insert_mhs) {
									$select_daftar_mhs = array('id_kelas','id_jdl_kls','id AS in_mhs','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
									$data_mhs = $this->kelas_model->get_detail_data('get',array('mahasiswa','thn_angkatan'),NULL,array('id_jdl_kls' => $post['kelas_mhs']),NULL,$select_daftar_mhs);
									$result = array(
										'status' => 'success',
										'data' => 'data_mhs_kls',
										'kelas' => $post['kelas_mhs'],
										/*'record_mhs' => $data_mhs,*/
										);
								}
								else{
									$result = array('status' => 'failed_db');
								}
							}
							else{
								$error = array('mhs-kelas' => 'Mahasiswa yang anda masukkan dalam kelas ini sudah ada');
								$result = array('status' => 'failed', 'errors' => $error);
							}
						}
						else{
							$error = array('mhs-kelas' => 'Anda tidak bisa menambah mahasiswa dikelas ini karena tahun akademik kelas ini tidak diterapkan');
							$result = array('status' => 'failed', 'errors' => $error);
						}
					}
					else{
						$error = array('mhs-kelas' => 'Silahkan pilih mahasiswa yang ingin anda masukkan kedalam kelas ini');
						$result = array('status' => 'failed', 'errors' => $error);
					}
				}
				elseif (isset($post['data_alumni'])) {
					if (isset($post['id']) && $post['id'] != '') {
						$rules = $this->alumni_model->rules;
						$this->form_validation->set_rules($rules);

						if ($this->form_validation->run() == TRUE) {
							foreach ($post['id'] as $key) {
								$id_vars = explode(' ',$key);
								if (@$id_vars[0] != NULL) {
									$id_mhs_check[] = $id_vars[0];
								}
								else{
									$id_mhs_check[] = $key;
								}
							}
							$act = array(
								'in' => array(
									'id' => @$id_mhs_check,
									),
								);
							$data = $this->mahasiswa_model->get_detail_data('get',array('alumni','mhs_do'),$act,NULL,FALSE,array('id','id_mhs_alni','id_mhs_DO'));
							$alumni_dt = 0;
							$mhs_do_dt = 0;
							foreach ($data as $key) {
								if ($key->id_mhs_alni != NULL) {
									$alumni_dt++;
								}
								if ($key->id_mhs_DO != NULL) {
									$mhs_do_dt++;
								}
								if ($key->id_mhs_alni == NULL && $key->id_mhs_DO == NULL) {
									$batch[] = array(
										'id_mhs_alni' => $key->id,
										'tgl_yudisium' => $post['tgl_yudisium'],
										'tgl_lulus' => $post['tgl_lulus']
										);
								}
							}
							$count_check = count($data);
							if ($count_check == 0) {
								$error = array('alumni' => 'Mahasiswa yang anda pilih tidak ditemukan didalam database atau sudah terhapus!');
								$result = array('status' => 'failed', 'errors' => $error);
							}
							else{
								if (isset($batch)) {
									$insert_alumni = $this->alumni_model->insert($batch,TRUE);
									if ($insert_alumni) {
										$result = array(
											'status' => 'success',
											'data' => 'data_alumni'
											);
									}
									else{
										$result = array('status' => 'failed_db');
									}
								}
								else{
									if ($alumni_dt > 0 && $mhs_do_dt > 0) {
										$error = array('alumni' => 'Mahasiswa yang anda pilih sudah ada dalam data alumni dan mahasiswa drop out');
									}
									elseif ($alumni_dt > 0) {
										$error = array('alumni' => 'Mahasiswa yang anda pilih sudah ada dalam data mahasiswa alumni');
									}
									elseif ($mhs_do_dt > 0) {
										$error = array('alumni' => 'Mahasiswa yang anda pilih sudah ada dalam data mahasiswa drop out');
									}
									$result = array('status' => 'failed', 'errors' => $error);
								}
							}
						}
						else{
							$result = array(
								'status' => 'failed',
								'errors'=> $this->form_validation->error_array()
								);
						}
					}
					else{
						$error = array('alumni' => 'Silahkan pilih mahasiswa yang ingin anda masukkan kedalam data alumni');
						if ($post['tgl_yudisium'] == '') {
							$error = array_merge($error,array('tgl_yudisium' => 'Tolong masukkan tanggal yudisium'));
						}
						if ($post['tgl_lulus'] == '') {
							$error = array_merge($error,array('tgl_lulus' => 'Tolong masukkan tanggal kelulusan'));
						}
						$result = array('status' => 'failed', 'errors' => $error);
					}
				}
				elseif (isset($post['data_mhs_do'])) {
					if (isset($post['mhs-data']) && $post['mhs-data'] != '') {
						$rules = $this->mahasiswa_do_model->rules;
						$this->form_validation->set_rules($rules);

						if ($this->form_validation->run() == TRUE) {
							foreach ($post['mhs-data'] as $key) {
								$id_vars = explode(' ',$key);
								if (@$id_vars[0] != NULL) {
									$id_mhs_check[] = $id_vars[0];
								}
								else{
									$id_mhs_check[] = $key;
								}
							}
							$act = array(
								'in' => array(
									'id' => @$id_mhs_check,
									),
								);
							$data = $this->mahasiswa_model->get_detail_data('get',array('alumni','mhs_do'),$act,NULL,FALSE,array('id','id_mhs_alni','id_mhs_DO'));
							$alumni_dt = 0;
							$mhs_do_dt = 0;
							foreach ($data as $key) {
								if ($key->id_mhs_alni != NULL) {
									$alumni_dt++;
								}
								if ($key->id_mhs_DO != NULL) {
									$mhs_do_dt++;
								}
								if ($key->id_mhs_alni == NULL && $key->id_mhs_DO == NULL) {
									$batch[] = array(
										'id_mhs_DO' => $key->id,
										'tgl_drop_out' => $post['tgl_drop_out'],
										'drop_out_reason' => $post['drop_out_reason']
										);
									$user_batch[] = array(
										'id_user_detail' => $key->id,
										'active_status' => 0
									);
								}
							}

							$count_check = count($data);
							if ($count_check == 0) {
								$error = array('mhs-do' => 'Mahasiswa yang anda pilih tidak ditemukan didalam database atau sudah terhapus!');
								$result = array('status' => 'failed', 'errors' => $error);
							}
							else{
								if (isset($batch)) {
									$insert_mhs_do = $this->mahasiswa_do_model->insert($batch,TRUE);
									if ($insert_mhs_do) {
										$this->db->where(array('level_akses' => 'mhs'));
										$update_status_u = $this->user_model->update($user_batch,'id_user_detail',TRUE);
										$result = array(
											'status' => 'success',
											'data' => 'data_mhs_do',
											);
									}
									else{
										$result = array('status' => 'failed_db');
									}
								}
								else{
									if ($alumni_dt > 0 && $mhs_do_dt > 0) {
										$error = array('mhs-do' => 'Mahasiswa yang anda pilih sudah ada dalam data alumni dan mahasiswa drop out');
									}
									elseif ($alumni_dt > 0) {
										$error = array('mhs-do' => 'Mahasiswa yang anda pilih sudah ada dalam data mahasiswa alumni');
									}
									elseif ($mhs_do_dt > 0) {
										$error = array('mhs-do' => 'Mahasiswa yang anda pilih sudah ada dalam data mahasiswa drop out');
									}
									$result = array('status' => 'failed', 'errors' => $error);
								}
							}
						}
						else{
							$result = array(
								'status' => 'failed',
								'errors'=> $this->form_validation->error_array()
								);
						}
					}
					else{
						$error = array('mhs-do' => 'Silahkan pilih mahasiswa yang ingin anda masukkan kedalam data mahasiswa yang drop out');
						if ($post['tgl_drop_out'] == '') {
							$error = array_merge($error,array('tgl_drop_out' => 'Tolong masukkan tanggal drop out'));
						}
						$result = array('status' => 'failed', 'errors' => $error);
					}
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'ambil') {
				if ($post['data']=='data_mhs') {
					$id = array('id' => $post['id']);
					$total_rows = $this->mahasiswa_model->count($id);

					if ($total_rows > 0) {
						$record_mhs = array();
						if (!isset($post['ac'])) {
							$record = $this->mahasiswa_model->get_detail_data('get',array('prodi_mhs','user','ortu','alumni','mhs_do','thn_angkatan'),NULL,array('id' => $post['id'], 'level_akses' => 'mhs'),FALSE,list_fields(array('mahasiswa','ortu_wali'),array('nama_prodi','jenjang_prodi','tahun_angkatan','tgl_masuk_angkatan','id_user','last_online','active_status','tgl_lulus','tgl_drop_out')));
							$this->load->helper('file');
							foreach ($record as $key) {
								if ($key->tgl_drop_out == NULL && $key->tgl_lulus == NULL) {
									$status_mhs = 'Mahasiswa';
								}
								elseif ($key->tgl_drop_out != NULL && $key->tgl_lulus == NULL) {
									$status_mhs = 'Drop Out';
								}
								elseif ($key->tgl_drop_out == NULL && $key->tgl_lulus != NULL) {
									$status_mhs = 'Alumni';
								}

								$photo = photo_u();
								if ($key->photo_mhs != '') {
									$check_file = get_file_info('uploads/mhs-photo/'.$key->photo_mhs);
									if ($check_file != FALSE) {
										$check_file = TRUE;
										$photo = photo_u('mhs',$key->photo_mhs.'?n_img='.rand_val(20));
									}
									else{
										$check_file = FALSE;
									}
								}
								$arr = array(
									'tgl_masuk_angkatan' => date_convert($key->tgl_masuk_angkatan),
									'tgl_lulus' => date_convert($key->tgl_lulus),
									'tgl_drop_out' => date_convert($key->tgl_drop_out),
									'id_user' => md5($key->id_user),
									'in_user' => md5($key->id),
									'tgl_lhr' => date_convert($key->tgl_lhr),
									'photo_mhs' => $photo,
									'check_file' => @$check_file,
									'status_mhs' => $status_mhs
									);
								$record_mhs[] = array_merge((array)$key,$arr);
							}
						}
						else{
							$record = $this->mahasiswa_model->get_detail_data('get',array('prodi_mhs','ortu','thn_angkatan'),NULL,$id,FALSE,list_fields(array('mahasiswa','ortu_wali'),array('nama_prodi','jenjang_prodi','tahun_angkatan')));
							$this->load->helper('file');
							foreach ($record as $key) {
								$photo = photo_u();
								if ($key->photo_mhs != '') {
									$check_file = get_file_info('uploads/mhs-photo/'.$key->photo_mhs);
									if ($check_file != FALSE) {
										$check_file = TRUE;
										$photo = photo_u('mhs',$key->photo_mhs.'?n_img='.rand_val(20));
									}
									else{
										$check_file = FALSE;
									}
								}
								$arr = array(
									'file_name' => $key->photo_mhs,
									'photo_mhs' => $photo,
									'check_file' => @$check_file
									);
								$record_mhs[] = array_merge((array)$key,$arr);
							}
						}
						$result = array(
								'total_rows' => $total_rows,
								'record_mhs' => $record_mhs,
								);
					}
					else{
						$result = array(
								'total_rows' => $total_rows,
								'message' => 'Data mahasiswa yang anda pilih tidak ditemukan / data telah dihapus'
								);
					}
				}
				elseif ($post['data']=='data_ptk') {
					$id = array('id_ptk' => $post['id_ptk']);
					$total_rows = $this->ptk_model->count($id);

					if ($total_rows > 0) {
						if (!isset($post['ac'])) {
							$data = $this->ptk_model->get_detail_data('get',array('prodi_ptk','user'),NULL,array('id_ptk' => $post['id_ptk'], 'level_akses' => 'ptk'),FALSE,list_fields(array('ptk'),array('nama_prodi','jenjang_prodi','id_user','last_online','active_status')));
							$record = array();
							$this->load->helper('file');
							foreach ($data as $key) {
								$photo = photo_u();
								if ($key->photo_ptk != '') {
									$check_file = get_file_info('uploads/ptk-photo/'.$key->photo_ptk);
									if ($check_file != FALSE) {
										$check_file = TRUE;
										$photo = photo_u('ptk',$key->photo_ptk.'?n_img='.rand_val(20));
									}
									else{
										$check_file = FALSE;
									}
								}
								$arr = array(
									'id_user' => md5($key->id_user),
									'in_user' => md5($key->id_ptk),
									'tgl_lhr_ptk' => date_convert($key->tgl_lhr_ptk),
									'agama_ptk' => select_conv_value($key->agama_ptk,'ptk','agama_ptk'),
									'status_ptk' => select_conv_value($key->status_ptk,'ptk','status_ptk'),
									'status_aktif_ptk' => select_conv_value($key->status_aktif_ptk,'ptk','status_aktif_ptk'),
									'jenjang' => select_conv_value($key->jenjang,'ptk','jenjang'),
									'photo_ptk' => $photo,
									'check_file' => @$check_file
									);
								$record[] = array_merge((array)$key,$arr);
							}
						}
						else{
							$select = array('id_prodi','nama_prodi','jenjang_prodi');
							$data = $this->ptk_model->get_detail_data('get',array('prodi_ptk'),NULL,array('id_ptk' => $post['id_ptk']),FALSE,list_fields(array('ptk'),$select));
							$record = array();
							$this->load->helper('file');
							foreach ($data as $key) {
								$photo = photo_u();
								if ($key->photo_ptk != '') {
									$check_file = get_file_info('uploads/ptk-photo/'.$key->photo_ptk);
									if ($check_file != FALSE) {
										$check_file = TRUE;
										$photo = photo_u('ptk',$key->photo_ptk.'?n_img='.rand_val(20));
									}
									else{
										$check_file = FALSE;
									}
								}
								$arr = array(
									'file_name' => $key->photo_ptk,
									'photo_ptk' => $photo,
									'check_file' => @$check_file
									);
								$record[] = array_merge((array)$key,$arr);
							}
						}
						$result = array(
								'total_rows' => $total_rows,
								'record_ptk' => $record,
								);
					}
					else{
						$result = array(
								'total_rows' => $total_rows,
								'message' => 'Data tenaga pendidik yang anda pilih tidak ditemukan / data telah dihapus'
								);
					}
				}
				elseif ($post['data']=='data_studi_ptk') {
					$id = array('id_studi' => $post['id_studi']);
					$record_studi = $this->ptk_studi_model->get_detail_data('get',array('ptk'),NULL,$id,FALSE,array('id_studi','id_ptk_studi','nuptk AS nidn','nama_ptk AS nama','nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk'));
					$total_rows = count($record_studi);
					if ($total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'studi_ptk' => $record_studi,
							);
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data studi tenaga pendidik yang anda pilih tidak ditemukan / data telah dihapus'
							);
					}
				}
				elseif ($post['data']=='data_penelitian_ptk') {
					$id = array('id_penelitian_ptk' => $post['id_penelitian_ptk']);
					$record_penelitian = $this->ptk_penelitian_model->get_detail_data('get',array('ptk'),NULL,$id,FALSE,array('id_penelitian_ptk','id_ptk_rsch','nuptk AS nidn','nama_ptk AS nama','judul_penelitian','bidang_ilmu','lembaga'));
					$total_rows = count($record_penelitian);
					if ($total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'penelitian_ptk' => $record_penelitian,
							);
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data riwayat penelitian tenaga pendidik yang anda pilih tidak ditemukan / data telah dihapus'
							);
					}
				}
				elseif ($post['data']=='data_mk') {
					$id = array('id_mk' => $post['id_mk']);
					$total_rows = $this->mata_kuliah_model->count($id);
					if ($total_rows > 0 ) {
						$record_mk = $this->mata_kuliah_model->get_detail_data('get',array('prodi_mk','konsentrasi_pd'),NULL,$id,FALSE,Array('id_mk','id_pd_mk','nama_prodi','jenjang_prodi','kode_mk','nama_mk','jml_sks','jenis_jdl','nm_konsentrasi'));
						$result = array(
								'total_rows' => $total_rows,
								'record_mk' => $record_mk,
								);
					}
					else{
						$result = array(
								'total_rows' => $total_rows,
								'message' => 'Data mata kuliah yang anda pilih tidak ditemukan / data telah dihapus'
								);
					}
				}
				elseif ($post['data']=='data_jadwal_kuliah') {
					if (isset($post['act']) && $post['act'] == 'get') {
						$id = array('id_jdl' => $post['id_jdl'], 'status_jdl' => 1);
						$total_rows = $this->jadwal_model->get_detail_data('count',array('thn_akademik'),NULL,$id);
					}
					else{
						$id = array('id_jdl' => $post['id_jdl']);
						$total_rows = $this->jadwal_model->count($id);
					}

					if (@$total_rows > 0) {
						$select_jadwal_detail = array('id_jdl','id_mk_jdl','id_ptk_jdl','hari_jdl','jam_mulai_jdl','jam_akhir_jdl','id_thn_ak_jdl','thn_ajaran_jdl','semester','kelas','ruang','nama_prodi','kode_mk','nama_mk','jml_sks','nuptk','nama_ptk','status_jdl','jenis_jdl','nm_konsentrasi');
						$record = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','prodi_mk','ptk'),NULL,$id,NULL,$select_jadwal_detail);
						$record_jadwal = array();
						foreach ($record as $key) {
							$thn = array('thn_ajaran_jdl' => thn_ajaran_conv($key->thn_ajaran_jdl));
							$record_jadwal[] = array_merge((array)$key,$thn);
						}
						$result = array(
								'total_rows' => $total_rows,
								'record_jdl' => $record_jadwal,
								);
					}
					else{
						$result = array(
								'total_rows' => $total_rows,
								'message' => 'Data jadwal kuliah yang anda pilih tidak ditemukan / data telah dihapus / tahun akademik jadwal saat ini sedang tidak diterapkan'
								);
					}
				}
				elseif ($post['data']=='daftar_nilai_mhs') {
					$cari = $post['value'];
					$act = array(
						'like' => array(
							'nisn' => $cari,
							),
						'or_like' => array(
							'nama' => $cari,
							),
						);
					$data = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mahasiswa'),$act,NULL,FALSE,array('id_mhs_kls','nisn','nama','thn_ajaran_jdl','id_kelas','id_thn_ak'),array('thn_ajaran_jdl','id_mhs_kls'),'thn_ajaran_jdl DESC, nisn ASC');
					$total_rows = count($data);
					if ($total_rows > 0 ) {
						foreach ($data as $key => $value) {
							$record[] = array(
								'id' => $value->id_mhs_kls.'/'.$value->id_thn_ak,
								'text' => $value->nisn.' | '.$value->nama,
								'nim_mhs' => $value->nisn,
								'nama_mhs' => $value->nama,
								'thn_akademik' => thn_ajaran_conv($value->thn_ajaran_jdl),
								);
						}
						$result = array(
							'nilai_mhs' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['nilai_mhs'] = '';
					}
				}
				elseif ($post['data'] == 'data_nilai_mhs') {
					$vars = explode('/',$post['thn']);
					$where = array('id_mhs_kls' => $vars[0],'id_thn_ak' => $vars[1]);

					$record = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mata_kuliah','mahasiswa','prodi_mhs','fakultas'),NULL,$where,FALSE,array('kode_mk','nama_mk','jml_sks','nilai_akhir','thn_ajaran_jdl','nama','nisn','nama_fakultas','nama_prodi','jenjang_prodi','photo_mhs'),NULL,'kode_mk ASC');
					if (count($record) > 0) {
						$record_nilai = array();
						$sks = 0;
						$mutu = 0;
						foreach ($record as $key) {
							$n = explode('/',nilai_conv($key->nilai_akhir,$key->jml_sks));
							$mt = array(
								'thn_ajaran_jdl' => thn_ajaran_conv($key->thn_ajaran_jdl),
								'hm' => $n[0],
								'am' => $n[1],
								'mutu' => $n[2],
								);
							$record_nilai[] = array_merge((array)$key,$mt);
							$sks += $key->jml_sks;
							if ($n[2] != '') {
								$mutu += $n[2];
							}
						}
						$result = array(
							'total_rows' => count($record_nilai),
							'record_nilai' => $record_nilai,
							'sks' => $sks,
							'mutu' => $mutu,
							);
					}
					else{
						$result = array(
							'total_rows' => count($record),
							'message' => 'Data nilai mahasiswa yang anda pilih tidak ditemukan / data telah dihapus'
							);
					}
				}
				elseif ($post['data']=='daftar_mk') {
					$cari = $post['value'];
					$act = array(
						'or_like' => array(
							'kode_mk' => $cari,
							'nama_mk' => $cari,
							),
						);
					$data = $this->mata_kuliah_model->get_detail_data('get',array('prodi_mk','konsentrasi_pd'),$act,NULL,FALSE,array('id_mk','kode_mk','nama_mk','nama_prodi','jml_sks','jenjang_prodi','jenis_jdl','nm_konsentrasi'));
					$total_rows = count($data);
					if ($total_rows > 0 ) {

						foreach ($data as $key => $value) {
							if ($value->jenis_jdl == '0') {
								$konsentrasi = '';
							}
							else{
								$konsentrasi = ' (Konsentrasi '.$value->nm_konsentrasi.')';
							}
							$record[] = array(
								'id' => $value->id_mk,
								'text' => $value->kode_mk.' | '.$value->nama_mk.''.$konsentrasi,
								'nama_prodi' => $value->nama_prodi,
								'jml_sks' => $value->jml_sks,
								'jenjang_prodi' => $value->jenjang_prodi,
								'jenis_jdl' => $value->jenis_jdl,
								'konsentrasi' => $konsentrasi,
								);
						}
						$result = array(
							'mk' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['mk'] = '';
					}
				}
				elseif ($post['data']=='daftar_ptk') {
					$cari = $post['value'];
					$act = array(
						'or_like' => array(
							'nuptk' => $cari,
							'nama_ptk' => $cari
							),
						);
					$total_rows = $this->ptk_model->get_detail_data('count',NULL,$act);
					if ($total_rows > 0 ) {
						$length = 10;
						$offset = 0;
						if (isset($post['page'])) {
							$offset = ($post['page'] - 1) * $length;
							$this->db->limit($length,$offset);
						}
						else{
							$this->db->limit($length,$offset);
						}

						$select = array('nama_ptk','id_ptk','nama_prodi','nuptk AS nidn','jenjang_prodi','status_aktif_ptk','photo_ptk');
						$data = $this->ptk_model->get_detail_data('get',array('prodi_ptk'),$act,NULL,NULL,$select);
						$this->load->helper('file');
						foreach ($data as $key => $value) {
							$photo = photo_u();
							if ($value->photo_ptk != '') {
								$check_file = get_file_info('uploads/ptk-photo/'.$value->photo_ptk);
								if ($check_file != FALSE) {
									$photo = photo_u('ptk',$value->photo_ptk.'?n_img='.rand_val(20));
								}
							}
							$record[] = array(
								'id' => $value->id_ptk,
								'text' => $value->nidn.' | '.$value->nama_ptk,
								'nama' => $value->nama_ptk,
								'nidn' => $value->nidn,
								'nama_prodi' => $value->nama_prodi,
								'jenjang_prodi' => $value->jenjang_prodi,
								'status_aktif_ptk' => select_conv_value($value->status_aktif_ptk,'ptk','status_aktif_ptk'),
								'photo' => $photo
								);
						}
						$result = array(
							'ptk' => $record,
							'total_count' => $total_rows,
							'total_data' => $offset+$length
							);
					}
					else{
						$result['ptk'] = '';
					}
				}
				elseif ($post['data']=='daftar_jadwal_pd') {
					$thn_ajaran = explode(' ',$post['thn']);
					$where = array('id_thn_ak_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
					$select_jadwal_detail = array('id_jdl','id_thn_ak_jdl','hari_jdl','jam_mulai_jdl','jam_akhir_jdl','thn_ajaran_jdl','semester','kelas','ruang','jenis_jdl','nm_konsentrasi','nama_prodi','nama_mk','id_pd_mk','jml_sks','nama_ptk','status_jdl');
					$data = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','prodi_mk','ptk'),NULL,$where,NULL,$select_jadwal_detail);
					$record_jadwal = array();
					$data_k = array();
					$data_u = array();
					foreach ($data as $key) {
						/*if ((array_key_exists($key->semester, $semester_k)) == FALSE && (array_key_exists($key->kelas, $kelas_k)) == FALSE) {
							$data_k[] = array(
								'semester' => $key->semester,
								'kelas' => $key->kelas,
								'jenis_jdl' => $key->jenis_jdl,
								'nm_konsentrasi' => $key->nm_konsentrasi,
							);
							array_push($semester_k, $key->semester);
							array_push($kelas_k, $key->kelas);
						}*/
						$count_mhs = array('jml_mhs' => $this->kelas_model->count(array('id_jdl_kls' =>$key->id_jdl)));
						$record_jadwal[] = array_merge((array)$key,(array)$count_mhs);
					}
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('mata_kuliah','konsentrasi_pd'),NULL,$where,FALSE,array('semester','kelas','jenis_jdl','nm_konsentrasi'),array('semester','kelas'),'semester ASC, kelas ASC');
					$data_u = $this->jadwal_model->get_detail_data('get',array('mata_kuliah','konsentrasi_pd'),NULL,$where,FALSE,array('jenis_jdl','nm_konsentrasi'),array('jenis_jdl'),'nm_konsentrasi ASC');
					$result = array(
						'record_jadwal' => $record_jadwal,
						'record_kelas' => $data_kelas,
						'record_u' => $data_u
						);
				}
				elseif ($post['data']== 'daftar_kelas_mhs') {
					$select_daftar_mhs = array('id_kelas','id_jdl_kls','id AS in_mhs','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
					$data_mhs = $this->kelas_model->get_detail_data('get',array('mahasiswa','thn_angkatan'),NULL,array('id_jdl_kls' => $post['kelas']),NULL,$select_daftar_mhs);

					$select_kelas = array('id_jdl','hari_jdl','jam_mulai_jdl','jam_akhir_jdl','semester','kelas','ruang','jenis_jdl','nm_konsentrasi','nama_mk','nama_ptk','status_jdl');
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','ptk'),NULL,array('id_jdl' => $post['kelas']),NULL,$select_kelas);
					$result = array(
						'record_mhs' => $data_mhs,
						'record_kelas' => $data_kelas
						);
				}
				elseif ($post['data']=='daftar_mhs' && isset($post['pd']) || $post['data']=='daftar_mhs' && isset($post['act'])) {
					$cari = $post['value'];
					if (isset($post['pd'])) {
						$pd = $this->jadwal_model->get_detail_data('get',array('mata_kuliah'),NULL,array('id_jdl' => $post['pd']),TRUE,array('id_pd_mk'));
						$pd = $pd->id_pd_mk;
						$mhs_check = $this->kelas_model->get_detail_data('get',NULL,NULL,array('id_jdl_kls' => $post['pd']),NULL,array('id_mhs_kls'),NULL,'id_kelas');
						$mhs_list = array();
						foreach ($mhs_check as $key => $value) {
							$mhs_list[] = $value->id_mhs_kls;
						}

						$act = NULL;
						if (count($mhs_list) > 0) {
							$act[] = array(
									'not_in' => array('id' => $mhs_list),
									'where' => array(
										'id_pd_mhs' => $pd,
										'id_mhs_alni' => NULL,
										'id_mhs_DO' => NULL,
										),
									'like' => array(
										'nisn' => $cari,
										)
								);
							$act[] = array(
									'or_not_in' => array('id' => $mhs_list),
									'where' => array(
										'id_pd_mhs' => $pd,
										'id_mhs_alni' => NULL,
										'id_mhs_DO' => NULL,
										),
									'like' => array(
										'nama' => $cari,
										)
								);
						}
						else{
							$act[] = array(
									'where' => array(
										'id_pd_mhs' => $pd,
										'id_mhs_alni' => NULL,
										'id_mhs_DO' => NULL,
										),
									'like' => array(
										'nisn' => $cari,
										)
								);
							$act[] = array(
									'or' => array(
										'id_pd_mhs' => $pd,
										),
									'where' => array(
										'id_mhs_alni' => NULL,
										'id_mhs_DO' => NULL,
										),
									'like' => array(
										'nama' => $cari,
										)
								);
						}
						$cari = array('id_pd_mhs' => $pd);
						$count = $this->mahasiswa_model->get_detail_data('count',array('alumni','mhs_do'),$act,NULL,FALSE,array('id','nisn','nama'),array('id'));
					}
					elseif (isset($post['act'])) {
						$act[] = array(
								'where' => array(
									'id_mhs_alni' => NULL,
									'id_mhs_DO' => NULL,
									),
								'like' => array(
									'nisn' => $cari,
									)
							);
						$act[] = array(
								'or' => array(
									'id_mhs_alni' => NULL,
									),
								'where' => array(
									'id_mhs_DO' => NULL,
									),
								'like' => array(
									'nama' => $cari,
									)
							);
						$count = $this->mahasiswa_model->get_detail_data('count',array('alumni','mhs_do'),$act,NULL,FALSE,array('id','nisn','nama'),array('id'));
					}
					$total_rows = @$count;
					if ($total_rows > 0 ) {
						$length = 10;
						$offset = 0;
						if (isset($post['page'])) {
							$offset = ($post['page'] - 1) * $length;
							$this->db->limit($length,$offset);
						}
						else{
							$this->db->limit($length,$offset);
						}

						if (isset($post['pd'])) {
							$data = $this->mahasiswa_model->get_detail_data('get',array('alumni','mhs_do','thn_angkatan'),$act,NULL,FALSE,array('id','nisn','nama','photo_mhs','tahun_angkatan'),array('id'));
						}
						elseif (isset($post['act'])) {
							$data = $this->mahasiswa_model->get_detail_data('get',array('alumni','mhs_do','thn_angkatan'),$act,NULL,FALSE,array('id','nisn','nama','photo_mhs','tahun_angkatan'),array('id'));
						}
						$this->load->helper('file');
						foreach ($data as $key => $value) {
							$photo = photo_u();
							if ($value->photo_mhs != '') {
								$check_file = get_file_info('uploads/mhs-photo/'.$value->photo_mhs);
								if ($check_file != FALSE) {
									$photo = photo_u('mhs',$value->photo_mhs.'?n_img='.rand_val(20));
								}
							}
							$record[] = array(
								'id' => $value->id,
								'text' => $value->nisn.' | '.$value->nama,
								'nama_mhs' => $value->nama,
								'nim_mhs' => $value->nisn,
								'tahun_angkatan' => $value->tahun_angkatan,
								'photo' => $photo
								);
						}
						$result = array(
							'mhs' => $record,
							'total_count' => $total_rows,
							'total_data' => $offset+$length
							);
					}
					else{
						$result['mhs'] = '';
					}
				}
				elseif ($post['data']=='daftar_kelas') {
					$cari_k = $post['value'];
					$total_rows = 0;
					if (isset($post['thn'])) {
						$thn_f = $post['thn'];
					}
					elseif (isset($post['m_thn'])) {
						$thn_f = $post['m_thn'];
					}
					$thn_dt = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mata_kuliah'),NULL,array('id_kelas' => $thn_f),TRUE,array('thn_ajaran_jdl','id_pd_mk','id_mk_jdl','id_jdl'),NULL,'id_kelas');

					if ($thn_dt) {
						$thn = $thn_dt->thn_ajaran_jdl;
						$pd = $thn_dt->id_pd_mk;
						$mk = $thn_dt->id_mk_jdl;
						$jdl = $thn_dt->id_jdl;
						$cari = array('kelas LIKE' => '%'.$cari_k.'%', 'id_pd_mk' => $pd, 'thn_ajaran_jdl' => $thn, 'status_jdl' => 1,'id_mk_jdl' => $mk);
						$act = array(
							'not_in' => array(
								'id_jdl' => $jdl
								),
							);
						$data= $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','prodi_mk'),$act,$cari,FALSE,array('id_jdl','semester','kelas','nama_mk','jenis_jdl'),NULL,'semester ASC, kelas ASC');
						$total_rows = count($data);
					}

					if ($total_rows > 0 ) {
						foreach ($data as $key => $value) {
							$record[] = array(
								'id' => $value->id_jdl.'/'.$thn_f,
								'text' => $value->semester.'/'.$value->kelas.' '.$value->nama_mk,
								'semester' => $value->semester,
								'kelas' => $value->kelas,
								'mk' => $value->nama_mk,
								'jns' => $value->jenis_jdl,
								'jml_mhs' => $this->kelas_model->count(array('id_jdl_kls' => $value->id_jdl)),
								'jml_lk' => $this->kelas_model->get_detail_data('count',array('mahasiswa'),NULL,array('id_jdl_kls' => $value->id_jdl, 'jk' => 'L')),
								'jml_pr' => $this->kelas_model->get_detail_data('count',array('mahasiswa'),NULL,array('id_jdl_kls' => $value->id_jdl, 'jk' => 'P')),
								);
						}
						$result = array(
							'kls' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['kls'] = '';
					}
				}
				elseif ($post['data'] =='riwayat_akademik_mhs') {
					$where = array('id_mhs_kls' => $post['in_mhs']);
					$select = array('id_thn_ak_jdl','thn_ajaran_jdl','kode_mk','nama_mk','jml_sks');
					$data = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mata_kuliah'),NULL,$where,NULL,$select,NULL,'thn_ajaran_jdl ASC, kode_mk ASC');
					$record = array();
					$count = 0;
					$thn_ak = '';
					foreach ($data as $key) {
						$where = array_merge($where,array('id_thn_ak' => $key->id_thn_ak_jdl));
						if ($key->id_thn_ak_jdl != $thn_ak) {
							$thn_ak = $key->id_thn_ak_jdl;
							$act = array(
								'sum' => array(
									'jml_sks' => 'total_sks'
									)
								);
							$sks_count = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mata_kuliah'),$act,$where,TRUE,array('jml_sks'),NULL,'id_kelas');
							$total_sks = $sks_count->total_sks;

							$count_studi = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,$where);
							$count_aktif_studi = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,array_merge($where,array('status_mhs_kls' => 1)));
							$statik_studi = round($count_aktif_studi/$count_studi*100);
							if ($statik_studi >= 50) {
								$status_aktif_mhs = 'Aktif';
							}
							else{
								$status_aktif_mhs = 'Tidak Aktif';
							}
						}
						$arr = array(
							'id_thn_ak_jdl' => rand_val(),
							'thn_ajaran_jdl' => thn_ajaran_conv($key->thn_ajaran_jdl),
							'total_sks' => $total_sks,
							'status_aktif_mhs' => $status_aktif_mhs,
							'statik_aktif_mhs' => $statik_studi,
							);
						$record[] = array_merge((array)$key,$arr);
						$count += $key->jml_sks;
					}
					$result = array(
						'record_akademik' => $record,
						'sks' => $count,
						);
				}
				elseif ($post['data'] =='detail_data_ptk') {
					$in_ptk = $post['in_ptk'];
					if ($post['get_data'] == 'all') {
						$data_jadwal = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','prodi_mk'),NULL,array('id_ptk_jdl' => $in_ptk),NULL,array('thn_ajaran_jdl','kode_mk','nama_mk','semester','kelas','nama_prodi'),NULL,'thn_ajaran_jdl ASC, semester ASC, kelas ASC');
						$record_jadwal = array();
						foreach ($data_jadwal as $key) {
							$arr = array(
								'thn_ajaran_jdl' => thn_ajaran_conv($key->thn_ajaran_jdl),
								'kelas' => $key->semester.'/'.$key->kelas,
								);
							$record_jadwal[] = array_merge((array)$key,$arr);
						}
					}

					if ($post['get_data'] == 'all' || $post['get_data'] == 'studi_ptk') {
						$data_studi = $this->ptk_studi_model->get_detail_data('get',NULL,NULL,array('id_ptk_studi' => $in_ptk),NULL,array('id_studi AS in_studi','nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk'),NULL,'tgl_ijazah_ptk ASC');
						$record_studi = array();
						foreach ($data_studi as $key) {
							$arr = array('tgl_ijazah_ptk' => date_convert($key->tgl_ijazah_ptk));
							$record_studi[] = array_merge((array)$key,$arr);
						}
					}

					if ($post['get_data'] == 'all' || $post['get_data'] == 'penelitian_ptk') {
						$record_penelitian = $this->ptk_penelitian_model->get_detail_data('get',NULL,NULL,array('id_ptk_rsch' => $in_ptk),NULL,array('id_penelitian_ptk AS in_research','judul_penelitian','bidang_ilmu','lembaga'));
					}
					$result = array(
						'studi_ptk' => @$record_studi,
						'riwayat_mengajar' => @$record_jadwal,
						'penelitian_ptk' => @$record_penelitian,
						);
				}
				elseif ($post['data']=='check_mhs') {
					$data = array();
					if ($post['check'] == 'data_exists') {
						if (isset($post['id_alumni'])) {
							$id_mhs_check = array($post['id_alumni']);
						}
						elseif (isset($post['id_mhs_do'])) {
							$id_mhs_check = array($post['id_mhs_do']);
						}
						else{
							foreach ($post['id'] as $key) {
								$id_mhs = explode(' ',$key);
								$id_mhs_check[] = $id_mhs[0];
							}
						}
						/*$id_mhs_check = $post['id'];*/
						$count_check = count($id_mhs_check);
						if ($count_check > 0) {
							$act = array(
								'in' => array(
									'id' => $id_mhs_check,
									),
								);
							if (isset($post['id_alumni'])) {
								$select = array('id_alni AS in_mhs','id AS in_data','nisn AS nim','nama','tgl_lulus','tgl_yudisium');
								$join_table = array('alumni');
							}
							elseif (isset($post['id_mhs_do'])) {
								$select = array('id_DO AS in_mhs','id AS in_data','nisn AS nim','nama','tgl_drop_out','drop_out_reason');
								$join_table = array('mhs_do');
							}
							else {
								$select = array('nisn AS nim','nama');
								$join_table = array();
							}

							if (!isset($post['data_check']) && !isset($post['kls_mhs'])) {
								$data = $this->mahasiswa_model->get_detail_data('get',$join_table,$act,NULL,FALSE,$select,NULL,'nisn ASC');
							}
							elseif (isset($post['kls_mhs'])) {
								$data = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mahasiswa'),$act,array('id_jdl' => $post['kls_mhs'], 'status_jdl' => 1),FALSE,$select,NULL,'nisn ASC');
							}
							elseif (isset($post['data_check'])) {
								if ($post['data_check'] == 'alumni') {
									$data = $this->alumni_model->get_detail_data('get',array('mhs'),$act,NULL,FALSE,$select,NULL,'nisn ASC');
								}
								elseif ($post['data_check'] == 'mhs_do') {
									$data = $this->mahasiswa_do_model->get_detail_data('get',array('mhs'),$act,NULL,FALSE,$select,NULL,'nisn ASC');
								}
							}
							$count_check = count($data);
							if (count($data) == 0) {
								$message = 'Mahasiswa yang anda pilih tidak ditemukan didalam database atau sudah terhapus!';
							}
						}
						else{
							$message = 'Silahkan pilih data mahasiswa!';
						}
					}
					elseif ($post['check'] == 'alumni') {
						foreach ($post['id'] as $key) {
							$id_mhs = explode(' ',$key);
							if (@$id_mhs[0] != NULL) {
								$id_mhs_check[] = $id_mhs[0];
							}
							else{
								$id_mhs_check[] = $key;
							}
						}
						$act = array(
							'in' => array(
								'id' => @$id_mhs_check,
								),
							);
						$data_mhs = $this->mahasiswa_model->get_detail_data('get',array('alumni','mhs_do'),$act,NULL,FALSE,array('nisn AS nim','nama','id_mhs_alni','id_mhs_DO'),NULL,'nisn ASC');
						$alumni_dt = 0;
						$mhs_do_dt = 0;
						foreach ($data_mhs as $key) {
							if ($key->id_mhs_alni != NULL) {
								$alumni_dt++;
							}
							if ($key->id_mhs_DO != NULL) {
								$mhs_do_dt++;
							}
							if ($key->id_mhs_alni == NULL && $key->id_mhs_DO == NULL) {
								$data[] = array(
									'nim' => $key->nim,
									'nama' => $key->nama
									);
							}
						}
						$count_check = count($data);
						if (count($data_mhs) == 0) {
							$message = 'Mahasiswa yang anda pilih tidak ditemukan didalam database atau sudah terhapus!';
						}
						else{
							if ($alumni_dt > 0 && $mhs_do_dt > 0) {
								$message = 'Mahasiswa yang anda pilih ada yang sudah terdaftar sebagai alumni dan ada juga yang sudah drop out!';
							}
							elseif ($alumni_dt > 0) {
								$message = 'Mahasiswa yang anda pilih sudah terdaftar sebagai alumni!';
							}
							elseif ($mhs_do_dt > 0) {
								$message = 'Mahasiswa yang anda pilih sudah terdaftar sebagai mahasiswa yang drop out!';
							}
						}
					}

					if (@$count_check > 0) {
						$result = array(
							'data' => $data,
							'total_rows' => $count_check,
							);
					}
					else{
						$result = array(
							'total_rows' => @$count_check,
							'message' => @$message,
							);
					}
				}
				elseif ($post['data']=='check_ptk') {
					if ($post['check'] == 'data_exists') {
						$id_ptk = $post['id'];
						$count_check = count($id_ptk);
						if ($count_check > 0) {
							$act = array(
								'in' => array(
									'id_ptk' => $id_ptk,
									),
								);
							$data = $this->ptk_model->get_detail_data('get',NULL,$act,NULL,FALSE,array('nuptk AS nidn','nama_ptk AS nama'));
							$count_check = count($data);
							if (count($data) == 0) {
								$message = 'Data tenaga pendidik yang anda pilih tidak ada didalam database atau sudah terhapus!';
							}
						}
					}

					if (@$count_check > 0) {
						$result = array(
							'data' => $data,
							'total_rows' => $count_check,
							);
					}
					else{
						$result = array(
							'total_rows' => @$count_check,
							'message' => @$message
							);
					}
				}
				elseif ($post['data']=='check_mk') {
					if ($post['check'] == 'data_exists') {
						$id_mk_check = $post['id'];
						$count_check = count($id_mk_check);
						if ($count_check > 0) {
							$act = array(
								'in' => array(
									'id_mk' => $id_mk_check,
									),
								);
							$data = $this->mata_kuliah_model->get_detail_data('get',array('konsentrasi_pd'),$act,NULL,FALSE,array('kode_mk','nama_mk','jenis_jdl','nm_konsentrasi'));
							$count_check = count($data);
						}
					}

					if ($count_check > 0) {
						$result = array(
							'data' => $data,
							'total_rows' => $count_check,
							);
					}
					else{
						$result = array(
							'total_rows' => $count_check,
							'message' => 'Data mata kuliah yang anda pilih tidak ditemukan / data telah dihapus'
							);
					}
				}
				elseif ($post['data']=='check_jadwal') {
					$id_jadwal_check = array();
					if ($post['check'] == 'data_exists') {
						foreach ($post['id'] as $key) {
							$id_j = explode('/',$key);
							$id_jadwal_check[] = $id_j[0];
						}
						$count_check = count($id_jadwal_check);
						if ($count_check > 0) {
							$act = array(
								'in' => array(
									'id_jdl' => $id_jadwal_check,
									),
								);
							$data = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),$act,array('status_jdl' => 1),FALSE,array('semester','kelas'));
							$count_check = count($data);
						}
					}

					if ($count_check > 0) {
						$result = array(
							'data' => $data,
							'total_rows' => $count_check,
							);
					}
					else{
						$result = array(
							'total_rows' => $count_check,
							'message' => 'Data jadwal kuliah yang anda pilih tidak ditemukan / data telah dihapus / tahun akademik jadwal saat ini sedang tidak diterapkan'
							);
					}
				}
				elseif ($post['data']=='status_jdl') {
					if (isset($post['status_kelas'])) {
						$status_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $post['status_kelas']),NULL,array('status_jdl'));
						if ($status_kelas) {
							foreach ($status_kelas as $key => $value) {
								$status = $value->status_jdl;
							}
						}
						else{
							$status = 'not_found';
						}
					}
					elseif (isset($post['status'])) {
						$status_kelas = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik'),NULL,array('id_kelas' => $post['status']),NULL,array('status_jdl'),NULL,'id_kelas');
						if ($status_kelas) {
							foreach ($status_kelas as $key => $value) {
								$status = $value->status_jdl;
							}
						}
						else{
							$status = 'not_found';
						}
					}
					$result = array(
						'status_jdl' => $status,
						);
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'ambil_id') {
				if ($post['data']=='data_mhs') {
					$id = array('id' => $post['id']);
					$select_mhs = array('id','nisn','nama');
					$record_mhs = $this->mahasiswa_model->get_by_search($id,FALSE,$select_mhs);
					$result = array(
							'total_rows' => count($record_mhs),
							'record_mhs' => $record_mhs,
							);
				}
				elseif ($post['data']=='data_ptk') {
					$id = array('id_ptk' => $post['id_ptk']);
					$select = array('id_ptk','nama_ptk','nuptk');
					$record_ptk = $this->ptk_model->get_by_search($id,FALSE,$select);
					$result = array(
							'total_rows' => count($record_ptk),
							'record_ptk' => $record_ptk,
							);
				}
				elseif ($post['data']=='data_mk') {
					$id = array('id_mk' => $post['id_mk']);
					$select = array('id_mk','id_pd_mk','nama_prodi','jenjang_prodi','nama_mk','jenis_jdl','nm_konsentrasi');
					$record_mk = $this->mata_kuliah_model->get_detail_data('get',array('prodi_mk','konsentrasi_pd'),NULL,$id,FALSE,$select);
					$result = array(
							'total_rows' => count($record_mk),
							'record_mk' => $record_mk,
							);
				}
				elseif ($post['data']=='data_jadwal_kuliah') {
					$id = array('id_jdl' => $post['id_jdl']);
					$select = array('id_jdl','id_thn_ak_jdl','id_pd_mk','nama_prodi','thn_ajaran_jdl','nama_mk','semester','kelas','status_jdl','jenis_jdl','nm_konsentrasi');
					$record_jadwal = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','prodi_mk'),NULL,$id,NULL,$select);
					if (@$record_jadwal[0]->status_jdl == 1) {
						$result = array(
								'total_rows' => count($record_jadwal),
								'record_jdl' => $record_jadwal
								);
					}
					else{
						$result = array(
								'total_rows' => 0,
								'message' => 'Data jadwal kuliah yang anda pilih tidak ditemukan / data telah dihapus / tahun akademik jadwal saat ini sedang tidak diterapkan'
								);
					}
				}
				elseif ($post['data']=='kelas_mhs') {
					$id = array('id_kelas' => $post['id_kls']);
					$select = array('id_kelas','id_jdl_kls','nama','nisn','nama_prodi','thn_ajaran_jdl','nama_mk','semester','kelas','status_jdl','jenis_jdl','nm_konsentrasi');
					$record_mhs = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mahasiswa','mata_kuliah','konsentrasi_pd','prodi_mk'),NULL,$id,NULL,$select);
					if (@$record_mhs[0]->status_jdl == 1) {
						$result = array(
							'total_rows' => count($record_mhs),
							'record_mhs' => $record_mhs,
							);
					}
					else{
						$result = array(
								'total_rows' => 0,
								'message' => 'Data mahasiswa anda pilih tidak ditemukan / data telah dihapus / tahun akademik kelas ini saat ini sedang tidak diterapkan'
								);
					}
				}
				elseif ($post['data']=='data_alumni') {
					$id = array('id_mhs_alni' => $post['id']);
					$select_mhs = array('id_mhs_alni AS in_mhs','nisn AS nim','nama');
					$record_mhs = $this->mahasiswa_model->get_detail_data('get',array('alumni'),NULL,$id,FALSE,$select_mhs);
					$result = array(
							'total_rows' => count($record_mhs),
							'record_mhs' => $record_mhs,
							);
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'update') {
				if (isset($post['data_mhs'])) {
					$rules = $this->mahasiswa_model->rules;
					$this->form_validation->set_rules($rules);
					$this->id_mhs = $post['id_mhs'];

					if ($this->form_validation->run() == TRUE) {
						$id_mhs = array('id' => $post['id_mhs']);
						$nama_mhs = strtoupper($post['nama']);
						$tmp_lhr = ucwords($post['tmp_lhr']);
						$alamat = ucwords($post['alamat']);
						$dusun = ucwords($post['dusun']);
						$kelurahan = ucwords($post['kelurahan']);
						$kecamatan = ucwords($post['kecamatan']);
						$email = strtolower($post['email']);
						$data_mhs = array(
							'nisn' => $post['nisn'],
							'nama' => $nama_mhs,
							'thn_angkatan' => $post['thn_angkatan'],
							'id_pd_mhs' => $post['id_pd_mhs'],
							'jk' => $post['jk'],
							'tmp_lhr' => $tmp_lhr,
							'tgl_lhr' => $post['tgl_lhr'],
							'nik' => $post['nik'],
							'agama' => $post['agama'],
							'alamat' => $alamat,
							'rt' => $post['rt'],
							'rw' => $post['rw'],
							'dusun' => $dusun,
							'kelurahan' => $kelurahan,
							'kecamatan' => $kecamatan,
							'kode_pos' => $post['kode_pos'],
							'jns_tinggal' => $post['jns_tinggal'],
							'alt_trans' => $post['alt_trans'],
							'tlp' => $post['tlp'],
							'hp' => $post['hp'],
							'email' => $email
							);
						$save_data_mhs = $this->mahasiswa_model->update($data_mhs,$id_mhs);
						if ($this->db->affected_rows() > 0) {
							$status_update = TRUE;
						}
						else{
							$status_update = FALSE;
						}

						if ($save_data_mhs) {
							/*if ($post['nisn'] != $post['nisn_sebelumnya']) {
								$id_user = array(
									'id_user_detail' => $post['id_mhs'],
									'level_akses' => 'mhs'
									);
								$nisn_user = array('username' => $post['nisn']);
								$this->user_model->update($nisn_user,$id_user);
							}*/

							$id_ortu = array('id_ortu' => $post['id_ortu']);
							$nm_ayah = strtoupper($post['nm_ayah']);
							$nm_ibu = strtoupper($post['nm_ibu']);
							$nm_wali = strtoupper($post['nm_wali']);
							$data_ortu_wali = array(
								'nm_ayah' => $nm_ayah,
								'thn_lhr_ayah' => $post['thn_lhr_ayah'],
								'pendi_ayah' => $post['pendi_ayah'],
								'pekerjaan_ayah' => $post['pekerjaan_ayah'],
								'penghasilan_ayah' => $post['penghasilan_ayah'],
								'nik_ayah' => $post['nik_ayah'],
								'nm_ibu' => $nm_ibu,
								'thn_lhr_ibu' => $post['thn_lhr_ibu'],
								'pendi_ibu' => $post['pendi_ibu'],
								'pekerjaan_ibu' => $post['pekerjaan_ibu'],
								'penghasilan_ibu' => $post['penghasilan_ibu'],
								'nik_ibu' => $post['nik_ibu'],
								'nm_wali' => $nm_wali,
								'thn_lhr_wali' => $post['thn_lhr_wali'],
								'pendi_wali' => $post['pendi_wali'],
								'pekerjaan_wali' => $post['pekerjaan_wali'],
								'penghasilan_wali' => $post['penghasilan_wali'],
								'nik_wali' => $post['nik_wali'],
								);
							$save_data_ortu = $this->ortu_model->update($data_ortu_wali,$id_ortu);
							if ($save_data_ortu) {
								$data = 'data_mhs';
								$result = array(
									'status' => 'success',
									'data' => $data,
									'in'=> $post['id_mhs'],
									'status_update'=> $status_update,
									);
							}
							else{
								$result = array('status' => 'failed_db');
							}
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_ptk'])) {
					$rules = $this->ptk_model->rules;
					$this->id_ptk = $post['id_ptk'];
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$id_ptk = array('id_ptk' => $post['id_ptk']);
						$nama_ptk = ucwords(strtolower($post['nama_ptk']));
						$tmp_lhr = ucwords($post['tmp_lhr_ptk']);
						$data_ptk = array(
							'nama_ptk' => $nama_ptk,
							'nuptk' => $post['nuptk'],
							'nip' => $post['nip'],
							'jk_ptk' => $post['jk_ptk'],
							'tmp_lhr_ptk' => $tmp_lhr,
							'tgl_lhr_ptk' => $post['tgl_lhr_ptk'],
							'status_ptk' => $post['status_ptk'],
							'status_aktif_ptk' =>$post['status_aktif_ptk'],
							'jenjang' => $post['jenjang'],
							'jurusan_prodi' => $post['jurusan_prodi'],
							'nik_ptk' => $post['nik_ptk'],
							'agama_ptk' => $post['agama_ptk'],
							'alamat_ptk' => ucwords($post['alamat_ptk']),
							'rt_ptk' => $post['rt_ptk'],
							'rw_ptk' => $post['rw_ptk'],
							'dusun_ptk' => ucwords($post['dusun_ptk']),
							'kelurahan_ptk' => ucwords($post['kelurahan_ptk']),
							'kecamatan_ptk' => ucwords($post['kecamatan_ptk']),
							'kode_pos_ptk' => $post['kode_pos_ptk'],
							'tlp_ptk' => $post['tlp_ptk'],
							'hp_ptk' => $post['hp_ptk'],
							'email_ptk' => $post['email_ptk'],
							);
						$update_data_ptk = $this->ptk_model->update($data_ptk,$id_ptk);
						if ($this->db->affected_rows() > 0) {
							$status_update = TRUE;
						}
						else{
							$status_update = FALSE;
						}

						if ($update_data_ptk) {
							/*if ($post['nuptk'] != $post['nuptk_sebelumnya']) {
								$id_user = array(
									'id_user_detail' => $post['id_ptk'],
									'level_akses' => 'ptk'
								);
								if (!empty($post['nuptk'])) {
									$username = array('username' => $post['nuptk']);
								}
								else{
									for ($i=0; $i <= 1; $i++) {
										$user = rand(10000000000000,99999999999999).$post['id_ptk'];
										$check_user = array('username' => $user);
										$total_rows = $this->user_model->count($check_user);
										if ($total_rows > 0) {
											$i = 0;
										}
										else{
											$i = 1;
										}
									}
									$username = array('username' => $user);
								}
								$this->user_model->update($username,$id_user);
							}*/
							$data = 'data_ptk';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in'=> $post['id_ptk'],
								'status_update' => $status_update
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_studi_ptk'])) {
					$rules = $this->ptk_studi_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$in_ptk = $post['id_ptk_studi'];
						$data_studi = array(
							'id_ptk_studi' => $in_ptk,
							'nama_pt_studi' => ucwords($post['nama_pt_studi']),
							'studi_ptk' => ucwords($post['studi_ptk']),
							'jenjang_studi_ptk' => $post['jenjang_studi_ptk'],
							'gelar_ak_ptk' => $post['gelar_ak_ptk'],
							'tgl_ijazah_ptk' => $post['tgl_ijazah_ptk'],
							);
						$update_data_studi = $this->ptk_studi_model->update($data_studi,array('id_studi' => $post['id_studi']));
						if ($update_data_studi) {
							$record_studi = array();
							if (isset($post['ptk_detail'])) {
								$data_studi = $this->ptk_studi_model->get_detail_data('get',NULL,NULL,array('id_ptk_studi' => $post['ptk_detail']),NULL,array('id_studi AS in_studi','nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk'),NULL,'tgl_ijazah_ptk ASC');
								$record_studi = array();
								foreach ($data_studi as $key) {
									$arr = array('tgl_ijazah_ptk' => date_convert($key->tgl_ijazah_ptk));
									$record_studi[] = array_merge((array)$key,$arr);
								}
							}
							$data = 'data_studi_ptk';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in_ptk' => @$post['ptk_detail'],
								'studi_ptk' => $record_studi
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_penelitian_ptk'])) {
					$rules = $this->ptk_penelitian_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$in_ptk = $post['id_ptk_rsch'];
						$data_penelitian = array(
							'id_ptk_rsch' => $in_ptk,
							'judul_penelitian' => ucwords($post['judul_penelitian']),
							'bidang_ilmu' => ucwords($post['bidang_ilmu']),
							'lembaga' => $post['lembaga'],
							);
						$update_data_penelitian = $this->ptk_penelitian_model->update($data_penelitian,array('id_penelitian_ptk' => $post['id_penelitian_ptk']));
						if ($update_data_penelitian) {
							$record_penelitian = array();
							if (isset($post['ptk_detail'])) {
								$record_penelitian = $this->ptk_penelitian_model->get_detail_data('get',NULL,NULL,array('id_ptk_rsch' => $post['ptk_detail']),NULL,array('id_penelitian_ptk AS in_research','judul_penelitian','bidang_ilmu','lembaga'));
							}
							$data = 'data_penelitian_ptk';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in_ptk' => $post['ptk_detail'],
								'penelitian_ptk' => $record_penelitian
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_mk'])) {
					$rules = $this->mata_kuliah_model->rules;
					$this->form_validation->set_rules($rules);
					$this->id_mk = $post['id_mk'];
					if (isset($post['id_pd_mk'])) {
						$this->mk_pd = $post['id_pd_mk'];
					}

					if (isset($post['jenis_jdl']) && $post['jenis_jdl'] != '') {
						$this->konst_add = $post['jenis_jdl'];
						$jenis_jdl = $post['jenis_jdl'];
					}
					else{
						$this->konst_add = 0;
						$jenis_jdl = 0;
					}

					if ($this->form_validation->run() == TRUE) {
						$data_mk = array(
							'kode_mk' => strtoupper($post['kode_mk']),
							'nama_mk' => ucwords($post['nama_mk']),
							'id_pd_mk' => $post['id_pd_mk'],
							'jml_sks' => $post['jml_sks'],
							'jenis_jdl' => $jenis_jdl,
							);
						$id_mk = array('id_mk' => $post['id_mk']);
						$update_data_mk = $this->mata_kuliah_model->update($data_mk,$id_mk);
						if ($update_data_mk) {
							$data = 'data_mk';
							$result = array(
								'status' => 'success',
								'data' => $data
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_jadwal_kuliah'])) {
					$this->jam_awal = $post['jam_mulai_jdl'];
					$rules = $this->jadwal_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data_jadwal = array(
							'id_thn_ak_jdl' => $post['id_thn_ak_jdl'],
							'id_mk_jdl' => $post['id_mk_jdl'],
							'id_ptk_jdl' => $post['id_ptk_jdl'],
							'hari_jdl' => $post['hari_jdl'],
							'jam_mulai_jdl' => $post['jam_mulai_jdl'],
							'jam_akhir_jdl' => $post['jam_akhir_jdl'],
							'semester' => $post['semester'],
							'kelas' => $post['kelas'],
							'ruang' => strtoupper($post['ruang']),
							);
						$id_jdl = array('id_jdl' => $post['id_jdl']);
						$update_data_jadwal = $this->jadwal_model->update($data_jadwal,$id_jdl);
						if ($update_data_jadwal) {
							$thn= $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah'),NULL,array('id_thn_ak_jdl' => $post['id_thn_ak_jdl'], 'id_mk_jdl' => $post['id_mk_jdl']),NULL,array('id_thn_ak_jdl AS thn_ajaran_jdl','id_pd_mk'),array('thn_ajaran_jdl','id_pd_mk'));
							$data = 'data_jadwal';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'thn' => $thn,
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['status_thn_ajaran'])) {
					if ($post['status_thn_ajaran'] == 'true') {
						$status = 1;
					}
					else{
						$status = 0;
					}
					$data = array('status_jdl' => $status);
					$where = array('thn_ajaran_jdl' => $post['thn']);
					if ($status == 1) {
						$update_status_noaktif = $this->jadwal_model->update(array('status_jdl' => 0),array('status_jdl' => 1));
					}
					$update_status_aktif = $this->jadwal_model->update($data,$where);
					if ($update_status_aktif || $update_status_noaktif && $update_status_aktif) {
						$result = array(
							'status' => 'success',
							'status_user' => $status,
							);
					}
					else{
						$result = array(
							'status' => 'failed',
							'status_user' => $status,
							);
					}
				}
				elseif (isset($post['update_kelas'])) {
					if ($post['update_kelas'] == '') {
						if (isset($post['kls_mhs'])) {
							$var = explode('/', $post['kls_mhs']);
							$l_kls = $this->kelas_model->get_detail_data('get',NULL,NULL,array('id_kelas' => $var[1]),TRUE,array('id_jdl_kls','id_mhs_kls'),NULL,'id_kelas');
							$kelas_l = $l_kls->id_jdl_kls;
							$mhs = $l_kls->id_mhs_kls;
							$count = $this->kelas_model->count(array('id_jdl_kls' => $var[0], 'id_mhs_kls' => $mhs));
							if ($count == 0) {
								$status_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $var[0]),TRUE,array('status_jdl'));
								$status = $status_kelas->status_jdl;
								if (@$status == 1) {
									$data = array('id_jdl_kls' => $var[0]);
									$where = array('id_kelas' => $var[1]);
									$update_kelas = $this->kelas_model->update($data,$where);
									if ($update_kelas) {
										/*$select_daftar_mhs = array('id_kelas','id_jdl_kls','id AS in_mhs','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
										$data_mhs = $this->kelas_model->get_detail_data('get',array('jadwal','mahasiswa','thn_angkatan'),NULL,array('id_jdl' => $kelas_l),NULL,$select_daftar_mhs);*/
										$result = array(
											'status' => 'success',
											'data' => 'data_mhs_kls',
											/*'record_mhs' => $data_mhs,*/
											'c_kls' => $kelas_l,
											);
									}
									else{
										$result = array(
											'status' => 'failed',
											);
									}
								}
								else{
									$error = array('mhs-kelas' => 'Anda tidak bisa memindahkan kelas mahasiswa saat ini');
									$result = array('status' => 'failed', 'errors' => $error);
								}
							}
							else{
								$error = array('mhs-kelas' => 'Mahasiswa yang anda akan pindahkan ke dalam kelas ini sudah ada');
								$result = array('status' => 'failed', 'errors' => $error);
							}
						}
						else{
							$error = array('mhs-kelas' => 'Silahkan pilih kelas yang dituju');
							$result = array('status' => 'failed', 'errors' => $error);
						}
					}
					elseif ($post['update_kelas'] == 'data_mhs_kls'){
						if ($post['kls_mhs'] != '') {
							$var = explode('/', $post['kls_mhs']);
							$status_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $var[0]),TRUE,array('status_jdl'));
							$status = $status_kelas->status_jdl;
							if (@$status == 1) {
								foreach ($post['id'] as $key => $value_kelas) {
									$l_kls = $this->kelas_model->get_detail_data('get',NULL,NULL,array('id_kelas' => $value_kelas),TRUE,array('id_jdl_kls','id_mhs_kls'),NULL,'id_kelas');
									$kelas_l = $l_kls->id_jdl_kls;
									$mhs = $l_kls->id_mhs_kls;
									$count = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,array('id_jdl_kls' => $var[0], 'id_mhs_kls' => $mhs, 'status_jdl' => 1));
									if ($count == 0) {
										$data[] = array(
											'id_kelas' => $value_kelas,
											'id_jdl_kls' => $var[0],
											);
									}
								}
								if (isset($data)) {
									$update_kelas = $this->kelas_model->update($data,'id_kelas',TRUE);
								}
								if (isset($update_kelas) && $update_kelas > 0) {
									/*$select_daftar_mhs = array('id_kelas','id_jdl_kls','id AS in_mhs','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
									$data_mhs = $this->kelas_model->get_detail_data('get',array('jadwal','mahasiswa','thn_angkatan'),NULL,array('id_jdl' => $kelas_l),NULL,$select_daftar_mhs);*/
									$result = array(
										'status' => 'success',
										/*'record_mhs' => $data_mhs,*/
										'c_kls' => $kelas_l,
										);
								}
								else{
									$error = array('mhs-kelas' => 'Gagal memindahkan kelas mahasiswa, mahasiswa yang anda akan pindahkan ke dalam kelas ini sudah ada atau tahun akademik kelas ini sedang tidak aktif/diterapkan');
									$result = array('status' => 'failed', 'errors' => $error);
								}
							}
							else{
								$error = array('mhs-kelas' => 'Anda tidak bisa memindahkan kelas mahasiswa saat ini');
								$result = array('status' => 'failed', 'errors' => $error);
							}
						}
						else{
							$error = array('mhs-kelas' => 'Silahkan pilih kelas yang dituju');
							$result = array('status' => 'failed', 'errors' => $error);
						}
					}
				}
				elseif (isset($post['data_alumni'])) {
					$rules = $this->alumni_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						if (!isset($post['update'])) {
							$data_alumni = array(
								'tgl_lulus' => $post['tgl_lulus'],
								'tgl_yudisium' => $post['tgl_yudisium'],
								);
							$id_alumni = array('id_alni' => $post['in_mhs']);
							$update_data_alumni = $this->alumni_model->update($data_alumni,$id_alumni);
						}
						else{
							$data = array();
							foreach ($post['in_mhs'] as $key) {
								$id = explode('-',$key);
								$data[] = array(
									'id_mhs_alni' => $id[0],
									'tgl_lulus' => $post['tgl_lulus'],
									'tgl_yudisium' => $post['tgl_yudisium']
								);
							}
							$update_data_alumni = $this->alumni_model->update($data,'id_mhs_alni',TRUE);
						}

						if ($update_data_alumni) {
							$data = 'data_alumni';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in' => $post['in_mhs']
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				elseif (isset($post['data_mhs_do'])) {
					$rules = $this->mahasiswa_do_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						if (!isset($post['update'])) {
							$data_mhs_do = array(
								'tgl_drop_out' => $post['tgl_drop_out'],
								'drop_out_reason' => $post['drop_out_reason']
								);
							$id_mhs_do = array('id_DO' => $post['in_mhs']);
							$update_data_mhs_do = $this->mahasiswa_do_model->update($data_mhs_do,$id_mhs_do);
						}
						else{
							$data = array();
							foreach ($post['in_mhs'] as $key) {
								$id = explode('-',$key);
								$data[] = array(
									'id_mhs_DO' => $id[0],
									'tgl_drop_out' => $post['tgl_drop_out'],
									'drop_out_reason' => $post['drop_out_reason']
								);
							}
							$update_data_mhs_do = $this->mahasiswa_do_model->update($data,'id_mhs_DO',TRUE);
						}

						if ($update_data_mhs_do) {
							$data = 'data_mhs_do';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'in' => $post['in_mhs']
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else {
						$result = array(
							'status' => 'failed',
							'errors'=> $this->form_validation->error_array()
							);
					}
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'delete') {
				if (isset($post['data_mhs'])) {
					$id_mhs = $post['id_mhs'];

					$delete_mhs_by = array('id' => $id_mhs);
					$delete_ortu_by = array('id_mhs_ortu' => $id_mhs);
					$delete_user_by = array(
						'id_user_detail' => $id_mhs,
						'level_akses' => 'mhs'
						);

					$detail = $this->mahasiswa_model->get($id_mhs,TRUE);
					$delete_mhs = $this->mahasiswa_model->delete_by($delete_mhs_by);
					$delete_ortu = $this->ortu_model->delete_by($delete_ortu_by);
					$delete_user = $this->user_model->delete_by($delete_user_by);

					if ($delete_mhs && $delete_ortu && $delete_user) {
						$data = 'data_mhs';
						if ($detail->photo_mhs != '') {
							$this->load->helper('file');
							$check_file = get_file_info('uploads/mhs-photo/'.$detail->photo_mhs);
							if ($check_file != FALSE) {
								unlink('./uploads/mhs-photo/'.$detail->photo_mhs);
							}
						}
						$result = array(
							'status' => 'success',
							'data' => $data,
							'delete_id' => $id_mhs
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_ptk'])) {
					$id_ptk = $post['id_ptk'];
					$delete_ptk_by = array('id_ptk' => $id_ptk);
					$delete_user_by = array(
						'id_user_detail' => $id_ptk,
						'level_akses' => 'ptk'
						);

					$detail = $this->ptk_model->get($id_ptk,TRUE);
					$delete_ptk = $this->ptk_model->delete_by($delete_ptk_by);
					$delete_user = $this->user_model->delete_by($delete_user_by);

					if ($delete_ptk && $delete_user) {
						$data = 'data_ptk';
						if ($detail->photo_ptk != '') {
							$this->load->helper('file');
							$check_file = get_file_info('uploads/ptk-photo/'.$detail->photo_ptk);
							if ($check_file != FALSE) {
								unlink('./uploads/ptk-photo/'.$detail->photo_ptk);
							}
						}
						$result = array(
							'status' => 'success',
							'data' => $data,
							'delete_id' => $id_ptk
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_studi_ptk'])) {
					$id_studi = $post['id_studi'];
					$delete_studi = $this->ptk_studi_model->delete_by(array('id_studi' => $id_studi));
					if ($delete_studi) {
						$record_studi = array();
						if (isset($post['ptk_detail']) && $post['id_ptk_studi'] == $post['ptk_detail']) {
							$data_studi = $this->ptk_studi_model->get_detail_data('get',NULL,NULL,array('id_ptk_studi' => $post['ptk_detail']),NULL,array('id_studi AS in_studi','nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk'),NULL,'tgl_ijazah_ptk ASC');
							foreach ($data_studi as $key) {
								$arr = array('tgl_ijazah_ptk' => date_convert($key->tgl_ijazah_ptk));
								$record_studi[] = array_merge((array)$key,$arr);
							}
						}
						$data = 'data_studi_ptk';
						$result = array(
							'status' => 'success',
							'data' => $data,
							'in_ptk' => @$post['id_ptk_studi'],
							'studi_ptk' => $record_studi
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_penelitian_ptk'])) {
					$id_penelitian_ptk = $post['id_penelitian_ptk'];
					$delete_penelitian_ptk = $this->ptk_penelitian_model->delete_by(array('id_penelitian_ptk' => $id_penelitian_ptk));
					if ($delete_penelitian_ptk) {
						$record_penelitian = array();
						if (isset($post['ptk_detail']) && $post['id_ptk_rsch'] == $post['ptk_detail']) {
							$record_penelitian = $this->ptk_penelitian_model->get_detail_data('get',NULL,NULL,array('id_ptk_rsch' => $post['ptk_detail']),NULL,array('id_penelitian_ptk AS in_research','judul_penelitian','bidang_ilmu','lembaga'));
						}
						$data = 'data_penelitian_ptk';
						$result = array(
							'status' => 'success',
							'data' => $data,
							'in_ptk' => @$post['id_ptk_rsch'],
							'penelitian_ptk' => $record_penelitian
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_mk'])) {
					$id_mk = $post['id_mk'];
					$delete_mk_by = array('id_mk' => $id_mk);
					$delete_mk = $this->mata_kuliah_model->delete_by($delete_mk_by);

					if ($delete_mk) {
						$data = 'data_mk';
						$result = array(
							'status' => 'success',
							'data' => $data
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_jadwal_kuliah'])) {
					$var = explode('/', $post['id_jdl']);
					$status = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $var[0]),TRUE,array('status_jdl'));
					$status = $status->status_jdl;
					if ($status == 1) {
						$delete_jadwal_by = array('id_jdl' => $var[0]);
						$delete_jadwal = $this->jadwal_model->delete_by($delete_jadwal_by);

						if ($delete_jadwal) {
							$data = 'data_jadwal';
							$count_thn = $this->jadwal_model->get_detail_data('count',array('mata_kuliah'),NULL,array('id_thn_ak_jdl' => $var[2],'id_pd_mk' => $var[1]));
							$result = array(
								'status' => 'success',
								'data' => $data
								);
							if ($count_thn > 0) {
								$result['thn'] = $var[2];
								$result['pd'] = $var[1];
							}
							else{
								$result['thn'] = '';
							}
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else{
						$result = array(
							'status' => 'no_active_thn_jdl',
							'error_message' => 'Gagal menghapus jadwal, karena tahun akademik jadwal ini tidak aktif/diterapkan'
							);
					}
				}
				elseif (isset($post['data_mhs_kls'])) {
					$var = explode('/', $post['id_mhs_kls']);
					$id_mhs = $var[0];
					$id_kelas = $var[1];
					$status = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $id_kelas),TRUE,array('status_jdl'));
					$status = $status->status_jdl;
					if ($status == 1) {
						$delete_mhs_by = array('id_kelas' => $id_mhs);
						$delete_mhs_kls = $this->kelas_model->delete_by($delete_mhs_by);

						if ($delete_mhs_kls) {
							$data = 'data_mhs_kls';
							/*$select_daftar_mhs = array('id_kelas','id_jdl_kls','id AS in_mhs','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
							$data_mhs = $this->kelas_model->get_detail_data('get',array('mahasiswa','thn_angkatan'),NULL,array('id_jdl_kls' => $id_kelas),NULL,$select_daftar_mhs);*/
							$result = array(
								'status' => 'success',
								'data' => $data,
								/*'record_mhs' => $data_mhs,*/
								'c_kls' => $id_kelas,
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else{
						$result = array(
							'status' => 'no_active_thn_kls',
							'error_message' => 'Anda tidak bisa menghapus mahasiswa dari kelas ini karena tahun akademik kelas tidak sedang diterapkan'
							);
					}
				}
				elseif (isset($post['data_alumni'])) {
					$id_alumni = array('id_mhs_alni' => $post['in_mhs']);
					$delete_alumni = $this->alumni_model->delete_by($id_alumni);
					if ($delete_alumni) {
						$data = 'data_alumni';
						$result = array(
							'status' => 'success',
							'data' => $data,
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_mhs_do'])) {
					$id_mhs_do = array('id_mhs_DO' => $post['in_mhs']);
					$delete_mhs_do = $this->mahasiswa_do_model->delete_by($id_mhs_do);
					if ($delete_mhs_do) {
						$this->user_model->update(array('active_status' => 1),array('id_user_detail' => $post['in_mhs'], 'level_akses' => 'mhs'));
						$data = 'data_mhs_do';
						$result = array(
							'status' => 'success',
							'data' => $data,
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data'])) {
					if ($post['data'] == 'data_mhs') {
						if (isset($post['id']) && count($post['id']) > 0) {
							$id = $post['id'];
							$id_mhs = array();
							foreach ($id as $key) {
								$id_mhs[] = $key;
								$id = $key;
								/*$detail = $this->mahasiswa_model->get($id,TRUE);

								if ($detail->photo_mhs != '') {
									$photo_mhs[] = $detail->photo_mhs;
								}*/
							}

							$act = array(
								'in' => array(
									'id' => $id_mhs
								),
							);
							$photo = $this->mahasiswa_model->get_detail_data('get',NULL,$act,array('photo_mhs !=' => ''),FALSE,array('photo_mhs'));
							$photo_mhs = array();
							foreach ($photo as $key) {
								$photo_mhs[] = $key->photo_mhs;
							}

							$where_mhs = array(
								'id' => $id_mhs,
								);
							$where_ortu = array(
								'id_mhs_ortu' => $id_mhs,
								);
							$where_user = array(
								'id_user_detail' => $id_mhs,
								);

							$delete_mhs = $this->mahasiswa_model->delete_by(NULL,$where_mhs);
							$delete_ortu = $this->ortu_model->delete_by(NULL,$where_ortu);
							$delete_user = $this->user_model->delete_by(array('level_akses' => 'mhs'),$where_user);

							if ($delete_mhs && $delete_ortu && $delete_user) {
								if (count($photo_mhs) > 0) {
									$this->load->helper('file');
									foreach ($photo_mhs as $key) {
										$check_file = get_file_info('uploads/mhs-photo/'.$key);
										if ($check_file != FALSE) {
											unlink('./uploads/mhs-photo/'.$key);
										}
									}
								}
								$result = array(
									'status' => 'success',
									'delete_id' => $id_mhs
									);
							}
							else{
								$result = array('status' => 'failed_db');
							}
						}
						else{
							$result = array(
								'status' => 'no_record',
								'message' => 'Tidak ada mahasiswa yang dipilih'
							);
						}
					}
					elseif ($post['data'] == 'data_ptk') {
						if (isset($post['id']) && count($post['id']) > 0) {
							$id = $post['id'];
							$id_ptk = array();
							foreach ($id as $key) {
								$id_ptk[] = $key;
							}

							$act = array(
								'in' => array(
									'id_ptk' => $id_ptk
								),
							);
							$photo = $this->ptk_model->get_detail_data('get',NULL,$act,array('photo_ptk !=' => ''),FALSE,array('photo_ptk'));
							$photo_ptk = array();
							foreach ($photo as $key) {
								$photo_ptk[] = $key->photo_ptk;
							}

							$where_ptk = array(
								'id_ptk' => $id_ptk
								);
							$where_user = array(
								'id_user_detail' => $id_ptk,
								);

							$delete_ptk = $this->ptk_model->delete_by(NULL,$where_ptk);
							$delete_user = $this->user_model->delete_by(array('level_akses' => 'ptk'),$where_user);

							if ($delete_ptk && $delete_user) {
								if (count($photo_ptk) > 0) {
									$this->load->helper('file');
									foreach ($photo_ptk as $key) {
										$check_file = get_file_info('uploads/ptk-photo/'.$key);
										if ($check_file != FALSE) {
											unlink('./uploads/ptk-photo/'.$key);
										}
									}
								}
								$result = array(
									'status' => 'success',
									'delete_id' => $id_ptk
									);
							}
							else{
								$result = array('status' => 'failed_db');
							}
						}
						else{
							$result = array(
								'status' => 'no_record',
								'message' => 'Tidak ada tenaga pendidik yang dipilih'
							);
						}
					}
					elseif ($post['data'] == 'data_mk') {
						$id = $post['id'];
						$id_mk = array();
						foreach ($id as $key) {
							$id_mk[] = $key;
						}
						$where_mk = array('id_mk' => $id_mk);
						$delete_mk = $this->mata_kuliah_model->delete_by(NULL,$where_mk);
						if ($delete_mk) {
							$result = array('status' => 'success');
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					elseif ($post['data'] == 'data_jadwal_kuliah') {
						$id = $post['id'];
						$id_jdl_m = array();
						foreach ($id as $key) {
							$id_jdl = explode('/',$key);
							$where_jdl[] = $id_jdl[0];
							/*$check_thn = $this->jadwal_model->get_detail_data('count',array('thn_akademik'),NULL,array('id_jdl' => $id[0], 'status_jdl' => 1));
							if ($check_thn > 0) {
								$id_jdl_m[] = $id_jdl[0];
							}*/
						}

						if (isset($where_jdl)) {
							$act = array(
								'in' => array(
									'id_jdl' => $where_jdl,
									),
							);
							$check_thn = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),$act,array('status_jdl' => 1),FALSE,array('id_jdl'));
							foreach ($check_thn as $key) {
								$id_jdl_m[] = $key->id_jdl;
							}
							if (count($id_jdl_m) > 0) {
								$where_jdl = array(
									'id_jdl' => $id_jdl_m,
									);
								$delete_jdl = $this->jadwal_model->delete_by(NULL,$where_jdl);

								if ($delete_jdl) {
									$result = array(
											'status' => 'success',
											'thn' => explode('/',$id[0])[2],
											'pd' => explode('/',$id[0])[1],
											);
								}
								else{
									$result = array(
										'status' => 'failed_db',
										'message' => 'Gagal menghapus jadwal kuliah'
									);
								}
							}
							else{
								$result = array(
									'status' => 'no_record_delete',
									'message' => 'Data jadwal kuliah yang anda pilih tidak ditemukan / data telah dihapus / tahun akademik jadwal saat ini sedang tidak diterapkan'
								);
							}
						}
						else{
							$result = array(
								'status' => 'no_record',
								'message' => 'Tidak ada jadwal kuliah yang dipilih'
							);
						}
					}
					elseif ($post['data'] == 'data_mhs_kls') {
						if (isset($post['id']) && count($post['id']) > 0 && isset($post['kelas']) && $post['kelas'] != '') {
							$act = array(
								'in' => array('id_kelas' => $post['id']),
							);
							$status_thn = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik'),$act,array('id_jdl_kls' => $post['kelas'], 'status_jdl' => 1),FALSE,array('id_kelas'),NULL,'id_kelas ASC');
							$id_mhs_kls = array();
							foreach ($status_thn as $key) {
								$id_mhs_kls[] = $key->id_kelas;
							}

							if (count($id_mhs_kls) > 0) {
								$delete_in = array(
									'id_kelas' => $id_mhs_kls
									);
								$delete_mhs_kls = $this->kelas_model->delete_by(NULL,$delete_in);
								if ($delete_mhs_kls) {
									/*$select_daftar_mhs = array('id_kelas','id_jdl_kls','id AS in_mhs','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
									$data_mhs = $this->kelas_model->get_detail_data('get',array('mahasiswa','thn_angkatan'),NULL,array('id_jdl_kls' => $post['kelas']),NULL,$select_daftar_mhs);*/
									$result = array(
										'status' => 'success',
										'c_kls' => $post['kelas'],
										/*'record_mhs' => $data_mhs,
										'delete' => $delete_mhs_kls,*/
										);
								}
								else{
									$result = array('status' => 'failed_db');
								}
							}
							else{
								$result = array(
									'status' => 'failed',
									'message' => 'Anda tidak bisa menghapus mahasiswa dari kelas ini karena tahun akademik kelas tidak sedang diterapkan');
							}
						}
						elseif (!isset($post['id']) || count($post['id']) < 1) {
							$result = array(
								'status' => 'failed',
								'message' => 'Silahkan pilih mahasiswa yang akan dihapus dari kelas ini');
						}
						elseif (!isset($post['kelas']) || $post['kelas'] == '') {
							$result = array(
								'status' => 'failed',
								'message' => 'Kelas mahasiswa yang anda pilih tidak ditemukan');
						}
					}
					elseif ($post['data'] == 'data_alumni') {
						$id = $post['id'];
						$id_alumni = array();
						foreach ($id as $key) {
							$vars = explode('-',$key);
							if ($vars[1] == 'alumni') {
								$id_alumni[] = $vars[0];
							}
						}

						$where_alumni = array(
							'id_mhs_alni' => $id_alumni,
							);
						$delete_alumni = $this->alumni_model->delete_by(NULL,$where_alumni);
						if ($delete_alumni) {
							$result = array(
								'status' => 'success',
								'delete_id' => $id_alumni
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					elseif ($post['data'] == 'data_mhs_do') {
						$id = $post['id'];
						$id_mhs_do = array();
						foreach ($id as $key) {
							$vars = explode('-',$key);
							if ($vars[1] == 'do') {
								$user_batch[] = array(
									'id_user_detail' => $vars[0],
									'active_status' => 1
								);
								$id_mhs_do[] = $vars[0];
							}
						}

						if (count($id_mhs_do) > 0) {
							$where_mhs_do = array(
								'id_mhs_DO' => $id_mhs_do,
								);
							$delete_mhs_do = $this->mahasiswa_do_model->delete_by(NULL,$where_mhs_do);
							if ($delete_mhs_do) {
								$this->db->where(array('level_akses' => 'mhs'));
								$update_status_u = $this->user_model->update($user_batch,'id_user_detail',TRUE);
								$result = array(
									'status' => 'success',
									'delete_id' => $id_mhs_do
									);
							}
							else{
								$result = array('status' => 'failed_db');
							}
						}
						else{
							$result = array('status' => 'no_record_delete');
						}
					}
					else{
						$result = array('status_action' => 'Not find...');
					}
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'update_pd') {
				$id = $post['id'];
				if (!empty($post['pd'])) {
					$pd = array();
					foreach ($id as $key) {
						$id_mhs = explode(' ',$key);
						$pd[] = array(
							'id' => $id_mhs[0],
							'id_pd_mhs' => $post['pd'],
							);
					}
					$pindah = $this->mahasiswa_model->update($pd,'id',TRUE);
					if ($pindah > 0) {
						$result = array('status' => 'success');
					}
					elseif ($pindah == 0){
						$result = array(
							'status' => 'zero_change',
							'error_message' => 'Program studi yang anda pilih merupakan program studi mahasiswa yang sekarang, silahkan pilih program studi yang lain'
						);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				else{
					$result = array(
						'status' => 'empty-ch',
						'error_message' => 'Tolong pilih program studi'
					);
				}
			}
			elseif ($param == 'update_pd_mk') {
				$id = $post['id'];
				if ($post['mk_j'] != '') {
					$this->konsentrasi = $post['mk_j'];
					$this->mk_pd = $post['id_pd_mk'];
					$konsentrasi = $post['mk_j'];
				}
				else{
					$konsentrasi = 0;
				}
				$this->form_validation->set_rules($this->mata_kuliah_model->mk_update_rules);

				if ($this->form_validation->run() == TRUE) {
					$pd = array();
					$no = 0;
					foreach ($id as $key) {
						$id_mk = $key;
						$pd[$no] = array(
							'id_mk' => $id_mk,
							);
						if ($post['id_pd_mk'] != '') {
							$pd[$no] = array_merge($pd[$no],array('id_pd_mk' => $post['id_pd_mk']));
						}
						if ($post['sks'] != '') {
							$pd[$no] = array_merge($pd[$no],array('jml_sks' => $post['sks']));
						}
						if ($post['mk_j'] != '') {
							$pd[$no] = array_merge($pd[$no],array('jenis_jdl' => $konsentrasi));
						}
						$no++;
					}
					$update = $this->mata_kuliah_model->update($pd,'id_mk',TRUE);
					if ($update > 0) {
						$result = array('status' => 'success');
					}
					elseif ($update == 0){
						$result = array(
							'status' => 'zero_change',
							'errors_message' => 'Gagal memperbahrui, karena data baru yang anda masukkan sama dengan data lama mata kuliah',
							);
					}
					else{
						$result = array(
							'status' => 'failed_db',
							'errors_message' => 'Maaf terjadi kesalahan dalam memperbahrui program studi data mata kuliah',
							);
					}
				}
				else{
					$errors = $this->form_validation->error_array();
					$result = array(
						'status' => 'errors_pd',
						'errors' => $errors
						);
				}
			}
			else{
				$result = array('status_action' => 'Not find...');
			}
			$result['n_token'] = $this->security->get_csrf_hash();
			echo json_encode($result);
		}
		else{
			$result = array(
				"success" => FALSE,
				"info" => "Service not found or not set",
				'n_token' => $this->security->get_csrf_hash()
				);
			echo json_encode($result);
		}
	}

	public function data_table_request($param){
		$post = $this->input->post(NULL, TRUE);
		if ($param == 'data_mahasiswa') {
			/*Serverside Processing*/
			$fetch_data = $this->mahasiswa_model->make_datatables();
			$data = array();
			$no  = 1;
			foreach($fetch_data as $row){
				$arr = array('no' => $post['start']+$no, );
				$data[]      = array_merge($arr,(array)$row);
				$no++;
			}
			$output = array(
				"draw"            => intval($post["draw"]),
				"recordsTotal"    => $this->mahasiswa_model->get_all_data(),
				"recordsFiltered" => $this->mahasiswa_model->get_filtered_data(),
				"data"            => $data
			);

			/*$select = array('nisn','nama','kelas','thn_angkatan','alamat','id');
			$data_siswa = $this->mahasiswa_model->get_by_search(NULL,FALSE,$select);
			$json_result = '{"data" : [';
			$i=0;
			foreach ($data_siswa as $data => $value) {
				if ($i != 0) {
					$json_result .=',';
				}
				$json_result .=json_encode($value);
				$i++;
			}
			$json_result .= ']}';*/
		}
		elseif ($param == 'data_mahasiswa_ak') {
			/*Serverside Processing*/
			$fetch_data = $this->kelas_model->make_datatables();
			$data = array();
			$no  = 1;
			foreach($fetch_data as $row){
				$arr = array('no' => $post['start']+$no, );
				$data[]      = array_merge($arr,(array)$row);
				$no++;
			}
			$output = array(
				"draw"            => intval($post["draw"]),
				"recordsTotal"    => $this->kelas_model->get_all_data(),
				"recordsFiltered" => $this->kelas_model->get_filtered_data(),
				"data"            => $data
			);
		}
		elseif ($param == 'data_mahasiswa_alni_do') {
			/*Serverside Processing*/
			$fetch_data = $this->mahasiswa_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				if (isset($row->tgl_lulus)) {
					$arr = array('data_mhs' => 'alumni',);
				}
				elseif (isset($row->tgl_drop_out)) {
					$arr = array('data_mhs' => 'do',);
				}
				$data[]      = array_merge((array)$row,$arr);
			}
			$output = array(
				"draw"            => intval($post["draw"]),
				"recordsTotal"    => $this->mahasiswa_model->get_all_data(),
				"recordsFiltered" => $this->mahasiswa_model->get_filtered_data(),
				"data"            => $data
			);
		}
		elseif ($param == 'data_ptk') {
			$fetch_data = $this->ptk_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				$arr = array(
					'status_aktif_ptk' => select_conv_value($row->status_aktif_ptk,'ptk','status_aktif_ptk'),
					);
				$data[]      = array_merge((array)$row,$arr);
			}
			$output = array(
				"draw"            => intval($post["draw"]),
				"recordsTotal"    => $this->ptk_model->get_all_data(),
				"recordsFiltered" => $this->ptk_model->get_filtered_data(),
				"data"            => $data
			);
		}
		elseif ($param == 'data_mk') {
			$count = $this->mata_kuliah_model->count(array('id_pd_mk' => $post['pd']));
			$pd = $this->prodi_model->get_detail_data('get',array('fakultas'),NULL,array('id_prodi' => $post['pd']),FALSE,array('nama_fakultas','nama_prodi','jenjang_prodi','kode_prodi','nama_kprodi','status_prodi'));
			if ($post['act'] == 'single-tbl') {
				if ($count > 0) {
					$data_mk = $this->mata_kuliah_model->get_detail_data('get',array('konsentrasi_pd'),NULL,array('id_pd_mk' => $post['pd']),FALSE,list_fields(array('mata_kuliah'),array('nm_konsentrasi')));
					$output = array(
						"total_rows" => $count,
						"record_mk" => $data_mk
					);
				}
				else{
					$output = array(
						"total_rows"    => $count
					);
				}
			}
			else{
				if ($count % 2 == 0) {
					$length = $count/2;
					$length2 = $count/2;
					$start = $length2;
				}
				else{
					$even = $count-1;
					$change = $even/2;
					$length = $change+1;
					$length2 = $change;
					$start = $change+1;
				}
				if ($count > 0) {
					if ($count > 1) {
						$act = array(
							'offset' => array($length,0)
							);
						$data_mk1 = $this->mata_kuliah_model->get_detail_data('get',array('konsentrasi_pd'),$act,array('id_pd_mk' => $post['pd']),FALSE,list_fields(array('mata_kuliah'),array('nm_konsentrasi')));
						$act = array(
							'offset' => array($length2,$start)
							);
						$data_mk2 = $this->mata_kuliah_model->get_detail_data('get',array('konsentrasi_pd'),$act,array('id_pd_mk' => $post['pd']),FALSE,list_fields(array('mata_kuliah'),array('nm_konsentrasi')));
						$output = array(
							"total_rows"    => $count,
							"record_mk1" => $data_mk1,
							"record_mk2" => $data_mk2
						);
					}
					elseif ($count == 1){
						$act = array(
							'offset' => array($length,0)
							);
						$data_mk1 = $this->mata_kuliah_model->get_detail_data('get',array('konsentrasi_pd'),$act,array('id_pd_mk' => $post['pd']),FALSE,list_fields(array('mata_kuliah'),array('nm_konsentrasi')));
						$output = array(
							"total_rows"    => $count,
							"record_mk1" => $data_mk1,
						);
					}
				}
				else{
					$output = array(
						"total_rows"    => $count
					);
				}
			}

			$output['prodi'] = $pd;
		}
		elseif ($param == 'daftar_jadwal') {
			/*Serverside Processing*/
			$fetch_data = $this->jadwal_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				$data[]      = $row;
			}
			$output = array(
				"draw"            => intval($post["draw"]),
				"recordsTotal"    => $this->jadwal_model->get_all_data(),
				"recordsFiltered" => $this->jadwal_model->get_filtered_data(),
				"data"            => $data
			);
		}
		$output['n_token'] = $this->security->get_csrf_hash();
		echo json_encode($output);
	}

	public function upload_file(){
		$post = $this->input->post(NULL, TRUE);
		$config = array(
			'allowed_types' => 'jpg|jpeg|png',
			'max_size' => '1024',
			'max_width' => 512,
	        'max_height' => 512,
	        'min_width' => 312,
	        'min_height' => 312,
			'overwrite' => TRUE,
			);
		if ($post['pt'] == 'mhs') {
			$detail = $this->mahasiswa_model->get($post['data'],TRUE);
			if ($detail) {
				$config_mhs_photo = array(
					'upload_path' => './uploads/mhs-photo/',
					'file_name' => rand_val().md5($detail->id).rand_val().'-mhs',
					);
				$config = array_merge($config_mhs_photo,$config);
				/*$config['upload_path'] = './uploads/mhs-photo/';
				$config['file_name'] = md5($detail->id).'-mhs';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '1024';
				$config['max_width'] = 512;
	            $config['max_height'] = 512;
	            $config['min_width'] = 312;
	            $config['min_height'] = 312;
				$config['overwrite'] = TRUE;*/
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('photo_mhs')) {
					if (stristr($this->upload->display_errors(), 'dimensions') == TRUE) {
						$error = '<li>Dimensi / ukuran foto "<b>'.$_FILES["photo_mhs"]["name"].'</b>" yang diupload tidak sesuai!</li>';
					}
					elseif (stristr($this->upload->display_errors(), 'permitted size') == TRUE) {
						$error = '<li>Ukuran file foto "<b>'.$_FILES["photo_mhs"]["name"].'</b>" yang diupload melebihi ukuran upload maksimal yaitu 1024 KB!</li>';
					}
					elseif (stristr($this->upload->display_errors(), 'filetype') == TRUE) {
						$error = '<li>Format / ekstensi foto yang diupload tidak diizinkan!. Hanya ekstensi "jpg, jpeg, png" yang diizinkan.</li>';
					}
					else{
						$error = $this->upload->display_errors('<li>','</li>');
					}
					$result = array('status' => 'failed', 'errors' => $error);
				}
				else{
					$photo_name = $this->upload->data('file_name');
					if ($detail->photo_mhs !='') {
						if ($photo_name != $detail->photo_mhs) {
							$this->load->helper('file');
							$check_file = get_file_info('uploads/mhs-photo/'.$detail->photo_mhs);
							if ($check_file != FALSE) {
								unlink('./uploads/mhs-photo/'.$detail->photo_mhs);
							}
						}
					}
					$data = array(
						'photo_mhs' => $photo_name,
						);
					$update = $this->mahasiswa_model->update($data,array('id' => $post['data']));
					if ($update) {
						if (isset($post['upload_act'])) {
							$this->load->helper('file');
							$check_file = get_file_info('uploads/mhs-photo/'.$photo_name);
							if ($check_file != FALSE) {
								$photo = photo_u('mhs',$photo_name.'?n_img='.rand_val(20));
								$file_name = $photo_name;
							}
							else{
								$photo = photo_u();
							}
						}
						$result = array(
							'status' => 'success',
							'photo_c' => @$photo,
							'file_name' => @$file_name
						);
					}
					else{
						unlink('./uploads/mhs-photo/'.$photo_name);
						$result = array('status' => 'failed_db');
					}
				}
			}
			else{
				$result = array('status' => 'failed');
			}
		}
		elseif ($post['pt'] == 'ptk') {
			$detail = $this->ptk_model->get($post['data'],TRUE);
			$config_ptk_photo = array(
				'upload_path' => './uploads/ptk-photo/',
				'file_name' => rand_val().md5($detail->id_ptk).rand_val().'-ptk',
				);
			$config = array_merge($config_ptk_photo,$config);
			/*$config['upload_path'] = './uploads/ptk-photo/';
			$config['file_name'] = md5($detail->id_ptk).'-ptk';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['max_width'] = 512;
            $config['max_height'] = 512;
            $config['min_width'] = 312;
            $config['min_height'] = 312;
			$config['overwrite'] = TRUE;
			$ext = pathinfo($_FILES['photo_ptk']['name'],PATHINFO_EXTENSION);*/
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('photo_ptk')) {
				if (stristr($this->upload->display_errors(), 'dimensions') == TRUE) {
					$error = '<li>Dimensi / ukuran foto "<b>'.$_FILES["photo_ptk"]["name"].'</b>" yang diupload tidak sesuai!</li>';
				}
				elseif (stristr($this->upload->display_errors(), 'permitted size') == TRUE) {
					$error = '<li>Ukuran file foto "<b>'.$_FILES["photo_ptk"]["name"].'</b>" yang diupload melebihi ukuran upload maksimal yaitu 1024 KB!</li>';
				}
				elseif (stristr($this->upload->display_errors(), 'filetype') == TRUE) {
					$error = '<li>Format / ekstensi foto yang diupload tidak diizinkan!. Hanya ekstensi "jpg, jpeg, png" yang diizinkan.</li>';
				}
				else{
					$error = $this->upload->display_errors('<li>','</li>');
				}
				$result = array('status' => 'failed', 'errors' => $error);
			}
			else{
				$photo_name = $this->upload->data('file_name');
				if ($detail->photo_ptk !='') {
					if ($photo_name != $detail->photo_ptk) {
						$this->load->helper('file');
						$check_file = get_file_info('uploads/ptk-photo/'.$detail->photo_ptk);
						if ($check_file != FALSE) {
							unlink('./uploads/ptk-photo/'.$detail->photo_ptk);
						}
					}
				}
				$data = array(
					'photo_ptk' => $photo_name,
					);
				$update = $this->ptk_model->update($data,array('id_ptk' => $post['data']));
				if ($update) {
					if (isset($post['upload_act'])) {
						$this->load->helper('file');
						$check_file = get_file_info('uploads/ptk-photo/'.$photo_name);
						if ($check_file != FALSE) {
							$photo = photo_u('ptk',$photo_name.'?n_img='.rand_val(20));
							$file_name = $photo_name;
						}
						else{
							$photo = photo_u();
						}
					}
					$result = array(
						'status' => 'success',
						'photo_c' => @$photo,
						'file_name' => @$file_name
					);
				}
				else{
					unlink('./uploads/ptk-photo/'.$photo_name);
					$result = array('status' => 'failed_db');
				}
			}
		}
		$result['n_token'] = $this->security->get_csrf_hash();
		echo json_encode($result);
	}

	public function delete_file(){
		$post = $this->input->post(NULL, TRUE);
		if ($post['data'] == 'photo') {
			if ($post['photo'] == 'mhs') {
				$detail = $this->mahasiswa_model->get($post['id_photo'],TRUE);
				if ($detail->photo_mhs != '') {
					$this->load->helper('file');
					$check_file = get_file_info('uploads/mhs-photo/'.$detail->photo_mhs);
					if ($check_file != FALSE) {
						unlink('./uploads/mhs-photo/'.$detail->photo_mhs);
					}
					$update_photo = $this->mahasiswa_model->update(array('photo_mhs' => ''),array('id' => $post['id_photo']));
					if ($update_photo) {
						$result = array(
							'status' => 'success',
							'default_photo' => photo_u()
						);
					}
					else{
						$result = array('status' => 'failed');
					}
				}
				else{
					$result = array(
						'status' => 'success',
						'default_photo' => photo_u()
					);
				}
			}
			elseif ($post['photo'] == 'ptk') {
				$detail = $this->ptk_model->get($post['id_photo'],TRUE);
				if ($detail->photo_ptk != '') {
					$this->load->helper('file');
					$check_file = get_file_info('uploads/ptk-photo/'.$detail->photo_ptk);
					if ($check_file != FALSE) {
						unlink('./uploads/ptk-photo/'.$detail->photo_ptk);

					}
					$update_photo = $this->ptk_model->update(array('photo_ptk' => ''),array('id_ptk' => $post['id_photo']));
					if ($update_photo) {
						$result = array(
							'status' => 'success',
							'default_photo' => photo_u()
						);
					}
					else{
						$result = array('status' => 'failed');
					}
				}
				else{
					$result = array(
						'status' => 'success',
						'default_photo' => photo_u()
					);
				}
			}
		}
		else{
			$result = array('status_action' => 'Not find...');
		}
		$result['n_token'] = $this->security->get_csrf_hash();
		echo json_encode($result);
	}

	public function data_statistik($param){
		$post = $this->input->post(NULL, TRUE);
		if ($param == 'alumni') {
			$daftar_pd = $this->prodi_model->get_by_search(NULL,FALSE,array('id_prodi','nama_prodi','jenjang_prodi'));
			$count_mhs = $this->alumni_model->get_detail_data('count',array('mhs'));
			$prodi = array();
			$canvas = array();
			$nama_prodi = array();
			$mhs_lk = array();
			$mhs_pr = array();
			$color = array();
			$no = 0;
			$pd = 1;
			foreach ($daftar_pd as $key) {
				$count_mhs_pd = $this->alumni_model->get_detail_data('count',array('mhs','prodi_mhs'),NULL,array('id_pd_mhs' => $key->id_prodi));
				$statik_mhs_pd = $count_mhs_pd/$count_mhs*100;
				$detail_grafik = array(
					'id_prodi' => rand_val(),
					'count_mhs' => number_format($count_mhs_pd,0,',','.'),
					'statik_mhs' => round($statik_mhs_pd),
					'color_detail' => color_pd_static($no),
					'no_prodi' => 'Prodi '.$pd
					);
				$prodi[] = array_merge((array)$key,$detail_grafik);
				$canvas[] = array(
					'value' => $count_mhs_pd,
					'color' => color_pd_static($no),
					'highlight' => color_pd_static($no),
					'label' => $key->nama_prodi.' ('.$key->jenjang_prodi.')',
					);
				$nama_prodi[] = 'Prodi '.$pd;
				$color[] = color_pd_static($no);
				$mhs_lk[] = $this->alumni_model->get_detail_data('count',array('mhs','prodi_mhs'),NULL,array('id_pd_mhs' => $key->id_prodi,'jk' => 'L'));
				$mhs_pr[] = $this->alumni_model->get_detail_data('count',array('mhs','prodi_mhs'),NULL,array('id_pd_mhs' => $key->id_prodi,'jk' => 'P'));
				$no++;
				$pd++;
			}
			$result = array(
				'pd' => $prodi,
				'canvas' => $canvas,
				'nama_prodi' => $nama_prodi,
				'mhs_lk' => $mhs_lk,
				'mhs_pr' => $mhs_pr,
				'color' => $color,
				);
		}
		elseif ($param == 'mhs_do') {
			$daftar_pd = $this->prodi_model->get_by_search(NULL,FALSE,array('id_prodi','nama_prodi','jenjang_prodi'));
			$count_mhs = $this->mahasiswa_do_model->get_detail_data('count',array('mhs'));
			$prodi = array();
			$canvas = array();
			$nama_prodi = array();
			$mhs_lk = array();
			$mhs_pr = array();
			$color = array();
			$no = 0;
			$pd = 1;
			foreach ($daftar_pd as $key) {
				$count_mhs_pd = $this->mahasiswa_do_model->get_detail_data('count',array('mhs','prodi_mhs'),NULL,array('id_pd_mhs' => $key->id_prodi));
				$statik_mhs_pd = $count_mhs_pd/$count_mhs*100;
				$detail_grafik = array(
					'id_prodi' => rand_val(),
					'count_mhs' => number_format($count_mhs_pd,0,',','.'),
					'statik_mhs' => round($statik_mhs_pd),
					'color_detail' => color_pd_static($no),
					'no_prodi' => 'Prodi '.$pd
					);
				$prodi[] = array_merge((array)$key,$detail_grafik);
				$canvas[] = array(
					'value' => $count_mhs_pd,
					'color' => color_pd_static($no),
					'highlight' => color_pd_static($no),
					'label' => $key->nama_prodi.' ('.$key->jenjang_prodi.')',
					);
				$nama_prodi[] = 'Prodi '.$pd;
				$color[] = color_pd_static($no);
				$mhs_lk[] = $this->mahasiswa_do_model->get_detail_data('count',array('mhs','prodi_mhs'),NULL,array('id_pd_mhs' => $key->id_prodi,'jk' => 'L'));
				$mhs_pr[] = $this->mahasiswa_do_model->get_detail_data('count',array('mhs','prodi_mhs'),NULL,array('id_pd_mhs' => $key->id_prodi,'jk' => 'P'));
				$no++;
				$pd++;
			}
			$result = array(
				'pd' => $prodi,
				'canvas' => $canvas,
				'nama_prodi' => $nama_prodi,
				'mhs_lk' => $mhs_lk,
				'mhs_pr' => $mhs_pr,
				'color' => $color,
				);
		}
		$result['n_token'] = $this->security->get_csrf_hash();
		echo json_encode($result);
	}

	public function nisn_check($string){
		$id_mhs = $this->id_mhs;
		if (empty($id_mhs)) {
			$nisn = array('nisn' => $string);
			$check = $this->mahasiswa_model->count($nisn);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$act = array(
				'not_in' => array(
					'id' => array($id_mhs),
					),
				);
			$nisn = array('nisn' => $string,);
			$check = $this->mahasiswa_model->get_detail_data('count',NULL,$act,$nisn);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function kode_mk_check($string){
		$kode_mk_s = $this->id_mk;
		$pd = $this->mk_pd;
		if (!empty($kode_mk_s)) {
			$act = array(
				'not_in' => array(
					'id_mk' => array($kode_mk_s),
					),
				);
			$kode_check = array('kode_mk' => $string, 'id_pd_mk' => $pd);
			$check = $this->mata_kuliah_model->get_detail_data('count',NULL,$act,$kode_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$kode_check = array('kode_mk' => $string, 'id_pd_mk' => $pd);
			$check = $this->mata_kuliah_model->count($kode_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function mk_check($string){
		$mk_s = $this->id_mk;
		$pd = $this->mk_pd;
		$konsentrasi = $this->konst_add;
		if (!empty($mk_s)) {
			$act = array(
				'not_in' => array(
					'id_mk' => array($mk_s),
					),
				'in' => array(
					'jenis_jdl' => array($konsentrasi),
					)
				);
			$kode_check = array('nama_mk' => $string, 'id_pd_mk' => $pd);
			$check = $this->mata_kuliah_model->get_detail_data('count',NULL,$act,$kode_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$act = array(
				'in' => array(
					'jenis_jdl' => array($konsentrasi),
					),
				);
			$mk_check = array('nama_mk' => $string, 'id_pd_mk' => $pd);
			$check = $this->mata_kuliah_model->get_detail_data('count',NULL,$act,$mk_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function nuptk_check($string){
		$id_ptk = $this->id_ptk;
		if (empty($id_ptk)) {
			if (!empty($string)) {
				$nuptk_check = array('nuptk' => $string);
				$check = $this->ptk_model->count($nuptk_check);
				if ($check > 0) {
					return FALSE;
				}
				else{
					return TRUE;
				}
			}
			else{
				return TRUE;
			}
		}
		else{
			$act = array(
				'not_in' => array(
					'id_ptk' => array($id_ptk),
					),
				);
			$nidn = array('nuptk' => $string,);
			$check = $this->ptk_model->get_detail_data('count',NULL,$act,$nidn);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function nip_check($string){
		$id_ptk = $this->id_ptk;
		if (empty($id_ptk)) {
			if (!empty($string)) {
				$nip_check = array('nip' => $string);
				$check = $this->ptk_model->count($nip_check);
				if ($check > 0) {
					return FALSE;
				}
				else{
					return TRUE;
				}
			}
			else{
				return TRUE;
			}
		}
		else{
			$act = array(
				'not_in' => array(
					'id_ptk' => array($id_ptk),
					),
				);
			$nip = array('nip' => $string,);
			$check = $this->ptk_model->get_detail_data('count',NULL,$act,$nip);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function pd_check_ex($string){
		$post = $this->input->post(NULL, TRUE);
		if ($string != '') {
			$check = $this->prodi_model->count(array('id_prodi' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('pd_check_ex', 'Maaf, program studi yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			if (!isset($post['mk_j'])) {
				$this->form_validation->set_message('pd_check_ex', 'Tolong pilih program studi');
				return FALSE;
			}
			else{
				if ($string == '' && $post['sks'] == '' && $post['mk_j'] == '') {
					$this->form_validation->set_message('pd_check_ex', 'Masukkan salah satu data yang ingin diperbahrui');
					return FALSE;
				}
			}
		}
	}

	public function thn_angkatan_mhs_c($string){
		if ($string != '') {
			$check = $this->thn_angkatan_model->count(array('id_thn_angkatan' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('thn_angkatan_mhs_c', 'Maaf, tahun angkatan yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('thn_angkatan_mhs_c', 'Tolong pilih tahun angkatan');
			return FALSE;
		}
	}

	public function mk_check_c($string){
		if ($string != '') {
			$check = $this->mata_kuliah_model->count(array('id_mk' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('mk_check_c', 'Maaf, mata kuliah yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('mk_check_c', 'Tolong pilih kuliah');
			return FALSE;
		}
	}

	public function check_konst($string){
		if ($string != '') {
			$pd_mk = $this->mk_pd;
			$konsentrasi_pd = $this->konsentrasi;
			if ($pd_mk != NULL || $konsentrasi_pd != NULL) {
				if ($konsentrasi_pd != NULL) {
					if ($pd_mk == '') {
						$this->form_validation->set_message('check_konst', 'Tolong pilih program studi');
						return FALSE;
					}
				}

				$check = $this->konsentrasi_pd_model->count(array('id_konst' => $string, 'id_pd_konst' => $pd_mk));
				if ($check > 0) {
					return TRUE;
				}
				else{
					$this->form_validation->set_message('check_konst', 'Maaf, konsentrasi yang anda pilih tidak sesuai dengan program studi yang anda pilih / konsentrasi yang anda pilih tidak ada dalam database');
					return FALSE;
				}
			}
			else{
				$check = $this->konsentrasi_pd_model->count(array('id_konst' => $string));
				if ($check > 0) {
					return TRUE;
				}
				else{
					$this->form_validation->set_message('check_konst', 'Maaf, konsentrasi yang anda pilih tidak ada dalam database');
					return FALSE;
				}
			}
		}
		else{
			return TRUE;
		}
	}

	public function ptk_check_c($string){
		if ($string != '') {
			$check = $this->ptk_model->count(array('id_ptk' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('ptk_check_c', 'Maaf, dosen yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('ptk_check_c', 'Tolong pilih dosen');
			return FALSE;
		}
	}

	public function check_jam($string){
		$jam_awal = $this->jam_awal;
		if ($jam_awal != '') {
			if ($string != '') {
				if ($string > $jam_awal) {
					return TRUE;
				}
				else{
					$this->form_validation->set_message('check_jam', 'Jam akhir kuliah harus lebih besar dari pada jam awal kuliah');
					return FALSE;
				}
			}
			else{
				$this->form_validation->set_message('check_jam', 'Tolong masukkan jam akhir kuliah');
				return FALSE;
			}
		}
		else{
			return TRUE;
		}
	}

	public function check_status_thn($string){
		$thn = $string;
		if ($thn != '') {
			$check_thn = $this->thn_ajaran_model->count(array('id_thn_ak' => $string, 'status_jdl' => 1));
			if ($check_thn > 0) {
				return TRUE;
			}
			else{
				$check_thn = $this->thn_ajaran_model->count(array('id_thn_ak' => $string));
				if ($check_thn > 0) {
					$this->form_validation->set_message('check_status_thn', 'Maaf, tahun akademik yang anda pilih untuk saat ini tidak sedang diterapkan');
					return FALSE;
				}
				else{
					$this->form_validation->set_message('check_status_thn', 'Maaf, tahun akademik yang anda pilih tidak ada dalam database');
					return FALSE;
				}
			}
		}
		else{
			$this->form_validation->set_message('check_status_thn', 'Tolong pilih tahun akademik');
			return FALSE;
		}
	}

	/*function created_dummy_data($param){
		if ($param == 'mhs') {
			$mhs_user = array();
			$mhs_ortu = array();
			$no = 1;
			$nim = 1704411001;
			for ($i=1; $i <= 50 ; $i++) {
				if ($i <= 25) {
					$jk = 'L';
				}
				else{
					$jk = 'P';
				}
				$data = array(
					'id_pd_mhs' => 36,
					'thn_angkatan' => 12,
					'nisn' => $nim,
					'nama' => 'MHS - TI '.$no,
					'jk' => $jk,
					'tmp_lhr' => 'Palopo',
					'tgl_lhr' => '1997-08-14',
					'agama' => 'Islam',
					'alamat' => 'TEST '.$no,
				);
				$no++;
				$nim++;
				$insert = $this->mahasiswa_model->insert($data);
				if ($insert) {
					$mhs_user[] = array(
						'id_user_detail' => $insert,
						'level_akses' => 'mhs',
						'active_status' => 1,
					);
					$mhs_ortu[] = array(
						'id_mhs_ortu' => $insert
					);
				}
			}

			if (count($mhs_user) > 0) {
				$this->user_model->insert($mhs_user,TRUE);
			}
			if (count($mhs_ortu) > 0) {
				$this->ortu_model->insert($mhs_ortu,TRUE);
			}
		}
	}*/

}
