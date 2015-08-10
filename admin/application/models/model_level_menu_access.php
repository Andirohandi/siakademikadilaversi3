<?php
	//File products_model.php
	class Model_level_menu_access extends CI_Model  {
	

	function getAlllevel_menu_access() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->select('a.id_level_menu_access, c.nm_menu_details, c.id_menu_details, b.nm_level, a.id_level, a.active');
		$this->db->from('ref_level_menu_access a');
		$this->db->join('ref_level b','a.id_level = b.id_level');
		$this->db->join('ref_menu_details c','a.id_menu_details = c.id_menu_details');
		return $this->db->get();
	}

    function Insertlevel_menu_access($data) 
    {
    	$this->db->insert('ref_level_menu_access', $data);
    }

     function Deletetlevel_menu_access($id_level_menu_access) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_level_menu_access', $id_level_menu_access);
		$this->db->delete('ref_level_menu_access');
	}
	
	function getAlllevel_menu_accessselect($id_level_menu_access) 
	{
	
		//select semua data yang ada pada table
		$this->db->from("ref_level_menu_access");
	
		$this->db->where('id_level_menu_access', $id_level_menu_access); 
		return $this->db->get();
	}

	 function Updatelevel_menu_access($id_level_menu_access, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_level_menu_access', $id_level_menu_access);
		$this->db->update('ref_level_menu_access', $data);
	}

	
	function combobox_menu_level() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_level");
	 
		return $this->db->get();
	}
	
	function combobox_menu_details() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_menu_details");
	 
		return $this->db->get();
	}
	
	function tampillevel($id_level)
	{
	$this->db->from("ref_level");
	$this->db->where("id_level",$id_level);
	}
	}
