<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Items extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('ItemModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('security');
		}
	
		public function index()
		{
			$app['title'] = 'List Items';
			$app['css'] = 'default';
			$app['pages'] = 'items';
			$app['js'] = 'items';
			$this->load->view('layouts/app', $app);
		}

		public function store()
		{
			$list = $this->ItemModel->get_datatables();
			$data = array();
			$no = $_POST['start'];

			foreach ($list as $ls) {

				$no++;
				$row = array();

				$row[] = $no;
				$row[] = $ls->title;
				$row[] = $ls->category_title;
				$row[] = number_format($ls->price);
				$row[] = $this->ItemModel->count($ls->id);
				$row[] = date('d-m-Y H:i:s', strtotime($ls->created_at));

				$row[] = '
					<div class="btn-group" role="group" aria-label="Action">
						<button class="btn btn-sm btn-warning text-white btn-update" title="Update Item" data-id="'.$ls->id.'" data-title="'.$ls->title.'" data-price="'.$ls->price.'" data-category="'.$ls->retail_category_id.'"><i class="fas fa-edit"></i></button>
						<button class="btn btn-sm btn-danger btn-delete" title="Delete Item" data-id="'.$ls->id.'"><i class="fas fa-trash-alt"></i></button>
						<a href="'. base_url($this->session->userdata("role_slug").'/sub-item/'.$ls->id). '" class="btn btn-sm btn-secondary btn-view-sub" title="Lihat Sub Item" data-id="'.$ls->id.'"><i class="fa fa-list"></i></a>
                    </div>
				';

				$data[] = $row;
			}

			$output = array(
				"draw"				=> $_POST['draw'],
				"recordsTotal" 		=> $this->ItemModel->count_all(),
				"recordsFiltered" 	=> $this->ItemModel->count_filtered(),
				"data" 				=> $data
			);

			echo json_encode($output);
		}

		public function create()
		{
			$config = array(
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Title Item Wajib diisi',
					),
				),

				array(
					'field' => 'price',
					'label' => 'Price',
					'rules' => 'required|xss_clean|numeric',
					'errors' => array(
						'required' => 'Title Item Wajib diisi',
						'numeric' => 'Price harus berupa angka',
					),
				),

				array(
					'field' => 'retail_category_id',
					'label' => 'Category',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Category Wajib diisi',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'title'      			=> form_error('title', '<h4>', '</h4>'),
					'price'      			=> form_error('price', '<h4>', '</h4>'),
					'retail_category_id'    => form_error('retail_category_id', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$data['title']     			= str_replace("'", "", htmlspecialchars($this->input->post('title'), ENT_QUOTES));
				$data['price']     			= str_replace("'", "", htmlspecialchars($this->input->post('price'), ENT_QUOTES));
				$data['retail_category_id'] = str_replace("'", "", htmlspecialchars($this->input->post('retail_category_id'), ENT_QUOTES));
				
				$act = $this->ItemModel->create($data);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data item berhasil ditambahkan !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data item gagal ditambahkan, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function update()
		{
			$config = array(
				array(
					'field' => 'title_update',
					'label' => 'Title',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Title Item Wajib diisi',
					),
				),

				array(
					'field' => 'price_update',
					'label' => 'Price',
					'rules' => 'required|xss_clean|numeric',
					'errors' => array(
						'required' => 'Title Item Wajib diisi',
						'numeric' => 'Price harus berupa angka',
					),
				),

				array(
					'field' => 'retail_category_id_update',
					'label' => 'Category',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Category Wajib diisi',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'title'      			=> form_error('title_update', '<h4>', '</h4>'),
					'price'      			=> form_error('price_update', '<h4>', '</h4>'),
					'retail_category_id'    => form_error('retail_category_id_update', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$id     					= str_replace("'", "", htmlspecialchars($this->input->post('id_update'), ENT_QUOTES));
				$data['title']     			= str_replace("'", "", htmlspecialchars($this->input->post('title_update'), ENT_QUOTES));
				$data['price']     			= str_replace("'", "", htmlspecialchars($this->input->post('price_update'), ENT_QUOTES));
				$data['retail_category_id'] = str_replace("'", "", htmlspecialchars($this->input->post('retail_category_id_update'), ENT_QUOTES));
				
				$act = $this->ItemModel->update($data, $id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data item berhasil diubah !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data item gagal diubah, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function delete()
		{
			$id = str_replace("'", "", htmlspecialchars($this->input->post('id_delete'), ENT_QUOTES));
			$act = $this->ItemModel->delete($id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data item berhasil dihapus !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data item gagal dihapus, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
		}
	
	}
	
	/* End of file Items.php */
	/* Location: ./application/controllers/Admin/Items.php */
?>