<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Location_Model');
	}
	
	public function index()
	{

		if ($this->ion_auth->logged_in()) {

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End
			$this->load->view('user/profile', $data);

		}else{

			redirect('/auth/login');

		}
		
	}

	public function updateProfile()
	{

		if ($this->ion_auth->logged_in()) {

			$imgName = do_upload('userPic', getMyID() . '_' ,  'user_profile');			
			$uploadPath = base_url() . 'assets/uploads/user_profile/';
			
			$userID = getMyID();
			$userCompany = $_POST['company'];
			$userUserName = $_POST['username'];
			$userMail = $_POST['email'];
			$userFName = $_POST['first_name'];
			$userLName = $_POST['last_name'];
			$userAdress = $_POST['adress'];
			$userZip = $_POST['zip'];
			$userAbout = $_POST['about'];			 

			$paisID = $_POST['paisID'];
			$provinciaID = $_POST['provinciaID'];
			$partidoID = $_POST['partidoID'];
			$localidadID = $_POST['localidadID'];
			$barrioID = $_POST['barrioID'];
			$subbarrioID = $_POST['subbarrioID'];

			$data = array(
				'company' => $userCompany,
				'username' => $userUserName,
				'email' => $userMail,
				'first_name' => $userFName, 
				'last_name' => $userLName,
				'adress' => $userAdress,
				'zip' => $userZip,
				'about' => $userAbout,
				'image_path' => $uploadPath . '' . $imgName,
				'pais' => $paisID,
				'provincia' => $provinciaID,
				'partido' => $partidoID,
				'localidad' => $localidadID,
				'barrio' => $barrioID,
				'subbarrio' => $subbarrioID
			);

			$this->db->where('id', $userID);
			$this->db->update('users', $data);

			redirect('user');

		}else{

			redirect('/auth/login');

		}
		
	}

	public function removeUserImg() {

		remove_file(getUserNfo(getMyID())['userPic']);		

	}

}

