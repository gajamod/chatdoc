<?php 
 define('BASEPATH', true);
  require '../system/config.php';
  require 'ajaxautoload.php';
 $buscar = array('i' => 'n', );
  if (Session::valid_session() and checkPost($buscar,$_POST)) {
  	
  }


 ?>