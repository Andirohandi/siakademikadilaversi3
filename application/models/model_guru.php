<?php
	
	class Model_guru extends CI_Model {
		
		function __construct()
		{
			parent::__construct();
		}
		
		function get_guru($arr = ""){
		   $this->load->database();
		   $this->db->select('*');
		   $this->db->from('ref_guru');
		   $this->db->where($arr);
		   $query = $this -> db -> get();
		 //  echo $this->db->last_query();
		   
			if($query -> num_rows() == 1)
			{
				$result = $query->result();
				return $result;
			}
			else
			{
				return false;
			}
		}
	function Updatenilai($id_mengajar, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_mengajar', $id_mengajar);
		$this->db->update('tr_mengajar', $data);
	}
	
	function updateDetailGuru($id, $data) 
	{
		//delete data yang ada pada table	
		$this->db->where('id_guru', $id);
		$this->db->update('ref_guru', $data);
	}
	
	}
?>
