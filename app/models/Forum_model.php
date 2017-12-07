<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum_model extends CI_Model
{

	public function getForumCats()
	{	
		$this->db->order_by('for_cat_id','asc');
		$result = $this->db->get('forum_cat');
		return $result;
	}
	public function getForumCatBySlug($slug)
	{	
		$this->db->order_by('for_cat_id','asc');
		$this->db->where('slug', $slug);
		$result = $this->db->get('forum_cat');
		return $result;
	}
	public function getForumTopicByCatID($id)
	{	
		$this->db->order_by('date','asc');
		$this->db->where('for_cat_id', $id);
		$result = $this->db->get('forum_topic');
		return $result;
	}
	public function getForumTopicBySlug($slug)
	{	
		$this->db->order_by('for_topic_id','asc');
		$this->db->where('slug', $slug);
		$result = $this->db->get('forum_topic');
		return $result;
	}
	public function getForumTopicByID($ID)
	{	
		$this->db->where('for_topic_id', $ID);
		$result = $this->db->get('forum_topic');
		return $result;
	}
	public function getForumCommentsByTopicID($ID)
	{
		$this->db->where('for_topic_id', $ID);
		$result = $this->db->get('forum_comment');
		return $result;
	}
}