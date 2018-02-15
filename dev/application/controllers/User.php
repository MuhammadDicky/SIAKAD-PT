<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Backend_Controller {

	protected $user_detail;
	protected $user_insert;
	protected $pass_cookie = NULL;

	public function __construct(){
		parent::__construct();		
	}

	public function login(){
		$this->site->login_status_check();
		if (get_cookie('user_in',TRUE) != NULL) {
			$str = explode('-',get_cookie('user_in',TRUE));
			$id = explode('_',$str[1]);
			if ($str[2] == 'mhs') {
				$record = $this->mahasiswa_model->get_by_search(array('id' => substr($id[0],3)),TRUE,array('nama', 'photo_mhs AS photo'));
			}
			elseif ($str[2] == 'ptk'){
				$record = $this->ptk_model->get_by_search(array('id_ptk' => substr($id[0],3)),TRUE,array('nama_ptk AS nama', 'photo_ptk AS photo'));
			}
			else{
				redirect(base_url('logout'));
			}

			if (!$record) {
				redirect(base_url('logout'));
			}
			else{
				$photo = photo_u();
				if ($record->photo != '') {
					$this->load->helper('file');
					$check_file = get_file_info('uploads/'.$str[2].'-photo/'.$record->photo);
					if ($check_file != FALSE) {
						$photo = photo_u($str[2],$record->photo.'?n_img='.rand_val(20));
					}
				}
				$data = array(
					'login' => 'lockscreen',
					'last_log' => $record,
					'photo' => $photo
					);
			}
		}
		else{
			$data = array(
				'login' => 'login_again',
				);
		}
		$this->site->view('page/others/'.$this->router->method,$data);
	}

	public function login_auth(){
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL) {
			$post = $this->input->post(NULL,TRUE);
			if (!isset($post['password'])) {
				$post['remember'] = 'on';

				$str_user = explode('-',get_cookie('user_u',TRUE));
				$user = $str_user[0];
				$this->user_insert = $user;

				$str_pass = explode('-',get_cookie('pass_u',TRUE));
				$post['password'] = $str_pass[0];
				$this->pass_cookie = $str_pass[0];
			}
			elseif (get_cookie('user_in',TRUE) != NULL) {
				$str = explode('-',get_cookie('user_in',TRUE));
				$user = $str[0];
				$this->user_insert = $user;
			}
			else{
				$user = $post['username'];
				$this->user_insert = $post['username'];
			}

			$select_u = array('id_user','id_ptk','nama_ptk','nuptk','id_prodi','nama_prodi','password','active_status','level_akses','last_online');
			$this->user_detail = $this->ptk_model->get_detail_data('get',array('user','prodi_ptk'),NULL,array('nuptk' => $user),TRUE,$select_u);
			if ($this->user_detail == NULL) {
				$select_u = array('id_user','id','nisn','nama','id_prodi','nama_prodi','id_thn_angkatan','tahun_angkatan','agama','password','active_status','level_akses','last_online');
				$this->user_detail = $this->mahasiswa_model->get_detail_data('get',array('user','prodi_mhs','thn_angkatan'),NULL,array('nisn' => $user),TRUE,$select_u);
			}
			if ($this->user_detail == NULL) {
				$select_u = array('id_user_admin AS id_user','username','password','active_status','level_akses','last_online');
				$this->user_detail = $this->user_admin_model->get_by_search(array('username' => $user),TRUE,$select_u);
			}

			$rules = $this->user_model->rules_auth;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == TRUE || $this->pass_cookie != NULL && $this->pass_cookie == md5($this->user_detail->password)) {
				if ($this->user_detail->active_status == 1) {
					$url_target = base_url();
					$last_online_u = $this->user_detail->last_online;
					if ($this->pass_cookie == NULL) {
						$this->load->library('user_agent');
						date_default_timezone_set('Asia/Makassar');
						$data_time = date('Y-m-d H:i:s');
						$last_online_u = $data_time;
						$last_online = array('last_online' => $data_time);

						if ($this->user_detail->level_akses == 'admin') {
							$where = array('id_user_admin' => $this->user_detail->id_user);
							$this->user_admin_model->update($last_online,$where);
						}
						else{
							$where = array('id_user' => $this->user_detail->id_user);
							$this->user_model->update($last_online,$where);
						}
					}

					if ($this->user_detail->level_akses == 'admin') {
						$url_target = set_url();
						$login_data = array(
							'username'      => ucwords($user),
							'logged_in'     => TRUE,
							'id_user'       => $this->user_detail->id_user,
							'active_status' => $this->user_detail->active_status,					
							'level_akses'   => $this->user_detail->level_akses,
							'last_online'   => $last_online_u,
						);
						$in_user = $this->user_detail->id_user;
						$user_level = 'admin';
						$act_menu = array(
							'where' => array(
								'level_access_menu' => 'admin',
							)
						);
					}
					elseif ($this->user_detail->level_akses == 'ptk') {
						$login_data = array(
							'logged_in'     => TRUE,
							'active_status' => $this->user_detail->active_status,					
							'level_akses'   => $this->user_detail->level_akses,
							'last_online'   => $last_online_u,
							'id_user'       => $this->user_detail->id_user,
							'id_ptk'        => $this->user_detail->id_ptk,
							'nama'          => $this->user_detail->nama_ptk,
							'nuptk'         => $this->user_detail->nuptk,
							'id_prodi'      => $this->user_detail->id_prodi,
							'prodi'         => $this->user_detail->nama_prodi,
							'user_password' => md5($this->user_detail->password),
						);
						$in_user = $this->user_detail->id_ptk;
						$user_level = 'ptk';
						$act_menu = array(
							'where' => array(
								'level_access_menu' => 'user'
							),
							'or' => array(
								'level_access_menu' => 'ptk'
							)
						);

						if (isset($post['remember']) || get_cookie('user_in',TRUE) != NULL) {
							if ($user == $this->user_detail->nuptk) {
								$in_user = $user;
							}
							else{
								$in_user = $this->user_detail->nuptk;
							}
							$cookie = array(
								'name' => 'user_in',
								'value' => $in_user.'-uIn'.$this->user_detail->id_ptk.'_'.md5(get_cookie('ci_session')).'-ptk',
								'expire' => 86400 * 7,
								'httponly' => TRUE,
								);
							$this->input->set_cookie($cookie);
						}
					}
					elseif ($this->user_detail->level_akses == 'mhs') {
						$login_data = array(
							'logged_in'       => TRUE,
							'active_status'   => $this->user_detail->active_status,					
							'level_akses'     => $this->user_detail->level_akses,
							'last_online'     => $last_online_u,
							'id_user'         => $this->user_detail->id_user,
							'id_mhs'          => $this->user_detail->id,
							'nama'            => $this->user_detail->nama,
							'nim'             => $this->user_detail->nisn,
							'id_prodi'        => $this->user_detail->id_prodi,
							'prodi'           => $this->user_detail->nama_prodi,
							'id_thn_angkatan' => $this->user_detail->id_thn_angkatan,
							'thn_angkatan'    => $this->user_detail->tahun_angkatan,
							'agama'           => $this->user_detail->agama,
							'user_password'   => md5($this->user_detail->password),
						);
						$in_user = $this->user_detail->id;
						$user_level = 'mhs';
						$act_menu = array(
							'where' => array(
								'level_access_menu' => 'user'
							),
							'or' => array(
								'level_access_menu' => 'mhs'
							)
						);
						
						if (isset($post['remember']) || get_cookie('user_in',TRUE) != NULL) {
							if ($user == $this->user_detail->nisn) {
								$in_user = $user;
							}
							else{
								$in_user = $this->user_detail->nisn;
							}
							$cookie = array(
								'name' => 'user_in',
								'value' => $in_user.'-uIn'.$this->user_detail->id.'_'.md5(get_cookie('ci_session')).'-mhs',
								'expire' => 86400 * 7,
								'httponly' => TRUE,
								);
							$this->input->set_cookie($cookie);
						}
					}

					/*Insert Visitor Logs*/
					/*if ($this->pass_cookie == NULL) {
						if ($this->agent->is_mobile()) {
							$login_data['agent'] = 'mobile';
						}
						else{
							$login_data['agent'] = 'desktop';
						}

						if ($this->input->ip_address() == '::1') {
							$ip_user = '127.0.0.1.';
						}
						else{
							$ip_user = $this->input->ip_address();
						}

						$data_ag = array(
							'visitor_IP' => $ip_user,
							'visitor_id_user' => $in_user,
							'visitor_user_level' => $user_level,
							'visitor_referer' => $this->agent->referrer(),
							'visitor_date' => date('Y-m-d H:i:s'),
							'visitor_agent' => ucwords($login_data['agent']),
							'visitor_os' => $this->agent->platform(),
							'visitor_browser' => $this->agent->browser(),
							);
						$this->visitor_log_model->insert($data_ag);
					}*/

					if (isset($post['remember']) && $this->user_detail->level_akses == 'admin') {
						$user_cookie = array(
							'name' => 'user_u',
							'value' => $user.'-uIn'.rand_val().'_'.md5(get_cookie('ci_session')).'-user',
							'expire' => 86400 * 7,
							'httponly' => TRUE,
							);
						if ($this->pass_cookie == NULL) {
							$pass_cookie = array(
								'name' => 'pass_u',
								'value' => md5(crypt($post['password'],$this->user_detail->password)).'-uIn'.rand_val().'_'.md5(get_cookie('ci_session')).'-user',
								'expire' => 86400 * 7,
								'httponly' => TRUE,
								);
						}
						else{
							$pass_cookie = array(
								'name' => 'pass_u',
								'value' => $this->pass_cookie.'-uIn'.rand_val().'_'.md5(get_cookie('ci_session')).'-user',
								'expire' => 86400 * 7,
								'httponly' => TRUE,
								);
						}
						$this->input->set_cookie($user_cookie);
						$this->input->set_cookie($pass_cookie);
					}

					/*Load List Menu*/
					$main_menu = $this->main_menu_list_model->get_detail_data('get',NULL,@$act_menu,NULL,FALSE,array('id_menu','nm_menu','level_access_menu','sort_menu','icon_menu','color_menu','status_access_menu','link_menu'));
					$sub_menu = $this->sub_menu_list_model->get_detail_data('get',array('main_menu_list'),@$act_menu,NULL,FALSE,array('id_parent_menu','nm_sub_menu','sort_sub_menu','icon_sub_menu','status_access_sub_menu','link_sub_menu','link_menu','level_access_menu'));
					$data_menu = array();
					foreach ($main_menu as $key) {
						if ($key->level_access_menu == 'admin') {
							$url_menu = set_url($key->link_menu);
						}
						else{
							$url_menu = base_url($key->link_menu);
						}

						$data_sub_menu = array();
						foreach ($sub_menu as $key_sub) {
							if ($key->id_menu == $key_sub->id_parent_menu) {
								$link_sub_menu = $url_menu.'/'.$key_sub->link_sub_menu;
								$data_sub_menu[] = array_merge((array)$key_sub,array('sort_link' => $key_sub->link_sub_menu,'link_sub_menu' => $link_sub_menu));
							}
						}

						$data_menu[] = array_merge((array)$key,array('sort_link' => $key->link_menu,'sub_menu' => $data_sub_menu,'link_menu' => $url_menu));
					}
					/*END -- Load List Menu*/

					$login_data['n_val'] = rand_val();
					$login_data['menu'] = $data_menu;
					$this->session->set_userdata($login_data);
					if ($this->pass_cookie == NULL) {
						$result = array(
							'status' => 'success',
							'level' => $this->user_detail->level_akses,
							'active_status' => $this->user_detail->active_status,
							'url_target' => $url_target,
							);
					}
					else{
						$url_target = $_SESSION['referrer'];
						if (isset($_SESSION['is_ajax_request']) && $_SESSION['is_ajax_request'] == TRUE) {
							$result = array(
								'login_rld' => TRUE,
								'url' => $url_target
								);
						}
						else{
							redirect($url_target);
						}
					}
				}
				else{
					if ($this->pass_cookie == NULL) {
						$result = array(
							'status' => 'success',
							'active_status' => $this->user_detail->active_status,
							);
					}
					else{
						$this->session->sess_destroy();
						delete_cookie('user_in');
						delete_cookie('user_u');
						delete_cookie('pass_u');
						redirect(base_url('login'));
					}
				}		
			}				
			else {
				if ($this->pass_cookie == NULL) {
					$result = array(
						'status' => 'failed',
						'errors'=> $this->form_validation->error_array()
						);
				}
				else{
					$this->session->sess_destroy();
					delete_cookie('user_in');
					delete_cookie('user_u');
					delete_cookie('pass_u');
					redirect(base_url('login'));
				}
			}
			$result['n_token'] = $this->security->get_csrf_hash();
			echo json_encode($result);
		}
		else{
			$result = array('status_action' => 'Not find...');
		}
	}

	public function password_check($pass){
		$user_detail = $this->user_detail;
		if ($this->pass_cookie == NULL) {
			if (!empty($this->user_insert)) {
				if (!empty($pass)) {
					if (@$user_detail->password == crypt($pass,@$user_detail->password)) {
						return TRUE;
					}
					elseif (@$user_detail->password) {
						if (get_cookie('user_in',TRUE) != NULL) {
							$this->form_validation->set_message('password_check','Password yang anda masukkan salah');
						}
						else{
							$this->form_validation->set_message('password_check','Username atau password anda salah');
						}
						return FALSE;
					}
					else{
						$this->form_validation->set_message('password_check','Username yang anda masukkan salah');
						return FALSE;
					}
				}
				else{
					$this->form_validation->set_message('password_check','{field} kosong, tolong disi dengan benar');
					return FALSE;
				}			
			}
			else{			
				$this->form_validation->set_message('password_check','Username kosong, isi dengan benar');
				return FALSE;
			}
		}
		else{
			if (md5(@$user_detail->password) == $this->pass_cookie) {
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		delete_cookie('user_in');
		delete_cookie('user_u');
		delete_cookie('pass_u');
		redirect(base_url('login'));
	}

	public function lock_user(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	protected function password_generate(){
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$len = strlen($string)-1;
		$pass = '';
		for ($i=1; $i <=7 ; $i++) { 
			$start = rand(0,$len);
			$pass .= $string{$start};
		}
		return $pass;
	}

	/*public function temporary_register(){
		$data_user_baru = array(
			'username' => 'admin',
			'password' => bCrypt('admin',12),
			'uncrypt_password' => 'admin',			
			'level_akses' => 'admin',
			'active_status' => 1
			);		
		$this->user_model->insert($data_user_baru);
	}*/

	public function logout_test(){
		$this->session->sess_destroy();
	}

}
