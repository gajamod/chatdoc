<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class usersModel extends loginModel
{
  
  public function __construct()
  {
    //parent::__construct();
  }

  public function ver_usuarios(){
    $query='SELECT `id`, `nombre`, `usuario`, `admin`, `activo`,`fecha_registro` FROM `personal` WHERE 1';
    return resultados_pdo($query,array())->fetchAll();
  }

  public function cambiar_permisos($a,$nuevo,$por){
    if ($this->tiene_permiso($por)) {
      if (is_numeric($nuevo) and ($nuevo==1 or $nuevo==0)) {
        $query='UPDATE `personal` SET `token`=?,`admin`=? WHERE `id`=?';
        $args=[Session::generateToken(),$nuevo,$a];
        $results=afectados_pdo($query,$args);
        return $results;
      }else{
        return -3;//Dato No valido
      }
    }else{
      return -4;// sin permisos
    }
    
  }
  public function cambiar_estatus($a,$nuevo,$por){
    if ($this->tiene_permiso($por)) {
      if (is_numeric($nuevo) and ($nuevo==1 or $nuevo==0)) {
        $query='UPDATE `personal` SET `token`=?,`activo`=? WHERE `id`=?';
        $args=[Session::generateToken(),$nuevo,$a];
        $results=afectados_pdo($query,$args);
        return $results;
      }else{
        return -3;//Dato No valido
      }
    }else{
      return -4;// sin permisos
    }
  }

  public function tiene_permiso($usuario){
    $query='SELECT `id`,`admin`, `activo` FROM `personal` WHERE `id`=? and `admin`=1 and `activo`=1';
    $results=resultados_pdo($query,$usuario);
    $cant=$results->rowCount();
    //mose("cant",$cant);
    if ( $cant== 1 ) {
      return true;
    }else{
      return false;
    }
  }

  public function es_activo($usuario){
    $query='SELECT `id`,`admin`, `activo` FROM `personal` WHERE `id`=?  and `activo`=1';
    $results=resultados_pdo($query,$usuario);
    $cant=$results->rowCount();
    //mose("cant",$cant);
    if ( $cant== 1 ) {
      return true;
    }else{
      return false;
    }
  }


}