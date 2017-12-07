<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_Buy_Prods_model extends CI_Model
{
	public function __construct(){
		parent::__construct();			
	}

	
 	public function saveListProd($data)
	{	
		$this->db->insert('list_buy_prods', $data);					
		return $this->db->insert_id();
	}


 	public function addProdToList($data)
	{	
		//check if product is already added in cart
		$this->db->where('id_list', $data['id_list']);
		$this->db->where('id_prod', $data['id_prod']);
		
		if(count($this->db->get('list_buy_prods')->result()) == 0) {
			return $this->db->insert('list_buy_prods', $data);											
		} else { //if exists, ads one in quantity
			$this->db->where('id_list', $data['id_list']);
			$this->db->where('id_prod', $data['id_prod']);
			$this->db->set('quantity', 'quantity+1', FALSE);
			return $this->db->update('list_buy_prods');
		}	
	}


}

?>