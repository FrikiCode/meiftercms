<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership_model extends CI_Model
{
	// MP Functions //
	// MP Show
	public function getMembershipTypes()
	{	
		$result = $this->db->get('membership_type');
		return $result;
	}
	public function getMembershipStatus($userID)
	{	
		$this->db->where('user_id', $userID);
		$result = $this->db->get('membership_log');
		return $result;
	}
	// MP Show End

} 