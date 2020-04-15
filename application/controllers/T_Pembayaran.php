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

	public function Tolak($id){
		$idpeg = $_SESSION['id_user'];
		$data['ID_STAT'] = 'SPT';
		$datapem['ID_PEG'] = $idpeg;
		$where = 	array('NO_INVOICE' => $id);
		$this->Master->update('pemesanan',$where ,'update', $data);
		$this->Master->update('pembayaran',$where ,'update',$datapem);
		$this->session->set_flashdata('konten_err' , 'Pembayaran berhasil ditolak');	
		redirect( base_url('admin/Pembayaran') );
	}

	public function Hapus($id){
		$idpeg = $_SESSION['id_user'];
		$data['ID_STAT'] = 'ST1';
		$datapem['ID_PEG'] = $idpeg;
		$where = 	array('NO_INVOICE' => $id);
		$this->Master->update('pemesanan',$where ,'update', $data);
		$this->Master->update('pembayaran',$where ,'update',$datapem);
		$this->session->set_flashdata('konten_err' , 'Pembayaran berhasil dihapus');	
		redirect( base_url('admin/Pembayaran') );
	}

	public function Approve($id){
		$idpeg = $_SESSION['id_user'];
		$data['ID_STAT'] = 'SP4';
		$datapem['ID_PEG'] = $idpeg;
		$where = 	array('NO_INVOICE' => $id);
		$this->Master->update('pemesanan',$where ,'update', $data);
		$this->Master->update('pembayaran',$where ,'update',$datapem);
		$this->session->set_flashdata('konten' , 'Pembayaran telah dikonfirmasi');
		redirect( base_url('admin/Pembayaran') );
	}

	public function Approve2($id){
		$idpeg = $_SESSION['id_user'];
		$now = $this->lihat->lihat_curenttimestamp();
		$data['ID_STAT'] = 'SJ2';
		$datapem['ID_PEG'] = $idpeg;
		$idbayar = str_replace('T', 'B', $id);
		$idbayar1 = str_replace('T', 'B', $id).'1';
		$tothar = $this->Master->get_tabel('pemesanan', "NO_INVOICE = '$id'",'TOTAL_HARGA_PESAN');
		$tatharbayar = $this->Master->get_tabel('pembayaran', "KODE_BAYAR = '$idbayar1'",'HARGA_BAYAR');
		$total = $tothar-$tatharbayar;
		$datapem 	=	array(
			/* Nama Field    => Isi Data $_Post */
				'KODE_BAYAR'		=> $idbayar."2",
				'NO_INVOICE'		=> $id,
				'ID_PEG'		=> $idpeg,
				'JENIS_BAYAR'	=> 'Tunai',
				'TGL_BAYAR'	=> $now,
				'HARGA_BAYAR' => $total,
			);
		$idbayar = $idbayar."2";
		if ($_FILES['userfile']['name']) {
			$datapem['JENIS_BAYAR'] = 'Transfer';
            $filename = $_FILES['userfile']['name'];
            $format =  pathinfo($filename, PATHINFO_EXTENSION);
            $foto =  $idbayar.'.'.$format;
            $config['upload_path']          = './upload/pembayaran';
            $config['allowed_types']        = 'jpg|png';
            $config['file_name']            = $idbayar;
            $config['overwrite']            = true;
            $config['max_size']             = 3048; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('userfile')) {
                $this->upload->data("file_name");
                $datapem['BUKTI_BAYAR'] = $foto;
            }
		}
		$where = 	array('NO_INVOICE' => $id);
		$this->Master->update('pemesanan',$where ,'update', $data);
		$this->Master->save_data('pembayaran' , $datapem);
		$this->session->set_flashdata('konten' , 'Pembayaran telah dikonfirmasi');
		redirect( base_url('admin/Transaksi') );
	}

	public function Approve3($id){
		$idpeg = $_SESSION['id_user'];
		$data['ID_STAT'] = 'ST2';
		$where = 	array('NO_INVOICE' => $id);
		$this->Master->update('pemesanan',$where ,'update', $data);
		$this->session->set_flashdata('konten' , 'Pembayaran telah dikonfirmasi');
		redirect( base_url('admin/Pembayaran') );
	}

	// function asdasd(){
	// 	return asdasdasdasd;
	// }

}
 ?>