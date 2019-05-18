<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class conversacionModel{
    public function __construct(){
        //parent::__construct();
    }

    public function crearConversacion($paciente,$token,$area,$motivo,$descripcion){
        //Si la sesion no es valida
        if (Session::valid_session()){
            //Si existe token y area valida
            if ($this->areaValida($area) and !($this->existeTokenConversacion($token)) ){
                //Crear conversacion (hilo) (Tomar datos de sesion existente)
                $query = "INSERT INTO 'hilos' ('motivo', 'area', 'descripcion', 'paciente',token) VALUES (?,?,?,?,?)";
                $idc = id_query($query, 'sisis', $motivo, $area, $descripcion, $paciente,$token);
                //Si se creo la conversacion
                if (is_numeric($idc) and $idc>0){
                    return $idc;
                }else{
                    return -3;
                }
            }else{
                return -2;
            }
        } else {
            return -4;
        }
    }   

    public function registrarRespuesta($respuesta,$paciente,$token,$conversacion){
        $nombre=htmlentities($nombre);
        $area=htmlentities($area);
        $descripcion=htmlentities($descripcion);
        // Si sesion valida
        //     Si existe conversacion y conversacion.paciente==paciente
        //         Si no Existe token en conversacion
        //             Guardar respuesta
        //             return true
        //         Else
        //             return -2
        //     Else
        //         return -3
        // Else
        //     return -4

        if (Session::valid_session()) {
            if ($this->existeConversacion($conversacion,$paciente)) {
                if (!($this->existeTokenRespuesta($token,$conversacion))) {
                    $query="INSERT INTO `respuestas`( `hilo`, `respuesta`,`paciente`,`token`) VALUES (?,?,?,?);";
                    $id=id_query($query,"isis",$conversacion,$respuesta,$paciente,$token);
                    if (is_numeric($id) and $id>0) {
                        return $id;
                    } else {
                        return -3;
                    }
                    
                }else {
                    return -2;
                }
            } else {
               return -2;
            }
        } else {
            return -4;
        }
        
    }

    public function getConversacion($registro){
        //obtiene todos los datos de la conversacion, incluyendo los respuestas
        if ($this->existeConversacion($registro)) {
            $conversacion['info']=$this->getInfo($registro);
            $conversacion['respuestas']=$this->getRespuestas($registro);
            return $conversacion;
        } else {
            return false;

        }
    }

    private function getRespuestas($conversacion){
        /****obtiene todas las respuestas
        **formato de entrega array:
        foreach:
        [id_respuesta]={'respuesta','tipo','nombre'(paciente o dr segun caso),'fecha'}
        **/
        $query="SELECT r.`id`, `respuesta`, r.`paciente`, r.`medico`, r.`fecha_registro`,p.nombre AS 'n_pac',m.nombre AS 'n_dr'
                FROM `respuestas` r
                LEFT JOIN pacientes p ON r.paciente=p.id
                LEFT JOIN medicos m ON r.medico=m.id
                WHERE `hilo`=?";
        $results=resultados_query($query,"i",$conversacion);
        $cant=mysqli_num_rows($results);
        if ($cant>=1) {
            $resp = array();
            $resp['cantidad']=$cant;
            while ($r=mysqli_fetch_array($results)) {
                if (is_numeric($r['medico'] ) and $r['medico']>0) {
                    $nom=$r['n_dr'];
                    $tip=1;
                } else {
                    $nom=$r['n_pac'];
                    $tip=0;
                }
                $resp['registros'][$r['id']]= array(
                    'respuesta' => $r['respuesta']
                    ,'fecha' => $r['fecha_registro']
                    ,'tipo' => $tip
                    ,'nombre'=> $nom
                );
            }
            return $resp;
        } else {
            return 0;
        }

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
                    $hilos['registros'][$r['id']]= array(
                    'motivo' => $r['motivo']
                    ,'fecha' => $r['fechacreacion']
                    ,'nombre_area' => $r['nombre_area']
                    ,'num_area' => $r['area']
                    ,'estatus' => $r['estatus']
                );}
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
            $areas = array();
            while ($r=mysqli_fetch_array($results)) {
                $areas[$r['id']]=$r['nombre'];
            }
            return $areas;
        }else{
            return false;
        }
    }

    public function existeConversacion($chat,$paciente=null){
        //TODO: completar funcion ejemplo de verificacion de existencia
        if (is_numeric($chat) and $chat>0 and is_int(intval($chat))) {
            if (is_numeric($paciente) and $paciente>0) {
                $query="SELECT `id` FROM `hilos` WHERE `id`=? and `paciente`=?";
                $results = resultados_query($query, 'ii', $chat,$paciente);
            } else {
                $query = "SELECT `id` FROM `hilos` WHERE `id`=?";
                $results = resultados_query($query, 'i', $chat);
                
            }
            $cant=mysqli_num_rows($results);
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
        if (is_numeric($area) and $area>0) {
            $query = "SELECT `id`, `nombre` FROM `areas` WHERE `id`=?";
            $results = resultados_query($query, 'i', $area);
            $cant=mysqli_num_rows($results);
            if ($cant>=1) {
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }       
    }
    private function existeTokenConversacion($token){
        //verifica si el token de la conversacion existe
            $query = "SELECT `id` FROM `hilos` WHERE `token`=?";
            $results = resultados_query($query, 's', $token);
            $cant=mysqli_num_rows($results);
            if ($cant>=1) {
                return true;
            }else{
                return false;
            }
     
    }

    private function existeTokenRespuesta($token,$conversacion){
        //verifica si el token de la conversacion existe
            $query = "SELECT `id` FROM `hilos` WHERE `token`=?";
            $results = resultados_query($query, 's', $token);
            $cant=mysqli_num_rows($results);
            if ($cant>=1) {
                return true;
            }else{
                return false;
            }
     
    }

    public function getInfo($conversacion){
        //Obtiene informacion de la conversacion
    }
}
?>