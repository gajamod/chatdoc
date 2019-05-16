<?php
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* Controlador base
*/
class Controller
{
  /**
   * @var object
   */
  private $view;
  protected $sesion_valida=true;
  protected $sesion_permisos=true;
  protected $sesion_redireccionar=true;
  /**
   * Inicializa la vista
   */
  public function render($controller_name = '',$opcion=null, $params = array())
  {
    if (Session::requiere_sesion($this->sesion_valida,$this->sesion_redireccionar)) {
      $this->view = new View($controller_name,$opcion, $params);
      echo $this->view->render();
   }else{
      $params['msg']="No tienes permisos";
      $this->view = new View($controller_name,"back",$params );
      echo $this->view->render();
   }
    
  }

  public function renderPartial($controller_name = '',$opcion, $params = array())
  {
    $this->view = new View($controller_name,$opcion, $params);
    echo $this->view->renderPartial();
  }
 

  /**
   * Metodo estándar
   */
  public function error($msg){
    $params['msg']=$msg;
    $this->render(__class__,"back", $params);
  }
}