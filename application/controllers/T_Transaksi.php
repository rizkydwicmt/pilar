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
			$invoice = 'T'.$id;
			$idbayar = 'B'.$id;
			$wherepem = array(
				'NO_INVOICE' => $invoice
			);
			$wherepeng = array(
				'KODE_BAYAR' => $idbayar
			);
			$order 	= 'NO_INVOICE DESC';	
			$wherepel = array(
				'ID_CUS' => $this->Master->get_tabel( 'pemesanan' , array('NO_INVOICE' => $invoice), 'ID_CUS')
			);
			$data = array(
	            'pemesanan' => $this->Master->get_tabel( 'pemesanan' , $wherepem, $order),
	            'detail' => $this->Master->get_orderby_desc( 'detail_pemesanan' , $wherepem)->result(),
	            'pembayaran' => $this->Master->get_orderby_desc( 'pembayaran' , "KODE_BAYAR LIKE '$idbayar%'")->result(),
	            'pengiriman' => $this->Master->get_tabel( 'pengiriman' , "KODE_BAYAR LIKE '$idbayar%'"),
	            'pelanggan' => $this->Master->get_tabel( 'customer' , $wherepel),

	        );
			$data['konten'] 		= $this->load->view('Admin/Transaksi/v_t_transaksi-detail',$data,TRUE);
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
	        $data['konten'] 		= $this->load->view('Admin/Transaksi/v_t_transaksi',$data,True);
			$this->load->view('Admin/index',$data);
		}
	}

	public function print_tagihan($id=''){
		$pesan = $this->Master->get_table_order_limit_1( 'pemesanan' , 'NO_INVOICE DESC', 1)->result();//ambil data pemesanan terakhir
		foreach ($pesan as $key) {
			$invoice = $key->NO_INVOICE;
		}
		if ($id!=null) {
			$invoice = $id;
		}
		$wherepem = array(
				'NO_INVOICE' => $invoice
			);
		$data = array(
	            'pemesanan' => $this->Master->get_tabel( 'pemesanan' , $wherepem),
	            'detail' => $this->Master->get_orderby_desc( 'detail_pemesanan' , $wherepem)->result(),
	        );
		$this->load->view('Admin/Laporan/nota',$data);
	}

	public function invoice($id)
	{
    	$idbayar = 'B'.substr($id,1);
    	$where = "ID_CUS IN (SELECT a.ID_CUS FROM `customer` a INNER JOIN `pemesanan` b ON a.ID_CUS = b.ID_CUS WHERE NO_INVOICE = '$id')";
    	$data = array(
			'pembeli' => $this->Master->get_tabel('customer', $where),
        	'penerima' => $this->lihat->lihat_keranjangpesan($id),
        	'pembayaran' => $this->lihat->lihat_pembayaran($id),
        	'pengiriman' => $this->lihat->lihat_pengiriman($idbayar),
            'jmlhdetail' => $this->lihat->lihat_detpesinv($id),
	        );
		$this->load->view('invoice',$data);
	}

	// function asdasd(){
	// 	return asdasdasdasd;
	// }

}
 ?>