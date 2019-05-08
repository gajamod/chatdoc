<?php
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/
class ErrorPageController extends Controller
{
  public $path_inicio;

  public function __construct()
  {
    $this->path_inicio = FOLDER_PATH;
  }
  
  public function index()
  {
    $this->render(__class__,null, array('path_inicio' => $this->path_inicio));
  }
  public function back($msg="Ha ocurrido un Error")
  {
  	$params['msg']=$msg;
    $this->render(__class__,"back", $params);
  }
  public function error($msg){
    $params['msg']=$msg;
    $this->render(__class__,"back", $params);
  }
}