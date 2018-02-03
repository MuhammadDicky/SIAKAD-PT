<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ptk_studi_model extends My_Models_Configuration{
	protected $_table_name = 'ptk_studi';
	protected $_select = array('nama_pt_studi','studi_ptk','jenjang_studi_ptk','gelar_ak_ptk','tgl_ijazah_ptk');
	protected $_primary_key = 'id_studi';
	protected $_order_by = 'tgl_ijazah_ptk';
	protected $_order_column = array(NULL,NULL,'nuptk','nama_ptk', NULL, NULL);
	protected $_order_by_type = 'ASC';		
	protected $_type;

	public $rules = array(
		'id_ptk_studi' => array(
			'field' => 'id_ptk_studi', 
			'label' => 'Tenaga Pendidik',
			'rules' => 'required|callback_ptk_check_c',
			'errors'=> array(
							'required' => 'Tolong pilih tenaga pendidik',
						)
			),
		'nama_pt_studi' => array(
			'field' => 'nama_pt_studi', 
			'label' => 'Perguruan Tinggi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama perguruan tinggi',							
						)
			),
		'studi_ptk' => array(
			'field' => 'studi_ptk', 
			'label' => 'Program Studi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan program studi',
						)
			),
		'jenjang_studi_ptk' => array(
			'field' => 'jenjang_studi_ptk',
			'label' => 'Jenjang',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan jenjang studi',
						)
			),
		'gelar_ak_ptk' => array(
			'field' => 'gelar_ak_ptk', 
			'label' => 'Gelar Akademik',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan gelar akademik',
						)
			),
		'tgl_ijazah_ptk' => array(
			'field' => 'tgl_ijazah_ptk', 
			'label' => 'Tanggal Ijazah',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal ijazah',
						)
			),
		);

	function __construct(){
		parent:: __construct();
	}

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'ptk') {
					$this->db->join('{PRE}ptk', '{PRE}'.$this->_table_name.'.id_ptk_studi = {PRE}ptk.id_ptk', 'LEFT' );
				}
				if ($table == 'prodi_ptk') {
					$this->db->join('{PRE}prodi', '{PRE}ptk.jurusan_prodi = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT' );
				}
			}
		}

		if ($query == 'get') {
			return parent::get_by_search($where,$single,$select,$group,$order,NULL,$act);
		}
		elseif ($query == 'count') {
			return parent::count($where,$group,$act);
		}
	}

}