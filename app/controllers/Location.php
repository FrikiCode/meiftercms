<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Location_Model');			
	}

	public function getProvincia()
	{
		echo '<option value="0" selected>Selecciona tu Provincia</option>';
		if($this->input->post('paisID'))
		{
			$paisID = $this->input->post('paisID');
			$provincia = $this->Location_Model->getProvinciaByPais($paisID);			
			foreach($provincia->result() as $t)
			{
				echo '<option value="' . $t->id . '">' . $t->nombre . '</option>';
			}
		}
	}

	public function getPartido()
	{
		echo '<option value="0" selected>Selecciona tu Partido</option>';
		if($this->input->post('provinciaID'))
		{
			$provinciaID = $this->input->post('provinciaID');
			$pais = $this->Location_Model->getPartidoByProvincia($provinciaID);			
			foreach($pais->result() as $t)
			{
				echo '<option value="' . $t->id . '">' . $t->nombre . '</option>';
			}
		}
	}

	public function getLocalidad()
	{
		echo '<option value="0" selected>Selecciona tu Localidad</option>';
		if($this->input->post('partidoID'))
		{
			$partidoID = $this->input->post('partidoID');
			$pais = $this->Location_Model->getLocalidadByPartido($partidoID);			
			foreach($pais->result() as $t)
			{
				echo '<option value="' . $t->id . '">' . $t->nombre . '</option>';
			}
		}
	}

	public function getBarrio()
	{
		echo '<option value="0" selected>Selecciona tu Barrio</option>';
		if($this->input->post('localidadID'))
		{
			$localidadID = $this->input->post('localidadID');
			$pais = $this->Location_Model->getBarrioByLocalidad($localidadID);			
			foreach($pais->result() as $t)
			{
				echo '<option value="' . $t->id . '">' . $t->nombre . '</option>';
			}
		}
	}

	public function getSubbarrio()
	{
		echo '<option value="0" selected>Selecciona tu Sub Barrio</option>';
		if($this->input->post('barrioID'))
		{
			$barrioID = $this->input->post('barrioID');
			$pais = $this->Location_Model->getSubBarrioByBarrio($barrioID);			
			foreach($pais->result() as $t)
			{
				echo '<option value="' . $t->id . '">' . $t->nombre . '</option>';
			}
		}
	}

}