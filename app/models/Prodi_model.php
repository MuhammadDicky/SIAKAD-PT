<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends My_Models_Configuration{
	protected $_table_name = 'prodi';
	protected $_select = array('id_prodi','kode_prodi','nama_prodi','jenjang_prodi','status_prodi');
	protected $_primary_key = 'id_prodi';
	protected $_order_by = 'jenjang_prodi DESC, nama_prodi ASC';
	protected $_order_column = array(NULL,NULL,'kode_prodi', 'nama_prodi', NULL, NULL,NULL,NULL);
	protected $_order_by_type = '';
	protected $_type;

	public $rules = array(
		'id_fk_pd' => array(
			'field' => 'id_fk_pd', 
			'label' => 'Kode Prodi',
			'rules' => 'callback_fk_pd_check'
			),
		'kode_prodi' => array(
			'field' => 'kode_prodi', 
			'label' => 'Kode Prodi',
			'rules' => 'required|callback_kd_pd_check',
			'errors'=> array(
							'required' => 'Tolong masukkan kode program studi',
							'kd_pd_check' => 'Kode program studi yang anda masukkan sudah ada'
						)
			),
		'nama_prodi' => array(
			'field' => 'nama_prodi', 
			'label' => 'Nama Program Studi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong nama program studi'
						)
			),
		'nama_kprodi' => array(
			'field' => 'nama_kprodi', 
			'label' => 'Nama Ketua Prodi',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama ketua prodi'
						)
			),
		'jenjang_prodi' => array(
			'field' => 'jenjang_prodi', 
			'label' => 'Jenjang',
			'rules' => 'required|in_list[S1,S2,S3]',
			'errors'=> array(
							'required' => 'Tolong pilih jenjang program studi',
							'in_list' => 'Jenjang prodi yang anda pilih tidak valid'
						)
			),
		'akreditasi_prodi' => array(
			'field' => 'akreditasi_prodi', 
			'label' => 'Akreditasi',
			'rules' => 'required|in_list[A,B,C]',
			'errors'=> array(
							'required' => 'Tolong pilih akreditasi program studi',
							'in_list' => 'Akreditasi prodi yang anda pilih tidak valid'
						)
			),
		'status_prodi' => array(
			'field' => 'status_prodi', 
			'label' => 'Status',
			'rules' => 'required|in_list[0,1]',
			'errors'=> array(
							'required' => 'Tolong pilih status program studi',
							'in_list' => 'Status prodi yang anda pilih tidak valid'
						)
			)
		);
	
	function __construct(){
		parent:: __construct();
	}

	function make_query(){  
		$post  = $this->input->post(NULL,TRUE);
		$sub_query = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE id_pd_mhs = id_prodi) AS count_mhs_prodi';
		$select = array_merge($this->_select,array($sub_query));
		$this->db->select($select);  
		$this->db->from($this->_table_name);

		if(!empty($post["search"]["value"])){
			$cari = $post["search"]["value"];
			$this->db->like(array('kode_prodi' => $cari));
			$this->db->or_like(array('nama_prodi' => $cari));
		}
		
		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('kode_prodi', 'ASC');  
		}		
	}

    function make_datatables(){  
    	$post  = $this->input->post(NULL,TRUE);
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
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}'.$this->_table_name.'.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT');
				}
				if ($table == 'konsentrasi_pd') {
					$this->db->join('{PRE}konsentrasi_pd', '{PRE}'.$this->_table_name.'.id_prodi = {PRE}konsentrasi_pd.id_pd_konst', 'LEFT');
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