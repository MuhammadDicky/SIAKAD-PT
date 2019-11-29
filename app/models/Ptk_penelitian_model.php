<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ptk_penelitian_model extends My_Models_Configuration{
	protected $_table_name = 'penelitian_ptk';
	protected $_select = array('judul_penelitian','bidang_ilmu','lembaga');
	protected $_primary_key = 'id_penelitian_ptk';
	protected $_order_by = 'id_penelitian_ptk';
	protected $_order_column = array(NULL,NULL,'nuptk','nama_ptk', NULL, NULL);
	protected $_order_by_type = 'ASC';		
	protected $_type;

	public $rules = array(
		'id_ptk_rsch' => array(
			'field' => 'id_ptk_rsch', 
			'label' => 'Tenaga Pendidik',
			'rules' => 'required|callback_ptk_check_c',
			'errors'=> array(
							'required' => 'Tolong pilih tenaga pendidik',
						)
			),
		'judul_penelitian' => array(
			'field' => 'judul_penelitian', 
			'label' => 'Judul Penelitian',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan judul penelitian',
						)
			),
		'bidang_ilmu' => array(
			'field' => 'bidang_ilmu', 
			'label' => 'Bidang Ilmu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan bidang ilmu',
						)
			),
		'lembaga' => array(
			'field' => 'lembaga',
			'label' => 'lembaga',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan lembaga lokasi penelitian',
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
					$this->db->join('{PRE}ptk', '{PRE}'.$this->_table_name.'.id_ptk_rsch = {PRE}ptk.id_ptk', 'LEFT' );
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