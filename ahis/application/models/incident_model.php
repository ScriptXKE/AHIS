<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains a series of user authentication related methods
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 * 
 */
class Incident_model extends CI_Model {
	
	private $tbl_incident = 'incidents';	// This table stores details about incidents
	private $tbl_sms = 'sms';	// This table stores a list of all SMSes in the system
	private $tbl_incident_sms = 'incident_sms';	// This table contains a list of all SMSes associated with an incident
	private $tbl_incident_comments = 'incident_comments';	// This table contains all incident comments
	private $tbl_users = 'users';	// This table contains a list of all users
	private $tbl_persons = 'persons';	// This table contains a list of all persons in the database
	private $tbl_view_incident_comments = 'view_incident_comments';	// A view of all the incident comments in the database
	private $tbl_view_incident_sms = 'view_incident_sms';	// This view links incident SMSes and the original SMS
	private $tbl_view_incident_laboratory_comments = 'view_incident_laboratory_comments'; // This view has laboratory comments
	private $tbl_view_incident_prognosis_comments = 'view_incident_prognosis_comments'; // This view has prognosis comments
	private $tbl_view_incident_surveillance_comments = 'view_incident_surveillance_comments'; // This view has surveillance comments
	private $tbl_view_incident_symptoms_comments = 'view_incident_symptoms_comments'; // This view has symptoms comments
	private $tbl_incident_symptoms = 'incident_symptoms';	// This table has all the incident symptoms
	private $tbl_incident_symptoms_comments = 'incident_symptoms_comments';	// This table holds an incident's symptoms' comments
	
	/**
	* Constructor method
	*/
	function __construct(){
		parent::__construct();
	} // END: __construct()
	
    
    // Get list of all incidents in the database
    public function list_all(){
		$this->db->order_by('last_update','desc');
		return $this->db->get($this->tbl_incident);
	}
	
	// Get a count of all incidents
	public function count_all(){
		return $this->db->count_all($this->tbl_incident);
	}
	
	// Get a paged list of all incidents
	public function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_incident, $limit, $offset);
	}
	
	// Get incident details by ID
	public function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_incident);
	}
	
	// Save an incident
	public function save($incident){
		$this->db->insert($this->tbl_incident, $incident);
		return $this->db->insert_id();
	}
	
	// Update an incident
	public function update($id, $incident){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_incident, $incident);
	}
	
	// Delete an incident
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_incident);
	}

	/**
	 * This method generates the menu items used in the incident page
	 * The menu items are generated and if the incident ID is available
	 * in the session variable (refer to authenticate_user() method in AUTH_MODEL model)
	 */
	public function incident_menu_items($current_menu_item = NULL) {

		// Initialize the incident ID & menu item html code
		$incident_id = $this->session->userdata('incident_id');
		$menu_items_html_code = "";

		// check if the incident_id session variable has a value
		if ($this->session->userdata('incident_id') > 0) {
			$basic_details_url = base_url() . 'incident/basic_details_summary/' . $incident_id;
		} else {
			$basic_details_url = base_url() . 'incident/basic_details/' . $incident_id;
		}

		// Simply generate the menu items and append the incident ID
		$menu_items = array(
				array(
					'menu_text' => 'Basic Details',
					'menu_link' => $basic_details_url,
					'menu_code' => 'basic_details'
					),
				array(
					'menu_text' => 'Symptoms',
					'menu_link' => base_url() . 'incident/symptoms/' . $incident_id,
					'menu_code' => 'symptoms'
					),
				array(
					'menu_text' => 'Surveillance',
					'menu_link' => base_url() . 'incident/surveillance/' . $incident_id,
					'menu_code' => 'surveillance'
					),
				array(
					'menu_text' => 'Laboratory',
					'menu_link' => base_url() . 'incident/laboratory/' . $incident_id,
					'menu_code' => 'laboratory'
					),
				array(
					'menu_text' => 'Prognosis',
					'menu_link' => base_url() . 'incident/prognosis/' . $incident_id,
					'menu_code' => 'prognosis'
					),
				array(
					'menu_text' => 'Summary',
					'menu_link' => base_url() . 'incident/summary/' . $incident_id,
					'menu_code' => 'summary'
					)
			);

		// Iterate through the array and create the menu items
		foreach ($menu_items as $menu_item) {

			// Check if the menu_code value is the same as the current_menu_item value
			// If it is, create a string that assigns the CURRENT class to the link
			$menu_class = ($menu_item['menu_code'] == $current_menu_item) ? ' class="current"' : '';

			// Get the various menu item details and use them to create the list of menus
			$menu_items_html_code .= '<li'.$menu_class.'><a href="'.$menu_item['menu_link'].'">'.$menu_item['menu_text'].'</a></li>';

		}

		// Return the menu html code
		return $menu_items_html_code;

	}	// END: incident_menu_items()

	/**
	 * This method is used to save an incident's basic details
	 */
	public function save_basic_details() {

		// check for the $_POST variable
		if ($_POST) {

			// A form has been submitted
			// Start creating the form validation configuration array
			$incident_basic_details_validation_config = array(
					array(
						'field' => 'serial_no',
						'label' => 'Incident Serial Number',
						'rules' => 'xss_clean|trim|required|unique[incidents.serial_no]'
						),
					array(
						'field' => 'description',
						'label' => 'Incident Description',
						'rules' => 'xss_clean|trim|required'
						),
					array(
						'field' => 'location_id',
						'label' => 'Incident Location',
						'rules' => 'xss_clean|trim|required|numeric|greater_than[0]'
						),
					array(
						'field' => 'animal_herd_size',
						'label' => 'Animal Herd Size',
						'rules' => 'xss_clean|trim|required|numeric|greater_than[0]'
						),
					array(
						'field' => 'num_animals_affected',
						'label' => 'Number of Infected Animals',
						'rules' => 'xss_clean|trim|required|numeric|greater_than[0]'
						),
					array(
						'field' => 'symptoms_duration',
						'label' => 'Period Symptoms Have Been Observed',
						'rules' => 'xss_clean|trim|required'
						),
					array(
						'field' => 'incident_reporter',
						'label' => 'Incident Reporter',
						'rules' => 'xss_clean|trim|required'
						),
					array(
						'field' => 'incident_reporter_phone',
						'label' => 'Incident Reporter Phone Number',
						'rules' => 'xss_clean|trim|required'
						)
				);

			// Load the validation config file
			$this->form_validation->set_rules($incident_basic_details_validation_config);

			// Set the validation error messages delimiters
			$this->form_validation->set_error_delimiters('<p class="form-validation-error">','</p>');

			// Run the validation
			if ($this->form_validation->run() == FALSE) {

				// Validation failed
				return array(
					'success' => FALSE, 
					'message' => 'There were some errors when trying to save the incident basic details. Please view them in the form below:'
				);

			} else {

				// First Validation succeeded
				// Now check for herd size validity i.e. herd size > # of animals infected
				$herd_size_valid = $this->validate_herd_size();
				if (!$herd_size_valid) {

					// herd size is not valid
					return array(
						'success' => FALSE, 
						'message' => 'The herd size cannot be less than the total number of animals infected in the herd. Please update the numbers in the form below:'
					);

				} else {

					// herd size is valid
					// go ahead and save the details
					$db_data = array(
							'serial_no' => $this->input->post('serial_no'),
							'description' => $this->input->post('description'),
							'reported_date' => date('Y-m-d'),
							'user_id' => $this->session->userdata('user_id'),
							'location_id' => $this->input->post('location_id'),
							'reporter_id' => $this->session->userdata('user_id'),
							'animal_id' => $this->input->post('animal_id'),
							'animal_herd_size' => $this->input->post('animal_herd_size'),
							'num_animals_affected' => $this->input->post('num_animals_affected'),
							'symptoms_duration' => $this->input->post('symptoms_duration'),
							'incident_reporter' => $this->input->post('incident_reporter'),
							'incident_reporter_phone' => $this->input->post('incident_reporter_phone')
						);

					// save the details
					try {

						// save the record
						$this->db->insert($this->tbl_incident, $db_data);

						// successful insert ... get the last insert id
						$last_insert_id = $this->db->insert_id();

						// now process the SMS messages
						$sms_data = $this->input->post('sms_id');
						if (isset($sms_data)) {

							// there are some SMSes associated with this incident
							$array_sms_ids = $this->input->post('sms_id');
							foreach ($array_sms_ids as $sms_id) {

								// Create the array
								// I'd wanted to do a batch insert ... but the 'recursive' like loop
								// couldn't quite come ... maybe next time
								$db_data = array(
									'incident_id' => $last_insert_id,
									'sms_id' => $sms_id
									);

								// save the sms details into the incident_sms table
								$this->db->insert($this->tbl_incident_sms, $db_data);

							}	// iterating through the selected SMSes

						}	// checking for incident SMSes

						// update the session variables
						$this->session->set_userdata('incident_id', $last_insert_id);

						// Set the flash data
						$this->session->set_flashdata('message', 'The incident details were successfully saved.');

						// redirect to the basic details summary page
						return array(
								'success' => TRUE,
								'message' => 'The incident details were successfully saved.'
							);

					} catch (Exception $e) {

						// the save query failed
						return array(
							'success' => FALSE, 
							'message' => $e->getMessage()
						);

					}	// running the query

				}	// validating herd size

			}	// running form validation

		}	// Checking for a submitted form

	}	// END: save_basic_details()


	/**
	 * This method is used to validate the basic details form values to ensure that the
	 * total number of animals infected are not more than the total number of animals
	 * in the herd
	 */
	public function validate_herd_size() {

		// Grab the two values i.e. herd size and the size that is infected
		$herd_size = $this->input->post('animal_herd_size');
		$infected_animals = $this->input->post('num_animals_affected');

		// Ensure that the herd size is greater than or equal to the # of infected animals
		if ($herd_size < $infected_animals) {

			// Validation failed ...
			// Set the error message
			$this->form_validation->set_message('num_animals_affected', 'The number of infected animals cannot be more than the herd size');

			// return false
			return FALSE;

		} else {

			// Validation succeeded
			return TRUE;

		}	// Checking if the herd size figures make sense i.e. herd size >= # of infected animals

	}	// End: validate_herd_size()


	/**
	 * This method is used to save incident comments
	 */
	public function save_incident_comments() {

		// Check for the $_POST variable
		if ($_POST) {

			// comment validation config
			$comment_validation_config = array(
					'field' => 'comment_details',
					'label' => 'Comment Details',
					'rules' => 'xss_clean|trim|min_length[5]'
				);

			// load the validation rules
			$this->form_validation->set_rules($comment_validation_config);

			// run the validation
			if ($this->form_validation->run() == TRUE) {

				// comment details provided for the incident
				// create the db data array
				$db_data = array(
						'incident_id' => $this->session->userdata('incident_id'),
						'comment_details' => trim($this->input->post('comment_details')),
						'user_id' => $this->session->userdata('user_id')
					);

				// run the query to insert the record
				if (trim($this->input->post('comment_details')) != "") {
					$this->db->insert($this->tbl_incident_comments, $db_data);
				}

				// after this, return nothing because a user may or may not provide a comment
				// we dont care either way ... we only process a comment if one comes through
				// else, we revert back to the calling method in the controller which then redirects
				// back to the basic_details_summary page

				// Set the flash data ... it will show up once the page redirects back to the basic_details_summary page
				$this->session->set_flashdata('message','Your incident comment was successfully saved.');

				// but for the heck of it, let's just return TRUE
				return TRUE;

			}	// running form validation

		}	// Checking for form posted

		// Nothing posted ... just return FALSE then (just for heck of it again)
		return FALSE;

	}	// END: save_incident_comments()


	/**
	 * This method retrieves the list of SMSes from the database
	 * If the flag for ignoring the SMSes that have been used with incidents is set to true,
	 * the method will filter out those SMSes
	 * @author ScriptX Consulting Ltd
	 */
	public function sms_listing($ignore_incident_sms = FALSE) {

		// Check for the ignore flag
		// If it is set to TRUE, we get a list of SMSes from the incident_sms table,
		// create an array of the IDs and then we pass it to the ignore list of the query
		// that will be run agains the SMS table
		// If the ignore flag is not set OR is false (default), then simply retrieve all 
		// SMSes from the SMS table
		$array_incident_sms = array();
		if ($ignore_incident_sms) {

			// get list of IDs from the incident_sms table
			$this->db->select('sms_id id');
			$query = $this->db->get($this->tbl_incident_sms);
			$array_incident_sms = $query->result_array();
			$sms_id_array = array();
			foreach ($array_incident_sms as $sms) {
				$sms_id_array[] = $sms['id'];
			}

		}	// Arrgghhh ... but it still worked; getting the array of used SMS IDs so that one SMS is not used by two or more incidents

		// Now run the actual query that we wanted in order to get the list of SMSes that can be used for a new incident
		// Note that already used SMSes ... found in table 'incident_sms' will not be shown
		$this->db->where_not_in('id', $sms_id_array);
		$this->db->order_by('date_received', 'desc');
		$sms_query = $this->db->get($this->tbl_sms);

		// return the database object that was sent over
		return $sms_query;

	}


	/**
	 * This method gets a list of SMSes associated with an incident
	 * It accepts an incident ID
	 */
	public function incident_sms_listing($incident_id) {

		// get the list of the SMSes
		$this->db->where('incident_id', $incident_id);
		$this->db->order_by('date_received', 'desc');
		$query = $this->db->get($this->tbl_view_incident_sms);

		// return the db object
		return $query;

	}	// END: incident_sms_listing()


	/**
	 * This method gets a list of all comments associated with an incident
	 */
	public function incident_comments_listing($incident_id) {

		// get the list of comments
		$this->db->where('incident_id', $incident_id);
		$this->db->order_by('date_posted', 'desc');
		$query = $this->db->get($this->tbl_view_incident_comments);

		// return the db object
		return $query;

	}	// incident_comments_listing()


	/**
	 * This method saves the incident symptoms
	 */
	 public function save_incident_symptoms() {

	 	// Check for the $_POST variable
	 	if ($_POST) {

	 		// a form with the list of symptoms was submitted
	 		// get the list of incident symptoms
	 		$symptom_ids = $this->input->post('symptom_id');

	 		// get the incident id
	 		$incident_id = $this->session->userdata('incident_id');

	 		// first, delete all existing symptoms for this incident
	 		$this->db->delete($this->tbl_incident_symptoms, array('incident_id' => $incident_id));
	 		
	 		// iterate through the symptoms and save them
	 		foreach ($symptom_ids as $symptom_id) {
	 			$db_data = array(
	 				'incident_id' => $incident_id,
	 				'symptom_id' => $symptom_id
	 				);

		 		// insert the symptoms data
		 		$this->db->insert($this->tbl_incident_symptoms, $db_data);

	 		}	// Looping through the submitted incidents

	 	}	// Checking if anything was posted

	 }	// END: save_incident_symptoms()


	 /**
	  * This method gets a list of all incident symptoms
	  */
	 public function incident_symptoms_ids($incident_id) {

	 	// run query to get a list of all incident symptoms
	 	$this->db->where('incident_id', $incident_id);
	 	$query = $this->db->get($this->tbl_incident_symptoms);

	 	// loop through and get the IDs
	 	$array_symptoms_ids = array();
	 	foreach ($query->result() as $symptom_id) {
	 		$array_symptoms_ids[] = $symptom_id->symptom_id;
	 	}

	 	// return the array
	 	return $array_symptoms_ids;

	 }	// END: incident_symptoms_ids()


	 /**
	  * This method saves the incident symptoms comment
	  */
	 public function save_symptoms_comment() {

	 	// if this method is called, the submitted comment had a value
	 	// but first, let's confirm that it has a value
	 	if (trim($this->input->post('symptoms_comment')) != '') {

	 		// for sure, the form had something posted
	 		// prepare the data for saving
	 		$db_data = array(
	 				'incident_id' => $this->session->userdata('incident_id'),
	 				'comment_details' => trim($this->input->post('symptoms_comment')),
	 				'user_id' => $this->session->userdata('user_id')
	 			);

	 		// save the comment
	 		$this->db->insert($this->tbl_incident_symptoms_comments, $db_data);

	 		// set the flash data
	 		$this->session->set_flashdata('message', 'Your symptoms comment was successfully saved.');

	 	}	// checking if a comment was posted

	 	// return true
	 	return TRUE;

	 }	// save_symptoms_comment()


	/**
	 * This method gets a list of all the symptoms comments
	 */
	public function symptoms_comments_listing($incident_id) {

		// get the list of comments
		$this->db->where('incident_id', $incident_id);
		$this->db->order_by('date_posted', 'desc');
		$query = $this->db->get($this->tbl_view_incident_symptoms_comments);

		// return the db object
		return $query;

	}	// End: symptoms_comments_listing()


	/**
	 * This method gets a listing of all surveillance comments
	 */
	public function surveillance_comments_listing($incident_id) {

		// get the list of comments
		$this->db->where('incident_id', $incident_id);
		$this->db->order_by('date_posted', 'desc');
		$query = $this->db->get($this->tbl_view_incident_surveillance_comments);

		// return the db object
		return $query;

	}	// End: surveillance_comments_listing()


	/**
	 * This method gets a listing of all laboratory comments
	 */
	public function laboratory_comments_listing($incident_id) {

		// get the list of comments
		$this->db->where('incident_id', $incident_id);
		$this->db->order_by('date_posted', 'desc');
		$query = $this->db->get($this->tbl_view_incident_laboratory_comments);

		// return the db object
		return $query;

	}	// End: laboratory_comments_listing()


	/**
	 * This method gets a listing of all prognosis comments
	 */
	public function prognosis_comments_listing($incident_id) {

		// get the list of comments
		$this->db->where('incident_id', $incident_id);
		$this->db->order_by('date_posted', 'desc');
		$query = $this->db->get($this->tbl_view_incident_prognosis_comments);

		// return the db object
		return $query;

	}	// End: prognosis_comments_listing()


}	// END: class Incident_model()


/* End of file incident_model.php */
/* Location: ./application/models/incident_model.php */
