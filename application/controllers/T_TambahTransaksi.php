<?php 

	class T_TambahTransaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		$this->load->model('Transaksi');
		$this->load->library('PdfGenerator');
		$role_id 	=	$this->session->userdata('id_role');
		if ( empty($this->session->userdata('nama_user')) ){ 
			redirect( base_url() ); 
		}
	}

	public function index()
	{	
		$order 	= 'NO_INVOICE ASC';		
		$data = array(
			'jenisdomba' => $this->Master->get_orderby_desc( 'jenis_domba')->result(),
			'pelanggan' => $this->Master->get_orderby_desc( 'pelanggan' , array('STATUS_PELANGGAN' => 1))->result(),
			'provinsi' => $this->Master->lihat_provinsi(),
			'kota' => $this->Master->lihat_kota()
		);
		$data['konten'] 		= $this->load->view('Admin/Transaksi/v_tambahtransaksi',$data,True);
		$this->load->view('Admin/index',$data);
	}

	public function domba(){
		$id=$this->input->post('id');
		$data=$this->db->query("SELECT * FROM `domba` WHERE ID_JENIS = '$id' AND STATUS_DOMBA = 1")->result();
        echo json_encode($data);
	}

	public function domba_jk(){
		$id=$this->input->post('id');
		$data=$this->Master->get_tabel('domba' , array('ID_DOMBA' => $id), '');
        echo json_encode($data);
	}

	public function pelanggan(){
		$id=$this->input->post('id');
		$data=$this->db->query("SELECT * FROM pelanggan pe join kota ko ON pe.ID_KOTA=ko.ID_KOTA where ID_PELANGGAN = '$id'")->result();
        echo json_encode($data);
	}

	public function Save(){
		//print_r($_POST);die();
		$this->Transaksi->savePemesanan();
		$this->Transaksi->savePembayaran();
		$this->Transaksi->saveDetailPemesanan();
		$pesan = $this->Master->get_table_order_limit_1( 'pemesanan' , 'TGL_PESAN DESC', 1)->result();
		$data = $pesan[0]->ID_PEMESANAN;
		echo json_encode($data);
	}

}
 ?>