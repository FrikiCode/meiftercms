<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industrial extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	
		$this->load->model('Location_Model');	
		$this->load->model('Industrial_model');		
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
		
		// Industrial Render
		$data['industrialCatList'] = $this->Industrial_model->getIndCats();
		// Industrial Render End
		
		// Render Title and Tags
		// Get Basic Info For Page Meta
		$data['title'] = getSiteConfiguration()['site_name'] . ' | Empresas Certificadas';
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
		$data['titleSpot'] = 'Empresas Certificadas';
		// Render Visualizations End

		// Load View
		$this->load->view('industrial/home', $data);
		}

	public function getIndSubCategory($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Industrial Render
		$data['industrialCatList'] = $this->Industrial_model->getIndCats();
		// Industrial Render End

		// Retrive Nfo from Internal
		$data['indsubcategory'] = $this->Industrial_model->getIndSubcatBySlug($slug);

		// Render Title and Tags
		if ($data['indsubcategory']->num_rows() > 0) {
			
			foreach ($data['indsubcategory']->result() as $subcat) {
				// Save Category ID
				$subcatID = $subcat->indsubcat_id;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $subcat->name;
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
			$data['titleSpot'] = $subcat->name;
			// Render Visualizations End

			// List of Industrial by Subcat
			$data['industrialList'] = $this->Industrial_model->getIndByIndSubcatID($subcatID);

			// Load View
			$this->load->view('industrial/subcategory', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function getIndustrial($slug)
	{
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Industrial Render
		$data['industrialCatList'] = $this->Industrial_model->getIndCats();
		// Industrial Render End

		// Retrive Nfo from Internal
		$data['industrial'] = $this->Industrial_model->getIndustrialBySlug($slug);

		// Render Title and Tags
		if ($data['industrial']->num_rows() > 0) {
			
			foreach ($data['industrial']->result() as $ind) {
				// Save Category ID
				$indID = $ind->ind_id;
				$userID = $ind->user_id;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $ind->title;
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
			$data['titleSpot'] = $ind->title;
			// Render Visualizations End

			if ($ind->status == 1) {
				// Load View
				$this->load->view('industrial/industrial', $data);
			}else{
				$data['titleSpot'] = 'Industria No Encontrada';
				// Load View
				$data['owner'] = $userID;
				$data['industriaID'] = $indID;
				$this->load->view('Errors/activateInd', $data);
			}
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function editIndustrial($ind_id)
	{
		$userID = getMyID();
		$myIndustrialID = getIndustrialUserByID($userID);
		if ($ind_id == $myIndustrialID) {
			// Navbar Configuration
			$data['navbarConf'] = 'commercial';
			// Navbar Configuration End
			// Load Renders for Navbar
			$data['menuCat'] = $this->Commercial_model->getCategoryALL();
			$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
			$data['menuInt'] = $this->Internal_model->getInternalALL();
			// Load Renders for Navbar End

			// Industrial Render
			$data['industrialCatList'] = $this->Industrial_model->getIndCats();
			// Industrial Render End

			// Retrive Nfo from Internal
			$data['industrial'] = $this->Industrial_model->getIndustrialByID($ind_id);

			// Render Title and Tags
			if ($data['industrial']->num_rows() > 0) {
				
				foreach ($data['industrial']->result() as $ind) {
					// Save Category ID
					$indID = $ind->ind_id;
					// Get Basic Info For Page Meta
					$data['title'] = getSiteConfiguration()['site_name'] . ' | Editar Industria';
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

				// Industrial Category Script
				$data['indcat'] = $this->Industrial_model->getIndCats();
				// Industrial Category Script End

				// Industrial Certifications
				$data['certificates'] = $this->Industrial_model->getIndCerts();
				// Industrial Certifications End
				
				// Render Visualizations
				$data['titleSpot'] = 'Editar Industria';
				// Render Visualizations End

				// Industrial ID
				$data['indID'] = $ind_id;
				// Industrial ID End

				// Load View
				$this->load->view('industrial/editindustrial', $data);
			}else{
				// Error 404 Page
				redirect('Error/NotFound', 'refresh');
			}
		}else{
			// Error Forbiden Access
			redirect('Home','refresh');
		}
	}

	// Get Values for Dropdowns
	public function getIndSubcategoryForDd()
	{
		echo '<option value="0" selected>Selecciona tu Sub Categoria</option>';
		if($this->input->post('indcatID'))
		{
			$indcatID = $this->input->post('indcatID');
			$subcate = $this->Industrial_model->getSubcategoryByCategory($indcatID);			
			foreach($subcate->result() as $t)
			{
				echo '<option value="' . $t->indsubcat_id . '">' . $t->name . '</option>';
			}
		}
	}
	// Get Values for Dropdowns End

	// Save values for Industrial Settings
	public function saveIndustrialValues()
	{
		$userID = getMyID();
		$myIndustrialID = getIndustrialUserByID($userID);
		$indID = $_POST['indID'];
		if ($indID == $myIndustrialID) {
			if(isset($_POST['title'])){
				$title = $_POST['title'];
			}else{
			  	$title = null;
			}
			if(isset($_POST['slug'])){
				$slug = $_POST['slug'];
			}else{
				$slug = null;
			}
			if(isset($_POST['indsubcatID'])){
				$indsubcatID = $_POST['indsubcatID'];
			}else{
				$indsubcatID = null;
			}
			if(isset($_POST['adress'])){
				$adress = $_POST['adress'];
			}else{
				$adress = null;
			}
			if(isset($_POST['number'])){
				$number = $_POST['number'];
			}else{
				$number = null;
			}
			if(isset($_POST['paisID'])){
				$paisID = $_POST['paisID'];
			}else{
				$paisID = null;
			}
			if(isset($_POST['provinciaID'])){
				$provinciaID = $_POST['provinciaID'];
			}else{
				$provinciaID = null;
			}
			if(isset($_POST['partidoID'])){
				$partidoID = $_POST['partidoID'];
			}else{
				$partidoID = null;
			}
			if(isset($_POST['localidadID'])){
				$localidadID = $_POST['localidadID'];
			}else{
				$localidadID = null;
			}
			if(isset($_POST['barrioID'])){
				$barrioID = $_POST['barrioID'];
			}else{
				$barrioID = null;
			}
			if(isset($_POST['subbarrioID'])){
				$subbarrioID = $_POST['subbarrioID'];
			}else{
				$subbarrioID = null;
			}
			if(isset($_POST['phone'])){
				$phone = $_POST['phone'];
			}else{
				$phone = null;
			}
			if(isset($_POST['fax'])){
				$fax = $_POST['fax'];
			}else{
				$fax = null;
			}
			if(isset($_POST['email'])){
				$email = $_POST['email'];
			}else{
				$email = null;
			}
			if(isset($_POST['facebook'])){
				$facebook = $_POST['facebook'];
			}else{
				$facebook = null;
			}
			if(isset($_POST['twitter'])){
				$twitter = $_POST['twitter'];
			}else{
				$twitter = null;
			}
			if(isset($_POST['youtube'])){
				$youtube = $_POST['youtube'];
			}else{
				$youtube = null;
			}
			if(isset($_POST['linkedin'])){
				$linkedin = $_POST['linkedin'];
			}else{
				$linkedin = null;
			}
			if(isset($_POST['shortdesc'])){
				$shortdesc = $_POST['shortdesc'];
			}else{
				$shortdesc = null;
			}
			if(isset($_POST['desc'])){
				$desc = $_POST['desc'];
			}else{
				$desc = null;
			}
			if(isset($_POST['body'])){
				$body = $_POST['body'];
			}else{
				$body = null;
			}
			if(isset($_POST['user_id'])){
				$user_id = $_POST['user_id'];
			}else{
				$user_id = null;
			}
			if(isset($_POST['lat'])){
				$lat = $_POST['lat'];
			}else{
				$lat = null;
			}
			if(isset($_POST['lng'])){
				$lng = $_POST['lng'];
			}else{
				$lng = null;
			}
			if(isset($_POST['status'])){
				$status = $_POST['status'];
			}else{
				$status = null;
			}

			$slug = str_replace(' ','-',$title);
			$replaceValues = array('.',',');
			$slug = strtolower(str_replace($replaceValues,'',$slug));

			$data = array(
	           'title' => $title,
	           'slug' => $slug,
	           'indsubcat_id' => $indsubcatID,
	           'adress' => $adress,
	           'number' => $number,
	           'pais_id' => $paisID,
	           'provincia_id' => $provinciaID,
	           'partido_id' => $partidoID,
	           'localidad_id' => $localidadID,
	           'barrio_id' => $barrioID,
	           'subbarrio_id' => $subbarrioID,
	           'phone' => $phone,
	           'fax' => $fax,
	           'email' => $email,
	           'facebook' => $facebook,
	           'twitter' => $twitter,
	           'youtube' => $youtube,
	           'linkedin' => $linkedin,
	           'shortdesc' => $shortdesc,
	           'desc' => $desc,
	           'body' => $body,
	           'lat' => $lat,
	           'lng' => $lng,
	           'status' => $status
	        );
			$this->db->where('ind_id', $indID);
			$this->db->update('ind', $data);


			if ($paisID != null) {
				$pais = getCountryByID($paisID)['nombre'];
			}else{
				$pais = '';
			}
			if ($provinciaID != null) {
				$provincia = getProvinceByID($provinciaID)['nombre'];
			}else{
				$provincia = '';
			}
			if ($partidoID != null) {
				$partido = getPartidoByID($partidoID)['nombre'];
			}else{
				$partido = '';
			}
			if ($localidadID != null) {
				$localidad = getLocalidadByID($localidadID)['nombre'];
			}else{
				$localidad = '';
			}
			if ($barrioID != null) {
				$barrio = getBarrioByID($barrioID)['nombre'];
			}else{
				$barrio = '';
			}
			if ($subbarrioID != null) {
				$subbarrio = getSubBarrioByID($subbarrioID)['nombre'];
			}else{
				$subbarrio = '';
			}

			$completeAddress = $adress . ' '
					   . $number . ', '
					   . $subbarrio . ', '
					   . $barrio . ', '
					   . $localidad . ', '
					   . $partido . ', '
					   . $provincia . ', '
					   . $pais;

			if ($completeAddress != null) {
				$lat = geocode($completeAddress)[0];
				$lng = geocode($completeAddress)[1];
				saveGeocode($lat, $lng, $indID);
			}
			redirect('Industrial/editIndustrial/' . $indID,'refresh');
		}else{
			// Error Forbiden Access
			redirect('Home','refresh');
		}
	}

	public function saveIndustrialLogo()
	{
		$userID = getMyID();
		$myIndustrialID = getIndustrialUserByID($userID);
		$indID = $_POST['indID'];
		if ($indID == $myIndustrialID) {
			
			$imgName = do_upload('logo', getMyID() . '_' ,  'files/industrial/');			
			$uploadPath = base_url() . 'assets/uploads/files/industrial/';
			$imgName = str_replace(' ','_',$imgName);

			$data = array(
	           'logo' => $imgName
	        );
			$this->db->where('ind_id', $indID);
			$this->db->update('ind', $data);

			redirect('Industrial/editIndustrial/' . $indID,'refresh');
		}else{
			// Error Forbiden Access
			redirect('Home','refresh');
		}
	}

	public function saveIndustrialCerts()
	{
		$userID = getMyID();
		$myIndustrialID = getIndustrialUserByID($userID);
		$indID = $_POST['indID'];

		if ($indID == $myIndustrialID) {
			deleteAllCertsByIndID($indID);
			$counter = 1;
			$certsList = $_POST['certs'];
			foreach ($certsList as $key => $value) {
				if (checkIfHasCert($indID, $value) == false) {
					$data = array(
					   'ind_id' => $indID,
					   'ind_cert_type_id' => $value,
					   'order' => $counter
					);
					$this->db->insert('ind_cert', $data); 
					$counter = $counter + 1;
				}
			}

			redirect('Industrial/editIndustrial/' . $indID,'refresh');
		}else{
			// Error Forbiden Access
			redirect('Home','refresh');
		}
	}

	public function removeIndustrialLogo() {
		remove_file('logo');		
	}
	// Save values for Industrial Settings End
}