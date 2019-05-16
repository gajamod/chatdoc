<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class conversacionModel
{
  
  public function __construct()
  {
    //parent::__construct();
  }
  public function crearConversacion($paciente,$token,$area,$motivo,$descripcion){

    /**
    Si sesion valida
      Si no existe token y area valida 

        Crear conversacion (Tomar datos de sesion existente)
        Si se creo conversacion
          return idConversacion
        Else
          return -3
      Else 
        return -2
    Else
      return -4
    **/
    
  }

  public function registrarRespuesta($respuesta,$paciente,$token,$conversacion)
  {
       $nombre=htmlentities($nombre);
    $area=htmlentities($area);
    $descripcion=htmlentities($descripcion);
    /**
  Si sesion valida
    Si existe conversacion y conversacion.paciente==paciente
      Si no Existe token en conversacion
        Guardar respuesta
        return true
      Else
        Return -2
    Else
      return -3
  Else
    return -4
    ***/
      
  }

  public function getConversacion($registro){
    //obtiene todos los datos de la conversacion, incluyendo los respuestas
    $conversacion['info']=$this->getInfo($registro);
    $conversacion['respuestas']=$this->getRespuestas($registro);
    return $conversacion;
  }

  private function getRespuestas($conversacion){
  /****obtiene todas las respuestas
  **formato de entrega array:
  foreach:
  [id_respuesta]={'respuesta','tipo','nombre'(paciente o dr segun caso),'fecha'}
    **/
  }

  public static function busquedaHilo($text='',$area=null){
    //Obtiene informacion de los hilos del paciente
    $text='%'.htmlentities($text).'%';
    if (Session::valid_session()) {
      $paciente=$_SESSION['id'];
      if (is_numeric($area) and $area>=1) {
        $query="SELECT h.id,h.motivo,h.area,a.nombre as 'nombre_area',h.fechacreacion,h.estatus  
          FROM hilos h
          inner join soport16_chatdoc.areas a on h.area=a.id
          WHERE h.paciente=? and (h.area=?) and h.motivo like ?";
        $results=resultados_query($query,'iis',$paciente,$area,$text);
      } else {
        $query="SELECT h.id,h.motivo,h.area,a.nombre as 'nombre_area',h.fechacreacion,h.estatus 
          FROM hilos h
          inner join soport16_chatdoc.areas a on h.area=a.id
          WHERE h.paciente=? and h.motivo like ?";
        $results=resultados_query($query,'is',$paciente,$text);
      }
      $cant=mysqli_num_rows($results);
      if ($cant>=1) {
        $hilos = array();
        $hilos['cantidad']=$cant;
        while ($r=mysqli_fetch_array($results)) {
          $hilos['resultados'][$r['id']]= array(
                'motivo' => $r['motivo']
                ,'fecha' => $r['fechacreacion']
                ,'nombre_area' => $r['nombre_area']
                ,'num_area' => $r['area']
                ,'estatus' => $r['estatus']
              );
          
        }
        return $hilos;
      } else {
        return 0;
      }
      
        
    } else {
      return -4;
    }
    
    /*
    foreach:
    [idHilo]={area, estatus,motivo}
    */
  }
  public static function getAreas(){
    //obtiene Areas disponibles para consulta
    $query="SELECT id, nombre FROM areas";
    $results=resultados_query($query,"");
    $cant=mysqli_num_rows($results);
      if ($cant>=1) {
        $hilos = array();
        $hilos['cantidad']=$cant;
        while ($r=mysqli_fetch_array($results)) {
          $hilos['resultados'][$r['id']]= array(
                'motivo' => $r['motivo']
                ,'fecha' => $r['fechacreacion']
                ,'nombre_area' => $r['nombre_area']
                ,'num_area' => $r['area']
                ,'estatus' => $r['estatus']
              );
          
        }
        return $hilos;
  }

  public function existeConversacion($chat){
    //TODO: completar funcion ejemplo de verificacion de existencia
    if (
      is_numeric($chat) and 
      $chat>0 and 
      is_int(intval($chat))
    ) {
      $query="";
      /*
      $results=//resultados encontrados
      $cant=//cant resultados encontrados
      */
      if ( $cant== 1 ) {
        return true;
       }else{
        return false;
       }
    }else{
      return false;
    }
  }
  
  private function areaValida($area){
    //verifica que el area sea valida
    
  }
  public function getInfo($conversacion){
    //Obtiene informacion de la conversacion
  }

}

?>