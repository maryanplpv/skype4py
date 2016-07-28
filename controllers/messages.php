<?php

class Controller_Messages extends Controller 
{

	function __construct() 
	{
	
		$this->model = new Model_Messages();
		$this->view = new View();
		$this->session = new Session();
		$this->auth = new Controller_Authentication();
		$this->model->auth = $this->auth;

	}
	
	
	public function index() 
	{
		
		$data['messages'] = $this->model->get_messages();
		$data['total_pages'] = $this->model->total_pages;
		$data['active_page'] = $this->model->active_page;
		$data['user_name'] = $this->session->data('login');
		
		// check access for show/hide admin buttons
		($this->auth->logged_user()) ? $data['is_admin'] = true : $data['is_admin'] = false;
		
		// load view
		$this->view->load('messages', null, $data);
		
	}


	public function addnew() 
	{

		$this->view->load('send_message_form'); 
		
	}
	

	
	public function savenew() 
	{
		
		// get post AJAX
		if (!isset($_POST)) return false;
	
	
		if ($this->model->savenew($_POST)) 
		{
			echo 1;
		} 
		else 
		{
			echo 0;
		}
	
	}

}

?>