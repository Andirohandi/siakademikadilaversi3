<?php
	//File products_model.php
	class Model_personal extends CI_Model  {


	function getpersonal($id_pendaftaran) 
	{
		// Variable pendukung query
		$this->db->where('id_pendaftaran', $id_pendaftaran);	
		$this->db->from('tr_pendaftaran');
		
		return $this->db->get();
	}

	
	 function update($id_pendaftaran, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_pendaftaran', $id_pendaftaran);
		$this->db->update('tr_pendaftaran', $data);
	}

	

}
