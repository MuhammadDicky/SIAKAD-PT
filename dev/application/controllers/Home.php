<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Frontend_Controller {

	protected $current_pass;

	public function __construct(){
		parent::__construct();		
		$this->site->login_status_check();
	}
	
	public function index(){
		$hari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat','Sabtu','Minggu');
		if ($_SESSION['level_akses'] == 'mhs') {
			$jumlah_ak_mhs = $this->kelas_model->get_detail_data('count',array('jadwal'),NULL,array('id_mhs_kls' => $_SESSION['id_mhs']),FALSE,NULL,array('id_thn_ak_jdl'));
			$jumlah_studi = $this->kelas_model->count(array('id_mhs_kls' => $_SESSION['id_mhs']));
			
			/*$jadwal_kelas = array('id_mhs_kls' => $_SESSION['id_mhs'], 'hari_jdl' => $hari[date('N')], 'status_jdl' => 1);
			$select_jadwal = array('jam_mulai_jdl','jam_akhir_jdl','semester','kelas','ruang','nama_mk','jml_sks','nama_ptk');
			$count_jadwal = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,$jadwal_kelas);
			$record_jadwal = $this->kelas_model->get_kelas_mhs($jadwal_kelas,FALSE,$select_jadwal);*/

			$all_jadwal_kelas = array('id_mhs_kls' => $_SESSION['id_mhs'], 'status_jdl' => 1);
			$count_all_jadwal = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,$all_jadwal_kelas);

			/*$jumlah_mhs = $this->mahasiswa_model->count(array('thn_angkatan' => $_SESSION['id_thn_angkatan']));
			$mhs_laki2 = $this->mahasiswa_model->count(array('thn_angkatan' => $_SESSION['id_thn_angkatan'], 'jk' => 'L'));
			$mhs_perempuan = $this->mahasiswa_model->count(array('thn_angkatan' => $_SESSION['id_thn_angkatan'], 'jk' => 'P'));
			$presentase_laki2 = $mhs_laki2/$jumlah_mhs*100;
			$presentase_perempuan = $mhs_perempuan/$jumlah_mhs*100;*/

			$data = array(
				'count_thn_ak_mhs' => $jumlah_ak_mhs,
				'count_studi' => $jumlah_studi,
				'count_all_jadwal' => $count_all_jadwal
				);
		}
		elseif ($_SESSION['level_akses'] == 'ptk') {
			$jumlah_mengajar = $this->jadwal_model->count(array('id_ptk_jdl' => $_SESSION['id_ptk']));
			$count_jadwal = $this->jadwal_model->get_detail_data('count',array('thn_akademik'),NULL,array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1));
			$jumlah_kelas = $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah'),NULL,array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1),FALSE,NULL,array('kelas','semester','jenis_jdl'));
			$data = array(
				'count_mengajar' => $jumlah_mengajar,
				'count_jadwal' => $count_jadwal,
				'count_kelas_ajar' => $jumlah_kelas,
				);
		}
		$this->site->view('index',$data);
	}

	public function home_page(){
		$this->site->view('home_page2');
	}

	public function profil_pt(){
		$this->site->view('data_identitas_pt');
	}

	public function pusat_unduhan(){
		$this->page_soon('Pusat Unduhan','fa-cloud-download');
	}

	public function feedback(){
		$this->page_soon('Feedback','fa-retweet');
	}

	public function about(){
		$this->site->view('about');
	}

	public function action($param){
		$post = $this->input->post(NULL, TRUE);
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			if ($param == 'ambil') {
				if ($post['data'] == 'data_identitas_pt') {
					$record = $this->konfigurasi_model->get_by_search(array('nama_konfigurasi' => $this->konfigurasi_model->konfigurasi_pt), TRUE);
					$data_identitas_pt[] = unserialize($record->isi_konfigurasi);
					$record_pt = array();
					foreach ($data_identitas_pt as $key) {
						$tgl_pt = array(
							'tgl_berdiri' => date_convert($key['tgl_berdiri']),
							'tgl_sk_pend' => date_convert($key['tgl_sk_pend']),
							);
						$record_pt[] = array_merge((array)$key,$tgl_pt);
					}

					$record = $this->prodi_model->get_detail_data('get',array('fakultas'),NULL,array('id_prodi' => $_SESSION['id_prodi']),FALSE,list_fields(array('prodi'),array('nama_fakultas')));
					$prodi = array();
					foreach ($record as $key) {
						if ($key->status_prodi == 1) {
							$status_pd = 'Aktif';
						}
						else{
							$status_pd = 'Tidak Aktif';
						}
						$count_jml = $this->mahasiswa_model->count(array('id_pd_mhs' => $key->id_prodi));
						$count_lk = $this->mahasiswa_model->count(array('id_pd_mhs' => $key->id_prodi, 'jk' => 'L'));
						$count_pr = $this->mahasiswa_model->count(array('id_pd_mhs' => $key->id_prodi, 'jk' => 'P'));
						$arr = array(
							'id_prodi' => rand_val(),
							'id_fk_pd' => rand_val(),
							'status' => $status_pd,
							'jml_mhs' => number_format($count_jml,0,',','.'),
							'jml_lk' => number_format($count_lk,0,',','.'),
							'jml_pr' => number_format($count_pr,0,',','.'),
							'tgl_berdiri_prodi' => date_convert($key->tgl_berdiri_prodi),
							'tgl_sk_prodi' => date_convert($key->tgl_sk_prodi)
							);
						$prodi[] = array_merge((array)$key,$arr);
					}
					$kons = $this->konsentrasi_pd_model->get_by_search(array('id_pd_konst' => $_SESSION['id_prodi']),FALSE,array('nm_konsentrasi'));
					$result = array(
						'data' => $record_pt,
						'prodi' => $prodi,
						'konsentrasi' => $kons
						);
				}
				elseif ($post['data'] =='daftar_jadwal_ptk') {
					$hari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat','Sabtu','Minggu');
					if (isset($post['d']) && $post['d'] == 'true') {
						$where = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1,'hari_jdl' => $hari[date('N')]);
						$count_jadwal = '';
					}
					else{
						if (isset($post['thn'])) {
							$thn_ajaran = explode(' ',$post['thn']);
							if (!isset($post['all'])) {
								$where = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
							}
							else{
								$where = array('thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
							}
							$where_count_jdl_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
							$where_count_kls_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
						}
						else{
							$where_count_jdl_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1);
							$where_count_kls_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1);
							$where = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1);
						}
						$count_jadwal = array(
							'count_ptk_jdl' => $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah'),NULL,$where_count_jdl_ptk),
							'count_ptk_kls' => $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah'),NULL,$where_count_kls_ptk,FALSE,NULL,array('kelas','semester','jenis_jdl'))
						);
					}

					$sub_query_count[] = '(SELECT COUNT(*) FROM {PRE}kelas_nilai_mhs WHERE id_jdl = id_jdl_kls) AS jml_mhs';
					$sub_query_count[] = '(SELECT COUNT(*) FROM {PRE}kelas_nilai_mhs 
										LEFT JOIN {PRE}mahasiswa ON {PRE}mahasiswa.id = id_mhs_kls
										WHERE id_jdl = id_jdl_kls AND jk = "L") AS jml_lk';
					$sub_query_count[] = '(SELECT COUNT(*) FROM {PRE}kelas_nilai_mhs 
										LEFT JOIN {PRE}mahasiswa ON {PRE}mahasiswa.id = id_mhs_kls
										WHERE id_jdl = id_jdl_kls AND jk = "P") AS jml_pr';
					$select_jadwal_detail = array_merge(array('id_jdl AS jdl_no','hari_jdl','jam_mulai_jdl','jam_akhir_jdl','semester','kelas','ruang','jenis_jdl','nm_konsentrasi','nama_prodi','nama_mk','jml_sks','thn_ajaran_jdl'), $sub_query_count);
					$data = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','prodi_mk'),NULL,$where,FALSE,$select_jadwal_detail);
					$record_jadwal = array();
					$no = 1;
					foreach ($data as $key) {
						$count_mhs = array(
							'jdl_no' => $no,
							'jdl_in' => $key->jdl_no,
							'thn_ajaran' => thn_ajaran_conv($key->thn_ajaran_jdl)
							);
						$record_jadwal[] = array_merge((array)$key,(array)$count_mhs);
						$no++;
					}
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah'),NULL,$where,FALSE,array('semester','kelas','jenis_jdl'),array('semester','kelas','id_pd_mk'),'semester ASC, kelas ASC');
					$data_u = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd'),NULL,$where,FALSE,array('jenis_jdl','nm_konsentrasi'),array('jenis_jdl'),'nm_konsentrasi ASC');
					$result = array(
						'record_jadwal' => $record_jadwal,
						'record_kelas' => $data_kelas,
						'record_u' => $data_u,
						'count_jadwal_ptk' => $count_jadwal,
						'hari_i' => $hari[date('N')],
						'c_thn_ajaran' => $_SESSION['thn_ajaran']
						);
				}
				elseif ($post['data'] =='daftar_jadwal_mhs') {
					$hari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat','Sabtu','Minggu');
					if (isset($post['d']) && $post['d'] == 'true') {
						$where = array('id_mhs_kls' => $_SESSION['id_mhs'], 'status_jdl' => 1,'hari_jdl' => $hari[date('N')]);
						$count_jadwal = '';
					}
					else{
						if (isset($post['thn'])) {
							$thn_ajaran = explode(' ',$post['thn']);
							if (!isset($post['all'])) {
								$where = array('id_mhs_kls' => $_SESSION['id_mhs'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
							}
							else{
								$where = array('thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
							}
							$where_count_jdl_ptk = array('id_mhs_kls' => $_SESSION['id_mhs'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
							$where_count_kls_ptk = array('id_mhs_kls' => $_SESSION['id_mhs'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
						}
						else{
							$where_count_jdl_ptk = array('id_mhs_kls' => $_SESSION['id_mhs'], 'status_jdl' => 1);
							$where_count_kls_ptk = array('id_mhs_kls' => $_SESSION['id_mhs'], 'status_jdl' => 1);
							$where = array('id_mhs_kls' => $_SESSION['id_mhs'], 'status_jdl' => 1);
						}
						$count_jadwal = array(
							'count_ptk_jdl' => $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah','kelas_nilai_mhs'),NULL,$where_count_jdl_ptk),
							'count_ptk_kls' => $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah','kelas_nilai_mhs'),NULL,$where_count_kls_ptk,FALSE,NULL,array('kelas','semester','jenis_jdl'))
						);
					}

					$sub_query_count[] = '(SELECT COUNT(*) FROM {PRE}kelas_nilai_mhs WHERE id_jdl = id_jdl_kls) AS jml_mhs';
					$sub_query_count[] = '(SELECT COUNT(*) FROM {PRE}kelas_nilai_mhs 
										LEFT JOIN {PRE}mahasiswa ON {PRE}mahasiswa.id = id_mhs_kls
										WHERE id_jdl = id_jdl_kls AND jk = "L") AS jml_lk';
					$sub_query_count[] = '(SELECT COUNT(*) FROM {PRE}kelas_nilai_mhs 
										LEFT JOIN {PRE}mahasiswa ON {PRE}mahasiswa.id = id_mhs_kls
										WHERE id_jdl = id_jdl_kls AND jk = "P") AS jml_pr';
					$select_jadwal_detail = array_merge(array('id_jdl AS jdl_no','hari_jdl','jam_mulai_jdl','jam_akhir_jdl','semester','kelas','ruang','jenis_jdl','nm_konsentrasi','nama_prodi','nama_mk','nama_ptk','jml_sks','thn_ajaran_jdl'), $sub_query_count);
					if (!isset($post['all'])) {
						$data = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','ptk','prodi_mk','kelas_nilai_mhs'),NULL,$where,FALSE,$select_jadwal_detail);
					}
					else{
						$data = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','ptk','prodi_mk'),NULL,$where,FALSE,$select_jadwal_detail);
					}
					$record_jadwal = array();
					$no = 1;
					foreach ($data as $key) {
						$count_mhs = array(
							'jdl_no' => $no,
							'jdl_in' => $key->jdl_no,
							'thn_ajaran' => thn_ajaran_conv($key->thn_ajaran_jdl)
							);
						$record_jadwal[] = array_merge((array)$key,(array)$count_mhs);
						$no++;
					}
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','kelas_nilai_mhs'),NULL,$where,FALSE,array('semester','kelas','jenis_jdl'),array('semester','kelas','id_pd_mk'),'semester ASC, kelas ASC');
					$data_u = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','kelas_nilai_mhs'),NULL,$where,FALSE,array('jenis_jdl','nm_konsentrasi'),array('jenis_jdl'),'nm_konsentrasi ASC');
					$result = array(
						'record_jadwal' => $record_jadwal,
						'record_kelas' => $data_kelas,
						'record_u' => $data_u,
						'count_jadwal_ptk' => $count_jadwal,
						'hari_i' => $hari[date('N')],
						'c_thn_ajaran' => $_SESSION['thn_ajaran']
						);
				}
				elseif ($post['data']== 'daftar_kelas_mhs') {
					$select_daftar_mhs = array('id_kelas','nisn','nama','mahasiswa.jk','tahun_angkatan','status_mhs_kls');
					$select_kelas = array('hari_jdl','jam_mulai_jdl','jam_akhir_jdl','semester','kelas','ruang','jenis_jdl','nama_mk','nama_ptk','status_jdl','nm_konsentrasi');
					$where = array('id_jdl_kls' => $post['kelas']);
					$data_mhs = $this->kelas_model->get_detail_data('get',array('mahasiswa','thn_angkatan'),NULL,$where,NULL,$select_daftar_mhs);
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','ptk'),NULL,array('id_jdl' => $post['kelas']),NULL,$select_kelas);
					$result = array(
						'record_mhs' => $data_mhs,
						'record_kelas' => $data_kelas,
						'data_kelas' => $_SESSION['level_akses']
						);
				}
				elseif ($post['data'] =='daftar_kls_ptk') {
					if (isset($post['thn'])) {
						$thn_ajaran = explode(' ',$post['thn']);
						$where = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
						$where_count_jdl_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
						$where_count_kls_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'thn_ajaran_jdl' => $thn_ajaran[0], 'id_pd_mk' => $thn_ajaran[1]);
					}
					else{
						$where_count_jdl_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1);
						$where_count_kls_ptk = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1);
						$where = array('id_ptk_jdl' => $_SESSION['id_ptk'], 'status_jdl' => 1);
					}
					$count_jadwal = array(
						'count_ptk_jdl' => $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah'),NULL,$where_count_jdl_ptk),
						'count_ptk_kls' => $this->jadwal_model->get_detail_data('count',array('thn_akademik','mata_kuliah'),NULL,$where_count_kls_ptk,FALSE,NULL,array('kelas','semester','jenis_jdl'))
					);
					$select_jadwal_detail = array('id_jdl AS jdl_no','thn_ajaran_jdl','semester','kelas','jenis_jdl','nm_konsentrasi','nama_prodi','nama_mk','jml_sks','status_jdl','status_inp_nilai');
					$data = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','prodi_mk'),NULL,$where,FALSE,$select_jadwal_detail);
					$record_jadwal = array();
					$no = 1;
					foreach ($data as $key) {
						$count_mhs = array(
							'jml_mhs' => $this->kelas_model->count(array('id_jdl_kls' =>$key->jdl_no)),
							'jml_lk' => $this->kelas_model->get_detail_data('count',array('mahasiswa'),NULL,array('id_jdl_kls' =>$key->jdl_no, 'jk' => 'L')),
							'jml_pr' => $this->kelas_model->get_detail_data('count',array('mahasiswa'),NULL,array('id_jdl_kls' =>$key->jdl_no, 'jk' => 'P')),
							'jdl_no' => $no,
							'jdl_in' => $key->jdl_no,
							'thn_ajaran' => thn_ajaran_conv($key->thn_ajaran_jdl)
							);
						$record_jadwal[] = array_merge((array)$key,(array)$count_mhs);
						$no++;
					}
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','prodi_mk'),NULL,$where,FALSE,array('semester','kelas','jenis_jdl'),array('semester','kelas','id_pd_mk'),'semester ASC, kelas ASC');
					$data_u = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','prodi_mk'),NULL,$where,FALSE,array('jenis_jdl','nm_konsentrasi'),array('jenis_jdl'),'nm_konsentrasi ASC');
					$result = array(
						'record_jadwal' => $record_jadwal,
						'record_kelas' => $data_kelas,
						'record_u' => $data_u,
						'count_jadwal_ptk' => $count_jadwal,
						'c_thn_ajaran' => $_SESSION['thn_ajaran']
						);
				}
				elseif ($post['data']== 'daftar_nilai_mhs') {
					$check_thn_ajaran = $this->jadwal_model->get_detail_data('count',array('thn_akademik'),NULL,array('id_jdl' => $post['kelas'], 'status_inp_nilai' => 1));
					if ($check_thn_ajaran > 0) {
						$input = TRUE;
					}
					else{
						$input = FALSE;
					}
					$select_daftar_mhs = array('nisn','nama','id_kelas','nilai_akhir');
					$data_mhs = $this->kelas_model->get_detail_data('get',array('mahasiswa'),NULL,array('id_jdl_kls' => $post['kelas']),NULL,$select_daftar_mhs);
					$select_kelas = array('id_jdl AS jdl_i','hari_jdl','jam_mulai_jdl','jam_akhir_jdl','semester','kelas','ruang','jenis_jdl','nm_konsentrasi','nama_mk','nama_ptk');
					$data_kelas = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','konsentrasi_pd','ptk'),NULL,array('id_jdl' => $post['kelas']),FALSE,$select_kelas);
					$nilai_mhs = array();
					foreach ($data_mhs as $key) {
						$pd = array('pdk' => pdk_conv($key->nilai_akhir));
						$nilai_mhs[] = array_merge((array)$key,$pd);
					}
					$result = array(
						'input' => $input,
						'record_mhs' => $nilai_mhs,
						'record_kelas' => $data_kelas
						);
				}
				elseif ($post['data'] == 'ptk') {
					$count_ptk = $this->ptk_model->count();
					if ($count_ptk > 0) {
						$daftar_pd = $this->prodi_model->get_by_search(NULL,FALSE,array('id_prodi','nama_prodi','jenjang_prodi'));
						$prodi = array();
						$canvas = array();
						$no = 0;
						foreach ($daftar_pd as $key) {
							$count_ptk_pd = $this->ptk_model->count(array('jurusan_prodi' => $key->id_prodi));
							$statik_ptk_pd = $count_ptk_pd/$count_ptk*100;
							$detail_grafik = array(
								'count_ptk' => $count_ptk_pd,
								'statik_ptk' => round($statik_ptk_pd),
								'color_detail' => color_pd_static($no)
								);
							$prodi[] = array_merge((array)$key,$detail_grafik);
							$canvas[] = array(
								'value' => $count_ptk_pd,
								'color' => color_pd_static($no),
								'highlight' => color_pd_static($no),
								'label' => $key->nama_prodi.' ('.$key->jenjang_prodi.')',
								);
							$no++;
						}
						$result = array(
							'status' => 'success',
							'pd' => $prodi,
							'canvas' => $canvas,
							);
					}
					else{
						$result = array('status' => 'empty');
					}
				}
				elseif ($post['data']=='daftar_thn_ajaran') {
					$cari = $post['value'];
					if ($_SESSION['level_akses'] == 'mhs') {
						$join = array('thn_akademik','mata_kuliah','prodi_mk','kelas_nilai_mhs');
						$cari = array('thn_ajaran_jdl LIKE' => '%'.$cari.'%', 'id_mhs_kls' => $_SESSION['id_mhs']);
					}
					elseif ($_SESSION['level_akses'] == 'ptk') {
						$join = array('thn_akademik','mata_kuliah','prodi_mk');
						$cari = array('thn_ajaran_jdl LIKE' => '%'.$cari.'%', 'id_ptk_jdl' => $_SESSION['id_ptk']);
					}
					$data= $this->jadwal_model->get_detail_data('get',$join,NULL,$cari,NULL,array('thn_ajaran_jdl','id_pd_mk','nama_prodi','jenjang_prodi'),array('thn_ajaran_jdl','id_pd_mk'),'thn_ajaran_jdl DESC');
					$total_rows = count($data);
					if ($total_rows > 0 ) {
						foreach ($data as $key => $value) {
							$data[] = array(
								'id' => $value->thn_ajaran_jdl.' '.$value->id_pd_mk,
								'text' => thn_ajaran_conv($value->thn_ajaran_jdl).' '.$value->nama_prodi.' ('.$value->jenjang_prodi.')',
								'thn_ajaran_jdl' => $value->thn_ajaran_jdl,
								'nama_prodi' => $value->nama_prodi,
								'jenjang_prodi' => $value->jenjang_prodi,
								);
						}		
						$result = array(
							'jadwal' => $data,
							'total_count' => $total_rows
							);
					}					
					else{
						$result['jadwal'] = '';
					}					
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'change_password') {
				$rules = $this->user_model->rules_change_password;
				$this->form_validation->set_rules($rules);
				$this->current_pass = $this->user_model->get_by_search(array('id_user' => $_SESSION['id_user']),TRUE,array('password','pass_change'));

				if ($this->form_validation->run() == TRUE) {
					$pass = password_hash($post['new_password'],PASSWORD_BCRYPT);
					if ($this->current_pass->pass_change == 0) {
						$new_password = array(
							'password' => $pass,
							'pass_change' => 1,
							);
						$update_password = $this->user_model->update($new_password,array('id_user' => $_SESSION['id_user']));
					}
					else{
						$new_password = array(
							'password' => $pass,
							);
						$update_password = $this->user_model->update($new_password,array('id_user' => $_SESSION['id_user']));
					}
					if ($update_password) {
						$this->session->set_userdata(array('user_password' => md5($pass)));
						$result = array(
							'status' => 'success'
							);
					}
					else{
						$result = array(
							'status' => 'failed_db'
							);
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
			$result['n_token'] = $this->security->get_csrf_hash();
			echo json_encode($result,TRUE);
		}
	}

	public function check_password($string){
		$old_password = $string;
		$current_pass = $this->current_pass;
		if (@$current_pass->password == crypt($old_password,@$current_pass->password)) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

}
