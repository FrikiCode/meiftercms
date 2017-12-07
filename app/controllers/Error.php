<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	
		$this->load->model('Location_Model');			
	}
	
	public function NotFound()
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Error';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Render Visualizations
		$data['titleSpot'] = 'Error 404';
		// Render Visualizations End

		// Location Script
		$data['pais'] = $this->Location_Model->getPais();
		// Location Script End
		
		$this->load->view('errors/error404', $data);
	}
}
