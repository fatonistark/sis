<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendances extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AttendanceModel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('security');
	}
	
	public function index()
	{
		$app['title'] = 'Daftar Kehadiran';
		$app['css'] = 'default';
		$app['pages'] = 'attendances';
		$app['js'] = 'attendances';
		$this->load->view('layouts/app', $app);
	}

	public function report()
	{
		$app['title'] = 'Report Kehadiran';
		$app['css'] = 'default';
		$app['pages'] = 'report-attendances';
		$app['js'] = 'report-attendances';
		$this->load->view('layouts/app', $app);
	}

	public function store()
	{
		$list = $this->AttendanceModel->get_datatables();
			// echo $this->db->last_query($list);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $ls) {
			$selisih = $this->AttendanceModel->check_status($ls->nama_hari, $ls->start_time, $ls->end_time);

			$no++;
			$row = array();

			$row[] = $no;
			$row[] = $ls->nama_hari;
			$row[] = $ls->nama_lengkap;
			$row[] = date('d-m-Y', strtotime($ls->tanggal));
			$row[] = $selisih['status_masuk'];
			$row[] = $selisih['status_keluar'];

			$data[] = $row;
		}

		$output = array(
			"draw"				=> $_POST['draw'],
			"recordsTotal" 		=> $this->AttendanceModel->count_all(),
			"recordsFiltered" 	=> $this->AttendanceModel->count_filtered(),
			"data" 				=> $data
		);

		echo json_encode($output);
	}

	public function getreport()
	{
		$this->load->model('SantriModel');
		$html = '';
		$thead='';
		$tbody='';
		$tanggal=array();

			// $nis = $this->input->post('santri_nis');
		$start = new DateTime($this->input->post('tanggal_awal'));
		$end = new DateTime($this->input->post('tanggal_akhir'));
		$end->modify('+1 day');

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($start, $interval, $end);
		$total_date = iterator_count($period);
		$mydays = array('6', '7');
		$no=1;

		$thead .= '<thead>
		<tr>
		<th class="align-middle" rowspan="2">No</th>
		<th class="align-middle" rowspan="2">NIS</th>
		<th class="align-middle" rowspan="2">Nama Lengkap</th>
		<th class="text-center" colspan="'.$total_date.'">Tanggal / Status</th>
		<th class="align-middle" rowspan="2">Total H</th>
		<th class="align-middle" rowspan="2">Total TH</th>
		</tr>
		<tr>';

		foreach ($period as $dt) {
								// $thead .= '<th>'.$dt->format("m\n").'</th>';
			$thead .= '<th>'.$dt->format("d/m").'</th>';
								// var_dump($dt->format("m"));
		}

		$thead .= '</tr>
		
		</thead>';
		$tbody .= '<tbody>';
		$get = $this->SantriModel->get()->result();

		$status = '';
		foreach ($get as $gt) {
			$total_h = 0;
			$total_th = 0;
			$tbody .= '<tr>
			<td>'.$no++.'</td>
			<td>'.$gt->nis.'</td>
			<td>'.$gt->nama_lengkap.'</td>';

			foreach ($period as $dt) {
				$check = $this->AttendanceModel->check_date($dt->format("Y-m-d\n"), $gt->nis);
				if(in_array($dt->format('N'), $mydays)) {
					$status = '<span class="badge badge-info">L</span>';
				}else if ($check->num_rows() > 0) {
					$status = '<span class="badge badge-success">H</span>';
					$total_h++;
				}else{
					$status = '<span class="badge badge-danger">TH</span>';
					$total_th++;
				}

				$tbody .= '<td>'.$status.'</td>';
			}

			$tbody .= '<td>'.$total_h.'</td>
			<td>'.$total_th.'</td>';
		}

		$html .= $thead;
		$html .= $tbody;

            // echo json_encode($get);
		echo $html;
	}
}

/* End of file Items.php */
/* Location: ./application/controllers/Admin/Items.php */
?>