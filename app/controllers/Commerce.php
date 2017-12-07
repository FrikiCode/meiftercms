<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commerce extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');
		$this->load->model('Location_Model');
	}

	public function getCategory($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Get Testimonials
		$data['abouts'] = $this->Internal_model->getAllAbouts();
		// Get Testimonials End
		//
		// Retrive Nfo from Internal
		$data['category'] = $this->Commercial_model->getCategoryBySlug($slug);

		// Get all Categories
		$data['categories'] = $this->Commercial_model->getCategoryALL();
		// Get all Categories End

		// Render Title and Tags
		if ($data['category']->num_rows() > 0) {

			foreach ($data['category']->result() as $cat) {
				// Save Category ID
				$catID = $cat->prod_cat_id;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $cat->title;
			}
			$data['charset'] = getSiteConfiguration()['site_charset'];
			$data['description'] = getSiteConfiguration()['site_desc'];
			$data['keywords'] = getSiteConfiguration()['site_keywords'];
			$data['language'] = getSiteConfiguration()['site_lang'];
			$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
			$data['favicon'] = getSiteConfiguration()['site_favicon'];
			$data['author'] = getSiteConfiguration()['site_author'];

			// Cast Products from Category
			$data['products'] = $this->Commercial_model->getProductByCat($catID);

			// Cast Last 5 Productos
			$data['lastProd'] = $this->Commercial_model->getLastFiveProds();

			// Cast All Brands
			$data['brands'] = $this->Commercial_model->getBrandsALL();

			// Cast All Segments
			$data['segments'] = $this->Commercial_model->getSegmentsALL();

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			// Load View
			$this->load->view('newdesign/category', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function getBrand($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Retrive Nfo from Internal
		$data['brand'] = $this->Commercial_model->getBrandBySlug($slug);

		// Render Title and Tags
		if ($data['brand']->num_rows() > 0) {

			foreach ($data['brand']->result() as $brand) {
				// Save brand ID
				$brandID = $brand->prod_brand_id;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $brand->title;
			}
			$data['charset'] = getSiteConfiguration()['site_charset'];
			$data['description'] = getSiteConfiguration()['site_desc'];
			$data['keywords'] = getSiteConfiguration()['site_keywords'];
			$data['language'] = getSiteConfiguration()['site_lang'];
			$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
			$data['favicon'] = getSiteConfiguration()['site_favicon'];
			$data['author'] = getSiteConfiguration()['site_author'];

			// Cast Products from Brand
			$data['products'] = $this->Commercial_model->getProdsByCat($brandID);

			// Cast All Brands
			$data['brands'] = $this->Commercial_model->getBrandsALL();

			// Cast All Segments
			$data['segments'] = $this->Commercial_model->getSegmentsALL();

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			// Load View
			$this->load->view('commercial/brand', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function getProduct($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End

		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Get all Categories
		$data['categories'] = $this->Commercial_model->getCategoryALL();
		// Get all Categories End

		// Cast Last 5 Productos
		$data['lastProd'] = $this->Commercial_model->getLastFiveProds();

		$data['product'] = $this->Commercial_model->getProdBySlug($slug);
		$data['productDest'] = $this->Commercial_model->getProdDest();

		if ($data['product']->num_rows() > 0) {
			foreach ($data['product']->result() as $pro) {
				// Save Category ID
				$prodID = $pro->prod_id;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $pro->name;
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

			// Load View
			$this->load->view('newdesign/product', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}

	}
}
