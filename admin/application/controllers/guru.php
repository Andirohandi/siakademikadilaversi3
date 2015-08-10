<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class guru extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_guru");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }
	public function index()
	{
		if($this->session->userdata('login'))
        {
		$this->load->model("model_menu");
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listguru'] = $this->model_guru->getAllguru();
		$this->load->view('guru/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function Insert() 
	{
		
		$id_guru = $this->input->post ('id_guru');
		$nm_guru = $this->input->post ('nm_guru');
		$alamat = $this->input->post ('alamat');
		$telp = $this->input->post ('telp');


        if(empty($id_guru) or empty($nm_guru) or empty($alamat) or empty($telp)){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{
		if($this->session->userdata('login'))
        {
		//insert semua data yang ada pada table
		$data = array(
		'id_guru' => $this->input->post ('id_guru'),
   		'nm_guru' => $this->input->post ('nm_guru'),
   		'alamat' => $this->input->post ('alamat'),
   		'telp' => $this->input->post ('telp'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_guru->Insertguru($data);

		redirect('guru');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}

	Public function Delete($id_guru) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_guru->Deleteguru($id_guru);
		redirect('guru');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function FormUpdate($id_guru) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listguruselect'] = $this->model_guru->getAllguruselect($id_guru);
		$this->load->view('guru/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Update() 
	{
		$id_guru = $this->input->post ('id_guru');
		$nm_guru = $this->input->post ('nm_guru');
		$alamat = $this->input->post ('alamat');
		$telp = $this->input->post ('telp');


        if(empty($id_guru) or empty($nm_guru) or empty($alamat) or empty($telp)){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{
		if($this->session->userdata('login'))
        {
		$id_guru = $this->input->post ('id_guru');
		$data = array(		
   		'nm_guru' => $this->input->post ('nm_guru'),
   		'alamat' => $this->input->post ('alamat'),
   		'telp' => $this->input->post ('telp'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_guru->Updateguru($id_guru, $data);
		redirect('guru');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}


}