<?php defined('BASEPATH') or exit('No se permite acceso directo'); 


class Session
{
  	
	public static function activar_session(){
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
	}

	public static function is_session_started(){
		
	    if ( php_sapi_name() !== 'cli' ) {
	        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
	            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
	        } else {
	            return session_id() === '' ? FALSE : TRUE;
	        }
	    }/*
	    if (isset($_SESSION['token']) and $_SESSION['token']!= NULL) {
	    	return true;	    }
	    return FALSE;*/
	}

	public static function closeSession(){
		if (self::is_session_started()) {
		 	session_destroy();
		 } 
		
	}

	public static function generateToken($cad=""){
		return md5(time()+$cad);
	}

	public static function startSession($idU,$apodo,$admin,$token){
		if (self::is_session_started()) {
		 	self::closeSession();
		 } 
		session_start([
		    'cookie_lifetime' => 14400
		    //'read_and_close'  => true,
		]);
		$_SESSION['idE']=$idU;
		$_SESSION['apodo']=$apodo;
		$_SESSION['admin']=$admin;
		$_SESSION['tokenE']=$token;
		$queryRegistrar="UPDATE `personal` SET `token`=? WHERE `id`=?;";
		$args=[$_SESSION['tokenE'],$_SESSION['idE']];
		$resultados=afectados_pdo($queryRegistrar,$args);
		//
		if ($resultados==1) {
			return self::valid_session();
		}else{
			closeSession();
			return false;
		}
		closeSession();
		return false;
		
	}

	public static function valid_session(){
		if (self::is_session_started()) {
			if (isset($_SESSION['idE']) and isset($_SESSION['tokenE']) and  isset($_SESSION['apodo'])) {
				$id=$_SESSION['idE'];
				$token=$_SESSION['tokenE'];
				$apodo=$_SESSION['apodo'];
				$queryVerificar="SELECT `id` FROM `personal` WHERE `id`=? and `token`=? and `activo`=1;";
				$args=[$id,$token];
				$results = resultados_pdo($queryVerificar,$args);
				$cant=$results->rowCount();
				if ($cant == 1) {
					return true;
				}else{
				return false;
				}
			}else{
				return false;
			}
			
		}
		else
		{
			return false;
		}
	}

	public static function encriptar(){

	}

	public static function tipo_usuario(){
		return "eMp";
	}

	public static function redireccionarLogin(){
		if ('http://'.URI!=LOGIN_URL) {
			//echo(URI);
			//echo("<br>".LOGIN_URL);
			header("location:".LOGIN_URL);
			return false;
		} else {
			return true;
		}		
		//
	}
	public static function requiere_sesion($sesion=true,$permisos=true,$redireccionar=true){
		if ($permisos) {
			$usuario=new usersModel();
			if (self::valid_session()) {
				if ($usuario->tiene_permiso($_SESSION['idE'])) {
					return true;
				} else {
					return false;
				}
			 } else {
			 	if ($redireccionar) {
			 		return self::redireccionarLogin();
			 	} else {
			 		return false;
			 	}
			 	
			 }
			
		}elseif ($sesion) {
			if (self::valid_session()) {
			 	return true;
			 } else {
			 	if ($redireccionar) {
			 		return self::redireccionarLogin();
			 	} else {
			 		return false;
			 	}
			 	
			 }
			  
		}else{
			return true;
		}
		
	}

}
 ?>