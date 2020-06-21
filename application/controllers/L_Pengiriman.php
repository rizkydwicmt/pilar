<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class L_Pengiriman extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		$this->load->library('PdfGenerator');
		if ( empty($this->session->userdata('nama_user')) ){ 
				redirect( base_url() ); 
			}
		
	}
	public function index(){
		$data['konten'] 	= $this->load->view('Admin/Laporan/v_laporan_pengiriman' , '' ,true);
		$this->load->view('Admin/index',$data);
		
	}

	public function laporan(){
		//inisialisasi dari post html
		$bulan = $this->input->post('bulan');
		$tahun = substr($this->input->post('tahun'),2);
		$status_transaksi = $this->input->post('trans');

		//inisialisasi sistem bayar untuk query pemesanan
		if ($status_transaksi == 'Semua') {
			$status_transaksi = '';
		}

		//inisialisasi bulan untuk query pemesanan dan filename untuk nama file pdf
		if ($bulan != 0) {
			$filename = "laporan pengiriman bulan ".$this->bulan($bulan)." 20$tahun";
			$bulan = "and SUBSTRING(p.ID_PEMESANAN, 4, 2) = '$bulan'";
		}else{
			$filename = "laporan pengiriman tahunan 20$tahun";
			$bulan = "";
		}

		//inisialisasi data query pemesanan
		$select_transaksi = "SELECT * from pemesanan p join pembayaran pe on p.ID_PEMESANAN = pe.ID_PEMESANAN join pengiriman pen on pe.ID_PEMBAYARAN = pen.ID_PEMBAYARAN 
		WHERE SUBSTRING(p.ID_PEMESANAN, 6, 2)= '$tahun' $bulan and p.STATUS_TRANSAKSI like '%$status_transaksi%' 
		order by p.STATUS_TRANSAKSI asc";
		
		$data = array(
					'transaksi' => $this->db->query($select_transaksi)->result(),
					'name' => $filename,
				);
				
		//jika ada data maka print laporan, jika tidak muncul tulisan laporan tidak tersedia
		if ($data['transaksi'] != null) {
			$print = $this->load->view('Admin/Laporan/laporan_pengiriman',$data,true);
			$paper = 'A4';
	    	$orientation = 'landscape';
			$this->pdfgenerator->generate($print , $filename , $paper , $orientation );
		}else{
			$this->session->set_flashdata('konten_err' , 'laporan tidak tersedia');	
			redirect( base_url('admin/LapPengiriman') );
		}
	}

	function bulan($bulan){
		switch ($bulan) {
			case "01":
			  $nama_bulan = 'Januari';
			  break;
			case "02":
			  $nama_bulan = 'Februari';
			  break;
			case "03":
			  $nama_bulan = 'Maret';
			  break;
			case "04":
			  $nama_bulan = 'April';
			  break;
			case "05":
			  $nama_bulan = 'Mei';
			  break;
			case "06":
			  $nama_bulan = 'Juni';
			  break;
			case "07":
			  $nama_bulan = 'Juli';
			  break;
			case "08":
			  $nama_bulan = 'Agustus';
			  break;
			case "09":
			  $nama_bulan = 'September';
			  break;
			case "10":
			  $nama_bulan = 'Oktober';
			  break;
			case "11":
			  $nama_bulan = 'November';
			  break;
			case "12":
			  $nama_bulan = 'Desember';
			  break;
			default:
			  $nama_bulan =  "asdasd";
		  }
		return $nama_bulan;
	}
}
?>