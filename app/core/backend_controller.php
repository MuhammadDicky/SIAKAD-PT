<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_Controller extends My_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array());
		$this->load->library(array('form_validation','upload'));
		$this->load->model(array('fakultas_model','user_admin_model','visitors_logs_model','thn_angkatan_model','ortu_model','ptk_studi_model','ptk_penelitian_model','alumni_model','mahasiswa_do_model'));

		$this->site->side = 'backend';

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
	}

}


?>
