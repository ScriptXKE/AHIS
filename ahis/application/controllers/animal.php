<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class contains methods for the districts
 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 25 July 2013
 */
class Animal extends CI_Controller
{
	/**
	 * Constructor method
	 * 
	 * This constructor checks if the user has a valid session before
	 * transferring control to the index() method to load the animals
	 * 
	 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 25 July 2013
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
		$this->load->model('animal_model');
	}	// END: __construct()

	public function index()
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		$data['view'] = 'animal/index';

		$paginate['base_url'] = base_url().'/animal/index/';
		$paginate['total_rows'] = $this->animal_model->count('district');
        $paginate['per_page'] = 10;	
        $this->pagination->initialize($paginate);

		$this->db->select('animals.name animal_name, animals.id animal_id');
		$this->db->from('animals');
		
		$query = $this->db->get();

		$arr = $query->result_array();

		$data['animals'] = $query;

		$this->load->view('main_template', $data);
	}

	public function detail($animal_ID)
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		if ($query = $this->animal_model->get_animal_detail($animal_ID))
		{
			$data['view'] = 'animal/detail';

			$this->db->select('animals.name animal_name, animals.id animal_id');
			$this->db->from('animals');
			$this->db->where('animals.id', $animal_ID);

			$query = $this->db->get();

			$arr = $query->result_array();

			$data['animals'] = $query;
		}
		/**
		 * Load the main template and pass it the dashboard view
		 */
		$this->load->view('main_template', $data);
	}

	public function add()
	{
		//first pass an array to help us block any errors we dont want
		$data = array();
		$data['view'] = 'animal/add';
		$this->load->view('main_template', $data);
	}	

	public function create()
	{
		$animaldata = array(
			'name' => $this->input->post('animal') //equivalent to $_POST['title'] in regular php
			//'district_id' => $this->input->post('districts')
			);
		$this->animal_model->add($animaldata);
		// animal entered successfully so we set the flash data
		$this->index(); //Here we just load the index of the animal controller which will take us back to the index page
	}

	function edit($animal)
	{
		//first pass an array to help us block any errors we dont want
		$data = array();

		if ($query = $this->animal_model->get_animal_detail($animal)) {
			$data['view'] = 'animal/edit';
			$this->db->select('animals.name animal_name,  animals.id animal_id');
			$this->db->from('animals');
			$this->db->where('animals.id', $animal);
		
		$query = $this->db->get();
		$arr = $query->result_array();
		//then pass the data to create the dropdown list
		//$data['animal'] = $this->animal_model->dropdownanimals();
		$data['animals'] = $query;
		}		
		$this->load->view('main_template', $data);
	}

	function addupdate()
	{
		$animaldata = array(
			'id' 			=> $this->input->post('id') ,
			'name' 			=> $this->input->post('animal')  
			);

		$this->animal_model->edit($animaldata);
		$this->index();
	}


	function delete()
	{
		$this->animal_model->delete();
		$this->index();
	}


	
}