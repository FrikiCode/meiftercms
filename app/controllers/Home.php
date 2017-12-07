<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');
		$this->load->model('Location_Model');
		$this->load->model('Testimonial_model');
	}

	public function index()
	{
		if (getSiteConfiguration()['cooming_soon'] == false) {
			// Navbar Configuration
			$data['navbarConf'] = 'main';
			// Navbar Configuration End
			// Load Renders for Navbar
			$data['menuCat'] = $this->Commercial_model->getCategoryALL();
			$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
			$data['menuInt'] = $this->Internal_model->getInternalALL();
			// Load Renders for Navbar End

			// Get Products Dest
			$data['productDest'] = $this->Commercial_model->getProdDest();
			// Get Products Dest End

			// Get Testimonials
			$data['testimonials'] = $this->Testimonial_model->getTestimonialALL();
			// Get Testimonials End

			// Get Testimonials
			$data['abouts'] = $this->Internal_model->getAllAbouts();
			// Get Testimonials End

			// Get Combos
			$data['combos'] = $this->Commercial_model->getCombosALL();
			// Get Combos End

			// Render Title and Tags
			$data['title'] = getSiteConfiguration()['site_name'];
			$data['charset'] = getSiteConfiguration()['site_charset'];
			$data['description'] = getSiteConfiguration()['site_desc'];
			$data['keywords'] = getSiteConfiguration()['site_keywords'];
			$data['language'] = getSiteConfiguration()['site_lang'];
			$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
			$data['favicon'] = getSiteConfiguration()['site_favicon'];
			$data['author'] = getSiteConfiguration()['site_author'];
			// Render Title and Tags End

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			$this->load->view('newdesign/home', $data);
		}else{
			redirect('Under', 'refresh');
		}
	}
}
