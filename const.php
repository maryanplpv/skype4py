<?php

if ( !defined('ABSPATH') ) define('ABSPATH', str_replace('\\', '/', dirname(__FILE__) . '/'));

if ( !defined('TEMPLATES_DIR') ) define('TEMPLATES_DIR', 'views/templates');

if ( !defined('CONTROLLERS_DIR') ) define('CONTROLLERS_DIR', 'controllers/');

if ( !defined('VIEWS_DIR') ) define('VIEWS_DIR', 'views/');

if ( !defined('SITE_URL') ) ($config['development'] == true) ? define('SITE_URL', 'http://localhost/test2017.loc') : define('SITE_URL', '');


?>
