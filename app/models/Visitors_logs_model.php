<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitors_logs_model extends My_Models_Configuration{
	protected $_table_name = 'visitor_logs';
	protected $_primary_key = 'visitor_ID';
	protected $_select = array('visitor_id_user','visitor_IP','visitor_user_level','visitor_date','visitor_agent','visitor_os','visitor_browser');
	protected $_order_by = 'visitor_date';
	protected $_order_by_type = 'DESC';
	protected $_order_column = array(NULL, NULL, NULL, NULL, 'visitor_date');
	protected $_type;

	function __construct(){
		parent:: __construct();
	}

	function make_query(){ 
		$post  = $this->input->post(NULL, TRUE);
		/*$sub_query_user[] = 'CASE WHEN visitor_user_level = "mhs" 
								THEN (SELECT nisn FROM {PRE}mahasiswa WHERE id = visitor_id_user) 
							WHEN visitor_user_level = "ptk" 
								THEN (SELECT nuptk FROM {PRE}ptk WHERE id_ptk = visitor_id_user) 
							END AS username';
		$sub_query_user[] = 'CASE WHEN visitor_user_level = "mhs" 
								THEN (SELECT nama FROM {PRE}mahasiswa WHERE id = visitor_id_user) 
							WHEN visitor_user_level = "ptk" 
								THEN (SELECT nama_ptk FROM {PRE}ptk WHERE id_ptk = visitor_id_user) 
							END AS nama';
		$sub_query_user[] = 'CASE WHEN visitor_user_level = "mhs" 
								THEN (SELECT photo_mhs FROM {PRE}mahasiswa WHERE id = visitor_id_user) 
							WHEN visitor_user_level = "ptk" 
								THEN (SELECT photo_ptk FROM {PRE}ptk WHERE id_ptk = visitor_id_user) 
							END AS photo_u';
		$this->db->select(list_fields(array('visitor_logs'),$sub_query_user));*/
		$this->db->from($this->_table_name)->where(array('visitor_user_level != ' => 'admin'));

		if ($post['visitor'] == 'mhs') {
			$this->db->select(list_fields(array('visitor_logs'),array('nisn AS username','nama','photo_mhs as photo_u')));
			$this->db->join('{PRE}mahasiswa', '{PRE}'.$this->_table_name.'.visitor_id_user = {PRE}mahasiswa.id', 'LEFT' );
			$this->db->where('visitor_user_level', 'mhs');
		}
		else{
			$this->db->select(list_fields(array('visitor_logs'),array('nuptk AS username','nama_ptk as nama','photo_ptk as photo_u')));
			$this->db->join('{PRE}ptk', '{PRE}'.$this->_table_name.'.visitor_id_user = {PRE}ptk.id_ptk', 'LEFT' );
			$this->db->where('visitor_user_level', 'ptk');
		}
		
		
		if (isset($post['visitor_browser']) && $post['visitor_browser'] !='') {
			if ($post['visitor_browser'] != 'other-browser') {
				$this->db->like('visitor_browser', $post['visitor_browser']);
			}
			else{
				$other_browser = array('Chrome','Mozilla','Edge','Internet Explorer','Safari','Opera');
				$this->db->where_not_in('visitor_browser', $other_browser);
			}
		}
		if (isset($post['visitor_platform']) && $post['visitor_platform'] !='') {
			if ($post['visitor_platform'] != 'other-platform') {
				$this->db->like('visitor_os', $post['visitor_platform']);
			}
			else{
				$other_os = array('Windows','Linux','Android','IOS','MAC OS X');
				$this->db->where_not_in('visitor_os', $other_os);
			}
		}

		if(!empty($post["search"]["value"])){
			$cari = $post["search"]["value"];
			if ($post['visitor'] == 'mhs') {
				$this->db->where("(nisn LIKE '%$cari%' OR nama LIKE '%$cari%')");
			}
			else{
				$this->db->where("(nuptk LIKE '%$cari%' OR nama_ptk LIKE '%$cari%')");
			}
		}
		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('visitor_date', 'DESC');
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
		$this->db->from($this->_table_name);  
		$this->db->where('visitor_user_level !=', 'admin');
		return $this->db->count_all_results();
	}

}