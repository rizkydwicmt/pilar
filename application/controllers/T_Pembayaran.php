<?php 

	class T_Pembayaran extends CI_Controller {

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
		$query_transaksi = "SELECT p.*, count(pe.ID_PEMBAYARAN) FROM pemesanan p join pembayaran pe
		on p.ID_PEMESANAN=pe.ID_PEMESANAN
		WHERE p.SISTEM_BAYAR='Cicilan'
		AND p.STATUS_TRANSAKSI!='Dibatalkan'
		GROUP BY p.ID_PEMESANAN
		HAVING count(pe.ID_PEMBAYARAN) = 1
		ORDER BY p.ID_PEMESANAN DESC";
		$data = array(
            'transaksi' => $this->db->query($query_transaksi)->result(),
            'provinsi' => $this->Master->lihat_provinsi(),
            'kota' => $this->Master->lihat_kota(),
            'provinsi_selected' => '',
            'kota_selected' => '',

        );
        $data['konten'] 		= $this->load->view('Admin/Transaksi/v_pembayaran',$data,True);
		$this->load->view('Admin/index',$data);
	}

	public function Tunai($id){
		//inisialisasi id(primary key)
		$id_pembayaran = str_replace('T', 'B', $id).'2';

		//mencari harga bayar
		$telah_dibayar = $this->Master->get_tabel('pembayaran',array('ID_PEMESANAN' => $id),'TOTAL_PEMBAYARAN');
		$total_harga = $this->Master->get_tabel('pemesanan',array('ID_PEMESANAN' => $id),'TOTAL_HARGA');
		$harga_bayar = $total_harga-$telah_dibayar;

		//insert data
		$data =	array(
			/* Nama Field    => Isi Data $_Post */
			'ID_PEMBAYARAN'		=> $id_pembayaran,
			'ID_PEGAWAI'		=> $_SESSION['id_user'],
			'ID_PEMESANAN'		=> $id,
			'JENIS_BAYAR'		=> 'Tunai',
			'TOTAL_PEMBAYARAN'	=> $harga_bayar,
			'BUKTI_TRANSFER'	=> '',
			'STATUS_PEMBAYARAN'	=> 'Pelunasan',
			);
		$this->Master->save_data('pembayaran' , $data);
		$this->UpdateStatus($id);
		$this->session->set_flashdata('konten' , 'Pembayaran berhasil');
		redirect( base_url('admin/Pembayaran') );
	}

	public function Transfer($id){
		//inisialisasi id(primary key)
		$id_pembayaran = str_replace('T', 'B', $id).'2';

		//mencari harga bayar
		$telah_dibayar = $this->Master->get_tabel('pembayaran',array('ID_PEMESANAN' => $id),'TOTAL_PEMBAYARAN');
		$total_harga = $this->Master->get_tabel('pemesanan',array('ID_PEMESANAN' => $id),'TOTAL_HARGA');
		$harga_bayar = $total_harga-$telah_dibayar;

		//upload foto
		if ($_FILES['userfile']['name']) {
			$datapem['JENIS_BAYAR'] = 'Transfer';
            $filename = $_FILES['userfile']['name'];
            $format =  pathinfo($filename, PATHINFO_EXTENSION);
            $foto =  $id_pembayaran.'.'.$format;
            $config['upload_path']          = './upload/pembayaran';
            $config['allowed_types']        = 'jpg|png';
            $config['file_name']            = $id_pembayaran;
            $config['overwrite']            = true;
            $config['max_size']             = 3048; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('userfile')) {
                $this->upload->data("file_name");
            }
		}else{
			$this->session->set_flashdata('konten_err' , 'Foto tidak tersedia, silahkan melakukan upload kembali');
			redirect( base_url('admin/Pembayaran') );
		}

		//insert data
		$data =	array(
			/* Nama Field    => Isi Data $_Post */
			'ID_PEMBAYARAN'		=> $id_pembayaran,
			'ID_PEGAWAI'		=> $_SESSION['id_user'],
			'ID_PEMESANAN'		=> $id,
			'JENIS_BAYAR'		=> 'Transfer',
			'TOTAL_PEMBAYARAN'	=> $harga_bayar,
			'BUKTI_TRANSFER'	=> $foto,
			'STATUS_PEMBAYARAN'	=> 'Pelunasan',
			);
		$this->Master->save_data('pembayaran' , $data);
		$this->UpdateStatus($id);
		$this->session->set_flashdata('konten' , 'Pembayaran berhasil');
		redirect( base_url('admin/Pembayaran') );
	}

	function UpdateStatus($id){
		//mencari status_transaksi
		$status_transaksi = $this->Master->get_tabel('pemesanan',array('ID_PEMESANAN' => $id),'STATUS_TRANSAKSI');
		//jika domba sudah dikirim dan Belum lunas
		if($status_transaksi=='Belum lunas'){
			$where	= array('ID_PEMESANAN' => $id);
			$data	= array('STATUS_TRANSAKSI' => 'Selesai');
			$this->Master->update('pemesanan',$where ,'update', $data);
		}
	}

	function Dibatalkan($id){
		$where	= array('ID_PEMESANAN' => $id);
		$data	= array('STATUS_TRANSAKSI' => 'Dibatalkan');
		$this->Master->update('pemesanan',$where ,'update', $data);
		redirect( base_url('admin/Pembayaran') );
	}
}
 ?>