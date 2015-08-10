<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class kelas extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_kelas");
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
		$data['listkelas'] = $this->model_kelas->getAllkelas();
		
		$this->load->view('kelas/index', $data);
		}else{ 
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function Insert() 
	{
		$id_kelas = $this->input->post ('id_kelas');
		$nm_kelas = $this->input->post ('nm_kelas');
		$tingkat = $this->input->post ('tingkat');
		
		if(empty($id_kelas) or empty($nm_kelas) or empty($tingkat) ){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{
		if($this->session->userdata('login'))
        {
		//insert semua data yang ada pada table
		$data = array(
		'id_kelas' => $this->input->post ('id_kelas'),
   		'nm_kelas' => $this->input->post ('nm_kelas'),
   		'tingkat' => $this->input->post ('tingkat'),
		);	
		$this->model_kelas->Insertkelas($data);

		redirect('kelas');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}

	Public function Delete($id_kelas) 
	{
		if($this->session->userdata('login'))
        {
		//delete data yang ada pada table
		$this->model_kelas->Deletekelas($id_kelas);
		redirect('kelas');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function siswa_kelas($id_kelas) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listsiswakelas'] = $this->model_kelas->getAllsiswakelas($id_kelas);
		$data['combobox_kelas'] = $this->model_kelas->combobox_kelas();
		$this->load->view('kelas/siswa_kelas', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	Public function FormUpdate($id_kelas) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listkelasselect'] = $this->model_kelas->getAllkelasselect($id_kelas);
		$this->load->view('kelas/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	
	Public function FormUpdatesiswa($nis) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listsiswasselect'] = $this->model_kelas->getAllsiswaselect($nis);
		$this->load->view('kelas/updatesiswa', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Updatesiswa() 
	{
		if($this->session->userdata('login'))
        {
		$nisn = $this->input->post ('nis');
		$data = array(		
   		
   		'kelas' => $this->input->post ('kelas')
		);	
		$this->model_kelas->Updatesiswa($nis, $data);
		redirect('siswa_kelas');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	


}