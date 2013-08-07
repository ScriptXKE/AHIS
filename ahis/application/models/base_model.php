<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This model contains generic methods that are not necessarily module / functionality
 * specific but are applicable throughout the AHIS
 *
 * This model is autoloaded in the ./application/config/autoload.php file
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 * 
 */

class Base_model extends CI_Model {

	/**
	 * Declare a series of private variables that hold table names
	 * This is a good practice because should the table names change, we only have to change
	 * them in one spot in the entire model; otherwise, there will be HELL to pay :)
	 */
	private $tbl_towns = 'towns';	// This table contains a list of towns
	private $tbl_animals = 'animals';	// This table contains a list of animals
	private $tbl_sms = 'sms';	// This table contains SMSes sent by people who own animals
	private $tbl_incident_sms = 'incident_sms';	// This table contains incident SMSes
	private $tbl_symptoms = 'symptoms';	// This table contains all symptoms

	/**
	 * Constructor method
	 */
	public function __construct() {

		/**
		 * Constructor the class ... right now it does nothing
		 */
		parent::__construct();

	}


	/**
	 * This method retrieves a list of all the towns in the database
	 * It accepts a parameter to filter the towns based on a list of districts
	 * @author ScriptX Consulting Ltd
	 */
	public function towns_list($district_id = FALSE) {

		// Initialize the district IDs to an empty array
		$district_id_array = array();

		// Check for district ID
		if ($district_id) {
			// create an array of the district IDs
			// the assumption is that the district IDs are comma separated
			$district_id_array = explode(',', $district_id);
			// Now that we have the district IDs ... let's run the query
			$this->db->where_in('district_id', $district_id_array);
		}

		// Set the sort order
		$this->db->order_by('name', 'asc');

		// Run the query
		$query = $this->db->get($this->tbl_towns);

		// return the query so that whoever called it can use it anyway they like
		return $query;

	}


	/**
	 * This method gets a town's name if given an ID
	 */
	public function get_town_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->tbl_towns);
		if ($query->num_rows() > 0) {
			$town = $query->row();
			return $town->name;
		} else {
			return 'Not Found';
		}
	}


	/**
	 * This method retrieves a list of all the animals in the database
	 * @author ScriptX Consulting Ltd
	 */
	public function animals_list($animal_id = FALSE) {

		// Check for animal ID
		if ($animal_id) {
			// filter by the specified animal ID
			$this->db->where_in('id', $animal_id);
		}

		// Set the sort order
		$this->db->order_by('name', 'asc');

		// Run the query
		$query = $this->db->get($this->tbl_animals);

		// return the query so that whoever called it can use it anyway they like
		return $query;

	}


	/**
	 * This method gets an animal's name if given an ID
	 */
	public function get_animal_by_id($id) {

		$this->db->where('id', $id);
		$query = $this->db->get($this->tbl_animals);
		if ($query->num_rows() > 0) {
			$animal = $query->row();
			return $animal->name;
		} else {
			return 'Not Found';
		}

	}	// END: get_animal_by_id()


	/**
	 * This method gets the listing of all symptoms in the database
	 */
	public function symptoms_listing() {

		// prepare the query and ensure you sort alphabetically
		$this->db->order_by('description', 'asc');

		// run the query
		$query = $this->db->get($this->tbl_symptoms);

		// return the database object
		return $query;

	}	// END: symptoms_listing()


	/**
	 * Clears the cache to remove any traces of a previous session
	 *
	 * This method clears the cache completely to avoid instances where you've logged out but when you go back
	 * in the browser, the previously loaded page (one that you've logged out already) is loaded as if you haven't
	 * logged out yet; this method totally clears the cache and enables redirecting to the login page
	 * 
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 * 
	 */
    public function clear_cache()
    {

    	/**
    	 * Run the code to completely clear the cache
    	 */
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

    }	// END: clear_cache()
	


}


/* End of file base_model.php */
/* Location: ./application/models/base_model.php */
