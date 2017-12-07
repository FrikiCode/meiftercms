<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payu_model extends CI_Model
{
	// PayU Functions //
	// PayU Show
	public function getPayUByUserID($userID)
	{	
		$this->db->where('user_id', $userID);
		$result = $this->db->get('payureg');
		return $result;
	}
	public function getPayUByRefCode($refCode)
	{	
		$this->db->where('referenceCode', $refCode);
		$result = $this->db->get('payureg');
		return $result;
	}
	// PayU Show End

} 