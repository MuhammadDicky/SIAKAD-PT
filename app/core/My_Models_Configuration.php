<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Models_Configuration extends CI_Model{
	protected $_table_name;
	protected $_order_by;
	protected $_order_by_type;
	protected $_primary_filter = 'intval';
	protected $_primary_key;
	protected $_type;
	public $rules;

	function __construct(){
		parent:: __construct();
	}

	public function insert($data,$batch=FALSE){
		$id = NULL;
		if ($batch == TRUE) {
			$id = $this->db->insert_batch('{PRE}'.$this->_table_name,$data);			
		}
		else{			
			$this->db->insert('{PRE}'.$this->_table_name,$data);
			$id = $this->db->insert_id();
		}		
		return $id;
	}

	public function update($data,$where,$batch=FALSE,$where_not=NULL,$not_val=NULL){
		if ($where_not != NULL) {
			$this->db->where_not_in($where_not,$not_val);
		}
		if ($batch == TRUE) {
			$update = $this->db->update_batch('{PRE}'.$this->_table_name,$data,$where);
		}
		else{
			$this->db->set($data);
			$this->db->where($where);
			$update = $this->db->update('{PRE}'.$this->_table_name);
		}

		$affected_rows = $this->db->affected_rows();
		if ($affected_rows > 0) {
			return $affected_rows;
		}
		else{
			return $update;
		}
	}
	
	public function get($id=NULL,$single=NULL,$order=NULL,$sum=NULL){
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key,$id);
			$method ='row';
		}
		elseif ($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		if ($order == NULL) {
			if ($this->_order_by_type) {
				$this->db->order_by($this->_order_by,$this->_order_by_type);			
			}
			else{
				$this->db->order_by($this->_order_by);
			}
		}
		else{
			$this->db->order_by($order);
		}

		if ($sum != NULL) {
			$this->db->select_sum($sum[0],$sum[1]);
		}

		return $this->db->get('{PRE}'.$this->_table_name)->$method();
	}

	public function get_by($where=NULL,$limit=NULL,$offset=NULL,$single=FALSE,$select=NULL,$order=NULL){
		if ($select!=NULL) {
			$this->db->select($select);
		}
		if ($where) {
			$this->db->where($where);
		}
		if (($limit) && ($offset)) {
			$this->db->limit($limit,$offset);
		}
		elseif ($limit) {
			$this->db->limit($limit);
		}

		return $this->get(NULL,$single,$order);
	}

	public function get_by_search($where=NULL,$single=FALSE,$select=NULL,$group=NULL,$order=NULL,$sum=NULL,$act=NULL){
		if ($act != NULL) {
			$this->get_dt_detail($act);
		}

		if ($select!=NULL) {
			$this->db->select($select);
		}
		if ($where) {
			$this->db->where($where);
		}
		if ($group) {
			$this->db->group_by($group);
		}

		return $this->get(NULL,$single,$order,$sum);
	}

	public function delete($id=NULL,$where=NULL){
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			if (!$id) {
				return FALSE;
			}
			$this->db->where($this->_primary_key,$id);
		}
		else{
			$this->db->where($where);
		}

		$delete = $this->db->delete('{PRE}'.$this->_table_name);
		$affected_rows = $this->db->affected_rows();
		if ($affected_rows > 0) {
			return $affected_rows;
		}
		else{
			return $delete;
		}
	}

	public function delete_by($where=NULL,$delete_m=NULL){
		if ($delete_m != NULL) {
			foreach ($delete_m as $field => $value) {
				$this->db->where_in($field, $value);
			}
		}
		if ($where != NULL) {
			$this->db->where($where);
		}
		
		$delete = $this->db->delete('{PRE}'.$this->_table_name);
		$affected_rows = $this->db->affected_rows();
		if ($affected_rows > 0) {
			return $affected_rows;
		}
		else{
			return $delete;
		}
	}

	public function count($where=NULL,$group=NULL,$act=NULL){
		if ($act != NULL) {
			$this->get_dt_detail($act);
		}

		if (!empty($this->_type)) {
			$where['post_type'] = $this->_type;
		}
		if ($where) {
			$this->db->where($where);
		}
		if ($group) {
			$this->db->group_by($group);
		}
		$this->db->from('{PRE}'.$this->_table_name);
		return $this->db->count_all_results();
	}

	protected function get_dt_detail($act){
		if ($act != NULL) {
			if (@$act[0] == NULL) {
				foreach ($act as $action => $val_act) {
					if ($action == 'sum') {
						foreach ($val_act as $field => $alias) {
							$this->db->select_sum($field,$alias);
						}
					}
					if ($action == 'where') {
						$this->db->where($val_act);
					}
					if ($action == 'or') {
						$this->db->or_where($val_act);
					}
					if ($action == 'like') {
						foreach ($val_act as $field => $value) {
							$this->db->like($field,$value);
						}
					}
					if ($action == 'or_like') {
						foreach ($val_act as $field => $value) {
							$this->db->or_like($field,$value);
						}
					}
					if ($action == 'in') {
						foreach ($val_act as $field => $value) {
							$this->db->where_in($field, $value);
						}
					}
					if ($action == 'or_in') {
						foreach ($val_act as $field => $value) {
							$this->db->or_where_in($field, $value);
						}
					}
					if ($action == 'not_in') {
						foreach ($val_act as $field => $value) {
							$this->db->where_not_in($field, $value);
						}
					}
					if ($action == 'or_not_in') {
						foreach ($val_act as $field => $value) {
							$this->db->or_where_not_in($field, $value);
						}
					}
					if ($action == 'limit') {
						$this->db->limit($val_act);
					}
					if ($action == 'offset') {
						$this->db->limit($val_act[0],$val_act[1]);
					}
				}
			}
			else{
				foreach ($act as $act_no) {
					foreach ($act_no as $action => $val_act) {
						if ($action == 'sum') {
							foreach ($val_act as $field => $alias) {
								$this->db->select_sum($field,$alias);
							}
						}
						if ($action == 'where') {
							$this->db->where($val_act);
						}
						if ($action == 'or') {
							$this->db->or_where($val_act);
						}
						if ($action == 'like') {
							foreach ($val_act as $field => $value) {
								$this->db->like($field,$value);
							}
						}
						if ($action == 'or_like') {
							foreach ($val_act as $field => $value) {
								$this->db->or_like($field,$value);
							}
						}
						if ($action == 'in') {
							foreach ($val_act as $field => $value) {
								$this->db->where_in($field, $value);
							}
						}
						if ($action == 'or_in') {
							foreach ($val_act as $field => $value) {
								$this->db->or_where_in($field, $value);
							}
						}
						if ($action == 'not_in') {
							foreach ($val_act as $field => $value) {
								$this->db->where_not_in($field, $value);
							}
						}
						if ($action == 'or_not_in') {
							foreach ($val_act as $field => $value) {
								$this->db->or_where_not_in($field, $value);
							}
						}
						if ($action == 'limit') {
							$this->db->limit($val_act);
						}
						if ($action == 'offset') {
							$this->db->limit($val_act[0],$val_act[1]);
						}
					}
				}

				/*foreach ($act as $action) {
					if (isset($action['sum'])) {
						foreach ($action['sum'] as $field => $alias) {
							$this->db->select_sum($field,$alias);
						}
					}
					if (isset($action['where'])) {
						$this->db->where($action['where']);
					}
					if (isset($action['or'])) {
						$this->db->or_where($action['or']);
					}
					if (isset($action['like'])) {
						foreach ($action['like'] as $field => $value) {
							$this->db->like($field,$value);
						}
					}
					if (isset($action['or_like'])) {
						foreach ($action['or_like'] as $field => $value) {
							$this->db->or_like($field,$value);
						}
					}
					if (isset($action['in'])) {
						foreach ($action['in'] as $field => $value) {
							$this->db->where_in($field, $value);
						}
					}
					if (isset($action['or_in'])) {
						foreach ($action['or_in'] as $field => $value) {
							$this->db->or_where_in($field, $value);
						}
					}
					if (isset($action['not_in'])) {
						foreach ($action['not_in'] as $field => $value) {
							$this->db->where_not_in($field, $value);
						}
					}
					if (isset($action['or_not_in'])) {
						foreach ($action['or_not_in'] as $field => $value) {
							$this->db->or_where_not_in($field, $value);
						}
					}
				}*/
			}
		}
	}

}

?>