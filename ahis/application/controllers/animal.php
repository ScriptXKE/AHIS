<?php
class Animals extends CI_Controller
{
	function __construct()
	{
		parent::__construct('animaltypes');
	}
	
	function index()
	{
		$config['base_url'] = site_url('/animals/index');
		$config['total_rows'] = $this->animal->count_all();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_animal_manage_table( $this->animal->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->view('animals/manage',$data);
	}
	
	/*
	Returns animal table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_animal_manage_table_data_rows($this->animal->search($search),$this);
		echo $data_rows;
	}
	
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		$suggestions = $this->animal->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
	/*
	Loads the animal edit form
	*/
	function view($animal_id=-1)
	{
		$data['person_info']=$this->animal->get_info($animal_id);
		$this->load->view("animals/form",$data);
	}
	
	/*
	Inserts/updates a animal
	*/
	function save($animal_id=-1)
	{
		$person_data = array(
		'first_name'=>$this->input->post('first_name'),
		'last_name'=>$this->input->post('last_name'),
		'email'=>$this->input->post('email'),
		'phone_number'=>$this->input->post('phone_number'),
		'address_1'=>$this->input->post('address_1'),
		'address_2'=>$this->input->post('address_2'),
		'city'=>$this->input->post('city'),
		'state'=>$this->input->post('state'),
		'zip'=>$this->input->post('zip'),
		'country'=>$this->input->post('country'),
		'comments'=>$this->input->post('comments')
		);
		$animal_data=array(
		'company_name'=>$this->input->post('company_name'),
		'account_number'=>$this->input->post('account_number')=='' ? null:$this->input->post('account_number'),
		);
		if($this->animal->save($person_data,$animal_data,$animal_id))
		{
			//New animal
			if($animal_id==-1)
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('animals_successful_adding').' '.
				$animal_data['company_name'],'person_id'=>$animal_data['person_id']));
			}
			else //previous animal
			{
				echo json_encode(array('success'=>true,'message'=>$this->lang->line('animals_successful_updating').' '.
				$animal_data['company_name'],'person_id'=>$animal_id));
			}
		}
		else//failure
		{	
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('animals_error_adding_updating').' '.
			$animal_data['company_name'],'person_id'=>-1));
		}
	}
	
	/*
	This deletes animals from the animals table
	*/
	function delete()
	{
		$animals_to_delete=$this->input->post('ids');
		
		if($this->animal->delete_list($animals_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('animals_successful_deleted').' '.
			count($animals_to_delete).' '.$this->lang->line('animals_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('animals_cannot_be_deleted')));
		}
	}
	
	/*
	Gets one row for a animal manage table. This is called using AJAX to update one row.
	*/
	function get_row()
	{
		$person_id = $this->input->post('row_id');
		$data_row=get_animal_data_row($this->animal->get_info($person_id),$this);
		echo $data_row;
	}
	
	/*
	get the width for the add/edit form
	*/
	function get_form_width()
	{			
		return 360;
	}
}
?>