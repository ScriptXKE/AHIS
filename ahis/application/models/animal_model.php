<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class contains a series of user authentication related methods
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 * 
 */

class Animal_model extends CI_Model{

	/**
	 * Constructor method
	 */
	public function __construct() {

		parent::__construct();

	}	// END: __construct()


	//This function returns all of the district records in our database
	public function listanimals()
	{
		$query = $this->db->get('animals');
        return $query->result();
	}

	/*
	Gets information about a particular animal
	*/
	public function get_animal_detail($animal_ID)
	{
		$query = $this->db->get_where('animals', array('ID' => $animal_ID));		
		return $query->result();
	}

	//This function allows us to add locations to the district table

	public function add($animaldata) //ensure that this function will accept the data
	{
		$this->db->insert('animals', $animaldata); //pass the tablename and the data passed to the function
		return;
	}

	public function edit($animaldata)  //ensure that this function will accept the data
	{
		$query = $this->db->where('id', $this->input->post('id'));
		$query = $this->db->update('animals', $animaldata);
		return $query;
	}

	public function delete()
	{
		$this->db->where('ID', $this->uri->segment(3));
		$this->db->delete('animals');
	}

	function count(){
		return $this->db->count_all('animals');
	}

}