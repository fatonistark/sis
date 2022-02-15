<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->helper('String');
		// $config = $this->db->get('config')->result_array();
		// foreach ($config as $cf) {
		// 	define("_{$cf['attr']}", $cf['value']);
		// }
	}
	
	public function index()
	{
		$data['title'] = 'Login Page';
		$data['css'] = '';
		$data['js'] = 'login';
		$data['pages'] = 'login';

		$cookie = get_cookie('sis');
		if ($this->session->userdata('logged')) {
			redirect($this->session->userdata('role_slug').'/dashboard','refresh');
		}else if ($cookie != '') {
			$row = $this->AuthModel->get_by_cookie($cookie)->row();
			if ($row) {
				$this->_reg_session($row);
			}else{
				$this->load->view('layouts/guest', $data);
			}
		}else{
			$this->load->view('layouts/guest', $data);
		}
	}

	public function process()
	{
		$username = str_replace("'", "", htmlspecialchars($this->input->post('username'), ENT_QUOTES));
		$password = str_replace("'", "", htmlspecialchars($this->input->post('password'), ENT_QUOTES));
		$remember = $this->input->post('remember_me');

		$row = $this->AuthModel->login($username)->row();

		if ($row) {
			if ($row->status != 0) {
				if (password_verify($password, $row->password)) {
					
					if ($remember) {
						$key = random_string('alnum', 64);

						set_cookie('sis', $key, 60 * 5);
						$update = array('cookie' => $key);

						$this->AuthModel->update($update, $row->id);
					}

					$response = $this->_reg_session($row);
				}else{
					$response = array(
						'type' => 'error',
						'title' => 'Gagal !!!',
						'message' => 'Email atau password yang anda gunakan salah !',
						'redirect' => base_url('login'),
					);
				}
				
			}else{
				$response = array(
					'type' => 'warning',
					'title' => 'Gagal !!!',
					'message' => 'Akun anda belum aktif silahkan cek email atau hubungi administrator !',
					'redirect' => base_url('login'),
				);
			}

		}else{
			$response = array(
				'type' => 'error',
				'title' => 'Gagal !!!',
				'message' => 'Akun yang anda masukan salah atau belum terdaftar !',
				'redirect' => base_url('login'),
			);
		}

		echo json_encode($response);

	}

	public function _reg_session($row)
	{
		$data_session = array(
			'id'				=> $row->id,
			'username'			=> $row->username,
			'nama_lengkap'		=> $row->nama_lengkap,
			'role_id'			=> $row->role_id,
			'role_name'			=> $row->name,
			'role_slug'			=> $row->slug,
			'logged' 			=> TRUE
		);

		$this->session->set_userdata($data_session);

		$response = array(
			'type' => 'success',
			'title' => 'Berhasil !',
			'message' => 'Anda berhasil login, halaman ini akan di alihkan.',
			'redirect' => base_url($this->session->userdata('role_slug').'/dashboard'),
		);

		return $response;
	}

	public function logout()
	{
		delete_cookie('sis');
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

	public function create()
	{
		echo password_hash('password', PASSWORD_DEFAULT);
	}
	
}

/* End of file Login.php */
/* Location: ./application/controllers/auth/Login.php */
?>
