<?php

class View {
	
	public $default_template = 'main_template'; // default template name
	
	public function load($view_name, $template_view = null, $data = null) {
		
		//breadcrumbs
		$path = explode('/', $_SERVER['REQUEST_URI']);
		$breadcrumbs  = array();

		
		// add view extention .php
		$view_name = $view_name . '.php';
				
		// convert array to vars
		if (isset($data) and !is_null($data) and is_array($data)) 
{
extract($data, EXTR_PREFIX_SAME, "dup");
}
		
		
		//load view
		if (is_null($template_view) or empty($template_view)) 
		{

			include ABSPATH . TEMPLATES_DIR .'/' . $this->default_template . '.php';
		} 
		else 
		{
			include ABSPATH . TEMPLATES_DIR .'/' . $template_view . '.php';
		}
		
	}
}

?>
