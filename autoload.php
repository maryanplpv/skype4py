<?php
	
	class Autoloader 
	{
		
		public static function run($class_name)
		{
			$filename = strtolower($class_name) . '.php';
			$filename = substr($filename, strpos($filename, '_')+1, strlen($filename));
			
			$model = ABSPATH . 'models/' . $filename;
			$controller = ABSPATH . 'controllers/' . $filename;
			
			// start model class
			
			if (file_exists($model)) {
				
				require_once $model;
				
			}
			
			// start controller class
			
			if (file_exists($controller)) {
				
				require_once $controller;
				
			}
			
		}
		
		
	}
	
?>