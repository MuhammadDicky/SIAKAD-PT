<?php

	class Config{
		
		/*Server Config*/
		var $_site_url            = 'http://localhost/siakad-uncp/';
		var $_document_root       = __DIR__;/*'C:/xampp/htdocs/siakad-uncp';*/
		var $_site_name           = 'siakad-uncp.com';

		/*Web Assets Path*/
		var $_plugin_path         = 'assets/plugins/';
		var $_template_assets     = 'template/template_assets/';
		
		/*Url Admin*/
		var $_data_dashboard_path = '/siakad-uncp/admin';
		var $_data_master_path    = '/siakad-uncp/admin/data_master';
		var $_data_pengguna_path  = '/siakad-uncp/admin/data_pengguna';
		var $_data_akademik_path  = '/siakad-uncp/admin/data_akademik';
		
		/*Url User*/
		var $_path_home           = '/siakad-uncp/home';
		var $_path_profil_pt      = '/siakad-uncp/profil_pt';
		var $_beranda_mhs_path    = '/siakad-uncp/beranda_mhs';
		var $_beranda_ptk_path    = '/siakad-uncp/beranda_ptk';
		
		/*Database Config*/
		var $_hostname            = 'localhost';
		var $_database_user       = 'root';
		var $_database_password   = 'dickyhidayat';
		var $_database_name       = 'siakad_uncp';
		var $_table_prefix        = 'tbl_';
		var $_dbdriver            = 'mysqli';
		var $_table_swap_prefix   = '{PRE}';
		
		/*Web Detail Config*/
		var $_app_version         = '1.7 Beta';
		var $_dev_name            = 'Muhammad Dicky Hidayat Latif';
		var $_web_name            = 'Sistem Informasi Akademik Universitas Cokroaminoto Palopo';
		var $_pt_name             = 'Universitas Cokroaminoto Palopo';
		var $_web_icon			  = 'pt-icon-profile.png';
		var $_email_feedback_1    = 'muh.dickyhidayat@gmail.com';
		var $_email_feedback_2    = 'muh.dickyhidayat@outlook.com';
		var $_CI_version    	  = 'v';
		var $_AdminLTE_version    = 'v2.3.8';
		var $_AdminLTE_ver        = '2.3.8';
		var $_backend_perpage     = 5;
		var $_frontend_perpage    = 5;
		
		/*AdminLTE Config*/
		var $_logo_mini           = 'UNCP';
		var $_logo_lg             = 'UNCP';

	}

 ?>
