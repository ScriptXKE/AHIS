<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class contains a series of disease management methods
 * 
 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 25 July 2013
 * 
 */

class Disease_model extends CI_Model{

	/**
	 * Constructor method
	 */
	public function __construct() {

		parent::__construct();

	}	// END: __construct()


	//This function returns all of the disease records in our database
	public function get_records()
	{
		$query = $this->db->get('diseases');
		return $query->result();
	}

	/*
	Gets information about a particular disease
	*/
	function get_detail($disease_ID)
	{
		$query = $this->db->get_where('diseases', array('ID' => $disease_ID));		
		return $query->result();
	}

	//This function allows us to add diseases to the disease table

	public function add($diseasedata) //ensure that this function will accept the data
	{
		$this->db->insert('diseases', $diseasedata); //pass the tablename and the data passed to the function
		return;
	}

	public function update($diseasedata)  //ensure that this function will accept the data
	{
		//$this->db->where('ID', $this->uri->segment(3));
		$query = $this->db->update_where('ID', array('ID' => $this->uri->segment(3)));
		$query = $this->db->update('diseases', $diseasedata);
		return;
	}

	public function delete()
	{
		$this->db->where('ID', $this->uri->segment(3));
		$this->db->delete('diseases');
	}

}