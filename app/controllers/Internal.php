<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');
		$this->load->model('Location_Model');			
	}

	public function getInternal($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'internal';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End
		
		// Retrive Nfo from Internal
		$data['internal'] = $this->Internal_model->getInternalBySlug($slug);
		
		// Render for Package Detail
		// Render Title and Tags
		if ($data['internal']->num_rows() > 0) {
			foreach ($data['internal']->result() as $int) {
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $int->title;
			}
			$data['charset'] = getSiteConfiguration()['site_charset'];
			$data['description'] = getSiteConfiguration()['site_desc'];
			$data['keywords'] = getSiteConfiguration()['site_keywords'];
			$data['language'] = getSiteConfiguration()['site_lang'];
			$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
			$data['favicon'] = getSiteConfiguration()['site_favicon'];
			$data['author'] = getSiteConfiguration()['site_author'];

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			// Render Visualizations
			$data['titleSpot'] = $int->title;
			// Render Visualizations End

			// Load View
			$this->load->view('internal/internal', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function faq()
	{
		// Navbar Configuration
		$data['navbarConf'] = 'internal';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		$data['faq'] = $this->Internal_model->getAllFaqs();
		// Load Renders for Navbar End
		
		// Render for Package Detail
		// Render Title and Tags
		$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Preguntas Frecuentes';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Render Visualizations
		$data['titleSpot'] = 'F.A.Q.';
		// Render Visualizations End

		// Location Script
		$data['pais'] = $this->Location_Model->getPais();
		// Location Script End

		// Load View
		$this->load->view('internal/faq', $data);
	}

}