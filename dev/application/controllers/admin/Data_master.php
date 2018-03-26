<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_master extends Backend_Controller {

	protected $kelas = NULL;
	protected $kd_pd = NULL;
	protected $thn_ajaran;
	protected $thn_ajaran_id = NULL;
	protected $thn;
	protected $in_pt;
	protected $in_konst;

	public function __construct(){
		parent::__construct();
		$this->site->login_status_check();
	}

	public function index(){
		$this->page_soon('Data Master','fa-archive');
	}

	public function data_identitas_pt(){
		if ($this->site->template == 'adminlte') {
			$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
		}
		elseif ($this->site->template == 'core_ui') {
			$data = array(
				'view' => 'Data Identitas Perguruan Tinggi'
				);
			$this->site->view('index',$data);
		}

		$post = $this->input->get(NULL, TRUE);
		if (isset($post['request_view'])) {
			if (isset($post['req_info']) && $post['req_info'] == TRUE) {
				$data = array(
					'status_page' => 'success',
					'title_page' => title(),
					'breadcrumb' => content_path()
					);
				echo json_encode($data);
			}
			else{
				$this->site->view('views/'.$this->router->class.'/'.$this->router->method);
			}
		}
	}

	public function data_fakultas_pstudi(){
		if ($this->site->template == 'adminlte') {
			$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
		}
		elseif ($this->site->template == 'core_ui') {
			$data = array(
				'view' => 'Data Fakultas & Program Studi'
				);
			$this->site->view('index',$data);
		}

		$post = $this->input->get(NULL, TRUE);
		if (isset($post['request_view'])) {
			if (isset($post['req_info']) && $post['req_info'] == TRUE) {
				$data = array(
					'status_page' => 'success',
					'title_page' => title(),
					'breadcrumb' => content_path()
					);
				echo json_encode($data);
			}
			else{
				$this->site->view('views/'.$this->router->class.'/'.$this->router->method);
			}
		}
	}

	public function data_thn_akademik(){
		$thn = $this->thn_ajaran_model->get_by_search(array('status_jdl ' => 1),TRUE,array('thn_ajaran_jdl'));
		if ($thn) {
			$thn_akademik = thn_ajaran_conv($thn->thn_ajaran_jdl);
		}
		else{
			$thn_akademik = '-';
		}
		$data = array(
			'tahun_akademik' => $thn_akademik,
			);
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method,$data);
	}

	public function data_angkatan(){
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function data_kelas(){
		$this->site->view('data_kelas');
	}

	public function action($param){
		global $Config;
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$post = $this->input->post(NULL, TRUE);
			if ($param == 'tambah') {
				if (isset($post['data_thn_akademik'])) {
					$this->thn_ajaran = $post['thn_ajar'].'/'.$post['smstr'];
					$rules = $this->thn_ajaran_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'thn_ajaran_jdl' => $this->thn_ajaran,
							'tgl_mulai_thn_ajar' => $post['tgl_mulai_thn_ajar'],
							'tgl_akhir_thn_ajar' => $post['tgl_akhir_thn_ajar'],
							'status_jdl' => 0,
							'status_inp_nilai' => 0,
							);
						$save = $this->thn_ajaran_model->insert($data);
						if ($save) {
							$data = 'data_thn_akademik';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_thn_angkatan'])) {
					$rules = $this->thn_angkatan_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'tahun_angkatan' => $post['thn_angkatan'],
							'tgl_masuk_angkatan' => $post['tgl_masuk_angkatan'],
							);
						$save = $this->thn_angkatan_model->insert($data);
						if ($save) {
							$data = 'data_thn_angkatan';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_identitas_pt'])) {
					$rules = $this->konfigurasi_model->rules_identitas_pt;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data_pt = array(
							'nama'            => strtoupper($post['nama']),
							'kpt'             => $post['kpt'],
							'kategori'        => $post['kategori'],
							'status'          => ucwords($post['status']),
							'btk_pendi'       => $post['btk_pendi'],
							'status_milik'    => $post['status_milik'],
							'tgl_berdiri'     => $post['tgl_berdiri'],
							'sk_pend_sekolah' => strtoupper($post['sk_pend_sekolah']),
							'tgl_sk_pend'     => $post['tgl_sk_pend'],
							/*'sk_izin_op'      => $post['sk_izin_op'],
							'tgl_sk_izin_op'  => $post['tgl_sk_izin_op'],*/
							'kebutu_khusus'   => ucwords($post['kebutu_khusus']),
							'bank'            => ucwords($post['bank']),
							'cabang_kcp_unit' => ucwords($post['cabang_kcp_unit']),
							'rekening_nama'   => $post['rekening_nama'],
							'luas_tanah_m'    => $post['luas_tanah_m'],
							'luas_tanah_bm'   => $post['luas_tanah_bm'],
							'sertifikat_iso'  => $post['sertifikat_iso'],
							'sumber_listrik'  => $post['sumber_listrik'],
							'daya_listrik'    => $post['daya_listrik'],
							'akses_internet'  => ucwords($post['akses_internet']),
							'alamat'          => ucwords($post['alamat']),
							'rt'              => $post['rt'],
							'rw'              => $post['rw'],
							'dusun'           => ucwords($post['dusun']),
							'desa_kelurahan'  => ucwords($post['desa_kelurahan']),
							'kecamatan'       => ucwords($post['kecamatan']),
							'kabupaten'       => ucwords($post['kabupaten']),
							'provinsi'        => ucwords($post['provinsi']),
							'kode_pos'        => $post['kode_pos'],
							'telepon'         => $post['telepon'],
							'fax'             => $post['fax'],
							'email'           => strtolower($post['email']),
							'website'         => strtolower($post['website']),
						);
						$data = array(
							'nama_konfigurasi' => $this->konfigurasi_model->konfigurasi_pt,
							'isi_konfigurasi' => serialize($data_pt)
						);
						$save = $this->konfigurasi_model->insert($data);
						if ($save) {
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
							$data = 'data_identitas_pt';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'record_pt' => $record_pt,
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
				elseif (isset($post['data_fakultas'])) {
					$rules = $this->fakultas_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'nama_fakultas' => ucwords($post['nama_fakultas']),
							'dekan' => ucwords($post['dekan']),
							'tgl_berdiri' => $post['tgl_berdiri'],
							'akreditasi_fk' => $post['akreditasi_fk'],
							);
						$save = $this->fakultas_model->insert($data);
						if ($save) {
							$data = 'data_fakultas';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_prodi'])) {
					$rules = $this->prodi_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'id_fk_pd' => $post['id_fk_pd'],
							'kode_prodi' => $post['kode_prodi'],
							'nama_prodi' => ucwords($post['nama_prodi']),
							'nama_kprodi' => ucwords($post['nama_kprodi']),
							'jenjang_prodi' => $post['jenjang_prodi'],
							'akreditasi_prodi' => $post['akreditasi_prodi'],
							'status_prodi' => $post['status_prodi'],
							'tgl_berdiri_prodi' => $post['tgl_berdiri_prodi'],
							'sk_peny_prodi' => strtoupper($post['sk_peny_prodi']),
							'tgl_sk_prodi' => $post['tgl_sk_prodi'],
							'alamat_prodi' => $post['alamat_prodi'],
							'kode_pos_prodi' => $post['kode_pos_prodi'],
							'telpon_prodi' => $post['telpon_prodi'],
							'fax_prodi' => $post['fax_prodi'],
							'email_prodi' => $post['email_prodi'],
							'website_prodi' => $post['website_prodi'],
							);
						$save = $this->prodi_model->insert($data);
						if ($save) {
							$data = 'data_prodi';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_konsentrasi_pd'])) {
					$rules = $this->konsentrasi_pd_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'id_pd_konst' => $post['id_pd_konst'],
							'nm_konsentrasi' => ucwords($post['nm_konsentrasi'])
							);
						$save = $this->konsentrasi_pd_model->insert($data);
						if ($save) {
							$data = 'data_konsentrasi_pd';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				echo json_encode($result);
			}
			elseif ($param == 'update') {
				if (isset($post['data_identitas_pt'])) {
					$this->in_pt = TRUE;
					$rules = $this->konfigurasi_model->rules_identitas_pt;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data_pt = array(
							'nama'            => strtoupper($post['nama']),
							'kpt'             => $post['kpt'],
							'kategori'        => $post['kategori'],
							'status'          => ucwords($post['status']),
							'btk_pendi'       => $post['btk_pendi'],
							'status_milik'    => $post['status_milik'],
							'tgl_berdiri'     => $post['tgl_berdiri'],
							'sk_pend_sekolah' => strtoupper($post['sk_pend_sekolah']),
							'tgl_sk_pend'     => $post['tgl_sk_pend'],
							/*'sk_izin_op'      => $post['sk_izin_op'],
							'tgl_sk_izin_op'  => $post['tgl_sk_izin_op'],*/
							'kebutu_khusus'   => ucwords($post['kebutu_khusus']),
							'bank'            => ucwords($post['bank']),
							'cabang_kcp_unit' => ucwords($post['cabang_kcp_unit']),
							'rekening_nama'   => $post['rekening_nama'],
							'luas_tanah_m'    => $post['luas_tanah_m'],
							'luas_tanah_bm'   => $post['luas_tanah_bm'],
							'sertifikat_iso'  => $post['sertifikat_iso'],
							'sumber_listrik'  => $post['sumber_listrik'],
							'daya_listrik'    => $post['daya_listrik'],
							'akses_internet'  => ucwords($post['akses_internet']),
							'alamat'          => ucwords($post['alamat']),
							'rt'              => $post['rt'],
							'rw'              => $post['rw'],
							'dusun'           => ucwords($post['dusun']),
							'desa_kelurahan'  => ucwords($post['desa_kelurahan']),
							'kecamatan'       => ucwords($post['kecamatan']),
							'kabupaten'       => ucwords($post['kabupaten']),
							'provinsi'        => ucwords($post['provinsi']),
							'kode_pos'        => $post['kode_pos'],
							'telepon'         => $post['telepon'],
							'fax'             => $post['fax'],
							'email'           => strtolower($post['email']),
							'website'         => strtolower($post['website']),
						);
						$where = array('nama_konfigurasi' => $this->konfigurasi_model->konfigurasi_pt);
						$data = array(
							'isi_konfigurasi' => serialize($data_pt)
						);
						$update = $this->konfigurasi_model->update($data, $where);
						$update_fields = $this->db->affected_rows();
						if ($update && $update_fields > 0) {
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
							$data = 'data_identitas_pt';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'record_pt' => $record_pt,
								);
						}
						elseif ($update && $update_fields == 0) {
							$result = array(
								'status' => 'nothing_change'
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
				elseif (isset($post['data_thn_akademik'])) {
					$this->thn_ajaran = $post['thn_ajar'].'/'.$post['smstr'];
					$this->thn_ajaran_id = $post['id_thn_ak'];
					$rules = $this->thn_ajaran_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'thn_ajaran_jdl' => $this->thn_ajaran,
							'tgl_mulai_thn_ajar' => $post['tgl_mulai_thn_ajar'],
							'tgl_akhir_thn_ajar' => $post['tgl_akhir_thn_ajar'],
							);
						$update = $this->thn_ajaran_model->update($data,array('id_thn_ak' => $post['id_thn_ak']));
						if ($update) {
							$data = 'data_thn_akademik';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_thn_angkatan'])) {
					$this->thn = $post['id_thn_angkatan'];
					$rules = $this->thn_angkatan_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'tahun_angkatan' => $post['thn_angkatan'],
							'tgl_masuk_angkatan' => $post['tgl_masuk_angkatan'],
							);
						$save = $this->thn_angkatan_model->update($data,array('id_thn_angkatan' => $post['id_thn_angkatan']));
						if ($save) {
							$data = 'data_thn_angkatan';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_fakultas'])) {
					$rules = $this->fakultas_model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$id_fk = array('id_fk' => $post['id_fk']);
						$data = array(
							'nama_fakultas' => ucwords($post['nama_fakultas']),
							'dekan' => ucwords($post['dekan']),
							'tgl_berdiri' => $post['tgl_berdiri'],
							'akreditasi_fk' => $post['akreditasi_fk'],
							);
						$save = $this->fakultas_model->update($data,$id_fk);
						if ($save) {
							$data = 'data_fakultas';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_prodi'])) {
					$rules = $this->prodi_model->rules;
					$this->form_validation->set_rules($rules);
					$this->kd_pd = $post['id_prodi'];

					if ($this->form_validation->run() == TRUE) {
						$id_pd = array('id_prodi' => $post['id_prodi']);
						$data = array(
							'id_fk_pd' => $post['id_fk_pd'],
							'kode_prodi' => $post['kode_prodi'],
							'nama_prodi' => ucwords($post['nama_prodi']),
							'nama_kprodi' => ucwords($post['nama_kprodi']),
							'jenjang_prodi' => $post['jenjang_prodi'],
							'akreditasi_prodi' => $post['akreditasi_prodi'],
							'status_prodi' => $post['status_prodi'],
							'tgl_berdiri_prodi' => $post['tgl_berdiri_prodi'],
							'sk_peny_prodi' => strtoupper($post['sk_peny_prodi']),
							'tgl_sk_prodi' => $post['tgl_sk_prodi'],
							'alamat_prodi' => $post['alamat_prodi'],
							'kode_pos_prodi' => $post['kode_pos_prodi'],
							'telpon_prodi' => $post['telpon_prodi'],
							'fax_prodi' => $post['fax_prodi'],
							'email_prodi' => $post['email_prodi'],
							'website_prodi' => $post['website_prodi'],
							);
						$save = $this->prodi_model->update($data,$id_pd);
						if ($save) {
							$data = 'data_prodi';
							$result = array(
								'status' => 'success',
								'data' => $data
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
				elseif (isset($post['data_konsentrasi_pd'])) {
					$rules = $this->konsentrasi_pd_model->rules;
					$this->in_konst = $post['id_konst'];
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == TRUE) {
						$data = array(
							'id_pd_konst' => $post['id_pd_konst'],
							'nm_konsentrasi' => ucwords($post['nm_konsentrasi'])
							);
						$id_konst = array('id_konst' => $post['id_konst']);
						$update = $this->konsentrasi_pd_model->update($data,$id_konst);
						if ($update) {
							$data = 'data_konsentrasi_pd';
							$result = array(
								'status' => 'success',
								'data' => $data,
								'pd' => $post['id_pd_konst']
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
				echo json_encode($result);
			}
			elseif ($param == 'ambil') {
				if ($post['data']=='data_thn_angkatan') {
					$thn_angkatan = $this->thn_angkatan_model->get_by_search(array('id_thn_angkatan' => $post['thn']),FALSE,array('tahun_angkatan','id_thn_angkatan','tgl_masuk_angkatan'));
					$total_rows = count($record);
					if ($thn_angkatan && $total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'record_thn' => $thn_angkatan
							 );
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data tahun angkatan yang anda pilih tidak ditemukan / data telah dihapus'
						);
					}
				}
				elseif ($post['data']=='daftar_thn_angkatan') {
					$cari = $post['value'];
					$cari = array('tahun_angkatan LIKE' => '%'.$cari.'%');
					$select = array('tahun_angkatan','id_thn_angkatan');
					$data = $this->thn_angkatan_model->get_by_search($cari,NULL,$select);
					$total_rows = count($data);
					if ($total_rows >0 ) {
						foreach ($data as $key => $value) {
							$record[] = array(
								'id' => $value->id_thn_angkatan,
								'text' => $value->tahun_angkatan
								);
						}
						$result = array(
							'thn_angkatan' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['thn_angkatan'] = '';
					}
				}
				elseif ($post['data']=='data_thn_akademik') {
					$record = $this->thn_ajaran_model->get_by_search(array('id_thn_ak' => $post['thn']),FALSE,array('id_thn_ak','thn_ajaran_jdl','tgl_mulai_thn_ajar','tgl_akhir_thn_ajar'));
					$thn_ajaran = array();
					foreach ($record as $key) {
						$vars = explode('/',$key->thn_ajaran_jdl);
						$thn = array(
							'thn_ajar' => $vars[0],
							'smstr' => $vars[1],
							);
						$thn_ajaran = array_merge((array)$key,$thn);
					}
					$total_rows = count($record);
					if ($record && $total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'record_thn' => $thn_ajaran
							 );
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data tahun akademik yang anda pilih tidak ditemukan / data telah dihapus'
						);
					}
				}
				elseif ($post['data']=='daftar_thn_akademik') {
					if (!isset($post['spec'])) {
						$cari = $post['value'];
						if ($post['status'] == 'active') {
							$cari = array('thn_ajaran_jdl LIKE' => '%'.$cari.'%', 'status_jdl' => 1);
						}
						else{
							$cari = array('thn_ajaran_jdl LIKE' => '%'.$cari.'%');
						}
						$select = array('thn_ajaran_jdl','id_thn_ak');
						$data = $this->thn_ajaran_model->get_by_search($cari,NULL,$select);
						$total_rows = count($data);
						if ($total_rows >0 ) {
							foreach ($data as $key => $value) {
								$record[] = array(
									'id' => $value->id_thn_ak,
									'text' => thn_ajaran_conv($value->thn_ajaran_jdl),
									'thn_ajaran_jdl' => $value->thn_ajaran_jdl
									);
							}
							$result = array(
								'thn_ajaran' => $record,
								'total_count' => $total_rows
								);
						}
						else{
							$result['thn_ajaran'] = '';
						}
					}
					else{
						$cari = $post['value'];
						$act = array(
							'or_like' => array(
								'thn_ajaran_jdl' => $cari,
								'nama_prodi' => $cari,
								),
							);
						$data= $this->jadwal_model->get_detail_data('get',array('thn_akademik','mata_kuliah','prodi_mk'),$act,NULL,FALSE,array('id_thn_ak_jdl','thn_ajaran_jdl','id_pd_mk','nama_prodi','jenjang_prodi'),array('thn_ajaran_jdl','id_pd_mk'),'thn_ajaran_jdl DESC');
						$total_rows = count($data);
						if ($total_rows >0 ) {
							foreach ($data as $key => $value) {
								$data[] = array(
									'id' => $value->id_thn_ak_jdl.' '.$value->id_pd_mk,
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
				}
				elseif ($post['data']=='data_identitas_pt') {
					$total_rows = $this->konfigurasi_model->count(array('nama_konfigurasi' => $this->konfigurasi_model->konfigurasi_pt));
					if ($total_rows > 0) {
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
						$result = array('data' => $record_pt);
					}
					else{
						$result = array('status' => 'empty');
					}
				}
				elseif ($post['data']=='data_fakultas') {
					$record = $this->fakultas_model->get_by(array('id_fk' => $post['id_fk']));
					$total_rows = count($record);
					if ($total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'record' => $record
						);
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data fakultas yang anda pilih tidak ditemukan / data telah dihapus'
						);
					}
				}
				elseif ($post['data']=='daftar_fk') {
					$cari = $post['value'];
					$cari = array('nama_fakultas LIKE' => '%'.$cari.'%');
					$select = array('nama_fakultas','id_fk');
					$data = $this->fakultas_model->get_by_search($cari,NULL,$select);
					$total_rows = count($data);
					if ($total_rows >0 ) {
						foreach ($data as $key => $value) {
							$record[] = array(
								'id' => $value->id_fk,
								'text' => $value->nama_fakultas
								);
						}
						$result = array(
							'fk' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['fk'] = '';
					}
				}
				elseif ($post['data']=='daftar_pd') {
					$cari = $post['value'];
					$cari = array('nama_prodi LIKE' => '%'.$cari.'%', 'status_prodi' => 1);
					$select = array('nama_prodi','id_prodi','jenjang_prodi');
					$data = $this->prodi_model->get_by_search($cari,NULL,$select);
					$total_rows = count($data);
					if ($total_rows >0 ) {
						foreach ($data as $key => $value) {
							$record[] = array(
								'id' => $value->id_prodi,
								'text' => $value->nama_prodi.' ('.$value->jenjang_prodi.')'
								);
						}
						$result = array(
							'pd' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['pd'] = '';
					}
				}
				elseif ($post['data']=='detail_fk') {
					$fakultas = $this->prodi_model->get_detail_data('get',array('fakultas'),NULL,array('id_fk_pd' => $post['id']),NULL,array('id_prodi','id_fk_pd','kode_prodi','nama_prodi','status_prodi','jenjang_prodi','nama_fakultas','dekan','akreditasi_fk','tgl_berdiri'));
					$detail_fak = array();
					if ($fakultas) {
						foreach ($fakultas as $key) {
							$arr = array('tgl_berdiri' => date_convert($key->tgl_berdiri));
							$detail_fak[] = array_merge((array)$key,$arr);
						}
						$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
										LEFT JOIN {PRE}prodi ON {PRE}prodi.id_prodi = {PRE}mahasiswa.id_pd_mhs
										WHERE id_fk_pd = '.$post['id'].' AND jk = "L") AS jml_lk';
						$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
										LEFT JOIN {PRE}prodi ON {PRE}prodi.id_prodi = {PRE}mahasiswa.id_pd_mhs
										WHERE id_fk_pd = '.$post['id'].' AND jk = "P") AS jml_pr';
						$count_mhs = $this->mahasiswa_model->get_detail_data('get',NULL,NULL,NULL,TRUE,$sub_query);
						$count_fk_mhs = array(
							'jml_mhs' => number_format($count_mhs->jml_lk + $count_mhs->jml_pr,0,',','.'),
							'jml_lk' => number_format($count_mhs->jml_lk,0,',','.'),
							'jml_pr' => number_format($count_mhs->jml_pr,0,',','.')
							);
					}
					$result = array(
						'data' => $detail_fak,
						'count_fk_mhs' => @$count_fk_mhs
						);
				}
				elseif ($post['data']=='data_prodi') {
					if (isset($post['act']) && $post['act'] == 'edit') {
						/*$data = $this->prodi_model->get_detail_data('get',array('fakultas'),NULL,array('id_prodi' => $post['id_pd']),FALSE,list_fields(array('prodi'),array('nama_fakultas')));*/
					}
					else{
						$sub_query_count_lk = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE id_pd_mhs = id_prodi AND jk = "L") AS jml_lk';
						$sub_query_count_pr = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE id_pd_mhs = id_prodi AND jk = "P") AS jml_pr';
						/*$data = $this->prodi_model->get_detail_data('get',array('fakultas','konsentrasi_pd'),NULL,array('id_prodi' => $post['id_pd']),FALSE,list_fields(array('prodi'),array('nama_fakultas','id_konst','id_pd_konst','nm_konsentrasi')),NULL,'nm_konsentrasi ASC');*/
					}
					$data = $this->prodi_model->get_detail_data('get',array('fakultas'),NULL,array('id_prodi' => $post['id_pd']),FALSE,list_fields(array('prodi'),array('nama_fakultas',@$sub_query_count,@$sub_query_count_lk,@$sub_query_count_pr)));
					$prodi = array();
					foreach ($data as $key) {
						if ($key->status_prodi == 1) {
							$status_pd = 'Aktif';
						}
						else{
							$status_pd = 'Tidak Aktif';
						}
						/*$count_jml = $this->mahasiswa_model->count(array('id_pd_mhs' => $key->id_prodi));
						$count_lk = $this->mahasiswa_model->count(array('id_pd_mhs' => $key->id_prodi, 'jk' => 'L'));
						$count_pr = $this->mahasiswa_model->count(array('id_pd_mhs' => $key->id_prodi, 'jk' => 'P'));*/
						$arr = array(
							'status' => $status_pd,
							'jml_mhs' => number_format(@$key->jml_lk + @$key->jml_pr,0,',','.'),
							'tgl_berdiri_prodi' => date_convert($key->tgl_berdiri_prodi),
							'tgl_sk_prodi' => date_convert($key->tgl_sk_prodi)
							);
						$prodi[] = array_merge((array)$key,$arr);
					}
					$total_rows = count($prodi);
					if ($total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'data' => $prodi,
							);
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data program studi yang anda pilih tidak ditemukan / data telah dihapus'
							);
					}
				}
				elseif ($post['data']=='data_konsentrasi_pd') {
					$data = $this->konsentrasi_pd_model->get_detail_data('get',array('prodi_konst'),NULL,array('id_konst' => $post['id']),FALSE,array('nama_prodi','jenjang_prodi','id_konst','id_pd_konst','nm_konsentrasi'));
					$total_rows = count($data);
					if ($total_rows > 0) {
						$result = array(
							'total_rows' => $total_rows,
							'data' => $data
							);
					}
					else{
						$result = array(
							'total_rows' => $total_rows,
							'message' => 'Data konsentrasi program studi yang anda pilih tidak ditemukan / data telah dihapus'
							);
					}
				}
				elseif ($post['data']=='daftar_konsentrasi_pd') {
					$data = $this->konsentrasi_pd_model->get_detail_data('get',array('prodi_konst'),NULL,array('id_pd_konst' => $post['id_konst']),FALSE,array('nama_prodi','id_konst','id_pd_konst','nm_konsentrasi'));
					$result = array(
						'data' => $data
						);
				}
				elseif ($post['data']=='daftar_konsentrasi') {
					$cari = $post['value'];
					if (isset($post['prodi']) && $post['prodi'] != '') {
						$cari = array('nm_konsentrasi LIKE' => '%'.$cari.'%' , 'id_pd_konst' => $post['prodi']);
					}
					else{
						$cari = array('nm_konsentrasi LIKE' => '%'.$cari.'%');
					}
					$select = array('nm_konsentrasi','id_konst','nama_prodi','jenjang_prodi');
					$data = $this->konsentrasi_pd_model->get_detail_data('get',array('prodi_konst'),NULL,$cari,FALSE,$select);
					$total_rows = count($data);
					if ($total_rows >0 ) {
						foreach ($data as $key => $value) {
							$record[] = array(
								'id' => $value->id_konst,
								'text' => $value->nm_konsentrasi.' | '.$value->nama_prodi.'('.$value->jenjang_prodi.')',
								'detail' => $value->nm_konsentrasi,
								'nama_prodi' => $value->nama_prodi,
								'jenjang_prodi' => $value->jenjang_prodi
								);
						}
						$result = array(
							'konsentrasi' => $record,
							'total_count' => $total_rows
							);
					}
					else{
						$result['konsentrasi'] = '';
					}
				}
				elseif ($post['data']=='check_data_master') {
					$id_ptk_check = array();
					if ($post['check'] == 'data_pd') {
						foreach ($post['id'] as $key) {
							$id_pd_check[] = $key;
						}
						$count_check = count($id_pd_check);
						if ($count_check > 0) {
							$act = array(
								'in' => array(
									'id_prodi' => $id_pd_check,
									),
								);
							$data = $this->prodi_model->get_detail_data('get',NULL,$act,NULL,FALSE,array('nama_prodi AS nm'));
							$count_check = count($data);
							if (count($data) == 0) {
								$message = 'Program studi yang anda pilih tidak ada didalam database atau sudah terhapus!';
							}
						}
					}
					elseif ($post['check'] == 'data_fk') {
						foreach ($post['id'] as $key) {
							$id_fk_check[] = $key;
						}
						$count_check = count($id_fk_check);
						if ($count_check > 0) {
							$act = array(
								'in' => array(
									'id_fk' => $id_fk_check,
									),
								);
							$data = $this->fakultas_model->get_detail_data('get',NULL,$act,NULL,FALSE,array('nama_fakultas AS nm'));
							$count_check = count($data);
							if (count($data) == 0) {
								$message = 'Fakultas yang anda pilih tidak ada didalam database atau sudah terhapus!';
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
							);
					}
				}
				elseif ($post['data']=='check_thn_ak') {
					$record = $this->thn_ajaran_model->get_by_search(array('id_thn_ak' => $post['thn_ak']),TRUE,array('thn_ajaran_jdl'));
					if ($record) {
						$result = array(
							'status' => 'success',
							'thn_akademik' => thn_ajaran_conv($record->thn_ajaran_jdl)
							 );
					}
					else{
						$result = array('status' => 'empty',);
					}
				}
				elseif ($post['data']=='check_thn_angkatan') {
					$record = $this->thn_angkatan_model->get_by_search(array('id_thn_angkatan' => $post['thn_ak']),TRUE,array('tahun_angkatan'));
					if ($record) {
						$result = array(
							'status' => 'success',
							'thn_angkatan' => $record->tahun_angkatan
							 );
					}
					else{
						$result = array('status' => 'empty',);
					}
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
				$result['n_token'] = $this->security->get_csrf_hash();
				echo json_encode($result,TRUE);
			}
			elseif ($param == 'ambil_id') {
				if ($post['data']=='data_fakultas') {
					$id = array('id_fk' => $post['id_fk']);
					$select_fk = array('id_fk','nama_fakultas');
					$record_fk = $this->fakultas_model->get_by_search($id,FALSE,$select_fk);
					$result = array(
							'total_rows' => count($record_fk),
							'record_fk' => $record_fk,
							);
				}
				elseif ($post['data']=='data_prodi') {
					$id = array('id_prodi' => $post['id_pd']);
					$select_pd = array('id_prodi','id_fk_pd','nama_prodi','jenjang_prodi');
					$record_pd = $this->prodi_model->get_by_search($id,FALSE,$select_pd);
					$result = array(
							'total_rows' => count($record_pd),
							'record_pd' => $record_pd,
							);
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
				$result['n_token'] = $this->security->get_csrf_hash();
				echo json_encode($result);
			}
			elseif ($param == 'delete') {
				if (isset($post['data_fakultas'])) {
					$delete_fk_by = array('id_fk' => $post['id_fk']);
					$delete_fk = $this->fakultas_model->delete_by($delete_fk_by);

					if ($delete_fk) {
						$data = 'data_fakultas';
						$result = array(
							'status' => 'success',
							'data' => $data
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_prodi'])) {
					$delete_pd_by = array('id_prodi' => $post['id_prodi']);
					$delete_pd = $this->prodi_model->delete_by($delete_pd_by);

					if ($delete_pd) {
						$data = 'data_prodi';
						$result = array(
							'status' => 'success',
							'data' => $data
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data_konsentrasi_pd'])) {
					$delete_konst_by = array('id_konst' => $post['id_konst']);
					$delete_konst = $this->konsentrasi_pd_model->delete_by($delete_konst_by);

					if ($delete_konst) {
						$data = 'data_konsentrasi_pd';
						$result = array(
							'status' => 'success',
							'data' => $data,
							'pd' => $post['id_pd_konst']
							);
					}
					else{
						$result = array('status' => 'failed_db');
					}
				}
				elseif (isset($post['data'])) {
					if ($post['data'] == 'data_fakultas') {
						$id = $post['id'];
						foreach ($id as $key) {
							$id_fk = $key;
							$where_fk = array('id_fk' => $id_fk);
							$delete_fk = $this->fakultas_model->delete_by($where_fk);
						}
						if ($delete_fk) {
							$result = array('status' => 'success');
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					elseif ($post['data'] == 'data_prodi') {
						$id = $post['id'];
						foreach ($id as $key) {
							$i = explode('/',$key);
							$id_pd = $i[0];
							$id_fk = $i[1];
							$where_pd = array('id_prodi' => $id_pd);
							$delete_pd = $this->prodi_model->delete_by($where_pd);
						}
						if ($delete_pd) {
							$result = array(
								'status' => 'success',
								'data' => $id_fk,
								);
						}
						else{
							$result = array('status' => 'failed_db');
						}
					}
					else{
						$result = array('status_action' => 'Not find...');
					}
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
				$result['n_token'] = $this->security->get_csrf_hash();
				echo json_encode($result);
			}
			elseif ($param == 'update_status') {
				if ($post['data'] == 'thn_ajaran_status') {
					if ($post['status'] == 'true') {
						$status = 1;
						$data = array('status_jdl' => $status);
					}
					else{
						$status = 0;
						$data = array('status_jdl' => $status, 'status_inp_nilai' => $status);
					}
					$where = array('id_thn_ak' => $post['in']);
					$update_status = $this->thn_ajaran_model->update($data,$where);
					if ($update_status) {
						if ($status == 1) {
							$non_aktif_thn = $this->thn_ajaran_model->update(array('status_jdl' => 0, 'status_inp_nilai' => 0),array('status_jdl' => 1),FALSE,'id_thn_ak',array($post['in']));
						}
						$result = array(
							'status' => 'success',
							'status_thn' => $status,
							);
					}
					else{
						$result = array(
							'status' => 'failed',
							'status_thn' => $status,
							);
					}
				}
				elseif ($post['data'] == 'thn_ajaran_status_inp') {
					if ($post['status'] == 'true') {
						$status = 1;
						$data = array('status_inp_nilai' => $status);
					}
					else{
						$status = 0;
						$data = array('status_inp_nilai' => $status);
					}
					$where = array('id_thn_ak' => $post['in']);
					$update_status = $this->thn_ajaran_model->update($data,$where);
					if ($update_status) {
						$result = array(
							'status' => 'success',
							'status_thn' => $status,
							);
					}
					else{
						$result = array(
							'status' => 'failed',
							'status_thn' => $status,
							);
					}
				}
				elseif ($post['data'] == 'thn_ajaran_status_non') {
					$data = array('status_jdl' => 0, 'status_inp_nilai' => 0);
					$where = array('status_jdl' => 1);
					$update_status = $this->thn_ajaran_model->update($data,$where);
					if ($update_status) {
						$result = array(
							'status' => 'success',
							);
					}
					else{
						$result = array(
							'status' => 'failed',
							'status_thn' => $status,
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
				$result = array('status_action' => 'Not find...','n_token' => $this->security->get_csrf_hash());
				echo json_encode($result);
			}
		}
	}

	public function data_table_request($param){
		$post = $this->input->post(NULL, TRUE);
		if ($param == 'data_thn_akademik') {
			$fetch_data = $this->thn_ajaran_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				$sub_query[] = '(SELECT COUNT(*) FROM
									(SELECT * FROM {PRE}kelas_nilai_mhs
									LEFT JOIN {PRE}jadwal_kuliah ON {PRE}jadwal_kuliah.id_jdl = {PRE}kelas_nilai_mhs.id_jdl_kls
									LEFT JOIN {PRE}thn_akademik ON {PRE}thn_akademik.id_thn_ak = {PRE}jadwal_kuliah.id_thn_ak_jdl
									WHERE id_thn_ak_jdl = '.$row->id_thn_ak.'
									GROUP BY id_mhs_kls) count_mhs
								) AS jml_mhs';
				$sub_query[] = '(SELECT COUNT(*) FROM
									(SELECT * FROM {PRE}kelas_nilai_mhs
									LEFT JOIN {PRE}jadwal_kuliah ON {PRE}jadwal_kuliah.id_jdl = {PRE}kelas_nilai_mhs.id_jdl_kls
									LEFT JOIN {PRE}thn_akademik ON {PRE}thn_akademik.id_thn_ak = {PRE}jadwal_kuliah.id_thn_ak_jdl
									LEFT JOIN {PRE}mahasiswa ON {PRE}mahasiswa.id = {PRE}kelas_nilai_mhs.id_mhs_kls
									WHERE id_thn_ak_jdl = '.$row->id_thn_ak.' AND jk = "L"
									GROUP BY id_mhs_kls) count_mhs
								) AS jml_mhs_lk';
				$sub_query[] = '(SELECT COUNT(*) FROM
									(SELECT * FROM {PRE}kelas_nilai_mhs
									LEFT JOIN {PRE}jadwal_kuliah ON {PRE}jadwal_kuliah.id_jdl = {PRE}kelas_nilai_mhs.id_jdl_kls
									LEFT JOIN {PRE}thn_akademik ON {PRE}thn_akademik.id_thn_ak = {PRE}jadwal_kuliah.id_thn_ak_jdl
									LEFT JOIN {PRE}mahasiswa ON {PRE}mahasiswa.id = {PRE}kelas_nilai_mhs.id_mhs_kls
									WHERE id_thn_ak_jdl = '.$row->id_thn_ak.' AND jk = "P"
									GROUP BY id_mhs_kls) count_mhs
								) AS jml_mhs_pr';
				$count_mhs = $this->db->select($sub_query)->get()->result();

				$thn = thn_ajaran_conv($row->thn_ajaran_jdl);
				$o_data = array(
					'thn_ajaran_jdl' => $thn,
					'tgl_ma_ajar'    => date_convert($row->tgl_mulai_thn_ajar).' - '.date_convert($row->tgl_akhir_thn_ajar)
					/*'jml_mhs'        => $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,array('id_thn_ak_jdl' => $row->id_thn_ak),FALSE,NULL,array('id_mhs_kls')),
					'jml_mhs_lk'     => $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,array('id_thn_ak_jdl' => $row->id_thn_ak,'jk' => 'L'),FALSE,NULL,array('id_mhs_kls')),
					'jml_mhs_pr'     => $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,array('id_thn_ak_jdl' => $row->id_thn_ak,'jk' => 'P'),FALSE,NULL,array('id_mhs_kls')),*/
					);
				$data[]      = array_merge((array)$row,$o_data,(array)$count_mhs[0]);
			}
			$recordsTotal = $this->thn_ajaran_model->get_all_data();
			$recordsFiltered = $this->thn_ajaran_model->get_filtered_data();
		}
		elseif ($param == 'data_thn_angkatan') {
			$fetch_data = $this->thn_angkatan_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				if ($row->tgl_masuk_angkatan == '0000-00-00') {
					$tgl_masuk = '-';
				}
				else{
					$tgl_masuk = date_convert($row->tgl_masuk_angkatan);
				}
				$count = array(
					'tgl_masuk_angkatan' => $tgl_masuk,
					'laki_laki'       => number_conv($row->laki_laki,0,',','.'),
					'perempuan'       => number_conv($row->perempuan,0,',','.'),
					'jumlah'          => number_conv($row->jumlah,0,',','.')
					);
				$data[]      = array_merge((array)$row,$count);
			}
			$recordsTotal = $this->thn_angkatan_model->get_all_data();
			$recordsFiltered = $this->thn_angkatan_model->get_filtered_data();
		}
		elseif ($param == 'data_fakultas') {
			$fetch_data = $this->fakultas_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				$date = array('tgl_berdiri' => date_convert($row->tgl_berdiri));
				$data[]      = array_merge((array)$row,$date);
			}
			$recordsTotal = $this->fakultas_model->get_all_data();
			$recordsFiltered = $this->fakultas_model->get_filtered_data();
		}
		elseif ($param == 'data_prodi') {
			$fetch_data = $this->prodi_model->make_datatables();
			$data = array();
			foreach($fetch_data as $row){
				if ($row->status_prodi == 1) {
					$status_pd = 'Aktif';
				}
				else{
					$status_pd = 'Tidak Aktif';
				}
				/*$count_jml = $this->mahasiswa_model->count(array('id_pd_mhs' => $row->id_prodi));*/
				$st_pd = array(
					'status_prodi' => $status_pd,
					'count_mhs_prodi' => number_format($row->count_mhs_prodi,0,',','.')
					);
				$data[]      = array_merge((array)$row,$st_pd);
			}
			$recordsTotal = $this->prodi_model->get_all_data();
			$recordsFiltered = $this->prodi_model->get_filtered_data();
		}
		$output = array(
			"draw"            => intval(@$post["draw"]),
			"recordsTotal"    => @$recordsTotal,
			"recordsFiltered" => @$recordsFiltered,
			"data"            => @$data,
			"n_token"         => $this->security->get_csrf_hash(),
		);
		echo json_encode($output);
	}

	public function data_statistik(){
		$post = $this->input->post(NULL, TRUE);
		if ($post['data'] == 'static_mhs_fk') {
			$count_mhs = $this->mahasiswa_model->count();
			if ($count_mhs > 0) {
				$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
									LEFT JOIN {PRE}prodi ON {PRE}prodi.id_prodi = {PRE}mahasiswa.id_pd_mhs
									WHERE id_fk_pd = id_fk) AS count_mhs_fk';
				$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
									LEFT JOIN {PRE}prodi ON {PRE}prodi.id_prodi = {PRE}mahasiswa.id_pd_mhs
									WHERE id_fk_pd = id_fk AND jk = "L") AS count_mhs_lk';
				$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
									LEFT JOIN {PRE}prodi ON {PRE}prodi.id_prodi = {PRE}mahasiswa.id_pd_mhs
									WHERE id_fk_pd = id_fk AND jk = "P") AS count_mhs_pr';
				$select_fld = array_merge(array('id_fk','nama_fakultas'),$sub_query);
				$daftar_fk = $this->fakultas_model->get_by_search(NULL,FALSE,$select_fld);
				$fk = array();
				$nama_fk = array();
				$mhs_lk = array();
				$mhs_pr = array();
				$color = array();
				$no = 0;
				foreach ($daftar_fk as $key) {
					$count_mhs_fk = $key->count_mhs_fk;
					$statik_mhs_fk = $count_mhs_fk/$count_mhs*100;
					$detail_grafik = array(
						'count_mhs' => number_format($count_mhs_fk,0,',','.'),
						'statik_mhs' => round($statik_mhs_fk),
						'color_detail' => color_pd_static($no),
						'nama_fakultas' => $key->nama_fakultas,
						'id_fk' => $no,
						);
					$fk[] = array_merge((array)$key,$detail_grafik);

					$nama_fk[] = $key->nama_fakultas;
					$color[] = color_pd_static($no);
					$mhs_lk[] = intval($key->count_mhs_lk);
					$mhs_pr[] = intval($key->count_mhs_pr);
					$no++;
				}
				$result = array(
					'status' => 'success',
					'fk' => $fk,
					'nama_fk' => $nama_fk,
					'mhs_lk' => $mhs_lk,
					'mhs_pr' => $mhs_pr,
					'color' => $color,
					);
			}
			else{
				$result = array('status' => 'empty');
			}
		}
		elseif ($post['data'] == 'static_thn_ak') {
			$count_thn = $this->thn_ajaran_model->count();
			if ($count_thn > 0 ) {
				if (isset($post['thn_ak'])) {
					$where = array('id_thn_ak' => $post['thn_ak']);
					$thn = $this->thn_ajaran_model->get_by_search($where,TRUE,array('thn_ajaran_jdl'));
				}
				else{
					$where = array('status_jdl' => 1);
					$thn = $this->thn_ajaran_model->get_by_search($where,TRUE,array('thn_ajaran_jdl'));
					if (!$thn) {
						$thn = $this->thn_ajaran_model->get_by(NULL,1,NULL,TRUE,array('id_thn_ak','thn_ajaran_jdl'),'thn_ajaran_jdl DESC');
						$where = array('id_thn_ak' => $thn->id_thn_ak);
					}
				}
				$daftar_pd = $this->prodi_model->get_by_search(NULL,FALSE,array('id_prodi','nama_prodi','jenjang_prodi'));
				$count_mhs = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,$where,FALSE,NULL,array('id_mhs_kls'));
				$prodi = array();
				$nama_prodi = array();
				$mhs_lk = array();
				$mhs_pr = array();
				$color = array();
				$no = 0;
				$pd = 1;
				foreach ($daftar_pd as $key) {
					$where = array_merge($where,array('id_pd_mhs' => $key->id_prodi));
					$where_l = array_merge($where,array('id_pd_mhs' => $key->id_prodi,'jk' => 'L'));
					$where_p = array_merge($where,array('id_pd_mhs' => $key->id_prodi,'jk' => 'P'));

					$count_mhs_pd = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,$where,FALSE,NULL,array('mahasiswa.id'));
					$statik_mhs_pd = $count_mhs_pd/$count_mhs*100;
					$detail_grafik = array(
						'count_mhs' => number_format($count_mhs_pd,0,',','.'),
						'statik_mhs' => round($statik_mhs_pd),
						'color_detail' => color_pd_static($no),
						'no_prodi' => 'Prodi '.$pd
						);
					$prodi[] = array_merge((array)$key,$detail_grafik);

					$nama_prodi[] = 'Prodi '.$pd;
					$color[] = color_pd_static($no);
					$mhs_lk[] = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,$where_l,FALSE,NULL,array('mahasiswa.id'));
					$mhs_pr[] = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,$where_p,FALSE,NULL,array('mahasiswa.id'));
					$no++;
					$pd++;
				}
				$result = array(
					'status' => 'success',
					'pd' => $prodi,
					'nama_prodi' => $nama_prodi,
					'mhs_lk' => $mhs_lk,
					'mhs_pr' => $mhs_pr,
					'color' => $color,
					'thn_ak' => thn_ajaran_conv($thn->thn_ajaran_jdl)
					);
			}
			else{
				$result = array('status' => 'empty');
			}
		}
		elseif ($post['data'] == 'static_mhs_thn_ak') {
			$where = array('id_thn_ak' => $post['thn_ak']);
			$thn = $this->thn_ajaran_model->get_by_search($where,TRUE,array('thn_ajaran_jdl'));

			$daftar_pd = $this->prodi_model->get_by_search(NULL,FALSE,array('id_prodi','nama_prodi','jenjang_prodi'));
			$count_mhs = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik'),NULL,$where,FALSE,NULL,array('id_mhs_kls'));
			$prodi = array();
			$nama_prodi = array();
			$mhs_lk = array();
			$mhs_pr = array();
			$color = array();
			$no = 0;
			$pd = 1;
			foreach ($daftar_pd as $key) {
				$where = array_merge($where,array('id_pd_mhs' => $key->id_prodi));
				$where_l = array_merge($where,array('id_pd_mhs' => $key->id_prodi,'jk' => 'L'));
				$where_p = array_merge($where,array('id_pd_mhs' => $key->id_prodi,'jk' => 'P'));

				$count_mhs_pd = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,$where,FALSE,NULL,array('mahasiswa.id'));
				$statik_mhs_pd = $count_mhs_pd/$count_mhs*100;
				$detail_grafik = array(
					'count_mhs' => number_format($count_mhs_pd,0,',','.'),
					'statik_mhs' => round($statik_mhs_pd),
					'color_detail' => color_pd_static($no),
					'no_prodi' => 'Prodi '.$pd
					);
				$prodi[] = array_merge((array)$key,$detail_grafik);

				$nama_prodi[] = 'Prodi '.$pd;
				$color[] = color_pd_static($no);
				$mhs_lk[] = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,$where_l,FALSE,NULL,array('mahasiswa.id'));
				$mhs_pr[] = $this->kelas_model->get_detail_data('count',array('jadwal','thn_akademik','mahasiswa'),NULL,$where_p,FALSE,NULL,array('mahasiswa.id'));
				$no++;
				$pd++;
			}
			$result = array(
				'pd' => $prodi,
				'nama_prodi' => $nama_prodi,
				'mhs_lk' => $mhs_lk,
				'mhs_pr' => $mhs_pr,
				'color' => $color,
				'thn_ak' => thn_ajaran_conv($thn->thn_ajaran_jdl)
				);
		}
		elseif ($post['data'] == 'static_mhs_thn_angkatan') {
			$where = array('id_thn_angkatan' => $post['thn_ak']);
			$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE thn_angkatan = id_thn_angkatan) AS count_mhs';
			$select_fld = array_merge(array('tahun_angkatan'),$sub_query);
			$thn = $this->thn_angkatan_model->get_by_search($where,TRUE,$select_fld);
			$count_mhs = $thn->count_mhs;

			$sub_query_pd[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
								WHERE id_pd_mhs = id_prodi AND thn_angkatan = '.$post['thn_ak'].') AS count_mhs_pd';
			$sub_query_pd[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
								WHERE id_pd_mhs = id_prodi AND thn_angkatan = '.$post['thn_ak'].' AND jk = "L") AS count_mhs_lk';
			$sub_query_pd[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa
								WHERE id_pd_mhs = id_prodi AND thn_angkatan = '.$post['thn_ak'].' AND jk = "P") AS count_mhs_pr';
			$select_fld = array_merge(array('id_prodi','nama_prodi','jenjang_prodi'),$sub_query_pd);
			$daftar_pd = $this->prodi_model->get_by_search(NULL,FALSE,$select_fld);
			$prodi = array();
			$nama_prodi = array();
			$mhs_lk = array();
			$mhs_pr = array();
			$color = array();
			$no = 0;
			$pd = 1;
			foreach ($daftar_pd as $key) {
				$count_mhs_pd = $key->count_mhs_pd;
				$statik_mhs_pd = $count_mhs_pd/$count_mhs*100;
				$detail_grafik = array(
					'count_mhs' => number_format($count_mhs_pd,0,',','.'),
					'statik_mhs' => round($statik_mhs_pd),
					'color_detail' => color_pd_static($no),
					'no_prodi' => 'Prodi '.$pd
					);
				$prodi[] = array_merge((array)$key,$detail_grafik);

				$nama_prodi[] = 'Prodi '.$pd;
				$color[] = color_pd_static($no);
				$mhs_lk[] = $key->count_mhs_lk;
				$mhs_pr[] = $key->count_mhs_pr;
				$no++;
				$pd++;
			}
			$result = array(
				'pd' => $prodi,
				'nama_prodi' => $nama_prodi,
				'mhs_lk' => $mhs_lk,
				'mhs_pr' => $mhs_pr,
				'color' => $color,
				'thn_ak' => $thn->tahun_angkatan
				);
		}
		$result['n_token'] = $this->security->get_csrf_hash();
		echo json_encode($result);
	}

	public function thn_valid($string){
		if ($this->thn != NULL) {
			$id_thn = $this->thn;
			$act = array(
				'not_in' => array(
					'id_thn_angkatan' => array($id_thn),
					),
				);
			$thn_check = array('tahun_angkatan' => $string);
			$check = $this->thn_angkatan_model->get_detail_data('count',NULL,$act,$thn_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$thn = array('tahun_angkatan' => $string, );
			$check = $this->thn_angkatan_model->count($thn);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function kd_pd_check($string){
		$id_pd = $this->kd_pd;
		if ($id_pd == NULL) {
			if (!empty($string)) {
				$kd_pd_check = array('kode_prodi' => $string);
				$check = $this->prodi_model->count($kd_pd_check);
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
					'id_prodi' => array($id_pd),
					),
				);
			$kd_pd_check = array('kode_prodi' => $string);
			$check = $this->prodi_model->get_detail_data('count',NULL,$act,$kd_pd_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function fk_pd_check($string){
		if ($string != '') {
			$check = $this->fakultas_model->count(array('id_fk' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('fk_pd_check', 'Maaf, fakultas yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('fk_pd_check', 'Tolong pilih fakultas');
			return FALSE;
		}
	}

	public function pd_check_ex($string){
		if ($string != '' && $string != NULL) {
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
			$this->form_validation->set_message('pd_check_ex', 'Tolong pilih program studi');
			return FALSE;
		}
	}

	public function konst_check($string){
		$post = $this->input->post(NULL, TRUE);
		if ($string != '') {
			if (isset($post['id_pd_konst'])) {
				$act = array(
					'like' => array(
						'nm_konsentrasi' => $string
					),
				);
				$c_konst = $this->in_konst;
				if ($c_konst != NULL) {
					$arr = array(
						'not_in' => array(
							'id_konst' => $c_konst
						),
					);
					$act = array_merge($act,$arr);
				}
				$check = $this->konsentrasi_pd_model->get_detail_data('count',NULL,$act,array('id_pd_konst' => $post['id_pd_konst']));
				if ($check > 0) {
					$this->form_validation->set_message('konst_check', 'Konsentrasi yang anda masukkan sudah ada / konsentrasi yang anda masukkan memiliki kesamaan dengan konsentrasi lain');
					return FALSE;
				}
				else{
					return TRUE;
				}
			}
			else{
				$act = array(
					'like' => array(
						'nm_konsentrasi' => $string
					),
				);
				$c_konst = $this->in_konst;
				if ($c_konst != NULL) {
					$arr = array(
						'not_in' => array(
							'id_konst' => $c_konst
						),
					);
					$act = array_merge($act,$arr);
				}
				$check = $this->konsentrasi_pd_model->get_detail_data('count',NULL,$act);
				if ($check > 0) {
					$this->form_validation->set_message('konst_check', 'Konsentrasi yang anda masukkan sudah ada / konsentrasi yang anda masukkan memiliki kesamaan dengan konsentrasi lain');
					return FALSE;
				}
				else{
					return TRUE;
				}
			}
		}
	}

	public function check_thn_ajaran(){
		if ($this->thn_ajaran_id == NULL) {
			$thn = $this->thn_ajaran;
			$check = $this->thn_ajaran_model->count(array('thn_ajaran_jdl' => $thn));
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$thn = $this->thn_ajaran;
			$thn_id = $this->thn_ajaran_id;
			$act = array(
				'not_in' => array(
					'id_thn_ak' => array($thn_id),
					),
				);
			$thn_check = array('thn_ajaran_jdl' => $thn);
			$check = $this->thn_ajaran_model->get_detail_data('count',NULL,$act,$thn_check);
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	public function check_pt(){
		if ($this->in_pt == NULL) {
			$check = $this->konfigurasi_model->count(array('nama_konfigurasi' => $this->konfigurasi_model->konfigurasi_pt));
			if ($check > 0) {
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$check = $this->konfigurasi_model->count(array('nama_konfigurasi' => $this->konfigurasi_model->konfigurasi_pt));
			if ($check > 0) {
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}

}
