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
		$order 					= 'ID_PEMESANAN DESC';		
		$where = array(
			'STATUS_TRANSAKSI' => 'Menunggu pengiriman',
			'STATUS_TRANSAKSI' => 'Sedang dikirim'
	);
		$data = array(
            'pemesanan' => $this->Master->get_orderby_desc( 'pemesanan' , $where ,$order)->result(),

        );
        $data['konten'] 		= $this->load->view('Admin/Transaksi/v_pengiriman',$data,True);
		$this->load->view('Admin/index',$data);
	}

	public function Save($id){
		//cari id_pembayaran
		$query_transaksi = "SELECT p.SISTEM_BAYAR, count(pe.ID_PEMBAYARAN) as jumlah_pembayaran FROM pemesanan p join pembayaran pe
		on p.ID_PEMESANAN=pe.ID_PEMESANAN
		WHERE p.ID_PEMESANAN='$id'";
		$transaksi = $this->db->query($query_transaksi)->result();
		
		foreach ($transaksi as $data) { 
			$sistem_bayar = $data->SISTEM_BAYAR;
			$jumlah_bayar = $data->jumlah_pembayaran;
		}
		
		if($sistem_bayar == 'Cicilan'){
			$id_pembayaran = str_replace('T', 'B', $id).$jumlah_bayar;
		}else{
			$id_pembayaran = str_replace('T', 'B', $id);
		}
		
		//data yang akan diinputkan ke database
		$data 	=	array(
			/* Nama Field    => Isi Data $_Post */
			'NO_RESI'		 => $this->input->post('noresi'),
			'ID_PEGAWAI'	 => $_SESSION['id_user'],
			'ID_PEMBAYARAN'	 => $id_pembayaran,
			'TGL_PENGIRIMAN' => $this->input->post('tglkirim')
		);
		$where = 	array('ID_PEMESANAN' => $id);
		$data_pemesanan = array('STATUS_TRANSAKSI' => 'Sedang dikirim');
		
		//proses input atau update kedalam database
		$this->Master->save_data('pengiriman' , $data);
		$this->Master->update('pemesanan', $where ,'update', $data_pemesanan);
		$this->session->set_flashdata('konten' , 'Data Pengiriman Berhasil di Tambahkan');
		redirect( base_url('admin/Pengiriman') );
	}
	
	public function Update($id){
		//mencari apakah cicilan sudah lunas?
		$query_transaksi = "SELECT p.SISTEM_BAYAR, count(pe.ID_PEMBAYARAN) as jumlah_pembayaran FROM pemesanan p join pembayaran pe
		on p.ID_PEMESANAN=pe.ID_PEMESANAN
		WHERE p.ID_PEMESANAN='$id'";
		$transaksi = $this->db->query($query_transaksi)->result();
		
		foreach ($transaksi as $data) { 
			$sistem_bayar = $data->SISTEM_BAYAR;
			$jumlah_bayar = $data->jumlah_pembayaran;
		}

		if($sistem_bayar == 'Cicilan' && $jumlah_bayar == 1){
			$status_transaksi = 'Menunggu pelunasan';
		}else{
			$status_transaksi = 'Selesai';
		}

		//update data status_transaksi
		$where	= array('ID_PEMESANAN' => $id);
		$data	= array('STATUS_TRANSAKSI' => $status_transaksi);
		$this->Master->update('pemesanan',$where ,'update', $data);

		$this->session->set_flashdata('konten' , 'Berhasil mengupdate status');
		redirect( base_url('admin/Pengiriman') );
	}
}
 ?>