<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tahun_ajaran extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_tahun_ajaran");
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
        $status = 1;
		$data['tahun_ajaran'] = $this->model_tahun_ajaran->getAlltahun($status);
		$this->load->view('tahun_ajaran/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	public function rapot()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $status = 3;
		$data['kelas_tahun'] = $this->model_tahun_ajaran->getAllajaran($status);
		$this->load->view('tahun_ajaran/rapot', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	
	public function daftarkelas($tahun)
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $status = 3;
		$data['daftarkelas'] = $this->model_tahun_ajaran->getdaftarkelas($tahun);
		$this->load->view('tahun_ajaran/daftarkelas', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	public function siswa($kelas)
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        
		$data['siswa'] = $this->model_tahun_ajaran->getAllsiswa($kelas);
		$this->load->view('tahun_ajaran/siswa', $data);
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
		'kelas' => $this->input->post ('kelas'),
   		'kuota' => $this->input->post ('kuota'),
   		'tahun' => $this->input->post ('tahun'),
   		
   		'status' => 1	
		);	
		$this->model_tahun_ajaran->Inserttahun($data);

		redirect('tahun_ajaran');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	


	

	Public function Delete($id_tahun_ajaran) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_tahun_ajaran->Deletetahun($id_tahun_ajaran);
		redirect('tahun_ajaran');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	

	Public function close($id_tahun_ajaran) 
	{
		if($this->session->userdata('login'))
        {
		
		$data = array(
		'status' => 2		
		);	
		$this->model_tahun_ajaran->Updatetahun($id_tahun_ajaran, $data);
		redirect('tahun_ajaran');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	function cek_tahun()
	{
		$tahun = $_POST['tahun'];
		
		
		$query = $this->model_tahun_ajaran->cek_tahun($tahun);
		
		if($query->num_rows()>0)
		{
			$data = array(
				'rs'=> 1
			);
		}else{
		
			$data = array(
				'rs'=> 0
			);

		}
		
		echo json_encode($data);
	}


}