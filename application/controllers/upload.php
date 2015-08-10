<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		
		if($this->session->userdata('login'))
        {
		
		$session = $this->session->userdata('login');
       
        $data['name'] = $session['name'];
        $data['id_pendaftaran'] = $session['id_pendaftaran'];
        $data['nisn'] = $session['nisn'];
		$data['error'] = '';
		$this->load->view('upload_form', $data);

		}else{
		redirect('welcome/relogin','refresh');	
		}
	}


	function do_upload()
	{
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '4000';
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		$session = $this->session->userdata('login');
		$type = $this->input->post ('type');
		$nisn = $session['nisn'];
		$config['file_name']  = $type.$nisn;
		$config['overwrite']  = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			echo "<script type='text/javascript'>alert('upload failed');window.history.back();</script>";
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			redirect('home/data_personal');
		}
	}


	
}
?>