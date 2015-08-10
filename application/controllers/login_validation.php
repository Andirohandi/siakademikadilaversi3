<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_validation extends CI_Controller {
    public function index()
    {
        // load library form validasi , agar login kita lebih aman
        $this->load->library('form_validation');

        $this->load->helper('url'); // digunakan untuk fungsi redirect di bawah

		if($_POST['status']=='siswa'){
			$this->form_validation->set_rules('nisn', 'nisn', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');
			
			if($this->form_validation->run() == FALSE)
			{

				redirect('login/faillogin','refresh');
			}else
			{
				redirect('login','refresh');

			}
		}else{
			$this->form_validation->set_rules('nisn', 'nisn', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');
			if($this->form_validation->run() == FALSE)
			{

				redirect('login','refresh');
			}else
			{
				redirect('guru','refresh');

			}
		}
    }

    function check_database()
    {
        $this->load->library('session');
        //validasi kedua dengan cara mengecek database
        $nisn = $this->input->post('nisn');
        $password = $this->input->post('password');

        //query ke database dan memanggil model m_login
        $this->load->model('model_login');
		$result = '';
		
		if($_POST['status']=='siswa'){
			$result = $this->model_login->login($nisn,$password);
			if($result)
			{
				foreach($result as $row)
				{
					$sess_array = array(
						'name'=> $row->name,
						'id_pendaftaran'=> $row->id_pendaftaran,
						'nisn' => $row->nisn,
						
					);

					$this->session->set_userdata('login', $sess_array);
				}
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}else{
			$result = $this->model_login->login_guru($nisn,$password);
			if($result)
			{
			 $this->session->unset_userdata('login_guru');
				foreach($result as $row)
				{
				
					$sess_array = array(
						'id_guru'=> $row->id_guru,
						'nmguru'=> trim($row->nm_guru),
						'alamat' => $row->alamat,
						'photo'	=> $row->photo,
						'tlp'	=> $row->telp
					);
					$this->session->set_userdata('login_guru',$sess_array);	  
				//	echo $row->id_guru;
				//	$ar = array(login_guru);
				//	echo $this->session->userdata('id_guru');
				//	exit;
				//	$this->session->set_userdata('login_guru', $sess_array);
				}
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
        //jika hasilnya ada pada maka masukan ke season field nama dan username dengan nama season : login
        
    }
	
	
}
