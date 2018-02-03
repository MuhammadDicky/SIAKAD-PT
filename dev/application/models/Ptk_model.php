<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ptk_model extends My_Models_Configuration{
	protected $_table_name = 'ptk';
	protected $_select = array('nama_ptk','nuptk','status_aktif_ptk','status_verifikasi_ptk','id_ptk');
	protected $_primary_key = 'id_ptk';
	protected $_order_by = 'nuptk';
	protected $_order_column = array(NULL,NULL,'nuptk','nama_ptk', NULL, NULL);
	protected $_order_by_type = 'ASC';		
	protected $_type;

	public $rules = array(
		'jurusan_prodi' => array(
			'field' => 'jurusan_prodi', 
			'label' => 'Program Studi',
			'rules' => 'callback_pd_check_ex'
			),
		'nuptk' => array(
			'field' => 'nuptk', 
			'label' => 'NIDN',
			'rules' => 'required|numeric|callback_nuptk_check',
			'errors'=> array(
							'required' => 'Tolong masukkan NIDN',
							'numeric' => 'NIDN hanya boleh mengandung angka 0-9',
							'nuptk_check' => 'Maaf, NIDN yang anda masukkan sudah ada. Tolong cek kembali!'
						)
			),
		'nama_ptk' => array(
			'field' => 'nama_ptk', 
			'label' => 'Nama Tenaga Pendidik',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama'
						)
			),
		'nip' => array(
			'field' => 'nip',
			'label' => 'NIP',
			'rules' => 'numeric|callback_nip_check',
			'errors'=> array(
							'numeric' => 'NIP hanya boleh mengandung angka 0-9',
							'nip_check' => 'Maaf, NIP yang anda masukkan sudah ada. Tolong cek kembali!'
						)
			),
		'jk_ptk' => array(
			'field' => 'jk_ptk', 
			'label' => 'Jenis kelamin',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong pilih jenis kelamin'
						)
			),
		'tmp_lhr_ptk' => array(
			'field' => 'tmp_lhr_ptk', 
			'label' => 'Tempat lahir',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tempat lahir'
						)
			),
		'tgl_lhr_ptk' => array(
			'field' => 'tgl_lhr_ptk', 
			'label' => 'Jenis kelamin',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal lahir'
						)
			),
		'status_ptk' => array(
			'field' => 'status_ptk', 
			'label' => 'Status Ikatan Kerja',
			'rules' => 'in_list[1,2,3]',
			'errors'=> array(
							'in_list' => 'Status ikatan kerja yang anda pilih tidak valid'
						)
			),
		'status_aktif_ptk' => array(
			'field' => 'status_aktif_ptk', 
			'label' => 'Status Keaktifan',
			'rules' => 'in_list[1,2,3,4,5]',
			'errors'=> array(
							'in_list' => 'Status keaktifan yang anda pilih tidak valid'
						)
			),
		'jenjang' => array(
			'field' => 'jenjang', 
			'label' => 'Pendidik Tertinggi',
			'rules' => 'in_list[1,2,3,4]',
			'errors'=> array(
							'in_list' => 'Pendidikan tertinggi yang anda pilih tidak valid'
						)
			),
		'agama_ptk' => array(
			'field' => 'agama_ptk', 
			'label' => 'Agama',
			'rules' => 'in_list[1,2,3,4,5,6,7]',
			'errors'=> array(
							'in_list' => 'Agama yang anda pilih tidak valid'
						)
			)
		);

	function __construct(){
		parent:: __construct();
	}

	function make_query(){  
		$post  = $this->input->post(NULL, TRUE);
		$this->db->select($this->_select);  
		$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.jurusan_prodi = {PRE}prodi.id_prodi', 'LEFT' );
		$this->db->from($this->_table_name);  		

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];			
			$this->db->where("(nama_ptk LIKE '%$cari%' OR nuptk LIKE '%$cari%')");	
		}

		if ($post['status_aktif_ptk'] !='') {
			$this->db->where('status_aktif_ptk', $post['status_aktif_ptk']);
		}

		if (!empty($post['cari_prodi'])) {
			$this->db->where('jurusan_prodi', $post['cari_prodi']);
		}

		if ($post['status_data'] !='') {
			$this->db->where('status_verifikasi_ptk', $post['status_data']);
		}

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('nama_ptk', 'ASC');  
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

	/*function get_detail_ptk($where=NULL,$single=FALSE,$select=NULL,$group=NULL){
		// $this->db->join('table_name', 'table_name.field = table_name.field')
		$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.jurusan_prodi = {PRE}prodi.id_prodi', 'LEFT' );		
		$this->db->join('{PRE}user', '{PRE}'.$this->_table_name.'.id_ptk = {PRE}user.id_user_detail', 'LEFT' );
		return parent::get_by_search($where,$single,$select,$group);
	}*/

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'prodi_ptk') {
					$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.jurusan_prodi = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT' );
				}
				if ($table == 'user') {
					$this->db->join('{PRE}user', '{PRE}'.$this->_table_name.'.id_ptk = {PRE}user.id_user_detail', 'LEFT' );
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