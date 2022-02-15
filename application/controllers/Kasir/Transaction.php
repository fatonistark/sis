<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Transaction extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->model('TransactionModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('security');
		}
	
		public function index()
		{
			$app['title'] = 'Transaction Kasir';
			$app['css'] = '';
			$app['pages'] = 'transaction-kasir';
			$app['js'] = 'transaction-kasir';
			$this->load->view('layouts/app', $app);
		}

		public function list_transaksi()
		{
			$app['title'] = 'List Transaction Kasir';
			$app['css'] = 'default';
			$app['pages'] = 'list-transaction-kasir';
			$app['js'] = 'list-transaction-kasir';
			$this->load->view('layouts/app', $app);
		}

		public function create()
		{
			$bills['santri_id'] = $this->input->post('nis');
			$bills['amount'] = $this->input->post('amount');
			$bills['is_paid'] = 0;

			$retail_sub_item_id = $this->input->post('retail_sub_item_id', TRUE);

			$act = $this->TransactionModel->create($bills, $retail_sub_item_id);
			if ($act) {
				$response = array(
					'type' => 'success',
					'title' => 'Berhasil !',
					'message' => 'Chekout berhasil, silahkan bayar tagihan !'
				);
			} else {
				$response = array(
					'type' => 'error',
					'title' => 'Gagal !',
					'message' => 'Checkout gagal, silahkan coba kembali dalam beberapa menit !'
				);
			}

			echo json_encode($response);
		}

		public function store()
		{
			$list = $this->TransactionModel->get_datatables();
			// echo $this->db->last_query($list);
			$data = array();
			$no = $_POST['start'];

			foreach ($list as $ls) {

				if ($ls->is_paid == 1) {
					$status = '<span class="badge badge-success">Di Bayar</span>';
				}else{
					$status = '<span class="badge badge-danger">Belum Di Bayar</span>';
				}

				$no++;
				$row = array();

				$row[] = $no;
				$row[] = $ls->nis;
				$row[] = $ls->nama_lengkap;
				$row[] = $ls->amount;
				$row[] = $status;
				$row[] = date('d-m-Y H:i:s', strtotime($ls->created_at));

				$data[] = $row;
			}

			$output = array(
				"draw"				=> $_POST['draw'],
				"recordsTotal" 		=> $this->TransactionModel->count_all(),
				"recordsFiltered" 	=> $this->TransactionModel->count_filtered(),
				"data" 				=> $data
			);

			echo json_encode($output);
		}
	
	}
	
	/* End of file Transaction.php */
	/* Location: ./application/controllers/Kasir/Transaction.php */
?>