<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_menu_list_model extends My_Models_Configuration{
	protected $_table_name = 'main_menu_list';
	protected $_select = array();
	protected $_primary_key = 'id_menu';
	protected $_order_by = 'sort_menu ASC';
	protected $_order_column = array();
	protected $_order_by_type = '';
	protected $_type;

	public $rules = array(
		'nm_menu' => array(
			'field' => 'nm_menu', 
			'label' => 'Nama Menu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama menu'
						)
			),
		'level_access_menu' => array(
			'field' => 'level_access_menu', 
			'label' => 'Level Akses Menu',
			'rules' => 'required|in_list[admin,user,mhs,ptk]',
			'errors'=> array(
							'required' => 'Tolong pilih akses menu',
							'in_list' => 'Akses menu yang anda pilih tidak valid'
						)
			),
		'status_access_menu' => array(
			'field' => 'status_access_menu', 
			'label' => 'Status Akses Menu',
			'rules' => 'required|in_list[0,1,2,3]',
			'errors'=> array(
							'required' => 'Tolong pilih status akses menu',
							'in_list' => 'Status akses menu yang anda pilih tidak valid'
						)
			),
		'link_menu' => array(
			'field' => 'link_menu', 
			'label' => 'Link Menu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan link menu'
						)
			),
		'icon_menu' => array(
			'field' => 'icon_menu', 
			'label' => 'Icon Menu',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan class icon menu'
						)
			),
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
				if ($table == 'sub_menu_list') {
					$this->db->join('{PRE}sub_menu_list', '{PRE}'.$this->_table_name.'.id_menu = {PRE}sub_menu_list.id_mn_subm', 'LEFT');
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