<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class konfigurasi_model extends My_Models_Configuration{
	protected $_table_name = 'konfigurasi';
	protected $_primary_key = 'id_konfigurasi';
	protected $_order_by = 'id_konfigurasi';
	protected $_order_by_type = 'DESC';		
	protected $_select = array('id_konfigurasi','nama_konfigurasi','isi_konfigurasi','autoload');
	protected $_type;
	public $konfigurasi_pt = 'identitas_pt';

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
		'_app_environment' => array(
			'field' => '_app_environment', 
			'label' => 'Status Aplikasi',
			'rules' => 'required|in_list[Development,Testing,Production]',
			'errors'=> array(
							'required' => 'Tolong pilih status aplikasi',
							'in_list' => 'Maaf, status yang anda pilih salah'
						)
			)
	);

	public $rules_identitas_pt = array(
		'data_identitas_pt' => array(
			'field' => 'data_identitas_pt', 
			'label' => 'Nama Sekolah',
			'rules' => 'callback_check_pt',
			'errors'=> array(
							'check_pt' => 'Terjadi kesalahan!',
						)
			),
		'nama' => array(
			'field' => 'nama', 
			'label' => 'Nama Perguruan Tinggi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama perguruan tinggi',
						)
			),
		'kpt' => array(
			'field' => 'kpt', 
			'label' => 'Kode PT',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan kode perguruan tinggi',
						)
			),
		'kategori' => array(
			'field' => 'kategori', 
			'label' => 'Kategori',
			'rules' => 'required|in_list[Negeri,Swasta,Lainnya]',
			'errors'=> array(
							'required' => 'Tolong pilih kategori perguruan tinggi',
							'in_list' => 'Kategori yang anda pilih tidak valid'
						)
			),
		'status' => array(
			'field' => 'status', 
			'label' => 'Status Perguruan Tinggi',
			'rules' => 'in_list[Aktif,Alih Bentuk,Tutup,Alih Kelolah,Pembinaan]',
			'errors'=> array(
							'in_list' => 'Status yang anda pilih tidak valid'
						)
			),
		'btk_pendi' => array(
			'field' => 'btk_pendi', 
			'label' => 'Bentuk Pendidikan',
			'rules' => 'required|in_list[Universitas,Institut,Sekolah Tinggi,Lainnya]',
			'errors'=> array(
							'required' => 'Tolong pilih bentuk pendidikan sekolah',
							'in_list'  => 'Bentuk perguruan tinggi yang anda pilih tidak valid'
						)
			),
		'sertifikat_iso' => array(
			'field' => 'sertifikat_iso', 
			'label' => 'Sertifikat ISO',
			'rules' => 'in_list[Sudah Bersertifikat,Belum Bersertifikat]',
			'errors'=> array(
							'in_list'  => 'Status sertifikat ISO yang anda pilih tidak valid'
						)
			),
		'status_milik' => array(
			'field' => 'status_milik', 
			'label' => 'Status Kepemilikan',
			'rules' => 'in_list[Pemerintah Pusat,Pemerintah Daerah,Swasta,Lainnya]',
			'errors'=> array(
							'in_list'  => 'Status kepemilikan yang anda pilih tidak valid'
						)
			),
		'email' => array(
			'field' => 'email', 
			'label' => 'Email',
			'rules' => 'valid_email',
			'errors'=> array(
							'valid_email' => 'Tolong masukkan email yang valid',
						)
			),		
		);

}