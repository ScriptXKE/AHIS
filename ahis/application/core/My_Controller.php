<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller {

	// create the __construct() method
	public function __construct() {

		// load the parent constructor
		parent::__construct();

		// check if the user is logged in before they can even use any of the system features
		$this->is_logged_in();

	}	// END: __construct()

	// create the method to validate a session
	public function is_logged_in() {

		// check for the session first, grab the user id
		$user_id = $this->session->userdata('user_id');

		// check if the user id is valid ... if not valid, redirect to the login page
		if (!$user_id || $user_id <= 0) {

			// user id is invalid ... i.e. session is invalid redirect to the login page
			redirect(base_url() . 'login');

		}	// checking if the session variable is valid

	}	// END: is_logged_in()

}	// END: Class My_Controller