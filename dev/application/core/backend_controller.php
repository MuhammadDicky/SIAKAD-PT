<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_Controller extends My_Controller{

	public function __construct(){
		parent::__construct();		
		$this->load->helper(array());
		$this->load->library(array('form_validation','upload'));
		$this->load->model(array('fakultas_model','user_admin_model','visitors_logs_model','thn_angkatan_model','ortu_model','ptk_studi_model','ptk_penelitian_model','alumni_model','mahasiswa_do_model'));
		$this->site->side = 'backend';
		$this->site->template = 'adminlte';

		/*if (array_key_exists('menu',$_SESSION)) {
			if ($_SESSION['level_akses'] == 'admin') {
				foreach ($_SESSION['menu'] as $key) {
					if (count($key['sub_menu']) > 0) {
						foreach ($key['sub_menu'] as $key_sub) {
							if ($this->uri->segment(3) == $key_sub['sort_link'] && $key_sub['status_access_sub_menu'] == 0) {
								$this->page_soon($key_sub['nm_sub_menu'],$key_sub['icon_sub_menu']);
							}
							elseif ($this->uri->segment(3) == $key_sub['sort_link'] && $key_sub['status_access_sub_menu'] == 3) {
								$this->page_on_repair($key_sub['nm_sub_menu'],$key_sub['icon_sub_menu']);
							}
						}
					}
					else{

					}
				}
			}
		}*/
	}

}


?>