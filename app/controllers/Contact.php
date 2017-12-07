<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');
		$this->load->model('User_model');
		$this->load->model('Location_Model');
	}

	public function index()
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
		// Render Title and Tags
		// Get Basic Info For Page Meta
		$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Contacto';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Render Visualizations
		$data['titleSpot'] = 'Contacto';
		// Render Visualizations End

		// Location Script
		$data['pais'] = $this->Location_Model->getPais();
		// Location Script End

		// Load View
		$this->load->view('newdesign/contact', $data);


	}

	public function contactSent() {
		$message =  'Nombre: ' . $_POST['name'] . "\r\n" .
	    			'Email: ' . $_POST['email'] . "\r\n" .
				    'Asunto: '	. $_POST['subject'] . "\r\n" .
				    'Mensaje: ' . $_POST['message'] . "\r\n";
		$userMail = $_POST['email'];

		$MailNfo = array(
            'sendto' => $userMail,
            'message' =>  $message,
        );
        $this->startMailProtocole($MailNfo);
	}

	function startMailProtocole($MailNfo)
	{
		$this->db->from('smtp_mail_conf');
		$this->db->where('smtp_conf_id', 1);
		$smtp = $this->db->get();
		foreach ($smtp->result() as $row) {
			$from = $row->from;
		}

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = getMailConfiguration()['smtp_host'];
		$config['smtp_port']    = getMailConfiguration()['smtp_port'];
		$config['smtp_timeout'] = getMailConfiguration()['smtp_timeout'];
		$config['smtp_user']    = getMailConfiguration()['smtp_user'];
		$config['smtp_pass']    = getMailConfiguration()['smtp_pass'];
		$config['charset']    = getMailConfiguration()['smtp_charset'];
		$config['newline']    = getMailConfiguration()['smtp_newline'];
		$config['mailtype'] = getMailConfiguration()['smtp_mailtype'];
		$config['validation'] = getMailConfiguration()['smtp_validation'];

	    for ($i = 0; $i < 1; $i++) {
	        $subject = 'Consulta Web';
	        //$sendto = $from; ??
	        //$sendto = "leonmsaia@gmail.com";
	        $sendto = "leonmsaia@gmail.com";
	        $this->email->initialize($config);
	        $this->email->from($from, getSiteConfiguration()['site_name']);
	        $this->email->to($sendto);
	        $this->email->reply_to($from, getSiteConfiguration()['site_name']);
	        $this->email->subject($subject);
	        $this->email->message($MailNfo['message']);
	        $this->email->send();
	        echo $this->email->print_debugger();
	        $i + 1;
	    }

	}

}
