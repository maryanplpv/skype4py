<?php


class Model_Messages extends Model {
	
	public $order_by = 'datetime';	// default sorting
	public $limit = 10; // items per 1 page
	public $total_pages; // count of pages
	public $active_page = 1; // active page
	public $pagination_start = 0;
	public $pagination_end = 10;
	public $desc = true;

	public function get_messages() {
	
		// get page number from AJAX
		if (isset($_POST['listpage'])) 
		{
			$this->pagination_start = ($_POST['listpage']-1) * $this->limit;
			$this->pagination_end = $this->limit;
			$this->active_page = $_POST['listpage'];
		}
		
		// explode pages
		$this->total_pages = ceil($this->messagesCount() / $this->limit);
		
		// sorting from AJAX
		if (isset($_POST['sort'])) 
		{
			$sort = explode(' ', $_POST['sort']);
			
			if (isset($sort[0]) and !empty($sort[0])) $this->order_by = $sort[0];
			
			if (isset($sort[1])) 
			{
				if ($sort[1] == "desc") $this->desc = true;
			} else 
			{
				//$this->desc = false;
			}
		}
		
		
		($this->desc) ? $desc = 'DESC' : $desc = '';
		$this->db->query_result("SELECT * FROM messages ORDER BY ".$this->order_by." ".$desc." LIMIT ".$this->pagination_start.",".$this->pagination_end);
		if ($this->db->result() != false) return $this->db->result();	
		
		
		/*
		$this->db->showDebug = false;
		$this->db->get();
		$this->db->from('messages', $this->pagination_start, $this->pagination_end);
		$this->db->sortBy($this->order_by);
		if ($this->desc) $this->db->desc();

		if ($this->db->result() != false) return $this->db->result();
		*/
	}
	
	
	public function messagesCount() 
	{
		$this->db->get();
		$this->db->from('messages');
		$this->db->where(array('m_status' => 'sent'));
		return ($this->db->result() != false) ? count($this->db->result()) : 0;
	}
	
	
	public function savenew($post) 
	{
		
		// check access
		if ($this->auth->logged_user() == false) return false;
		
		// require inputs
		$valide = array('name','text');
		
		// check required inputs
		foreach ($valide as $input) 
		{
			if (!isset($post[$input])) return false;
			
		}
		
		$vars = array();
		
		// vars
		foreach ($post as $input=>$value) 
		{
			$vars[$input] = $value;
		}
	
		extract($vars, EXTR_PREFIX_SAME, "dup");

		// insert data
		$values = array(
			'datetime'	=>	date('Y-m-d H:i:s'),
			'username'	=>	$name,
			'message'	=>	$text,
			'm_status'	=>	'new',
		);
		
		$this->db->insertTo('messages');
		$this->db->values($values);	
		if ($this->db->result() == true) return true;
		
				
		
	}
	
	
}
?>
