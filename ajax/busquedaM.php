<?php 

  require('../'.LIBS_ROUTE.'funcionesproducto.php');
  require('../'.LIBS_ROUTE.'busqueda.class.php');
  $estatus=$_POST['c'];
  $reservacion=$_POST['t'];
 // $IdEvento=$_POST['e'];

      $buscar=new busqueda();
      mostrar_modificacion($buscar->buscarReservacion("",$estatus,$reservacion));  
?>
    
    
    



 Plastim5643