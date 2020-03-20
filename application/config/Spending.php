<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Spending extends MY_Controller {
	public $tbl = 'spendings';

	public function __construct(){
		parent::__construct();
		$this->load->model('Master');
		if ( empty($this->session->userdata('nama_user')) ){ redirect( base_url() ); }

		
	}

	public function index(){
		$where 				=	array('status_del' => '0');
		$order 				=	'spending_id ASC';
		$order2 				=	'id_cabang ASC';
		$order3 				=	'id_operation ASC';
		$data['nama_cabang']	 	= $this->get_nama( array( 'status_del' => 'T') , $order2);
		$data['nama_opration']	 	= $this->get_nama2( array( 'status_del' => 'T') , $order3);
		$data['spending'] 		=   $this->Master->get_orderby_desc('spendings' ,$where ,$order)->result();
		$data['konten'] 	=	$this->load->view('Admin/Transaksi/spending_v2' , $data , True);
		$this->load->view('Admin/index',$data);
	}
	
	public function get_nama( $where , $order){
		
		$data 		=	$this->Master->get_orderby_desc('tb_cabang' , $where , $order);
		return $data;

	}

	public function get_nama2( $where , $order){
		
		$data 		=	$this->Master->get_orderby_desc('tb_operation' , $where , $order);
		return $data;

	}

	public function load_data(){
		
		$select = '*';
		$tbl = 'spendings a';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'spending_code',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$join['data'][] = array(
			'table' => 'tb_cabang c',
			'join'	=> 'c.id_cabang=a.warehouse_id',
			'type'	=> 'left'
		);

		$where['data'][]=array(
			'column'	=>'a.status_del',
			'param'		=>0
			);

		$query_total = $this->g_mod->select($select,$tbl,NULL,NULL,NULL,$join,$where);
		$query_filter = $this->g_mod->select($select,$tbl,NULL,$where_like,$order,$join,$where);
		$query = $this->g_mod->select($select,$tbl,$limit,$where_like,$order,$join,$where);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				if ($val->spending_id>0) {
					$response['data'][] = array(
						$val->spending_code,
						$val->nama_cabang,
						$val->spending_date,
						$val->spending_cost,
						'<button class="btn btn-primary btn-xs" type="button" onclick="edit_data('.$val->spending_id.')" ><i class="glyphicon glyphicon-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-danger btn-xs" type="button" onclick="delete_data('.$val->spending_id.')" ><i class="glyphicon glyphicon-trash"></i></button>'
					);
					$no++;	
				}
			}
		}

		$response['recordsTotal'] = 0;
		if ($query_total<>false) {
			$response['recordsTotal'] = $query_total->num_rows();
		}
		$response['recordsFiltered'] = 0;
		if ($query_filter<>false) {
			$response['recordsFiltered'] = $query_filter->num_rows();
		}

		echo json_encode($response);
	}

	public function load_data_detail($id){
		/*$u = 'disabled'; $d = 'disabled';
		if (strpos($this->permit, 'u') !== false){
			$u = '';
		}else{

		}
		if (strpos($this->permit, 'd') !== false){
			$d = '';
		}*/
		$tbl = 'spending_details a';
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'nama_operation',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);
		
		//WHERE
		$where['data'][] = array(
			'column' => 'a.spending_id',
			'param'	 => $id
		);

		$where['data'][] = array(
			'column' => 'a.spending_detail_delete',
			'param'	 => 0
		);

		/*if (!$id) {
			$where['data'][] = array(
				'column' => 'user_id',
				'param'	 => $this->user_id
			);
		}*/
		

		//JOIN
		$join['data'][] = array(
			'table' => 'tb_operation b',
			'join'	=> 'b.id_operation=a.oprational_id',
			'type'	=> 'inner'
		);
		
		$query_total = $this->g_mod->select($select,$tbl,NULL,NULL,NULL,$join,$where);
		$query_filter = $this->g_mod->select($select,$tbl,NULL,$where_like,$order,$join,$where);
		$query = $this->g_mod->select($select,$tbl,$limit,$where_like,$order,$join,$where);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				if ($val->spending_detail_id>0) {
					$response['data'][] = array(
						$val->nama_operation,
						$val->spending_detail_cost,
						$val->spending_detail_desc,
						'<button class="btn btn-primary btn-xs" type="button" onclick="edit_data_detail('.$val->spending_detail_id.')" ><i class="glyphicon glyphicon-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-danger btn-xs" type="button" onclick="delete_data_detail('.$val->spending_detail_id.')"><i class="glyphicon glyphicon-trash"></i></button>'
					);
					$no++;	
				}
			}

		}

		$response['recordsTotal'] = 0;
		if ($query_total<>false) {
			$response['recordsTotal'] = $query_total->num_rows();
		}
		$response['recordsFiltered'] = 0;
		if ($query_filter<>false) {
			$response['recordsFiltered'] = $query_filter->num_rows();
		}

		echo json_encode($response);
	}


	public function load_data_where(){
		$select = '*';
		//WHERE
		$where['data'][] = array(
			'column' => 'spending_id',
			'param'	 => $this->input->get('id')
		);

		$join['data'][] = array(
			'table' => 'tb_cabang c',
			'join'	=> 'c.id_cabang=a.warehouse_id',
			'type'	=> 'left'
		);
		$query = $this->g_mod->select($select,'spendings a',NULL,NULL,NULL,$join,$where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'spending_id'			=> $val->spending_id,
					'warehouse_id'			=> $val->warehouse_id,
					'nama_cabang'			=> $val->nama_cabang,
					'spending_date' 		=> $this->format_date_day_mid2($val->spending_date),
				);
			}

			echo json_encode($response);
		}
	}

	public function load_data_where_detail(){
		$select = '*';
		$tbl = 'spending_details a';
		//WHERE
		$where['data'][] = array(
			'column' => 'spending_detail_id',
			'param'	 => $this->input->get('id')
		);

		//JOIN
		$join['data'][] = array(
			'table' => 'tb_operation b',
			'join'	=> 'b.id_operation=a.oprational_id',
			'type'	=> 'inner'
		);
		

		
		$query = $this->g_mod->select($select,$tbl,NULL,NULL,NULL,$join,$where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'spending_detail_id'	=> $val->spending_detail_id,
					'oprational_id'	=> $val->oprational_id,
					'oprational_name'	=> $val->nama_operation,
					'spending_detail_cost' 	=> $val->spending_detail_cost,
					'spending_detail_desc' 	=> $val->spending_detail_desc,
				);
			}

			echo json_encode($response);
		}
	}

	

	public function action_data(){
		$id = $this->input->post('i_id');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data($id);
			//WHERE
			$where['data'][] = array(
				'column' => 'spending_id',
				'param'	 => $id
			);
			$update = $this->g_mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
				$response['alert'] = '2';
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data($id);
			$data['spending_code'] = $this->get_code_spending();
			$insert = $this->g_mod->insert_data_table($this->tbl, NULL, $data);
			$data2['spending_id'] = $insert->output;
			$spending = $insert->output;
			//WHERE
			$where2['data'][] = array(
				'column' => 'spending_id',
				'param'	 => 0
			);
			
			$update = $this->g_mod->update_data_table('spending_details', $where2, $data2);

			$sql = "SELECT SUM(spending_detail_cost) as cost FROM spending_details 
					where spending_id = $spending and spending_detail_delete = 0";
			$row = $this->g_mod->select_manual($sql);

			$data3['spending_cost'] = $row['cost'];

			$where3['data'][]=array(
				'column'	=>'spending_id',
				'param'		=>$spending
				); 

			$update2 = $this->g_mod->update_data_table('spendings', $where3, $data3);

			if($insert->status) {
				$response['status'] = '200';
				$response['alert'] = '1';
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	public function action_data_detail(){
		$id = $this->input->post('i_detail');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data_detail();
			//WHERE
			$where['data'][] = array(
				'column' => 'spending_detail_id',
				'param'	 => $id
			);
			$update = $this->g_mod->update_data_table('spending_details', $where, $data);
			if($update->status) {
				$response['status'] = '200';
				$response['alert'] = '2';
			} else {
				$response['status'] = '204';
			}
			
		} else {
			//INSERT
			$data = $this->general_post_data_detail();
			$insert = $this->g_mod->insert_data_table('spending_details', NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				$response['alert'] = '1';
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}


	public function delete_data(){
		$id = $this->input->post('id');
		//WHERE
		$where['data'][] = array(
			'column' => 'spending_id',
			'param'	 => $id
		);
		$data['status_del'] = 1;
		$update = $this->g_mod->update_data_table('spendings', $where, $data);
		if($update->status) {
			$response['status'] = '200';
			$response['alert'] = '3';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	public function delete_data_detail(){
		$id = $this->input->post('id');
		//WHERE
		$where['data'][] = array(
			'column' => 'spending_detail_id',
			'param'	 => $id
		);
		$data['spending_detail_delete'] = 1;
		$update = $this->g_mod->update_data_table('spending_details', $where, $data);
		if($update->status) {
			$response['status'] = '200';
			$response['alert'] = '3';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function get_code_spending(){
        $bln = date('m');
        $thn = date('Y');
        $select = 'MID(spending_code,9,5) as id';
        $where['data'][] = array(
            'column' => 'MID(spending_code,1,8)',
            'param'     => 'SP'.$thn.''.$bln.''
        );
        $order['data'][] = array(
            'column' => 'spending_code',
            'type'     => 'DESC'
        );
        $limit = array(
            'start'  => 0,
            'finish' => 1
        );
        $query = $this->g_mod->select($select,$this->tbl,$limit,NULL,$order,NULL,$where);
        $new_code = $this->format_kode_transaksi('SP',$query);
        return $new_code;
    }

	function general_post_data($id){
		if (!$id) {
			$data['spending_code'] = $this->get_code_spending();
		}
		$data = array(
			'spending_date' 		=> $this->format_date_day_mid($this->input->post('i_date', TRUE)),
			'warehouse_id' 		=> $this->input->post('i_warehouse', TRUE),
			);

		return $data;
	}

	function general_post_data_detail(){

		$data = array(
			'spending_id' 			=> $this->input->post('i_id', TRUE),
			'oprational_id' 			=> $this->input->post('i_oprational', TRUE),
			'spending_detail_cost' 				=> $this->input->post('i_price', TRUE),
			'spending_detail_desc' 				=> $this->input->post('i_needs', TRUE),
			);
			

		return $data;
	}

	public function load_data_select_cabang(){
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'nama_cabang',
			'param'	 => $this->input->get('q')
		);
		//ORDER
		$order['data'][] = array(
			'column' => 'nama_cabang',
			'type'	 => 'ASC'
		);

		$query = $this->g_mod->select('*','tbl_cabang',NULL,$where_like,$order,NULL,NULL,NULL);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->id_cabang,
					'text'	=> $val->nama_cabang
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}


}
?>