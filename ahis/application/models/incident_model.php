<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains a series of user authentication related methods
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 * 
 */
class Incident_model extends CI_Model {
	
	private $tbl_incident= 'incident';
	
        /**
	 * Constructor method
	 */
	function __construct(){
		parent::__construct();
	} // END: __construct()
	
        function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_incident);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_incident);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_incident, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_incident);
	}
	
	function save($incident){
		$this->db->insert($this->tbl_incident, $incident);
		return $this->db->insert_id();
	}
	
	function update($id, $incident){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_incident, $incident);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_incident);
	}
}
?>