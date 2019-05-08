<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class pacientesModel
{
  
  public function __construct()
  {
    //parent::__construct();
  }
  
  public function pacientes(){

  }
  public function paciente($paciente){
    $query="SELECT 
          p.clave_paciente,
          p.clave_estado_paciente,
          s.descripcion_estado_paciente as 'estatus',
          p.nombre_paciente,
          p.apellido_paterno_paciente,
          p.apellido_materno_paciente,
          p.fecha_nacimiento_paciente,

          p.direccion_paciente,
          p.colonia_paciente,
          p.entidad_federativa_paciente,
          p.municipio_paciente,
          p.cp_paciente,
          p.telefono_paciente,
          p.celular_paciente,
          p.correo_contacto_paciente,

          p.semanas_gestacion,
          p.sexo_paciente,
          p.peso_paciente,
          p.talla_paciente,
          p.fum,
          p.apgar_paciente,
          p.fecha_nacimiento_madre,

          p.codigo_paciente,
          p.instituto_procedencia_paciente,
          p.protocolo_paciente,
          p.fecha_registro,
          p.usuario_registro,
          p.fecha_ingreso_paciente,
          p.usuario_actualizacion,
          p.fecha_actualizacion,
          p.motivo_baja,
          
          p.nombre_padre_paciente,
          p.nombre_madre_paciente,
          p.escolaridad_materna,
          p.escolaridad_paterna,
          p.nivel_socioeconomico,
          p.ocupacion_materna,
          p.ocupacion_paterna,
          p.seguridad_social,
          p.numero_integrantes
          FROM agenda_citas.paciente p
          inner join agenda_citas.estado_paciente s on p.clave_estado_paciente=s.clave_estado_paciente 
          WHERE clave_paciente= ?;";
    $args=[$paciente];
    $results=resultados_pdo($query,$args)->fetchAll();
    return $results;
  }

  public static function pacienteLite($paciente){
    $query="SELECT 
          p.clave_paciente,
          p.clave_estado_paciente,
          s.descripcion_estado_paciente as 'estatus',
          p.nombre_paciente,
          p.apellido_paterno_paciente,
          p.apellido_materno_paciente,
          p.fecha_nacimiento_paciente,

          p.semanas_gestacion,
          p.sexo_paciente,
          p.peso_paciente,
          p.talla_paciente,
          p.fum,
          p.apgar_paciente,
          p.fecha_nacimiento_madre,
          p.codigo_paciente,
          p.instituto_procedencia_paciente,
          p.protocolo_paciente, 
          p.fecha_ingreso_paciente
          FROM agenda_citas.paciente p
          inner join agenda_citas.estado_paciente s on p.clave_estado_paciente=s.clave_estado_paciente 
          WHERE clave_paciente= ?;";
    $args=[$paciente];
    $results=resultados_pdo($query,$args)->fetchAll();
    return $results;
  }
  public function estudios_paciente($paciente){
    $query="
      SELECT 
      p.`id`, p.`comentarios`, p.`fecha` 
      ,e.nombre as 'nombre_estudio'
      ,a.area
      ,s.nombre as 'nombre_personal'
      FROM `neuroprueba`.`estudios_paciente` p
      INNER JOIN `neuroprueba`.estudios e ON p.`estudio`=e.id
      INNER JOIN `neuroprueba`.areas a on e.area=a.id
      INNER JOIN `neuroprueba`.personal s ON p.`registrador`=s.id
      where paciente=?;";
    $args=[$paciente];
    return resultados_pdo($query,$args)->fetchAll();
  }

  public function estudiosDisponibles($paciente){
    $query='SELECT e.`id`, e.`nombre`, a.area, e.`descripcion` FROM `estudios` e inner join areas a on e.area=a.id';
    return resultados_pdo($query,array())->fetchAll();
  }
}