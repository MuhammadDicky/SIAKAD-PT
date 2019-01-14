<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends My_Models_Configuration{
	protected $_table_name = 'mahasiswa';
	protected $_select = array('nisn','nama','nama_prodi','tahun_angkatan','status_verifikasi_mhs','id','id_ortu');
	protected $_primary_key = 'id';
	protected $_order_by = 'nisn';
	protected $_order_column = array(NULL,NULL,'nisn', 'nama', 'nama_prodi', 'tahun_angkatan', NULL);
	protected $_order_by_type = 'ASC';		
	protected $_type;

	public $rules = array(
		'nisn' => array(
			'field' => 'nisn', 
			'label' => 'NIM',
			'rules' => 'required|numeric|callback_nisn_check',
			'errors'=> array(
							'required' => 'Tolong NIM diisi',
							'numeric' => 'NIM hanya boleh mengandung angka 0-9',
							'nisn_check' => 'NIM yang anda masukkan sudah ada'
						)
			),
		'nama' => array(
			'field' => 'nama', 
			'label' => 'Nama mahasiswa',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan nama mahasiswa'
						)
			),
		'thn_angkatan' => array(
			'field' => 'thn_angkatan', 
			'label' => 'Tahun angkatan',
			'rules' => 'callback_thn_angkatan_mhs_c'
			),
		'id_pd_mhs' => array(
			'field' => 'id_pd_mhs', 
			'label' => 'Program Studi',
			'rules' => 'callback_pd_check_ex'
			),
		'jk' => array(
			'field' => 'jk', 
			'label' => 'Jenis kelamin',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong pilih jenis kelamin'
						)
			),
		'tmp_lhr' => array(
			'field' => 'tmp_lhr', 
			'label' => 'Tempat lahir',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tempat lahir'
						)
			),
		'tgl_lhr' => array(
			'field' => 'tgl_lhr', 
			'label' => 'Jenis kelamin',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan tanggal lahir'
						)
			),
		'agama' => array(
			'field' => 'agama', 
			'label' => 'Agama',
			'rules' => 'required|in_list[Islam,Kristen,Katholik,Budha,Hindu,Konghucu,Lainnya]',
			'errors'=> array(
							'required' => 'Tolong pilih agama',
							'in_list' => 'Agama yang anda pilih tidak valid'
						)
			),
		'alamat' => array(
			'field' => 'alamat', 
			'label' => 'Alamat',
			'rules' => 'required',
			'errors'=> array(
							'required' => 'Tolong masukkan alamat sekarang'
						)
			),
		'jns_tinggal' => array(
			'field' => 'jns_tinggal', 
			'label' => 'Jenis Tinggal',
			'rules' => 'in_list[Bersama orang tua,Wali,Asrama,Lainnya]',
			'errors'=> array(
							'in_list' => 'Jenis tinggal yang anda pilih tidak valid'
						)
			),
		'alt_trans' => array(
			'field' => 'alt_trans', 
			'label' => 'Alat Transportasi',
			'rules' => 'in_list[Sepeda motor,Kendaraan pribadi,Ojek,Angkutan umum/bus/pete-pete,Andong/bendi/sado/dokar/delman/becak,Mobil/bus antar jemput,Sepeda,Jalan kaki,Lainnya]',
			'errors'=> array(
							'in_list' => 'Jenis tinggal yang anda pilih tidak valid'
						)
			),
		'email' => array(
			'field' => 'email', 
			'label' => 'Email',
			'rules' => 'valid_email',
			'errors'=> array(
							'valid_email' => 'Tolong masukkan email yang valid'
						)
			),
		'hp' => array(
			'field' => 'hp', 
			'label' => 'HP',
			'rules' => 'min_length[11]|max_length[12]',
			'errors'=> array(
							'min_length' => 'Tolong masukkan nomor hp yang valid',
							'max_length' => 'Tolong masukkan nomor hp yang valid'
						)
			),
		'pendi_ayah' => array(
			'field' => 'pendi_ayah', 
			'label' => 'Pendidikan Ayah',
			'rules' => 'in_list[SD / sederajat,SMP / sederajat,SMA / sederajat,D1,D3,S1,S2,S3,Putus SD,Tidak Sekolah,Lainnya]',
			'errors'=> array(
							'in_list' => 'Pendidikan ayah yang anda pilih tidak valid'
						)
			),
		'pekerjaan_ayah' => array(
			'field' => 'pekerjaan_ayah', 
			'label' => 'Pekerjaan Ayah',
			'rules' => 'in_list[Buruh,Petani,Wiraswasta,Wirausaha,Karyawan swasta,PNS/TNI/Porli,Nelayan,Pedagang kecil,Tidak bekerja,Sudah meninggal,lainnya]',
			'errors'=> array(
							'in_list' => 'Pekerjaan ayah yang anda pilih tidak valid'
						)
			),
		'penghasilan_ayah' => array(
			'field' => 'penghasilan_ayah', 
			'label' => 'Penghasilan Ayah',
			'rules' => 'in_list[Kurang dari Rp. 500.000,Kurang dari Rp. 1000.000,Rp. 500.000 - Rp. 1.000.000,Rp. 1.000.000 - Rp. 2.000.000,Rp. 2.000.000 - Rp. 5.000.000,Lebih dari Rp. 5.000.000]',
			'errors'=> array(
							'in_list' => 'Penghasilan ayah yang anda pilih tidak valid'
						)
			),
		'pendi_ibu' => array(
			'field' => 'pendi_ibu', 
			'label' => 'Pendidikan Ibu',
			'rules' => 'in_list[SD / sederajat,SMP / sederajat,SMA / sederajat,D1,D3,S1,S2,S3,Putus SD,Tidak Sekolah,Lainnya]',
			'errors'=> array(
							'in_list' => 'Pendidikan ibu yang anda pilih tidak valid'
						)
			),
		'pekerjaan_ayah' => array(
			'field' => 'pekerjaan_ayah', 
			'label' => 'Pekerjaan Ayah',
			'rules' => 'in_list[Buruh,Petani,Wiraswasta,Wirausaha,Karyawan swasta,PNS/TNI/Porli,Nelayan,Pedagang kecil,Tidak bekerja,Sudah meninggal,lainnya]',
			'errors'=> array(
							'in_list' => 'Pekerjaan ibu yang anda pilih tidak valid'
						)
			),
		'penghasilan_ibu' => array(
			'field' => 'penghasilan_ibu', 
			'label' => 'Penghasilan Ibu',
			'rules' => 'in_list[Kurang dari Rp. 500.000,Kurang dari Rp. 1000.000,Rp. 500.000 - Rp. 1.000.000,Rp. 1.000.000 - Rp. 2.000.000,Rp. 2.000.000 - Rp. 5.000.000,Lebih dari Rp. 5.000.000]',
			'errors'=> array(
							'in_list' => 'Penghasilan ibu yang anda pilih tidak valid'
						)
			),
		'pendi_wali' => array(
			'field' => 'pendi_wali', 
			'label' => 'Pendidikan Wali',
			'rules' => 'in_list[SD / sederajat,SMP / sederajat,SMA / sederajat,D1,D3,S1,S2,S3,Putus SD,Tidak Sekolah,Lainnya]',
			'errors'=> array(
							'in_list' => 'Pendidikan wali yang anda pilih tidak valid'
						)
			),
		'pekerjaan_wali' => array(
			'field' => 'pekerjaan_wali', 
			'label' => 'Pekerjaan Wali',
			'rules' => 'in_list[Buruh,Petani,Wiraswasta,Wirausaha,Karyawan swasta,PNS/TNI/Porli,Nelayan,Pedagang kecil,Tidak bekerja,Sudah meninggal,lainnya]',
			'errors'=> array(
							'in_list' => 'Pekerjaan wali yang anda pilih tidak valid'
						)
			),
		'penghasilan_wali' => array(
			'field' => 'penghasilan_wali', 
			'label' => 'Penghasilan Wali',
			'rules' => 'in_list[Kurang dari Rp. 500.000,Kurang dari Rp. 1000.000,Rp. 500.000 - Rp. 1.000.000,Rp. 1.000.000 - Rp. 2.000.000,Rp. 2.000.000 - Rp. 5.000.000,Lebih dari Rp. 5.000.000]',
			'errors'=> array(
							'in_list' => 'Penghasilan wali yang anda pilih tidak valid'
						)
			)
		);
	
	function __construct(){
		parent:: __construct();
	}

	function make_query(){  
		$post  = $this->input->post(NULL, TRUE);
		$cari_thn_angkatan = array();
		$cari_prodi = array();
		$cari_status_data = array();
		if (isset($post['data_search']) && $post['data_search'] == 0) {
			$this->db->select(array('nisn','nama','nama_prodi','tahun_angkatan','id','tgl_lulus'));
			$this->db->from('alumni');
			$this->db->join('{PRE}'.$this->_table_name, '{PRE}'.$this->_table_name.'.id = {PRE}alumni.id_mhs_alni', 'LEFT');
		}
		elseif (isset($post['data_search']) && $post['data_search'] == 1) {
			$this->db->select(array('nisn','nama','nama_prodi','tahun_angkatan','id','tgl_drop_out'));
			$this->db->from('mhs_do');
			$this->db->join('{PRE}'.$this->_table_name, '{PRE}'.$this->_table_name.'.id = {PRE}mhs_do.id_mhs_DO', 'LEFT');
		}
		else{
			$this->db->from($this->_table_name);
		}

		if (isset($post['data'])) {
			$this->db->select(array('nisn','nama','nama_prodi','agama','alamat'));  
			$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
			$this->db->join('{PRE}thn_angkatan', '{PRE}'.$this->_table_name.'.thn_angkatan = {PRE}thn_angkatan.id_thn_angkatan', 'LEFT' );
			if ($post['data'] == 'thn_angkatan') {
				$cari_thn_angkatan = array('thn_angkatan' => $post['value']);
				$this->db->where('thn_angkatan', $post['value']);
			}
		}
		else{
			$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
			$this->db->join('{PRE}thn_angkatan', '{PRE}'.$this->_table_name.'.thn_angkatan = {PRE}thn_angkatan.id_thn_angkatan', 'LEFT' );
			$this->db->join('{PRE}ortu_wali', '{PRE}'.$this->_table_name.'.id = {PRE}ortu_wali.id_mhs_ortu', 'LEFT' );
			$this->db->select($this->_select);  
		}

		if (!empty($post['cari_thn_angkatan'])) {
			$cari_thn_angkatan = array('thn_angkatan' => $post['cari_thn_angkatan']);
			$this->db->where('thn_angkatan', $post['cari_thn_angkatan']);
		}
		if (!empty($post['cari_prodi'])) {			
			$cari_prodi = array('id_prodi' => $post['cari_prodi']);
			$this->db->where('id_prodi', $post['cari_prodi']);
		}

		if (isset($post['status_data']) && $post['status_data'] !='') {
			$cari_status_data = array('status_verifikasi_mhs' => $post['status_data']);
			$this->db->where('status_verifikasi_mhs', $post['status_data']);
		}

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];
			$search_spec = array_merge($cari_thn_angkatan,$cari_prodi,$cari_status_data);
			$this->db->like(array('nisn' => $cari));
			$this->db->where($search_spec);
			$this->db->or_like(array('nama' => $cari));
			$this->db->where($search_spec);
			$this->db->or_like(array('nama_prodi' => $cari));
			$this->db->where($search_spec);
			$this->db->or_like(array('tahun_angkatan' => $cari));
			$this->db->where($search_spec);
			/*$this->db->where("(nisn LIKE '%$cari%' OR nama LIKE '%$cari%' OR nama_prodi LIKE '%$cari%' OR tahun_angkatan LIKE '%$cari%')");*/
		}

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('nisn', 'ASC');  
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
    	$post  = $this->input->post(NULL, TRUE);
		$this->db->select("*");
		if (isset($post['data_search']) && $post['data_search'] == 0) {
			$this->db->from('alumni');
		}
		elseif (isset($post['data_search']) && $post['data_search'] == 1) {
			$this->db->from('mhs_do');
		}
		else{
			$this->db->from($this->_table_name);
		}

		if (isset($post['data'])) {
			if ($post['data'] == 'thn_angkatan') {
				$this->db->where('thn_angkatan', $post['value']);
			}
		}
		return $this->db->count_all_results();  
	}

	function get_detail_data($query=NULL,$join_table=NULL,$act=NULL,$where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL){
		if ($join_table != NULL) {
			foreach ($join_table as $table) {
				if ($table == 'prodi_mhs') {
					$this->db->join('{PRE}prodi', '{PRE}'.$this->_table_name.'.id_pd_mhs = {PRE}prodi.id_prodi', 'LEFT' );
				}
				if ($table == 'fakultas') {
					$this->db->join('{PRE}fakultas', '{PRE}prodi.id_fk_pd = {PRE}fakultas.id_fk', 'LEFT' );
				}
				if ($table == 'user') {
					$this->db->join('{PRE}user', '{PRE}'.$this->_table_name.'.id = {PRE}user.id_user_detail', 'LEFT' );
				}
				if ($table == 'alumni') {
					$this->db->join('{PRE}alumni', '{PRE}'.$this->_table_name.'.id = {PRE}alumni.id_mhs_alni', 'LEFT' );
				}
				if ($table == 'mhs_do') {
					$this->db->join('{PRE}mhs_do', '{PRE}'.$this->_table_name.'.id = {PRE}mhs_do.id_mhs_DO', 'LEFT' );
				}
				if ($table == 'ortu') {
					$this->db->join('{PRE}ortu_wali', '{PRE}'.$this->_table_name.'.id = {PRE}ortu_wali.id_mhs_ortu', 'LEFT' );
				}
				if ($table == 'thn_angkatan') {
					$this->db->join('{PRE}thn_angkatan', '{PRE}'.$this->_table_name.'.thn_angkatan = {PRE}thn_angkatan.id_thn_angkatan', 'LEFT' );
				}
			}
		}

		
		/*Structur act*/
		/*$where_in_1 = array('val1','val2');
		$where_in_2 = array('val1','val2');
		$act_where_in = array(
			'field1' => $where_in_1,
			'field2' => $where_in_2
			);

		$where_not_in_1 = array('val1','val2');
		$where_not_in_2 = array('val1','val2');
		$act_where_not_in = array(
			'field1' => $where_not_in_1,
			'field2' => $where__not_in_2
			);
		
		$act = array(
			'in' => $act_where_in,
			'not_in' => $act_where_not_in,
			);*/

		if ($query == 'get') {
			return parent::get_by_search($where,$single,$select,$group,$order,NULL,$act);
		}
		elseif ($query == 'count') {
			return parent::count($where,$group,$act);
		}
	}

}