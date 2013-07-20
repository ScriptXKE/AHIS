<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains a series of user authentication related methods
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 * 
 */
class Auth_model extends CI_Model {



	/**
	 * Constructor method
	 */
	public function __construct() {

		parent::__construct();

	}	// END: __construct()



	/**
	 * Checks if a user is logged in and has a valid session
	 * 
	 * This method takes advantage of the session variable to check if the 'user_id' is set
	 * If the 'user_id' is set, it checks if it contains any valid value i.e. numeric value greater than zero
	 * This is because there is no valid user_id that is less than zero
	 *
	 * This method clears the cache completely to avoid instances where you've logged out but when you go back
	 * in the browser, the previously loaded page (one that you've logged out already) is loaded as if you haven't
	 * logged out yet; this method totally clears the cache and enables redirecting to the login page
	 *
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 *  
	 */
	public function is_logged_in() {

		// Clear the cache first
		$this->base_model->clear_cache();

		//	Check for the session first, grab the user id
		$user_id = $this->session->userdata('user_id');

		//	Check if the user id is valid ... if not valid, redirect to the login page
		if (!$user_id || $user_id <= 0) {

			//	Simply redirect via the logout page to kill all remnant session variables and then redirect to the login page
			redirect(base_url() . 'logout');

		}	// Checking if the session variable is valid

	}	// END: is_logged_in()



	/**
	 * Validates a Login Attempt
	 * This method is used to validate the login username and password
	 * If the details are correct, the user is successfully logged in
	 * If they are invalid, the user is notified and given a chance to log in again
	 * 
	 * @author 	ScriptX Consulting Ltd (sales@scriptx.co.ke | sales@scriptx.org) | 18th July 2013
	 * 
	 */
	public function authenticate_user() {

		//	Create the login details validation rules
		$login_details_validation_config = array(
				array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'trim|required'
					),
				array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required'
					)
			);

		//	Load the form validation library
		$this->load->library('form_validation');

		//	Set the validation error delimiters
		$this->form_validation->set_error_delimiters('<li>','</li>');

		//	Load the validation rules
		$this->form_validation->set_rules($login_details_validation_config);

		//	Run the validation of the login credentials
		if ($this->form_validation->run() == FALSE) {

			// load the error message(s) in the $data array
			$return_array = array(
					'success' => FALSE,
					'errors' => validation_errors()
				);

			// return the status message
			return $return_array;

		} else {
			
			//	All is okay ... authenticate the user
			//	Create array for querying the database
			$user_data = array(
					'username' => $this->input->post('username', true),
					'password' => sha1($this->input->post('password', true)),
					'active' => '1'
				);

			// Run these details against the database
			$query = $this->db->get_where('view_users', $user_data);

			// Check for the number of rows returned
			if ($query->num_rows == 1) {

				// Successful login ... the details are valid
				// Create the session variables
				// Grab the returned query results
				$user_details = $query->row_array();

				// Create an array of all the session variables
				$session_data = array(
						'user_id' => $user_details['user_id'],
						'person_id' => $user_details['person_id'],
						'fullname' => $user_details['firstname'] . ' ' . $user_details['surname'],
						'username' => $user_details['username'],
						'avatar' => (trim($user_details['avatar']) == '' ? 'missing.avatar.jpg' : $user_details['avatar'])
					);

				// Create the session
				$this->session->set_userdata($session_data);

				// Redirect to the dashboard
				redirect(base_url() . 'dashboard');

			} else {

				// The login credentials are invalid
				$return_array = array(
						'success' => FALSE,
						'msg' => 'The login details that you provided are invalid.'
					);

				// return the results
				return $return_array;

			}	//	Checking if the query returned any results

		}	// running validation on form submitted

	}	// END: authenticate_user()



	/**
	 * Updates the user's profile with submitted information
	 * This method checks for any form submissions and if it finds any, it 
	 * processes them and updates the database using the user_id and person_id
	 * that are stored in the session variable
	 * 
	 * @author 	ScriptX Consulting Ltd (sales@scriptx.co.ke | sales@scriptx.org) | 19th July 2013
	 * 
	 */
	public function profile_update() 
	{

		// Check for any posted information
		// Initialize the message variable
		$msg = "<p>The following notice(s) / error(s) were noted:-</p><ul>";

		
		/**************** BASIC PERSON DETAILS ****************************/
		// Let's set form validation config file for the person details
		$person_details_validation_config = array(
				array(
					'field' => 'u_firstname',
					'label' => 'First Name',
					'rules' => 'required|trim'
					),
				array(
					'field' => 'u_surname',
					'label' => 'Surname',
					'rules' => 'required|trim'
					),
				array(
					'field' => 'u_othernames',
					'label' => 'Other Name(s)',
					'rules' => 'trim'
					),
				array(
					'field' => 'u_biodata',
					'label' => 'Biodata',
					'rules' => 'trim'
					)
			);

		// Load the form validation library
		$this->load->library('form_validation');

		// Set the validation delimiters
		$this->form_validation->set_error_delimiters('<li>','</li>');

		// Load the validation configuration
		$this->form_validation->set_rules($person_details_validation_config);

		// Check if they all validated
		if ($this->form_validation->run() == FALSE) 
		{

			// Return the error(s) encountered
			$msg .= validation_errors();

		} else {

			//	No errors ... go ahead and update the persons table with the new details
			//	First, update the $person_details_array() with the details to be updated
			$person_details_array = array(
					'firstname' => $this->input->post('u_firstname'),
					'surname' => $this->input->post('u_surname'),
					'othernames' => $this->input->post('u_othernames'),
					'surname' => $this->input->post('u_surname'),
					'biodata' => $this->input->post('u_biodata')
				);

			// Update the persons table
			$this->db->where('id', $this->session->userdata['person_id']);
			$this->db->update('persons', $person_details_array);

			// Successful update
			// Update the session variable that carries the user's name
			$this->session->set_userdata('fullname', $this->input->post('u_firstname') . ' ' . $this->input->post('u_surname'));

			// Update the $msg variable
			$msg .= "<li>Your profile details were updated successfully.</li>";

		}	//	Running the form data validations for PERSONS update data


		/************* NOW RUN EMAIL CHECKS ********************************/
		// Create the email validation configuration array
		$email_validation_config = array(
				array(
					'field' => 'u_email',
					'label' => 'Email',
					'rules' => 'required|trim|valid_email|callback_email_check'
					)
			);

		// Run the validation check
		$this->form_validation->set_rules($email_validation_config);

		// Run the validation and check for the result
		if ($this->form_validation->run() == TRUE) 
		{

			// Email is okay ... go ahead and save it to the database
			$this->db->where('id', $this->session->userdata['person_id']);
			$this->db->update('persons', array('email' => $this->input->post('u_email')));

			// Email updated successfully
			$msg .= "<li>Your email address was successfully updated.</li>";

		}	// Checking if email validation ran successfully


		/**************** PASSWORD UPDATE CHECKS *****************************/
		if ( trim($this->input->post('u_password') != "") && trim($this->input->post('u_confirm_password') != "") ) 
		{

			// passwords provided ... ensure they are at least 6 characters long and they match
			$password_validation_config = array(
					array(
						'field' => 'u_password',
						'label' => 'Password',
						'rules' => 'trim|min_length[6]'
						),
					array(
						'field' => 'u_confirm_password',
						'label' => 'Confirm Password',
						'rules' => 'trim|min_length[6]|matches[u_password]'
						)
				);

			// Load the form validation configuration file and run the validation
			$this->form_validation->set_rules($password_validation_config);

			// run the validation and check for the result
			if ($this->form_validation->run() == TRUE) {

				// The passwords passed the validation
				// Update the password in the database
				$this->db->where('id', $this->session->userdata['user_id']);
				$this->db->update('users', array('password' => sha1(trim($this->input->post('u_password')))));

				// Update the status message
				$msg .= "<li>Your password was successfully updated.</li>";

			}	// Checking for valid passwords

		}	// Checking if passwords were sent over for update


		/********************* AVATAR PROCESSING ********************************/
		

		// Close the $msg variable and return it to the calling function
		$msg .= "</ul>";

		// Return it ...
		return $msg;

	}	//	END: profile_update()



	/**
	 * Checks if an email already exists in the database under a different account
	 * This method will be called within the form validation configuration definition
	 */
	public function email_check($email) 
	{

		// Construct the query
		$this->db->where('email', $email);
		$this->db->where('id != ', $this->session->userdata('person_id'));

		// Run the query
		$query = $this->db->get('persons');

		// Check for the number of rows returned
		// If a record is returned, then this action will cause a duplicate email record
		if ($query->num_rows() == 0) {

			// No duplicate possibility
			return TRUE;

		} else {

			// There is a duplicate possibility
			// Return an error message
			$this->form_validation->set_message('email_check', 'The email address already exists for another account.');
			return FALSE;

		}	// Checking the # of records returned

	}	// END: email_check()



}	// END: Class My_Model



/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */