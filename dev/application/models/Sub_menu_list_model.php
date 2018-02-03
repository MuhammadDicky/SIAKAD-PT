<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_menu_list_model extends My_Models_Configuration{
	protected $_table_name = 'sub_menu_list';
	protected $_select = array();
	protected $_primary_key = 'id_sub_menu';
	protected $_order_by = 'sort_sub_menu ASC';
	protected $_order_column = array();
	protected $_order_by_type = '';
	protected $_type;

	public $rules = array(
		'id_parent_menu' => array(
			'field' => 'id_parent_menu', 
			'label' => 'Parent Menu',
			'rules' => 'required|callback_check_menu',
			'errors'=> array(
							'required' => 'Tolong pilih parent menu'
						)
			),
		'nm_sub_menu' => array(
			'field' => 'nm_sub_menu', 
			'label' => 'Nama Sub Menu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama sub menu'
						)
			),
		'status_access_sub_menu' => array(
			'field' => 'status_access_sub_menu', 
			'label' => 'Status Akses Sub Menu',
			'rules' => 'required|in_list[0,1,2,3]',
			'errors'=> array(
							'required' => 'Tolong pilih status akses sub menu',
							'in_list' => 'Status akses sub menu yang anda pilih tidak valid'
						)
			),
		'link_sub_menu' => array(
			'field' => 'link_sub_menu', 
			'label' => 'Link Sub Menu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan link sub menu'
						)
			)
		/*'color_menu' => array(
			'field' => 'color_menu', 
			'label' => 'Color Menu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan kode warna menu'
						)
			)*/
		);
	
	function __construct(){
		parent:: __construct();
	}

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'main_menu_list') {
					$this->db->join('{PRE}main_menu_list', '{PRE}'.$this->_table_name.'.id_parent_menu = {PRE}main_menu_list.id_menu', 'LEFT');
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