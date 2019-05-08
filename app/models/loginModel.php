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
    $queryVerificar="SELECT `id` FROM `personal` WHERE `usuario`= ?  AND `contrasena`=?";
    $args=[$usuario,$password_encriptado];
    $results = resultados_pdo($queryVerificar,$args);

    $cant=$results->rowCount();
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
    $queryVerificar="SELECT `id`,`nombre`,`admin` FROM `personal` WHERE (`usuario`= ?  AND `contrasena`=?) and `activo`=1";
    $args=[$usuario,$password_encriptado];
    $results = resultados_pdo($queryVerificar,$args);
    $cant=$results->rowCount();
    if ($cant == 1) {
      $row=$results->fetch();
      $token=Session::generateToken();
      
      if (Session::startSession($row['id'],$row['nombre'],($row['admin']==1)?true:false,$token)){
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

  public function existe_usuario($user){
    $query='SELECT `id` FROM `personal` WHERE `usuario`=? limit 1;' ;
    resultados_pdo($query,$user);
    $results = resultados_pdo($query,$user);
    $cant=$results->rowCount();
    //mose("cant",$cant);
    if ( $cant>= 1 ) {
      return true;
    }else{
      return false;
    }
  }

  public function get_IDusuario($user){
    $query='SELECT `id` FROM `personal` WHERE `usuario`=? limit 1;' ;
    resultados_pdo($query,$user);
    $results = resultados_pdo($query,$user);
    $cant=$results->rowCount();
    //mose("cant",$cant);
    if ( $cant>= 1 ) {
      $row=$results->fetch();
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
        UPDATE `personal` 
        SET `contrasena`=?,`token`=?,`tknPwd`=? 
        WHERE `fecha_tknPwd` IS NOT NULL and TIMESTAMPDIFF(HOUR,`fecha_tknPwd`,now())<=24 and (`token`=? and `tknPwd`=? ) and `id`=?;";
        $args=[$password,$tokenS,$tokenRN,$tkn,$tokenR,$idUsuario];
        $cant=afectados_pdo($query,$args);
        if ($cant==1) {
          return true;
        } else {
          return false;
        }
        
    } else {
      return false;
    }
    
  }

  public function alta_usuario($nombre,$usuario,$password,$activo=false,$admin=false){
    if(!($this->existe_usuario($usuario))){
      $password=self::encryptPass($password);
      $query='INSERT INTO `personal`
      (`nombre`, `usuario`, `contrasena`, `admin`, `activo`)
      VALUES 
      (?,?,?,?,?)';
      $args = [$nombre,$usuario,$password,$admin,$activo];
      $registrado=id_pdo($query,$args);
      return $registrado;
    }else{
      return -3;
    }
  }
  public function recuperar_valido($token,$tokenR){
    $query='SELECT `id`,  `usuario` FROM `personal` WHERE `fecha_tknPwd` IS NOT NULL and TIMESTAMPDIFF(HOUR,`fecha_tknPwd`,now())<=24 and `tknPwd`=? and `token`=?;' ;
    $args=[$tokenR,$token];
    $results = resultados_pdo($query,$args);
    $cant=$results->rowCount();
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
      $query='UPDATE `personal` SET `token`=?,`tknPwd`=?,`fecha_tknPwd`=NOW() WHERE `id`=?';
      $args=[$tokenS,$tokenR,$idUsuario];
      $afectados=afectados_pdo($query,$args);
      $res['t']=$tokenS;
      $res['r']=$tokenR;
      $res['afectados']=$afectados;
      return $res;
  }

  public function ver_usuarios(){
    $query='SELECT `id`, `nombre`, `usuario`, `admin`, `activo`,`fecha_registro` FROM `personal` WHERE 1';
    return resultados_pdo($query,array())->fetchAll();
  }
}