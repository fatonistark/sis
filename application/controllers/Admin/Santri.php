<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Santri extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('SantriModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('security');
		}
	
		public function index()
		{
			$app['title'] = 'Daftar Santri';
			$app['css'] = 'default';
			$app['pages'] = 'santri';
			$app['js'] = 'santri';
			$this->load->view('layouts/app', $app);
		}

		public function get()
		{
			$where['nis'] = str_replace("'", "", htmlspecialchars($this->input->post('nis'), ENT_QUOTES));
			$data = $this->SantriModel->get($where)->row();

			echo json_encode($data);
		}

		public function store()
		{
			$list = $this->SantriModel->get_datatables();
			// echo $this->db->last_query($list);
			$data = array();
			$no = $_POST['start'];

			foreach ($list as $ls) {

				if ($ls->nama_orang_tua != null) {
					$parrent = '<span class="badge badge-success">'.$ls->nama_orang_tua.'</span>';	
				}else{
					$parrent = '<span class="badge badge-danger">Tidak ada data</span>';
				}

				$no++;
				$row = array();

				$row[] = $no;
				$row[] = $ls->nis;
				$row[] = $ls->tag_id;
				$row[] = $ls->nama_lengkap;
				$row[] = 'Rp. '.number_format($ls->walletamount);
				$row[] = $parrent;

				$row[] = date('d-m-Y H:i:s', strtotime($ls->created_at));

				$row[] = '
					<div class="btn-group" role="group" aria-label="Action">
						<button class="btn btn-sm btn-warning text-white btn-update" title="Update Santri" data-nis="'.$ls->nis.'" data-nama="'.$ls->nama_lengkap.'" data-parrent="'.$ls->parrent_id.'" data-tag="'.$ls->tag_id.'" data-walletamount="'.$ls->walletamount.'"><i class="fas fa-edit"></i></button>
						<button class="btn btn-sm btn-danger btn-delete" title="Delete Santri" data-nis="'.$ls->nis.'"><i class="fas fa-trash-alt"></i></button>
                    </div>
				';

				$data[] = $row;
			}

			$output = array(
				"draw"				=> $_POST['draw'],
				"recordsTotal" 		=> $this->SantriModel->count_all(),
				"recordsFiltered" 	=> $this->SantriModel->count_filtered(),
				"data" 				=> $data
			);

			echo json_encode($output);
		}

		public function create()
		{
			$config = array(
				array(
					'field' => 'nis',
					'label' => 'NIS',
					'rules' => 'required|xss_clean|is_unique[santri.nis]',
					'errors' => array(
						'required' => 'NIS wajib diisi',
						'is_unique' => 'Data santri sudah tersedia',
					),
				),

				array(
					'field' => 'nama_lengkap',
					'label' => 'Nama Lengkap',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Nama lengkap wajib diisi',
					),
				),

				array(
					'field' => 'tag_id',
					'label' => 'Kode RFID',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Kode RFID wajib diisi',
					),
				),

				array(
					'field' => 'walletamount',
					'label' => 'Saldo Awal',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Saldo awal wajib diisi',
					),
				),
			);

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'nis'      			=> form_error('nis', '<h4>', '</h4>'),
					'nama_lengkap'      => form_error('nama_lengkap', '<h4>', '</h4>'),
					'tag_id'      		=> form_error('tag_id', '<h4>', '</h4>'),
					'walletamount'    	=> form_error('walletamount', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {
				$data['nis']     			= str_replace("'", "", htmlspecialchars($this->input->post('nis'), ENT_QUOTES));
				$data['nama_lengkap'] 		= str_replace("'", "", htmlspecialchars($this->input->post('nama_lengkap'), ENT_QUOTES));
				$data['tag_id'] 		= str_replace("'", "", htmlspecialchars($this->input->post('tag_id'), ENT_QUOTES));
				$data['walletamount'] 		= str_replace(["'", ","], "", htmlspecialchars($this->input->post('walletamount'), ENT_QUOTES));
				$data['parrent_id'] 		= str_replace("'", "", htmlspecialchars($this->input->post('parrent_id'), ENT_QUOTES));
				
				$act = $this->SantriModel->create($data);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data santri berhasil ditambahkan !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data santri gagal ditambahkan, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function update()
		{
			$config = array(
				array(
					'field' => 'nis_update',
					'label' => 'NIS',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'NIS wajib diisi',
					),
				),

				array(
					'field' => 'nama_lengkap_update',
					'label' => 'Nama Lengkap',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Nama lengkap wajib diisi',
					),
				),

				array(
					'field' => 'tag_id_update',
					'label' => 'Kode RFID',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Kode RFID wajib diisi',
					),
				),

				array(
					'field' => 'walletamount_update',
					'label' => 'Saldo Awal',
					'rules' => 'required|xss_clean',
					'errors' => array(
						'required' => 'Saldo awal wajib diisi',
					),
				),
			);


			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {

				$data = [
					'type'              => 'val_error',
					'nis'      			=> form_error('nis_update', '<h4>', '</h4>'),
					'nama_lengkap'      => form_error('nama_lengkap_update', '<h4>', '</h4>'),
					'tag_id'      		=> form_error('tag_id_update', '<h4>', '</h4>'),
					'walletamount'    	=> form_error('walletamount_update', '<h4>', '</h4>'),
				];

				echo json_encode($data);
			} else {

				$nis     				= str_replace("'", "", htmlspecialchars($this->input->post('nis_update'), ENT_QUOTES));
				$data['nama_lengkap'] 	= str_replace("'", "", htmlspecialchars($this->input->post('nama_lengkap_update'), ENT_QUOTES));
				$data['tag_id'] 		= str_replace("'", "", htmlspecialchars($this->input->post('tag_id_update'), ENT_QUOTES));
				$data['walletamount'] 	= str_replace(["'", ","], "", htmlspecialchars($this->input->post('walletamount_update'), ENT_QUOTES));
				$data['parrent_id'] 	= str_replace("'", "", htmlspecialchars($this->input->post('parrent_id_update'), ENT_QUOTES));

				$act = $this->SantriModel->update($data, $nis);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data santri berhasil diubah !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data santri gagal diubah, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
			}
		}

		public function delete()
		{
			$nis = str_replace("'", "", htmlspecialchars($this->input->post('nis_delete'), ENT_QUOTES));
			$act = $this->SantriModel->delete($nis);
				if ($act) {
					$response = array(
						'type' => 'success',
						'title' => 'Berhasil !',
						'message' => 'Data santri berhasil dihapus !'
					);
				} else {
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !',
						'message' => 'Data santri gagal dihapus, silahkan coba kembali dalam beberapa menit !'
					);
				}

				echo json_encode($response);
		}
	}
	
	/* End of file Items.php */
	/* Location: ./application/controllers/Admin/Items.php */
?>