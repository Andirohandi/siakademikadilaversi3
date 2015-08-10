<?php
	//File products_model.php
	class Model_tahun_ajaran extends CI_Model  {
	

	function getAlltahun($status) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->where('status', $status);
		$this->db->from("tr_tahun_ajaran");
	 
		return $this->db->get();
	}

	function getAllajaran($status) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("tr_tahun_ajaran");
		$this->db->where('status', $status);
		
	 
		return $this->db->get();
	}
	
	function getdaftarkelas($tahun) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		$this->db->from("ref_siswa");
		$this->db->where('tahun', $tahun);
		$this->db->group_by('kelas');
		
	 
		return $this->db->get();
	}
	
	function getAllsiswa($kelas) 
	{
		// Variable pendukung query	
	
		//select semua data yang ada pada table
		
		$this->db->select('a.nis, a.name, a.kelas, a.tahun, a.gender, a.tanggal_lahir, b.id_tahun_ajaran, b.kelas, b.tahun');
		$this->db->from('ref_siswa a');
		$this->db->join('tr_tahun_ajaran b', 'a.tahun = b.tahun','left');
		$this->db->where('a.tahun = b.tahun');
		$this->db->group_by('a.kelas');
	 
		return $this->db->get();
	}
	
    function Inserttahun($data) 
    {
    	$this->db->insert('tr_tahun_ajaran', $data);
    }

     function Deletetahun($id_tahun_ajaran) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_tahun_ajaran', $id_tahun_ajaran);
		$this->db->delete('tr_tahun_ajaran');
	}
	
	function Updatetahun($id_tahun_ajaran, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_tahun_ajaran', $id_tahun_ajaran);
		$this->db->update('tr_tahun_ajaran', $data);
	}

	function cek_tahun($tahun)
	{
		$this->db->where('tahun', $tahun);
		$this->db->from("tr_tahun_ajaran");
		return $this->db->get();
	}

}
