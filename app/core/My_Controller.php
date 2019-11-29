<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class My_Controller extends CI_Controller{
	
	public $data = array();
	
	public function __construct(){
		parent::__construct();						
		$this->load->helper(array('template_dir_helper','user_helper','form','option_helper'));
		$this->load->library(array('site'));
		$this->load->model(array('mahasiswa_model','ptk_model','user_model','identitas_universitas_model','prodi_model','thn_ajaran_model','mata_kuliah_model','konsentrasi_pd_model','kelas_model','jadwal_model','nilai_mhs_model','main_menu_list_model','sub_menu_list_model','template_model','konfigurasi_model'));
	}

	public function page_on_repair($n,$i){
		$string = array(
			'page_name' => $n,
			'icon' => $i
			);
		$this->load->view('in_dev_page/page_in_repair',$string);
	}

	public function page_soon($n,$i){
		$this->load->library('user_agent');
		$referrer =  $this->agent->referrer();
		$string = array(
			'page_name' => $n,
			'icon' => $i,
			'referrer' => $referrer
			);
		$this->load->view('in_dev_page/page_soon',$string);
	}

}

?>