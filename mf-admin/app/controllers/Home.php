<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		if ($this->ion_auth->logged_in()) {

			$this->load->view('v2/home');

		}else{

			redirect('/auth/login');

		}

	}
}
