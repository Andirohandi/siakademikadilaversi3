<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();

        $this->load->model("model_daftar");
    
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function daftar()
	{
		$nisn = $this->input->post ('nisn');
		$name = $this->input->post ('nama');
		$asal_sekolah = $this->input->post ('asal_sekolah');
		$NUN = $this->input->post ('NUN');
		$no_ijazah = $this->input->post ('no_ijazah');
		$jenis_kelamin = $this->input->post ('jenis_kelamin');
		
		if(empty($nisn) or empty($name) or empty($asal_sekolah) or empty($NUN) or empty($no_ijazah) or empty($jenis_kelamin) ){
            echo "<script>alert('Data Belum Lengkap');window.location.href='javascript:history.back(-1);'</script>";
            }else{
		$nisn = $this->input->post ('nisn');
		$pendaftar = $this->model_daftar->ceknisn($nisn);
		if($pendaftar['nisn'] != $nisn){
			
		$data = array(
		'nisn' => $this->input->post ('nisn'),
   		'name' => $this->input->post ('nama'),
   		'asal_sekolah' => $this->input->post ('asal_sekolah'),
   		'NUN' => $this->input->post ('NUN'),
   		'no_ijazah' => $this->input->post ('no_ijazah'),
   		'jenis_kelamin' => $this->input->post ('jenis_kelamin')	
		);	
		$this->model_daftar->pendaftaran($data);


			echo "<script>alert('NISN Berhasil Di daftarkan, Harap melakukan verifikasi dokumen kesekolah');window.location.href='../welcome'</script>";
		}else{
			echo "<script>alert('NISN Sudah terdaftar');window.location.href='javascript:history.back(-1);'</script>";
		}}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */