<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas_model extends My_Models_Configuration{
	protected $_table_name = 'fakultas';
	protected $_select = '*';
	protected $_primary_key = 'id_fk';
	protected $_order_by = 'nama_fakultas';
	protected $_order_column = array(NULL,'nama_fakultas', 'dekan', 'tgl_berdiri', 'akreditasi',NULL);
	protected $_order_by_type = 'ASC';
	protected $_type;

	public $rules = array(
		'nama_fakultas' => array(
			'field' => 'nama_fakultas', 
			'label' => 'Fakultas',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong nama fakultas'
						)
			),
		'dekan' => array(
			'field' => 'dekan', 
			'label' => 'Dekan',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama dekan fakultas yang bersangkutan'
						)
			),
		'akreditasi_fk' => array(
			'field' => 'akreditasi_fk', 
			'label' => 'Akreditasi',
			'rules' => 'required|in_list[A,B,C]',
			'errors'=> array(
							'required' => 'Tolong pilih akreditasi fakultas',
							'in_list' => 'Akreditasi fakultas yang anda pilih tidak valid'
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
			$this->db->order_by('nama_fakultas', 'ASC');  
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