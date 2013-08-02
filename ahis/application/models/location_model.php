<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class contains a series of district management related methods
 * 
 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 27 July 2013
 * 
 */

class Location_model extends CI_Model{

	/**
	 * Constructor method
	 */
	public function __construct() {

		parent::__construct();

	}	// END: __construct()


	//This function returns all of the district records in our database
	public function listlocations()
	{
		$query = $this->db->get('district');
        return $query->result();
	}


	//This function returns all of the district records in our database for the dropdown
	public function dropdownlocations()
	{
		$query = $this->db->get('district');

		foreach($query->result_array() as $row){
            $data[$row['id']]=$row['name'];
        }
        return $data;
	}

	/*
	Gets information about a particular animal
	*/
	public function get_location_detail($location_ID)
	{
		$query = $this->db->get_where('district', array('ID' => $location_ID));		
		return $query->result();
	}


	/*
	Gets information about a particular animal
	*/
	public function get_town_detail($location)
	{
		$query = $this->db->get_where('town', array('ID' => $location));		
		return $query->result();
	}

	//This function allows us to add locations to the district table

	public function add($locationdata) //ensure that this function will accept the data
	{
		$this->db->insert('town', $locationdata); //pass the tablename and the data passed to the function
		return;
	}

	public function edit($locationdata)  //ensure that this function will accept the data
	{
		//var_dump($locationdata);
		//echo "wooooooooooooooooooo";
		$query = $this->db->where('id', $this->input->post('id'));
		$query = $this->db->update('town', $locationdata);
		return $query;
	}

	public function delete()
	{
		$this->db->where('ID', $this->uri->segment(3));
		$this->db->delete('town');
	}

	function count(){
		return $this->db->count_all('district');
	}

}