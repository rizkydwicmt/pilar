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
			$filename = "laporan transaksi bulanan $sistem_bayar $bulan 20$tahun";
			$bulan = "and SUBSTRING(ID_PEMESANAN, 4, 2) = '$bulan'";
		}else{
			$filename = "laporan transaksi tahunan $sistem_bayar 20$tahun";
			$bulan = "";
		}

		//inisialisasi data query pemesanan
		$data = array(
	            'pemesanan' => $this->db->query("SELECT * FROM `pemesanan` WHERE STATUS_TRANSAKSI = 'Selesai' and SUBSTRING(ID_PEMESANAN, 6, 2)= '$tahun' $bulan and SISTEM_BAYAR like '%$sistem_bayar%'")->result(),
	            'name' => $filename,
			);

		//jika ada data maka print laporan, jika tidak muncul tulisan laporan tidak tersedia
		if ($data['pemesanan'] != null) {
			$print = $this->load->view('Admin/Laporan/laporan_transaksi',$data,true);
			$paper = 'A4';
	    	$orientation = 'portrait';
			$this->pdfgenerator->generate($print , $filename , $paper , $orientation );
		}else{
			$this->session->set_flashdata('konten_err' , 'laporan tidak tersedia');	
			redirect( base_url('admin/LapTransaksi') );
		}
	}
}
?>