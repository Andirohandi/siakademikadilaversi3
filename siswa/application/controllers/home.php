<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	 function __construct(){
        parent::__construct();
      $this->load->model("model_home");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }
	public function index()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        
        $data['nis'] = $session['nis'];
        $nis = $session['nis'];
        $data['nis'] = $nis;
        
		$data['listnilai'] = $this->model_home->getAllnilai($nis);
		$this->load->view('home', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}
	
	


}