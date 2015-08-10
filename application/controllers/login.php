<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
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
        redirect('login','refresh');
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
        $data['alert'] = "Username & Password tidak cocok atau anda belum melakukan aktivasi ";
        $this->load->view('login',$data);
        
        //jika seasson login belum sudah ada maka tampilkan home
            if($this->session->userdata('login'))
            {
                //jika seasson ada direct ke home
                redirect('home','refresh');
            }
    }

  	
    
   
}