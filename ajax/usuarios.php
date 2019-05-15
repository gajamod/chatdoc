<?php 
	define('BASEPATH', true);
	require '../system/config.php';
	require '../system/core/autoload.php';
	if (!function_exists('conectar')) {
	  require('../'.LIBS_ROUTE."BDBF.php");
	}
  	require 'ajaxautoload.php';


	$cpPermisos = array(
		'us' => 'n', 
		'op' => 'n',
		'val'=>'s',
		'per'=>'n'
	);
	$cpEstatus = array(
		'us' => 'n', 
		'op' => 'n',
		'val'=>'s',
		'act'=>'n'
	);
	$user=new usersModel();

	if (checkPost($cpEstatus,$_POST) and $_POST['op']==2 and $_POST['act']==1) {
		$us=$_POST['us'];
		if ($_POST['val']=='v') {
			$val=1;///
		}else{
			$val=0;
		}
		echo $user->cambiar_estatus($us,$val,$_SESSION['idE']);
	}elseif (checkPost($cpPermisos,$_POST) and $_POST['op']==3 and $_POST['per']==1) {
		$us=$_POST['us'];
		if ($_POST['val']=='v') {
			$val=1;//
		}else{
			$val=0;
		}
		echo $user->cambiar_permisos($us,$val,$_SESSION['idE']);
	}else{
		echo "-2";
	}
	
 ?>