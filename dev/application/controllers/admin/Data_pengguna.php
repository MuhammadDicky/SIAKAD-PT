<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pengguna extends Backend_Controller {	

	public function __construct(){
		parent::__construct();			
		$this->site->login_status_check();		
	}

	public function index(){
		$this->page_soon('Data Pengguna','fa-users');
	}
	
	public function data_pengguna_mahasiswa(){
		$str = array(
			'pengguna' => 'Mahasiswa',
			'user_lvl' => 'mhs'
			);
		$this->site->view('page/'.$this->router->class.'/data_pengguna',$str);
	}

	public function data_pengguna_ptk(){
		$str = array(
			'pengguna' => 'Tenaga Pendidik',
			'user_lvl' => 'ptk'
			);
		$this->site->view('page/'.$this->router->class.'/data_pengguna',$str);
	}

	public function data_pengunjung(){
		/*$this->page_soon('Data Pengunjung','fa-user-circle');*/
		$this->site->view('page/'.$this->router->class.'/'.$this->router->method);
	}

	public function action($param){
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$post = $this->input->post(NULL, TRUE);
			if ($param == 'ambil') {
				if ($post['data'] == 'daftar_browser') {
					$total_rows = $this->visitors_logs_model->count(NULL,array('visitor_browser'));
					if ($total_rows >0 ) {
						$data = $this->visitors_logs_model->get_by_search(NULL,FALSE,array('visitor_browser'),array('visitor_browser'),'visitor_browser ASC');
						foreach ($data as $key => $value) {
							if (stristr($value->visitor_browser, 'chrome') == TRUE) {
								$icon = 'fa-chrome';
							}
							elseif (stristr($value->visitor_browser, 'edge') == TRUE) {
								$icon = 'fa-edge';
							}
							elseif (stristr($value->visitor_browser, 'firefox') == TRUE) {
								$icon = 'fa-firefox';
							}
							elseif (stristr($value->visitor_browser, 'Internet Explorer') == TRUE) {
								$icon = 'fa-internet-explorer';
							}
							elseif (stristr($value->visitor_browser, 'opera') == TRUE) {
								$icon = 'fa-opera';
							}
							else{
								$icon = 'fa-globe';
							}
							$data[] = array(
								'id' => $value->visitor_browser,
								'text' => $value->visitor_browser,
								'icon' => $icon,
								);
						}		
						$result = array(
							'browser' => $data,
							'total_count' => $total_rows
							);
					}					
					else{
						$result['browser'] = '';
					}
				}
				elseif ($post['data'] == 'daftar_platform') {
					$total_rows = $this->visitors_logs_model->count(NULL,array('visitor_os'));
					if ($total_rows >0 ) {
						$data = $this->visitors_logs_model->get_by_search(NULL,FALSE,array('visitor_os'),array('visitor_os'),'visitor_os ASC');
						foreach ($data as $key => $value) {
							if (stristr($value->visitor_os, 'windows') == TRUE) {
								$icon = 'fa-windows';
							}
							elseif (stristr($value->visitor_os, 'android') == TRUE) {
								$icon = 'fa-android';
							}
							elseif (stristr($value->visitor_os, 'linux') == TRUE) {
								$icon = 'fa-linux';
							}
							elseif (stristr($value->visitor_os, 'ios') == TRUE || stristr($value->visitor_os, 'mac os x') == TRUE) {
								$icon = 'fa-apple';
							}
							else{
								$icon = 'fa-cube';
							}
							$data[] = array(
								'id' => $value->visitor_os,
								'text' => $value->visitor_os,
								'icon' => $icon,
								);
						}		
						$result = array(
							'platform' => $data,
							'total_count' => $total_rows
							);
					}					
					else{
						$result['platform'] = '';
					}
				}
				else{
					$result = array('status_action' => 'Not find...');
				}
			}
			elseif ($param == 'update_status') {
				if ($post['status'] == 'true') {
					$status = 1;
				}
				else{
					$status = 0;
				}
				$data = array('active_status' => $status);
				$where = array('id_user' => $post['id']);
				$update_status = $this->user_model->update($data,$where);
				if ($update_status == TRUE) {
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
			elseif ($param == 'update_password') {
				$vars = explode('-',$post['user_in']);
				$password = $this->user_model->password_generate();
				$data = array(
					'password' => password_hash($password,PASSWORD_BCRYPT)
					);
				$where = array('md5(id_user)' => $vars[1]);
				$update_password = $this->user_model->update($data,$where);
				if ($update_password && $this->db->affected_rows() > 0) {
					$result = array(
						'status' => 'success',
						'u_pass' => $password,
						);
				}
				else{
					$result = array(
						'status' => 'failed',
						);
				}
			}
			else{
				$result = array('status_action' => 'Not find...');
			}
			$result['n_token'] = $this->security->get_csrf_hash();
			echo json_encode($result);
		}
	}

	public function data_table_request($param){
		$post = $this->input->post(NULL, TRUE);
		if ($param == 'user_list') {
			$fetch_data = $this->user_model->make_datatables();  
			$data = array();  
			foreach($fetch_data as $row){
				$arr = array(
					'user_in' => md5($row->user_in),
					'user_i' => md5($row->id_user)
					);
				$data[]      = array_merge((array)$row,$arr);
			}  
			$recordsTotal = $this->user_model->get_all_data();
			$recordsFiltered = $this->user_model->get_filtered_data();
		}
		elseif ($param == 'visitor_list') {
			$fetch_data = $this->visitors_logs_model->make_datatables();  
			$data = array();  
			$no_record = 0;
			$recordsFiltered = 0;
			$this->load->helper('file');
			$photo = photo_u();
			foreach($fetch_data as $row){
				if ($row->visitor_user_level == 'mhs') {
					$lvl = 'Mahasiswa';
					/*$user = $this->mahasiswa_model->get_by_search(array('id' =>$row->visitor_id_user),TRUE,array('nisn AS username','nama'));*/
				}
				elseif ($row->visitor_user_level == 'ptk') {
					$lvl = 'Tenaga Pendidik';
					/*$user = $this->ptk_model->get_by_search(array('id_ptk' =>$row->visitor_id_user),TRUE,array('nuptk AS username','nama_ptk AS nama'));*/
				}

				if (stristr($row->visitor_browser, 'chrome') == TRUE) {
					$browser_icon = 'fa-chrome';
				}
				elseif (stristr($row->visitor_browser, 'edge') == TRUE) {
					$browser_icon = 'fa-edge';
				}
				elseif (stristr($row->visitor_browser, 'firefox') == TRUE) {
					$browser_icon = 'fa-firefox';
				}
				elseif (stristr($row->visitor_browser, 'Internet Explorer') == TRUE) {
					$browser_icon = 'fa-internet-explorer';
				}
				elseif (stristr($row->visitor_browser, 'opera') == TRUE) {
					$browser_icon = 'fa-opera';
				}
				else{
					$browser_icon = 'fa-globe';
				}

				if (stristr($row->visitor_os, 'windows') == TRUE) {
					$os_icon = 'fa-windows';
				}
				elseif (stristr($row->visitor_os, 'android') == TRUE) {
					$os_icon = 'fa-android';
				}
				elseif (stristr($row->visitor_os, 'linux') == TRUE) {
					$os_icon = 'fa-linux';
				}
				elseif (stristr($row->visitor_os, 'ios') == TRUE || stristr($row->visitor_os, 'mac os x') == TRUE) {
					$os_icon = 'fa-apple';
				}
				else{
					$os_icon = 'fa-cube';
				}

				if ($row->visitor_agent == 'Desktop') {
					$device_icon = 'fa-desktop';
				}
				elseif ($row->visitor_agent == 'Mobile') {
					$device_icon = 'fa-mobile';
				}

				if ($row->photo_u != '') {
					if ($row->visitor_user_level == 'mhs') {
						$check_file = get_file_info('uploads/mhs-photo/'.$row->photo_u);
						if ($check_file != FALSE) {
							$photo = photo_u('mhs',$row->photo_u.'?n_img='.rand_val(20));
						}
					}
					else{
						$check_file = get_file_info('uploads/ptk-photo/'.$row->photo_u);
						if ($check_file != FALSE) {
							$photo = photo_u('ptk',$row->photo_u.'?n_img='.rand_val(20));
						}
					}
				}

				$date_vars = explode(' ',$row->visitor_date);
				$last_online = date_convert($date_vars[0]);

				/*$recordsFiltered = $this->visitors_logs_model->get_filtered_data();
				if ($post['search']['value'] !='' && stristr($user->username, $post['search']['value']) == TRUE || $post['search']['value'] !='' && stristr($user->nama, $post['search']['value']) == TRUE) {
					$no_record++;
					$recordsFiltered = $no_record;
					$row = array(
						'username' => $user->username,
						'nama' => $user->nama,
						'visitor_browser' => $row->visitor_browser,
						'visitor_os' => $row->visitor_os,
						'visitor_agent' => $row->visitor_agent,
						'visitor_date' => $row->visitor_date,
						'date' => $last_online,
						'time' => $date_vars[1],
						'user_lvl' => $lvl,
						'browser_icon' => $browser_icon,
						'os_icon' => $os_icon,
						'device_icon' => $device_icon
						);
					$data[]      = $row;
				}
				elseif ($post['search']['value'] !='' && stristr($user->username, $post['search']['value']) == FALSE && $post['search']['value'] !='' && stristr($user->nama, $post['search']['value']) == FALSE) {
					$recordsFiltered = $no_record;
				}
				elseif ($post['search']['value'] =='') {
					$row = array(
						'username' => $user->username,
						'nama' => $user->nama,
						'visitor_browser' => $row->visitor_browser,
						'visitor_os' => $row->visitor_os,
						'visitor_agent' => $row->visitor_agent,
						'visitor_date' => $row->visitor_date,
						'date' => $last_online,
						'time' => $date_vars[1],
						'user_lvl' => $lvl,
						'browser_icon' => $browser_icon,
						'os_icon' => $os_icon,
						'device_icon' => $device_icon,
						);
					$data[]      = $row;
				}*/

				$row = array(
					'username' => $row->username,
					'nama' => $row->nama,
					'photo_u' => $photo,
					'visitor_browser' => $row->visitor_browser,
					'visitor_os' => $row->visitor_os,
					'visitor_agent' => $row->visitor_agent,
					'visitor_date' => $row->visitor_date,
					'date' => $last_online,
					'time' => $date_vars[1],
					'user_lvl' => $lvl,
					'browser_icon' => $browser_icon,
					'os_icon' => $os_icon,
					'device_icon' => $device_icon,
					);
				$data[]      = $row;
			}
			/*$recordsFiltered = $this->visitors_logs_model->get_filtered_data();*/
			$recordsTotal = $this->visitors_logs_model->get_all_data();
			$recordsFiltered = $this->visitors_logs_model->get_filtered_data();
		}
		$output = array(  
			"draw"            => intval(@$post["draw"]),  
			"recordsTotal"    => @$recordsTotal,
			"recordsFiltered" => @$recordsFiltered,
			"data"            => @$data,
			"n_token"         => $this->security->get_csrf_hash()
		);
		echo json_encode($output);
	}

	public function print_user_info(){
		$post = $this->input->post_get(NULL, TRUE);
		$this->load->library('user_agent');
		if (stristr($this->agent->referrer(), set_url('data_pengguna/data_pengguna_mahasiswa')) == TRUE) {
			$rules = $this->user_model->rules_print_umhs;
			$this->form_validation->set_rules($rules);
			$user_level = 'mhs';
		}
		elseif (stristr($this->agent->referrer(), set_url('data_pengguna/data_pengguna_ptk')) == TRUE) {
			$rules = $this->user_model->rules_print_uptk;
			$this->form_validation->set_rules($rules);
			$user_level = 'ptk';
		}

		if (@$rules) {
			$this->user_model->print_pdf_user($user_level);
			if ($this->form_validation->run() == TRUE) {
			    $this->user_model->print_pdf_user($user_level);
			}
			else{
				echo "Error";
			}
		}
	}

	public function check_print_data(){
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->load->library('user_agent');
			if (stristr($this->agent->referrer(), set_url('data_pengguna/data_pengguna_mahasiswa')) == TRUE) {
				$rules = $this->user_model->rules_print_umhs;
				$this->form_validation->set_rules($rules);
			}
			elseif (stristr($this->agent->referrer(), set_url('data_pengguna/data_pengguna_ptk')) == TRUE) {
				$rules = $this->user_model->rules_print_uptk;
				$this->form_validation->set_rules($rules);
			}

			if (@$rules) {
				if ($this->form_validation->run() == TRUE) {
				    $result = array(
				    	'status' => 'success',
				    	'form_action' => set_url('data_pengguna/print_user_info')
				    	);
				}
				else{
					$result = array(
						'status' => 'failed', 
						'errors'=> $this->form_validation->error_array()
						);
				}
			}
			$result['n_token'] = $this->security->get_csrf_hash();
			echo json_encode($result);
		}
	}

	public function thn_angkatan_check($string){
		if ($string != '') {
			$check = $this->thn_angkatan_model->count(array('id_thn_angkatan' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('thn_angkatan_check', 'Maaf, tahun angkatan yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('thn_angkatan_check', 'Tolong pilih tahun angkatan');
			return FALSE;
		}
	}

	public function prodi_check($string){
		if ($string != '') {
			$check = $this->prodi_model->count(array('id_prodi' => $string));
			if ($check > 0) {
				return TRUE;
			}
			else{
				$this->form_validation->set_message('prodi_check', 'Maaf, program studi yang anda pilih tidak ada dalam database');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('prodi_check', 'Tolong pilih program studi');
			return FALSE;
		}
	}

}