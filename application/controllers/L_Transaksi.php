<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class L_Transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		$this->load->library('PdfGenerator');
		if ( empty($this->session->userdata('nama_user')) ){ 
				redirect( base_url() ); 
			}
		
	}
	public function index(){
		$data['konten'] 	= $this->load->view('Admin/Laporan/v_laporan_transaksi' , '' ,true);
		$this->load->view('Admin/index',$data);
	}

	public function laporan(){
		//inisialisasi dari post html
		$bulan = $this->input->post('bulan');
		$tahun = substr($this->input->post('tahun'),2);
		$sistem_bayar = $this->input->post('trans');

		//inisialisasi sistem bayar untuk query pemesanan
		if ($sistem_bayar == 'Semua') {
			$sistem_bayar = '';
		}

		//inisialisasi bulan untuk query pemesanan dan filename untuk nama file pdf
		if ($bulan != 0) {
			$filename = "laporan transaksi bulan $sistem_bayar ".$this->bulan($bulan)." 20$tahun";
			$bulan = "and SUBSTRING(ID_PEMESANAN, 4, 2) = '$bulan'";
		}else{
			$filename = "laporan transaksi tahunan $sistem_bayar 20$tahun";
			$bulan = "";
		}

		//inisialisasi data query pemesanan
		$data = array(
	            'pemesanan' => $this->db->query("SELECT * FROM `pemesanan` WHERE SUBSTRING(ID_PEMESANAN, 6, 2)= '$tahun' $bulan and SISTEM_BAYAR like '%$sistem_bayar%'")->result(),
	            'name' => $filename,
			);

		//jika ada data maka print laporan, jika tidak muncul tulisan laporan tidak tersedia
		if ($data['pemesanan'] != null) {
			$print = $this->load->view('Admin/Laporan/laporan_transaksi',$data,true);
			var_dump($print);die();
			$paper = 'A4';
	    	$orientation = 'landscape';
			$this->pdfgenerator->generate($print , $filename , $paper , $orientation );
		}else{
			$this->session->set_flashdata('konten_err' , 'laporan tidak tersedia');	
			redirect( base_url('admin/LapTransaksi') );
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