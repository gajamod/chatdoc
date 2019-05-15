<?php
define('BASEPATH', true);
require 'system/config.php';
require 'system/core/autoload.php';
require(LIBS_ROUTE.'BDBF.php');

/**
 * Inicializa Router y detección de valores de la URI
 */
$router = new Router();

$controller = $router->getController();
$method = $router->getMethod();
$param = $router->getParam();

/**
 * Validaciones e inclusión del controlador y el metodo 
 */
if(!CoreHelper::validateController($controller)){
  $controller = 'ErrorPage';
}

require PATH_CONTROLLERS . "{$controller}/{$controller}Controller.php";

$controller .= 'Controller';

if(!CoreHelper::validateMethodController($controller, $method)){
  array_unshift($param, $method);
  $method = 'index';
  
}
//mose("param",$param);
//mose("controller",$controller);
//mose("method",$method);

/**
 * Ejecución final del controlador, método y parámetro obtenido por URI
*/
$controller = new $controller;

$controller->$method($param); 