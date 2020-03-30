<?php 

	class T_TambahTransaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		$this->load->library('PdfGenerator');
		$role_id 	=	$this->session->userdata('id_role');
		if ( empty($this->session->userdata('nama_user')) ){ 
			redirect( base_url() ); 
		}
		
		
	}

	public function index($id='')
	{	
		if ($id != null) {
			$order 					= 'NO_INVOICE ASC';	
			$data = array(
	            'domba' => $this->Master->get_orderby_desc( 'domba' , array('STATUS_DOMBA' => '1'))->result(),
	            'provinsi' => $this->Master->lihat_provinsi(),
				'kota' => $this->Master->lihat_kota(),
	            'id' => $id,

	        );
			$data['konten'] 		= $this->load->view('Admin/Transaksi/v_t_tambahtransaksi',$data,TRUE);
			$this->load->view('Admin/index',$data);
		} else { 
			$order 					= 'NO_INVOICE ASC';		
			$data = array(
				'jenisdomba' => $this->Master->get_orderby_desc( 'jenis_domba' , '')->result(),
				'provinsi' => $this->Master->lihat_provinsi(),
				'kota' => $this->Master->lihat_kota()
	        );
	        $data['konten'] 		= $this->load->view('Admin/Transaksi/v_t_tambahtransaksi',$data,True);
			$this->load->view('Admin/index',$data);
		}
	}

	public function domba(){
		$id=$this->input->post('id');
		$data=$this->db->query("SELECT * FROM `domba` WHERE ID_JENIS = '$id'")->result();
        //$data=$this->lihat->lihat_warna_att($id);
        	echo json_encode($data);
	}

	public function warna(){
		$idbar=$this->input->post('idbar');
		$iduk=$this->input->post('iduk');
		$data=$this->db->query("SELECT * FROM `warna` WHERE ID_WAR IN (SELECT a.ID_WAR FROM `detail_barang` a INNER JOIN `ukuran` b ON a.ID_UK = b.ID_UK INNER JOIN warna c ON a.ID_WAR=c.ID_WAR WHERE a.ID_UK = '$iduk' AND a.ID_BAR = '$idbar' AND STATUS_BAR = '1')")->result();
        //$data=$this->lihat->lihat_warna_att($id);
        	echo json_encode($data);
	}

	public function layanan(){
		require_once('vendor/autoload.php');
		$idkota=$this->input->post('idkota');
		$kurir=$this->input->post('kurir');
		$layanan = $this->input->post('layanan');
		$foo = new RajaOngkir\RajaOngkir();
		$biaya = $foo->Cost([
		'origin'    => '409', // id kota asal 
		'destination'   => $idkota, // id kota tujuan
		'weight'    => '1', // berat satuan gram
		'courier'     => $kurir , // kode kurir pengantar ( jne / tiki / pos )
		])->get();

		foreach ($biaya as $key => $value) 
	  	{
		    $costs = $value['costs'];
		    foreach ($costs as $key2 => $value2) 
		    {
		    	if (!isset($i)) {
		    		$i=0;
		    	}
		      $cost = $value2['cost'];
		       $cos = $cost[0]['value'];
		       $data[$i]=$value2['service'];
		       $i++;
		    }
	  	}
        echo json_encode($data);
	}

	public function ongkir(){
		require_once('vendor/autoload.php');
		$idkota=$this->input->post('idkota');
		$kurir=$this->input->post('kurir');
		$layanan = $this->input->post('layanan');
		$foo = new RajaOngkir\RajaOngkir();
		$biaya = $foo->Cost([
		'origin'    => '409', // id kota asal 
		'destination'   => $idkota, // id kota tujuan
		'weight'    => '1', // berat satuan gram
		'courier'     => $kurir , // kode kurir pengantar ( jne / tiki / pos )
		])->get();

		foreach ($biaya as $key => $value) 
	  	{
		    $costs = $value['costs'];
		    foreach ($costs as $key2 => $value2) 
		    {
		     	if ($layanan === $value2['service']) {
		     		$cost = $value2['cost'];
		    		$cos  = $cost[0]['value'];
		     		$data = $cos;
		     	}
		    }
	  	}
        echo json_encode($data);
	}

	public function harga(){
		$idbar=$this->input->post('idbar');
		$arr = array(
			'ID_BAR' => $idbar,
		);
		$data=$this->Master->get_orderby_desc( 'domba' , $arr)->result();
        //$data=$this->lihat->lihat_warna_att($id);
        	echo json_encode($data);
	}

	public function Save($id=""){
		$idpeg = $_SESSION['id_user'];
		if(!$this->input->post('total')){
				$this->session->set_flashdata('konten_err' , 'Silahkan isi semua data pada form');	
				redirect( base_url('admin/addTransaksi') );
		}else{
			//data
			$total = $this->input->post('total');
			$now = $this->lihat->lihat_curenttimestamp();

			//pemesananan
			$datapes 	=	array(
				/* Nama Field    => Isi Data $_Post */
				'ID_CUS'			=> 'C00001',
				'ID_STAT'			=> 'ST2',
				'ONGKIR_PESAN'		=> '0',
				'LAYANAN_PESAN'		=> 'COD',
				'TOTAL_HARGA_PESAN'	=> $total,
				'TGL_TRANSAKSI'		=> $this->lihat->lihat_curenttimestamp(),
			);
			if ($this->input->post('KIRIM') == 'on') {
				$kurir = $this->input->post('kurir');
				$total = $total+$this->input->post('ongkir');
				$datapes['NAMA_PEN'] = $this->input->post('nama');
				$datapes['ALAMAT_PEN'] = $this->input->post('alamat');
				$datapes['KODEPOS_PEN'] = $this->input->post('kodepos');
				$datapes['ID_KOTA'] = $this->input->post('kota');
				$datapes['TELEPON_PEN'] = $this->input->post('telepon');
				if($kurir=="tiki"){
					$kurir = "J01";
				}else{
					$kurir = "J02";
				}
				$datapes['ID_JEN'] = $kurir;
				$datapes['LAYANAN_PESAN'] = $this->input->post('layanan');
				$datapes['ONGKIR_PESAN'] = $this->input->post('ongkir');
				$datapes['TOTAL_HARGA_PESAN'] = $total;
				$datapes['ID_STAT'] = "SP5";
			}
			if($this->input->post('KIRIM') == 'on' && $this->input->post('DP') == 'on'){
				$datapes['NAMA_KTP'] = $this->input->post('NamaKTP');
				$datapes['NOMER_KTP'] = $this->input->post('NoKTP');
				$datapes['STATUS_DP'] = 2;
				$datapes['ID_STAT'] = "SJ1";
			}
			elseif($this->input->post('DP') == 'on'){
				$datapes['NAMA_KTP'] = $this->input->post('NamaKTP');
				$datapes['NOMER_KTP'] = $this->input->post('NoKTP');
				$datapes['STATUS_DP'] = 1;
				$datapes['ID_STAT'] = "SJ1";
			}else{
				$datapes['STATUS_DP'] = 0;
			}
			//var_dump($datapes);die();
			$this->Master->save_data('pemesanan' , $datapes);//insert pemesanan
			//pembayaran
			$pesan = $this->Master->get_table_order_limit_1( 'pemesanan' , 'TGL_TRANSAKSI DESC', 1)->result();//ambil data pemesanan terakhir
			foreach ($pesan as $key) {
				$invoice = $key->NO_INVOICE;
			}
			$idbayar = str_replace('T', 'B', $invoice);
			$datapem 	=	array(
			/* Nama Field    => Isi Data $_Post */
				'KODE_BAYAR'		=> $idbayar,
				'NO_INVOICE'		=> $invoice,
				'ID_PEG'		=> $idpeg,
				'JENIS_BAYAR'	=> 'Tunai',
				'TGL_BAYAR'	=> $now,
				'HARGA_BAYAR' => $total,
			);
			if ($this->input->post('DP') == 'on') {
				$datapem['KODE_BAYAR'] = $idbayar."1";
				$datapem['HARGA_BAYAR'] = $this->input->post('DPval');
				$idbayar = $idbayar."1";
			}
			if ($this->input->post('TF') == 'on') {
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
			$this->Master->save_data('pembayaran' , $datapem);//insert pembayaran
			if($id!=null){
				for ($i=0; $i < $id; $i++) { 
					//data
					$idbar = $this->input->post('barang['.$i.']');
					$iduk = $this->input->post('ukuran['.$i.']');
					$idwar = $this->input->post('warna['.$i.']');
					$jmlh = $this->input->post('jumlah['.$i.']');
					$subtot = $this->input->post('subtotal['.$i.']');

					//detailpemesanan
					$datadetpes 	=	array(
						/* Nama Field    => Isi Data $_Post */
						'NO_INVOICE'			=> $invoice,
						'ID_WAR'		=> $idwar,
						'ID_UK'		=> $iduk,
						'ID_BAR'	=> $idbar,
						'JUMLAH'	=> $jmlh,
						'SUBTOTAL'	=> $subtot,
					); 
					$this->Master->save_data('detail_pemesanan' , $datadetpes);//insert pemesanan
					$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');	
				}
			}else{
				$datadetpes 	=	array(
					/* Nama Field    => Isi Data $_Post */
					'NO_INVOICE'			=> $invoice,
					'ID_WAR'		=> $this->input->post('warna'),
					'ID_UK'		=> $this->input->post('ukuran'),
					'ID_BAR'	=> $this->input->post('domba'),
					'JUMLAH'	=> $this->input->post('jumlah'),
					'SUBTOTAL'	=> $this->input->post('subtotal'),
				); 
				$this->Master->save_data('detail_pemesanan' , $datadetpes);//insert pemesanan
				$this->session->set_flashdata('konten' , 'Data Berhasil di Tambahkan');	
			}
			$_SESSION['print'] = 'ada';
			redirect( base_url('admin/Transaksi') );
		}
	}

	public function coba($id){
		$data = $this->load->view('Admin/cobaprint','',true);
		$paper = 'A4';
    	$orientation = 'portrait';
		$this->pdfgenerator->generate($data , 'nota_tagihan' , $paper , $orientation );
	}
}
 ?>