<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class contains methods for modifying the diseases
 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 22 July 2013
 */

class Disease extends CI_Controller
{
	/**
	 * Constructor method
	 * 
	 * This constructor checks if the user has a valid session before
	 * transferring control to the index() method to load the diseases
	 * 
	 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 22 July 2013
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

	function index()
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		if ($query = $this->disease_model->get_records())
		{
			$data['diseases'] = $query;
			$data['view'] = 'disease/index';
		}	
		/**
		 * Load the main template and pass it the dashboard view
		 */
		$this->load->view('main_template', $data);
	}

	public function detail($disease_ID)
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		if ($query = $this->disease_model->get_detail($disease_ID))
		{
			$data['diseases'] = $query;
			$data['view'] = 'disease/detail';
		}
		/**
		 * Load the main template and pass it the dashboard view
		 */
		$this->load->view('main_template', $data);
	}

	public function add()
	{
		$data['view'] = 'disease/add';
		$this->load->view('main_template', $data);
	}

	public function create()
	{
		$diseasedata = array(
			'Disease' => $this->input->post('Disease') //equivalent to $_POST['title'] in regular php
			);
		$this->disease_model->add($diseasedata);
		// Animal entered successfully so we set the flash data
		$this->index(); //Here we just load the index of the animal controller which will take us back to the index page
	}

	function update($disease_ID)
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		if ($query = $this->disease_model->get_detail($disease_ID))
		{
			$data['diseases'] = $query;
			$data['view'] = 'disease/update';
		}

		$this->load->view('main_template', $data);
	}

	function addupdate($disease_ID)
	{
		$diseasedata = array(
			'Disease' => $this->input->post('Disease') 
			);

		$this->disease_model->update($diseasedata);
	}


	function delete()
	{
		$this->disease_model->delete();
		$this->index();
	}


	
}