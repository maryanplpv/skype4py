<?php
	
	// display errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	
	// config
	require_once 'config.php';
	
	
	// const
	require_once 'const.php';
	

	// autoload classes
	require_once('autoload.php');
	spl_autoload_register('Autoloader::run');
	
?>