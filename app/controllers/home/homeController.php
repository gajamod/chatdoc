<?php
defined('BASEPATH') or exit('No se permite acceso directo');

/**
 * Home controller
 */
class homeController extends Controller
{
  /**
   * string 
   */
  public $nombre;

  /**
   * object 
   */
  public $model;

  /**
   * Inicializa valores 
   */
  public function __construct()
  {
    //$this->model = new homeModel();
    
  }

  /**
  * Método estándar
  */
  public function index()
  {

    $this->show();
  }

  public function show()
  {
    $this->sesion_permisos=false;
    $params = array('nombre' => $this->nombre);
    $this->render(__CLASS__,null, $params); 
  }



}