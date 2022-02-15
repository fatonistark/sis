<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SantriModel extends CI_Model {
		
		var $column_order = array(null, 's.nis', 's.nama_lengkap', 's.walletamount', 's.created_at', 'p.nama_lengkap'); 
	    var $column_search = array('s.nis', 's.nama_lengkap', 's.walletamount', 's.created_at', 'p.nama_lengkap'); //field yang diizin untuk pencarian 
	    var $order = array('s.created_at' => 'asc'); // default order 
	    var $table = 'santri';

	// Datatable
	    private function _get_datatables_query()
	    {	
	    	$this->db->select('s.*, p.nama_lengkap as nama_orang_tua');
	    	$this->db->from($this->table.' as s');
	    	$this->db->join('parrents as p', 'p.id = s.parrent_id', 'left');

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

		function get($where=null)
		{
			if ($where != null) {
				$this->db->where($where);
			}

			return $this->db->get('santri');
		}

		function create($data)
		{
			return $this->db->insert($this->table, $data);
		}

		function update($data, $nis)
		{
			return $this->db->update($this->table, $data, ['nis' => $nis]);
		}

		function delete($nis)
		{
			return $this->db->delete($this->table, ['nis' => $nis]);
		}
	
	}
	
	/* End of file SantriModel.php */
	/* Location: ./application/models/SantriModel.php */
?>