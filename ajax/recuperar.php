<?php
	define('BASEPATH', true);
	require '../system/config.php';
	require '../system/core/autoload.php';
	if (!function_exists('conectar')) {
	  require('../'.LIBS_ROUTE."BDBF.php");
	}
  	require 'ajaxautoload.php';
  	$login=new loginModel();
  	$cpValido = array(
		't' => 's', 
		'c' => 's'
	);
	$cpRecuperar = array(
		'us' => 'n'
	);

	if (checkPost($cpRecuperar,$_POST) and Session::requiere_sesion()) {
		$respuesta=$login->solicitud_recuperar($_POST['us']);
		if ($respuesta['afectados']==1) {
			$enlace=BASE_URL."login/recuperar/?c=".$respuesta['r']."&t=".$respuesta['t'];
			echo $enlace;
		} else {
			echo '0';
		}
		
		
	} elseif (checkPost($cpValido,$_POST)) {
		$us=$_POST['us'];
		if ($login->recuperar_valido($_POST['t'],$_POST['c'])) {
			echo '1';
		}else{
			echo '0';
		}
	}else{
		echo "-2";
	}