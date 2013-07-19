<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains methods for logging out a user from the system
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 */
class Logout extends CI_Controller 
{



	/**
	 * Constructor for the Logout class / controller
	 */
	public function __construct() 
	{

		/**
		 * this constructor does nothing right now
		 */
		parent::__construct();

	}	// END: __construct()



	/**
	 * Default method for the Logout controller
	 * 
	 * This method is automatically called when a user clicks on the Logout link
	 * It resets all the session array data to nothing
	 * It then destroys the session
	 * It goes further to set the session's expiry date to a date earlier than today
	 * (just to make sure the session is killed dead!!!)
	 * It then redirects the user to the login page
	 * 
	 * @todo 	Perhaps in a later date, we can set flashdata to notify the user that the
	 *			session was successfully destroyed i.e. user successfully logged out
	 * 
	 */
	public function index() 
	{

		/**
		 * Set the session array to nothing
		 */
		$this->session->userdata = array();

		/**
		 * Destroy the session
		 */
		$this->session->sess_destroy();

		/**
		 * Destroy the cookie by setting its expiration to a past time/date
		 */
		setcookie( config_item('sess_cookie_name'), '', time() - 3600 );

		/**
		 * Clear the cache
		 */
		$this->base_model->clear_cache();

		/**
		 * Now redirect to the login page
		 */
		redirect(base_url().'login');

	}	// END: index()



}	// END: Class Logout


/* End of file logout.php */
/* Location: ./application/models/logout.php */