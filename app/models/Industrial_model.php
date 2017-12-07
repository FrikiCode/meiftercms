<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Industrial_model extends CI_Model
{
	// Industrial Functions //
	// Industrials Show
	public function getIndCats()
	{	
		$this->db->order_by('indcat_id', 'asc');
		$result = $this->db->get('ind_cat');
		return $result;
	}
	public function getIndSubcatBySlug($slug)
	{	
		$this->db->where('slug', $slug);
		$result = $this->db->get('ind_subcat');
		return $result;
	}
	public function getIndByIndSubcatID($subcatID)
	{	
		$this->db->where('indsubcat_id', $subcatID);
		$result = $this->db->get('ind');
		return $result;
	}
	public function getIndustrialBySlug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('ind');
		return $result;
	}
	public function getIndustrialByID($ind_id)
	{
		$this->db->where('ind_id', $ind_id);
		$result = $this->db->get('ind');
		return $result;
	}
	// Industrial Show End

	// Get Renders for Dropdowns
	public function getSubcategoryByCategory($ind_cat_id)
	{	
		$this->db->where('indcat_id', $ind_cat_id);
		$this->db->order_by('indsubcat_id','asc');
		$result = $this->db->get('ind_subcat');
		return $result;
	}

	public function getIndCerts()
	{	
		$this->db->order_by('ind_cert_type_id', 'asc');
		$result = $this->db->get('ind_cert_type');
		return $result;
	}

}