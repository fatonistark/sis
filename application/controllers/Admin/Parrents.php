<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Parrents extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('ParrentModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('security');
		}
	
		public function index()
		{
			$app['title'] = 'Daftar Orang Tua';
			$app['css'] = 'default';
			$app['pages'] = 'parrents';
			$app['js'] = 'parrents';
			$this->load->view('layouts/app', $app);
		}

		public function get()
		{
			$get = $this->ParrentModel->get()->result();
			echo json_encode($get);
		}

		public function store()
		{
			$list = $this->ParrentModel->get_datatables();
			// echo $this->db->last_query($list);
			$data = array();
			$no = $_POST['start'];

			foreach ($list as $ls) {

				$no++;
				$row = array();

				$row[] = $no;
				$row[] = $ls->nama_lengkap;
				$row[] = $ls->email;
				$row[] = $ls->phone;

				$row[] = date('d-m-Y H:i:s', strtotime($ls->created_at));

				$row[] = '
					<div class="btn-group" role="group" aria-label="Action">
						<button class="btn btn-sm btn-warning text-white btn-update" title="Update Santri" data-id="'.$ls->id.'" data-nama="'.$ls->nama_lengkap.'" data-email="'.$ls->email.'" data-phone="'.$ls->phone.'"><i class="fas fa-edit"></i></button>
						<button class="btn btn-sm btn-danger btn-delete" title="Delete Santri" data-id="'.$ls->id.'"><i class="fas fa-trash-alt"></i></button>
                    </div>
				';

				$data[] = $row;
			}

			$output = array(
				"draw"				=> $_POST['draw'],
				"recordsTotal" 		=> $this->ParrentModel->count_all(),
				"recordsFiltered" 	=> $this->ParrentModel->count_filtered(),
				"data" 				=> $data
			);

			echo json_encode($output);
		}

		public function create()
		{
			$config = array(
				
				array(
					'field' => 'nama_lengkap',
					'label' => 'Nama Lengkap',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Nama lengkap wajib diisi',
					),
				),

				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Email wajib diisi',
					),
				),

				array(
					'field' => 'phone',
					'label' => 'Phone',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Phone awal wajib diisi',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'nama_lengkap'      => form_error('nama_lengkap', '<h4>', '</h4>'),
					'email'      		=> form_error('email', '<h4>', '</h4>'),
					'phone'    			=> form_error('phone', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$data['nama_lengkap'] 		= str_replace("'", "", htmlspecialchars($this->input->post('nama_lengkap'), ENT_QUOTES));
				$data['email'] 		= str_replace("'", "", htmlspecialchars($this->input->post('email'), ENT_QUOTES));
				$data['phone'] 		= str_replace(["'", ","], "", htmlspecialchars($this->input->post('phone'), ENT_QUOTES));
				
				$act = $this->ParrentModel->create($data);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data orang tua berhasil ditambahkan !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data orang tua gagal ditambahkan, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function update()
		{
			$config = array(
				array(
					'field' => 'nama_lengkap_update',
					'label' => 'Nama Lengkap',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Nama lengkap wajib diisi',
					),
				),

				array(
					'field' => 'email_update',
					'label' => 'Email',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Email wajib diisi',
					),
				),

				array(
					'field' => 'phone_update',
					'label' => 'Phone',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Phone awal wajib diisi',
					),
				),
			);


			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'nama_lengkap'      => form_error('nama_lengkap_update', '<h4>', '</h4>'),
					'email'      		=> form_error('email_update', '<h4>', '</h4>'),
					'phone'    			=> form_error('phone_update', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$id = str_replace("'", "", htmlspecialchars($this->input->post('id_update'), ENT_QUOTES));
				$data['nama_lengkap'] 		= str_replace("'", "", htmlspecialchars($this->input->post('nama_lengkap_update'), ENT_QUOTES));
				$data['email'] 		= str_replace("'", "", htmlspecialchars($this->input->post('email_update'), ENT_QUOTES));
				$data['phone'] 		= str_replace("'", "", htmlspecialchars($this->input->post('phone_update'), ENT_QUOTES));

				$act = $this->ParrentModel->update($data, $id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data orang tua berhasil diubah !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data orang tua gagal diubah, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function delete()
		{
			$id = str_replace("'", "", htmlspecialchars($this->input->post('id_delete'), ENT_QUOTES));
			$act = $this->ParrentModel->delete($id);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data orang tua berhasil dihapus !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data orang tua gagal dihapus, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
		}
	}
	
	/* End of file Items.php */
	/* Location: ./application/controllers/Admin/Items.php */
?>