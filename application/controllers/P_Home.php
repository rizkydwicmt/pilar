<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Master');
    }

	public function index()
	{
		$data = array(
            'jenis_domba' => $this->Master->get_orderby_desc('jenis_domba')->result()

		);
		//print_r($data);die();
		$this->load->view('header');
		$this->load->view('index',$data);
	}

	public function select_jk()
	{
		$id=$this->input->post('id');
		$jk=$this->input->post('jk');
		$data=$this->db->query("SELECT harga FROM `domba` WHERE ID_JENIS = '$id' AND JENIS_KELAMIN = '$jk'")->result();
		echo json_encode($data);
	}
}

/* End of file P_Home.php */
/* Location: ./application/controllers/P_Home.php */