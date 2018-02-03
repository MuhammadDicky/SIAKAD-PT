<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsentrasi_pd_model extends My_Models_Configuration{
	protected $_table_name = 'konsentrasi_pd';
	protected $_select = array('id_konst','id_pd_konst','nm_konsentrasi');
	protected $_primary_key = 'id_konst';
	protected $_order_by = 'nm_konsentrasi ASC';
	protected $_order_column = array();
	protected $_order_by_type = '';
	protected $_type;

	public $rules = array(
		'id_pd_konst' => array(
			'field' => 'id_pd_konst', 
			'label' => 'Program Studi',
			'rules' => 'required|callback_pd_check_ex',
			'errors'=> array(
							'required' => 'Tolong pilih program studi'
						)
			),
		'nm_konsentrasi' => array(
			'field' => 'nm_konsentrasi', 
			'label' => 'Nama Konsentrasi',
			'rules' => 'required|callback_konst_check',
			'errors'=> array(
							'required' => 'Tolong masukkan nama konsentrasi'
						)
			)
		);
	
	function __construct(){
		parent:: __construct();
	}

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'prodi_konst') {
					$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.id_pd_konst = {PRE}prodi.id_prodi', 'LEFT');
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT');
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