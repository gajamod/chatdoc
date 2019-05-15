<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/

class loginModel
{
  
  public function __construct()
  {
    //parent::__construct();
  }
  public function verify($user,$pass)
  {
    $usuario=htmlentities($user);
    $password_encriptado = self::encryptPass($pass);
    $queryVerificar="SELECT `id` FROM `pacientes` WHERE (`correo`= ?  AND `password`=?)";
    $results = resultados_query($queryVerificar,'ss',$usuario,$password_encriptado);
    $cant=mysqli_num_rows($results);
    if ( $cant== 1) {
      return true;
     }else{
      return false;
     }
  }
  public function signIn($user,$pass)
  {
    $usuario=htmlentities($user);
    $password_encriptado = self::encryptPass($pass);
    $queryVerificar="SELECT `id`,`nombre` FROM `pacientes` WHERE (`correo`= ?  AND `password`=?)";
    $results = resultados_query($queryVerificar,'ss',$usuario,$password_encriptado);
    $cant=mysqli_num_rows($results);
    if ($cant == 1) {
      $row=mysqli_fetch_array($results);
      $token=Session::generateToken();
      
      if (Session::startSession($row['id'],$row['nombre'],$token)){
        if (Session::is_session_started()) {
          return true;
        }else{
          return false;
        }
       }else
       {
        return false;
       }
     }else{
      return false;
     }
  }

  public static function encryptPass($pass){
    $password=htmlentities($pass);
    $salt = md5($password);
    $criptado=crypt($password, $salt);
    return $criptado;
  }

  public function existe_usuario($correo){
    $query='SELECT `id` FROM `pacientes` WHERE `correo`=?;' ;
    $results = resultados_query($query,"s",$correo);
    $cant=mysqli_num_rows($results);
    //mose("cant",$cant);
    if ( $cant>= 1 ) {
      return true;
    }else{
      return false;
    }
  }

  public function get_IDusuario($user){
    $query='SELECT `id` FROM `pacientes` WHERE `correo`=? limit 1;' ;
    $results = resultados_query($query,"s",$correo);
    $cant=mysqli_num_rows($results);
    //mose("cant",$cant);
    if ( $cant>= 1 ) {
      $row=mysqli_fetch_array($results);
      return $row['id'];
    }else{
      return false;
    }
  }

  public function restaurar_password($idUsuario,$tkn,$tokenR,$password){
    if ($this->recuperar_valido($tkn,$tokenR)) {
      $password=self::encryptPass($password);
      $tokenS=Session::generateToken();
      $tokenRN=Session::generateToken($idUsuario);
      $query="
        UPDATE `pacientes` 
        SET `password`=?,`token`=?,`tknPwd`=? 
        WHERE `fecha_tknPwd` IS NOT NULL and TIMESTAMPDIFF(HOUR,`fecha_tknPwd`,now())<=24 and (`token`=? and `tknPwd`=? ) and `id`=?;";
        $cant=afectados_query($query,'sssssi',$password,$tokenS,$tokenRN,$tkn,$tokenR,$idUsuario);
        if ($cant==1) {
          return true;
        } else {
          return false;
        }
        
    } else {
      return false;
    }
    
  }

  public function alta_usuario($nombre,$ap_paterno,$ap_materno,$fecha_nac,$sexo,$correo,$password){
    if(!($this->existe_usuario($correo))){
      $password=self::encryptPass($password);
      $query='INSERT INTO `pacientes`
      (`nombre`, `ap_paterno`, `ap_materno`, `fecha_nac`, `sexo`, `correo`, `password`) 
      VALUES (?,?,?,?,?,?,?)';
      $registrado=id_query($query,'ssssiss',$nombre,$ap_paterno,$ap_materno,$fecha_nac,$sexo,$correo,$password);
      return $registrado;
    }else{
      return -3;
    }
  }
  public function recuperar_valido($token,$tokenR){
    $query='SELECT `id`,  `usuario` FROM `personal` WHERE `fecha_tknPwd` IS NOT NULL and TIMESTAMPDIFF(HOUR,`fecha_tknPwd`,now())<=24 and `tknPwd`=? and `token`=?;' ;
    $results = resultados_pdo($query,'ss',$token,$tokenR);
    $cant=mysqli_num_rows($results);
    //mose("cant",$cant);
    if ( $cant>= 1 ) {
      return true;
    }else{
      return false;
    }
  }
  public function solicitud_recuperar($idUsuario){
      $tokenS=Session::generateToken();
      $tokenR=Session::generateToken($idUsuario);
      $query='UPDATE `pacientes` SET `token`=?,`tknPwd`=?,`fecha_tknPwd`=NOW() WHERE `id`=?';
      $afectados=afectados_query($query,'ssi',$tokenS,$tokenR,$idUsuario);
      $res['t']=$tokenS;
      $res['r']=$tokenR;
      $res['afectados']=$afectados;
      return $res;
  }
/**
  private function ver_usuarios(){
    $query='SELECT `id`, `nombre`, `usuario`, `admin`, `activo`,`fecha_registro` FROM `personal` WHERE 1';
    return resultados_pdo($query,array())->fetchAll();
  } */
}