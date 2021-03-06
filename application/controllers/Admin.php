<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		if ( empty($this->session->userdata('nama_user')) ){ redirect( base_url() ); }
		
		
	}

	public function index()
	{
		$where_status_menunggu = array('STATUS_TRANSAKSI' => 'Belum lunas');
		$where_status_dikirim = array('STATUS_TRANSAKSI' => 'Sedang dikirim');
		$where_status_sukses = array('STATUS_TRANSAKSI' => 'Selesai');
		$isi = array(
			'total' => $this->Master->get_tabelcount('pemesanan'),
			'menunggu' => $this->Master->get_tabelcount('pemesanan', $where_status_menunggu),
			'dikirim' => $this->Master->get_tabelcount('pemesanan', $where_status_dikirim),
			'sukses' => $this->Master->get_tabelcount('pemesanan', $where_status_sukses),
		);
		$data['konten'] = $this->load->view('Admin/v_beranda',$isi,True);
		$this->load->view('Admin/index',$data);
	}

	// public function update(){
	// 	header('Content-Type: text/event-stream');
	// 	header('Cache-Control: no-cache');
	// 	header("Connection: keep-alive");

	// 	$isi = array(
	// 		'total' => 0,
	// 		'menunggu' => 0,
	// 		'sukses' => 0,
	// 		'gagal' => 0,
	// 	);

	// 	$str = json_encode($isi);
	// 	echo "data: {$str}\n\n";
	// 	flush();
	// }

}
