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
		$this->load->library('pagination');
		$this->load->model('');

	}	// END: __construct()

	function index()
	{
		
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		$data['view'] = 'disease/index';

		$paginate['base_url'] = base_url().'/disease/index/';
		$paginate['total_rows'] = $this->disease_model->count('diseases');
        $paginate['per_page'] = 10;	
        $this->pagination->initialize($paginate);

		$this->db->select('diseases.id disease_id, diseases.name disease_name');
		$this->db->from('diseases');
		
		$query = $this->db->get();

		$arr = $query->result_array();
		$data['title'] = "index page";

		$data['diseases'] = $query;

		$this->load->view('main_template', $data);
	}

	public function detail($disease_ID)
	{
		//first we prevent errors in case there are no results
		$data = array();

		//then we check, what is the user trying to do. Get the details about a disease
		if ($query = $this->disease_model->get_disease_detail($disease_ID))
		{
			//then we select all our data after joining the diseases and the symptoms using the lookup table
			$this->db->select('diseases.id disease_id, diseases.name disease_name, 
				symptoms.id symptom_id, symptoms.name symptom_name');
			$this->db->from('diseasesymptom');
			$this->db->from('symptoms');
			$this->db->from('diseases');
			$this->db->where('diseases.id', $disease_ID);
			$this->db->where('diseasesymptom.disease_id', $disease_ID);
			
		//then we put the results into an array
			$query = $this->db->get();
			$arr = $query->result_array();
			$data['diseases'] = $query;

		//then we prepare our pagination for the results
		//then we prepare our view
			$data['view'] = 'disease/detail';
		//then we pass our results to the view		
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

	function edit($disease_ID)
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		if ($query = $this->disease_model->get_disease_detail($disease_ID))
		{
			$data['diseases'] = $query;
			$data['view'] = 'disease/edit';
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