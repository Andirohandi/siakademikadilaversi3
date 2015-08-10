<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_ajaran");
        $this->load->model("model_menu");
		$this->load->library(array('PHPExcel','PHPExcel/PHPExcel/IOFactory'));

    }
	public function index()
	{
		$thn = base64_decode($_GET['xYx']);
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['tahun_ajaran'] = $thn;
		$data['result'] = '';
        $tahun = $session['tahun'];
        $status = 3;
		
		$this->load->view('upload/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	
	}
	
	function do_upload()
	{
		$thn = base64_decode($_GET['xYz']);
		
		$this->db->trans_begin();
		
		if ($this->input->post('save')) {
                $fileName = $_FILES['import']['name'];
 
            $config['upload_path'] = './assets/files/';
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size']        = 10000;
 
            $this->load->library('upload');
            $this->upload->initialize($config);
 
            if(! $this->upload->do_upload('import') )
            $this->upload->display_errors();
 
            $media = $this->upload->data('import');
            $inputFileName = './assets/files/'.$media['file_name'];
 
            //  Read your Excel workbook
            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            //  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
 
            //  Loop through each row of the worksheet in turn
			
            for ($row = 17; $row <= $highestRow; $row++){
			//  Read a row of data into an array                 
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
               //  Insert row data array into your database of choice here
			   
			   $jk = $rowData[0][5];
			   $jen = "";
			   if($jk=="L")
			   {
					$jen = "Pria";
			   }elseif($jk=="P"){
					$jen = "Wanita";
			   }else{
					$jen = "";
			   }
                $data = array(
					"nis"=> '',
					"id_pendaftaran"=> '',
					"kelas"=> '',
					"name"=> $rowData[0][4],
					"username"=> '',
					"jenis_kelamin"=> $jen,
					"tempat_lahir"=> $rowData[0][8],
					"tanggal_lahir"=> $rowData[0][9],
					"alamat"=> $rowData[0][12],
					"tahun" => $thn,
					"active" => 0,
					"id_level" => 4
				);
				
                $query = $this->db->insert("ref_siswa",$data);
				
				/*if($query)
				{
					$hasil = 1;
				}else{
					$hasil = 0;
				}*/
            }
				// $this->db->trans_complete();
				
				if ($this->db->trans_status() === FALSE)
{
					$this->db->trans_rollback();
					$hasil = 0;
				}
				else
				{
					$this->db->trans_commit();
					$hasil = 1;
				}
            
        }
		$session = $this->session->userdata('login');
        $data['nm_user_last'] = $session['nm_user_last'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
		$data['tahun_ajaran'] = $thn;
        $tahun = $session['tahun'];
        $status = 3;
		$data['result'] = $hasil;
		
		
       $this->load->view('upload/index', $data);
	}
	
}