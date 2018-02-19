<?php

	class Config{

		/*Server Config*/
		var $_site_url            = 'http://localhost/';
		var $_sub_domain          = 'siakad-uncp';
		var $_document_root       = __DIR__;
		var $_app_environment     = 'Development';
		var $_site_name           = 'siakad-uncp.com';

		/*Web Assets Path*/
		var $_plugin_path         = 'assets/plugins/';
		var $_template_assets     = 'template/template_assets/';

		/*Url Admin*/
		var $_data_dashboard_path = 'admin';
		var $_data_master_path    = 'admin/data_master';
		var $_data_pengguna_path  = 'admin/data_pengguna';
		var $_data_akademik_path  = 'admin/data_akademik';

		/*Url User*/
		var $_index_path          = '';
		var $_path_home           = 'home';
		var $_path_profil_pt      = 'profil_pt';
		var $_beranda_mhs_path    = 'beranda_mhs';
		var $_beranda_ptk_path    = 'beranda_ptk';

		/*Database Config*/
		var $_hostname            = 'localhost';
		var $_database_user       = 'root';
		var $_database_password   = '';
		var $_database_name       = 'siakad_pt';
		var $_table_prefix        = 'tbl_';
		var $_dbdriver            = 'mysqli';
		var $_table_swap_prefix   = '{PRE}';

		/*Web Detail Config*/
		var $_app_name;
		var $_app_version         = '1.7 Beta';
		var $_dev_name            = 'Muhammad Dicky Hidayat Latif';
		var $_web_name            = 'Sistem Informasi Akademik';
		var $_pt_name             = 'Universitas Cokroaminoto Palopo';
		var $_web_icon            = 'pt-icon-profile.png';
		var $_email_feedback_1    = 'muh.dickyhidayat@gmail.com';
		var $_email_feedback_2    = 'muh.dickyhidayat@outlook.com';
		var $_CI_version          = 'v';
		var $_AdminLTE_version    = 'v2.4.3';
		var $_AdminLTE_ver        = '2.4.3';
		var $_backend_perpage     = 5;
		var $_frontend_perpage    = 5;

		/*AdminLTE Config*/
		var $_logo_mini           = 'UNCP';
		var $_logo_lg             = 'UNCP';

		public function __construct(){
			// Create connection
			$connect = new mysqli($this->_hostname, $this->_database_user, $this->_database_password, $this->_database_name);

			// Check connection
			if ($connect) {
			    $query = mysqli_query($connect,"SELECT isi_konfigurasi FROM tbl_konfigurasi
			    					WHERE nama_konfigurasi = 'web_konfigurasi'");
			    $konfigurasi = mysqli_fetch_object($query);
			    if ($query && $konfigurasi) {
			    	$config = unserialize($konfigurasi->isi_konfigurasi);
			    	foreach ($config as $key => $value) {
			    		$this->$key = $value;
			    	}
			    	mysqli_free_result($query);
			    	/*$this->_web_name = $config['_web_name'];
			    	$this->_pt_name = $config['_pt_name'];
			    	$this->_app_version = $config['_app_version'];
			    	$this->_plugin_path = $config['_plugin_path'];
			    	$this->_template_assets = $config['_template_assets'];
			    	$this->_AdminLTE_version = $config['_AdminLTE_version'];
			    	$this->_logo_mini = $config['_logo_mini'];
			    	$this->_logo_lg = $config['_logo_lg'];*/
			    }
			}

			$this->_app_name = $this->_web_name;
			$this->_web_name = $this->_web_name.' '.$this->_pt_name;
			$sub_domain = $this->_sub_domain;
			if ($sub_domain != '') {
				$this->_site_url = $this->_site_url.$sub_domain.'/';

				$this->_data_dashboard_path = '/'.$sub_domain.'/'.$this->_data_dashboard_path;
				$this->_data_master_path    = '/'.$sub_domain.'/'.$this->_data_master_path;
				$this->_data_pengguna_path  = '/'.$sub_domain.'/'.$this->_data_pengguna_path;
				$this->_data_akademik_path  = '/'.$sub_domain.'/'.$this->_data_akademik_path;

				$this->_index_path          = '/'.$sub_domain;
				$this->_path_home           = '/'.$sub_domain.'/'.$this->_path_home;
				$this->_path_profil_pt      = '/'.$sub_domain.'/'.$this->_path_profil_pt;
				$this->_beranda_mhs_path    = '/'.$sub_domain.'/'.$this->_beranda_mhs_path;
				$this->_beranda_ptk_path    = '/'.$sub_domain.'/'.$this->_beranda_ptk_path;
			}

			$app_env = array('Development','Testing','Production');
			if ($this->_app_environment != $app_env[0] && $this->_app_environment != $app_env[1] && $this->_app_environment != $app_env[2]) {
				$this->_app_environment = 'Development';
			}

		}

	}

 ?>
