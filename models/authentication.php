<?php

class Model_Authentication extends Model {


	public function login($login, $pass) 
	{
		$this->db->get(array('login', 'pass'));
		$this->db->from('users');
		$this->db->where(array('login' => $login, 'pass' => sha1(md5($pass))));
		
		if ($this->db->result() != false and count($this->db->result()) > 0) 
		{
			
			$this->session->set_data('login', $_POST['login']);
			$this->session->set_data('login_date', date('Y-m-d H:i:s'));
			
			return true;
		}
	
	}
	
	
	public function logged_user() 
	{
		
		if ($this->session->exists('login')) {return true;} else {return false;}
		
	}
	
	
	public function logout() 
	{
	
		if ($this->session()) {
			$this->session->unset_data('login');
			$this->session->unset_data('login_date');	
			return true;
		}

	}
	
	
	public function register($login, $pass) 
	{
		
		$values = array(
			'login'	=>	$login,
			'pass'	=>	$pass,
		);
		
		$this->db->insertTo('users');
		$this->db->values($values);
		if ($this->db->result() == true) {return true;}	
	}
}
?>