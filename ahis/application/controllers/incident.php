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

		// Load the required models
		$this->load->model(array('incident_model','base_model'));

		// Load the required libraries
		$this->load->library('form_validation');

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
				'incident_listing' => $this->incident_model->list_all()
			);

		// Load the view
		$this->load->view('main_template', $data);

	}


	/**
	 * Create a new incident's basic details
	 * This method is used to load the form for creating a new incident together with any other
	 * supporting information that is retrieved from the 'incident_model' model
	 */
	public function basic_details() {

		// initialize the message variable to nothing
		$msg = '';

		// clear the incident_id value from the session
		$this->session->set_userdata('incident_id', '');

		// Prepare the data for the page
		$data = array(
				'title' => 'Incident: Basic Details',
				'town_listing' => $this->base_model->towns_list(),
				'animal_listing' => $this->base_model->animals_list(),
				'sms_listing' => $this->incident_model->sms_listing(TRUE),
				'view' => 'incident/basic_details',
				'msg' => $msg
			);

		// Check if the form has been posted
		if ($_POST) {

			// something was posted
			// call the method to process an incident
			$status = $this->incident_model->save_basic_details();

			// Check for the value of status
			if (!$status['success']) {

				// The save operation failed
				// Update the message variable
				$data['msg'] = array(
					'type' => 'error', 
					'message' => $status['message']
				);

				// Load the view
				// $this->load->view('main_template', $data);

			} else {

				// The save was successful
				// Update the session variable's "INCIDENT_ID" with the returned incident ID
				redirect(base_url() . 'incident/basic_details_summary/' . $this->session->userdata('incident_id'), 'refresh');

			}	// Checking if the save was successful

		}	// Checking if the form with the incident details was submitted

		// Load the view
		$this->load->view('main_template', $data);

	}	// END: basic_details()



	/**
	 * This method loads the incident basic details summary page
	 */
	public function basic_details_summary($incident_id) {

		// Initialize some mandatory variables
		$msg = '';

		// Check for the ID ... if it's missing, redirect to the page for adding an incident
		if (!isset($incident_id) || !is_numeric($incident_id) || $incident_id <= 0) {

			// Invalid incident id ... redirect to page for adding incident
			redirect(base_url() . 'incident/basic_details', 'refresh');

		}	// Checking for valid incident id

		// Update session variable with incident id
		$this->session->set_userdata('incident_id', $incident_id);

		// If we reach here, we have a valid incident id
		// Check if associated details exist
		$incident_object = $this->incident_model->get_by_id($incident_id);
		if ($incident_object->num_rows() <= 0) {

			// missing incident details ... redirect to page for adding incident
			redirect(base_url() . 'incident/basic_details', 'refresh');

		}

		// If we get here, the incident id is valid and has associated details in the database
		// extract the record returned with incident details
		$incident_details_record = $incident_object->row();

		// Create the array of page data
		$data = array(
				'title' => 'Incident: Basic Details',
				'sms_listing' => $this->incident_model->incident_sms_listing($incident_id),
				'incident_details' => $incident_details_record,
				'incident_comments_listing' => $this->incident_model->incident_comments_listing($incident_id),
				'view' => 'incident/basic_details_summary',
				'msg' => $msg
			);

		// Load the view
		$this->load->view('main_template', $data);

	}	// End: basic_details_summary()


	/**
	 * This method is responsible for saving comments associated with an incident
	 */
	public function comments() {

		// Check for a $_POST variable
		if ($_POST) {

			// call the model method for processing comments
			$this->incident_model->save_incident_comments();

		}	// Checking if a form was submitted

		// Redirect back to the basic details summary page
		redirect(base_url() . 'incident/basic_details_summary/' . $this->session->userdata('incident_id'), 'refresh');

	}	// END: comments()


	/**
	 * This method manages the symptoms page for incidents
	 */
	public function symptoms($incident_id = NULL) {

		// Check for valid incident ID
		$incident_id = $this->session->userdata('incident_id');
		$this->check_incident_id($incident_id, 'You cannot add symptoms before adding basic details.');

		// Check if anything was posted
		if ($_POST) {

			// A form with the selected symptoms was submited over
			$this->incident_model->save_incident_symptoms();

			// redirect to the symptoms page
			redirect(base_url() . 'incident/symptoms/' . $incident_id, 'refresh');

		}	// Checking if a form with symptoms was submitted

		// Load the symptoms page
		$data = array(
				'view' => 'incident/symptoms',
				'symptoms_listing' => $this->base_model->symptoms_listing(),
				'array_symptoms_ids' => $this->incident_model->incident_symptoms_ids($incident_id),
				'symptoms_comments_listing' => $this->incident_model->symptoms_comments_listing($incident_id)
			);

		// Load the view
		$this->load->view('main_template', $data);

	}	// END: symptoms()


	/**
	 * This method saves all comments related to the incident's symptoms
	 */
	public function symptoms_comments() {

		// check for the posting of the form with the comment
		if ($_POST) {

			// comment submitted
			if (trim($this->input->post('symptoms_comment')) != '') {

				// save the comment
				$this->incident_model->save_symptoms_comment();

			}	// checking if any comment was posted

		}	// checking if a form was posted

		// redirect to the symptoms page
		redirect(base_url() . 'incident/symptoms/' . $this->session->userdata('incident_id'), 'refresh');

	}	// END: symptoms_comments()


	/**
	 * This method manages the surveillance page for incidents
	 */
	public function surveillance($incident_id = NULL) {

		// Check for valid incident ID
		$incident_id = $this->session->userdata('incident_id');
		$this->check_incident_id($incident_id, 'You cannot post Surveillance Requests before adding basic details.');

		// Load the surveillance page
		$data = array(
				'view' => 'incident/surveillance',
				'msg' => 'This page will process incident surveillance ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}	// END: surveillance()


	/**
	 * This method manages the laboratory page for incidents
	 */
	public function laboratory($incident_id = NULL) {

		// Check for valid incident ID
		$incident_id = $this->session->userdata('incident_id');
		$this->check_incident_id($incident_id, 'You cannot post laboratory information before adding basic details.');

		// Load the laboratory page
		$data = array(
				'view' => 'incident/laboratory',
				'msg' => 'This page will process incident laboratory ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}	// END: laboratory()


	/**
	 * This method manages the prognosis page for incidents
	 */
	public function prognosis($incident_id = NULL) {

		// Check for valid incident ID
		$incident_id = $this->session->userdata('incident_id');
		$this->check_incident_id($incident_id, 'You cannot post the incident\'s prognosis before adding basic details.');

		// Load the prognosis page
		$data = array(
				'view' => 'incident/prognosis',
				'msg' => 'This page will process incident prognosis ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}	// END: prognosis()


	/**
	 * This method manages the summary page for incidents
	 */
	public function summary($incident_id = NULL) {

		// Check for valid incident ID
		$incident_id = $this->session->userdata('incident_id');
		$this->check_incident_id($incident_id, 'You cannot view the incident summary before adding basic details.');

		// Load the summary page
		$data = array(
				'view' => 'incident/summary',
				'msg' => 'This page will process incident summary ...'
			);

		// Load the view
		$this->load->view('main_template', $data);

	}	// END: summary()


	/**
	 * This method checks for the incident ID ... if there is none, 
	 * it redirects to the page for adding a new incident
	 */
	public function check_incident_id($incident_id = NULL, $message) {

		// Check if the incident ID is available
		if ($incident_id == NULL || !is_numeric($incident_id) || $incident_id <= 0) {

			// Do the flash data
			$this->session->set_flashdata('message', $message);

			// Redirect to page for adding basic details for an incident
			redirect(base_url() . 'incident/basic_details', 'refresh');

			// 

		}	// checking for valid incident ID

	}	// check_incident_id()


}	// END: incident()


/* End of file incident.php */
/* Location: ./application/controllers/incident.php */
