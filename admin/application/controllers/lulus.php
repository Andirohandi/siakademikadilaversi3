<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lulus extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_lulus");
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
        $status = 2;
		$data['tahunajaran'] = $this->model_lulus->getAlllulus($status);
		$this->load->view('lulus/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}

	public function detail($tahun)
    {
        if($this->session->userdata('login'))
        {
        $this->load->model("model_menu");
        $session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
       
        $data['listcalonsiswa'] = $this->model_lulus->getAllcalonsiswa($tahun);
        $this->load->view('lulus/detail_siswa', $data);
        }else{
        redirect('welcome/relogin','refresh');  
        }
    }

    public function tidak()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $status = 2;
		$data['tahunajaran'] = $this->model_lulus->getAlltidak($status);
		$this->load->view('lulus/tidak', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}
	public function detail_tidak($tahun)
    {
        if($this->session->userdata('login'))
        {
        $this->load->model("model_menu");
        $session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
       
        $data['listcalonsiswa'] = $this->model_lulus->getAllcalonsiswatidak($tahun);
        $this->load->view('lulus/detail_siswa_tidak', $data);
        }else{
        redirect('welcome/relogin','refresh');  
        }
    }
	
	public function lulus()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $status = 2;
		$data['tahunajaran'] = $this->model_lulus->getAlllus($status);
		$this->load->view('lulus/lulus', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}

	public function detail_lulus()
    {
		$thn = $_GET['thn'];
        if($this->session->userdata('login'))
        {
        $this->load->model("model_menu");
        $session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
       
        $data['listcalonsiswa'] = $this->model_lulus->getAllcalonsiswa($thn);
        $this->load->view('lulus/detail_siswa_lulus', $data);
        }else{
        redirect('welcome/relogin','refresh');  
        }
    }
	
	public function generate($id_tahun_ajaran, $tahun) 
	{	
		$this->load->model('model_kelas');
		
		if($this->session->userdata('login'))
        {
		
		//get kelas where tingkat = 1
		$kelas = $this->model_kelas->getAllkelas(array('tingkat' => 1));		
		$array_abjad = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'
								, 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X'
								, 'Y', 'Z');	
									
		$id_pendaftaran = array();
		
		$tahun_ajaran_1 = substr($tahun, 2, 2);
		$tahun_ajaran_2 = $tahun_ajaran_1 + 1;
		
		$this->db->trans_begin();
		
		// get the abjad
		for($i=0; $i<count($array_abjad); $i++) {
			// get siswa berdasarkan abjad
			$siswa = $this->model_lulus->getAllcalonsiswa($tahun, "UPPER(SUBSTR(TRIM(`name`), 1, 1)) = '$array_abjad[$i]' AND kelas = 0");
			
			if($siswa->num_rows > 0) {							
				$j = 0;
				
				foreach($siswa->result() as $det) {					
					$id_pendaftaran[$j] = $det->id_pendaftaran;
					$j++;
				}
			}
			
			if(count($id_pendaftaran) > 0) {
				if($kelas->num_rows() > 0) {
					$jml_siswa = $siswa->num_rows();					
					$k = 0;
					
					back:
					$jml_kelas = $kelas->num_rows();
					
					foreach($kelas->result_array() as $row) {						
						if($jml_siswa > 0) {
							$nis_temp = $this->model_lulus->get_nis($tahun_ajaran_1.$tahun_ajaran_2.'7');							
							$nis = $tahun_ajaran_1.$tahun_ajaran_2.'7'.substr('0000', 0, 4-strlen($nis_temp)).$nis_temp;
							
							$this->db->update('ref_siswa', array('kelas' => $row['id_kelas'], 'active' => 1, 'nis' => $nis, 'username' => $nis, 'password' => 12345), array('id_pendaftaran' => $id_pendaftaran[$k]));							
						} else {
							goto escape;
						}					
						
						$k++;
						$jml_siswa--;
						$jml_kelas--;
						
						if($jml_siswa > 0 && $jml_kelas == 0)
							goto back;
					}
				}
			}
			escape:
		}
			
		$data = array(
		'status' => 3	
		);	
		
		$this->model_lulus->Updatelulus($id_tahun_ajaran, $data);
		
		if($this->db->trans_status() === true) {
			$this->db->trans_commit();			
		} else {
			$this->db->trans_rollback();
		}
		
		redirect('lulus');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	public function reg($id_pendaftaran) 
	{
		if($this->session->userdata('login'))
        {
		
		$data = array(
		'reg' => 1		
		);	
		$this->model_lulus->Updatereg($id_pendaftaran, $data);
		redirect('lulus');
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}



}