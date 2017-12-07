<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_Model extends CI_Model
{

	public function getPais()
	{	
		$this->db->order_by('id','asc');
		$result = $this->db->get('pais');
		return $result;
	}
	public function getPaisByPais($paisID)
	{	
		$this->db->where('idPais', $paisID);
		$this->db->order_by('id','asc');
		$result = $this->db->get('pais');
		return $result;
	}

	public function getProvincia()
	{	
		$this->db->order_by('id','asc');
		$result = $this->db->get('provincias');
		return $result;
	}
	public function getProvinciaByPais($paisID)
	{	
		$this->db->where('idPais', $paisID);
		$this->db->order_by('id','asc');
		$result = $this->db->get('provincias');
		return $result;
	}

	public function getPartido()
	{	
		$this->db->order_by('id','asc');
		$result = $this->db->get('partidos');
		return $result;
	}
	public function getPartidoByProvincia($provinciaID)
	{	
		$this->db->where('idProvincia', $provinciaID);
		$this->db->order_by('id','asc');
		$result = $this->db->get('partidos');
		return $result;
	}

	public function getLocalidad()
	{	
		$this->db->order_by('id','asc');
		$result = $this->db->get('localidades');
		return $result;
	}
	public function getLocalidadByPartido($partidoID)
	{	
		$this->db->where('idPartido', $partidoID);
		$this->db->order_by('id','asc');
		$result = $this->db->get('localidades');
		return $result;
	}

	public function getBarrio()
	{	
		$this->db->order_by('id','asc');
		$result = $this->db->get('barrios');
		return $result;
	}
	public function getBarrioByLocalidad($localidadID)
	{	
		$this->db->where('idLocalidad', $localidadID);
		$this->db->order_by('id','asc');
		$result = $this->db->get('barrios');
		return $result;
	}

	public function getSubBarrio()
	{	
		$this->db->order_by('id','asc');
		$result = $this->db->get('subbarrios');
		return $result;
	}
	public function getSubBarrioByBarrio($barrioID)
	{	
		$this->db->where('idBarrio', $barrioID);
		$this->db->order_by('id','asc');
		$result = $this->db->get('subbarrios');
		return $result;
	}
}