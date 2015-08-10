<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class mapel extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_mapel");
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
        $data['combobox_guru'] = $this->model_mapel->comboboxguru();
		$data['listmapel'] = $this->model_mapel->getAllmapel();
		$this->load->view('mapel/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	public function siswa($id_mapel)
	{
		if($this->session->userdata('login'))
        {
		$this->load->model("model_menu");
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $data['id_mapel'] = $id_mapel;
        $data['combobox_siswa'] = $this->model_mapel->comboboxsiswa();
		$data['listsiswa'] = $this->model_mapel->getAllsiswa($id_mapel);
		$this->load->view('mapel/siswa', $data);
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
		
   		'nm_pelajaran' => $this->input->post ('nm_pelajaran'),
   		'id_guru' => $this->input->post ('id_guru'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_mapel->Insertmapel($data);

		redirect('mapel');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function insertmengajar() 
	{
		if($this->session->userdata('login'))
        {
		//insert semua data yang ada pada table
        $id_mapel = $this->input->post ('id_mapel');
		$data = array(
		
   		'nis' => $this->input->post ('nis'),
   		'id_mapel' => $this->input->post ('id_mapel'),
   		
		);	
		$this->model_mapel->insertmengajarsiswa($data);

		redirect('mapel/siswa/'.$id_mapel);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Delete($id_mapel) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_mapel->Deletemapel($id_mapel);
		redirect('mapel');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function deletemengajar($id_mengajar, $id_mapel) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_mapel->deletemengajarsiswa($id_mengajar);
		redirect('mapel/siswa/'.$id_mapel);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function FormUpdate($id_mapel) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $data['combobox_guru'] = $this->model_mapel->comboboxguru();
		$data['listmapelselect'] = $this->model_mapel->getAllmapelselect($id_mapel);
		$this->load->view('mapel/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Update() 
	{
		if($this->session->userdata('login'))
        {
		$id_mapel = $this->input->post ('id_mapel');
		$data = array(		
   		'nm_pelajaran' => $this->input->post ('nm_pelajaran'),
   		'id_guru' => $this->input->post ('id_guru'),
   		'active' => $this->input->post ('active')	
		);	
		$this->model_mapel->Updatemapel($id_mapel, $data);
		redirect('mapel');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}


	Public function Updatedataulangan() 
	{
		if($this->session->userdata('login'))
        {
		$id_mengajar = $this->input->post ('id_mengajar');
		$data = array(		
   		'latihan' => $this->input->post ('n_latihan'),
   		'uts' => $this->input->post ('n_uts'),
   		'uas' => $this->input->post ('n_uas')	
		);	
		$this->model_mapel->Updatenilai($id_mengajar, $data);
		redirect('mapel');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
}