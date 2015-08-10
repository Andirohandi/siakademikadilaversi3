<?php
	
	class Model_siswa extends CI_Model  {
	

	function getAllsiswa() 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_siswa a");
		$this->db->join("ref_kelas b", "a.kelas = b.id_kelas","left");
		$this->db->where("a.active",1);
		return $this->db->get();
	}

    function Insertsiswa($data) 
    {
    	$this->db->insert('ref_siswa', $data);
    }

     function Deletesiswa($nis) 
	{
		//delete data yang ada pada table	
		$this->db->where('nis', $nis);
		$this->db->delete('ref_siswa');
	}
	
	function getAllsiswaselect($nis) 
	{
	
		//select semua data yang ada pada table
		$this->db->from("ref_siswa");
	
		$this->db->where('nis', $nis); 
		return $this->db->get();
	}

	 function Updatesiswa($nis, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('nis', $nis);
		$this->db->update('ref_siswa', $data);
	}

	}
