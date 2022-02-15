<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('SantriModel');
			$this->load->model('ItemModel');
			$this->load->model('SubitemModel');
			$this->load->model('CategoryModel');
		}
	
		public function index()
		{
			$app['title'] = 'Dashboard';
			$app['css'] = '';
			$app['pages'] = 'dashboard';
			$app['js'] = 'dashboard';
			$this->load->view('layouts/app', $app);
		}

		public function get()
		{
			$data['data_santri'] = [
				'title' => 'Total Santri', 
				'icon'	=> 'fas fa-users',
				'total' => $this->SantriModel->count_all()
			];
			$data['data_item'] = [
				'icon'	=> 'fas fa-bars',
				'title' => 'Total Item', 
				'total' => $this->SantriModel->count_all()
			];
			$data['data_category'] = [
				'title' => 'Total Kategori', 
				'icon' => 'fas fa-archive', 
				'total' => $this->CategoryModel->count_all()
			];
			$data['data_sub_item'] = [
				'icon'	=> 'fas fa-ellipsis-v',
				'title' => 'Total Sub Item', 
				'total' => $this->SubitemModel->count_all()
			];

			echo json_encode($data);
		}
	
	}
	
	/* End of file Dashboard.php */
	/* Location: ./application/controllers/Dashboard.php */
?>