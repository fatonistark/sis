<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Subitem extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('SubitemModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('security');
		}
	
		public function index()
		{
			$app['title'] = 'List Sub Item';
			$app['css'] = 'default';
			$app['pages'] = 'subitem';
			$app['js'] = 'subitem';
			$this->load->view('layouts/app', $app);
		}

		public function store()
		{
			$list = $this->SubitemModel->get_datatables();
			// echo $this->db->last_query($list);
			$data = array();
			$no = $_POST['start'];

			foreach ($list as $ls) {

				$no++;
				$row = array();

				$row[] = $no;
				$row[] = $ls->barcode;
				$row[] = $ls->item_title;
				$row[] = date('d-m-Y H:i:s', strtotime($ls->created_at));

				$row[] = '
					<div class="btn-group" role="group" aria-label="Action">
						<button class="btn btn-sm btn-warning text-white btn-update" title="Update Item" data-id="'.$ls->id.'" data-barcode="'.$ls->barcode.'"><i class="fas fa-edit"></i></button>
						<button class="btn btn-sm btn-danger btn-delete" title="Delete Item" data-id="'.$ls->id.'"><i class="fas fa-trash-alt"></i></button>
                    </div>
				';

				$data[] = $row;
			}

			$output = array(
				"draw"				=> $_POST['draw'],
				"recordsTotal" 		=> $this->SubitemModel->count_all(),
				"recordsFiltered" 	=> $this->SubitemModel->count_filtered(),
				"data" 				=> $data
			);

			echo json_encode($output);
		}

		public function create()
		{
			$config = array(
				array(
					'field' => 'barcode',
					'label' => 'Barcode',
					'rules' => 'required|xss_clean|is_unique[retail_sub_items.barcode]',
					'errors' => array(
						'required' => 'Barcode Wajib diisi',
						'is_unique' => 'Item ini sudah tersedia',
					),
				),

				array(
					'field' => 'retail_item_id',
					'label' => 'retail_item_id',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Insert data harus melalui list item',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'barcode'      		=> form_error('barcode', '<h4>', '</h4>'),
					'retail_item_id'    => form_error('retail_item_id', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$data['barcode']     			= str_replace("'", "", htmlspecialchars($this->input->post('barcode'), ENT_QUOTES));
				$data['retail_item_id'] 		= str_replace("'", "", htmlspecialchars($this->input->post('retail_item_id'), ENT_QUOTES));
				
				$act = $this->SubitemModel->create($data);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data sub item berhasil ditambahkan !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data sub item gagal ditambahkan, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function update()
		{
			$is_unique = '';
			$barcode = $this->db->get('retail_sub_items', array('id' => $this->input->post('id_update')))->row()->barcode;
			if ($barcode != $this->input->post('barcode')) {
				$is_unique = 'is_unique[retail_sub_items.barcode]';
			}

			$config = array(
				array(
					'field' => 'barcode_update',
					'label' => 'Barcode',
					'rules' => 'required|xss_clean|'.$is_unique,
					'errors' => array(
						'required' => 'Barcode Wajib diisi',
						'is_unique' => 'Item ini sudah tersedia',
					),
				),
			);


			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'barcode'      		=> form_error('barcode_update', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$id     			 = str_replace("'", "", htmlspecialchars($this->input->post('id_update'), ENT_QUOTES));
				$data['barcode']     = str_replace("'", "", htmlspecialchars($this->input->post('barcode_update'), ENT_QUOTES));
				
				$act = $this->SubitemModel->update($data, $id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data sub item berhasil diubah !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data sub item gagal diubah, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function delete()
		{
			$id = str_replace("'", "", htmlspecialchars($this->input->post('id_delete'), ENT_QUOTES));
			$act = $this->SubitemModel->delete($id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data sub item berhasil dihapus !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data sub item gagal dihapus, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
		}

		public function getAll()
		{
			if (!empty($barcode = $this->input->post('barcode'))) {
				$get = $this->SubitemModel->getAll()->row();
			}else{
				$get = $this->SubitemModel->getAll()->result();
			}

			echo json_encode($get);
		}
	
	}
	
	/* End of file Items.php */
	/* Location: ./application/controllers/Admin/Items.php */
?>