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
			'domba' => $this->Master->get_orderby_desc( 'domba' , array('STATUS_DOMBA' => '1' ), $order)->result(),
			'jenisdomba' => $this->Master->get_orderby_desc( 'jenis_domba' , '' , '')->result(),

        );
        $data['konten'] 		= $this->load->view('Admin/v_domba',$data,True);
		$this->load->view('Admin/index',$data);
		
	}

	public function Save(){	
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'ID_JENIS'		=> $_POST['jd'],
			'JENIS_KELAMIN'		=> $_POST['jk'],
			'HARGA'		=> $_POST['harbar'],
			'BERAT'		=> $_POST['berbar'],
			'STATUS_DOMBA'		=> '1'
			);

		$this->Master->save_data('domba' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');
		redirect( base_url('admin/Domba') );
	}

	public function SaveJenis(){	
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'JENIS_DOMBA'		=> $_POST['jenis']
			);

		$this->Master->save_data('jenis_domba' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');
		redirect( base_url('admin/Domba') );
	}

	public function Delete($iddomba){

		$where = 	array('ID_DOMBA' => $iddomba);
		$this->Master->update('domba',$where ,'update', array('STATUS_DOMBA' => '0' ));

		$this->session->set_flashdata('konten_err' , 'Data Berhasil di Hapus');	
		redirect( base_url('admin/Domba') );
	}

	public function Update($iddomba){
		$where 	= 	array('ID_DOMBA' => $iddomba);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'JENIS_KELAMIN'	=> $_POST['jk'],
			'BERAT'			=> $_POST['berdom'],
			'HARGA'			=> $_POST['hardom'],
			'STATUS_DOMBA'	=> '1'
			);		

		$this->Master->update('domba',$where ,'update' , $data);
		$this->session->set_flashdata('konten' , 'Data Berhasil di Rubah');	
		redirect( base_url('admin/Domba') );
	}

}
 ?>