<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incident extends CI_Controller 
{


	/**
	 * Constructor method for this class
	 * @author ScriptX Consulting Ltd
	 */
	public function __construct() {

		// Run parent constructor
		parent::__construct();

		// Check if the user is logged in because all incident operations require login
		$this->auth_model->is_logged_in();

		// Load the incident model
		$this->load->model(array('incident_model','base_model'));

	}	// END: __construct()


	/**
	 * Default method ... loads the list of incidents
	 * This is called by default if not other parameters are provided after 'incident' in the url
	 * @author ScriptX Consulting Ltd
	 */
	public function index() {

		// Get the list of incidents from the database
		$incidents = $this->incident_model->list_all();

		// Prepare the data for the page
		$data = array(
				'title' => 'Listing of Incidents',
				'view' => 'incident/list',
				'msg' => 'Default method message is passed here ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}


	/**
	 * This method lists all incidents in the database
	 * @author ScriptX Consulting Ltd
	 */
	public function listing() {

		// Get the list of incidents from the database
		$incidents = $this->incident_model->list_all();

		// Prepare the data for the page
		$data = array(
				'title' => 'Listing of Incidents',
				'view' => 'incident/list',
				'msg' => 'Pass my incident listing message here ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}


	/**
	 * Create a new incident
	 * This method is used to load the form for creating a new incident together with any other
	 * supporting information that is retrieved from the 'incident_model' model
	 */
	public function create() {

		// Check if the form has been posted
		if ($_POST) {
			// something was posted
			// call the method to process an incident
			$result = $this->incident_model->process_incident();
		}

		// Prepare the data for the page
		$data = array(
				'title' => 'Incident: Basic Details',
				'town_listing' => $this->base_model->towns_list(),
				'animal_listing' => $this->base_model->animals_list(),
				'view' => 'incident/basic_details',
				'msg' => 'I am creating a new incident ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}


}