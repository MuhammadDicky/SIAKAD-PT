<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu_model extends My_Models_Configuration{
	protected $_table_name = 'ortu_wali';
	protected $_primary_key = 'id';
	protected $_order_by = 'id';
	protected $_order_by_type = 'DESC';		
	protected $_type;

	function __construct(){
		parent:: __construct();
	}

}