<?php
	
	class Model_nilai extends CI_Model  {
	

	function getAllmapelguru() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_pelajaran a");
		$this->db->join("ref_guru b", 'a.id_guru = b.id_guru','left');
		//$this->db->where ('a.id_guru',$id_guru);
	 
		return $this->db->get();
	}

	function getAllsiswa($id_mapel) 
	{
		$this->db->from("tr_mengajar a ");
		$this->db->join("ref_siswa b ", "a.nis = b.nis", "left");
		$this->db->join("ref_pelajaran c ", "c.id_mapel = a.id_mapel", "left");
		$this->db->where('a.id_mapel', $id_mapel);
		
	 
		return $this->db->get();
	}

	function comboboxguru() 
	{
		
		$this->db->from("ref_guru");
	 
		return $this->db->get();
	}

	function comboboxsiswa() 
	{
		
		$this->db->from("ref_siswa");
	 
		return $this->db->get();
	}

    function Insertmapel($data) 
    {
    	$this->db->insert('ref_pelajaran', $data);
    }

    function insertmengajarsiswa($data) 
    {
    	$this->db->insert('tr_mengajar', $data);
    }


     function Deletemapel($id_mapel) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_mapel', $id_mapel);
		$this->db->delete('ref_pelajaran');
	}

	function deletemengajarsiswa($id_mengajar) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_mengajar', $id_mengajar);
		$this->db->delete('tr_mengajar');
	}
	
	function getAllmapelselect($id_mapel) 
	{
	
		//select semua data yang ada pada table
		$this->db->from("ref_pelajaran");
	
		$this->db->where('id_mapel', $id_mapel); 
		return $this->db->get();
	}

	 function Updatemapel($id_mapel, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_mapel', $id_mapel);
		$this->db->update('ref_pelajaran', $data);
	}

	function Updatenilai($id_mengajar, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_mengajar', $id_mengajar);
		$this->db->update('tr_mengajar', $data);
	}

	}
