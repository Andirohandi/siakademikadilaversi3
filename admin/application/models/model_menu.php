<?php
	//File products_model.php
	class Model_menu extends CI_Model  {
	

	function getAllMenugroups() 
	{
		// Variable pendukung query	
		 $active = 1;
		//select semua data yang ada pada table
		$this->db->from("ref_menu_groups");
		$this->db->where('active', $active);
		$this->db->order_by('position','asc'); 
		return $this->db->get();
	}
	function getAllMenudetails($id, $level) 
	{
		// Variable pendukung query	
		$active = 1;
		//select semua data yang ada pada table
		$this->db->from("ref_level_menu_access a");
		$this->db->join('ref_menu_details b', 'a.id_menu_details = b.id_menu_details', 'left');
		$this->db->where('a.id_level', $level);
		$this->db->where('a.active', $active);
		$this->db->order_by("b.position","asc");
		if($id == 0)
		{}
		else
		{ $this->db->where('b.id_menu_groups', $id); }
		return $this->db->get();
	}

	}
?>