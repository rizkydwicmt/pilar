<?php 

	class T_Pengiriman extends CI_Controller {

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
		$order 					= 'NO_INVOICE DESC';		
		$where = "ID_STAT = 'SP4' or ID_STAT = 'SP5' or ID_STAT = 'SP6' or STATUS_DP = 2";	
		$data = array(
            'pemesanan' => $this->Master->get_orderby_desc( 'pemesanan' , $where ,$order)->result(),

        );
        $data['konten'] 		= $this->load->view('Admin/v_t_pengiriman',$data,True);
		$this->load->view('Admin/index',$data);
	}

	public function Packing($id){
		$id = explode('-', $id);
		$data['ID_STAT'] = $id[1];
		$where = 	array('NO_INVOICE' => $id[0]);
		$this->Master->update('pemesanan',$where ,'update', $data);

		$this->session->set_flashdata('konten' , 'Berhasil mengupdate status');
		redirect( base_url('admin/Pengiriman') );
	}

	public function Save($id){
		$datapes['ID_STAT'] = 'SP6';
		$where = 	array('NO_INVOICE' => $id);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'NO_RESI'		=> $_POST['noresi'],
			'KODE_BAYAR'	=> str_replace('T', 'B', $id),
			'TGL_KIRIM'		=> $_POST['tglkirim']
			);

		$this->Master->save_data('pengiriman' , $data);
		$this->Master->update('pemesanan',$where ,'update', $datapes);
		$this->session->set_flashdata('konten' , 'Data Pengiriman Berhasil di Tambahkan');
		redirect( base_url('admin/Pengiriman') );
	}

	public function Save2($id){
		$datapes['STATUS_DP'] = '3';
		$where = 	array('NO_INVOICE' => $id);
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'NO_RESI'		=> $_POST['noresi'],
			'KODE_BAYAR'	=> str_replace('T', 'B', $id).'1',
			'TGL_KIRIM'		=> $_POST['tglkirim']
			);

		$this->Master->save_data('pengiriman' , $data);
		$this->Master->update('pemesanan',$where ,'update', $datapes);
		$this->session->set_flashdata('konten' , 'Data Pengiriman Berhasil di Tambahkan');
		redirect( base_url('admin/Pengiriman') );
	}

	// function asdasd(){
	// 	return asdasdasdasd;
	// }

}
 ?>