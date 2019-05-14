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
  }
  public static function getAreas(){
    //obtiene Areas disponibles para consulta

  }

  public function existeConversacion($chat){
    //TODO: completar funcion ejemplo de verificacion de existencia
    if (
      is_numeric($chat) and 
      $chat>0 and 
      is_int(intval($chat))
    ) {
      $query="";
      $results=//resultados encontrados
      $cant=//cant resultados encontrados
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