<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thn_ajaran_model extends My_Models_Configuration{
	protected $_table_name = 'thn_akademik';
	protected $_primary_key = 'id_thn_ak';
	protected $_order_by = 'thn_ajaran_jdl';
	protected $_order_by_type = 'DESC';		
	protected $_order_column = array('thn_ajaran_jdl',NULL,NULL,NULL,NULL);
	protected $_type;

	public $rules = array(
		'thn_ajar' => array(
			'field' => 'thn_ajar', 
			'label' => 'Tahun Ajaran',
			'rules' => 'required|min_length[4]|max_length[4]',
			'errors'=> array(
							'required' => 'Tolong masukkan tahun akademik',
							'min_length' => 'Tolong masukkan tahun akademik yang valid',
							'max_length' => 'Tolong masukkan tahun akademik yang valid',
						)
			),
		'smstr' => array(
			'field' => 'smstr', 
			'label' => 'Semester',
			'rules' => 'required|in_list[1,2]|callback_check_thn_ajaran',
			'errors'=> array(
							'required' => 'Tolong pilih semester tahun akademik',
							'in_list' => 'Semester tahun akademik yang anda pilih tidak valid',
							'check_thn_ajaran' => 'Tahun akademik yang anda masukkan sudah ada'
						)
			),
		'tgl_mulai_thn_ajar' => array(
			'field' => 'tgl_mulai_thn_ajar', 
			'label' => 'Tanggal Mulai',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal mulainya tahun akademik',
						)
			),
		'tgl_akhir_thn_ajar' => array(
			'field' => 'tgl_akhir_thn_ajar', 
			'label' => 'Tanggal Berakhir',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal berakhirnya tahun akademik',
						)
			),
		);


	function __construct(){
		parent:: __construct();
	}

	function make_query(){
		$post  = $this->input->post(NULL, TRUE);		
		$this->db->from($this->_table_name);

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];
			$this->db->like('thn_ajaran_jdl', $cari);
		}  

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('thn_ajaran_jdl', 'ASC');  
		}		
	}

    function make_datatables(){  
    	$post  = $this->input->post(NULL, TRUE);
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
			
		}

		if ($query == 'get') {
			return parent::get_by_search($where,$single,$select,$group,$order,NULL,$act);
		}
		elseif ($query == 'count') {
			return parent::count($where,$group,$act);
		}
	}

}