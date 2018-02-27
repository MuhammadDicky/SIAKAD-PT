<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_error extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('template_dir_helper');
	}
	
	public function index(){
		if (!$this->input->is_ajax_request()) {
			$this->load->view('errors/bs_error/page_404');
		}
		else{
			$post = $this->input->get(NULL, TRUE);
			if (isset($post['request_view']) && isset($post['template'])) {
				$this->load->view(@$post['template'].'views/error_page/page_error_404');
			}
			else{
				$errors = array(
					'status_page' => 'page_error',
					'message' => 'Page not found...'
				);
				echo json_encode($errors);
			}
		}
	}

	public function error_403(){
		if ($this->session->flashdata('error_request')!= NULL) {
			$this->load->view('errors/bs_error/page_403');
		}
		else{
			if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']== TRUE) {
				if ($_SESSION['level_akses'] == 'admin') {
					redirect(set_url());
				}
				else{
					redirect(base_url());
				}
			}
			else{
				redirect(base_url('login'));
			}
		}
	}

	public function error_500(){
		if (!$this->input->is_ajax_request()) {
			$this->load->view('errors/bs_error/page_500');
		}
		else{
			$post = $this->input->get(NULL, TRUE);
			if (isset($post['request_view']) && isset($post['template'])) {
				$this->load->view(@$post['template'].'views/error_page/page_error_500');
			}
			else{
				$errors = array(
					'status_page' => 'page_error',
					'message' => 'Page Error'
				);
				echo json_encode($errors);
			}
		}
	}

	public function no_direct_access(){
		$str = array('direct_access' => 'no_access');
		$this->load->view('errors/bs_error/page_403',$str);
	}
		
}
