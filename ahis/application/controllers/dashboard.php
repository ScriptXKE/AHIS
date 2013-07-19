<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains methods for the dashboard
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 */
class Dashboard extends CI_Controller 
{



	/**
	 * Constructor method
	 * 
	 * This constructor checks if the user has a valid session before
	 * transferring control to the index() method to load the dashboard
	 * 
	 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
	 *
	 */
	public function __construct() 
	{

		// Run parent controller
		parent::__construct();

		/**
		 * The auth model is already autoloaded and the session validated
		 * Check if the user is logged in
		 */
		$this->auth_model->is_logged_in();

	}	// END: __construct()



	/**
	 * Default method for the Dashboard controller
	 * 
	 * This method loads the dasboard without any fuss
	 * Session validation has already taken place in the constructor
	 *
	 */
	public function index() 
	{

		/**
		 * Create the data array
		 */
		$data = array(
				'view' => 'dashboard/index'
			);

		/**
		 * Load the main template and pass it the dashboard view
		 */
		$this->load->view('main_template', $data);
		
	}	// END: index()

}


/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */