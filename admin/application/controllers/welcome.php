<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function index()
	{
        $data['alert'] = "";
		$this->load->view('login', $data);
		
		//jika seasson login belum sudah ada maka tampilkan home
            if($this->session->userdata('login'))
            {
                //jika seasson ada direct ke home
                redirect('home','refresh');
            }
	}
	
    public function logout(){    
        $this->session->unset_userdata('login');
        redirect('welcome','refresh');
    }

    public function relogin()
    {
        $data['alert'] = "Anda Harus Login Terlebih Dahulu";
        $this->load->view('login',$data);
        
        //jika seasson login belum sudah ada maka tampilkan home
            if($this->session->userdata('login'))
            {
                //jika seasson ada direct ke home
                redirect('home','refresh');
            }
    }

    public function faillogin()
    {
        $data['alert'] = "Username & Password tidak cocok ";
        $this->load->view('login',$data);
        
        //jika seasson login belum sudah ada maka tampilkan home
            if($this->session->userdata('login'))
            {
                //jika seasson ada direct ke home
                redirect('home','refresh');
            }
    }

  	
    
   
}