<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TransactionModel extends CI_Model {
		
		var $column_order = array(null, 's.nis', 's.nama_lengkap', 'b.amount', 'b.created_at', 'b.is_paid'); 
	    var $column_search = array('s.nis', 's.nama_lengkap', 'b.amount', 'b.created_at', 'b.is_paid'); //field yang diizin untuk pencarian 
	    var $order = array('b.created_at' => 'desc'); // default order 
	    var $table = 'bills';

	// Datatable
	    private function _get_datatables_query()
	    {	
	    	$this->db->select('b.*, s.nis, s.nama_lengkap');
	    	$this->db->from($this->table.' as b');
	    	$this->db->join('santri as s', 's.nis = b.santri_id', 'left');
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

		function create($bills, $retail_sub_item_id)
		{
			$this->db->trans_start();
	    		$this->db->insert('bills', $bills);
	    		$bill_id = $this->db->insert_id();
	    		$result = array();
	    			foreach ($retail_sub_item_id as $key => $value) {
	    				$result[] = array(
	    					'bill_id' => $bill_id,
	    					'retail_sub_item_id' => $_POST['retail_sub_item_id'][$key],
	    					'total_item' => $_POST['total_item'][$key],	
						);
	    			}

	    		$this->db->insert_batch('bill_items', $result);
	    	$this->db->trans_complete();

	    	return true;
		}
	
	}
	
	/* End of file TransactionModel.php */
	/* Location: ./application/models/TransactionModel.php */
?>