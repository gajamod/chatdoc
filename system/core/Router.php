<?php
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * Identificacion de la URI
 */
class Router
{
  /**
   * @var string
   */
  public $uri;

  /**
   * @var string
   */
  public $controller;

  /**
   * @var string
   */
  public $method;

  /**
   * @var string
   */
  public $param;

  /**
   * Inicializa los atributos
   */
  public function __construct()
  {
    $this->setUri();
    $this->setController();
    $this->setMethod();
    $this->setParam();
  }

  private function url_origin( $s, $use_forwarded_host = false )
  {
      $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
      $sp       = strtolower( $s['SERVER_PROTOCOL'] );
      $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
      $port     = $s['SERVER_PORT'];
      $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
      $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
      $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
      return $protocol . '://' . $host;
  }

  private function full_url( $s, $use_forwarded_host = false )
  {
    $full=$this->url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
    $sub=substr($full,strlen($full)-1);
    if ($sub!="/") {
     $full.="/";
    }
    
      return $full;
  }

  private function realURI(){
    return str_replace(BASE_URL,'',$this->full_url($_SERVER));
  }
  /**
   * Asigna la uri completa
   */
  public function setUri()
  {

    $RURI=$this->realURI();
    $this->uri = explode('/', $RURI);
  }

  /**
   *Asigna el nombre del controlador
   */
  public function setController()
  {   //mose("OCont",$this->uri[0]);
      //mose("DEFAULT_CONTROLLER",DEFAULT_CONTROLLER);
    $this->controller = ($this->uri[0] === '') ? DEFAULT_CONTROLLER : $this->uri[0];
  }

  /**
   * Asigna el nombre del metodo
   */
  public function setMethod()
  {
    $this->method = (isset($this->uri[1]) && !(empty($this->uri[1]))) ? $this->uri[1] : '';
    //$this->method = (isset($this->uri[1]) && !(empty($this->uri[1]))) ? $this->uri[1] : 'index';
  }

  /**
   * Asigna el valor del parametro si existe segun el metodo de peticion
   */
  public function setParam()
  {
    $this->param = array();
    $s=count($this->uri);
    if ($s>2) {
      for ($i=2; $i < $s ; $i++) {
        if (!(empty($this->uri[$i]))) {
          $this->param[]=$this->uri[$i];
        }
      }
    }
    /*
    if(REQUEST_METHOD === 'POST')
      $this->param = $_POST;
    else if (REQUEST_METHOD === 'GET')
      $this->param = ! empty($this->uri[2]) ? $this->uri[2] : '';
      */
  }

  /**
   * @return $uri
   */
  public function getUri()
  {
    return $this->uri;
  }

  /**
   * @return $controller
   */
  public function getController()
  {
    return $this->controller;
  }

  /**
   * @return $method
   */
  public function getMethod()
  {
    return $this->method;
  }

  /**
   * @return $param
   */
  public function getParam()
  {
    return $this->param;
  }
}