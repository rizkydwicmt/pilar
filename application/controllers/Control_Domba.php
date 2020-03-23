<?php 

	class Control_Domba extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		$role_id 	=	$this->session->userdata('id_role');
		if ( empty($this->session->userdata('nama_user')) ){ 
			redirect( base_url() ); 
		}
		
		
	}

	public function index()
	{	
		$order 					= 'ID_DOMBA ASC';		
		$data = array(
			'domba' => $this->Master->get_orderby_desc( 'domba' , '' ,$order)->result(),
			'jenisdomba' => $this->Master->get_orderby_desc( 'jenis_domba' , '' , '')->result(),

        );
        $data['konten'] 		= $this->load->view('Admin/v_domba',$data,True);
		$this->load->view('Admin/index',$data);
		
	}

	public function Save(){
		$filename = $_FILES['userfile']['name'];
		$format =  pathinfo($filename, PATHINFO_EXTENSION);
		$namafoto =  rand(1,9999).date("dm").'.'.$format;
		$tujuan = './assets/img/product-img/';
		$foto = $this->Master->insert_foto($namafoto,$tujuan,'userfile');
		if($foto == 'berhasil'){	
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'NAMA_BAR'		=> $_POST['namabar'],
			'HARGA_BAR'		=> $_POST['harbar'],
			'FOTO_BAR'		=> $namafoto,
			'STATUS'		=> '1'
			);

		$this->Master->save_data('barang' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');
		}else{
			$this->session->set_flashdata('konten_err' , 'Format file anda salah atau lebih dari 2 mb');
		}
		redirect( base_url('admin/Barang') );
	}


	public function Delete($idbar){

		$where = 	array('ID_BAR' => $idbar);
		$this->Master->update('barang',$where ,'update', "STATUS ='0'");

		$this->session->set_flashdata('konten_err' , 'Data Berhasil di Hapus');	
		redirect( base_url('admin/Barang') );
	}

	public function Updatestok($idbar){
		$data['STATUS'] = '1';
		$where = 	array('ID_BAR' => $idbar);
		$this->Master->update('barang',$where ,'update', $data);

		$this->session->set_flashdata('konten' , 'Data Berhasil di Update');
		redirect( base_url('admin/Barang') );
	}

	public function Update($idbar){
		$where 	= 	array('ID_BAR' => $idbar);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'HARGA_BAR'		=> $_POST['harbar'],
			'STATUS'		=> '1'
			);		
		if($_FILES['userfile']['name']){
			$filename = $_FILES['userfile']['name'];
			$format =  pathinfo($filename, PATHINFO_EXTENSION);
			$namafoto =  $_POST['namafile'];
			$tujuan = './assets/img/product-img/';
			$foto = $this->Master->insert_foto($namafoto,$tujuan,'userfile');
			if($foto == 'berhasil'){
				$data['FOTO_BAR'] = $namafoto;
			}else{
				$this->session->set_flashdata('konten_err' , 'Format file anda salah atau lebih dari 2 mb');
			}
		}

		$this->Master->update('barang',$where ,'update' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Rubah');	
		redirect( base_url('admin/Barang') );
	}

	// function asdasd(){
	// 	return asdasdasdasd;
	// }

}
 ?>