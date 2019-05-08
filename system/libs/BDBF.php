<?php 

	function checkPost($buscar,$en){
		if (is_array($buscar) and is_array($en)) {
			foreach ($buscar as $key => $value) {
				if (isset($en[$key])) {
					$value=trim($value);
					switch ($value) {
					    case "a":
					        if (!(is_array($en[$key]))) {
					        	return false;
					        }
					        break;
					    case "s":
					        if (!(is_string($en[$key]))) {
					        	return false;
					        }
					        break;
					    case "n":
					        if (!(is_numeric($en[$key]))) {
					        	return false;
					        }
					        break;
					}
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
		return true;
	}
	function mose($titulo,$valor="valor PRUEBA no ingresado"){
		if (ENDESARROLLO) {
			if (is_array($valor)) {
				echo "<h5> ----<b> ".$titulo." </b>---- </h5>";
				print_r($valor);
				echo "<h5> ---fin de ".$titulo."--- </h5>";
			}else{
				echo "<h4> ".$titulo." : ".$valor."</h4>";
			}
			
		}
		
	}

	function eraq(){
		mose("ERROR AQUI","Archivo: ".__FILE__." :".__LINE__);
	}
	function conectar(){
			$servidor=DB_SERVER;
			$user=DB_USERNAME;
			$pass=DB_PASSWORD;
			$bd=DB_DATABASE;

			$conexion = new mysqli($servidor, $user, $pass, $bd);
			return $conexion;
	}


	function resultados_query($queryB,$types,$var1=null,$var2=null,$var3=null,$var4=null,$var5=null,$var6=null,$var7=null,$var8=null,$var9=null,$var10=null,$var11=null,$var12=null,$var13=null,$var14=null,$var15=null){
		$types=trim($types);
	  	$conexion=conectar();
	  if (!$conexion) {
	      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	      echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	      echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    }
	    

	    $conexion->set_charset('utf8');
	    $var1=$conexion->real_escape_string($var1);
	    $var2=$conexion->real_escape_string($var2);
	    $var3=$conexion->real_escape_string($var3);
	    $var5=$conexion->real_escape_string($var5);
	    $var6=$conexion->real_escape_string($var6);
	    $var7=$conexion->real_escape_string($var7);
	    $var8=$conexion->real_escape_string($var8);
	    $var9=$conexion->real_escape_string($var9);
	    $var10=$conexion->real_escape_string($var10);
	    $var11=$conexion->real_escape_string($var11);
	    $var13=$conexion->real_escape_string($var13);
	    $var14=$conexion->real_escape_string($var14);
	    $var15=$conexion->real_escape_string($var15);
	    $var4=$conexion->real_escape_string($var4);
	    $var12=$conexion->real_escape_string($var12);
	    //echo $query;

	    //echo strlen($types)."\n";
	    //echo strlen($types)."\n";
	    $nuevaConsulta = $conexion->stmt_init();
	  if ($nuevaConsulta -> prepare($queryB)) {
	  	switch (strlen($types)) {
	  		case 1:
	  			//echo "<br>S<br>";
	  			$nuevaConsulta->bind_param($types,$var1);
	  			//echo "<br>E<br>";
			    /*echo $var1;
			    echo "<br>";
			    echo $queryB;
			    */
	  			break;
	  		case 2:
	  			$nuevaConsulta->bind_param($types,$var1,$var2);
	  			break;
	  		case 3:
	  			//echo "<br>S<br>";
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3);
	  			//echo "<br>E<br>";
			    /*echo $var1;
			    echo "<br>";
			    echo $queryB;
			    */
	  			break;
	  		case 4:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4);
	  			break;
	  		case 5:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5);
	  			break;
	  		case 6:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6);
	  			break;
	  		case 7:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7);
	  			break;
	  		case 8:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8);
	  			break;
	  		case 9:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9);
	  			break;
	  		case 10:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10);
	  			break;
	  		case 11:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11);
	  			break;
	  		case 12:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12);
	  			break;
	  		case 13:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13);
	  			break;
	  		case 14:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14);
	  			break;
	  		case 15:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14,$var15);
	  			break;
	  		default:
	  			//$nuevaConsulta->bind_param($types,$var1);
	  			break;
	  	}
	  	
	  	$nuevaConsulta->execute();
	  	/*printf("Error: %d.\n", $nuevaConsulta->errno);
	  	printf("Error: %d.\n", $nuevaConsulta->error);
	  	echo "Error:\n";
    	print_r($nuevaConsulta->error_list);*/
	  	$resultados=$nuevaConsulta->get_result();
	  }
	  return $resultados;

	}


	function id_query($queryB,$types,$var1=null,$var2=null,$var3=null,$var4=null,$var5=null,$var6=null,$var7=null,$var8=null,$var9=null,$var10=null,$var11=null,$var12=null,$var13=null,$var14=null,$var15=null){
		$types=trim($types);
	  	$conexion=conectar();
	  if (!$conexion) {
	      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	      echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	      echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    }
	    

	    $conexion->set_charset('utf8');
	    $var1=$conexion->real_escape_string($var1);
	    $var2=$conexion->real_escape_string($var2);
	    $var3=$conexion->real_escape_string($var3);
	    $var5=$conexion->real_escape_string($var5);
	    $var6=$conexion->real_escape_string($var6);
	    $var7=$conexion->real_escape_string($var7);
	    $var8=$conexion->real_escape_string($var8);
	    $var9=$conexion->real_escape_string($var9);
	    $var10=$conexion->real_escape_string($var10);
	    $var11=$conexion->real_escape_string($var11);
	    $var13=$conexion->real_escape_string($var13);
	    $var14=$conexion->real_escape_string($var14);
	    $var15=$conexion->real_escape_string($var15);
	    $var4=$conexion->real_escape_string($var4);
	    $var12=$conexion->real_escape_string($var12);
	    //echo $query;

	    //echo strlen($types)."\n";
	    //echo strlen($types)."\n";
	  if ($nuevaConsulta= $conexion -> prepare($queryB)) {
	  	switch (strlen($types)) {
	  		case 1:
	  			$nuevaConsulta->bind_param($types,$var1);
	  			break;
	  		case 2:
	  			$nuevaConsulta->bind_param($types,$var1,$var2);
	  			break;
	  		case 3:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3);
	  			break;
	  		case 4:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4);
	  			break;
	  		case 5:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5);
	  			break;
	  		case 6:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6);
	  			break;
	  		case 7:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7);
	  			break;
	  		case 8:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8);
	  			break;
	  		case 9:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9);
	  			break;
	  		case 10:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10);
	  			break;
	  		case 11:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11);
	  			break;
	  		case 12:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12);
	  			break;
	  		case 13:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13);
	  			break;
	  		case 14:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14);
	  			break;
	  		case 15:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14,$var15);
	  			break;
	  		default:
	  			//$nuevaConsulta->bind_param($types,$var1);
	  			break;
	  	}
	  	
	  	$nuevaConsulta->execute();

	  	$resultados=$nuevaConsulta->get_result();
	  }
	  return mysqli_insert_id($conexion);

	}




	function afectados_query($queryB,$types,$var1=null,$var2=null,$var3=null,$var4=null,$var5=null,$var6=null,$var7=null,$var8=null,$var9=null,$var10=null,$var11=null,$var12=null,$var13=null,$var14=null,$var15=null){
		$types=trim($types);
	  	$conexion=conectar();
	  if (!$conexion) {
	      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	      echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	      echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    }
	    

	    $conexion->set_charset('utf8');
	    $var1=$conexion->real_escape_string($var1);
	    $var2=$conexion->real_escape_string($var2);
	    $var3=$conexion->real_escape_string($var3);
	    $var5=$conexion->real_escape_string($var5);
	    $var6=$conexion->real_escape_string($var6);
	    $var7=$conexion->real_escape_string($var7);
	    $var8=$conexion->real_escape_string($var8);
	    $var9=$conexion->real_escape_string($var9);
	    $var10=$conexion->real_escape_string($var10);
	    $var11=$conexion->real_escape_string($var11);
	    $var13=$conexion->real_escape_string($var13);
	    $var14=$conexion->real_escape_string($var14);
	    $var15=$conexion->real_escape_string($var15);
	    $var4=$conexion->real_escape_string($var4);
	    $var12=$conexion->real_escape_string($var12);
	    //echo $query;

	    //echo strlen($types)."\n";
	    //echo strlen($types)."\n";
	  if ($nuevaConsulta= $conexion -> prepare($queryB)) {
	  	switch (strlen($types)) {
	  		case 1:
	  			$nuevaConsulta->bind_param($types,$var1);
	  			break;
	  		case 2:
	  			$nuevaConsulta->bind_param($types,$var1,$var2);
	  			break;
	  		case 3:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3);
	  			break;
	  		case 4:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4);
	  			break;
	  		case 5:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5);
	  			break;
	  		case 6:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6);
	  			break;
	  		case 7:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7);
	  			break;
	  		case 8:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8);
	  			break;
	  		case 9:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9);
	  			break;
	  		case 10:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10);
	  			break;
	  		case 11:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11);
	  			break;
	  		case 12:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12);
	  			break;
	  		case 13:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13);
	  			break;
	  		case 14:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14);
	  			break;
	  		case 15:
	  			$nuevaConsulta->bind_param($types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14,$var15);
	  			break;
	  		default:
	  			//$nuevaConsulta->bind_param($types,$var1);
	  			break;
	  	}
	  	
	  	$nuevaConsulta->execute();
	  	/*printf("Error: %d.\n", $nuevaConsulta->errno);
	  	printf("Error: %d.\n", $nuevaConsulta->error);
	  	echo "Error:\n";
    	print_r($nuevaConsulta->error_list);
	  	$resultados=$nuevaConsulta->get_result();*/
	  }
	 return $conexion->affected_rows;

	}


	function datos_fila($queryB,$types,$var1=null,$var2=null,$var3=null,$var4=null,$var5=null,$var6=null,$var7=null,$var8=null,$var9=null,$var10=null,$var11=null,$var12=null,$var13=null,$var14=null,$var15=null){

		$resultados=resultados_query($queryB,$types,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10,$var11,$var12,$var13,$var14,$var15);

	    if(mysqli_num_rows($resultados)==1){
	      
	      while ($r=mysqli_fetch_array($resultados)) {
	        return $r;
	      }
	      
	    }
	    else{
	      return null;
	      
	    }

	}

 ?>