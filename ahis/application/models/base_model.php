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
	 */
	private $tbl_towns = 'towns';
	private $tbl_animals = 'animals';


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