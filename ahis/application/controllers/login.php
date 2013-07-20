<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class has several methods that are used in the user login and
 * authentication process
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 */
class Login extends CI_Controller 
{

	/**
	 * Constructor for the Login class
	 */
	public function __construct() 
	{

		// Run the parent constructor
		parent::__construct();

	}	// END: __construct()


	/**
	 * Default method for the login class
	 * This method, first and foremost, checks if a user is logged in
	 * If the user is logged in, they are redirected to the dashboard
	 * If the user is not logged, the login form is loaded instead
	 * 
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 * 
	 */
	public function index() 
	{

		//	Check if user has a valid session
		if ($this->session->userdata('user_id')) 
		{

			//	Session is set ... redirect to the dashboard
			redirect(base_url(). 'dashboards');

		}
		else
		{

			//	No session ... load the login page
			$data = array(
					'view' => 'login/index'
				);

			//	Load the main template and pass in the login page view
			$this->load->view('login_template', $data);

		}	// checking if session exists

	}	// END: index()


	
	/**
	 * Validates User Login Request
	 * This method checks for a form submission
	 * If there is no submission, it redirects to the login page
	 * 
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 * 
	 */
	public function validate() 
	{

		//	Check for POST values
		if ($_POST) 
		{

			//	Call the user login authentication method
			$login_status = $this->auth_model->authenticate_user();
			
			// Check for the login status
			if ($login_status['success'] == TRUE) 
			{
				
				// Login successful ... redirect to the dashboard
				redirect(base_url() . "dashboards");

			} 
			else 
			{

				// Login failed ... redirect back to the login page with flashdata
				$this->session->set_flashdata('msg', $login_status['msg']);

				// Redirect to the login page
				redirect(base_url() . 'login');

			}	//	Checking if the login process was successful

		}
		else
		{

			//	Redirect to the login page
			redirect(base_url() . 'login');

		}	// checking for $_POST values

	}	// END: validate()


	
	/**
	 * Resets a User's Password
	 * 
	 * This method is used to reset a user's password by taking his/her email address,
	 * checking that it exists in the database and providing a link to enable the user
	 * to change their password; the password changing link is sent to the email address
	 * that the user provided in order to avoid the system automatically changing passwords
	 * ... a feature that can be exploited by malicious people
	 *
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 * 
	 */
	public function password_reset() {

		//	Check for the email address associated with the account whose owner forgot his/her password
		echo "We'll be resetting your password very soon ... just go back now :)";

	}	//	END: password_reset()

}	//	END: Class Login


/* End of file login.php */
/* Location: ./application/controllers/login.php */