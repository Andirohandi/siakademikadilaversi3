<?php
	//File products_model.php
	class Model_ajaran extends CI_Model  {
	

	function getAlltahun($status, $tahun) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status', $status);
		$this->db->where('tahun', $tahun);
		$this->db->from("tr_tahun_ajaran");
	 
		return $this->db->get();
	}

	
	
	function getlistkelas($tahun, $kelas) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_siswa");
		$this->db->where('tahun', $tahun);
		$this->db->where('kelas', $kelas);
		$this->db->group_by('kelas');
		
	 
		return $this->db->get();
	}
	
	function getAllsiswasiswi($kelas, $tahun) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_siswa a");
		$this->db->where('a.kelas', $kelas);
		$this->db->where('a.tahun', $tahun);
	
		return $this->db->get();
	}
	
   function getAllmengajar($nis) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("tr_mengajar a ");
		$this->db->join("ref_siswa b ", "a.nis = b.nis", "left");
		$this->db->join("ref_pelajaran c ", "c.id_mapel = a.id_mapel", "left");
		$this->db->where('a.nis', $nis);
	
		
	 
		return $this->db->get();
	}
	

	}
