<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceModel extends CI_Model {
	
	var $column_order = array(null, 's.nama_lengkap', 's.nis', 'a.checkroll_time'); 
	    var $column_search = array('s.nis', 's.nama_lengkap', 'a.checkroll_time'); //field yang diizin untuk pencarian 
	    var $order = array('a.checkroll_time' => 'asc'); // default order 
	    var $table = 'attendances_log';

	// Datatable
	    private function _get_datatables_query()
	    {	
	    	$this->db->select('s.nis, s.nama_lengkap, DATE(a.checkroll_time) as tanggal, TIME(a.checkroll_time) as waktu, TIME(MIN(a.checkroll_time)) as start_time, TIME(MAX(a.checkroll_time)) as end_time');
	    	$this->db->select('CASE DAYOFWEEK(DATE(a.checkroll_time))
	    		WHEN 1 THEN "Minggu"
	    		WHEN 2 THEN "Senin"
	    		WHEN 3 THEN "Selasa"
	    		WHEN 4 THEN "Rabu"
	    		WHEN 5 THEN "Kamis"
	    		WHEN 6 THEN "Jumat"
	    		WHEN 7 THEN "Sabtu"
	    		END as nama_hari');
	    	$this->db->from($this->table.' as a');
	    	$this->db->join('santri as s', 's.nis = a.santri_id', 'left');
	    	// $this->db->join('attendance_time as at', 'a.attendance_time_id = at.id', 'left');
	    	$this->db->group_by(array('s.nis', 'DATE(a.checkroll_time)'));

	    	$i = 0;

	        foreach ($this->column_search as $item) // looping awal
	        {
	            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
	            {

	                if($i===0) // looping awal
	                {
	                	$this->db->group_start();
	                	$this->db->like($item, $_POST['search']['value']); 
	                }
	                else
	                {
	                	$this->db->or_like($item, $_POST['search']['value']);
	                }

	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])) { // here order processing
	        	$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        }  else if(isset($this->order)) {
	        	$order = $this->order;
	        	$this->db->order_by(key($order), $order[key($order)]);
	        }
	    }

	    function get_datatables()
	    {
	    	$this->_get_datatables_query();
	    	if($_POST['length'] != -1)
	    		$this->db->limit($_POST['length'], $_POST['start']);

	    	$query = $this->db->get();
	    	return $query->result();
	    }

	    function count_filtered()
	    {
	    	$this->_get_datatables_query();
	    	$query = $this->db->get();
	    	return $query->num_rows();
	    }

	    function count_all()
	    {
	    	$this->db->from($this->table);
	    	return $this->db->count_all_results();
	    }
	// Datatable

	    function check_date($date, $nis)
	    {
	    	$this->db->where('santri_id', $nis);
	    	$this->db->where('DATE(checkroll_time)', $date);
	    	return $this->db->get($this->table);
	    }

	    function check_status($hari, $start, $end)
	    {
	    	$data=array();
	    	$get = $this->db->get_where('attendance_time', ['hari' => $hari])->row();

	    	$diff_start = strtotime($start) - strtotime($get->start_time);
	    	$diff_end = strtotime($end) - strtotime($get->end_time);

	    	$jam_masuk = floor($diff_start / (60 * 60));
	    	$menit_masuk = $diff_start - $jam_masuk * (60 * 60);

	    	if ($jam_masuk < 0) {
	    		$data['status_masuk'] = '<span class="badge badge-success">'.$start.'</span>';
	    	}else{
	    		$data['status_masuk'] = '<span class="badge badge-danger">'.$start.'</span>';
	    	}

	    	$jam_keluar = floor($diff_end / (60 * 60));
	    	$menit_keluar = $diff_end - $jam_keluar * (60 * 60);

	    	if ($jam_keluar < 0) {
	    		$data['status_keluar'] = '<span class="badge badge-danger">'.$end.'</span>';
	    	}else{
	    		$data['status_keluar'] = '<span class="badge badge-success">'.$end.'</span>';
	    	}

	    	$data['selisih_keluar'] = $jam_keluar .':'. floor( $menit_keluar / 60 );
	    	$data['selisih_masuk'] = $jam_masuk .':'. floor( $menit_masuk / 60 );

	    	return $data;
	    }
	    
	}
	
	/* End of file SantriModel.php */
	/* Location: ./application/models/SantriModel.php */
?>