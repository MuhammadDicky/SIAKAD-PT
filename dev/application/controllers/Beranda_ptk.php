<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_ptk extends Frontend_Controller {

	protected $check_nilai;
	protected $check_ptk;
	protected $check_thn_ajaran;

	public function __construct(){
		parent::__construct();		
		$this->site->login_status_check('ptk');
	}

	public function data_tenaga_pendidik(){
		$this->site->view('data_ptk');
	}

	public function jadwal_mengajar(){
		$this->site->view('data_jadwal_mengajar');
	}

	public function nilai_mhs(){
		$this->site->view('nilai_mhs');
	}

	public function action($param){
		$post = $this->input->post(NULL, TRUE);
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			if ($param == 'tambah') {
				if ($post['data'] == 'nilai_mhs') {
					$this->check_nilai = $post['nilai_akhir'];
					$this->check_ptk = $post['id_kls_nilai'];
					$this->check_thn_ajaran = $post['c_kelas'];
					$rules = $this->kelas_model->rules_nilai;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$no = 0;
						foreach ($post['nilai_akhir'] as $key) {
							$insert_batch[] = array(
								'id_kelas' => $post['id_kls_nilai'][$no],
								'nilai_akhir' => $post['nilai_akhir'][$no],
								);
							$no++;
						}
						$this->db->where(array('id_jdl_kls' => $post['c_kelas']));
						$insert_nilai = $this->kelas_model->update($insert_batch,'id_kelas',TRUE);
						if ($insert_nilai) {
							$result = array(
								'status' => 'success',
								'data' => $post['data'],
								'kls'=> $post['c_kelas'],
								);
						}
						else{
							$result = array(
								'status' => 'failed',
								'inp' => TRUE,
								'errors'=> array('nilai_akhir' => 'Anda tidak merubah satu pun nilai')
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
			}
			elseif ($param == 'ambil') {
				if ($post['data'] == 'data_tenaga_pendidik') {
					$record = $this->ptk_model->get_by_search(array('id_ptk' => $_SESSION['id_ptk']));
					$record_ptk = array();
					foreach ($record as $key) {
						$pd_ptk = $this->prodi_model->get_by_search(array('id_prodi' => $key->jurusan_prodi),TRUE,array('nama_prodi','jenjang_prodi'));
						$attr = array(
							'tgl_lhr_ptk' => date_convert($key->tgl_lhr_ptk),
							'agama_ptk' => select_conv_value($key->status_ptk,'ptk','agama_ptk'),
							'status_ptk' => select_conv_value($key->status_ptk,'ptk','status_ptk'),
							'status_aktif_ptk' => select_conv_value($key->status_aktif_ptk,'ptk','status_aktif_ptk'),
							'jenjang' => select_conv_value($key->jenjang,'ptk','jenjang'),
							);
						$record_ptk[] = array_merge((array)$key,$attr,(array)$pd_ptk);
					}
					$result = array(
						'record_ptk' => $record_ptk,							
						);
				}
				elseif ($post['data'] =='detail_data_ptk') {
					$in_ptk = $_SESSION['id_ptk'];
					$data_studi = $this->ptk_studi_model->get_detail_data('get',NULL,NULL,array('id_ptk_studi' => $in_ptk),NULL,array('nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk'),NULL,'tgl_ijazah_ptk ASC');
					$record_studi = array();
					foreach ($data_studi as $key) {
						$arr = array('tgl_ijazah_ptk' => date_convert($key->tgl_ijazah_ptk));
						$record_studi[] = array_merge((array)$key,$arr);
					}

					$data_jadwal = $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','prodi_mk'),NULL,array('id_ptk_jdl' => $in_ptk),NULL,array('thn_ajaran_jdl','kode_mk','nama_mk','semester','kelas','nama_prodi'),NULL,'thn_ajaran_jdl ASC, semester ASC, kelas ASC');
					$record_jadwal = array();
					foreach ($data_jadwal as $key) {
						$arr = array(
							'thn_ajaran_jdl' => thn_ajaran_conv($key->thn_ajaran_jdl),
							'kelas' => $key->semester.'/'.$key->kelas,
							);
						$record_jadwal[] = array_merge((array)$key,$arr);
					}

					$record_penelitian = $this->ptk_penelitian_model->get_detail_data('get',NULL,NULL,array('id_ptk_rsch' => $in_ptk),NULL,array('judul_penelitian','bidang_ilmu','lembaga'));
					$result = array(
						'studi_ptk' => $record_studi,
						'riwayat_mengajar' => $record_jadwal,
						'penelitian_ptk' => $record_penelitian,
						);
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'update_status') {
				if ($post['status_mhs_kls'] == 'true') {
					$status = 1;
				}
				else{
					$status = 0;
				}
				$check_thn = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,array('id_kelas' => $post['id'],'status_jdl' => 1));
				if ($check_thn > 0) {
					$data = array('status_mhs_kls' => $status);
					$where = array('id_kelas' => $post['id']);
					$update_status = $this->kelas_model->update($data,$where);
					if ($update_status == TRUE) {
						$result = array(
							'status' => 'success',
							'status_mhs' => $status,
							);
					}
					else{
						$result = array(
							'status' => 'failed',
							'status_mhs' => $status,
							);
					}
				}
				else{
					$result = array(
						'status' => 'failed_thn',
						'status_mhs' => $status,
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

	public function verifikasi_data($status){
		if ($status == 'true') {
			$this->ptk_model->update(array('status_verifikasi_ptk' => 1),array('id_ptk' => $_SESSION['id_ptk']));
		}
		elseif ($status == 'false') {
			$this->ptk_model->update(array('status_verifikasi_ptk' => 2),array('id_ptk' => $_SESSION['id_ptk']));
		}
		redirect(base_url('beranda_ptk/data_tenaga_pendidik'));
	}

	public function check_vnilai($string){
		$nilai = $this->check_nilai;
		$thn = $this->check_thn_ajaran;
		$ptk = $this->check_ptk;
		$check_thn = $this->jadwal_model->get_detail_data('get',array('thn_akademik'),NULL,array('id_jdl' => $thn),TRUE,array('status_jdl','status_inp_nilai'));
		if ($check_thn->status_jdl == 1 && $check_thn->status_inp_nilai == 1) {
			$no_p = 1;
			foreach ($ptk as $key_ptk) {
				$check_ptk = $this->kelas_model->get_detail_data('count',array('jadwal'),NULL,array('id_kelas' => $key_ptk,'id_jdl' => $thn, 'id_ptk_jdl' => $_SESSION['id_ptk']));
				if ($no_p != count($ptk)) {
					if ($check_ptk == 0) {
						$this->form_validation->set_message('check_vnilai', 'Anda tidak bisa menginput nilai dari kelas yang bukan kelas didik anda');
						return FALSE;
					}
				}
				else{
					if ($check_ptk == 0) {
						$this->form_validation->set_message('check_vnilai', 'Anda tidak bisa menginput nilai dari kelas yang bukan kelas didik anda');
						return FALSE;
					}
				}
				$no_p++;
			}
			$no = 1;
			foreach ($nilai as $key) {
				if ($no != count($nilai)) {
					if ($key == '') {
						$this->form_validation->set_message('check_vnilai', 'Tolong masukkan nilai');
						return FALSE;
					}
					else{
						if ($key > 100 || $key < 0) {
							$this->form_validation->set_message('check_vnilai', 'Nilai yang dimasukkan antara 1-100');
							return FALSE;
						}
					}
				}
				else{
					if ($key == '') {
						$this->form_validation->set_message('check_vnilai', 'Tolong masukkan nilai');
						return FALSE;
					}
					else{
						if ($key > 100 || $key < 0) {
							$this->form_validation->set_message('check_vnilai', 'Nilai yang dimasukkan antara 1-100');
							return FALSE;
						}
						else{
							return TRUE;
						}
					}
				}
				$no++;
			}
		}
		elseif ($check_thn->status_jdl == 0){
			$this->form_validation->set_message('check_vnilai', 'Anda tidak bisa menginput nilai sekarang karena tahun akademik kelas ini sedang tidak diterapkan');
			return FALSE;
		}
		elseif ($check_thn->status_inp_nilai == 0) {
			$this->form_validation->set_message('check_vnilai', 'Anda tidak bisa menginput nilai untuk saat ini');
			return FALSE;
		}
	}

}
