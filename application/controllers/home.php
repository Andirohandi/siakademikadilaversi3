<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_personal");
        
    }
    	public function index()
	{
		if($this->session->userdata('login'))
        {
		
		$session = $this->session->userdata('login');
        $data['name'] = $session['name'];
        $data['id_pendaftaran'] = $session['id_pendaftaran'];
        $data['nisn'] = $session['nisn'];
		$id_pendaftaran = $session['id_pendaftaran'];
		$data['datapersonal'] = $this->model_personal->getpersonal($id_pendaftaran);
		$this->load->view('home', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	public function data_personal()
	{
		if($this->session->userdata('login'))
        {
		
		$session = $this->session->userdata('login');
        $data['name'] = $session['name'];
        $data['id_pendaftaran'] = $session['id_pendaftaran'];
        $data['nisn'] = $session['nisn'];
        $id_pendaftaran = $session['id_pendaftaran'];
		$data['datapersonal'] = $this->model_personal->getpersonal($id_pendaftaran);
		$this->load->view('data_personal', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	public function kartu()
	{
		if($this->session->userdata('login'))
        {
		
		$session = $this->session->userdata('login');
        $data['name'] = $session['name'];
        $data['id_pendaftaran'] = $session['id_pendaftaran'];
        $data['nisn'] = $session['nisn'];
        $id_pendaftaran = $session['id_pendaftaran'];
		$data['datapersonal'] = $this->model_personal->getpersonal($id_pendaftaran);
		$this->load->view('kartu', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Update() 
	{
		$nisn = $this->input->post ('nisn');
		$name = $this->input->post ('nama');
		$asal_sekolah = $this->input->post ('asal_sekolah');
		$NUN = $this->input->post ('NUN');
		$no_ijazah = $this->input->post ('no_ijazah');
		$jenis_kelamin = $this->input->post ('jenis_kelamin');
		$password = $this->input->post ('password');
		
		if(empty($nisn) or empty($nama) or empty($asal_sekolah) or empty($NUN) or empty($no_ijasah) or empty($password) or empty($jenis_kelamin)){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{
		if($this->session->userdata('login'))
        {
		$id_pendaftaran = $this->input->post ('id_pendaftaran');
		$data = array(
		
   		'nama' => $this->input->post ('nama'),
   		'asal_sekolah' => $this->input->post ('asal_sekolah'),
   		'tempat_lahir' => $this->input->post ('tempat_lahir'),
   		'tanggal_lahir' => $this->input->post ('tanggal_lahir'),
   		'alamat' => $this->input->post ('alamat'),
   		'NUN' => $this->input->post ('NUN'),
   		'no_ijazah' => $this->input->post ('no_ijazah'),
   		'jenis_kelamin' => $this->input->post ('jenis_kelamin'),
   		'password' => $this->input->post ('password')
   		
		);	
		$this->model_personal->update($id_pendaftaran, $data);
		redirect('home/data_personal');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}
	
	


}