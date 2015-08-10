<?php
	
	class Model_login extends CI_Model {
		
		function __construct()
		{
			parent::__construct();
		}
		
		function login($nisn, $password)
		{
            $this->load->database();
			
			$this -> db -> from('tr_pendaftaran');
			$this -> db -> where('nisn', $nisn);
			$this -> db -> where('password', $password);
			$this -> db -> where('active', 1);
			$this -> db -> limit(1);
			
			$query = $this -> db -> get();
			
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
		
		function login_guru($nisn, $password)
		{
            $this->load->database();
			
			$this -> db -> from('ref_guru');
			$this -> db -> where('id_guru', $nisn);
			$this -> db -> where('active', 1);
			$this -> db -> where('password', $password);
			$this -> db -> limit(1);
			
			$query = $this -> db -> get();
			
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
		
	}
?>