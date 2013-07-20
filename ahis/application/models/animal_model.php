<?php

class Animal_model extends CI_Model{

	public function get_info($animal_id)
	{
		$this->db->from('animaltype');
		$this->db->where('ID',$animal_ids);
		return $this->db->get();
		$this = array(
				'view' => 'dashboard/index'
			);
	}

	/*
	Determines if a given animal_id exists
	*/
	function exists($animal_id)
	{
		$this->db->from('animaltype');
		$this->db->where('animaltype.ID',$animal_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	/*
	Returns all the animals
	*/
	function get_all($limit=10000, $offset=0)
	{
		$this->db->from('animaltype');
		//$this->db->where('deleted', 0);
		$this->db->order_by("Type", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();		
	}
	
	function count_all()
	{
		$this->db->from('animaltype');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	
	/*
	Gets information about a particular animal
	*/
	function get_info($animal_id)
	{
		$this->db->from('animaltype');
		$this->db->where('animaltype.ID',$animal_id)
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $animal_id is NOT an animal
			$animal_obj=parent::get_info(-1);
			
			//Get all the fields from animal table
			$fields = $this->db->list_fields('Type');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$animal_obj->$field='';
			}
			
			return $animal_obj;
		}
	}
	
	/*
	Gets information about multiple animaltypes
	*/
	function get_multiple_info($animals_ids)
	{
		$this->db->from('animaltypes');
		$this->db->where_in('animals.ID',$animals_ids);
		$this->db->order_by("Type", "asc");
		return $this->db->get();		
	}
	
	/*
	Inserts or updates a animals
	*/
	function save(&$animal_data, &$animal_data,$animal_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		if(parent::save($animal_data,$animal_id))
		{
			if (!$animal_id or !$this->exists($animal_id))
			{
				$animal_data['ID'] = $animal_data['ID'];
				$success = $this->db->insert('animals',$animal_data);				
			}
			else
			{
				$this->db->where('ID', $animal_id);
				$success = $this->db->update('animals',$animal_data);
			}
			
		}
		
		$this->db->trans_complete();		
		return $success;
	}
	
	/*
	Deletes one animal
	*/
	function delete($animal_id)
	{
		$this->db->where('ID', $animal_id);
		return $this->db->update('animals', array('deleted' => 1));
	}
	
	/*
	Deletes a list of animals
	*/
	function delete_list($animal_ids)
	{
		$this->db->where_in('ID',$animal_ids);
		return $this->db->update('animals', array('deleted' => 1));
 	}
 	
 	
}
}
