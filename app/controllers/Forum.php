<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
		$this->load->model('Commercial_model');
		$this->load->model('Internal_model');	
		$this->load->model('Location_Model');
		$this->load->model('Forum_model');
	}

	public function getForum()
	{
		// Navbar Configuration
		$data['navbarConf'] = 'internal';
		// Navbar Configuration End
		// Load Renders for Navbar
		$data['menuCat'] = $this->Commercial_model->getCategoryALL();
		$data['menuBrands'] = $this->Commercial_model->getBrandsALL();
		$data['menuInt'] = $this->Internal_model->getInternalALL();
		// Load Renders for Navbar End
		

		// User Status
		$status = getUserNfo(getMyID())['active'];
		// User Status End

		if ($this->ion_auth->logged_in()) {

			if ($status == 1) {
				$data['title'] = getSiteConfiguration()['site_name'] . ' | Foro';
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
				$data['titleSpot'] = 'Foro';
				// Render Visualizations End
				
				// Render Forum Categories
				$data['forumCat'] = $this->Forum_model->getForumCats();
				// Render Forum Categories End

				// Load View
				$this->load->view('forum/forum', $data);
			}else{
				// Error Forbiden Access
				redirect('User/mustLog','refresh');
			}

		}else{
			// Error Forbiden Access
			redirect('User/mustLog','refresh');
		}
	}

	public function getForumCategory($slug)
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
		$data['category'] = $this->Forum_model->getForumCatBySlug($slug);

		// Render Title and Tags
		if ($data['category']->num_rows() > 0) {
			
			foreach ($data['category']->result() as $cat) {
				// Save Category ID
				$catID = $cat->for_cat_id;
				$categoryTitle = $cat->title;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $categoryTitle;
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
			$data['titleSpot'] = $categoryTitle;
			// Render Visualizations End

			// Category Title
			$data['catTitle'] = $categoryTitle;
			// Category Title End

			// Category ID
			$data['catID'] = $catID;
			// Category ID End
			
			// Render Forum Topics By Category
			$data['forumTopic'] = $this->Forum_model->getForumTopicByCatID($catID);
			// Render Forum Topics By Category End

			// Load View
			$this->load->view('forum/category', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function saveForumTopic()
	{
		$userID = getMyID();
		$catID = $_POST['catID'];
		$topicTitle = $_POST['title'];
		$topicBody = $_POST['body'];
		$date = date('y-m-d');
		
		$slug = str_replace(' ','-',$topicTitle);
		$replaceValues = array('.',',','?','!','¿','!');
		$slug = strtolower(str_replace($replaceValues,'',$slug));

		$data = array(
           'title' => $topicTitle,
           'slug' => $slug,
           'date' => $date,
           'user_id' => $userID,
           'for_cat_id' => $catID,
           'body' => $topicBody
        );
		$this->db->insert('forum_topic', $data);

		redirect('foro/category/' . getForumCatNfoById($catID)['slug'],'refresh');
	}

	public function getForumTopic($slug)
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
		$data['topic'] = $this->Forum_model->getForumTopicBySlug($slug);

		// Render Title and Tags
		if ($data['topic']->num_rows() > 0) {
			
			foreach ($data['topic']->result() as $top) {
				// Save Category ID
				$topID = $top->for_topic_id;
				$topicTitle = $top->title;
				// Get Basic Info For Page Meta
				$data['title'] = getSiteConfiguration()['site_name'] . ' | ' . $topicTitle;
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
			$data['titleSpot'] = $topicTitle;
			// Render Visualizations End

			// Category Title
			$data['topTitle'] = $topicTitle;
			// Category Title End

			// Category ID
			$data['topID'] = $topID;
			// Category ID End

			// Render Topic
			$data['topic'] = $this->Forum_model->getForumTopicByID($topID);
			// Render Topic End

			// Render Topic Comments
			$data['comments'] = $this->Forum_model->getForumCommentsByTopicID($topID);
			// Render Topic Comments End

			// Load View
			$this->load->view('forum/topic', $data);
		}else{
			// Error 404 Page
			redirect('Error/NotFound', 'refresh');
		}
	}

	public function createComment()
	{
		$userID = getMyID();
		$topID = $_POST['topID'];
		$comBody = $_POST['body'];
		$date = date('y-m-d');
		
		$data = array(
           'comment_father' => $_POST['commFather'],
           'date' => $date,
           'user_id' => $userID,
           'for_topic_id' => $topID,
           'body' => $comBody,
           'plus_vote' => 0,
           'neg_vote' => 0
        );  
		
		$this->db->insert('forum_comment', $data);

		redirect('foro/topic/' . getForumTopicNfoById($topID)['slug'], 'refresh');
	}

	public function voteComments()
	{
		$topID = $_POST['topID'];
		$adjustVote = $_POST['adjustVote'];
		$comID = $_POST['comID'];
		
		if ($adjustVote == 1) {
			$posVote = getPositiveVotesComByID($comID);
			$data = array(
	           'plus_vote' => $posVote + 1
	        );
		}else{
			$negVote = getNegativeVotesComByID($comID);
	        $data = array(
	           'neg_vote' => $negVote + 1
	        );
		}
        $this->db->where('for_com_id', $comID);
        $this->db->update('forum_comment', $data);

		redirect('foro/topic/' . getForumTopicNfoById($topID)['slug'], 'refresh');
	}

}