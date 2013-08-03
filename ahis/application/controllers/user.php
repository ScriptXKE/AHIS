<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{


	// Declare private variables that hold table names
	private $tbl_users = 'users';
	private $vw_users = 'view_users';

	
	/**
	 * Constructor for the User class / controller
	 */
	public function __construct() 
	{

		/**
		 * Run the parent constructor
		 */
		parent::__construct();

		/**
		 * The auth model is autoloaded
		 * Check if the user is logged in
		 */
		$this->auth_model->is_logged_in();
		
	}	// END: __construct()


	
	/**
	 * Loads user's profile for editing
	 * This method is used to load a user's personal profile for editing purposes
	 * Currently, the user can change most settings except for his 'username' ... this
	 * is to avoid a user giving himself reserved usernames e.g. admin, administrator,
	 * superuser etc
	 *
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 18 July 2013
	 * 
	 */
	public function profile() {

		// Initialize the $msg variable to nothing
		$msg = "";

		// Check if any data was posted from the form
		if ($_POST) {

			// User details posted for update
			// Call the appropriate method from the auth_model
			$msg .= $this->auth_model->profile_update();

		}	//	Checking for posting of any profile details

		//	Run the query to get the current user's profile details
		$user_criteria_array = array('user_id' => $this->session->userdata('user_id'));
		$query = $this->db->get_where('view_users', $user_criteria_array);

		// Check for results
		if ($query->num_rows() == 1) {

			// Successfully retrieved user details from the database
			// Now prepare to load the user profie view
			$data = array(
					'view' => 'user/profile',
					'user_details' => $query->row_array(),
					'msg' => $msg
				);

			// Load the view
			$this->load->view('main_template', $data);

		} else {

			// No results were fetched for the user_id provided
			// Notify the user that his/her details could not be found
			// This is of course most weird because then how did the user log in?
			// Maybe his/her details were deleted while they were still logged in ...
			// Does this necessitate us to validate sessions using the users table everytime?
			// Are we willing to underwrite such database overheads? HELL NO!!!
			$data = array(
					'view' => 'common/notifications',
					'msg' => array('type'=>'error','message'=>'Your details could not be found in the database. Please try again later.')
				);

			// Load the view
			$this->load->view('main_template', $data);

		}

	}	//	END: profile()

}	// END: Class User


/* End of file user.php */
/* Location: ./application/controllers/user.php */