<?php
	
	class Model_kelas extends CI_Model  {
	

	function getAllkelas() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_kelas");
	 
		return $this->db->get();
	}
	
	function getAllsiswakelas($id_kelas) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->select('a.nis, a.name, a.kelas, a.jenis_kelamin, b.id_kelas, b.nm_kelas as nm_kelas');
		$this->db->from('ref_siswa a');
		$this->db->join('ref_kelas b','a.kelas = b.id_kelas', 'left');
		$this->db->where('a.kelas ', $id_kelas);
	 
		return $this->db->get();
	}

    function Insertkelas($data) 
    {
    	$this->db->insert('ref_kelas', $data);
    }

     function Deletekelas($id_kelas) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_kelas', $id_kelas);
		$this->db->delete('ref_kelas');
	}
	
	function getAllkelasselect($id_kelas) 
	{
	
		//select semua data yang ada pada table
		$this->db->from("ref_kelas");
	
		$this->db->where('id_kelas', $id_kelas); 
		return $this->db->get();
	}
	
	function getAllsiswaselect($nis) 
	{
	
		//select semua data yang ada pada table
		$this->db->from("ref_siswa");
	
		$this->db->where('nis', $nis); 
		return $this->db->get();
	}

	 function Updatekelas($id_kelas, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_kelas', $id_kelas);
		$this->db->update('ref_kelas', $data);
	}

	function Updatesiswa($nis, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('nis', $nis);
		$this->db->update('ref_siswa', $data);
	}
	
	function combobox_kelas() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_kelas");
	 
		return $this->db->get();
	}
	
	}
