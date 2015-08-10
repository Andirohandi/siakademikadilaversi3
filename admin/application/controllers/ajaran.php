<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ajaran extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_ajaran");
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
        $tahun = $session['tahun'];
        $status = 3;
		$data['tahun_ajaran'] = $this->model_ajaran->getAlltahun($status, $tahun);
		
		
		$this->load->view('ajaran/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	
	
	
	public function kelas($tahun)
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $kelas = $session['kelas'];
        
		$data['daftar_kelas'] = $this->model_ajaran->getlistkelas($tahun, $kelas);
		$this->load->view('ajaran/kelas', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	public function siswa($kelas, $tahun)
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        
		$data['siswa'] = $this->model_ajaran->getAllsiswasiswi($kelas, $tahun);
		$this->load->view('ajaran/siswa', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}

	public function rapot($nis)
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $status = 3;
		$data['kelas_tahun'] = $this->model_ajaran->getAllmengajar($nis);
		$this->load->view('ajaran/rapot', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	

	 


}