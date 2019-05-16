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
    $this->model = new conversacionModel();
    
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
    $texto=isset($_GET['t'])?htmlentities($_GET['t']):'';
    $area=isset($_GET['a'])?htmlentities($_GET['a']):null;
    $param['resultados']=$this->model->busquedaHilo($texto,$area);
    $param['area']=$area;
    $param['texto']=$texto;
    $param['dareas']=conversacionModel::getAreas();
    $this->render(__CLASS__,null, $param); 
  }



}