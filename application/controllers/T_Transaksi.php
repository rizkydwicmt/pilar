<?php 

	class T_Transaksi extends CI_Controller {

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
			$id_pemesanan = 'T'.$id;
			$id_pembayaran = 'B'.$id;
			$where_pemesanan = array(
				'ID_PEMESANAN' => $id_pemesanan
			);	
			$where_pelanggan = array(
				'ID_PELANGGAN' => $this->Master->get_tabel( 'pemesanan' , array('ID_PEMESANAN' => $id_pemesanan), 'ID_PELANGGAN')
			);
			$data = array(
	            'pemesanan' => $this->Master->get_tabel( 'pemesanan' , $where_pemesanan),
	            'detail_pemesanan' => $this->Master->get_orderby_desc( 'detail_pemesanan' , $where_pemesanan)->result(),
	            'pembayaran' => $this->Master->get_orderby_desc( 'pembayaran' , "ID_PEMBAYARAN LIKE '$id_pembayaran%'")->result(),
	            'pengiriman' => $this->Master->get_tabel( 'pengiriman' , "ID_PEMBAYARAN LIKE '$id_pembayaran%'"),
	            'pelanggan' => $this->Master->get_tabel( 'pelanggan' , $where_pelanggan),

	        );
			$data['konten'] 		= $this->load->view('Admin/Transaksi/v_transaksi-detail',$data,TRUE);
			$this->load->view('Admin/index',$data);
		} else { 
			$order 					= 'ID_PEMESANAN ASC';		
			$data = array(
	            'pemesanan' => $this->Master->get_orderby_desc( 'pemesanan' , '' ,$order)->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
	            'kota' => $this->Master->lihat_kota(),
	            'provinsi_selected' => '',
	            'kota_selected' => '',

	        );
	        $data['konten'] 		= $this->load->view('Admin/Transaksi/v_transaksi',$data,True);
			$this->load->view('Admin/index',$data);
		}
	}

	public function print_nota($id){
		$where = array(
				'ID_PEMESANAN' => $id
			);
		$data = array(
	            'pemesanan' => $this->Master->get_tabel( 'pemesanan' , $where),
	            'detail' => $this->Master->get_orderby_desc( 'detail_pemesanan' , $where)->result(),
	        );
		$this->load->view('Admin/Laporan/nota',$data);
	}

}
 ?>