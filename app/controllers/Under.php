<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Under extends CI_Controller {
	
	public function __construct(){
		parent::__construct();			
	}

	public function index()
	{
		if (getSiteConfiguration()['cooming_soon'] == true) {
		
		// Render Title and Tags
		// Get Basic Info For Page Meta
		$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Mantenimiento';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Load View
		$this->load->view('internal/construccion', $data);
		
		}else{
			redirect('Home', 'refresh');
		}
	}

}