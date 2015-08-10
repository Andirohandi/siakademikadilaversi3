<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Level extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_level");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }
	public function index()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listlevel'] = $this->model_level->getAlllevel();
		$this->load->view('level/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}
	
	Public function Insert() 
	{
		if($this->session->userdata('login'))
        {
		//insert semua data yang ada pada table
		$data = array(
		//'id_level' => $this->input->post ('id_level'),
   		'nm_level' => $this->input->post ('nm_level'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_level->Insertlevel($data);

		redirect('level');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Delete($id_level) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_level->Deletetlevel($id_level);
		redirect('level');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function FormUpdate($id_level) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listlevelselect'] = $this->model_level->getAlllevelselect($id_level);
		$this->load->view('level/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Update() 
	{
		if($this->session->userdata('login'))
        {
		$id_level = $this->input->post ('id_level');
		$data = array(
		
   		'nm_level' => $this->input->post ('nm_level'),
		'active' => $this->input->post ('active')		
		);	
		$this->model_level->Updatelevel($id_level, $data);
		redirect('level');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}


}