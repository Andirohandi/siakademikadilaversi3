<?php
	
	class Model_raport_siswa extends CI_Model  {
	

	function getAllnilai($nis) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		
		$this->db->select('a.id_mengajar, a.id_mapel, a.nis, a.latihan, a.uts, a.uas, b.id_mapel, b.nm_pelajaran as nm_pelajaran, e.nis, e.name');
		$this->db->from('tr_mengajar a');
		$this->db->join('ref_pelajaran b','a.id_mapel = b.id_mapel', 'left');
		
		
		$this->db->join('ref_siswa e','a.nis = e.nis','left');
		$this->db->where('e.nisn', $nis);
		
		return $this->db->get();
	}
	
    
	
	}
