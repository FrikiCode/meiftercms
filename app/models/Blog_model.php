<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model
{
	// Blog Functions //
	// Blog Show
	public function getPostALL()
	{	
		$result = $this->db->get('post');
		return $result;
	}
	// Blog Show End

	// Post Functions
	public function getPostBySlug($slug)
	{	
		$this->db->where('slug', $slug);
		$result = $this->db->get('post');
		return $result;
	}
	// Post Functions End

	// Blog Category
	public function getCategoryALL()
	{
		$result = $this->db->get('post_categorie');
		return $$result;
	}
	public function getCategoryBySlug($slug)
	{	
		$this->db->where('slug', $slug);
		$result = $this->db->get('post_categorie');
		return $result;
	}
	public function getPostByCatID($cat_id)
	{	
		$this->db->where('categorie_id', $cat_id);
		$result = $this->db->get('post');
		return $result;
	}

}