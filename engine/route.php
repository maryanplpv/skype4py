<?php 


class Route extends View {
	
	public function ErrorPage404()
	{
		
		header('HTTP/1.1 404 Not Found');
		
		$view = new View();
		$view->load('page_error');
		
    }
	
	
	public function url() {
		
		$routes['site'] = SITE_URL;
		$routes['path'] = array_filter(explode('/', $_SERVER['REQUEST_URI']));
		$routes['controller'] = $routes['path'][1];
		
		return $routes;
		
	}

	
	static function start() {
		
		// default controller & action
		$controller_name = 'Messages';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// get controller name
		if (!empty($routes[2])) {	
			$controller_name = $routes[2];
		}
		
		// get action name
		if (!empty($routes[3])) {
			$action_name = $routes[3];
		}

		$model_name = $controller_name;
		$controller_name = $controller_name;
		$action_name = $action_name;

		// include model file
		$model_file = strtolower($model_name).'.php';
		$model_path = "./models/".$model_file;
		if (file_exists($model_path)) include "./models/".$model_file;


		// include controller class file
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "./controllers/".$controller_file;
		
		if (file_exists($controller_path)) {
		
			include "./controllers/".$controller_file;
			
		} else {

			//die(Route::ErrorPage404());
	
		}
		
	
		// create controller object
		$controller_name = 'Controller_'.$controller_name;
		$controller = new $controller_name;
		$action = $action_name;
		
		if (method_exists($controller, $action)) {
			
			// run controller action
			$controller->$action();
			
		} else {

			die(Route::ErrorPage404());
		}
	
	}
}
?>
