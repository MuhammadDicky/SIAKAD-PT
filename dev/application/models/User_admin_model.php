<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_admin_model extends My_Models_Configuration{
	protected $_table_name = 'user_admin';
	protected $_primary_key = 'id_user';
	protected $_select = array('id_user','username','uncrypt_password','level_akses','active_status','last_online');
	protected $_order_by = 'last_online';
	protected $_order_by_type = 'DESC';		
	protected $_order_column = array('username', NULL, NULL, NULL, 'last_online');
	protected $_type;

	public $rules_auth = array(		
		'auth' => array(
			'field' => 'password', 
			'label' => 'Password',
			'rules' => 'trim|required|callback_password_check'
			),
		);

	public $rules_change_password = array(
		'new_password' => array(
			'field' => 'new_password',
			'rules' => 'required|alpha_numeric|min_length[5]|max_length[10]',
			'errors'=> array(
							'required' => 'Masukkan password baru',
							'alpha_numeric' => 'Password hanya boleh mengandung A-Z,a-z,0-9',
							'min_length' => 'Panjang password minimal 5 karakter',
							'max_length' => 'Panjang password maksimal 10 karakter'
						)
			),
		'confirm_password' => array(
			'field' => 'confirm_password',
			'rules' => 'required|matches[new_password]',
			'errors'=> array(
							'required' => 'Masukkan konfirmasi password baru',
							'matches' => 'Password yang anda masukkan tidak sama dengan password baru',
						)
			),
		'old_password' => array(
			'field' => 'old_password',
			'rules' => 'required|callback_check_password',
			'errors'=> array(
							'required' => 'Masukkan password lama',
							'check_password' => 'Password lama yang anda masukkan salah',
						)
			)
		);


	function __construct(){
		parent:: __construct();
	}

	function make_query(){ 
		$post  = $this->input->post(NULL, TRUE);
		$this->db->from($this->_table_name);
		$this->db->select($this->_select);
		$this->db->where('level_akses', $post['user_type']);

		if(!empty($post["search"]["value"])){  
			$cari = $post["search"]["value"];
			$this->db->where("(username LIKE '%$cari%')");
		}  

		if(isset($post["order"])){  
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}  
		else{  
			$this->db->order_by('username', 'ASC');  
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

	function password_generate(){
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$len = strlen($string)-1;
		$pass = '';
		for ($i=1; $i <=7 ; $i++) { 
			$start = rand(0,$len);
			$pass .= $string{$start};
		}
		return $pass;
	}

}