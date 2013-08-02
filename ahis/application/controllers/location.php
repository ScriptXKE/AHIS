<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class contains methods for the districts
 * @author ScriptX Consulting Ltd (andrew@scriptx.co.ke / andrew@scriptx.org) | 25 July 2013
 */
class Location extends CI_Controller
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

	}	// END: __construct()

	public function index()
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		$data['view'] = 'location/index';

		$paginate['base_url'] = base_url().'/location/index/';
		$paginate['total_rows'] = $this->location_model->count('district');
        $paginate['per_page'] = 10;	
        $this->pagination->initialize($paginate);

		$this->db->select('country.name country_name, zone.name zone_name, region.name region_name, district.name district_name, district.id district_id');
		$this->db->from('country');
		$this->db->join('zone', 'zone.country_id = country.id');
		$this->db->join('region', 'region.zone_id = zone.id');
		$this->db->join('district', 'district.region_id = region.id');
		
		$query = $this->db->get();

		$arr = $query->result_array();

		$data['gis'] = $query;

		$this->load->view('main_template', $data);
	}

	public function detail($location_ID)
	{
		$data = array(); // this will prevent errors in case there is no data in the array; so we declare it and leave it empty

		if ($query = $this->location_model->get_location_detail($location_ID))
		{
			$data['view'] = 'location/detail';

			$this->db->select('country.name country_name, zone.name zone_name, region.name region_name, district.name district_name, district.id district_id, town.name town_name,  town.id town_id');
			$this->db->from('country');
			$this->db->where('district.id', $location_ID);
			$this->db->join('zone', 'zone.country_id = country.id');
			$this->db->join('region', 'region.zone_id = zone.id');
			$this->db->join('district', 'district.region_id = region.id');
			$this->db->join('town', 'town.district_id = district.id');
		
		$query = $this->db->get();

		$arr = $query->result_array();

		$data['gis'] = $query;
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
		//then pass the data to create the dropdown list
		$data['districts'] = $this->location_model->dropdownlocations();
		$data['view'] = 'location/add';
		$this->load->view('main_template', $data);
	}	

	public function create()
	{
		$locationdata = array(
			'name' => $this->input->post('town') ,//equivalent to $_POST['title'] in regular php
			'district_id' => $this->input->post('districts')
			);
		$this->location_model->add($locationdata);
		// location entered successfully so we set the flash data
		$this->index(); //Here we just load the index of the animal controller which will take us back to the index page
	}

	function edit($location)
	{
		//first pass an array to help us block any errors we dont want
		$data = array();

		if ($query = $this->location_model->get_town_detail($location)) {
			$data['view'] = 'location/edit';
			$this->db->select('town.name town_name,  town.id town_id, district.name district_name, district.id district_id');
			$this->db->from('district');
			$this->db->where('town.id', $location);
			$this->db->join('town', 'town.district_id = district.id');		
		
		$query = $this->db->get();
		$arr = $query->result_array();
		//then pass the data to create the dropdown list
		$data['districts'] = $this->location_model->dropdownlocations();
		$data['gis'] = $query;
		}		
		$this->load->view('main_template', $data);
	}

	function addupdate()
	{
		$locationdata = array(
			'id' 			=> $this->input->post('id') ,
			'name' 			=> $this->input->post('town') ,
			'district_id' 	=> $this->input->post('districts') 
			);

		$this->location_model->edit($locationdata);
		$this->index();
	}


	function delete()
	{
		$this->location_model->delete();
		$this->index();
	}


	
}