<?php 

 define('BASEPATH', true);
  require '../system/config.php';
  require 'ajaxautoload.php';

  require('../'.LIBS_ROUTE.'funcionesproducto.php');
  require('../'.LIBS_ROUTE.'busqueda.class.php');
  
  $texto=$_POST['t'];
 
 
  if (isset($texto) and is_numeric($texto)) {
      $query="CALL BuscarNumBol(?)";
      imp_bol($query,"i",$texto);
  }elseif (isset($texto) and is_string($texto)) {
    //echo "qwerty";
    //echo "<br>";
    //echo $texto."<br>";
    $tempText=trim($texto);
    //echo $tempText."<br>";
    $tempText=str_replace(' ', '', $tempText);
    //echo $tempText."<br>";
    //echo $tempText."<br>";
    $tempText=strtoupper($tempText);
    $findme   = 'R';
    //echo "..".$tempText."..";
    $pos = strpos($tempText, $findme);
    //echo "--".$pos."--";
    // Nótese el uso de ===. Puesto que == simple no funcionará como se espera
    // porque la posición de 'a' está en el 1° (primer) caracter.
    if (!($pos === false)) {
      $parte=explode("R", $tempText);
      //echo "@".$parte[1]."@";
      //print_r($parte);
      //echo "@";
    }
    
    if (isset($parte) and count($parte)==2 and is_numeric($parte[1])) {
      //echo $parte[0];
      $query="CALL BuscarReservacion(?)";
      imp_bol($query,"i",$parte[1]);
    }else{
      //echo "string1234";
      $query="CALL BuscarNombre(?)";
      $texto="%".$texto."%";
      imp_bol($query,"s",$texto);
    }
  }

  
  
    
?>
    
    
    



 