<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Level_menu_access extends CI_Controller {
	 function __construct(){
        parent::__construct(); 
        $this->load->model("model_level_menu_access");
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

		$data['combo_menu_level'] = $this->model_level_menu_access->combobox_menu_level();
		$data['combo_menu_details'] = $this->model_level_menu_access->combobox_menu_details();
		$data['level_menu_access'] = $this->model_level_menu_access->getAlllevel_menu_access();
		$this->load->view('level_menu_access/index', $data);
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
		
   		'id_level' => $this->input->post ('id_level'),
		'id_menu_details' => $this->input->post ('id_menu_details'),
		'active' => $this->input->post ('active')
			
		);	
		$this->model_level_menu_access->Insertlevel_menu_access($data);

		redirect('level_menu_access');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Delete($id_level_menu_access) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_level_menu_access->Deletetlevel_menu_access($id_level_menu_access);
		redirect('level_menu_access');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function formupdate($id_level_menu_access) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['combo_menu_level'] = $this->model_level_menu_access->combobox_menu_level();
		$data['combo_menu_details'] = $this->model_level_menu_access->combobox_menu_details();
		$data['listlevel_menu_accessselect'] = $this->model_level_menu_access->getAlllevel_menu_accessselect($id_level_menu_access);
		$this->load->view('level_menu_access/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Update() 
	{
		if($this->session->userdata('login'))
        {
		$id_level_menu_access = $this->input->post ('id_level_menu_access');
		$data = array(
		
   		'id_level' => $this->input->post ('id_level'),
		'id_menu_details' => $this->input->post ('id_menu_details'),
		'active' => $this->input->post ('active')
		);	
		$this->model_level_menu_access->Updatelevel_menu_access($id_level_menu_access, $data);
		redirect('level_menu_access');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}


}