<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_mhs extends Frontend_Controller {

	public function __construct(){
		parent::__construct();		
		$this->site->login_status_check('mhs');
	}

	public function data_mhs(){
		$this->site->view('data_mhs');
	}

	public function data_jadwal(){
		$this->site->view('data_jadwal');
	}

	public function nilai_mhs(){
		$this->site->view('nilai_akhir_mhs');
	}

	public function action($param){
		$post = $this->input->post(NULL, TRUE);
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			if ($param == 'ambil') {
				if ($post['data'] == 'data_mhs') {
					$record = $this->mahasiswa_model->get_detail_data('get',array('prodi_mhs','ortu','thn_angkatan','alumni','mhs_do'),NULL,array('id' => $_SESSION['id_mhs']),FALSE,list_fields(array('mahasiswa','ortu_wali'),array('nama_prodi','jenjang_prodi','tahun_angkatan','tgl_masuk_angkatan','tgl_lulus','tgl_drop_out')));
					$record_mhs = array();
					foreach ($record as $key) {
						if ($key->tgl_drop_out != NULL && $key->tgl_lulus == NULL) {
							$status_mhs = array('status_mhs' => 'Drop Out');
						}
						elseif ($key->tgl_drop_out == NULL && $key->tgl_lulus != NULL) {
							$status_mhs = array('status_mhs' => 'Alumni');
						}
						else{
							$status_mhs = array('status_mhs' => 'Mahasiswa');
						}
						$tgl_lhr = array(
							'tgl_lhr' => date_convert($key->tgl_lhr),
							'tgl_masuk_angkatan' => date_convert($key->tgl_masuk_angkatan),
							'tgl_lulus' => date_convert($key->tgl_lulus),
							'tgl_drop_out' => date_convert($key->tgl_drop_out)
						);
						$record_mhs[] = array_merge((array)$key,$tgl_lhr,$status_mhs);
					}
					$result = array(
						'record_mhs' => $record_mhs
						);
				}
				elseif ($post['data'] =='riwayat_akademik_mhs') {
					$where = array('id_mhs_kls' => $_SESSION['id_mhs']);
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
				elseif ($post['data'] == 'data_jadwal') {
					$jadwal_kelas = array('kelas' => $_SESSION['kelas']);
					$total_rows = $this->jadwal_model->count($jadwal_kelas);

					if ($total_rows > 0) {
						$select = array('hari','jam_awal','jam_akhir','mata_pelajaran','guru');
						$record_jadwal = $this->jadwal_model->get_by_search($jadwal_kelas,FALSE,$select);
						$result = array(							
								'total_rows' => $total_rows,							
								'record_jadwal' => $record_jadwal,								
								);
					}
					else{						
						$result = array(							
								'total_rows' => $total_rows,								
								);
					}
				}
				elseif ($post['data'] == 'daftar_nilai_mhs') {
					if (isset($post['thn'])) {
						$thn = explode(' ',$post['thn']);
						$thn_ajaran = thn_ajaran_conv($thn[0]);
						$where = array('id_mhs_kls' => $_SESSION['id_mhs'],'thn_ajaran_jdl' => $thn[0]);
					}
					else{
						$thn_ajaran = $_SESSION['thn_ajaran'];
						$where = array('id_mhs_kls' => $_SESSION['id_mhs'],'status_jdl' => 1);
					}
					$record = $this->kelas_model->get_detail_data('get',array('jadwal','thn_akademik','mata_kuliah'),NULL,$where,FALSE,array('kode_mk','nama_mk','jml_sks','nilai_akhir','thn_ajaran_jdl'),NULL,'kode_mk ASC');
					$record_nilai = array();
					$sks = 0;
					$mutu = 0;
					foreach ($record as $key) {
						$n = explode('/',nilai_conv($key->nilai_akhir,$key->jml_sks));
						$mt = array(
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
						'record_nilai' => $record_nilai,
						'sks' => $sks,
						'mutu' => $mutu,
						'thn' => $thn_ajaran
						);
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			else{
				$result = array('status_action' => 'Not find...');
			}
			$result['n_token'] = $this->security->get_csrf_hash();
			echo json_encode($result,TRUE);
		}
	}

	public function verifikasi_data($status){
		if ($status == 'true') {
			$verifikasi_siswa = $this->mahasiswa_model->update(array('status_verifikasi_mhs' => 1),array('id' => $_SESSION['id_mhs']));
		}
		elseif ($status == 'false') {
			$verifikasi_siswa = $this->mahasiswa_model->update(array('status_verifikasi_mhs' => 2),array('id' => $_SESSION['id_mhs']));
		}
		redirect(base_url('beranda_mhs/data_mhs'));
	}

}
