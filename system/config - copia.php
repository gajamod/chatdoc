<?php
defined('BASEPATH') or exit('No se permite acceso directo');

define("ENDESARROLLO",TRUE);

if (ENDESARROLLO) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
}else{
	error_reporting(0);
	ini_set('display_errors', 'off');

}
//////////////////////////////////////
// Valores de uri
/////////////////////////////////////

define('URI', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

//////////////////////////////////////
// Valores de rutas
/////////////////////////////////////
define('FOLDER_PATH', '/neuropediatria/');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
//define('PATH_VIEWS', FOLDER_PATH . 'app/views/');
define('PATH_VIEWS', 'app/views/');
define('PATH_CONTROLLERS', 'app/controllers/');
define('PATH_MODELS', 'app/models/');
define('PATH_TEMPLATES', 'app/templates/');
define('HELPER_PATH', 'system/helpers/');
//define('LIBS_ROUTE', ROOT . FOLDER_PATH . 'system/libs/');
define('LIBS_ROUTE', 'system/libs/');

//////////////////////////////////////
// Valores de core
/////////////////////////////////////

define('CORE', 'system/core/');
define('DEFAULT_CONTROLLER', 'home');

//////////////////////////////////////
// Valores de base de datos
/////////////////////////////////////

define('DB_SERVER', '172.24.160.145');
define('DB_USERNAME', 'root');
define('DB_DATABASE', 'neuroPrueba');
define('DB_PASSWORD', 'hpaxn521');
define('APPCHARSET', 'utf8');
//////////////////////////////////////
// Valores configuracion
/////////////////////////////////////
define("BASE_URL", "http://localhost/neuropediatria/");//Siempre debe finalizar en '/'

define("APPNAME", "Neuropediatria");
define("no-reply","no-reply@soporteyventas.com");
define("CONTACTO","contacto@soporteyventas.com");




//////////////////
///PAYPAL
//////////////////
define('PRO_PayPal', 0);//0=Sandbox 1=Produccion

if(PRO_PayPal){
	define("PayPal_CLIENT_ID", "AU6HfDdspW9Emc-D9qCJR7je4_gRDOKKvq9_RQp1vRsSkOZtbXfMZhC5lNyFzo_gNsS_OF5AnGunJ0N7");
	define("PayPal_SECRET", "ENuHPmc3bYvpkcR4lGN8KT4Jul06HC0QxAXDKwAJipfVEW1yfqCSkeN7pfcfHFNJBAoompHfMu78a_mA");
	define("PayPal_BASE_URL", "https://api.paypal.com/v1/");
}
else{
	define("PayPal_CLIENT_ID", "Ac8GW7zOOqljjQaErFGhLkaf4V-rk77EPRqwwPzfk0PMoV0PftS6z7YFjRSy6ss8xhCXozM4b9BVxj_S");
	define("PayPal_SECRET", "ECgK4TX6LyJ0Vw-F4EbwuDjkpB4NGY_mygy8j3wU9RlmT1LRXoBrNm9TpXmD37BeFwc7XiGT2ZP0MJDu");
	define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");
}



function configFile() 
{
	return true;
}


session_start();