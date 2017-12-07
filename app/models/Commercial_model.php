<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commercial_model extends CI_Model
{
	// Categorie Functions //
	// Categories Show
	public function getCategoryBySlug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('prod_categorie');
		return $result;
	}
	public function getCategoryALL()
	{
		$this->db->order_by('prod_cat_id', 'asc');
		$result = $this->db->get('prod_categorie');
		return $result;
	}
	// Categories Show End

	// Product Functions //
	// Products Show
	public function getProdsByCat($catID)
	{
		$this->db->where('cat_id', $catID);
		$this->db->join('prod_seg', 'prod_seg.prod_id = product.prod_id');
		$result = $this->db->get('product');
		return $result;
	}
	public function getProductByCat($catID)
	{
		$this->db->where('cat_id', $catID);
		$result = $this->db->get('product');
		return $result;
	}
	public function getProdBySlug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('product');
		return $result;
	}
	public function getProdDest()
	{
		$this->db->where('highlight', 1);
		$result = $this->db->get('product');
		return $result;
	}
	public function getLastFiveProds()
	{
		$this->db->limit(5);
		$this->db->order_by('prod_id', 'desc');
		$result = $this->db->get('product');
		return $result;
	}
	// Products Show End

	// Brand Functions //
	// Brands Show
	public function getBrandsALL()
	{
		$this->db->order_by('title', 'desc');
		$result = $this->db->get('prod_brand');
		return $result;
	}
	public function getBrandsByID($brandID)
	{
		$this->db->where('prod_cat_id', $brandID);
		$result = $this->db->get('prod_brand');
		return $result;
	}
	public function getBrandBySlug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('prod_brand');
		return $result;
	}
	// Brands Show End

	// Segment Functions //
	// Segments Show
	public function getSegmentsALL()
	{
		$this->db->order_by('title', 'desc');
		$result = $this->db->get('prod_segment');
		return $result;
	}
	public function getSegmentsByID($segmentID)
	{
		$this->db->where('prod_segment_id', $segmentID);
		$result = $this->db->get('prod_segment');
		return $result;
	}
	// Segments Show End

	// Combo Functions //
	public function getCombosALL()
	{
		$this->db->order_by('prod_combo_id', 'desc');
		$result = $this->db->get('prod_combo');
		return $result;
	}
	// Combo Functions End //
}
