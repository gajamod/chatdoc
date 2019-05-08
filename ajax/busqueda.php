<?php 
  define('BASEPATH', true);
  require '../system/config.php';
  require 'ajaxautoload.php';

  require('../'.LIBS_ROUTE.'funcionesproducto.php');
  require('../'.LIBS_ROUTE.'busqueda.class.php');

  $estatus=$_POST['c'];
  $reservacion=$_POST['t'];
  if (isset($_POST['e']) and is_numeric($_POST['e']) and $_POST['e']>0) {
    $IdEvento=$_POST['e'];
  }else{
    $IdEvento="";//main_event;
  }

  $buscar=new busqueda();

  $Empleado=NULL;
 
      mostrar_productos($buscar->buscarReservacion($IdEvento,$estatus,$reservacion));
    
 
      

  
  
    
?>
    
    
    



 