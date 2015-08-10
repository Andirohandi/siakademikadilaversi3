<?php
	
	class Model_guru extends CI_Model  {
	

	function getAllguru() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_guru");
	 
		return $this->db->get();
	}

    function Insertguru($data) 
    {
    	$this->db->insert('ref_guru', $data);
    }

     function Deleteguru($id_guru) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_guru', $id_guru);
		$this->db->delete('ref_guru');
	}
	
	function getAllguruselect($id_guru) 
	{
	
		//select semua data yang ada pada table
		$this->db->from("ref_guru");
	
		$this->db->where('id_guru', $id_guru); 
		return $this->db->get();
	}

	 function Updateguru($id_guru, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_guru', $id_guru);
		$this->db->update('ref_guru', $data);
	}

	}
