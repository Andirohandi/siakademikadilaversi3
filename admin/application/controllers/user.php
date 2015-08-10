<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	
	 function __construct(){
        parent::__construct();
        $this->load->model("model_user");
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
		
		
		$data['combobox_level'] = $this->model_user->combobox_level();
		$data['listuser'] = $this->model_user->getAllUser();
		$this->load->view('user/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}
	
	Public function Insert() 
	{
		$id_user = $this->input->post ('id_user');
		$nm_user_first = $this->input->post ('nm_user_first');
		$nm_user_last = $this->input->post ('nm_user_last');
		$username = $this->input->post ('username');
		$password = $this->input->post ('password');
		


        if(empty($id_user) or empty($nm_user_last) or empty($nm_user_first) or empty($username) or empty($password)){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{

		if($this->session->userdata('login'))
        {
		//insert semua data yang ada pada table
		$data = array(
		'id_user' => $this->input->post ('id_user'),
   		'nm_user_first' => $this->input->post ('nm_user_first'),
   		'nm_user_last' => $this->input->post ('nm_user_last'),
   		'username' => $this->input->post ('username'),
   		'password' => $this->input->post ('password'),
   		'id_level' => $this->input->post ('id_level'),
   		'tahun' => $this->input->post ('tahun'),
   		'kelas' => $this->input->post ('kelas'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_user->InsertUser($data);

		redirect('user');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}
	
	

	Public function Delete($id_user) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_user->DeletetUser($id_user);
		redirect('user');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function FormUpdate($id_user) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		
		$data['combobox_level'] = $this->model_user->combobox_level();
		$data['listuserselect'] = $this->model_user->getAllUserselect($id_user);
		$this->load->view('user/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}

	Public function Update() 
	{
			$id_user = $this->input->post ('id_user');
		$nm_user_first = $this->input->post ('nm_user_first');
		$nm_user_last = $this->input->post ('nm_user_last');
		$username = $this->input->post ('username','admin');
		$password = $this->input->post ('password','admin');
		


        if(empty($id_user) or empty($nm_user_last) or empty($nm_user_first) or empty($username) or empty($password)){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{
		if($this->session->userdata('login'))
        {
		$id_user = $this->input->post ('id_user');
		$data = array(
		
   		'id_user' => $this->input->post ('id_user'),
   		'nm_user_first' => $this->input->post ('nm_user_first'),
   		'nm_user_last' => $this->input->post ('nm_user_last'),
   		'username' => $this->input->post ('username'),
   		'password' => $this->input->post ('password'),
   		'tahun' => $this->input->post ('tahun'),
   		'kelas' => $this->input->post ('kelas'),
   		'id_level' => $this->input->post ('id_level'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_user->UpdateUser($id_user, $data);
		redirect('user');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}


}