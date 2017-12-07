<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_Buy_model extends CI_Model
{
	public function __construct(){
		parent::__construct();			
	}

	
 	public function saveListBuy($data)
	{	
		$this->db->insert('list_buys', $data);					
		return $this->db->insert_id();
	}

	public function setFeedback($data)
	{	
		$this->db->where('id', $data['list_id']);	
		$this->db->set('feedback', $data['feedback']);
		return $this->db->update('list_buys');
	}

	public function getListsBuy()
	{	
		$this->db->where('usr_id', getMyID());	
		$this->db->where('listType', LIST_TYPE_BUY);				
		$this->db->order_by('date');
		$this->db->join('list_buy_prods', 'list_buys.id = list_buy_prods.id_list');
		return $this->db->get('list_buys');
	}
	
	public function getUserLists()
	{	
		$this->db->where('usr_id', getMyID());	
		$this->db->where('listType', LIST_TYPE_USER_LIST);				
		$this->db->order_by('date');		
		return $this->db->get('list_buys');
	}

	public function getUserListProds()
	{	
		$this->db->where('usr_id', getMyID());	
		$this->db->where('listType', LIST_TYPE_USER_LIST);				
		$this->db->order_by('date');
		$this->db->join('list_buy_prods', 'list_buys.id = list_buy_prods.id_list', 'left');
		return $this->db->get('list_buys');
	}

	public function deleteList($data) {		 
		
		$this->db->where('usr_id', $data['usr_id']);
		$this->db->where('id', $data['id']);
		return $this->db->delete('list_buys');

	}

	public function getListById($id) {
		$this->db->where('id', $id);
		$this->db->join('list_buy_prods', 'list_buys.id = list_buy_prods.id_list');
		$this->db->join('product', 'list_buy_prods.id_prod = product.prod_id');
		return $this->db->get('list_buys');
	}
 


}

?>