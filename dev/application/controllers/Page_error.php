<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_error extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('template_dir_helper');
	}
	
	public function index(){
		$this->load->view('errors/bs_error/page_404');
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

	public function no_direct_access(){
		$str = array('direct_access' => 'no_access');
		$this->load->view('errors/bs_error/page_403',$str);
	}
		
}
