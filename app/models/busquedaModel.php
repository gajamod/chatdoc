<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class busquedaModel
{
  
  public function __construct()
  {
    //parent::__construct();
  }
  
  public function pacientes($params){
    $args= array();

    $q1="";
    $q2="";
    $q3="";
    $q4="";

    
    if (isset($params['ar'])) {
      //año de registro
      $args[]=$params['ar'];
      $q1=" YEAR(fecha_registro)= ? and ";
    }

    if (isset($params['ei']) and isset($params['ea']) and is_numeric($params['ea']) and is_numeric($params['ei'])) {
      // rango
      $args[]=$params['ei'];
      $args[]=$params['ea'];
      $q2=" TIMESTAMPDIFF(MONTH,fecha_nacimiento_paciente,CURDATE())>= ? and TIMESTAMPDIFF(MONTH,fecha_nacimiento_paciente,CURDATE())<= ? and";
    }

    if (isset($params['an']) and is_numeric($params['an'])) {
      //año de nacimiento
      $args[]=$params['an'];
      $q3=" YEAR(fecha_nacimiento_paciente)= ? and ";
    }
    if (isset($params['na']) and !(empty($params['na']))) {
      //nombre
      $args[]='%'.$params['na'].'%';
      $q4=" concat( `nombre_paciente`,' ', `apellido_paterno_paciente`,' ',`apellido_materno_paciente`) like ? and ";
      
    }

    $query='SELECT p.`clave_paciente`, p.`clave_estado_paciente`,e.`descripcion_estado_paciente`, p.`nombre_paciente`, `apellido_paterno_paciente`,p.`apellido_materno_paciente`, p.`fecha_nacimiento_paciente`, p.`semanas_gestacion`, p.`sexo_paciente`, p.`fecha_registro`  
      FROM agenda_citas.`paciente` p
      INNER JOIN agenda_citas.estado_paciente e on p.`clave_estado_paciente`=e.`clave_estado_paciente` WHERE '.$q1.$q2.$q3.$q4.' 1';
    return resultados_pdo($query,$args)->fetchAll();
  }

  public function estudios($params){
    $query='SELECT e.`id`, e.`nombre`, a.area, e.`descripcion` FROM `estudios` e inner join areas a on e.area=a.id';
    return resultados_pdo($query,array())->fetchAll();
  }
}