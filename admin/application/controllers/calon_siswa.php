<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calon_siswa extends CI_Controller {
     function __construct(){
        parent::__construct();
        $this->load->model("model_calon_siswa");
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
       
        $data['listcalonsiswa'] = $this->model_calon_siswa->getAllcalonsiswa();
        $this->load->view('calon_siswa/index', $data);
        }else{
        redirect('welcome/relogin','refresh');  
        }
    }
    
    
    Public function update() 
    {
       

        if($this->session->userdata('login'))
        {
        //insert semua data yang ada pada table
        $id_pendaftaran = $this->input->post ('id_pendaftaran');

        $data = array(
        'nilai' => $this->input->post ('nilai'),
        'active' => $this->input->post ('active')
        );  
        $this->model_calon_siswa->updatecalonsiswa($id_pendaftaran, $data);

        redirect('calon_siswa');
        }else{
        redirect('welcome/relogin','refresh');  
        }
    
    }

	public function detail_calon()
    {
		$thn = $_GET['thn'];
        if($this->session->userdata('login'))
        {
        $this->load->model("model_menu");
        $session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $data['tahun'] = $thn;
        $data['listcalonsiswa'] = $this->model_calon_siswa->getAllcalonsiswa($thn);
        $this->load->view('calon_siswa/index', $data);
        }else{
        redirect('welcome/relogin','refresh');  
        }
    }
   
   public function update_go()
    {
		$id = $_GET['id'];
		
        if($this->session->userdata('login'))
        {
        $this->load->model("model_menu");
        $session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $data['tahun'] = $id;
        $data['listcalonsiswa'] = $this->model_calon_siswa->getCalonSiswa($id);
        $this->load->view('calon_siswa/update', $data);
        }else{
        redirect('welcome/relogin','refresh');  
        }
    }

	Public function update_calon() 
	{
		$name = $this->input->post ('name');
		$alamat = $this->input->post ('alamat');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tempat_lahir = $this->input->post ('tempat_lahir');
		$tanggal_lahir = $this->input->post ('tanggal_lahir');
		$tahun = $this->input->post ('tahun');
		
		if(empty($name) or empty($alamat) or empty($tempat_lahir) or empty($tanggal_lahir) ){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{

		if($this->session->userdata('login'))
        {
		$id_pendaftaran = $this->input->post ('id_pendaftaran');
		$data = array(		
   		'name' => $name,
   		'alamat' => $alamat,
   		'jenis_kelamin' => $jenis_kelamin,
   		'tempat_lahir' => $tempat_lahir,
   		'tanggal_lahir' => $tanggal_lahir		
		);	
		$this->model_calon_siswa->updatecalonsiswa($id_pendaftaran, $data);
		redirect('calon_siswa/detail_calon?thn='.$tahun);
		}else{
		redirect('welcome/relogin','refresh');	
		}}
	}
	
	public function delete_go()
    {
		$id_pendaftaran = $_GET['id'];
		$tahun = $_GET['tahun'];
		$this->model_calon_siswa->deletetecalonsiswa($id_pendaftaran);
		redirect('calon_siswa/detail_calon?thn='.$tahun);
    }
   

    

}