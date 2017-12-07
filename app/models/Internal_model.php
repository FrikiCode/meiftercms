<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Internal_model extends CI_Model
{
	// Internal Functions //
	// Internals Show
	public function getInternalBySlug($slug)
	{	
		$this->db->where('slug', $slug);
		$result = $this->db->get('internal_page');
		return $result;
	}
	public function getInternalALL()
	{
		$this->db->order_by('page_id', 'desc'); 
		$result = $this->db->get('internal_page');
		return $result;
	}
	public function getAllFaqs()
	{
		$this->db->order_by('faq_id', 'desc'); 
		$result = $this->db->get('faq');
		return $result;
	}
	public function getAllAbouts()
	{
		$this->db->order_by('about_id', 'desc'); 
		$result = $this->db->get('about');
		return $result;
	}
	// Internals Show End

}