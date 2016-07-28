<?php

// main config

$config['development'] = true;




// database 

if ($config['development'] == true) {
	
	if ( !defined('DB_HOST') ) define('DB_HOST', 'localhost');

	if ( !defined('DB_USER') ) define('DB_USER', 'root');

	if ( !defined('DB_PASS') ) define('DB_PASS', '');

	if ( !defined('DB_NAME') ) define('DB_NAME', 'complaints');	

} else {
	
	if ( !defined('DB_HOST') ) define('DB_HOST', 'localhost');

	if ( !defined('DB_USER') ) define('DB_USER', 'root');

	if ( !defined('DB_PASS') ) define('DB_PASS', '');

	if ( !defined('DB_NAME') ) define('DB_NAME', 'booklist');	

}


?>