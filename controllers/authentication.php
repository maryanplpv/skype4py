<?php

class Controller_Authentication extends Controller 
{
	

	function __construct() 
	{
		$this->model = new Model_Authentication();
		$this->view = new View();
	}
	
	function index() 
	{	
		$this->view->load('login');
	}

	
	public function logout() 
	{
		
		// logout
		if ($this->model->logout()) 
		{
			echo 1; // for AJAX
			return true;
		}
	}
	
	
	public function logged_user() 
	{
		
		return $this->model->logged_user();
		
	}


	public function login() 
	{
		
		// check post data AJAX
		if (!isset($_POST['login']) || !isset($_POST['pass'])) return false;
		
		// login
		if ($this->model->login($_POST['login'], $_POST['pass'])) 
		{
			echo 1; // for AJAX
			return true;
		} 
	}
	
	
	
}

?>