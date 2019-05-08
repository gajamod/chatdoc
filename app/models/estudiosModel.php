<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class estudiosModel
{
  
  public function __construct()
  {
    //parent::__construct();
  }
  public function cargar($estudio)
  {

  }

  public function registrarRespuestas($estudio,$paciente,$token,$respuestas,$comentarios="Sin comentarios")
  {
    $idRegistro=$this->crearRespuestasPaciente($estudio,$paciente,$token,$comentarios);
    if ($idRegistro>1) {
      $final['registro']=$idRegistro;
      $final['estudio']=$estudio;
      $final['paciente']=$paciente;
      $final['token']=$token;
      $final['comentarios']=$comentarios;
      foreach ($respuestas as $pregunta => $respuesta) {
        if ($pregunta[0]=='p' and is_numeric($pregunta=substr($pregunta,1))) {
          $respuestaR=$this->respuestaValida($pregunta,$respuesta);
          if ($respuestaR != false) {
            $final['preguntas'][$pregunta]['registro']=$this->guardarRespuestaPac($pregunta,$respuestaR,$idRegistro);
            $final['preguntas'][$pregunta]['respuesta']=$respuestaR;
            //echo "<br/>Respuesta Pregunta: ".$pregunta." R=".$respuestaR." RO=".$respuesta;
          } else {
            $final['error'][$pregunta]=$respuesta;
          }
        } else {
          echo "Error Pregunta: ".$pregunta;
        }
      }
      return $final;
    }else{
      return $idRegistro;
    }
      
  }

  private function crearRespuestasPaciente($estudio,$paciente,$token,$comentarios){
    $query="SELECT `id` FROM `estudios_paciente` WHERE `token`=?";
    $result=resultados_pdo($query,$token)->fetchAll();
    $cant=count($result);
    if ($cant>=1) {
      return -2;
    } else {
      if (Session::valid_session()) {
        $query="INSERT INTO `estudios_paciente`(`paciente`, `estudio`, `comentarios`, `registrador`, `token`) VALUES (?,?,?,?,?)";
        $args=[$paciente,$estudio,$comentarios,$_SESSION['idE'],$token];
        return id_pdo($query,$args);
      }else{
        return -4;
      }
    }
    
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

  public static function existRegistro($estudio){

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

  public function getRegistro($registro){
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

  public static function getData($estud){
    $data= array();
    $data["info"]=self::getInfo($estud);
    $data['categorias']=self::getJerarquia($estud);
    /*if ($data['categorias']!=null and $data['categorias']!=false and is_array($data['categorias'])) {
      $data['preguntas']=self::getPreguntas($estud);
    }else{
      $data['categorias']=null;
    }/**/
    return $data;
  }



  public static function getAreas(){
    $query="SELECT id,area FROM `neuroprueba`.`areas`";
    return resultados_pdo($query,array())->fetchAll();
  }
  public static function getHijos($categoria,$registro=false){
    if (
      is_numeric($categoria) and 
      $categoria>0 and 
      is_int(intval($categoria))
    ){
      $query="SELECT id, nombre as 'nombre_categoria',requiereEdad as 'edad_requerida',edadMaxima as 'edad_maxima',requierePregunta as 'pregunta_requerida' FROM neuroprueba.categorias Where padre=?;";
      $jerarquia = array();
      $results = resultados_pdo($query,$categoria);
      $cant=$results->rowCount();
      if ( $cant>0 ) {
        while ($fila = $results->fetch()) {
          $resHijo=self::getHijos($fila['id'],$registro);
          if ($resHijo!=false) {
            $jerarquia[$fila['id']]['subcategorias']=$resHijo;
            $jerarquia[$fila['id']]['nombre_categoria']=$fila['nombre_categoria'];
            $jerarquia[$fila['id']]['edad_requerida']=$fila['edad_requerida'];
            $jerarquia[$fila['id']]['pregunta_requerida']=$fila['pregunta_requerida'];
            $jerarquia[$fila['id']]['edad_maxima']=$fila['edad_maxima'];
          }else{
            $jerarquia[$fila['id']]['preguntas']=self::getPreguntasCat($fila['id'],$registro);
            $jerarquia[$fila['id']]['nombre_categoria']=$fila['nombre_categoria'];
            $jerarquia[$fila['id']]['edad_requerida']=$fila['edad_requerida'];
            $jerarquia[$fila['id']]['edad_maxima']=$fila['edad_maxima'];
            $jerarquia[$fila['id']]['pregunta_requerida']=$fila['pregunta_requerida'];
          }
        }
        return $jerarquia; 
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
  public static function getJerarquia($estudio,$registro=false){
    if (
      is_numeric($estudio) and 
      $estudio>0 and 
      is_int(intval($estudio))
    ){
      $jerarquia = array();
      $query="SELECT id, nombre as 'nombre_categoria',requiereEdad as 'edad_requerida',edadMaxima as 'edad_maxima',requierePregunta as 'pregunta_requerida' 
        FROM neuroprueba.categorias 
        Where estudio=?;";
      $results = resultados_pdo($query,$estudio);
      $cant=$results->rowCount();
      if ( $cant>0 ){
        while ($fila = $results->fetch()) {
          $resHijo=self::getHijos($fila['id'],$registro);
          if ($resHijo!=false) {
            $jerarquia[$fila['id']]['subcategorias']=$resHijo;
            $jerarquia[$fila['id']]['nombre_categoria']=$fila['nombre_categoria'];
            $jerarquia[$fila['id']]['edad_requerida']=$fila['edad_requerida'];
            $jerarquia[$fila['id']]['pregunta_requerida']=$fila['pregunta_requerida'];
          }else{
            $jerarquia[$fila['id']]['preguntas']=self::getPreguntasCat($fila['id'],$registro);
            $jerarquia[$fila['id']]['nombre_categoria']=$fila['nombre_categoria'];
            $jerarquia[$fila['id']]['edad_requerida']=$fila['edad_requerida'];
            $jerarquia[$fila['id']]['edad_maxima']=$fila['edad_maxima'];
            $jerarquia[$fila['id']]['pregunta_requerida']=$fila['pregunta_requerida'];
          }
        }
        return $jerarquia; 
      }else{
        return false;
      }
    }
  }
  
  public static function getInfo($estudio){
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
  public static function getCategorias($estudio){

    if (
      is_numeric($estudio) and 
      $estudio>0 and 
      is_int(intval($estudio))
    ) {
      $query="
      SELECT c.id as 'id_categoria', c.nombre as 'nombre_categoria', c.padre 'categoria_padre'
      FROM `neuroprueba`.`categorias` c 
      where c.estudio=?";
      $results = resultados_pdo($query,$estudio);
      $cant=$results->rowCount();
      //mose("cant",$cant);
      if ( $cant>0 ) {
        return $results->fetchAll();
       }else{
        return false;
       }
    }else{
      return false;
    }
  }
  public static function getPreguntas($estudio){
    if (
      is_numeric($estudio) and 
      $estudio>0 and 
      is_int(intval($estudio))
    ) {
      $query="
      SELECT c.padre 'categoria_padre',c.id as 'id_categoria',c.nombre as 'nombre_categoria', p.id as 'id_pregunta',p.pregunta,p.requerida,p.comentario,r.id as 'id_respuesta', r.respuesta
      FROM neuroprueba.Preguntas p
      inner join `neuroprueba`.`categorias` c on p.categoria=c.id
      inner join `neuroprueba`.`respuestas` r on p.id=r.pregunta
      where c.estudio=?";
      $results = resultados_pdo($query,$estudio);
      $cant=$results->rowCount();
      $pregs = array();
      if ( $cant>0 ){
        while ($fila = $results->fetch()){
          if (!(isset($pregs[$fila['categoria_padre']][$fila['id_categoria']][$fila['id_pregunta']]))) {
            $pregs[$fila['categoria_padre']][$fila['id_categoria']][$fila['id_pregunta']]=['pregunta'=>$fila['pregunta'],'comentario'=>$fila['comentario']
            ];
          }
          $pregs[$fila['categoria_padre']][$fila['id_categoria']][$fila['id_pregunta']]['respuestas'][$fila['id_respuesta']]=$fila['respuesta'];
        }
        return $pregs;
        //return $results->fetchAll();
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
  public static function getPreguntasCat($categoria,$registro=false){
    if (
      is_numeric($categoria) and 
      $categoria>0 and 
      is_int(intval($categoria))
    ){
      if ($registro==false) {
        $query="
          SELECT  p.id as 'id_pregunta',p.pregunta,p.requerida,p.comentario,r.id as 'id_respuesta', r.respuesta
          FROM neuroprueba.preguntas p
          inner join `neuroprueba`.`respuestas` r on p.id=r.pregunta
          where p.categoria=?";
        $results = resultados_pdo($query,$categoria);
        $cant=$results->rowCount();
        $pregs = array();
        if ( $cant>0 ){
          while ($fila = $results->fetch()){
            if (!(isset($pregs[$fila['id_pregunta']]))) {
              $pregs[$fila['id_pregunta']]=[
                'pregunta'=>$fila['pregunta'],
                'requerida'=>$fila['requerida'],
                'comentario'=>$fila['comentario'],
              ];
            }
            $pregs[$fila['id_pregunta']]['respuestas'][$fila['id_respuesta']]=$fila['respuesta'];
          }
          return $pregs;
          //return $results->fetchAll();
        }else{
          return false;
        }
      }else{
        if (is_numeric($registro) and 
          $registro>0 and 
          is_int(intval($registro))
        ){
          $query="SELECT r.`id`, r.`id_pregunta`, r.`pregunta`, r.`respuesta` 
            FROM `paciente_respuestas` r
            INNER JOIN preguntas p on r.`id_pregunta`=p.id
            WHERE p.categoria=? AND r.`id_estud_pac`=?";
            $args=[$categoria,$registro];
            $results = resultados_pdo($query,$args);
            $cant=$results->rowCount();
            $pregs = array();
            if ( $cant>0 ){
              while ($fila = $results->fetch()){
                if (!(isset($pregs[$fila['id_pregunta']]))) {
                  $pregs[$fila['id_pregunta']]=[
                    'pregunta'=>$fila['pregunta'],
                    'respuesta'=>$fila['respuesta'],
                    'id_operacion'=>$fila['id']
                  ];
                }
              }
              return $pregs;
              //return $results->fetchAll();
            }else{
              return false;
            }
        }else{
          return false;
        }
      }
        
    }else{
      return false;
    }
    
  }
  public static function drawSelectAreas($nombre, $class="",$id=null){
    ob_start();
    $ar=self::getAreas();
    ?>
    <div class="form-group">
      <select name="<?php echo $nombre; ?>" class="<?php echo $class; ?>" <?php // (!is_null($id)) ? 'id="'.$id.'"': " "; ?> >
        <?php 
          foreach ($ar as $key => $fila) {
            ?>
              <option value="<?php echo $fila['id']; ?>"><?php echo $fila['area']; ?></option>
            <?php
          }
        ?>
      </select>
    </div>
    <?php
    
    return ob_get_clean();
  }

  
}

?>