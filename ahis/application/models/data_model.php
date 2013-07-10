<?php

class Data_model extends CI_Model{
	/*

	function getAll(){
		$q = $this->db->query("select * from country");
		if ($q->num_rows() > 0){
			foreach ($q->result() as $row) {
				$data[] = $row;
				# code...
			}
			return $data;
			
		}
	}*/

	function getAll(){
		$q = $this->db->get('country');

		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
				# code...
			}
			return $data;
			# code...
		}

	}

}

?>