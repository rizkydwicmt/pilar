<?php 

	class Control_Pelanggan extends CI_Controller {

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
			$idcus = str_pad($id,5,'C0000',STR_PAD_LEFT);
			$where 					= array('ID_PELANGGAN' => $idcus , 'STATUS_PELANGGAN' => '1');
			$order 					= 'ID_PELANGGAN DESC';
			$data = array(
	            'pelanggan' => $this->Master->get_orderby_desc( 'pelanggan' , $where  ,$order)->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
			$data['konten'] 		= $this->load->view('Admin/Master/v_pelanggan-detail',$data,TRUE);
			$this->load->view('Admin/index',$data);
		} else { 
			$order 					= 'ID_PELANGGAN ASC';		
			$data = array(
	            'pelanggan' => $this->Master->get_orderby_desc( 'pelanggan' , array('STATUS_PELANGGAN' => '1') ,$order)->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
	        $data['konten'] 		= $this->load->view('Admin/Master/v_pelanggan',$data,True);
			$this->load->view('Admin/index',$data);
		}
	}

	public function Save(){
		
		$tlpn =	$_POST['teleponpeg'];
		$tlpn = str_replace('-', '', $tlpn);
		$pass = md5($_POST['passpeg']);

		$data 	=	array(
		/* Nama Field    => Isi Data $_Post */
			'ID_KOTA'		=> $_POST['kota'],
			'NAMA_PELANGGAN'	=> $_POST['namapel'] ,
			'ALAMAT_PELANGGAN'	=> $_POST['alamatpel'] ,
			'TELP_PELANGGAN'	=> $tlpn ,
			'KODEPOS_PELANGGAN'	=> $_POST['kodepospel'] ,
			'STATUS_PELANGGAN'	=> '1'
			);

		$this->Master->save_data('pelanggan' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');
		
		redirect( base_url('admin/Pelanggan') );
	}


	public function Delete($idcus){

		$where = 	array('ID_PELANGGAN' => $idcus);
		$this->Master->update('pelanggan',$where ,'update', "STATUS_PELANGGAN ='0' ");

		$this->session->set_flashdata('konten_err' , 'Data Berhasil di Hapus');	
		redirect( base_url('admin/Pelanggan') );
	}

	public function Update($idcus){
		$where 		    = 	array('ID_PELANGGAN' => $idcus);
		$tlpn =	$_POST['teleponcus'];
		$tlpn = str_replace('-', '', $tlpn);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'ID_KOTA'		=> $_POST['kota'],
			'NAMA_PELANGGAN'		=> $_POST['namacus'] ,
			'ALAMAT_PELANGGAN'	=> $_POST['alamatcus'] ,
			'TELP_PELANGGAN'	=> $tlpn ,
			'KODEPOS_PELANGGAN'	=> $_POST['kodeposcus'] ,
			'STATUS_PELANGGAN'	=> '1'
			);

		$this->Master->update('pelanggan',$where ,'update' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Rubah');	
		redirect( base_url('admin/Pelanggan') );
	}

}
 ?>