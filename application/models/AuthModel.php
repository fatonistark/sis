<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AuthModel extends CI_Model {
		
		function login($username)
		{
			$this->db->select('u.*, r.name, r.slug');
			$this->db->from('users as u');
			$this->db->join('roles as r', 'r.id = u.role_id', 'left');
			$this->db->where('u.username', $username);
			return $this->db->get();
		}

		function update($data, $id)
		{
			return $this->db->update('users', $data, ['id' => $id]);
		}
	
	}
	
	/* End of file AuthModel.php */
	/* Location: ./application/models/AuthModel.php */
?>