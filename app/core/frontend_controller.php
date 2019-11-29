<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends My_Controller{

	public function __construct(){
		parent::__construct();	
		$this->load->helper(array());
		$this->load->library(array('form_validation'));
		$this->load->model(array('ptk_studi_model','ptk_penelitian_model'));

		$this->site->side = 'frontend';
		
		/*Get template*/
		if (!$this->input->is_ajax_request()) {
			$template = $this->template_model->get_by_search(array('template_status' => 1),TRUE,array('template_directory'));
			if ($template && $template->template_directory != '') {
				$this->site->template = $template->template_directory;
			}
			else{
				$this->site->template = 'adminlte';
			}
		}

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE && $_SESSION['level_akses'] != 'admin') {
			$photo = photo_u();
			if ($_SESSION['level_akses'] == 'ptk') {
				/*$user_detail = $this->user_model->get_by(array('id_user_detail' => $_SESSION['id_ptk'], 'level_akses' => 'ptk'),1,NULL,TRUE);*/
				$detail_ptk = $this->ptk_model->get_detail_data('get',array('user','prodi_ptk'),NULL,array('id_ptk' => $_SESSION['id_ptk']),TRUE,array('id_user','id_ptk','nama_ptk','nuptk','id_prodi','nama_prodi','photo_ptk','status_verifikasi_ptk','active_status','password'));
				if ($detail_ptk != NULL) {
					if ($detail_ptk->active_status == 1 && md5($detail_ptk->password) == $_SESSION['user_password'] && $detail_ptk->nuptk == $_SESSION['nuptk']) {
						$thn_ajaran = $this->thn_ajaran_model->get_by_search(array('status_jdl' => 1),TRUE);
						if ($thn_ajaran) {
							$thn_ajaran_jdl = $thn_ajaran->thn_ajaran_jdl;
							$thn_ajaran = thn_ajaran_conv($thn_ajaran->thn_ajaran_jdl);
						}
						else{
							$thn_ajaran_jdl = NULL;
							$thn_ajaran = '-';
						}

						if ($detail_ptk->photo_ptk != '') {
							$this->load->helper('file');
							$check_file = get_file_info('uploads/ptk-photo/'.$detail_ptk->photo_ptk);
							if ($check_file != FALSE) {
								$photo = photo_u('ptk',$detail_ptk->photo_ptk.'?n_img='.rand_val(20));
							}
						}
						$login_data = array(
							'id_user'           => $detail_ptk->id_user,
							'user_password'     => md5($detail_ptk->password),
							'id_ptk'            => $detail_ptk->id_ptk,
							'nama'              => $detail_ptk->nama_ptk,
							'nuptk'             => $detail_ptk->nuptk,
							'id_prodi'          => $detail_ptk->id_prodi,
							'prodi'             => $detail_ptk->nama_prodi,
							'status_verifikasi' => $detail_ptk->status_verifikasi_ptk,
							'thn_ajaran_jdl'    => $thn_ajaran_jdl,
							'thn_ajaran'        => $thn_ajaran,
							'photo_u'           => $photo,
							);
					}
					else{
						if ($detail_ptk->active_status == 0) {
							$this->session->set_flashdata('user_change_info','Maaf, akun anda telah dinonaktifkan');
							delete_cookie('user_in');
						}
						elseif (md5($detail_ptk->password) != $_SESSION['user_password'] || $detail_ptk->nuptk != $_SESSION['nuptk']) {
							$this->session->set_flashdata('user_change_info','Telah terjadi perubahan informasi pada akun anda, silahkan login kembali');
							if ($detail_ptk->nuptk != $_SESSION['nuptk']) {
								delete_cookie('user_in');
							}
						}
						$array_items = array('id_user','id_ptk','nama','nuptk','id_prodi','prodi','status_verifikasi','thn_ajaran_jdl','thn_ajaran','photo_u','logged_in','active_status','level_akses','last_online','user_password');
						$this->session->unset_userdata($array_items);
						delete_cookie('user_u');
						delete_cookie('pass_u');
						redirect(base_url('login'));
					}
				}
				else{
					$this->session->set_flashdata('user_change_info','Maaf, akun anda telah dihapus dari database!');
					$array_items = array('id_user','id_ptk','nama','nuptk','id_prodi','prodi','status_verifikasi','thn_ajaran_jdl','thn_ajaran','photo_u','logged_in','active_status','level_akses','last_online','user_password');
					$this->session->unset_userdata($array_items);
					delete_cookie('user_in');
					delete_cookie('user_u');
					delete_cookie('pass_u');
					redirect(base_url('login'));
				}
			}
			elseif ($_SESSION['level_akses'] == 'mhs') {
				/*$user_detail = $this->user_model->get_by(array('id_user_detail' => $_SESSION['id_mhs'], 'level_akses' => 'mhs'),1,NULL,TRUE);*/
				$detail_mhs = $this->mahasiswa_model->get_detail_data('get',array('prodi_mhs','fakultas','thn_angkatan','user'),NULL,array('id' => $_SESSION['id_mhs']),TRUE,array('id_user','id','nama','nisn','id_prodi','nama_fakultas','nama_prodi','jenjang_prodi','id_thn_angkatan','tahun_angkatan','agama','photo_mhs','status_verifikasi_mhs','active_status','password'));
				if ($detail_mhs != NULL) {
					if ($detail_mhs->active_status == 1 && md5($detail_mhs->password) == $_SESSION['user_password'] && $detail_mhs->nisn == $_SESSION['nim']) {
						$thn_ajaran = $this->thn_ajaran_model->get_by_search(array('status_jdl' => 1),TRUE);
						if ($thn_ajaran) {
							$thn_ajaran_jdl = $thn_ajaran->thn_ajaran_jdl;
							$thn_ajaran = thn_ajaran_conv($thn_ajaran->thn_ajaran_jdl);
						}
						else{
							$thn_ajaran_jdl = NULL;
							$thn_ajaran = '-';
						}

						if ($detail_mhs->photo_mhs != '') {
							$this->load->helper('file');
							$check_file = get_file_info('uploads/mhs-photo/'.$detail_mhs->photo_mhs);
							if ($check_file != FALSE) {
								$photo = photo_u('mhs',$detail_mhs->photo_mhs.'?n_img='.rand_val(20));
							}
						}
						$login_data = array(
							'id_user'           => $detail_mhs->id_user,
							'user_password'     => md5($detail_mhs->password),
							'id_mhs'            => $detail_mhs->id,
							'nama'              => $detail_mhs->nama,
							'nim'               => $detail_mhs->nisn,
							'id_prodi'          => $detail_mhs->id_prodi,
							'fk'                => $detail_mhs->nama_fakultas,
							'prodi'             => $detail_mhs->nama_prodi,
							'jenjang_prodi'     => $detail_mhs->jenjang_prodi,
							'id_thn_angkatan'   => $detail_mhs->id_thn_angkatan,
							'thn_angkatan'      => $detail_mhs->tahun_angkatan,
							'agama'             => $detail_mhs->agama,
							'status_verifikasi' => $detail_mhs->status_verifikasi_mhs,
							'thn_ajaran_jdl'    => $thn_ajaran_jdl,
							'thn_ajaran'        => $thn_ajaran,
							'photo_u'           => $photo,
						);
					}
					else{
						if ($detail_mhs->active_status == 0) {
							$this->session->set_flashdata('user_change_info','Maaf, akun anda telah dinonaktifkan');
							delete_cookie('user_in');
						}
						elseif (md5($detail_mhs->password) != $_SESSION['user_password'] || $detail_mhs->nisn != $_SESSION['nim']) {
							$this->session->set_flashdata('user_change_info','Telah terjadi perubahan informasi pada akun anda, silahkan login kembali');
							if ($detail_ptk->nuptk != $_SESSION['nuptk']) {
								delete_cookie('user_in');
							}
						}
						$array_items = array('id_user','id_mhs','nama','nim','id_prodi','fk','prodi','jenjang_prodi','id_thn_angkatan','thn_angkatan','agama','status_verifikasi','thn_ajaran_jdl','thn_ajaran','photo_u','logged_in','active_status','level_akses','last_online','user_password');
						$this->session->unset_userdata($array_items);
						delete_cookie('user_u');
						delete_cookie('pass_u');
						redirect(base_url('login'));
					}
				}
				else{
					$this->session->set_flashdata('user_change_info','Maaf, akun anda telah dihapus dari database!');
					$array_items = array('id_user','id_mhs','nama','nim','id_prodi','fk','prodi','jenjang_prodi','id_thn_angkatan','thn_angkatan','agama','status_verifikasi','thn_ajaran_jdl','thn_ajaran','photo_u','logged_in','active_status','level_akses','last_online','user_password');
					$this->session->unset_userdata($array_items);
					delete_cookie('user_in');
					delete_cookie('user_u');
					delete_cookie('pass_u');
					redirect(base_url('login'));
				}
			}
			$this->session->set_userdata($login_data);
		}
	}

}


?>