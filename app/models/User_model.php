<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends My_Models_Configuration{
	protected $_table_name = 'user';
	protected $_primary_key = 'id_user';
	/*protected $_select = array('id_user','username','nama','level_akses','active_status','last_online');*/
	protected $_select_mhs = array('id_user','id_user_detail AS user_in','nisn AS username','nama','level_akses','active_status','last_online');
	protected $_select_ptk = array('id_user','id_user_detail AS user_in','nuptk AS username','nama_ptk AS nama','level_akses','active_status','last_online');
	protected $_order_by = 'last_online';
	protected $_order_by_type = 'DESC';		
	protected $_order_column = array('username', 'nama', NULL, 'last_online',NULL);
	protected $_type;

	public $rules_auth = array(		
		'auth' => array(
			'field' => 'password', 
			'label' => 'Password',
			'rules' => 'trim|required|callback_password_check'
			),
		);

	public $rules_print_umhs = array(		
		'thn_angkatan' => array(
			'field' => 'thn_angkatan', 
			'label' => 'Tahun Angkatan',
			'rules' => 'required|callback_thn_angkatan_check'
			),
		'prodi' => array(
			'field' => 'prodi', 
			'label' => 'Program Studi',
			'rules' => 'required|callback_prodi_check'
			),
		);

	public $rules_print_uptk = array(		
		'prodi' => array(
			'field' => 'prodi', 
			'label' => 'Program Studi',
			'rules' => 'required|callback_prodi_check'
			),
		);

	public $rules_change_password = array(
		'new_password' => array(
			'field' => 'new_password',
			'rules' => 'required|alpha_numeric|min_length[6]|max_length[12]',
			'errors'=> array(
							'required' => 'Masukkan password baru',
							'alpha_numeric' => 'Password hanya boleh mengandung A-Z,a-z,0-9',
							'min_length' => 'Panjang password minimal 6 karakter',
							'max_length' => 'Panjang password maksimal 12 karakter'
						)
			),
		'renew_password' => array(
			'field' => 'renew_password',
			'rules' => 'required|matches[new_password]',
			'errors'=> array(
							'required' => 'Masukkan ulang password lama',
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
		$active_status = array();
		$this->db->from($this->_table_name);
		if ($post['user_type'] == 'mhs') {
			/*$this->db->from('mahasiswa');*/
			$this->db->select($this->_select_mhs);
			$this->db->join('{PRE}mahasiswa', '{PRE}'.$this->_table_name.'.id_user_detail = {PRE}mahasiswa.id', 'LEFT' );
			$this->db->where('level_akses', 'mhs');
			/*$this->db->join('{PRE}user', '{PRE}mahasiswa.id = {PRE}user.id_user_detail', 'LEFT' );*/
		}
		else{
			/*$this->db->from('ptk');*/
			$this->db->select($this->_select_ptk);
			$this->db->join('{PRE}ptk', '{PRE}'.$this->_table_name.'.id_user_detail = {PRE}ptk.id_ptk', 'LEFT' );
			$this->db->where('level_akses', 'ptk');
			/*$this->db->join('{PRE}user', '{PRE}ptk.id_ptk = {PRE}user.id_user_detail', 'LEFT' );*/
		}
		/*$this->db->from($this->_table_name);
		$this->db->select($this->_select);
		$this->db->where('level_akses', $post['user_type']);*/

		if (isset($post['status_user']) && $post['status_user'] !='') {
			$active_status = array('active_status' => $post['status_user']);
			$this->db->where($active_status);
		}

		if(!empty($post["search"]["value"])){
			$cari = $post["search"]["value"];
			/*$this->db->where("(username LIKE '%$cari%')");*/
			if ($post['user_type'] == 'mhs') {
				$cari_nim = array(
					'nisn' => $cari
					);
				$cari_nm = array(
					'nama' => $cari
					);
				$this->db->like($cari_nim);
				$this->db->where($active_status);
				$this->db->or_like($cari_nm);
				$this->db->where($active_status);
				/*$this->db->where("(nisn LIKE '%$cari%' OR nama LIKE '%$cari%')");*/
			}
			else{
				$cari_nidn = array(
					'nuptk' => $cari
					);
				$cari_nm = array(
					'nama_ptk' => $cari
					);
				$this->db->like($cari_nidn);
				$this->db->where($active_status);
				$this->db->or_like($cari_nm);
				$this->db->where($active_status);
				/*$this->db->where("(nuptk LIKE '%$cari%' OR nama_ptk LIKE '%$cari%')");*/
			}
		}  

		if(isset($post["order"])){
			$this->db->order_by($this->_order_column[$post['order']['0']['column']], $post['order']['0']['dir']);  
		}
		else{
			$this->db->order_by('last_online', 'DESC');
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
		if ($post['user_type'] == 'mhs') {
			$this->db->from('mahasiswa');
			$this->db->join('{PRE}user', '{PRE}mahasiswa.id = {PRE}user.id_user_detail', 'LEFT' );
			$this->db->where('level_akses', 'mhs');
		}
		else{
			$this->db->from('ptk');
			$this->db->join('{PRE}user', '{PRE}ptk.id_ptk = {PRE}user.id_user_detail', 'LEFT' );
			$this->db->where('level_akses', 'ptk');
		}
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

	function print_pdf_user($user_level){
		$post = $this->input->post_get(NULL, TRUE);
		if ($user_level == 'mhs') {
			$judul = 'Daftar Info Data Pengguna Mahasiswa';
			$kolom = array(
				'no'=>'No.',
				'nim'=>'NIM',
				'nama' => 'Nama',
				'password' => 'Password',
				);
			$record_u = $this->mahasiswa_model->get_detail_data('get',array('user'),NULL,array('thn_angkatan' => $post['thn_angkatan'],'id_pd_mhs' => $post['prodi'], 'pass_change' => 0),FALSE,array('nisn AS nim','nama','id_user'));
			$data = array();
			$update_pass = array();
			$no = 1;
			foreach ($record_u as $key) {
				$new_password = $this->password_generate();
				$update_pass[] = array(
					'id_user' => $key->id_user,
					'password' => password_hash($new_password,PASSWORD_BCRYPT),
					);
				$arr = array(
					'no' => $no,
					'nim' => $key->nim,
					'nama' => $key->nama,
					'password' => $new_password,
					);
				$data[] = $arr;
				$no++;
			}
		}
		elseif ($user_level == 'ptk') {
			$judul = 'Daftar Info Data Pengguna Tenaga Pendidik';
			$kolom = array(
				'no'=>'No.',
				'nidn'=>'NIDN',
				'nama' => 'Nama',
				'password' => 'Password',
				);
			$record_u = $this->ptk_model->get_detail_data('get',array('user'),NULL,array('jurusan_prodi' => $post['prodi'], 'pass_change' => 0),FALSE,array('nuptk AS nidn','nama_ptk AS nama','id_user'));
			$data = array();
			$no = 1;
			foreach ($record_u as $key) {
				$new_password = $this->password_generate();
				$update_pass[] = array(
					'id_user' => $key->id_user,
					'password' => password_hash($new_password,PASSWORD_BCRYPT),
					);
				$arr = array(
					'no' => $no,
					'nidn' => $key->nidn,
					'nama' => $key->nama,
					'password' => $new_password,
					);
				$data[] = $arr;
				$no++;
			}
		}

		if ($record_u) {
			$update_password = $this->user_model->update($update_pass,'id_user',TRUE);
			if ($update_password) {
				$this->generatepdf($kolom, $data,$judul,$user_level);
			}
			else{
				echo "error, reload again!";
			}
		}
	}
  
  	private function generatepdf($header,$data,$judul,$lvl){
	    //load library tcpdf
	    $this->load->library('CustomHeader');
	    // create new PDF document
	    $pdf = new CustomHeader(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	        
	    // set document information
	    $pdf->SetAuthor('Admin '.web_detail('_site_name'));
	    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	        
	    // set default header data
	    $pdf->setPrintHeader(false);
	    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
	        
	    // set header and footer fonts
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	     
	    // set default monospaced font
	    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	      
	    // set margins
	    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	        
	    // set auto page breaks
	    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	        
	    // set image scale factor
	    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	        
	    // set some language-dependent strings (optional)
	    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	         require_once(dirname(__FILE__).'/lang/eng.php');
	         $pdf->setLanguageArray($l);
	    }
	    // add a page
	    $pdf->AddPage();

	    // Logo
        $image_file = get_real_path('/public/assets/web-images/pt-icon-profile.png');
        $pdf->Image($image_file, 15, 15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $pdf->SetFont('helvetica', 'B', 18);
        // Title
        /*$this->Cell(143, 0, web_detail('_pt_name'), 1, 1, 'C', 0, '', 0,false, 'T', 'M');*/
        if ($lvl == 'mhs') {
        	$html = '<font>'.web_detail('_pt_name').'</font><br>
	        <font>Daftar Info Data Pengguna Mahasiswa</font>';
        }
        else if ($lvl == 'ptk') {
        	$html = '<font>'.web_detail('_pt_name').'</font><br>
	        <font>Daftar Info Data Pengguna Tenaga Pendidik</font>';
        }
        $pdf->writeHTMLCell(143, 0, 35, 17, $html, 0, 1, 0, false, 'C',false);
        /*$this->writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)*/
        /*$pdf->Image($image_file, 178, 15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);*/
        $pdf->writeHTMLCell(183, 0, 14, 36, '<hr>', 0, 1, 0, false, 'C',false);

        // Set font
	    $pdf->SetFont('helvetica', '', 12);
	    // close and output PDF document
	    if ($this->input->post(NULL, TRUE)) {
			$post = $this->input->post(NULL, TRUE);
		}
		else{
			$post = $this->input->get(NULL, TRUE);
		}
	    $date_created = explode(' ',date('Y-m-d H:i:s'));
	    if ($lvl == 'mhs') {
	    	$thn_angkatan = $this->thn_angkatan_model->get_by_search(array('id_thn_angkatan' => $post['thn_angkatan']),TRUE,array('tahun_angkatan'));
	    	$prodi = $this->prodi_model->get_by_search(array('id_prodi' => $post['prodi']),TRUE,array('nama_prodi','jenjang_prodi'));
	    	$pdf->SetTitle('Info Pengguna Mahasiswa | Angkatan : '.$thn_angkatan->tahun_angkatan.' - Prodi : '.$prodi->nama_prodi.' ('.$prodi->jenjang_prodi.')');
		    $pdf->SetSubject('Info Pengguna Mahasiswa | Angkatan : '.$thn_angkatan->tahun_angkatan.' - Prodi : '.$prodi->nama_prodi.' ('.$prodi->jenjang_prodi.')');
		    $html = '<table>
		    <tr>
		    	<td>Tahun Angkatan</td>
		    	<td> : '.$thn_angkatan->tahun_angkatan.'</td>
		    </tr>
		    <tr>
		    	<td>Program Studi</td>
		    	<td> : '.$prodi->nama_prodi.'</td>
		    </tr>
		    <tr>
		    	<td>Dibuat</td>
		    	<td> : '.date_convert($date_created[0]).'</td>
		    </tr>
		    </table>';
	        $pdf->writeHTMLCell(90, 0, 14, 40, $html, 0, 1, 0, false, '',false);
		    // print colored table
		    $pdf->ColoredTable($header, $data,$lvl);
	    	$pdf->Output('Info_Pengguna_'.$thn_angkatan->tahun_angkatan.'_'.$prodi->nama_prodi.'.pdf', 'I');
	    }
	    elseif ($lvl == 'ptk') {
	    	$prodi = $this->prodi_model->get_by_search(array('id_prodi' => $post['prodi']),TRUE,array('nama_prodi','jenjang_prodi'));
	    	$pdf->SetTitle('Info Pengguna Tenaga Pendidik | Prodi : '.$prodi->nama_prodi.' ('.$prodi->jenjang_prodi.')');
		    $pdf->SetSubject('Info Pengguna Tenaga Pendidik | Prodi : '.$prodi->nama_prodi.' ('.$prodi->jenjang_prodi.')');
		    $html = '<table>
		    <tr>
		    	<td>Program Studi</td>
		    	<td> : '.$prodi->nama_prodi.'</td>
		    </tr>
		    <tr>
		    	<td>Dibuat</td>
		    	<td> : '.date_convert($date_created[0]).'</td>
		    </tr>
		    </table>';
	        $pdf->writeHTMLCell(90, 0, 14, 40, $html, 0, 1, 0, false, '',false);
		    // print colored table
		    $pdf->ColoredTable($header, $data,$lvl);
	    	$pdf->Output('Info_Pengguna_ptk_'.$prodi->nama_prodi.'.pdf', 'I');
	    }
	}

}