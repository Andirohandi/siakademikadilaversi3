<?php
	//File products_model.php
	class Model_calon_siswa extends CI_Model  {
	

	/*function getAllcalonsiswa() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status', 1);
		$this->db->where('lulus', 0);
		$this->db->from("tr_pendaftaran");
	 
		return $this->db->get();
	}*/

	
	function updatecalonsiswa($id_pendaftaran, $data) 
	{
		$this->db->where('id_pendaftaran', $id_pendaftaran);
		$this->db->update('ref_siswa', $data);
	}
	
	function getAllcalonsiswa($tahun) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		
		$this->db->where('tahun', $tahun);
		$this->db->from("ref_siswa");
	 	
	 	//$this->db->where('id_tahun_ajaran', 1);
		return $this->db->get();
	}
	
	function getCalonSiswa($id)
	{
		$this->db->where('id_pendaftaran', $id);
		$this->db->from("ref_siswa");
	 	
	 	//$this->db->where('id_tahun_ajaran', 1);
		return $this->db->get();
	
	}
	
	function deletetecalonsiswa($id)
	{
		$this->db->where('id_pendaftaran', $id);
		$this->db->delete('ref_siswa');
	}
	
   

}
