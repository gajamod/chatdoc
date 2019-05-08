<?php
defined('BASEPATH') or exit('No se permite acceso directo');

/**
 * Home controller
 */
class busquedaController extends Controller
{

  public function __construct()
  {
    $this->model = new busquedaModel();
    
  }

  /**
  * Método estándar
  */
  public function index($param)
  {
    //print_r($_GET);
    $this->sesion_permisos=false;
    $area=strtolower($param[0]);
    if ($area=='pacientes') {
      $param1= array();
      if (isset($_GET['ar']) and !(empty($_GET['ar']))) {
        $param1['ar']=$_GET['ar'];
      }
      if (isset($_GET['ei']) and !(empty($_GET['ei']))) {
        $param1['ei']=$_GET['ei'];
      }
      if (isset($_GET['ea']) and !(empty($_GET['ea']))) {
        $param1['ea']=$_GET['ea'];
      }
      if (isset($_GET['an']) and !(empty($_GET['an']))) {
        $param1['an']=$_GET['an'];
      }
      if (isset($_GET['na']) and !(empty($_GET['na']))) {
        $param1['na']=$_GET['na'];
      }
      $params['pacientes']= $this->model->pacientes($param1);
      $params['filtros']=$param1;
      $this->render(__CLASS__,"pacientes", $params);
    }elseif ($area=='estudios') {
      $params['estudios']= $this->model->estudios($param);
      $this->render(__CLASS__,"estudios", $params);
    }else{
      header('location: '.BASE_URL.'busqueda/pacientes/');
    } 
  }

  public function error($msg){
    $params['msg']=$msg;
    $this->render(__class__,"back", $params);
  }

}