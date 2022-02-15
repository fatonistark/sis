<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ItemModel extends CI_Model {
	
		var $column_order = array(null, 'i.title', 'i.price', 'c.title'); 
	    var $column_search = array('i.title', 'i.price', 'c.title'); //field yang diizin untuk pencarian 
	    var $order = array('i.title' => 'asc'); // default order 
	    var $table = 'retail_items';

	// Datatable
	    private function _get_datatables_query()
	    {	
	    	$this->db->select('i.*, c.title as category_title');
	    	$this->db->from($this->table.' as i');
	    	$this->db->join('retail_category_items as c', 'c.id = i.retail_category_id', 'left');
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

	    function count($id)
		{
			$this->db->select('COUNT(*) as count_sub_items');
			$this->db->where('retail_item_id', $id);
			return $this->db->get('retail_sub_items')->row()->count_sub_items;
		}

		function create($data)
		{
			return $this->db->insert('retail_items', $data);
		}

		function update($data, $id)
		{
			return $this->db->update('retail_items', $data, ['id' => $id]);
		}
		
		function delete($id)
		{
			return $this->db->delete('retail_items', ['id' => $id]);
		}
	}
	
	/* End of file ItemsModel.php */
	/* Location: ./application/models/ItemsModel.php */
?>