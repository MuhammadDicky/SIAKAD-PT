<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konfigurasi_model extends My_Models_Configuration{
	protected $_table_name = 'konfigurasi';
	protected $_primary_key = 'id_konfigurasi';
	protected $_order_by = 'id_konfigurasi';
	protected $_order_by_type = 'DESC';		
	protected $_select = array('id_konfigurasi','nama_konfigurasi','isi_konfigurasi','autoload');
	protected $_type;

	function __construct(){
		parent:: __construct();
	}

	public $rules_web_konfigurasi = array(
		'_web_name' => array(
			'field' => '_web_name', 
			'label' => 'Nama Web',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama web'
						)
			),	
		'_pt_name' => array(
			'field' => '_pt_name', 
			'label' => 'Nama Perguruan Tinggi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama perguruan tinggi'
						)
			),
		'_app_version' => array(
			'field' => '_app_version', 
			'label' => 'Versi Aplikasi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan versi aplikasi'
						)
			),
		'_plugin_path' => array(
			'field' => '_plugin_path', 
			'label' => 'Direktori Plugin',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan direktori plugin'
						)
			),
		'_template_assets' => array(
			'field' => '_template_assets', 
			'label' => 'Direktori aset template',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan direktori aset template'
						)
			),
		'_AdminLTE_version' => array(
			'field' => '_AdminLTE_version', 
			'label' => 'Versi AdminLTE',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan versi AdminLTE'
						)
			),
		'_logo_mini' => array(
			'field' => '_logo_mini', 
			'label' => 'Text Mini AdminLTE',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan text mini AdminLTE'
						)
			),
		'_logo_lg' => array(
			'field' => '_logo_lg', 
			'label' => 'Text Large AdminLTE',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan text large AdminLTE'
						)
			)
	);

}