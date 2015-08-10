<?php
	//File products_model.php
	class Model_lulus extends CI_Model  {
	

	function getAlllulus($status) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status', $status);
		$this->db->from("tr_tahun_ajaran");
	 
		return $this->db->get();
	}

	function getAlltidak($status) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status >=', $status);
		$this->db->from("tr_tahun_ajaran");
	 
		return $this->db->get();
	}

	function getAlllus($status) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status >=', $status);
		$this->db->from("tr_tahun_ajaran");
	 
		return $this->db->get();
	}


   
	
	function Updatelulus($id_tahun_ajaran, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_tahun_ajaran', $id_tahun_ajaran);
		$this->db->update('tr_tahun_ajaran', $data);
	}

	function Updatereg($id_pendaftaran, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_pendaftaran', $id_pendaftaran);
		$this->db->update('tr_pendaftaran', $data);
	}

	function getAllcalonsiswa($tahun, $where='') 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		
		$this->db->where('tahun', $tahun);
		
		if($where)
		$this->db->where($where);
		
		$this->db->from("ref_siswa");
	 	
	 	//$this->db->where('id_tahun_ajaran', 1);
		return $this->db->get();
	}

	function getAllcalonsiswatidak($tahun) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status', 1);
		$this->db->where('lulus', 1);
		$this->db->where('tahun', $tahun);
		$this->db->from("tr_pendaftaran");
	 	$this->db->order_by('no_urut','desc');
		return $this->db->get();
	}

	function get_nis($no_temp='') {
		$no_temp_ln = strlen($no_temp);
		$query = "SELECT MAX(nis) as max_id FROM `ref_siswa` where SUBSTR(trim(nis),1,5) = '$no_temp'";
		$query = $this->db->query($query);
		
		$no = $query->row();
		
		if(!$no->max_id)
			$result = 0;
		else
			$result = substr($no->max_id, $no_temp_ln, 4);
		
		return (int)$result+1;
	}

}
