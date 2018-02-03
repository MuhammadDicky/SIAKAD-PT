<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends My_Models_Configuration{
	protected $_table_name = 'kelas_nilai_mhs';
	protected $_primary_key = 'id_kelas';
	protected $_order_by = 'nisn';
	protected $_order_by_type = 'ASC';
	protected $_type;

	public $rules = array(		
		'tingkat' => array(
			'field' => 'tingkat_kelas', 
			'label' => 'Tingkat',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong pilih tingkat',							
						)
			),
		'kelas' => array(
			'field' => 'kelas', 
			'label' => 'Kelas',
			'rules' => 'required|min_length[1]|max_length[1]|callback_kelas_valid',
			'errors'=> array(
							'required' => 'Tolong pilih kelas',
							'min_length' => 'Masukkan kelas yang valid',
							'max_length' => 'Masukkan kelas yang valid',
							'kelas_valid' => 'Maaf kelas yang anda masukkan sudah ada'
						)
			),
		);
	public $rules_nilai = array(
		'nilai_akhir' => array(
			'field' => 'nilai_akhir', 
			'label' => 'Nilai Akhir',
			'rules' => 'callback_check_vnilai',
			),
		);


	function __construct(){
		parent:: __construct();
	}

	function make_query(){
		$post = $this->input->post(NULL, TRUE);
		$order_column = array(NULL,'nisn','nama','nama_prodi','tahun_angkatan',NULL);
		$this->db->select(array('nisn','nama','nama_prodi','tahun_angkatan','agama'));
		$this->db->from($this->_table_name);
		$this->db->join('{PRE}jadwal_kuliah', '{PRE}'.$this->_table_name.'.id_jdl_kls = {PRE}jadwal_kuliah.id_jdl', 'LEFT' );
		$this->db->join('{PRE}thn_akademik', '{PRE}jadwal_kuliah.id_thn_ak_jdl = {PRE}thn_akademik.id_thn_ak', 'LEFT' );
		$this->db->join('{PRE}mahasiswa', '{PRE}'.$this->_table_name.'.id_mhs_kls = {PRE}mahasiswa.id', 'LEFT' );
		$this->db->join('{PRE}prodi', '{PRE}mahasiswa.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
		$this->db->join('{PRE}thn_angkatan', '{PRE}mahasiswa.thn_angkatan = {PRE}thn_angkatan.id_thn_angkatan', 'LEFT' );
		$this->db->group_by(array('mahasiswa.id'));

		$this->db->where('id_thn_ak', $post['value']);

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];
			$this->db->where("(nisn LIKE '%$cari%' OR nama LIKE '%$cari%' OR nama_prodi LIKE '%$cari%' OR tahun_angkatan LIKE '%$cari%')");
		}  

		if(isset($post["order"])){
			$this->db->order_by($order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{ 
			$this->db->order_by('nisn', 'ASC');  
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
    	$post = $this->input->post(NULL, TRUE);
		$this->db->select("*");  
		$this->db->from($this->_table_name);
		$this->db->join('{PRE}jadwal_kuliah', '{PRE}'.$this->_table_name.'.id_jdl_kls = {PRE}jadwal_kuliah.id_jdl', 'LEFT' );
		$this->db->where('id_thn_ak_jdl', $post['value']);
		$this->db->group_by(array('id_mhs_kls'));
		return $this->db->count_all_results();  
	}

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'jadwal') {
					$this->db->join('{PRE}jadwal_kuliah', '{PRE}'.$this->_table_name.'.id_jdl_kls = {PRE}jadwal_kuliah.id_jdl', 'LEFT' );
				}
				if ($table == 'thn_akademik') {
					$this->db->join('{PRE}thn_akademik', '{PRE}jadwal_kuliah.id_thn_ak_jdl = {PRE}thn_akademik.id_thn_ak', 'LEFT' );
				}
				if ($table == 'mata_kuliah') {
					$this->db->join('{PRE}mata_kuliah', '{PRE}jadwal_kuliah.id_mk_jdl = {PRE}mata_kuliah.id_mk', 'LEFT' );
				}
				if ($table == 'konsentrasi_pd') {
					$this->db->join('{PRE}konsentrasi_pd', '{PRE}mata_kuliah.jenis_jdl = {PRE}konsentrasi_pd.id_konst', 'LEFT' );
				}
				if ($table == 'mahasiswa') {
					$this->db->join('{PRE}mahasiswa', '{PRE}'.$this->_table_name.'.id_mhs_kls = {PRE}mahasiswa.id', 'LEFT' );
				}
				if ($table == 'prodi_mhs') {
					$this->db->join('{PRE}prodi', '{PRE}mahasiswa.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'prodi_mk') {
					$this->db->join('{PRE}prodi', '{PRE}mata_kuliah.id_pd_mk = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_prodi = {PRE}fakultas.id_fk', 'LEFT' );
				}
				if ($table == 'thn_angkatan') {
					$this->db->join('{PRE}thn_angkatan', '{PRE}mahasiswa.thn_angkatan = {PRE}thn_angkatan.id_thn_angkatan', 'LEFT' );
				}
				if ($table == 'ptk') {
					$this->db->join('{PRE}ptk', '{PRE}jadwal_kuliah.id_ptk_jdl = {PRE}ptk.id_ptk', 'LEFT' );
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