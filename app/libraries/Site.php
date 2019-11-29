<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site{

	public $side;
	public $template;
	public $template_setting;
	public $website_setting;
	public $_in_home     = FALSE;
	public $_in_category = FALSE;
	public $_in_search   = FALSE;
	public $_in_detail   = FALSE;

	function view($page,$data=NULL){
		$_this =& get_instance();

		if ($this->template == '') {
			$template = $_this->template_model->get_by_search(array('template_status' => 1),TRUE,array('template_directory'));
			if ($template && $template->template_directory != '') {
				$this->template = $template->template_directory;
			}
			else{
				$this->template = 'adminlte';
			}
		}

		$data ?
			$_this->load->view($this->side."/".$this->template."/".$page,$data):
			$_this->load->view($this->side."/".$this->template."/".$page);
	}

	function link_view($page){
		$_this =& get_instance();
		if ($this->template == '') {
			$template = $_this->template_model->get_by_search(array('template_status' => 1),TRUE,array('template_directory'));
			if ($template && $template->template_directory != '') {
				$this->template = $template->template_directory;
			}
			else{
				$this->template = 'adminlte';
			}
		}
		return base_url('template/'.$this->side."/".$this->template."/".$page);
	}

	function login_status_check($level=NULL){
		$_this =& get_instance();
		$user_session = $_this->session->userdata();
		
		if ($this->side == 'backend') {
			if ($_this->uri->segment(1) == 'login') {
				if (isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE && $user_session['active_status']==1) {
					if ($user_session['level_akses'] == 'admin') {
						redirect(base_url('admin'));
					}
					elseif ($user_session['level_akses'] == 'mhs' || $user_session['level_akses'] == 'ptk') {
						redirect(base_url());
					}
				}
				else{
					if (get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL && get_cookie('user_in',TRUE) == NULL) {
						$_this->session->set_flashdata('referrer',current_url());
						redirect(base_url('user/login_auth'));
					}
				}
			}
			else{
				if ($level == NULL) {
					if (!isset($user_session['logged_in']) || $user_session['level_akses'] != 'admin' || $user_session['active_status']!=1) {
						/*$_this->session->set_flashdata('error_request',TRUE);*/
						/*redirect(base_url('error_403'));*/
						if (get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL && get_cookie('user_in',TRUE) == NULL) {
							if ($_this->input->is_ajax_request()) {
								$_this->load->library('user_agent');
								$_this->session->set_flashdata(
									'referrer',$_this->agent->referrer());
								$_this->session->set_flashdata(
									'is_ajax_request',TRUE);
								redirect(base_url('user/login_auth'));
							}
							else{
								$_this->session->set_flashdata('referrer',current_url());
								redirect(base_url('user/login_auth'));
							}
						}
						elseif (get_cookie('user_in',TRUE) != NULL) {
							redirect(base_url('login'));
						}
						else{
							redirect(base_url('home'));
						}
					}
				}
				else{
					if (!isset($user_session['logged_in']) || $user_session['active_status']!=1) {
						/*$_this->session->set_flashdata('error_request',TRUE);*/
						/*redirect(base_url('error_403'));*/
						if (get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL && get_cookie('user_in',TRUE) == NULL) {
							$_this->session->set_flashdata('referrer',current_url());
							redirect(base_url('user/login_auth'));
						}
						elseif (get_cookie('user_in',TRUE) != NULL) {
							redirect(base_url('login'));
						}
						else{
							redirect(base_url('home'));
						}
					}
					else{
						if ($level == 'mhs') {
							if ($user_session['level_akses'] !='mhs') {
								$_this->session->set_flashdata('error_request',TRUE);
								redirect(base_url('error_403'));
								/*redirect(base_url(''));*/
							}
						}
						elseif ($level == 'ptk') {
							if ($user_session['level_akses'] !='ptk') {
								/*$_this->session->set_flashdata('error_request',TRUE);
								redirect(base_url('error_403'));*/
								redirect(base_url(''));
							}
						}
					}
				}
			}
		}
		else{
			if ($_this->uri->segment(1) != 'home') {
				if ($level == NULL) {
					if (!isset($user_session['logged_in']) || $user_session['active_status']!=1) {
						/*$_this->session->set_flashdata('error_request',TRUE);*/
						/*redirect(base_url('error_403'));*/
						if (get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL && get_cookie('user_in',TRUE) == NULL) {
							$_this->session->set_flashdata('referrer',current_url());
							redirect(base_url('user/login_auth'));
						}
						elseif (get_cookie('user_in',TRUE) != NULL) {
							redirect(base_url('login'));
						}
						else{
							redirect(base_url('home'));
						}
					}
					else{
						if ($user_session['level_akses'] == 'admin') {
							/*$_this->session->set_flashdata('error_request',TRUE);
							redirect(base_url('error_403'));*/redirect(base_url('admin'));
						}
					}			
				}
				else{
					if (!isset($user_session['logged_in']) || $user_session['active_status']!=1) {
						/*$_this->session->set_flashdata('error_request',TRUE);*/
						/*redirect(base_url('error_403'));*/
						if (get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL && get_cookie('user_in',TRUE) == NULL) {
							$_this->session->set_flashdata('referrer',current_url());
							redirect(base_url('user/login_auth'));
						}
						elseif (get_cookie('user_in',TRUE) != NULL) {
							redirect(base_url('login'));
						}
						else{
							redirect(base_url('home'));
						}
					}
					else{
						if ($level == 'mhs') {
							if ($user_session['level_akses'] !='mhs') {
								$_this->session->set_flashdata('error_request',TRUE);
								redirect(base_url('error_403'));
								/*redirect(base_url(''));*/
							}
						}
						elseif ($level == 'ptk') {
							if ($user_session['level_akses'] !='ptk') {
								/*$_this->session->set_flashdata('error_request',TRUE);
								redirect(base_url('error_403'));*/
								redirect(base_url(''));
							}
						}
					}
				}
			}
			else{
				if ($_this->uri->segment(2) == NULL && $_this->uri->segment(1) == 'home') {
					if (isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE && $user_session['active_status']==1) {
						if ($user_session['level_akses'] == 'admin') {
							redirect(base_url('admin'));
						}
						elseif ($user_session['level_akses'] == 'mhs' || $user_session['level_akses'] == 'ptk') {
							redirect(base_url());
						}
					}
					elseif (get_cookie('user_u',TRUE) != NULL && get_cookie('pass_u',TRUE) != NULL && get_cookie('user_in',TRUE) == NULL) {
						redirect(base_url('user/login_auth'));
					}
				}
				else{
					if (!isset($user_session['logged_in'])) {
						redirect(set_url());
					}
					else if (isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE && $user_session['active_status']== 1 && $user_session['level_akses'] == 'admin') {
						redirect(base_url('admin'));
					}
				}
			}
		}		
	}

	function link_check(){
		$_this =& get_instance();

		if (array_key_exists('menu',$_SESSION)) {
			if ($_SESSION['level_akses'] == 'admin') {
				foreach ($_SESSION['menu'] as $key) {
					if (count($key['sub_menu']) > 0) {
						foreach ($key['sub_menu'] as $key_sub) {
							if ($_this->uri->segment(3) == $key_sub['sort_link'] && $key_sub['status_access_sub_menu'] == 0) {
								$_this->page_soon($key_sub['nm_sub_menu'],$key_sub['icon_sub_menu']);
							}
							elseif ($_this->uri->segment(3) == $key_sub['sort_link'] && $key_sub['status_access_sub_menu'] == 3) {
								$_this->page_on_repair($key_sub['nm_sub_menu'],$key_sub['icon_sub_menu']);
							}
						}
					}
					else{

					}
				}
			}
		}
	}

}

?>