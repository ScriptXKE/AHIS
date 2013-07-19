<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Splash extends CI_Controller 
{

	/**
	 * Run the constructor
	 */
	public function __construct() 
	{

		parent::__construct();

	}	// END: __construct()


	/**
	 * Default method for the Splash class
	 * 
	 * This method loads the splash screen / page without any fuss
	 * 
	 */
	public function index() 
	{

		/**
		 * Load the splash screen
		 */
		$data = array(
				'view' => 'splash/index'
			);

		/**
		 * Load the view
		 */
		$this->load->view('splash_template', $data);

	}	// END: index()

}	// END: Class CI_Controller


/* End of file splash.php */
/* Location: ./application/controllers/splash.php */