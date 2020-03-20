<?php 

	class Control_Pegawai extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		$role_id 	=	$this->session->userdata('id_role');
		if ( empty($this->session->userdata('nama_user')) ){ 
			redirect( base_url() ); 
		}
		
		
	}

	public function index($id='')
	{	
		if ($id != null) {
			$idpeg = str_pad($id,5,'P0000',STR_PAD_LEFT);
			$where 					= array('ID_PEGAWAI' => $idpeg , 'STATUS_PEGAWAI' => '1');
			$order 					= 'ID_PEGAWAI DESC';
			$data = array(
	            'pegawai' => $this->Master->get_orderby_desc( 'pegawai' , $where  ,$order)->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
			$data['konten'] 		= $this->load->view('Admin/v_pegawai-detail',$data,TRUE);
			$this->load->view('Admin/index',$data);
		} else { 
			$order 					= 'ID_PEGAWAI ASC';		
			$data = array(
	            'pegawai' => $this->Master->get_orderby_desc( 'pegawai' , array('STATUS_PEGAWAI' => '1') ,$order)->result(),
	            'jabatan' => $this->Master->get_orderby_desc('jabatan', "ID_JABATAN != 'JB001'")->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
	        $data['konten'] 		= $this->load->view('Admin/v_pegawai',$data,True);
			$this->load->view('Admin/index',$data);
		}
	}

	public function Save(){
		
		$tlpn =	$_POST['teleponpeg'];
		$tlpn = str_replace('-', '', $tlpn);
		$pass = md5($_POST['passpeg']);

		$cekemail = $this->Master->get_orderby_desc( 'pegawai' , array('EMAIL_PEGAWAI' => $_POST['emailpeg']) ,$order)->result();
		$cekuser = $this->Master->get_orderby_desc( 'pegawai' , array('USERNAME' => $_POST['userpeg']) ,$order)->result();
		if($cekemail != null){
			$this->session->set_flashdata('konten_err' , 'Email anda telah digunakan');	
		}elseif ($cekuser != null) {
			$this->session->set_flashdata('konten_err' , 'Username anda telah digunakan');
		}
		else{	
		$data 	=	array(
		/* Nama Field    => Isi Data $_Post */
			'ID_KOTA'		=> $_POST['kota'],
			'USERNAME'		=> $_POST['userpeg'],
			'PASSWORD'		=> $pass,
			'EMAIL_PEGAWAI'		=> $_POST['emailpeg'] ,
			'NAMA_PEGAWAI'		=> $_POST['namapeg'] ,
			'ALAMAT_PEGAWAI'	=> $_POST['alamatpeg'] ,
			'TELP_PEGAWAI'	=> $tlpn ,
			'KODEPOS_PEGAWAI'	=> $_POST['kodepospeg'] ,
			'ID_JABATAN'		=> $_POST['jabatan'],
			'STATUS_PEGAWAI'	=> '1'
			);

		$this->Master->save_data('pegawai' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');	
		}
		redirect( base_url('admin/Pegawai') );
	}


	public function Delete($idpeg){

		$where = 	array('ID_PEGAWAI' => $idpeg);
		$this->Master->update('pegawai',$where ,'update', 'STATUS_PEGAWAI');

		$this->session->set_flashdata('konten_err' , 'Data Berhasil di Hapus');	
		redirect( base_url('admin/Pegawai') );
	}

	public function Update($idpeg){
		$where 		    = 	array('ID_PEGAWAI' => $idpeg);
		$tlpn =	$_POST['teleponpeg'];
		$tlpn = str_replace('-', '', $tlpn);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'ID_KOTA'			=> $_POST['kota'],
			'NAMA_PEGAWAI'		=> $_POST['namapeg'] ,
			'ALAMAT_PEGAWAI'	=> $_POST['alamatpeg'] ,
			'TELP_PEGAWAI'	=> $tlpn ,
			'KODEPOS_PEGAWAI'	=> $_POST['kodepospeg'] ,
			'ID_JABATAN'		=> $_POST['jabatan'],
			'STATUS_PEGAWAI'	=> '1'
			);
		if($_POST['passpeg']!=null){
			$pass = md5($_POST['passpeg']);
			$data['PASSWORD'] 	=	$pass;
		}			

		$this->Master->update('pegawai',$where ,'update' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Rubah');	
		redirect( base_url('admin/Pegawai') );
	}

	// function asdasd(){
	// 	return asdasdasdasd;
	// }

}
 ?>