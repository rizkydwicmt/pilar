<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function do_login(){
		$user        =	$_POST['username'];
		$pass        =	md5($_POST['password']);
		
		$session_now =  $this->check_user($user , $pass);
		$text 		 =  'Selamat Datang '.$user;
		if ($session_now != null) {
			$this->session->set_flashdata('konten' , $text);
			redirect( base_url('admin/Beranda') );
		} else {
			redirect( base_url('admin') );
		}
	}

	public function check_user($user , $pass){

		$where 		=	array(
			'USERNAME' 	=> $user ,
			'PASSWORD' 		=> $pass,
			);
		$query 		=	$this->Master->check_session('pegawai' , $where);



		if ($query->num_rows() == 1) {

			$data 	=	$query->result();


			
			foreach ($data as $login) {	

				if ($login->STATUS_PEG == '1') {
					
					$id_karyawan 	=	$login->ID_PEG ;
					$config['nama_user'] 	= $login->NAMA_PEGAWAI;
					$config['id_role'] 		= $login->ID_JABATAN;
					$config['id_user'] 		= $login->ID_PEGAWAI;
					$this->session->set_userdata($config);	

					return $this->session->userdata();

				} else {
					redirect( base_url('403-Forbidden') ) ;
				}

			}
		
		} else {

			return NULL;
		}

		
	}

	public function do_logout(){
		$this->session->sess_destroy();
		redirect( base_url('admin') );
	}

}