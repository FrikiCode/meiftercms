<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale_Registry_model extends CI_Model
{
	public function __construct(){
		parent::__construct();			
	}

	
 	public function saveSaleRegistry($data)
	{	
		$this->db->insert('sale_registry', $data);					
		return $this->db->insert_id();
	}
	


}

?>