<?php
	
	class Model_nilai extends CI_Model  {
	

	function getAllmapelguru($id_guru) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_pelajaran a");
		$this->db->join("ref_guru b", 'a.id_guru = b.id_guru','left');
		$this->db->where ('a.id_guru',$id_guru);
	 
		return $this->db->get();
	}

	function getAllsiswa() 
	{
	
		//$this->db->from("ref_siswa a ");
		//$this->db->join("tr_mengajar b ", "b.nis = a.nis", "left");
		//$this->db->join("ref_pelajaran c ", "c.id_mapel = b.id_mapel", "join");
		//$this->db->where('a.id_mapel', $id_mapel);
	//	echo $this->db->last_query();
	//	exit;
	 
		return $this->db->query("SELECT a.*, b.*, a.nis as nis_s FROM ref_siswa a LEFT JOIN tr_mengajar b ON a.nis=b.nis");
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
	
	function Insertnilai($data) 
	{
		//delete data yang ada pada table
		$this->db->insert('tr_mengajar', $data);
	}
	
	function cek_nilai($id_mengajar)
	{
		$this->db->from("tr_mengajar");
		$this->db->where('id_mengajar',$id_mengajar);
		
		return $this->db->get();
	}

}
