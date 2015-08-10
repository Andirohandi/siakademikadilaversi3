<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Guru extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->library('session');
		$this->load->model('model_guru');
		$this->load->model('model_nilai');
    }
	
    public function index()
	{	
		if($this->session->userdata('login_guru')){
		$session = $this->session->userdata('login_guru');
		$where['id_guru'] = $session['id_guru'];
		$select_guru = $this->model_guru->get_guru($where);
		$nm_gru = "";
		$alamat = "";
		$ph ="";
		foreach($select_guru as $guru){
			$nm_gru = $guru->nm_guru;
			$alamat = $guru->alamat;
			$ph = $guru->photo;
		}
			$data = array(
				'content'	=> 'guru/index',
				'alamat'  => $alamat,
				'nm_guru' => $nm_gru,
				'photo'	=>$ph
			);
			//echo $this->session->userdata('nama_guru');
		
			$this->load->view($data['content'], $data);
		}else{
		echo "gagal seassion";
		}
	
	}
	public function siswa($id_mapel)
	{
		if($this->session->userdata('login_guru'))
        {
		//$this->load->model("model_menu");
		$session = $this->session->userdata('login_guru');
		$where['id_guru'] = $session['id_guru'];
		$select_guru = $this->model_guru->get_guru($where);
		$nm_gru = "";
		$alamat = "";
		$ph ="";
		foreach($select_guru as $guru){
			$nm_gru = $guru->nm_guru;
			$alamat = $guru->alamat;
			$ph = $guru->photo;
		}
        $data['nm_guru'] = $nm_gru;
        $data['alamat'] = $alamat;
		$data['photo'] = $ph;
        $data['id_mapel'] = $id_mapel;
        
		$data['listsiswa'] = $this->model_nilai->getAllsiswa();
		//echo $this->db->last_query();
		//exit;
		$this->load->view('guru/siswa', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	function update_guru(){
		if($this->session->userdata('login_guru'))
        {
			$session = $this->session->userdata('login_guru');
			$id = $session['id_guru'];
			$data['NAMA'] = $this->input->post();
			$data['telp'] = $this->input->post();
			$data['alamat'] = $this->input->post();
			
			
			$this->load->view($data['content'], $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	Public function Updatedataulangan() 
	{
		if($this->session->userdata('login_guru'))
        {
		$id_mengajar = $this->input->post ('id_mengajar');
		$id_mapel = $this->input->post ('id_mapel');
		$nis = $this->input->post('nis');
		
		
		
		//cek update atau delet
		$query = $this->model_nilai->cek_nilai($id_mengajar);
		
		if($query->num_rows > 0)
		{
			$data = array(		
			'latihan' => $this->input->post ('n_latihan'),
			'uts' => $this->input->post ('n_uts'),
			'uas' => $this->input->post ('n_uas')	
			);
			$this->model_nilai->Updatenilai($id_mengajar, $data);
			
		}else{
			
			$data = array(		
			'id_mapel' => $id_mapel,
			'nis' => $nis,
			'latihan' => $this->input->post ('n_latihan'),
			'uts' => $this->input->post ('n_uts'),
			'uas' => $this->input->post ('n_uas')	
			);
			
			$this->model_nilai->Insertnilai($data);
			
		}
		redirect('guru/siswa/'.$id_mapel);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	function nilai(){
			
		if($this->session->userdata('login_guru'))
        {
		//$this->load->model("model_menu");
		
       	$session = $this->session->userdata('login_guru');
		$where['id_guru'] = $session['id_guru'];
		$select_guru = $this->model_guru->get_guru($where);
		$nm_gru = "";
		$alamat = "";
		$ph ="";
		foreach($select_guru as $guru){
			$nm_gru = $guru->nm_guru;
			$alamat = $guru->alamat;
			$ph = $guru->photo;
		}
        $data['nm_guru'] = $nm_gru;
        $data['alamat'] = $alamat;
		$data['photo'] = $ph;
		$id_guru = $session['id_guru'];

		$data['id_guru'] = $id_guru;
      //  $data['session_level'] = $session['id_level'];
		
 
		$data['listmapelguru'] = $this->model_nilai->getAllmapelguru($id_guru);
		$this->load->view('guru/nilai', $data);
		
		//$this->load->view('nilai/index', $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	function profile(){
		if($this->session->userdata('login_guru'))
        {
		$session = $this->session->userdata('login_guru');
		$where['id_guru'] = $session['id_guru'];
		$select_guru = $this->model_guru->get_guru($where);
		$nm_gru = "";
		$alamat = "";
		$ph ="";
		foreach($select_guru as $guru){
			$nm_gru = $guru->nm_guru;
			$alamat = $guru->alamat;
			$ph = $guru->photo;
			$tp = $guru->telp;
		}
        $data['nm_guru'] = $nm_gru;
        $data['id_guru'] = $session['id_guru'];
        $data['alamat'] = $alamat;
		$data['photo'] = $ph;
		$data['tlp'] = $tp;
		$data['report'] = 0;
		
		$id_guru = $session['id_guru'];
		
		$data['content'] = 'guru/profile';
			$this->load->view($data['content'], $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	function updateDetail(){
		
		$id = $this->input->post('id_guru');
		$nm = $this->input->post('nm_guru');
		$almt = $this->input->post('alamat');
		$telp = $this->input->post('tlp');
		
		$folder = "assets/img/guru/";
		
		if(!empty($_FILES['image']['tmp_name'])){
		
			$jns_gmb = $_FILES['image']['type'];
		
			if($jns_gmb=="image/jpeg" || $jns_gmb=="image/jpg" || $jns_gmb=="image/gif" || $jns_gmb=="image/x-png"){
				$nm_gmbr = $_FILES['image']['name'];
				$gambar = $folder . basename($_FILES['image']['name']);
				if(move_uploaded_file($_FILES['image']['tmp_name'], $gambar)){
					$dt = array (
						'nm_guru' => $nm,
						'telp' => $telp,
						'alamat' => $almt,
						'photo' => $nm_gmbr
					);
					
					$this->model_guru->updateDetailGuru($id,$dt);

				}else{
					"Gambar Gagal Dikirim";
				
				}
			}else{
				echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
			}
		}else{
			$dt = array (
				'nm_guru' => $nm,
				'telp' => $telp,
				'alamat' => $almt
			);
			
			$this->model_guru->updateDetailGuru($id,$dt);
		}
		if($this->session->userdata('login_guru'))
        {
		$session = $this->session->userdata('login_guru');
		$where['id_guru'] = $session['id_guru'];
		$select_guru = $this->model_guru->get_guru($where);
		$nm_gru = "";
		$alamat = "";
		$ph ="";
		foreach($select_guru as $guru){
			$nm_gru = $guru->nm_guru;
			$alamat = $guru->alamat;
			$ph = $guru->photo;
			$tp = $guru->telp;
		}
        $data['nm_guru'] = $nm_gru;
        $data['id_guru'] = $session['id_guru'];
        $data['alamat'] = $alamat;
		$data['photo'] = $ph;
		$data['tlp'] = $tp;
		$data['report'] = 1;
		
		$id_guru = $session['id_guru'];
		
		$data['content'] = 'guru/profile';
			$this->load->view($data['content'], $data);
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
		
	}
	
    function logout(){  

        $this->session->unset_userdata('login_guru');
        redirect('login','refresh');
    }
}