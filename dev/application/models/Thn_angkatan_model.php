<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thn_angkatan_model extends My_Models_Configuration{
	protected $_table_name = 'thn_angkatan';
	protected $_primary_key = 'id_thn_angkatan';
	protected $_order_by = 'tahun_angkatan';
	protected $_order_by_type = 'DESC';		
	protected $_order_column = array('tahun_angkatan', 'tgl_masuk_angkatan', 'count_mhs',NULL);
	protected $_type;

	public $rules = array(		
		'thn' => array(
			'field' => 'thn_angkatan', 
			'label' => 'Tahun Angkatan',
			'rules' => 'required|min_length[4]|max_length[4]|callback_thn_valid',
			'errors'=> array(
							'required' => 'Tolong isi tahun angkatan',
							'min_length' => 'Masukkan tahun yang valid',
							'max_length' => 'Masukkan tahun yang valid',
							'thn_valid' => 'Maaf tahun yang anda masukkan sudah ada'
						)
			),
		);


	function __construct(){
		parent:: __construct();
	}

	function make_query(){  
		$post  = $this->input->post(NULL, TRUE);		
		$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE thn_angkatan = id_thn_angkatan) AS jumlah';
		$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE thn_angkatan = id_thn_angkatan AND jk = "L") AS laki_laki';
		$sub_query[] = '(SELECT COUNT(*) FROM {PRE}mahasiswa WHERE thn_angkatan = id_thn_angkatan AND jk = "P") AS perempuan';
		$select = array_merge(list_fields(array('thn_angkatan'),$sub_query));
		$this->db->select($select)->from($this->_table_name);

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];
			$this->db->like('tahun_angkatan', $cari);
		}  

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('tahun_angkatan', 'ASC');  
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
			foreach ($join_table as $table) {
				if ($table == 'mahasiswa') {
					$this->db->join('{PRE}mahasiswa', '{PRE}'.$this->_table_name.'.id_thn_angkatan = {PRE}mahasiswa.thn_angkatan', 'LEFT' );
				}
				if ($table == 'prodi_mhs') {
					$this->db->join('{PRE}prodi', '{PRE}mahasiswa.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
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