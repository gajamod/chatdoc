<?php
defined('BASEPATH') or exit('No se permite acceso directo');

/**
* 
*/
class ErrorHelper
{
  public static function back($msg)
  {
    
    $controller = 'login';
    require PATH_CONTROLLERS . "login/loginController.php";
    $controller .= 'Controller';
    $method = 'back';
    /**
     * Ejecución final del controlador, método y parámetro obtenido por URI
    */
    $controller1 = new loginController();
    $controller1->back($msg); 
  }
}