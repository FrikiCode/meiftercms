<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	
		$this->load->model('Blog_model');	
		$this->load->model('Location_Model');	
	}

	public function getBlog()
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Render Title and Tags
		// Get Basic Info For Page Meta
		$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Blog';
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

		// Cast Posts
		$data['posts'] = $this->Blog_model->getPostALL();

		// Load View
		$this->load->view('blog/blog', $data);
	}

	public function getPost($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Serialize Post by Slug
		$data['post'] = $this->Blog_model->getPostBySlug($slug);
		// Render Title and Tags
		if ($data['post']->num_rows() > 0) {
			
			foreach ($data['post']->result() as $Post) {
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $Post->title;
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
			$this->load->view('blog/post', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function getBlogCategory($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Serialize Post by Slug
		$data['postCat'] = $this->Blog_model->getCategoryBySlug($slug);
		
		// Render Title and Tags
		if ($data['postCat']->num_rows() > 0) {
			
			foreach ($data['postCat']->result() as $Post) {
				$blogCat = $Post->categorie_id;
				$data['posts'] = $this->Blog_model->getPostByCatID($blogCat);
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $Post->title;
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
			$this->load->view('blog/category', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

}