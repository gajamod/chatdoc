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
		return md5(time().$cad);
	}

	public static function startSession($idU,$apodo,$token){
		if (self::is_session_started()) {
		 	self::closeSession();
		 } 
		session_start([
		    'cookie_lifetime' => 14400
		    //'read_and_close'  => true,
		]);
		$_SESSION['id']=$idU;
		$_SESSION['apodo']=$apodo;
		$_SESSION['token']=$token;
		$queryRegistrar="UPDATE `pacientes` SET `token`=? WHERE `id`=?";
		$resultados=afectados_query($queryRegistrar,'si',$_SESSION['token'],$_SESSION['id']);
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
			if (isset($_SESSION['id']) and isset($_SESSION['token']) and  isset($_SESSION['apodo'])) {
				$id=$_SESSION['id'];
				$token=$_SESSION['token'];
				$apodo=$_SESSION['apodo'];
				$queryVerificar="SELECT `id` FROM `pacientes` WHERE `id`=? and token=?;";
				$results = resultados_query($queryVerificar,'is',$id,$token);
				$cant=mysqli_num_rows($results);
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

	//sin permisos
	public static function requiere_sesion($sesion=true,$redireccionar=true){
		if ($sesion) {
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

	/* //con permisos
	public static function requiere_sesion($sesion=true,$permisos=true,$redireccionar=true){
		if ($permisos) {
			$usuario=new usersModel();
			if (self::valid_session()) {
				if ($usuario->tiene_permiso($_SESSION['id'])) {
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
	*/

}
 ?>