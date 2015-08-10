<?php
	//File products_model.php
	class Model_daftar extends CI_Model  {


	function ceknisn($nisn) 
	{
		// Variable pendukung query	
		
		//select semua data yang ada pada table			 	
	 		
	 		
	 		$this->db->where('nisn', $nisn);
	 		$this->db->from("tr_pendaftaran");
			$query = $this ->db-> get();
			if($query -> num_rows() == 1)
			{
				return $query->row_array();
	 		}
			else
			{
				return false;
			}
	 
	}


    function pendaftaran($data) 
    {
    	$this->db->insert('tr_pendaftaran', $data);
    }

     

}
