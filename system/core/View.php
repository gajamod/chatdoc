<?php
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * Vista base
 */
class View
{
  /**
   * string
   */
  protected $template;

  /**
   * string
   */
  protected $controller_name;
  protected $opcion;
  protected $title;
  /**
   * array
   */
  protected $params;
  
  /**
   * Inicializa valores y el render
   * @param string $controller_name
   * @param array $params. Opcional
   */
  public function __construct($controller_name,$opcion, $params = array())
  {
    $this->controller_name = $controller_name;
    $this->params = $params;
    $this->opcion=$opcion;
    
  }

  /**
   * Muestra la vista según el controlador que hizo la petición
   */
  public function render($opcion=null)
  {
    if(class_exists($this->controller_name)){
      $file_name = str_replace('Controller', '', $this->controller_name);
      $this->template = $this->getContentTemplate($file_name,(empty($opcion))? $this->opcion:$opcion);
      return $this->template;
    }else{
      throw new Exception("Error No existe $controller_name");
    }
  }

  public function renderPartial($opcion=null){
    if(class_exists($this->controller_name)){
      $file_name = str_replace('Controller', '', $this->controller_name);
      $this->template = $this->getPartialTemplate($file_name,(empty($opcion))? $this->opcion:$opcion);
      return $this->template;
    }else{
      throw new Exception("Error No existe $controller_name");
    }
  }

  protected function getPartialTemplate($clase,$funcion){
    $file_path = PATH_VIEWS .$clase. "/" .$funcion. '.php';

    if(is_file($file_path)){
      extract($this->params);
      ob_start();
      require($file_path);
      $body=ob_get_clean();
      return $body;
    }else{
      throw new Exception("Error No existe $file_path");
    }
  }

  /**
   * Retorna el render de una vista
   */
  protected function getContentTemplate($clase,$funcion=null)
  {
    if ($funcion==null) {
       $funcion=$clase;
     } 
    $file_path = PATH_VIEWS .$clase. "/" .$funcion. '.php';

    $bandera=false;
    if((is_file($file_path))){
      $bandera=true;
    }elseif ($funcion=="back") {
      $file_path = PATH_TEMPLATES.$funcion.'.php';
      if((is_file($file_path))){
        $bandera=true;
      }
    }

    if ($bandera) {
      extract($this->params);
      ob_start();
      $screen = array(
        'title' => APPNAME,
        'onBody' => '',
        'extendedHead'=> ''
      );
      require($file_path);
      $body=ob_get_clean();
      $prueba= new Screen($screen['title'],$body);
      $prueba->setOnBody($screen['onBody']);
      $prueba->setExtendHead($screen['extendedHead']);
      $prueba->setParamScreen($this->params);
      $prueba->draw();

      $template = ob_get_contents();
      ob_end_clean();
      return $template;
    } else{
      throw new Exception("Error No existe $file_path");
    }
    
      
  }

}