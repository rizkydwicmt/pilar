<?php 

	class Master extends CI_model{
		function get_orderby_desc($nama_table , $where="" , $order="" , $limit="" , $like="" , $or_like="" ,$group_by=""){
			if ($order != null) {
				$this->db->order_by($order);
			}

			if ($limit != null) {
				$this->db->limit($limit);
			}

			if ($like != null) {
				$this->db->like($like);
			}

			if ($or_like != null) {
				$this->db->or_like($or_like);
			}

			if ($where !=null) {
				$this->db->where($where);
			}

			if ($group_by != null){
				$this->db->group_by($group_by);
			}

		    $query 	=	$this->db->get($nama_table);

			if ($query->num_rows() > 0) {
				return $query;
			} else {
				return $query;
			}
		}

		function save_data($nama_table , $data){
			$this->db->insert($nama_table ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function lihat_provinsi()
	    {
	        $this->db->order_by('NAMA_PROV', 'asc');
	        $this->db->get('provinsi', 'after');
	        return $this->db->get('provinsi')->result();
	    }

	    function lihat_kota()
	    {
	        // kita joinkan tabel kota dengan provinsi
	        $this->db->order_by('NAMA_KOTA', 'asc');
	        $this->db->join('provinsi', 'kota.ID_PROV = provinsi.ID_PROV');
	        return $this->db->get('kota')->result();
	    }

		function update($nama_table , $where , $komponen , $dataupdate=''){
			
			if ($komponen == 'delete') {	
				$this->db->set('$dataupdate', '0', FALSE);
				$this->db->where($where);
				$this->db->update($nama_table);

			} else if ($komponen == 'update' && !empty($dataupdate) ) {

				$this->db->where($where);
				$this->db->update($nama_table , $dataupdate);

			} else if ($komponen == 'update-delete') {
				
				$this->db->where($where);
				$this->db->update($nama_table , $dataupdate);
			} 

			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
				
			
		}

		function check_session($tbl_user , $where){
			return $this->db->get_where($tbl_user , $where);

		}

		function delete($statusdel=''){
			return array('status_del' => 'Y');
		}

		public function get_join_two(){
			// $find_by 		=	$tbl1.'.'.$column.'='.$tbl2.'.'.$column;
			// $this->db->select($need);
			// $this->db->from($tbl2);
			// $this->db->join($tbl1 , $find_by ,$type );
			// $this->db->order_by($order);

			// return $this->db->query (
			// 	"SELECT a.*, b.* FROM $tbl1 a $type JOIN $tbl2 b ON a.$column = b.$column"
			// 	);
			
			return $this->db->query(
				"SELECT a.*, b.* FROM `tb_karyawan` a right JOIN `tb_cabang` b ON a.id_karyawan = b.id_karyawan where b.status_del = 'T' "
				);
		}
		public function get_table_order_limit_1($table , $order , $limit){
			$this->db->order_by($order);
			return $this->db->get($table , $limit);
		}

		public function get_cabang($where){
			return $this->db->get_where('tb_cabang',$where);
		}

		public function insert_foto($filename,$tujuan,$postname){
			$config['upload_path']          = $tujuan;
			$config['allowed_types']        = 'jpg|png';
			$config['file_name']            = $filename;
			$config['overwrite']			= true;
			$config['max_size']             = 2048; // 1MB
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);
			if ($this->upload->do_upload($postname)) {
				$this->upload->data("file_name");
				return 'berhasil';
				}else{
					return 'gagal';
			}
		}


		public function ambil_tujuan($table,$nama_asal) { // Kota tujuan di t_v_order

			$this->db->where($nama_asal);
			$result 	=	$this->db->get($table);

			if ($result->num_rows() > 0) {
				return $result->result_array();
			} else {
				return array();
			}


		}

		public function get_custom_query($query){

			return $this->db->query($query);
		}

		public function delete_again($table , $where){

			$this->db->where($where);
			$this->db->delete($table);
		}

		public function get_tabel($nama_table, $where="", $att=""){
			if ($where !=null) {
				$this->db->where($where);
			}
			$res = $this->db->get($nama_table)->result();
			foreach ($res as $row)
	        {
	        	if($att==null){
	        		return $row;		
	        	}else{
	        		return $row->$att;
	        	}
	        }
		}

		public function get_tabelcount($nama_table, $where=""){
			if ($where !=null) {
				$this->db->where($where);
			}
			return $this->db->count_all_results($nama_table);
		}

		public function rupiah($angka){
	
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	 
		}

	}


 ?>