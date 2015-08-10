
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class siswa extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_siswa");
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
		$data['listsiswa'] = $this->model_siswa->getAllsiswa();
		$this->load->view('siswa/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	

	// Public function Delete($nis) 
	// {
	// 	if($this->session->userdata('login'))
 //        {
	// 	delete data yang ada pada table
	// 	$this->model_siswa->Deletesiswa($nis);
	// 	redirect('siswa');
	// 	}else{
	// 	redirect('welcome/relogin','refresh');	
	// 	}
	// }
	
	Public function FormUpdate($nis) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['listsiswaselect'] = $this->model_siswa->getAllsiswaselect($nis);
		$this->load->view('siswa/update', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Update() 
	{
		$name = $this->input->post ('name');
		$alamat = $this->input->post ('alamat');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$username = $this->input->post ('username');
		$password = $this->input->post ('password');
		
		if(empty($name) or empty($alamat) or empty($username) or empty($password) ){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{

		if($this->session->userdata('login'))
        {
		$nis = $this->input->post ('nis');
		$data = array(		
   		'name' => $this->input->post ('name'),
   		'alamat' => $this->input->post ('alamat'),
   		'jenis_kelamin' => $this->input->post ('jenis_kelamin'),
   		'username' => $this->input->post ('username'),
   		'password' => $this->input->post ('password')		
		);	
		$this->model_siswa->Updatesiswa($nis, $data);
		redirect('siswa');
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}


}