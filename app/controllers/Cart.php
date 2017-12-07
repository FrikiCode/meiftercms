<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	

		$this->load->model('Cart_model');
		$this->load->model('Sale_Registry_model');
		$this->load->model('List_Buy_model');
		$this->load->model('List_Buy_Prods_model');
		$this->load->model('User_model');

		$this->load->model('Payu_model');	
		$this->load->model('Location_Model');	
	}

	public function getCart()
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
		//if ($this->ion_auth->logged_in()) {

			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Mi Carrito';
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

			// Get cart by user
			$data['cartList'] = $this->Cart_model->getCartData();
			// Load View
			$this->load->view('cart/cart', $data);
		//}else{
			// Error Forbiden Access
		    //redirect('User/mustLog','refresh');
		//}
	}

	public function getBuys($message = null)
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
			
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Mis Compras';
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

			// Get buy lists by user
			$data['buyLists'] = $this->List_Buy_model->getListsBuy()->result();
			$data['message'] = $message;
			// Load View
			$this->load->view('cart/buylists', $data);
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function addListToCart()
	{		
		// Render Title and Tags
		if ($this->ion_auth->logged_in()) {		

			// Get user lists
			$list = $this->List_Buy_model->getListById($_POST['list_id'])->result();
			if($list && !empty($list)) :
				$usr_id =   getMyID();
				foreach($list as $item) :
					
					$data = array(
					   'usr_id' => $usr_id,
					   'prod_id' =>  $item->id_prod
					);

					if($this->Cart_model->saveProductCart($data)) {
						echo "ADD";
					}  else  echo "NO ADD";	
	
				endforeach;
			endif;			
			exit;
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function getMyLists()
	{	
		if ($this->ion_auth->logged_in()) {	
			
			// Get user lists
			$lists = $this->List_Buy_model->getUserLists()->result();			
			if($lists && !empty($lists)) {
				echo json_encode($lists);
			}

		} else{		
			redirect('User/mustLog','refresh');
		}
	}

	public function addProdList() 
	{
		if ($this->ion_auth->logged_in()) {	
			
			if(isset($_POST)) {
				
				$prodListData = array(
					'id_list' => $_POST['list_id'], 
					'id_prod' => $_POST['prod_id'], 
					'quantity' => 1,  
					'value' => null, 
					'id_sale_registry' => null
				);
				if($this->List_Buy_Prods_model->addProdToList($prodListData)) {
					echo "Producto añadido a la lista";
					exit;
				}
			} 
			echo  "Se produjo un error";


		} else {		
			redirect('User/mustLog','refresh');
		}
	}


	public function getListData()
	{		
		// Render Title and Tags
		if ($this->ion_auth->logged_in()) {		

			// Get user lists
			$list = $this->List_Buy_model->getListById($_POST['list_id'])->result();			
			if($list && !empty($list)) :
				echo json_encode($list);
			endif;			
			exit;
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function newList()
	{		
		// Render Title and Tags
		if ($this->ion_auth->logged_in()) {	

			if(isset($_POST['listName'])) {
			
				$data = array(
				   'usr_id' => getMyID() ,
				   'date' =>   date('Y-m-d'),
				   'descripcion' =>   $_POST['listName'],
				   'listType' =>   LIST_TYPE_USER_LIST
				);

				if($this->List_Buy_model->saveListBuy($data)) {
 					$this->getLists('Lista creada con exito');
				}  else  echo "Se produjo un error inesperado";	

			}
			 
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}


	public function getLists($message = null)
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
			
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Mis Listas de Compras';
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

			// Get user lists
			$data['userLists'] = $this->List_Buy_model->getUserListProds()->result();
			$data['message'] = $message;
			// Load View
			$this->load->view('cart/buyremem', $data);
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}


	public function listFeedback() {
		
		if(isset($_POST)) {
			 
			$data = array(
			   'list_id' => $_POST['listIdHidden'] ,
			   'feedback' =>  $_POST['feedback']
			);

			if($this->List_Buy_model->setFeedback($data)) {
				$this->getBuys("Mensaje enviado con exito");
			}  else  $this->getBuys("Se produjo un error");	

		}		
	}

	// Crea un registro de "cart", con Id del producto seleccionado y Id de usuario logueado
	public function addToCart()
	{
		$usr_id = null;
		if (!$this->ion_auth->logged_in())
   		{   			 
   			$usr_id = $_SERVER['REMOTE_ADDR'];    			
   		} else {
   			$usr_id = getMyID();
   		}

		if(isset($_POST['prod_id'])) {
			
			$data = array(
			   'usr_id' => $usr_id,
			   'prod_id' =>  $_POST['prod_id']
			);

			if($this->Cart_model->saveProductCart($data)) {
				echo "ADD";
			}  else  echo "NO ADD";	

		} else  echo "KO";	
		exit;	
	}

	// Suma uno al producto seleccionado 
	public function addOneProd()
	{

		$usr_id = null;
		if (!$this->ion_auth->logged_in())
   		{   			 
   			$usr_id = $_SERVER['REMOTE_ADDR'];    			
   		} else {
   			$usr_id = getMyID();
   		}

		if(isset($_POST['prod_id'])) {

			$data = array (
				'usr_id' => $usr_id,
				'prod_id' => $_POST['prod_id']
			);

			
			if($this->Cart_model->addOneProductCart($data)){
				echo "SUMA";
			}  else  echo "KO";	
		} else  echo "KO";	
		exit;
	}

	// resta uno al producto seleccionado 
	public function minusOneProd()
	{

		$usr_id = null;
		if (!$this->ion_auth->logged_in())
   		{   			 
   			$usr_id = $_SERVER['REMOTE_ADDR'];    			
   		} else {
   			$usr_id = getMyID();
   		}

		if(isset($_POST['prod_id']) && isset($_POST['quantity'])) {
			
			$data = array (
				'usr_id' => $usr_id,
				'prod_id' => $_POST['prod_id']
			);

			//si cantidad es 1, elimina el producto del carrito
			if($_POST['quantity'] == '1') {	
				if($this->Cart_model->deleteProductCart($data)) {
					echo "BORRA";
				}  else  echo "KO";
			} else {	
				if($this->Cart_model->minusOneProductCart($data)) {
					echo "RESTA";
				}  else  echo "KO"; 				
			}

		} else  echo "KO";
		exit;
	}

	public function deleteCartProd()
	{
		$usr_id = null;
		if (!$this->ion_auth->logged_in())
   		{   			 
   			$usr_id = $_SERVER['REMOTE_ADDR'];    			
   		} else {
   			$usr_id = getMyID();
   		}

		if(isset($_POST['prod_id'])) {

			$data = array (
				'usr_id' => $usr_id,
				'prod_id' => $_POST['prod_id']
			);
			
			if($this->Cart_model->deleteProductCart( $data)) {
				echo "BORRA";
			}  else  echo "KO";		
		}
	}

	public function deleteList()
	{
		if (!$this->ion_auth->logged_in())
   		{
   			redirect('auth/login', 'refresh');
   		}

		if(isset($_POST['list_id'])) {

			$data = array (
				'usr_id' => getMyID(),
				'id' => $_POST['list_id']
			);
			
			if($this->List_Buy_model->deleteList($data)) {
				echo "BORRA";
			}  else  echo "KO";		
		}
	}

	//Confirma carrito, elegir metodo de pago
	public function cartProceed() {

		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End

		// Render Title and Tags
		//if ($this->ion_auth->logged_in()) {
			
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Confirme su Compra';
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
			
			$data['cartData'] = $this->Cart_model->getCartData()->result();
			$data['usrInfo'] = getUserNfo(getMyID());
			// Load View
			$this->load->view('cart/cartConfirm', $data);
		//}else{
			// Error Forbiden Access
			//redirect('User/mustLog','refresh');
		//}

	} 

	public function confirmData() {

		if(isset($_POST)) {

			$usr_id = null;
			if (!$this->ion_auth->logged_in()) {

				//Registro al usuario si no esta logueado
				$regname = $_POST['nombre'];
				$reglastname = $_POST['apellido'];
				$regcompany = $_POST['compania'];
				$regphone = $_POST['telefono'];
				$regmail = $_POST['email'];
				$regpass = $_POST['pass'];
				$regdireccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : null;
				$regciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : null;
				$regcodpostal = (isset($_POST['codPostal'])) ? $_POST['codPostal'] : null;


				$additional_data = array(
					'first_name' => $regname,
					'last_name' => $reglastname,
					'company' => $regcompany,
					'address' => $regdireccion,
					'city' => $regciudad,
					'username' => $regcodpostal
				);
				$group = 0;

				//Crea al usuario y luego lo registra
				$this->ion_auth->register($regmail, $regpass, $regmail, $additional_data, $group);				
				//update el id guardado en el cart, para que sea el nuevo id de user   			 
	   			$usr_ip_address = $_SERVER['REMOTE_ADDR'];
				$usr = $this->User_model->getByEmail($regmail)->result();	
				
				if(!$this->Cart_model->updateIpToIdCart($usr_ip_address, $usr[0]->id)) {
	   				echo "se produjo un error inesperado";
	   				exit;
	   			}

			} else {
				$usr_id = getMyID();	
			}			

			$tipoEntrega = $_POST['tipoEntrega'];			
			$userInfo = getUserNfo($usr_id);			
			$saleData = array();
			$saleData['user_id'] = $usr_id;
			$saleData['telephone'] =  (isset($_POST['telefono'])) ? $_POST['telefono'] : $userInfo['phone'];
			$saleData['address'] =  (isset($_POST['direccion'])) ? $_POST['direccion'] : $userInfo['adress'];
			$saleData['city'] =  (isset($_POST['ciudad'])) ? $_POST['ciudad'] : $userInfo['city'];
			$saleData['zipcode'] =  (isset($_POST['codPostal'])) ? $_POST['codPostal'] : $userInfo['zip'];
			$saleData['message'] = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : $userInfo['zip'];
			$saleData['transaction_id'] = uniqid();
			$saleData['transaction_date'] = date('Y-m-d');
			$saleData['total_amount'] = (isset($_POST['totalCompra'])) ? $_POST['totalCompra'] : null;
			$saleData['type_transaction'] = $tipoEntrega;
			$saleData['ship_cost'] = 100;
			$saleData['status_delivery'] = STATUS_SALE_DELIVERY_PENDING;
			//salvo registro de venta 
			$registryId = $this->Sale_Registry_model->saveSaleRegistry($saleData);			
			//traigo los productos comprados
			$cartProds = $this->Cart_model->getCartData($usr_id)->result();

			//Si hay data en el carrito, salvo una nueva lista con fecha actual
			if( is_array( $cartProds) && !empty($cartProds)) { 
				//Creo nueva lista de tipo "lista carrito"... ponele				
				$listData = array('date' => date('Y-m-d'), 'usr_id' => $usr_id, 'listType' => LIST_TYPE_BUY, 'total_amount' => (isset($_POST['totalCompra'])) ? $_POST['totalCompra'] : null);				
				$listId = $this->List_Buy_model->saveListBuy($listData);
				if($listId) {
					//Recorro los productos añadidos al cart, y los salvo para la lista 
					foreach($cartProds as $cartItem) {
						$prodListData = array(
							'id_list' => $listId, 
							'id_prod' => $cartItem->prod_id, 
							'quantity' => $cartItem->prod_quantity,  
							'value' => $cartItem->prod_quantity, 
							'id_sale_registry' => $registryId
						);
						$this->List_Buy_Prods_model->saveListProd($prodListData);

					}
				}
			}

						
			if($tipoEntrega == SALE_TYPE_CONTRAENTREGA) {
				// Navbar Configuration
				$data['navbarConf'] = 'commercial';
				// Navbar Configuration End
				// Load Renders for Navbar
				$data['menuCat'] = $this->Commercial_model->getCategoryALL();
				$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
				$data['menuInt'] = $this->Internal_model->getInternalALL();
				// Load Renders for Navbar End

				// Render Title and Tags
				//if ($this->ion_auth->logged_in()) {
					
					// Get Basic Info For Page Meta
					$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Felicidades';
					$data['charset'] = getSiteConfiguration()['site_charset'];
					$data['description'] = getSiteConfiguration()['site_desc'];
					$data['keywords'] = getSiteConfiguration()['site_keywords'];
					$data['language'] = getSiteConfiguration()['site_lang'];
					$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
					$data['favicon'] = getSiteConfiguration()['site_favicon'];
					$data['author'] = getSiteConfiguration()['site_author'];
					$data['usrInfo'] = getUserNfo($usr_id);

					// Location Script
					$data['pais'] = $this->Location_Model->getPais();
					// Location Script End

					//Vacio el cart 
 					$this->Cart_model->deleteCartData($usr_id);

					// Load View
					$this->load->view('cart/cartFinish', $data);
					

				//}else{
					// Error Forbiden Access
					//redirect('User/mustLog','refresh');
				//}
			} else {
				//PAYU
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
					
					// Get Basic Info For Page Meta
					$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Felicidades';
					$data['charset'] = getSiteConfiguration()['site_charset'];
					$data['description'] = getSiteConfiguration()['site_desc'];
					$data['keywords'] = getSiteConfiguration()['site_keywords'];
					$data['language'] = getSiteConfiguration()['site_lang'];
					$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
					$data['favicon'] = getSiteConfiguration()['site_favicon'];
					$data['author'] = getSiteConfiguration()['site_author'];
					$data['usrInfo'] = getUserNfo($usr_id);
					$data['total_amount'] = $saleData['total_amount'];

					// Location Script
					$data['pais'] = $this->Location_Model->getPais();
					// Location Script End

					// Load View
					$this->load->view('cart/payuConfirm', $data);

				}else{
					// Error Forbiden Access
					redirect('User/mustLog','refresh');
				}
			}


		}
			
	}

	public function payuresponse() {
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
			// Get Basic Info For Page Meta
			$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Confirme su Compra';
			$data['charset'] = getSiteConfiguration()['site_charset'];
			$data['description'] = getSiteConfiguration()['site_desc'];
			$data['keywords'] = getSiteConfiguration()['site_keywords'];
			$data['language'] = getSiteConfiguration()['site_lang'];
			$data['appleicon'] = getSiteConfiguration()['site_appleicon'];
			$data['favicon'] = getSiteConfiguration()['site_favicon'];
			$data['author'] = getSiteConfiguration()['site_author'];
			
			$data['cartData'] = $this->Cart_model->getCartData();
			$data['usrInfo'] = getUserNfo(getMyID());

			// Location Script
			$data['pais'] = $this->Location_Model->getPais();
			// Location Script End

			// Load View
			$this->load->view('cart/payuResponse', $data);
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function payuinvoice() {
		// Navbar Configuration
		$data['navbarConf'] = 'commercial';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		$data['payuReg'] =$this->Payu_model->getPayUByUserID(getMyID());

		// Load Renders for Navbar End
		// Render Title and Tags
		if ($this->ion_auth->logged_in()) {
			if (havePayu(getMyID()) == TRUE) {
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . 'Pagos PayU';
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
				$this->load->view('cart/payuInvoice', $data);
			}else{
				// Error 404 Page
				redirect('Error/NotFound', 'refresh');
			}
		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	} 

	public function payuConfirmation()
	{
		$refCode = $_POST['reference_sale'];
		$data['payuReg'] =$this->Payu_model->getPayUByRefCode($refCode);

		if ($_POST['state_pol'] == 4 ) {
			$estadoTx = "Transacción aprobada";
		}
		else if ($_POST['transactionState'] == 6 ) {
			$estadoTx = "Transacción rechazada";
		}
		else if ($_POST['transactionState'] == 104 ) {
			$estadoTx = "Error";
		}
		else if ($_POST['transactionState'] == 7 ) {
			$estadoTx = "Transacción pendiente";
		}

		foreach($data['payuReg'] as $reg) {
			if ($refCode == $reg->referenceCode) {

				$arrayName = array(
					'reference_pol' => $_POST['response_code_pol'],
					'referenceCode' => $_POST['reference_sale'], 
					'TX_VALUE' => $_POST['value'],
					'currency' => $_POST['currency'],
					'estadotx' => $estadoTx,
					'transactionid' => $_POST['sign'],
				);

				$this->db->where('referenceCode', $reg->referenceCode);
				$this->db->update('payureg', $data); 
			}
		}
	}	

	public function checkPromoCodeNfo()
	{
		if (!$this->ion_auth->logged_in())
			{
				redirect('auth/login', 'refresh');
			}
		if(isset($_POST['disc_code'])) {
			$discoCode = $_POST['disc_code'];
			$list = getPromoCodeNfoByCode($discoCode);
			if ($list != null) {
				echo json_encode($list);
			}else{
				echo null;
			}
		} else  echo "KO";	
		exit;
	}

}