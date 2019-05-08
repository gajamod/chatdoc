<?php
defined('BASEPATH') or exit('No se permite acceso directo');

class pacientesController extends Controller
{
  /**
   * object 
   */
  public $model;

  /**
   * Inicializa valores 
   */
  public function __construct()
  {
    $this->model = new pacientesModel();
    
  }

  /**
  * Método estándar
  */
  public function index($params)
  {
    $this->show($params);
  }

  public function show($params)
  {
    $this->sesion_permisos=false;
    $params['datos'] = $this->model->paciente($params[0]);
    if (is_array($params['datos']) and !(empty($params['datos']))) {
      $params['estudios']= $this->model->estudios_paciente($params[0]);
      $params['estudiosDisponibles']=$this->model->estudiosDisponibles($params[0]);
      $this->render(__CLASS__,null, $params);
    }else{
      header('location: '.BASE_URL.'busqueda/pacientes/');
    }
    
     
  }

    

}