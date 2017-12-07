<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{
	public function __construct(){
		parent::__construct();			
	}

	public function updateIpToIdCart($ip, $usr_id)
	{			 
		//check if product is already added in cart
		$this->db->where('usr_id', $ip);
		$this->db->set('usr_id', $usr_id, FALSE);			
		return $this->db->update('cart');


	}	

	public function saveProductCart($data)
	{	
		//check if product is already added in cart
		$this->db->where('usr_id', $data['usr_id']);
		$this->db->where('prod_id', $data['prod_id']);
		
		if(count($this->db->get('cart')->result()) == 0) {
			$data['prod_quantity']	= 1;
			return $this->db->insert('cart', $data);	
		} else { //if exists, ads one in quantity
			$this->db->set('prod_quantity', 'prod_quantity+1', FALSE);
			return $this->db->update('cart');
		}		
	}

	public function addOneProductCart($data)
	{	
		$this->db->where('usr_id', $data['usr_id']);
		$this->db->where('prod_id', $data['prod_id']);
		$this->db->set('prod_quantity', 'prod_quantity+1', FALSE);
		return $this->db->update('cart');
	}

	public function minusOneProductCart($data)
	{	
		$this->db->where('usr_id', $data['usr_id']);
		$this->db->where('prod_id', $data['prod_id']);
		$this->db->set('prod_quantity', 'prod_quantity-1', FALSE);
		return $this->db->update('cart');
	}


	public function deleteProductCart($data) {

		$this->db->where('usr_id', $data['usr_id']);
		$this->db->where('prod_id', $data['prod_id']);
		return $this->db->delete('cart');

	}

	public function getCartData($user_id = null)
	{	
		if($user_id != null) {
			$usr_id = $user_id;
		} else if (!$this->ion_auth->logged_in()) {   			 
   			$usr_id = $_SERVER['REMOTE_ADDR'];    			
   		} else {
   			$usr_id = getMyID();
   		}
   		 
		$this->db->where('usr_id', $usr_id);
		$this->db->join('product', 'cart.prod_id = product.prod_id');
		$cartResult = $this->db->get('cart');
		return $cartResult;
	}
	
	public function deleteCartData($usrId) {

		$this->db->where('usr_id', $usrId);		 
		return $this->db->delete('cart');

	}

	public function getPromoCodeNfo($data)
	{	
		$this->db->where('disc_code', $data['disc_code']);
		$promocode = $this->db->get('promo_code');
		return $promocode;
	}
}

?>