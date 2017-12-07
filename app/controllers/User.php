<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');
		$this->load->model('User_model');
		$this->load->model('Location_Model');
	}

	public function regUser() {
		$regname = $_POST['name'];
		$reglastname = $_POST['lastname'];
		$regphone = $_POST['phone'];
		$regmail = $_POST['mail'];
		$regpass = $_POST['pass'];
		$paisID = $_POST['paisID'];
		$provinciaID = $_POST['provinciaID'];
		$partidoID = $_POST['partidoID'];
		$localidadID = $_POST['localidadID'];
		$barrioID = $_POST['barrioID'];
		$subbarrioID = $_POST['subbarrioID'];

		$additional_data = array(
			'first_name' => $regname,
			'last_name' => $reglastname,
			'username' => $regmail,
			'pais' => $paisID,
			'provincia' => $provinciaID,
			'partido' => $partidoID,
			'localidad' => $localidadID,
			'barrio' => $barrioID,
			'subbarrio' => $subbarrioID
		);

		$group = array('2');
		
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Get Basic Info For Page Meta
		$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Bienvenido';
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
		$data['titleSpot'] = 'Bienvenido';
		// Render Visualizations End

		$this->ion_auth->register($regmail, $regpass, $regmail, $additional_data, $group);

		$userID = getLastUserRegister();

		createIndCompany($userID);

		$this->load->view('auth/welcome', $data);
	}

	public function logUser() {

		$identity = $_POST['logmail'];
		$password = $_POST['logpass'];

		if(isset($_POST['logrem'])){
		  $remember = 1;
		}else{
		  $remember = 0;
		}

		$this->ion_auth->login($identity, $password, $remember);
		//echo $identity . ' ' . $password . ' ' . $remember;
		
		if ($this->ion_auth->login($identity, $password, $remember))
		{	
			redirect('Home','refresh');
		}
		else
		{
			// Load Renders for Navbar
			$data['menuCat'] = $this->Commercial_model->getCategoryALL();
			$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
			$data['menuInt'] = $this->Internal_model->getInternalALL();
			// Load Renders for Navbar End

			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Bienvenido';
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
			$data['titleSpot'] = 'Iniciar Sesion';
			// Render Visualizations End

			$data['loginFail'] = TRUE;

			// Load View
			$this->load->view('user/login', $data);
		}

	}

	public function logUserOut() {
		$this->ion_auth->logout();
		redirect('Home','refresh');
	}

	public function mustLog()
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
		if ($this->ion_auth->logged_in()) {
			
			redirect('Home','refresh');

		}else{
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Necesitas Logearte';
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
			$this->load->view('auth/mustlogin', $data);
		}
	}

	public function login()
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
		if ($this->ion_auth->logged_in()) {
			
			redirect('Home','refresh');

		}else{
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Iniciar Sesion';
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

			$data['loginFail'] = FALSE;

			// Load View
			$this->load->view('user/login', $data);
		}
	}

	public function register()
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
		if ($this->ion_auth->logged_in()) {
			
			redirect('Home','refresh');

		}else{
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Registrarse';
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
			$this->load->view('user/register', $data);
		}
	}

	public function personalInfo()
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
		if ($this->ion_auth->logged_in()) {
			// Handle User Info
			$userID = $this->ion_auth->get_user_id();
			$data['userNfo'] = $this->User_model->getByID($userID);
			
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Informacion Personal';
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
			$data['titleSpot'] = 'Informacion Personal';
			// Render Visualizations End

			// Load View
			$this->load->view('User/personaldata', $data);
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function changePersonalNfo()
	{
		// Render Title and Tags
		if ($this->ion_auth->logged_in()) {

		$userID = $this->ion_auth->get_user_id();
		$username =  $_POST['usernameMod'];
		$firstname =  $_POST['fnameMod'];
		$lastname =  $_POST['lnameMod'];
		$about =  $_POST['aboutMod'];
		$company =  $_POST['companyMod'];
		$adress =  $_POST['adressMod'];

		$pais =  $_POST['pais'];
		$provincia =  $_POST['provincia'];
		$partido =  $_POST['partido'];
		$localidad =  $_POST['localidad'];
		$barrio =  $_POST['barrio'];
		$subbarrio =  $_POST['subbarrio'];

		$zipcode =  $_POST['zipMod'];
		$phone =  $_POST['phoneMod'];
		$email =  $_POST['emailMod'];

		$data = array(
           'username' => $username,
           'first_name' => $firstname,
           'last_name' => $lastname,
           'about' => $about,
           'company' => $company,
           'adress' => $adress,
           'pais' => $pais,
           'provincia' => $provincia,
           'partido' => $partido,
           'localidad' => $localidad,
           'barrio' => $barrio,
           'subbarrio' => $subbarrio,
           'zip' => $zipcode,
           'phone' => $phone,
           'email' => $email
        );

		$this->db->where('id', $userID);
		$this->db->update('users', $data); 
		redirect('User/personalInfo','refresh');

		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}

	}

	public function securityInfo()
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
		if ($this->ion_auth->logged_in()) {
			// Handle User Info
			$userID = $this->ion_auth->get_user_id();
			$data['userNfo'] = $this->User_model->getByID($userID);
			
			$data['userID'] = $userID;
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Informacion de Seguridad';
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
			$data['titleSpot'] = 'Informacion de Seguridad';
			// Render Visualizations End

			// Load View
			$this->load->view('User/securityInfo', $data);
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function viewMsg($state)
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
		if ($this->ion_auth->logged_in()) {
			// Handle User Info
			$userID = $this->ion_auth->get_user_id();
			$data['userNfo'] = $this->User_model->getByID($userID);
			
			$data['userID'] = $userID;
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Informacion de Seguridad';
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
			if ($state == 1) {
				$data['titleSpot'] = 'Mensajes Nuevos';
			}elseif ($state == 2){
				$data['titleSpot'] = 'Mensajes Leidos';
			}elseif ($state == 3){
				$data['titleSpot'] = 'Mensajes Archivados';
			}else{
				redirect('User/viewMsg/1','refresh');
			}
			// Render Visualizations End

			// Message Filter
			$data['msgFilter'] = $state;
			// Message Filter End

			// Message Render
			$data['messages'] = $this->User_model->getMsgByID($userID);
			// Message Render End

			// Load View
			$this->load->view('User/message', $data);
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function stateMsg($msgID, $state, $view)
	{
		$data = array(
           'state' => $state
        );
		$this->db->where('msg_id', $msgID);
		$this->db->update('msg_system', $data);
		redirect('User/viewMsg/' . $view,'refresh');
	}
	public function deleteMsg($msgID, $view)
	{
		$this->db->where('msg_id', $msgID);
		$this->db->delete('msg_system');
		redirect('User/viewMsg/' . $view,'refresh');
	}
	public function respondMail() {
		$mailFrom = $_POST['IndName'];
		$mailToRespond = $_POST['mailToResp'];
		$messageFromInd = $_POST['respondTxt'];

		$message =  'Respuesta de: ' . $mailFrom . '<br />' .
	    			'Mensaje: ' . $messageFromInd . '<br />';

		$MailNfo = array(
            'sendto' => $mailToRespond,
            'message' =>  $message,
            'title' => 'Respuesta de ' . $mailFrom
        );
        $this->startMailProtocole($MailNfo, $mailToRespond);
        redirect('User/viewMsg/1','refresh');
	}

	function startMailProtocole($MailNfo, $mailToRespond)
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
	        $subject = $MailNfo['title'];	      
	        $sendto = $MailNfo['sendto'];
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