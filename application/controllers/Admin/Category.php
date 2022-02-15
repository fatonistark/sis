<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Category extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('CategoryModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('security');
		}
	
		public function index()
		{
			$app['title'] = 'Kategori';
			$app['css'] = '';
			$app['pages'] = 'category';
			$app['js'] = 'category';
			$this->load->view('layouts/app', $app);
		}

		public function store()
		{
			$data = array();
			$get = $this->CategoryModel->store();
			if ($get->num_rows() > 0) {
				foreach ($get->result() as $gt) {
					$data['id'] = $gt->id;
					$data['title'] = $gt->title;
					$data['count']	= $this->CategoryModel->count($gt->id);
					$data['created_at'] = $gt->created_at;

					$row[] = $data;
				}
			}
			
			echo json_encode($row);
		}

		public function create()
		{
			$config = array(
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Title Category Wajib diisi',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'title'      	=> form_error('title', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$data['title']     = str_replace("'", "", htmlspecialchars($this->input->post('title'), ENT_QUOTES));
				
				$act = $this->CategoryModel->create($data);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data Kategori berhasil ditambahkan !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data Kategori gagal ditambahkan, silahkan coba kembali dalam beberapa menit !'
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
						'required' => 'Title Category Wajib diisi',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'title'      	=> form_error('title_update', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$id = str_replace("'", "", htmlspecialchars($this->input->post('id_update'), ENT_QUOTES));
				$data['title']     = str_replace("'", "", htmlspecialchars($this->input->post('title_update'), ENT_QUOTES));
				
				$act = $this->CategoryModel->update($data, $id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data Kategori berhasil diubah !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data Kategori gagal diubah, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function delete()
		{
			$id = str_replace("'", "", htmlspecialchars($this->input->post('id_delete'), ENT_QUOTES));
			$act = $this->CategoryModel->delete($id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data Kategori berhasil dihapus !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data Kategori gagal dihapus, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
		}
	
	}
	
	/* End of file Dashboard.php */
	/* Location: ./application/controllers/Dashboard.php */
?>