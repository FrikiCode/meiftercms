<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rrhh extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	
		$this->load->model('Location_Model');	
		$this->load->model('Rrhh_model');
	}

	public function viewRrhhHome()
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
		$data['title'] = getSiteConfiguration()['site_name'] . ' | RRHH';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Render Visualizations
		$data['titleSpot'] = 'Mercado de Candidatos';
		// Render Visualizations End

		// Location Script
		$data['pais'] = $this->Location_Model->getPais();
		// Location Script End

		// Load View
		$this->load->view('rrhh/home', $data);
	}

	public function uploadCV()
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
		$data['title'] = getSiteConfiguration()['site_name'] . ' | RRHH';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Render Visualizations
		$data['titleSpot'] = 'Cargar CV';
		// Render Visualizations End

		// Location Script
		$data['pais'] = $this->Location_Model->getPais();
		// Location Script End

		// Render Directory Categories
		$data['categories'] = $this->Rrhh_model->getCategoryALL();
		// Render Directory Categories End

		// Load View
		$this->load->view('rrhh/registerAsCand', $data);
	}

	public function viewDirectory()
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
		$data['title'] = getSiteConfiguration()['site_name'] . ' | RRHH';
		$data['charset'] = getSiteConfiguration()['site_charset'];
		$data['description'] = getSiteConfiguration()['site_desc'];
		$data['keywords'] = getSiteConfiguration()['site_keywords'];
		$data['language'] = getSiteConfiguration()['site_lang'];
		$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
		$data['favicon'] = getSiteConfiguration()['site_favicon'];
		$data['author'] = getSiteConfiguration()['site_author'];

		// Render Visualizations
		$data['titleSpot'] = 'Directorio de Candidatos';
		// Render Visualizations End

		// Location Script
		$data['pais'] = $this->Location_Model->getPais();
		// Location Script End

		// Render Directory Categories
		$data['categories'] = $this->Rrhh_model->getCategoryALL();
		// Render Directory Categories End

		// Load View
		$this->load->view('rrhh/directory', $data);
	}

	public function regCand() {
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

		$group = array('3');
		
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

		createCand($userID);

		$this->load->view('rrhh/welcome', $data);
	}

	public function editCand($candID)
	{
		$userID = getMyID();
		$myCandID = getCandUserByID($userID);

		if ($candID == $myCandID) {		
			// Navbar Configuration
			$data['navbarConf'] = 'commercial';
			// Navbar Configuration End
			// Load Renders for Navbar
			$data['menuCat'] = $this->Commercial_model->getCategoryALL();
			$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
			$data['menuInt'] = $this->Internal_model->getInternalALL();
			// Load Renders for Navbar End

			// Render Title and Tags
			$data['title'] = getSiteConfiguration()['site_name'] . ' | Editar mi Perfil';
			$data['charset'] = getSiteConfiguration()['site_charset'];
			$data['description'] = getSiteConfiguration()['site_desc'];
			$data['keywords'] = getSiteConfiguration()['site_keywords'];
			$data['language'] = getSiteConfiguration()['site_lang'];
			$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
			$data['favicon'] = getSiteConfiguration()['site_favicon'];
			$data['author'] = getSiteConfiguration()['site_author'];

			// Render Visualizations
			$data['titleSpot'] = 'Editar Perfil';
			// Render Visualizations End

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			// Render Directory Categories
			$data['categories'] = $this->Rrhh_model->getCategoryALL();
			// Render Directory Categories End

			// Render Candidate Info
			$data['candInfo'] = $this->Rrhh_model->getCandidatesByCandID($candID);
			// Render Candidate Info End

			// Load View
			$this->load->view('rrhh/editcand', $data);
		}else{
			// Error Forbiden Access
			redirect('Home','refresh');
		}
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

		// Retrive Nfo from Internal
		$data['category'] = $this->Rrhh_model->getCategoryBySlug($slug);

		// Render Title and Tags
		if ($data['category']->num_rows() > 0) {
			
			foreach ($data['category']->result() as $cat) {
				// Save Category ID
				$catID = $cat->rrhh_cat_id;
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

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			// Render Visualizations
			$data['titleSpot'] = $cat->title;
			// Render Visualizations End

			// Get Candidates per Category
			$data['candidates'] = $this->Rrhh_model->getCandidatesByCatID($catID);
			// Get Candidates per Category End

			// Render Directory Categories
			$data['categories'] = $this->Rrhh_model->getCategoryALL();
			// Render Directory Categories End

			// Load View
			$this->load->view('rrhh/category', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function getCandidate($id)
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
		$data['candidate'] = $this->Rrhh_model->getCandidatesByCandID($id);

		// Render Title and Tags
		if ($data['candidate']->num_rows() > 0) {
			
			foreach ($data['candidate']->result() as $cand) {
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $cand->firstname . ' ' . $cand->lastname;
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
			$data['titleSpot'] = $cand->firstname . ' ' . $cand->lastname;
			// Render Visualizations End

			// Render Directory Categories
			$data['categories'] = $this->Rrhh_model->getCategoryALL();
			// Render Directory Categories End

			// Load View
			$this->load->view('rrhh/candidate', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function mycandidates()
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


		// Get Basic Info For Page Meta
		$data['title'] = getSiteConfiguration()['site_name'] . ' | Mis Candidatos';
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
		$data['titleSpot'] = 'Mis Candidatos';
		// Render Visualizations End

		// Load View
		$this->load->view('rrhh/candidatesList', $data);
	}

	// Save values for Candidate Settings
	public function saveCandidateValues()
	{

		$userID = getMyID();
		$myCandID = getCandUserByID($userID);
		$candID = $_POST['candID'];
		if ($candID == $myCandID) {
			if(isset($_POST['firstname'])){
				$nombre = $_POST['firstname'];
			}else{
			  	$nombre = null;
			}
			if(isset($_POST['lastname'])){
				$apellido = $_POST['lastname'];
			}else{
				$apellido = null;
			}
			if(isset($_POST['birthdate'])){
				$fechaNac = $_POST['birthdate'];
			}else{
				$fechaNac = null;
			}
			if(isset($_POST['doc'])){
				$documento = $_POST['doc'];
			}else{
				$documento = null;
			}
			if(isset($_POST['docType'])){
				$tipoDocumento = $_POST['docType'];
			}else{
				$tipoDocumento = null;
			}
			if(isset($_POST['sex'])){
				$genero = $_POST['sex'];
			}else{
				$genero = null;
			}
			if(isset($_POST['short_desc'])){
				$desCorta = $_POST['short_desc'];
			}else{
				$desCorta = null;
			}
			if(isset($_POST['bio'])){
				$biografia = $_POST['bio'];
			}else{
				$biografia = null;
			}
			if(isset($_POST['profesion'])){
				$profesion = $_POST['profesion'];
			}else{
				$profesion = null;
			}
			if(isset($_POST['phone'])){
				$telefono = $_POST['phone'];
			}else{
				$telefono = null;
			}
			if(isset($_POST['mail'])){
				$mail = $_POST['mail'];
			}else{
				$mail = null;
			}
			if(isset($_POST['salary'])){
				$salario = $_POST['salary'];
			}else{
				$salario = null;
			}
			if(isset($_POST['status'])){
				$estado = $_POST['status'];
			}else{
				$estado = null;
			}

			$data = array(
				'firstname' => $nombre,
				'lastname' => $apellido,
				'birthdate' => $fechaNac,
				'doc' => $documento,
				'doc_type' => $tipoDocumento,
				'sex' => $genero,
				'short_desc' => $desCorta,
				'bio' => $biografia,
				'profesion' => $profesion,
				'phone' => $telefono,
				'mail' => $mail,
				'salary' => $salario,
				'status' => $estado,
	        );
			$this->db->where('rrhh_cand_id', $candID);
			$this->db->update('rrhh_cand', $data);

			redirect('Rrhh/editCand/' . $candID,'refresh');
		}else{
			// Error Forbiden Access
			redirect('Home','refresh');
		}
	}

}