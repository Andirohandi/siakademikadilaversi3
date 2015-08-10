<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class nilai extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_nilai");
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
		$id_guru = $session['id_user'];

		$data['id_guru'] = $id_guru;
        $data['session_level'] = $session['id_level'];
		
 
		$data['listmapelguru'] = $this->model_nilai->getAllmapelguru();
		$this->load->view('nilai/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	public function siswa()
	{
		$id_mapel = $_GET['id'];
		if($this->session->userdata('login'))
        {
		$this->load->model("model_menu");
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        
        
		$data['listsiswa'] = $this->model_nilai->getAllsiswa($id_mapel);
		$this->load->view('nilai/siswa', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	

	
	Public function Updatedataulangan() 
	{
		if($this->session->userdata('login'))
        {
		$id_mengajar = $this->input->post ('id_mengajar');
		$id_mapel = $this->input->post ('id_mapel');
		$data = array(		
   		'latihan' => $this->input->post ('n_latihan'),
   		'uts' => $this->input->post ('n_uts'),
   		'uas' => $this->input->post ('n_uas')	
		);	
		$this->model_nilai->Updatenilai($id_mengajar, $data);
		redirect('nilai/siswa/'.$id_mapel);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
}