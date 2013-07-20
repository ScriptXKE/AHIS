<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class contains methods for the dashboard
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 17 July 2013
 */
class Cases extends CI_Controller 
{
	public function __construct() 
	{

		// Run parent controller
		parent::__construct();
		$this->auth_model->is_logged_in();

		/**
		 * The auth model is already autoloaded and the session validated
		 * Check if the user is logged in
		 */


		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('ahis_CRUD');	

	}	// END: __construct()


	function _cases_output($output = null)
	{
		$this->load->view('main_template.php',$output);	
	}


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
		 * Create the output array
		 */
		$output = array(
				'view' => 'cases/index'
			);

		/**
		 * Load the main template and pass it the dashboard view
		 */
		//$this->load->view('main_template', $data);
		$this->_cases_output($output);
		
	}	// END: index()


	

	function cases_management()
	{
		try{
			$crud = new ahis_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('case');
			$crud->set_subject('Cases');
			$crud->required_fields('CaseID','CaseNumber','CaseNotes');
			$crud->columns('CaseID','CaseNumber','CaseNotes');
			
			$output = $crud->render();
			
			$this->_cases_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
}


/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */