<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function get_templete_dir($path,$dir_file,$r_con=FALSE){
		global $Config;
		$replace_path = str_replace('\\', '/', $path);
		$get_digit_doc_root = strlen($Config->_document_root);
		$full_path = substr($replace_path,  $get_digit_doc_root);
		if (isset($_SESSION['n_val']) && $r_con == 'nC') {
			return $Config->_site_url.$full_path.'/'.$dir_file.'?nC='.$_SESSION['n_val'];
		}
		elseif ($r_con == TRUE) {
			return $Config->_site_url.$full_path.'/'.$dir_file.'?nC='.rand_val();
		}
		else{
			return $Config->_site_url.$full_path.'/'.$dir_file;
		}
	}

	function get_template_assets($dir_file,$r_con=FALSE){
		global $Config;
		$_this =& get_instance();
		$template = '';
		if (isset($_this->site->template)) {
			$template = $_this->site->template.'/';
		}
		$full_url = $Config->_site_url.$Config->_template_assets.$template.$dir_file;
		if (isset($_SESSION['n_val']) && $r_con == 'nC') {
			return $full_url.'?nC='.$_SESSION['n_val'];
		}
		elseif ($r_con == TRUE) {
			return $full_url.'?nC='.rand_val();
		}
		else{
			return $full_url;
		}
    }
    
    function get_custom_assets($url, $r_con=FALSE){
		global $Config;
        $_this =& get_instance();
        if (isset($_SESSION['n_val']) && $r_con == 'nC') {
            return $Config->_site_url.$Config->_template_assets.$_this->site->template.'/custom/'.$_this->site->side.'/'.$url.'?nC='.$_SESSION['n_val'];
		}
		elseif ($r_con == TRUE) {
            return $Config->_site_url.$Config->_template_assets.$_this->site->template.'/custom/'.$_this->site->side.'/'.$url.'?nC='.rand_val();
		}
		else{
			return $Config->_site_url.$Config->_template_assets.$_this->site->template.'/custom/'.$_this->site->side.'/'.$url;
		}
	}

	function get_configJS($url){
		return get_custom_assets($url);
	}

	function get_plugin($plugin,$com,$a_com=NULL,$r_con=FALSE){
		global $Config;
		$set_url = $Config->_site_url.$Config->_plugin_path;
		$rand = '';
		if (isset($_SESSION['n_val']) && $r_con == 'nC') {
			$rand = '?nC='.$_SESSION['n_val'];
		}
		elseif ($r_con == TRUE) {
			$rand = '?nC='.rand_val();
		}

		if ($plugin == 'angular') {
			$full_url = $Config->_site_url.'template/fe_frameworks/AngularJS/angular.min.js'.$rand;
		}
		elseif ($plugin == 'bluebird') {
			$full_url = $set_url.'bluebird/bluebird.min.js'.$rand;
		}
		elseif ($plugin == 'bs-toogle-master') {
			if ($com == 'js') {
				$full_url = $set_url.'bootstrap-toggle-master/js/bootstrap-toggle.min.js'.$rand;
			}
			elseif ($com == 'css') {
				$full_url = $set_url.'bootstrap-toggle-master/css/bootstrap-toggle.min.css'.$rand;
			}
		}
		elseif ($plugin == 'chartjs') {
			if ($com == 'js') {
				$full_url = $set_url.'chartjs/Chart.min'.$a_com.'.js'.$rand;
			}
		}
		elseif ($plugin == 'datatables') {
			if ($com == 'js') {
				if ($a_com == 'jquery') {
					$full_url = $set_url.'datatables/jquery.dataTables.min.js'.$rand;
				}
				elseif ($a_com == 'responsive') {
					$full_url = $set_url.'datatables/extensions/responsive/dataTables.responsive.min.js'.$rand;
				}
				elseif ($a_com == 'bs') {
					$full_url = $set_url.'datatables/dataTables.bootstrap.min.js'.$rand;
				}
				elseif ($a_com == 'bs4') {
					$full_url = $set_url.'datatables/dataTables.bootstrap4.min.js'.$rand;
				}
			}
			elseif ($com == 'css') {
				if ($a_com == 'responsive') {
					$full_url = $set_url.'datatables/extensions/responsive/responsive.bootstrap.min.css'.$rand;
				}
				elseif ($a_com == 'bs') {
					$full_url = $set_url.'datatables/dataTables.bootstrap.min.css'.$rand;
				}
				elseif ($a_com == 'bs4') {
					$full_url = $set_url.'datatables/dataTables.bootstrap4.min.css'.$rand;
				}
			}
		}
		elseif ($plugin == 'datepicker') {
			if ($com == 'js') {
				if ($a_com == 'lang') {
					$full_url = $set_url.'datepicker/locales/bootstrap-datepicker.id.js'.$rand;
				}
				else{
					$full_url = $set_url.'datepicker/bootstrap-datepicker.js'.$rand;
				}
			}
			elseif ($com == 'css') {
				$full_url = $set_url.'datepicker/datepicker3.css'.$rand;
			}
		}
		elseif ($plugin == 'fastclick') {
			if ($com == 'js') {
				$full_url = $set_url.'fastclick/fastclick.js'.$rand;
			}
		}
		elseif ($plugin == 'fontawesome') {
			if ($com == 'css') {
				$full_url = $set_url.'fontawesome/v4.7.0/css/font-awesome.min.css'.$rand;
			}
		}
		elseif ($plugin == 'icheck') {
			if ($com == 'js') {
				$full_url = $set_url.'iCheck/icheck.min.js'.$rand;
			}
			elseif ($com == 'css') {
				if ($a_com == 'all') {
					$full_url = $set_url.'iCheck/all.css'.$rand;
				}
				elseif ($a_com == 'flat_blue') {
					$full_url = $set_url.'iCheck/flat/blue.css'.$rand;
				}
				elseif ($a_com == 'square_blue') {
					$full_url = $set_url.'iCheck/square/blue.css'.$rand;
				}
			}
		}
		elseif ($plugin == 'jquery') {
			if ($com == 'js') {
				$full_url = $set_url.'jQuery/jquery.min.js'.$rand;
			}
		}
		elseif ($plugin == 'jquery-ui') {
			if ($com == 'js') {
				$full_url = $set_url.'jQueryUI/jquery-ui.min.js'.$rand;
			}
		}
		elseif ($plugin == 'jquery-file-select') {
			if ($com == 'js') {
				if ($a_com == 'lang') {
					$full_url = $set_url.'jquery-file-select/js/locales/id.js'.$rand;
				}
				else{
					$full_url = $set_url.'jquery-file-select/js/fileinput.min.js'.$rand;
				}
			}
			elseif ($com == 'css') {
				if ($a_com == 'rtl') {
					$full_url = $set_url.'jquery-file-select/css/fileinput-rtl.min.css'.$rand;
				}
				else{
					$full_url = $set_url.'jquery-file-select/css/fileinput.min.css'.$rand;
				}
			}
		}
		elseif ($plugin == 'jquery-loading-overlay') {
			if ($com == 'js') {
				if ($a_com == 'progress') {
					$full_url = $set_url.'jquery-loading-overlay/loadingoverlay.min.js'.$rand;
				}
				else{
					$full_url = $set_url.'jquery-loading-overlay/loadingoverlay_progress.min.js'.$rand;
				}
			}
			elseif ($com == 'image') {
				$full_url = $set_url.'jquery-loading-overlay/'.$a_com.$rand;
			}
		}
		elseif ($plugin == 'load-me') {
			if ($com == 'css') {
				$full_url = $set_url.'loadme-master/dist/style/loadme.min.css'.$rand;
			}
		}
		elseif ($plugin == 'loaderskit') {
			if ($com == 'css') {
				if ($a_com == 'main') {
					$full_url = $set_url.'loaderskit/main.css'.$rand;
				}
				elseif ($a_com == 'normalize') {
					$full_url = $set_url.'loaderskit/normalize.css'.$rand;
				}
			}
		}
		elseif ($plugin == 'momentjs') {
			if ($com == 'js') {
				$full_url = $set_url.'momentjs/moment-with-locales.min.js'.$rand;
			}
		}
		elseif ($plugin == 'pace') {
			if ($com == 'js') {
				$full_url = $set_url.'pace/pace.min.js'.$rand;
			}
			elseif ($com == 'css') {
				$full_url = $set_url.'pace/pace.min.css'.$rand;
			}
		}
		elseif ($plugin == 'select2') {
			if ($com == 'js') {
				if ($a_com == 'lang') {
					$full_url = $set_url.'select2/i18n/id.js'.$rand;
				}
				else{
					$full_url = $set_url.'select2/select2.full.min.js'.$rand;
				}
			}
			elseif ($com == 'css') {
				$full_url = $set_url.'select2/select2.min.css'.$rand;
			}
		}
		elseif ($plugin == 'slimscroll') {
			if ($com == 'js') {
				$full_url = $set_url.'slimScroll/jquery.slimscroll.min.js'.$rand;
			}
		}
		elseif ($plugin == 'sweetalert2') {
			if ($com == 'js') {
				$full_url = $set_url.'sweetalert2/sweetalert2.min.js'.$rand;
			}
			elseif ($com == 'css') {
				$full_url = $set_url.'sweetalert2/sweetalert2.min.css'.$rand;
			}
		}
		elseif ($plugin == 'timepicker') {
			if ($com == 'js') {
				$full_url = $set_url.'timepicker/js/bootstrap-timepicker.min.js'.$rand;
			}
			elseif ($com == 'css') {
				$full_url = $set_url.'timepicker/css/bootstrap-timepicker.min.css'.$rand;
			}
		}
		elseif ($plugin == 'sortable-master') {
			if ($com == 'js') {
				$full_url = $set_url.'sortable-master/Sortable.min.js'.$rand;
			}
		}
		elseif ($plugin == 'jquery-hashchange') {
			if ($com == 'js') {
				$full_url = $set_url.'jQuery-Hashchange/jquery.ba-bbq.min.js'.$rand;
			}
		}
		return $full_url;
	}

	function get_plugin_url($dir_file,$r_con=FALSE){
		global $Config;
		$full_url = $Config->_site_url.$Config->_plugin_path.$dir_file;
		if (isset($_SESSION['n_val']) && $r_con == 'nC') {
			return $full_url.'?nC='.@$_SESSION['n_val'];
		}
		elseif ($r_con == TRUE) {
			return $full_url.'?nC='.rand_val();
		}
		else{
			return $full_url;
		}
	}

	function get_real_path($path){
		global $Config;
		return str_replace('/','\\',$Config->_document_root.$path);
	}

	function get_templete_part($view){
		$_this =& get_instance();
		return $_this->site->view($view);
	}

	function set_url($sub=NULL){
		$_this =& get_instance();
		return site_url('admin/'.$sub);
	}

	function active_page_print($page,$class){
		$_this =& get_instance();
		if (!$_this->uri->segment(2) && $_this->site->side == 'backend') {
			if ($page == 'admin') {
				return $class;
			}
		}
		elseif ($_this->site->side == 'backend' && $page == $_this->uri->segment(3)) {
			return $class;
		}
		elseif ($_this->site->side == 'backend' && $page == $_this->uri->segment(2)) {
			return $class;
		}
		elseif ($_this->site->side == 'frontend' && $page !='' && $page == $_this->uri->segment(2)) {
			return $class;
		}
		elseif ($_this->site->side == 'frontend' && $page == $_this->uri->segment(1)) {
			return $class;
		}
		elseif ($_this->site->side == 'frontend' && !$_this->uri->segment(1)) {
			if ($page == '') {
				return $class;
			}
		}
	}

	function web_detail($str){
		global $Config;
		return $Config->$str;
	}

	function title(){
		$_this =& get_instance();
		global $Config;
		$array_backend_page = array(
			'login'                   => 'Login',
			'admin'                   => 'Dashboard',
			'dashboard'               => 'Dashboard',
			'data_master'             => 'Data Master',
			'data_identitas_pt'       => 'Data Identitas Perguruan Tinggi',
			'data_fakultas_pstudi'    => 'Data Fakultas dan Program Studi',
			'data_thn_akademik'       => 'Data Tahun Akademik',
			'data_angkatan'           => 'Data Tahun Angkatan Mahasiswa',
			'data_kelas'              => 'Data Kelas',
			'data_pengguna'           => 'Data Pengguna',
			'data_pengguna_mahasiswa' => 'Data Pengguna Mahasiswa',
			'data_pengguna_ptk'       => 'Data Pengguna Tenaga Pendidik',
			'data_pengunjung'         => 'Data Pengunjung',
			'data_akademik'           => 'Data Akademik',
			'data_mahasiswa'          => 'Data Mahasiswa',
			'data_ptk'                => 'Data Tenaga Pendidik',
			'data_mata_kuliah'        => 'Data Mata Kuliah',
			'data_jadwal_kuliah'      => 'Data Jadwal Kuliah dan Data Kelas',
			'data_nilai_mhs'          => 'Data Nilai Mahasiswa',
			'data_alumni_do'          => 'Data Alumni & Mahasiswa Drop Out',
			'data_mhs'                => 'Data Mahasiswa',
			'data_jadwal'             => 'Jadwal Kuliah',
			'profil_pt'               => 'Identitas Perguruan Tinggi',
			'data_tenaga_pendidik'    => 'Data Tenaga Pendidik',
			'jadwal_mengajar'         => 'Jadwal Mengajar',
			'nilai_mhs'               => 'Nilai Mahasiswa',
			'print_nilai'             => 'Print Nilai Mahasiswa',
			'pengolahan_database'     => 'Pengolahan Database',
			'pengaturan'              => 'Pengaturan',
			'about'                   => 'Tentang',
			);
		if (!$_this->uri->segment(3)) {
			if ($_this->uri->segment(2)) {
				if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(2)].' | '.$Config->_web_name;
				}
				elseif ($_this->site->side == 'frontend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(2)].' | '.$Config->_web_name;
				}
			}
			elseif(!$_this->uri->segment(2)){
				if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(1), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(1)].' | '.$Config->_web_name;
				}
				if ($_this->site->side =='frontend' && (array_key_exists($_this->uri->segment(1), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(1)].' | '.$Config->_web_name;
				}
				elseif(!$_this->uri->segment(1)){
					return $Config->_web_name;
				}
			}
		}
		elseif($_this->uri->segment(3)){
			if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(3), $array_backend_page))) {
				return $array_backend_page[$_this->uri->segment(3)].' | '.$Config->_web_name;
			}
		}
	}

	function content_header(){
		$_this =& get_instance();
		global $Config;
		$array_backend_page = array(
			'admin'                   => 'Dashboard',
			'data_master'             => 'Data Master',
			'data_identitas_pt'       => 'Data Identitas Perguruan Tinggi',
			'data_fakultas_pstudi'    => 'Data Fakultas dan Program Studi',
			'data_thn_akademik'       => 'Data Tahun Akademik',
			'data_angkatan'           => 'Data Tahun Angkatan',
			'data_kelas'              => 'Data Kelas',
			'data_pengguna'           => 'Data Pengguna',
			'data_pengguna_mahasiswa' => 'Data Pengguna Mahasiswa',
			'data_pengguna_ptk'       => 'Data Pengguna Tenaga Pendidik',
			'data_pengunjung'         => 'Data Pengunjung',
			'data_akademik'           => 'Data Akademik',
			'data_mahasiswa'          => 'Data Mahasiswa',
			'data_ptk'                => 'Data Tenaga Pendidik',
			'data_mata_kuliah'        => 'Data Mata Kuliah',
			'data_jadwal_kuliah'      => 'Data Jadwal Kuliah dan Data Kelas',
			'data_nilai_mhs'          => 'Data Nilai Mahasiswa',
			'data_alumni_do'          => 'Data Alumni & Mahasiswa Drop Out',
			'data_mhs'                => 'Data Mahasiswa',
			'data_jadwal'             => 'Jadwal Kuliah',
			'profil_pt'               => 'Identitas Perguruan Tinggi',
			'data_tenaga_pendidik'    => 'Data Tenaga Pendidik',
			'jadwal_mengajar'         => 'Jadwal Mengajar',
			'nilai_mhs'               => 'Nilai Mahasiswa',
			'pengolahan_database'     => 'Pengolahan Database',
			'pengaturan'              => 'Pengaturan',
			'about'                   => 'Tentang',
			);
		if (!$_this->uri->segment(3)) {
			if ($_this->uri->segment(2)) {
				if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(2)];
				}
				elseif ($_this->site->side =='frontend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(2)];
				}
			}
			elseif(!$_this->uri->segment(2)){
				if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(1), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(1)];
				}
				elseif ($_this->site->side =='frontend' && (array_key_exists($_this->uri->segment(1), $array_backend_page))) {
					return $array_backend_page[$_this->uri->segment(1)];
				}
				elseif(!$_this->uri->segment(1)){
					return 'Dashboard';
				}
			}
		}
		elseif($_this->uri->segment(3)){
			if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(3), $array_backend_page))) {
				return $array_backend_page[$_this->uri->segment(3)];
			}
		}
	}

	function content_path(){
		$_this =& get_instance();
		global $Config;
		$array_backend_page = array(
			'admin'                   => 'Dashboard',
			'dashboard'               => 'Dashboard',
			'data_master'             => 'Data Master',
			'data_identitas_pt'       => 'Data Identitas Perguruan Tinggi',
			'data_fakultas_pstudi'    => 'Data Fakultas dan Program Studi',
			'data_thn_akademik'       => 'Data Tahun Akademik',
			'data_angkatan'           => 'Data Tahun Angkatan',
			'data_kelas'              => 'Data Kelas',
			'data_pengguna'           => 'Data Pengguna',
			'data_pengguna_mahasiswa' => 'Data Pengguna Mahasiswa',
			'data_pengguna_ptk'       => 'Data Pengguna Tenaga Pendidik',
			'data_pengunjung'         => 'Data Pengunjung <sup class="text-aqua">BETA</sup>',
			'data_akademik'           => 'Data Akademik',
			'data_mahasiswa'          => 'Data Mahasiswa',
			'data_ptk'                => 'Data Tenaga Pendidik',
			'data_mata_kuliah'        => 'Data Mata Kuliah',
			'data_jadwal_kuliah'      => 'Data Jadwal Kuliah dan Data Kelas',
			'data_nilai_mhs'          => 'Data Nilai Mahasiswa',
			'data_alumni_do'          => 'Data Alumni & Mahasiswa Drop Out',
			'data_mhs'                => 'Data Mahasiswa',
			'data_jadwal'             => 'Jadwal Kuliah',
			'profil_pt'               => 'Identitas Perguruan Tinggi',
			'beranda_mhs'             => 'Beranda Mahasiswa',
			'beranda_ptk'             => 'Beranda Tenaga Pendidik',
			'data_tenaga_pendidik'    => 'Data Tenaga Pendidik',
			'jadwal_mengajar'         => 'Jadwal Mengajar',
			'nilai_mhs'               => 'Nilai Mahasiswa',
			'pengolahan_database'     => 'Pengolahan Database <sup class="text-aqua">BETA</sup>',
			'pengaturan'              => 'Pengaturan <sup class="text-aqua">BETA</sup>',
			'about'                   => 'Tentang',
			);
		$array_icon_path = array(
			'admin'               => '<i class="fa fa-dashboard"></i>',
			'dashboard'           => '<i class="fa fa-dashboard"></i>',
			'data_master'         => '<i class="fa fa-archive"></i>',
			'data_pengguna'       => '<i class="fa fa-users"></i>',
			'data_akademik'       => '<i class="fa fa-list-alt"></i>',
			'profil_pt'           => '<i class="fa fa-university"></i>',
			'beranda_mhs'         => '<i class="fa fa-list-alt"></i>',
			'beranda_ptk'         => '<i class="fa fa-list-alt"></i>',
			'pengolahan_database' => '<i class="fa fa-database"></i>',
			'pengaturan'          => '<i class="fa fa-gears"></i>',
			'about'               => '<i class="fa fa-exclamation-circle"></i>',
			);
		$array_color_path = array(
			'admin'               => 'text-aqua',
			'dashboard'           => 'text-aqua',
			'data_master'         => 'text-red',
			'data_pengguna'       => 'text-green',
			'data_akademik'       => 'text-yellow',
			'beranda_mhs'         => 'text-yellow',
			'beranda_ptk'         => 'text-yellow',
			'profil_pt'           => 'text-red',
			'pengolahan_database' => 'text-muted',
			'pengaturan'          => 'text-muted',
			'about'               => '',
			);
		if (!$_this->uri->segment(3)) {
			if ($_this->uri->segment(2)) {
				if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
					$content[] = array(
						'link' => current_url(),
						'color' => $array_color_path[$_this->uri->segment(2)],
						'icon' => $array_icon_path[$_this->uri->segment(2)],
						'title' => $array_backend_page[$_this->uri->segment(2)]
					);
					return $content;
				}
				elseif ($_this->site->side =='frontend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
					$content =
					'<li class="active"><a href="'.current_url().'" class="'.$array_color_path[$_this->uri->segment(1)].'">'.$array_icon_path[$_this->uri->segment(1)].$array_backend_page[$_this->uri->segment(1)].'</a></li>'.
					'<li class="active"><a href="'.current_url().'" style="color:#8aa4af;"><i class="fa fa-circle-o"></i>'.$array_backend_page[$_this->uri->segment(2)].'</a></li>';
					return $content;
				}
			}
			elseif ($_this->uri->segment(1)) {
				if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(1), $array_backend_page))) {
					$content[] = array(
						'link' => current_url(),
						'color' => $array_color_path[$_this->uri->segment(1)],
						'icon' => $array_icon_path[$_this->uri->segment(1)],
						'title' => $array_backend_page[$_this->uri->segment(1)]
					);
					return $content;
				}
				elseif ($_this->site->side =='frontend' && (array_key_exists($_this->uri->segment(1), $array_backend_page))) {
					$content =
					'<li class="active"><a href="'.current_url().'" class="'.$array_color_path[$_this->uri->segment(1)].'">'.$array_icon_path[$_this->uri->segment(1)].$array_backend_page[$_this->uri->segment(1)].'</a></li>';
					return $content;
				}
			}
			elseif(!$_this->uri->segment(1)){
				$content = '<li class="active"><a href="'.current_url().'" class="text-aqua"><i class="fa fa-dashboard"></i>Dashboard</a></li>';
				return $content;
			}
		}
		elseif($_this->uri->segment(3)){
			if ($_this->site->side =='backend' && (array_key_exists($_this->uri->segment(3), $array_backend_page))) {
				$content[] = array(
					'link' => current_url(),
					'color' => $array_color_path[$_this->uri->segment(2)],
					'icon' => $array_icon_path[$_this->uri->segment(2)],
					'title' => $array_backend_page[$_this->uri->segment(2)]
				);
				$content[] = array(
					'link' => current_url(),
					'color' => '',
					'icon' => '<i class="fa fa-circle-o"></i>',
					'title' => $array_backend_page[$_this->uri->segment(3)],
					'style' => 'color:#8aa4af'
				);
				return $content;
			}
		}
	}

?>
