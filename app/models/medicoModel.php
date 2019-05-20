<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class medicoModel{
    public function __construct(){
        //parent::__construct();
    }




    public static function busquedaMedico($text='',$area=null){
        //Obtiene informacion de los hilos del paciente
        $text='%'.htmlentities($text).'%';
        if (Session::valid_session()) {
            $paciente=$_SESSION['id'];
            if (is_numeric($area) and $area>=1) {
                $query="SELECT m.`id`, m.`nombre`, `cedula`, `area`, `estatus`, `correo`,a.nombre as 'nombre_area',DATE_FORMAT(fecha_registro,'%d/%b/%Y') AS 'fecha_registro'
                    FROM `medicos` m
                    inner join soport16_chatdoc.areas a on m.area=a.id
                    WHERE m.`nombre` LIKE ? AND m.`area`=?
                    ORDER BY id DESC";
                $results=resultados_query($query,'si',$text,$area);
                echo "akljsdkl";
            } else {
                $query="SELECT m.`id`, m.`nombre`, `cedula`, `area`, `estatus`, `correo`,a.nombre as 'nombre_area',DATE_FORMAT(fecha_registro,'%d/%b/%Y') AS 'fecha_registro'
                    FROM `medicos` m
                    inner join soport16_chatdoc.areas a on m.area=a.id
                    WHERE m.`nombre` LIKE ?
                    ORDER BY id DESC";
                $results=resultados_query($query,'s',$text);
                echo("no");
            }
            $cant=mysqli_num_rows($results);
            if ($cant>=1) {
                $hilos = array();
                $hilos['cantidad']=$cant;
                while ($r=mysqli_fetch_array($results)) {
                    $hilos['registros'][$r['id']]= array(
                    'nombre' => $r['nombre']
                    ,'correo' => $r['correo']
                    ,'cedula' => $r['cedula']
                    ,'fecha' => $r['fecha_registro']
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

}
?>