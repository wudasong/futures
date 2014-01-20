<?php
// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['SERVER_NAME'].'/');

// HTTPS
define('HTTPS_SERVER', 'https://'.$_SERVER['SERVER_NAME'].'/');


$here = dirname(__FILE__);

// DIR
define('DIR_APPLICATION', $here.'/web/');
define('DIR_SYSTEM', $here.'/system/');
define('DIR_DATABASE', $here.'/system/database/');
define('DIR_TEMPLATE', $here.'/web/view/theme/');
define('DIR_LOGS', $here.'/system/logs/');


// DB
if(IS_PRODUCT)
{	
	define('DB_DRIVER', 'mysql');
	define('DB_HOSTNAME', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'wds123456');
	define('DB_DATABASE', 'futures_tl');
	define('DB_PREFIX', '');
}
else 
{
	// DB Local
	define('DB_DRIVER', 'mysql');
	define('DB_HOSTNAME', '192.168.1.101');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'wds123456');
	define('DB_DATABASE', 'futures_tl');
	define('DB_PREFIX', '');
}
?>