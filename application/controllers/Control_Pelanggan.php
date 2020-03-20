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
			$idcus = str_pad($id+1,6,'C00000',STR_PAD_LEFT);
			$where 					= array('ID_CUS' => $idcus , 'STATUS_CUS' => '1');
			$order 					= 'ID_CUS DESC';
			$data = array(
	            'customer' => $this->Master->get_orderby_desc( 'customer' , $where  ,$order)->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
			$data['konten'] 		= $this->load->view('Admin/v_pelanggan-detail',$data,TRUE);
			$this->load->view('Admin/index',$data);
		} else { 
			$order 					= 'ID_CUS ASC';		
			$data = array(
	            'customer' => $this->Master->get_orderby_desc( 'customer' , array('STATUS_CUS' => '1') ,$order)->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
	        $data['konten'] 		= $this->load->view('Admin/v_pelanggan',$data,True);
			$this->load->view('Admin/index',$data);
		}
	}


	public function Delete($idcus){

		$where = 	array('ID_CUS' => $idcus);
		$this->Master->update('customer',$where ,'update', "STATUS_CUS ='0' ");

		$this->session->set_flashdata('konten_err' , 'Data Berhasil di Hapus');	
		redirect( base_url('admin/Pelanggan') );
	}

	public function Update($idcus){
		$where 		    = 	array('ID_CUS' => $idcus);
		$tlpn =	$_POST['teleponcus'];
		$tlpn = str_replace('-', '', $tlpn);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'ID_KOTA'		=> $_POST['kota'],
			'NAMA_CUS'		=> $_POST['namacus'] ,
			'ALAMAT_CUS'	=> $_POST['alamatcus'] ,
			'TELEPON_CUS'	=> $tlpn ,
			'KODEPOS_CUS'	=> $_POST['kodeposcus'] ,
			'STATUS_CUS'	=> '1'
			);
		if($_POST['passcus']!=null){
			$pass = md5($_POST['passcus']);
			$data['PASS_CUS'] 	=	$pass;
			//echo $pass.' = '.$_POST['passcus'];
		}
		if($_POST['pin']!=null){
			$pin = md5($_POST['pin']);
			$data['PIN_CUS'] 	=	$pin;
			//echo $_POST['pin'];
		}

		$this->Master->update('customer',$where ,'update' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Rubah');	
		redirect( base_url('admin/Pelanggan') );
	}

	// function asdasd(){
	// 	return asdasdasdasd;
	// }

}
 ?>