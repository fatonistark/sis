<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class CategoryModel extends CI_Model {
	
		function store()
		{
			return $this->db->get('retail_category_items');
		}

		function count_all()
		{
			$this->db->from('retail_category_items');
	    	return $this->db->count_all_results();
		}

		function count($id)
		{
			$this->db->select('COUNT(*) as count_category');
			$this->db->where('retail_category_id', $id);
			return $this->db->get('retail_items')->row()->count_category;
		}

		function create($data)
		{
			return $this->db->insert('retail_category_items', $data);
		}

		function update($data, $id)
		{
			return $this->db->update('retail_category_items', $data, array('id' => $id));
		}

		function delete($id)
		{
			return $this->db->delete('retail_category_items', array('id' => $id));
		}
	
	}
	
	/* End of file CategoryModel.php */
	/* Location: ./application/models/CategoryModel.php */
?>