<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rrhh_model extends CI_Model
{
	// Categorie Functions //
	// Categories Show
	public function getCategoryBySlug($slug)
	{	
		$this->db->where('slug', $slug);
		$result = $this->db->get('rrhh_cat');
		return $result;
	}
	public function getCategoryALL()
	{	
		$this->db->order_by('title', 'desc'); 
		$result = $this->db->get('rrhh_cat');
		return $result;
	}
	// Categories Show End

	// Candidates Functions //
	public function getCandidatesByCatID($CatID)
	{	
		$this->db->where('cat_id', $CatID);
		$result = $this->db->get('rrhh_cand');
		return $result;
	}

	public function getCandidatesByCandID($CandID)
	{	
		$this->db->where('rrhh_cand_id', $CandID);
		$result = $this->db->get('rrhh_cand');
		return $result;
	}
	
	// Candidates Functions End //

}