<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('image_CRUD');
	}

	public function renderCrud($output = null)
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('example.php',$output);

		}else{

			redirect('/auth/login');

		}
		
	}

	public function index()
	{
		$this->renderCrud((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function internal_pages()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('internal_page');
			$crud->set_subject('Paginas Internas');

			$crud->field_type(
				'menu_disp',
				'dropdown',
				array(
					'1' => 'Activo',
					'2' => 'Inactivo'
				)
			);

			$crud->required_fields(
				   'title',
				   'subtitle',
				   'text',
				   'menu_disp',
				   'date'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('subtitle','Subtitulo')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('text','Texto')
				 ->display_as('menu_disp','Vista en Menu')
				 ->display_as('date','Fecha');

			$crud->callback_after_insert(array($this, 'gen_internal_slug'));
	        $crud->callback_after_update(array($this, 'gen_internal_slug'));

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function gen_internal_slug($post_array,$primary_key){

        $this->load->helper('url');

        $name = normaliza($post_array['title']);
        $url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('page_id', $primary_key);
        $this->db->update('internal_page',$data);
     
        return true;
    }

	public function gallerie_media()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('media_gallerie');
			$crud->set_subject('Galeria Imagenes');
			$crud->set_relation_n_n('imagenes', 'gallerie_media', 'media_images', 'gallerie_id', 'media_id', 'title','order');

			$crud->required_fields(
				   'title',
				   'desc',
				   'date',
				   'copyright'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('desc','Descripcion')
				 ->display_as('date','Fecha')
				 ->display_as('copyright','Copyright')
				 ->display_as('imagenes','Lista de Imagenes');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function gallerie_video()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('video_gallerie');
			$crud->set_subject('Galeria Video');
			$crud->set_relation_n_n('videos', 'gallerie_video', 'media_videos', 'video_gallerie_id', 'video_id', 'title','order');

			$crud->required_fields(
				   'title',
				   'desc',
				   'date',
				   'copyright'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('desc','Descripcion')
				 ->display_as('date','Fecha')
				 ->display_as('copyright','Copyright')
				 ->display_as('videos','Lista de Videos');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function mediacrud()
	{
		$image_crud = new image_CRUD();
		
		$image_crud->set_primary_key_field('media_id');
		$image_crud->set_url_field('url');
		$image_crud->set_table('media_images');
		$image_crud->set_image_path('assets/uploads');
		$image_crud->set_title_field('title');
			
		$output = $image_crud->render();
		
		$this->renderCrud($output);
	}

	public function videocrud()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('media_videos');
			$crud->set_subject('Videos');
			$crud->unset_columns('url');

			$crud->field_type('url', 'text');
			$crud->unset_texteditor('url','full_text');

			$crud->required_fields(
				   'title',
				   'url'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('slug','Codigo Embed');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function prod()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('product');
			$crud->set_subject('Producto');
			// $crud->set_relation('tax_id','tax_prod','title');
			// $crud->set_relation('brand_id','prod_brand','title');
			$crud->set_relation('cat_id','prod_categorie','title');

			$crud->set_relation_n_n('Segmentos', 'prod_seg', 'prod_segment', 'prod_id', 'prod_segment_id', 'title', 'order');
			
			$crud->set_field_upload('pic','../assets/uploads/files/products');
			$crud->set_field_upload('pic2','../assets/uploads/files/products');
			$crud->set_field_upload('pic3','../assets/uploads/files/products');
			
			$crud->required_fields(
				   'name',
				   'desc',
				   'short_desc',
				   'pic',
				   'price',
				   'cat_id',
				   'highlight'
			);

			$crud->field_type(
				'highlight',
				'dropdown',
				array(
					'1' => 'Activo',
					'2' => 'Inactivo'
				)
			);

			$crud->display_as('name','Nombre')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('desc','Descripcion')
				 ->display_as('short_desc','Descripcion Corta')
				 ->display_as('ingredients','Ingredientes')
				 ->display_as('pic','Foto 1')
				 ->display_as('pic2','Foto 2')
				 ->display_as('pic3','Foto 3')
				 ->display_as('price','Precio')
				 ->display_as('tax_id','Impuesto')
				 ->display_as('brand_id','Marca')
				 ->display_as('cat_id','Categoria')
				 ->display_as('highlight','Destacado')
				 ->display_as('stock','Stock')
				 ->display_as('date_ing','Fecha de Ingreso')
				 ->display_as('qtybase','Cant. de Piezas')
				 ->display_as('date_venc','Fecha de Vencimiento');

			$disableFields = array('slug', 'Segmentos', 'ingredients', 'pic2', 'pic3', 'tax_id', 'brand_id', 'stock', 'date_ing', 'date_venc');
			$crud->unset_add_fields($disableFields);
			$crud->unset_edit_fields($disableFields);

			$crud->callback_after_insert(array($this, 'gen_prod_slug'));
	        $crud->callback_after_update(array($this, 'gen_prod_slug'));

	        $crud->unset_columns($disableFields);

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function gen_prod_slug($post_array,$primary_key){

        $this->load->helper('url');

        $name = normaliza($post_array['name']);
        $url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('prod_id', $primary_key);
        $this->db->update('product',$data);
     
        return true;
    }

	public function prod_cat()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('prod_categorie');
			$crud->set_subject('Categoria de Producto');

			$crud->required_fields(
				   'title',
				   'desc'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('desc','Descripcion');

			$crud->callback_after_insert(array($this, 'gen_cat_slug'));
	        $crud->callback_after_update(array($this, 'gen_cat_slug'));

	        $crud->unset_columns('slug');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function gen_cat_slug($post_array,$primary_key){

        $this->load->helper('url');

		$name = normaliza($post_array['title']);
		$url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('prod_cat_id', $primary_key);
        $this->db->update('prod_categorie',$data);
     
        return true;
    }

	public function tax_prod()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('tax_prod');
			$crud->set_subject('Impuesto');

			$crud->required_fields(
				   'title',
				   'value'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('value','Valor (En %)');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function testimonial()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('testimonial');
			$crud->set_subject('Testimoniales');

			$crud->required_fields(
				   'comment',
				   'pic',
				   'age',
				   'approved'
			);

			$crud->display_as('comment','Comentario')
				 ->display_as('pic','Fotografia')
				 ->display_as('age','Edad')
				 ->display_as('approved','Aprobacion');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function about()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('about');
			$crud->set_subject('Quienes Somos');

			$crud->set_field_upload('pic','../assets/uploads/files/internal');

			$crud->required_fields(
				   'title',
				   'text',
				   'pic'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('pic','Fotografia')
				 ->display_as('text','Texto');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	

	// Crud Dashboard Views
	// General Functions
	public function Internal()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/internal');

		}else{

			redirect('/auth/login');

		}
		
	}

	// Testimonials Functions
	public function TestimonialView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/testimonialView');

		}else{

			redirect('/auth/login');

		}
		
	}

	// About Functions
	public function AboutView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/AboutView');

		}else{

			redirect('/auth/login');

		}
		
	}

	// Media Galleries Functions
	public function Media()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/media');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function Video()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/video');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function Gallerie()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/gallerie');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function GallerieVideo()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/gallerievid');

		}else{

			redirect('/auth/login');

		}
		
	}

	// Product Functions
	public function Product()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/prod');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function ProdCat()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/prodcat');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function Tax()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/tax');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function SegmentView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/SegmentView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function segment()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('prod_segment');			
			$crud->set_subject('Segmento');
			$crud->set_field_upload('symbol','../assets/uploads/files/icons');
			$crud->required_fields(
				   'title',
				   'desc',
				   'symbol',
				   'desc'
			);
			$crud->display_as('title','Nombre')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('symbol','Simbolo')
				 ->display_as('desc','Descripcion');
			
			$crud->callback_after_insert(array($this, 'gen_segment_slug'));
			$crud->callback_after_update(array($this, 'gen_segment_slug'));

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}
	public function gen_segment_slug($post_array,$primary_key){

        $this->load->helper('url');

		$name = normaliza($post_array['title']);
		$url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('prod_segment_id', $primary_key);
        $this->db->update('prod_segment',$data);
     
        return true;
    }

	public function BrandView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/BrandView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function brand()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('prod_brand');			
			$crud->set_subject('Marca');
			$crud->required_fields(
				   'title'
			);
			$crud->display_as('title','Nombre')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('desc','Descripcion');
			
			$crud->callback_after_insert(array($this, 'gen_brand_slug'));
			$crud->callback_after_update(array($this, 'gen_brand_slug'));

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}
	public function gen_brand_slug($post_array,$primary_key){

        $this->load->helper('url');

		$name = normaliza($post_array['title']);
		$url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('prod_brand_id', $primary_key);
        $this->db->update('prod_brand',$data);
     
        return true;
    }


	//FAQ
	public function FrequentQuestions()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/faq');

		}else{

			redirect('/auth/login');

		}
		
	}

	public function faq()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('faq');			
			$crud->set_subject('FAQ');
			
			$crud->required_fields(
				   'question',
				   'answer',
				   'order'
			);

			$crud->display_as('question','Pregunta')
				 ->display_as('answer','Respuesta')
				 ->display_as('order','Orden');

			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Blog Functions
	public function PostView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/post');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function post()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('post');			
			$crud->set_subject('Noticias');
			$crud->set_relation('categorie_id','post_categorie','title');
			$crud->set_relation('id','users','username');
			$crud->set_relation_n_n('products', 'prod_post', 'product', 'post_id', 'prod_id', 'name','order');

			$crud->set_field_upload('imagen_assoc_id','../assets/uploads/files/post');

			$crud->required_fields(
				   'title',
				   'desc',
				   'keywords',
				   'tags',
				   'id',
				   'description',
				   'body',
				   'imagen_assoc_id',
				   'categorie_id'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('keywords','Keywords')
				 ->display_as('tags','Etiquetas')
				 ->display_as('id','Autor')
				 ->display_as('description','Descripcion')
				 ->display_as('body','Cuerpo')
				 ->display_as('imagen_assoc_id','Caratula')
				 ->display_as('categorie_id','Categoria')
				 ->display_as('products','Productos Relacionados');

			$crud->callback_after_insert(array($this, 'gen_post_slug'));
	        $crud->callback_after_update(array($this, 'gen_post_slug'));

	        $crud->unset_columns('slug');

			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	public function gen_post_slug($post_array,$primary_key){

        $this->load->helper('url');

		$name = normaliza($post_array['title']);
		$url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('post_id', $primary_key);
        $this->db->update('post',$data);
     
        return true;
    }

	public function PostCatView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/postcat');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function postcat()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('post_categorie');			
			$crud->set_subject('Categoria de Post');

			$crud->set_field_upload('image','../assets/uploads/files/post');
			
			$crud->required_fields(
				   'title',
				   'desc',
				   'image'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('desc','Descripcion')
				 ->display_as('image','Caratula');

			$crud->callback_after_insert(array($this, 'gen_postcat_slug'));
	        $crud->callback_after_update(array($this, 'gen_postcat_slug'));

	        $crud->unset_columns('slug');

			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}
	public function gen_postcat_slug($post_array,$primary_key){

        $this->load->helper('url');

        $name = normaliza($post_array['title']);
        $url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('categorie_id', $primary_key);
        $this->db->update('post_categorie',$data);
     
        return true;
    }

    // PayU Section
    public function PayUView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/payuview');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function payusys()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('payusystem');			
			$crud->set_subject('Configuracion de Payu');
			
			$crud->required_fields(
				   'merchantID',
				   'APILogin',
				   'APIkey',
				   'accountID',
				   'test',
				   'desc'
			);
			
			$crud->unset_add();
			$crud->unset_delete();

			$crud->field_type(
				'test',
				'dropdown',
				array(
					'1' => 'Activo',
					'2' => 'Inactivo'
				)
			);

			$crud->display_as('merchantID','ID de Comercio')
				 ->display_as('APILogin','API Login')
				 ->display_as('APIkey','API Key')
				 ->display_as('accountID','ID de Cuenta')
				 ->display_as('test','Modo Pruebas')
				 ->display_as('desc','Descripcion de Movimiento');

			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// User
	public function UserListView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/userlist');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function userlist()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('users');			
			$crud->set_subject('Usuario');
			
			$crud->unset_add();

			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Contact
	public function MailConfView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/MailConfView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function mailconf()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('smtp_mail_conf');			
			$crud->set_subject('Configuracion de E-Mail');
			
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Economical
	public function currencyview()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/currencyview');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function Currency()
	{
		try{

			$crud = new grocery_CRUD();			

			$crud->set_table('currency_list');			
			$crud->set_subject('Monedas');
			$crud->required_fields(
				   'name',
				   'iso',
				   'symbol'
			);
			$crud->display_as('name','Nombre')
				 ->display_as('iso','ISO')
				 ->display_as('symbol','Simbolo');
			$output = $crud->render();
			
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}
	public function methodpayview()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/methodpayview');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function Methodpay()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('pay_mods');			
			$crud->set_subject('Metodo de Pago');
			$crud->set_field_upload('icon','../assets/uploads/files/icons');
			$crud->required_fields(
				   'name',
				   'icon'
			);
			$crud->display_as('name','Nombre')
				 ->display_as('icon','Icono');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Store Functions
	public function StoreConfView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/StoreConfView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function storeconf()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('store_conf');			
			$crud->set_subject('Configuracion de Tienda');

			$crud->unset_add();
			$crud->unset_delete();

			$crud->display_as('currency_id','Moneda')
				 ->display_as('tax_id','Impuesto')
				 ->display_as('disable_payu','Habilitar/Desabilitar PayU')
				 ->display_as('show_stock','Mostrar Stock')
				 ->display_as('show_shipping','Mostrar Envio');

			$crud->set_relation('currency_id','currency_list','name');
			$crud->set_relation('tax_id','tax_prod','title');

			$crud->field_type(
				'disable_payu',
				'dropdown',
				array(
					'1' => 'Habilitar',
					'2' => 'Desabilitar'
				)
			);
			$crud->field_type(
				'show_stock',
				'dropdown',
				array(
					'1' => 'Habilitar',
					'2' => 'Desabilitar'
				)
			);
			$crud->field_type(
				'show_shipping',
				'dropdown',
				array(
					'1' => 'Habilitar',
					'2' => 'Desabilitar'
				)
			);

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Site Functions
	public function SiteConfView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/SiteConfView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function siteconf()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('site_conf');			
			$crud->set_subject('Configuracion de Sitio');

			$crud->unset_add();
			$crud->unset_delete();

			$crud->set_field_upload('site_favicon','../assets/img');
			$crud->set_field_upload('site_logo','../assets/img');
			$crud->set_field_upload('site_logofoot','../assets/img');
			$crud->set_field_upload('site_appleicon','../assets/img');

			$crud->display_as('site_name','Nombre de Sitio')
				 ->display_as('site_author','Autor de Sitio')
				 ->display_as('site_desc','Descripcion de Sitio')
				 ->display_as('site_favicon','Favicon')
				 ->display_as('site_logo','Logo')
				 ->display_as('site_logofoot','Logo de Footer')
				 ->display_as('site_charset','Charset')
				 ->display_as('site_lang','Lenguaje de Sitio')
				 ->display_as('cooming_soon','Modo Mantenimiento')
				 ->display_as('site_appleicon','Imagen Social');

			$crud->field_type(
				'cooming_soon',
				'dropdown',
				array(
					'1' => 'Habilitar',
					'0' => 'Desabilitar'
				)
			);

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Promo Code Functions
	public function PromoCodeView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/PromoCodeView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function promocode()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('promo_code');			
			$crud->set_subject('Codigos Promocionales');

			$crud->display_as('disc_name','Nombre del Descuento')
				 ->display_as('disc_code','Codigo del Descuento')
				 ->display_as('disc_percent','Porcentaje de Descuento')
				 ->display_as('disc_from','Fecha de Inicio')
				 ->display_as('disc_to','Fecha de Finalizacion');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}

	// Registro de Compras Functions
	public function SaleRegistryView()
	{
		if ($this->ion_auth->logged_in()) {

			$this->load->view('crud/SaleRegistryView');

		}else{

			redirect('/auth/login');

		}
		
	}
	public function saleregistry()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('sale_registry');			
			$crud->set_subject('Registro de Compras');

			$crud->unset_add();
			$crud->unset_delete();

			$crud->display_as('transaction_id','Codigo de Transaccion')
				 ->display_as('user_id','Codigo de Usuario')
				 ->display_as('type_transaction','Tipo de Transaccion')
				 ->display_as('status_delivery','Estado de Transaccion')
				 ->display_as('transaction_date','Fecha de Transaccion')
				 ->display_as('message','Mensaje de Usuario')
				 ->display_as('city','Ciudad de Usuario')
				 ->display_as('address','Direccio de Usuario')
				 ->display_as('zipcode','Codigo Postal de Usuario')
				 ->display_as('telephone','Telefono de Usuario')
				 ->display_as('total_amount','Monton Total de Transaccion');
			
			$crud->field_type(
				'type_transaction',
				'dropdown',
				array(
					'1' => 'PayU',
					'2' => 'Contra Entrega'
				)
			);

			$crud->field_type(
				'status_delivery',
				'dropdown',
				array(
					'1' => 'No Pagada',
					'2' => 'En Proceso',
					'3' => 'Pago Recibido',
					'4' => 'Enviando',
					'5' => 'Enviado'
				)
			);

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}


	// Location and Shipping
	public function ShippingView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/ShippingView');
		}else{

			redirect('/auth/login');
		}
	}

	public function shippingCost()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('shipping_cost');			
			$crud->set_subject('Costa de Envio');
			$crud->set_relation_n_n('asignados', 'shipp_barrio', 'localidades', 'shipping_id', 'id', 'nombre','order');

			$crud->display_as('shipping_name','Nombre de Shipping')
				 ->display_as('asignados','Barrios Asignados')
				 ->display_as('shipping_duration','Tardanza del Envio (Hs.)')
				 ->display_as('shipping_val','Precio del Envio');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function PaisView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/PaisView');
		}else{

			redirect('/auth/login');
		}
	}
	public function pais()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('pais');			
			$crud->set_subject('Pais');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function ProvinciaView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/ProvinciaView');
		}else{

			redirect('/auth/login');
		}
	}
	public function provincia()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('provincias');			
			$crud->set_subject('Provincia');
			$crud->set_relation('idPais','pais','nombre');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function PartidosView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/PartidosView');
		}else{

			redirect('/auth/login');
		}
	}
	public function partido()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('partidos');			
			$crud->set_subject('Partido');
			$crud->set_relation('idProvincia','provincias','nombre');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function LocalidadView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/LocalidadView');
		}else{

			redirect('/auth/login');
		}
	}
	public function localidad()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('localidades');			
			$crud->set_subject('Localidad');
			$crud->set_relation('idPartido','partidos','nombre');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function BarriosView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/BarriosView');
		}else{

			redirect('/auth/login');
		}
	}
	public function barrio()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('barrios');			
			$crud->set_subject('Barrio');
			$crud->set_relation('idLocalidad','localidades','nombre');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function SubBarriosView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/SubBarriosView');
		}else{

			redirect('/auth/login');
		}
	}
	public function subbarrio()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('subbarrios');			
			$crud->set_subject('Sub Barrio');
			$crud->set_relation('idBarrio','barrios','nombre');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function IndCatView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/IndCatView');
		}else{

			redirect('/auth/login');
		}
	}
	public function indcat()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('ind_cat');			
			$crud->set_subject('Categoria de Industria');

			$crud->callback_after_insert(array($this, 'gen_indcat_slug'));
			$crud->callback_after_update(array($this, 'gen_indcat_slug'));
			
			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function gen_indcat_slug($post_array,$primary_key){

        $this->load->helper('url');

        $name = normaliza($post_array['name']);
        $url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('indcat_id', $primary_key);
        $this->db->update('ind_cat',$data);
     
        return true;
    }

	public function IndSubCatView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/IndSubCatView');
		}else{

			redirect('/auth/login');
		}
	}
	public function indsubcat()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('ind_subcat');			
			$crud->set_subject('Sub Categoria de Industria');
			$crud->set_relation('indcat_id','ind_cat','name');

			$crud->callback_after_insert(array($this, 'gen_indsubcat_slug'));
			$crud->callback_after_update(array($this, 'gen_indsubcat_slug'));
			
			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function gen_indsubcat_slug($post_array,$primary_key){

        $this->load->helper('url');

        $name = normaliza($post_array['name']);
        $url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('indsubcat_id', $primary_key);
        $this->db->update('ind_subcat',$data);
     
        return true;
    }

	public function IndView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/IndView');
		}else{

			redirect('/auth/login');
		}
	}
	public function ind()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('ind');			
			$crud->set_subject('Industria');
			$crud->set_relation('indsubcat_id','ind_subcat','name');

			$crud->set_relation_n_n('certs', 'ind_cert', 'ind_cert_type', 'ind_id', 'ind_cert_type_id', 'name','order');

			$crud->set_relation('pais_id','pais','nombre');
			$crud->set_relation('provincia_id','provincias','nombre');
			$crud->set_relation('partido_id','partidos','nombre');
			$crud->set_relation('localidad_id','localidades','nombre');
			$crud->set_relation('barrio_id','barrios','nombre');
			$crud->set_relation('subbarrio_id','subbarrios','nombre');

			$crud->set_field_upload('logo','../assets/uploads/files/industrial');

			$crud->callback_after_insert(array($this, 'gen_ind_slug'));
		    $crud->callback_after_update(array($this, 'gen_ind_slug'));

		    $crud->display_as('title','Nombre de Industria')
				 ->display_as('slug','Slug (URL)')
				 ->display_as('logo','Logotipo')
				 ->display_as('indsubcat_id','Sub Categoria')
				 ->display_as('adress','Direccion')
				 ->display_as('number','Altura')
				 ->display_as('pais_id','Pais')
				 ->display_as('provincia_id','Provincia')
				 ->display_as('localidad_id','Localidad')
				 ->display_as('partido_id','Partido')
				 ->display_as('barrio_id','Barrio')
				 ->display_as('subbarrio_id','Sub Barrio')
				 ->display_as('phone','Telefono')
				 ->display_as('fax','Fax')
				 ->display_as('email','E-Mail')
				 ->display_as('facebook','Facebook')
				 ->display_as('twitter','Twitter')
				 ->display_as('youtube','Youtube')
				 ->display_as('linkedin','LinkedIN')
				 ->display_as('shortdesc','Descripcion Corta')
				 ->display_as('desc','Descripcion')
				 ->display_as('body','Cuerpo')
				 ->display_as('visit','Visitas Totales')
				 ->display_as('lat','Latitud')
				 ->display_as('lng','Longitud')
				 ->display_as('status','Estado')
				 ->display_as('certs','Certificaciones');
			
			$crud->field_type(
				'status',
				'dropdown',
				array(
					'0' => 'Inactivo',
					'1' => 'Activo'
				)
			);

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function gen_ind_slug($post_array,$primary_key){

        $this->load->helper('url');

        $name = normaliza($post_array['title']);
        $url_title = url_title($name, '-', TRUE);

        $data = array(
        'slug' => $url_title 
        );
        
        $this->db->where('ind_id', $primary_key);
        $this->db->update('ind',$data);
     
        return true;
    }

    public function candidates()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('rrhh_cand');			
			$crud->set_subject('Candidatos');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function CandView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/CandidatesView');
		}else{

			redirect('/auth/login');
		}
	}

	public function candcat()
	{
		try{

			$crud = new grocery_CRUD();			
			$crud->set_table('rrhh_cand');			
			$crud->set_subject('Candidatos');

			$output = $crud->render();
			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function CandCatView()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/CandCatView');
		}else{

			redirect('/auth/login');
		}
	}

	// Combos
	public function combos()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('prod_combo');
			$crud->set_subject('Combos');
			$crud->set_relation_n_n('prods', 'pro_com', 'product', 'prod_combo_id', 'prod_id', 'name','order');

			$crud->required_fields(
				   'title',
				   'desc',
				   'price',
				   'comment'
			);

			$crud->display_as('title','Titulo')
				 ->display_as('desc','Descripcion')
				 ->display_as('price','Precio')
				 ->display_as('comment','Comentario')
				 ->display_as('prods','Lista de Productos');

			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function combosview()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/CombosView');
		}else{

			redirect('/auth/login');
		}
	}


	// Contact Nfo
	public function contactNfo()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('contact_data');
			$crud->set_subject('Informacion de Contacto');

			$crud->display_as('adress','Direccion')
				 ->display_as('lat','Latitud')
				 ->display_as('lng','Longitud')
				 ->display_as('city','Ciudad')
				 ->display_as('phone','Telefono')
				 ->display_as('email','E-Mail')
				 ->display_as('time','Horario')
				 ->display_as('linkedin','LinkedIN')
				 ->display_as('facebook','Facebook')
				 ->display_as('twitter','Twitter');
				 
			$output = $crud->render();

			$this->renderCrud($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function InfoContactConf()
	{
		if ($this->ion_auth->logged_in()) {
			$this->load->view('crud/InfoContactConf');
		}else{

			redirect('/auth/login');
		}
	}


}