<?php 
	define('BASEPATH', true);
	require '../system/config.php';
	require '../system/core/autoload.php';
	if (!function_exists('conectar')) {
	  require('../'.LIBS_ROUTE."BDBF.php");
	}
	require "../".PATH_MODELS ."loginModel.php";
	if (isset($_POST['us']) and isset($_POST['pw'])) {
		$login=new LoginModel();
		if ($login->verify($_POST['us'],$_POST['pw'])) {
			echo "1";
		}elseif (isset($_POST['user']) and isset($_POST['ue']) and !($login->existe_usuario($_POST['user']))) {
			echo "1";
		}else{
			echo "0";
		}
	}else{
		echo "-1";
	}
	
 ?>