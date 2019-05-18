<?php 
/**
* 
*/

class TurnosModel //extends Model
{
  
  public function __construct()
  {
    //parent::__construct();
  }
  public static function abrir($user,$inicial)
  {
    if (self::turnoabierto($user)) {
      return false;
    }else{
      $query="INSERT INTO `turnos`( `Empleado`, `SaldoInicial`) VALUES (?,?);";
      return id_query($query,'id',$user,$inicial);
    }
    
  }
  public static function corte($turno,$efectivo,$tarjeta,$depositos,$dolares,$comentarios)
  {
    //falta agregar la persona que recibe
    //falta validar si el turno es valido en tiempo y formato
    $query="INSERT INTO `Cortes`(`turno`, `Efectivo`, `Tarjeta`, `Depositos`, `Dolares`, `Recibe`,Comentarios) VALUES (?,?,?,?,?,?,?);";
    $idc=id_query($query,'iddddis',$turno,$efectivo,$tarjeta,$depositos,$dolares,0,$comentarios);
    mose('id corte',$idc);
    return $idc;

  }
  public static function cerrar($turno,$efectivo,$tarjeta,$depositos,$dolares,$comentarios)
  {
    //guardar ultimo corte
    $idc=self::corte($turno,$efectivo,$tarjeta,$depositos,$dolares,$comentarios);
    $query="SELECT SUM(`Efectivo`) as 'efectivo',SUM(`Tarjeta`) as 'tarjeta',SUM(`Depositos`) as 'depositos',SUM(`Dolares`) as 'dolares' FROM `Cortes` WHERE `turno`=?";
    $r=datos_fila($query,'i',$turno);
    $query="UPDATE `turnos` SET `Cierre`=NOW(),`EfectivoReal`=?,`PagoTarjeta`=?,`Depositos`=?,`Dolares`=? WHERE `id`=?";
    $aff=afectados_query($query,'ddddi',$r['efectivo'],$r['tarjeta'],$r['depositos'],$r['dolares'],$turno);
    if ($aff>0) {
      $_SESSION['Eturno']=false;
      unset($_SESSION['Eturno']);
      return $aff;
    }else{
      return false;
    }
    //sumar y actualizar datos finales turno;
  }
  public static function turnoabierto($user)
  {
    $query="SELECT `id` FROM `turnos` WHERE `Cierre`IS NULL AND `Empleado`=? LIMIT 1;";
    $resultados = resultados_query($query,"i",$user);
    $results=mysqli_num_rows($resultados);
    if ($results == 1) {
      while ($r=mysqli_fetch_array($resultados)) {
        $_SESSION['Eturno']=$r['id'];
        return true;
      }
      return false;
    }else{    
    return false;
    }
  }

  public static function datosturno($turno)
  {
    $query="SELECT `id`,`SaldoInicial` as 'inicial',`Abre` as 'abierto' FROM `turnos` WHERE `id`= ? AND `Empleado`=?;";
    $resultados = resultados_query($query,"ii",$turno,$_SESSION['idE']);
    $results=mysqli_num_rows($resultados);
    if ($results == 1) {
      while ($r=mysqli_fetch_array($resultados)) {
        return $r;
      }
      return false;
    }else{
    
    return false;
    }
  }
}