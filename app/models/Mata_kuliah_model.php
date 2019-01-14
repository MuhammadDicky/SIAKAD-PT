<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah_model extends My_Models_Configuration{
	protected $_table_name = 'mata_kuliah';
	protected $_select = Array('id_mk','id_pd_mk','nama_prodi','kode_mk','nama_mk','jml_sks','jenis_jdl','jenjang_prodi');
	protected $_primary_key = 'id_mk';
	protected $_order_by = 'kode_mk';
	protected $_order_column = array(NULL,'kode_mk','nama_mk','jml_sks',NULL);
	protected $_order_by_type = 'ASC';		
	protected $_type;

	public $rules = array(
		'nama_mk' => array(
			'field' => 'nama_mk', 
			'label' => 'Mata Kuliah',
			'rules' => 'required|callback_mk_check',
			'errors'=> array(
							'required' => 'Tolong masukkan mata kuliah',
							'mk_check' => 'Maaf, mata kuliah yang anda masukkan sudah ada',
						)
			),
		'kode_mk' => array(
			'field' => 'kode_mk', 
			'label' => 'Kode MK',
			'rules' => 'required|callback_kode_mk_check',
			'errors'=> array(
							'required' => 'Tolong masukkan kode mata kuliah',
							'kode_mk_check' => 'Maaf, kode mata kuliah yang anda masukkan sudah ada',
						)
			),
		'id_pd_mk' => array(
			'field' => 'id_pd_mk', 
			'label' => 'Program Studi',
			'rules' => 'callback_pd_check_ex',
			),
		'jml_sks' => array(
			'field' => 'jml_sks', 
			'label' => 'SKS',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan jumlah sks',
						)
			),
		'jenis_jdl' => array(
			'field' => 'jenis_jdl', 
			'label' => 'Konsentrasi',
			'rules' => 'callback_check_konst'
			)
		);
	
	public $mk_update_rules = array(
		'id_pd_mk' => array(
			'field' => 'id_pd_mk', 
			'label' => 'Program Studi',
			'rules' => 'callback_pd_check_ex',
			),
		'mk_j' => array(
			'field' => 'mk_j', 
			'label' => 'Konsentrasi',
			'rules' => 'callback_check_konst'
			)
		);

	function __construct(){
		parent:: __construct();
	}

	function make_query(){  
		$post  = $this->input->post(NULL, TRUE);
		$this->db->select($this->_select);  
		$this->db->from($this->_table_name);
		$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.id_pd_mk = {PRE}prodi.id_prodi', 'LEFT' );		  		

		if(!empty($post["pd"])){  
			$pd = $post["pd"];			
			$this->db->where(array('id_pd_mk' => $pd));	
		}  

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('kode_mk', 'ASC');  
		}		
	}

    function make_datatables($length,$start){  
		$this->make_query();  		
		$this->db->limit($length,$start);  		
		$query = $this->db->get();  
		return $query->result();  
	}  
	
	function get_filtered_data(){  
		$this->make_query();
		$query = $this->db->get();  
		return $query->num_rows();  
	}       
      
    function get_all_data(){  
		$this->db->select("*");  
		$this->db->from($this->_table_name);  
		return $this->db->count_all_results();  
	}

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'prodi_mk') {
					$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.id_pd_mk = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'konsentrasi_pd') {
					$this->db->join('{PRE}konsentrasi_pd', '{PRE}'.$this->_table_name.'.jenis_jdl = {PRE}konsentrasi_pd.id_konst', 'LEFT' );
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