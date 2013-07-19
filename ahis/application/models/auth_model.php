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
			$query = $this->db->get_where('users', $user_data);

			// Check for the number of rows returned
			if ($query->num_rows == 1) {

				// Successful login ... the details are valid
				// Create the session variables
				// Grab the returned query results
				$user_details = $query->row_array();

				// Create an array of all the session variables
				$session_data = array(
						'user_id' => $user_details['id'],
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



}	// END: Class My_Model


/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */