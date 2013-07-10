<?php

/**
* 
*/
class Site extends ci_Controller
{
	
	function index(){
		//this pulls data from the data model
		$this->load->model('data_model');
		//this gets the data pulled and assigns it to the $data array
		$data['rows'] = $this->data_model->getAll();

		$this->load->view('home', $data);

	}

	
}

?>