<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	
		$this->load->model('Location_Model');
		$this->load->model('Membership_model');
		$this->load->helper('mpProduction');
	}

	public function userMembership($userID)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'internal';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End
		
		// Render for Package Detail
		// Render Title and Tags
		if ($userID == getMyID()) {
			$data['title'] = getSiteConfiguration()['site_name'] . ' | Membresia';
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
			$data['titleSpot'] = 'Membresia';
			// Render Visualizations End

			// Membership Render
			$data['membresias'] = $this->Membership_model->getMembershipTypes();
			// Membership Render End

			// User ID
			$data['user_id'] = $userID;
			// User ID End

			// Membership Status
			$data['memStatus'] = $this->Membership_model->getMembershipStatus($userID);
			
			// Load View
			$this->load->view('membership/membershippanel', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}
}