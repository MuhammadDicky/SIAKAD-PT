<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_mhs_model extends My_Models_Configuration{
	protected $_table_name = 'nilai_mhs';
	protected $_primary_key = 'id_nilai';
	protected $_order_by = 'nisn';
	protected $_order_by_type = 'ASC';		
	protected $_type;

	public $rules = array(
		'nilai_akhir' => array(
			'field' => 'nilai_akhir', 
			'label' => 'Nilai Akhir',
			'rules' => 'callback_check_vnilai',
			),
		);

	function __construct(){
		parent:: __construct();
	}

	function get_nilai_mhs($where=NULL,$single=FALSE,$select=NULL,$group=NULL){
		$this->db->join('{PRE}kelas_pd', '{PRE}'.$this->_table_name.'.id_kls_nilai = {PRE}kelas_pd.id_kelas', 'LEFT' );
		$this->db->join('{PRE}jadwal_kuliah', '{PRE}kelas_pd.id_jdl_kls = {PRE}jadwal_kuliah.id_jdl', 'LEFT' );
		$this->db->join('{PRE}thn_akademik', '{PRE}jadwal_kuliah.id_thn_ak_jdl = {PRE}thn_akademik.id_thn_ak', 'LEFT' );
		$this->db->join('{PRE}mata_kuliah', '{PRE}jadwal_kuliah.id_mk_jdl = {PRE}mata_kuliah.id_mk', 'LEFT' );
		$this->db->join('{PRE}mahasiswa', '{PRE}kelas_pd.id_mhs_kls = {PRE}mahasiswa.id', 'LEFT' );
		$this->db->join('{PRE}prodi', '{PRE}mahasiswa.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
		$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT' );
		return parent::get_by_search($where,$single,$select,$group);
	}
	
}