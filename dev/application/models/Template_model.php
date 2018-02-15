<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends My_Models_Configuration{
	protected $_table_name = 'template';
	protected $_primary_key = 'template_id';
	protected $_order_by = 'template_id';
	protected $_order_by_type = 'ASC';		
	protected $_select = array('template_id','template_name','template_directory','template_dev','template_version','template_description','template_status','template_image');
	protected $_type;

	function __construct(){
		parent:: __construct();
	}

	public $rules = array(		
		'template_name' => array(
			'field' => 'template_name', 
			'label' => 'Nama Template',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama template',
						)
			),
		'template_directory' => array(
			'field' => 'template_directory', 
			'label' => 'Direktori Template',
			'rules' => 'required|callback_check_template_dir',
			'errors'=> array(
							'required' => 'Tolong masukkan direktori template',
							'check_template_dir' => 'Direktori yang anda masukkan sudah ada pada template lain'
						)
			),
		'template_dev' => array(
			'field' => 'template_dev', 
			'label' => 'Pengembangan Template',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama pengembang template',
						)
			),
		'template_version' => array(
			'field' => 'template_version', 
			'label' => 'Versi Template',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan versi template',
						)
			)
		);

}