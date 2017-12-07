<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	// User Functions //
	// User Show
	public function getByID($id)
	{	
		$this->db->where('id', $id);
		$result = $this->db->get('users');
		return $result;
	}

	public function getByEmail($email)
	{	
		$this->db->where('email', $email);		
		$result = $this->db->get('users');
		return $result;
	}

	public function getMsgByID($id)
	{	
		$this->db->where('user_id', $id);		
		$result = $this->db->get('msg_system');
		return $result;
	}

	// User Show End
}