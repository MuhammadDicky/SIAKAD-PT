<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends My_Models_Configuration{
	protected $_table_name = 'jadwal_kuliah';
	protected $_select = '*';
	protected $_primary_key = 'id_jdl';
	protected $_order_by = "field(hari_jdl, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'), `jam_mulai_jdl` ASC";
	protected $_order_column = array('thn_ajaran_jdl');
	protected $_order_by_type = '';
	protected $_type;

	public $rules = array(
		'id_thn_ak_jdl' => array(
			'field' => 'id_thn_ak_jdl', 
			'label' => 'Tahun Ajaran',
			'rules' => 'callback_check_status_thn'
			),	
		'id_mk_jdl' => array(
			'field' => 'id_mk_jdl', 
			'label' => 'Mata Kuliah',
			'rules' => 'callback_mk_check_c'
			),
		'id_ptk_jdl' => array(
			'field' => 'id_ptk_jdl', 
			'label' => 'Dosen',
			'rules' => 'callback_ptk_check_c'
			),
		'semester' => array(
			'field' => 'semester', 
			'label' => 'Semester',
			'rules' => 'required|in_list[1,2,3,4,5,6,7,8]',
			'errors'=> array(
							'required' => 'Tolong pilih semester',
							'in_list' => 'Semester yang anda pilih tidak valid'
						)
			),
		'kelas' => array(
			'field' => 'kelas', 
			'label' => 'Kelas',
			'rules' => 'required|in_list[A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,V,GAB.1,GAB.2,GAB.3,GAB.4,GAB.5,GAB.6,GAB.7,GAB.8,GAB.9,GAB.10]',
			'errors'=> array(
							'required' => 'Tolong pilih kelas',
							'in_list' => 'Kelas yang anda pilih tidak valid'
						)
			),
		'hari_jdl' => array(
			'field' => 'hari_jdl', 
			'label' => 'Hari',
			'rules' => 'required|in_list[Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu]',
			'errors'=> array(
							'required' => 'Tolong pilih hari',
							'in_list' => 'Hari yang anda pilih tidak valid'
						)
			),
		'jam_mulai_jdl' => array(
			'field' => 'jam_mulai_jdl', 
			'label' => 'Jam Mulai',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan jam mulai kuliah'
						)
			),
		'jam_akhir_jdl' => array(
			'field' => 'jam_akhir_jdl', 
			'label' => 'Jam Akhir',
			'rules' => 'required|callback_check_jam',
			'errors'=> array(
							'required' => 'Tolong masukkan jam akhir kuliah'
						)
			),
		'ruang' => array(
			'field' => 'ruang', 
			'label' => 'ruang',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan ruangan'
						)
			),
		);
	
	function __construct(){
		parent:: __construct();
	}

	function make_query(){  
		$post = $this->input->post(NULL, TRUE);
		$this->db->select(array('thn_ajaran_jdl','status_jdl'));  
		$this->db->from($this->_table_name);
		$this->db->group_by(array('thn_ajaran_jdl'));

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];
			$this->db->where("(thn_ajaran_jdl LIKE '%$cari%')");
		}  

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('thn_ajaran_jdl', 'DESC');  
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
				if ($table == 'thn_akademik') {
					$this->db->join('{PRE}thn_akademik', '{PRE}'.$this->_table_name.'.id_thn_ak_jdl = {PRE}thn_akademik.id_thn_ak', 'LEFT' );
				}
				if ($table == 'mata_kuliah') {
					$this->db->join('{PRE}mata_kuliah', '{PRE}'.$this->_table_name.'.id_mk_jdl = {PRE}mata_kuliah.id_mk', 'LEFT' );
				}
				if ($table == 'konsentrasi_pd') {
					$this->db->join('{PRE}konsentrasi_pd', '{PRE}mata_kuliah.jenis_jdl = {PRE}konsentrasi_pd.id_konst', 'LEFT' );
				}
				if ($table == 'ptk') {
					$this->db->join('{PRE}ptk', '{PRE}'.$this->_table_name.'.id_ptk_jdl = {PRE}ptk.id_ptk', 'LEFT' );
				}
				if ($table == 'prodi_mk') {
					$this->db->join('{PRE}prodi', '{PRE}mata_kuliah.id_pd_mk = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT' );
				}
				if ($table == 'kelas_nilai_mhs') {
					$this->db->join('{PRE}kelas_nilai_mhs', '{PRE}'.$this->_table_name.'.id_jdl = {PRE}kelas_nilai_mhs.id_jdl_kls', 'LEFT' );
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