<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni_model extends My_Models_Configuration{
	protected $_table_name = 'alumni';
	protected $_select = '*';
	protected $_primary_key = 'id_alni';
	protected $_order_by = 'tgl_lulus';
	protected $_order_column = array(NULL,'nama_fakultas', 'dekan', 'tgl_berdiri', 'akreditasi',NULL);
	protected $_order_by_type = 'ASC';
	protected $_type;

	public $rules = array(
		'tgl_yudisium' => array(
			'field' => 'tgl_yudisium', 
			'label' => 'Tanggal Yudisium',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal yudisium',
						)
			),
		'tgl_lulus' => array(
			'field' => 'tgl_lulus', 
			'label' => 'Tanggal Kelulusan',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal kelulusan',							
						)
			),
		);
	
	function __construct(){
		parent:: __construct();
	}

	function make_query(){  	
		$post = $this->input->post(NULL, TRUE);
		$this->db->from($this->_table_name);  
		
		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('tgl_lulus', 'DESC');  
		}		
	}

    function make_datatables(){  
    	$post = $this->input->post(NULL, TRUE);
		$this->make_query();  
		if($post["length"] != -1){  
			$this->db->limit($post['length'], $post['start']);  
		}  
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
				if ($table == 'mhs') {
					$this->db->join('{PRE}mahasiswa', '{PRE}'.$this->_table_name.'.id_mhs_alni = {PRE}mahasiswa.id', 'INNER' );
				}
				if ($table == 'prodi_mhs') {
					$this->db->join('{PRE}prodi', '{PRE}mahasiswa.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT' );
				}
				if ($table == 'thn_angkatan') {
					$this->db->join('{PRE}thn_angkatan', '{PRE}mahasiswa.thn_angkatan = {PRE}thn_angkatan.id_thn_angkatan', 'LEFT' );
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