<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_form_validation extends CI_Form_validation{
	
	public function __construct($rules = array()){
		parent::__construct($rules);
		//Do your magic here
	}

	function error_array(){
		if (count($this->_error_array)==0) {
			return FALSE;
		}
		else{
			return $this->_error_array;
		}
	}

}

?>