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
define('PUERTO', $_SERVER['SERVER_PORT']);
define('PUERT2', (PUERTO==80)?"":":".PUERTO);
define('URI', $_SERVER['SERVER_NAME'].PUERT2.$_SERVER['REQUEST_URI']);
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
//////////////////////////////////////
// Valores de rutas
/////////////////////////////////////
define('FOLDER_PATH', '/chatdoc/');
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

define('DB_SERVER', 'soporteyventas.com');
define('DB_USERNAME', 'soport16_chatdoc');
define('DB_DATABASE', 'soport16_chatdoc');
define('DB_PASSWORD', 'ChatUser123@');
define('APPCHARSET', 'utf8');
//////////////////////////////////////
// Valores configuracion
/////////////////////////////////////
define("BASE_URL", "http://localhost/chatdoc/");//Siempre debe finalizar en '/'
define("LOGIN_URL", BASE_URL."login/");


define("APPNAME", "ChatDoc");
define("no-reply","no-reply@soporteyventas.com");
define("CONTACTO","contacto@soporteyventas.com");






function configFile() 
{
	return true;
}


session_start();