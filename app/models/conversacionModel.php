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
  public function cargar($estudio)
  {

  }

  public function registrarRespuesta($respuesta,$paciente,$token,$conversacion)
  {
    /**
    Si existe conversacion y conversacion.paciente==paciente
      Si no Existe token en conversacion
        Guardar respuesta
        return true
      Else
        Return -2
    Else
      return -3

    
    ***/
      
  }

  public function crearConversacion($paciente,$token,$area,$motivo,$descripcion){
    /**
      Si no existe token
        Crear conversacion
        Si se creo conversacion
          return idConversacion
        Else
          return -3
      Else 
        return -2
    **/
    
  }

  private function guardarRespuestaPac($id_pregunta,$respuesta,$idRespuestasPac){
    $query="SELECT `pregunta`, `requerida` FROM `preguntas` WHERE `id`=?";
    $args=[$id_pregunta];
    $result=fila_pdo($query,$args);

    $query="INSERT INTO `paciente_respuestas`(`id_estud_pac`, `id_pregunta`, `pregunta`, `respuesta`) VALUES (?,?,?,?)";
    $args=[$idRespuestasPac,$id_pregunta,$result['pregunta'],$respuesta];
    return id_pdo($query,$args);
  }

  private function respuestaValida($pregunta,$respuesta){
    $respuestas=$this->getRespuesta($pregunta);
    $cant=count($respuestas);
    if ($cant>1) {
      
      foreach ($respuestas as $key => $answer) {
        if ($answer['id']==$respuesta) {
          return $answer['respuesta'];
        }
      }
      return false;
    }elseif ($cant==1) {
      
      foreach ($respuestas as $key => $answer) {
        switch ($answer['respuesta']) {
          case 'text':
            return $respuesta;
            break;
          case 'number':
            return is_numeric($respuesta)?$respuesta:false;
            break;
          case 'bool':
            return ($respuesta==1)?'Si':'No';
            break;
          case 'date':
            return $respuesta;
            break;
          default:
            echo "---".$answer['respuesta']."---";
            return false;
            break;
        }
      }
        
    }else{
      return false;
    }
  }

  private function getRespuesta($pregunta){
    $query="SELECT `id`, `respuesta` FROM `respuestas` WHERE `pregunta` =?";
    $args=[$pregunta];
    return resultados_pdo($query,$args)->fetchAll();

  }
  public static function exist($estudio){
    if (
      is_numeric($estudio) and 
      $estudio>0 and 
      is_int(intval($estudio))
    ) {
      $query="SELECT id FROM neuroprueba.estudios where  id=?;";
      $results = resultados_pdo($query,$estudio);
      $cant=$results->rowCount();
      //mose("cant",$cant);
      if ( $cant== 1 ) {
        return true;
       }else{
        return false;
       }
    }else{
      
      return false;
    }
  }

  public static function existeConversacion($estudio){

    if (
      is_numeric($estudio) and 
      $estudio>0 and 
      is_int(intval($estudio))
    ) {
      $query="SELECT id FROM neuroprueba.estudios_paciente where  id=?;";
      $results = resultados_pdo($query,$estudio);
      $cant=$results->rowCount();
      //mose("cant",$cant);
      if ( $cant== 1 ) {
        return true;
       }else{
        return false;
       }
    }else{
      
      return false;
    }
  }
  public static function crear($nombre,$area,$descripcion)
  {
    $nombre=htmlentities($nombre);
    $area=htmlentities($area);
    $descripcion=htmlentities($descripcion);
    $query="INSERT INTO `neuroprueba`.`estudios` (`nombre`, `area`, `descripcion`) VALUES (?, ?, ?);";
    $args=[$nombre,$area,$descripcion];
    $id=id_pdo($query,$args);
    if (is_numeric($id) and$id>0) {
      return $id;
    }else{
      return false;
    }
  }

  public function getConversacion($registro){
    $query="SELECT e.`id`, e.`paciente`, e.`estudio`, e.`comentarios`, e.`registrador` as 'id_personal', e.`fecha`,p.nombre as 'nombre_personal'
      FROM `estudios_paciente` e
      INNER JOIN personal p on e.`registrador`=p.id
      WHERE e.`id`=?";
    $fila=fila_pdo($query,$registro);
    $data= array();
    $data["paciente"]=pacientesModel::pacienteLite($fila['paciente']);
    $data["info"]=self::getInfo($fila['estudio']);
    $data['fila']=$fila;
    $data['categorias']=self::getJerarquia($fila['estudio'],$registro);
    /*if ($data['categorias']!=null and $data['categorias']!=false and is_array($data['categorias'])) {
      $data['preguntas']=self::getPreguntas($estud);
    }else{
      $data['categorias']=null;
    }/**/
    return $data;
  }

  
  public static function getInfo($estudio){
    //Obtiene informacion basica para mostrar en  busqueda

    if (
      is_numeric($estudio) and 
      $estudio>0 and 
      is_int(intval($estudio))
    ) {
      $query="
      SELECT e.id as 'id_estudio',e.nombre as 'nombre_estudio', e.descripcion as 'descripcion_estudio',e.area as 'id_area',a.area as 'nombre_area' 
      FROM `neuroprueba`.`estudios` e 
      inner join `neuroprueba`.areas a on e.area=a.id
      WHERE e.id=?";
      $results = resultados_pdo($query,$estudio);
      $cant=$results->rowCount();
      //mose("cant",$cant);
      if ( $cant== 1 ) {
        return $results->fetch();
       }else{
        
        return false;
       }
    }else{
      
      return false;
    }
  }
  public static function getCategorias(){
    //obtiene Areas disponibles para consulta

  }
 

  
}

?>