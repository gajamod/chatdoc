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
	function mose($titulo,$valor="NoSETqwerty"){
		if ($valor=="NoSETqwerty") {
			$valor=$titulo;
			$titulo="dunno";
		}
		
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
	function conectar(){
			$servidor=DB_SERVER;
			$user=DB_USERNAME;
			$pass=DB_PASSWORD;
			$bd=DB_DATABASE;
			$charset=APPCHARSET;
			$dsn = "mysql:host=$servidor;dbname=$bd;charset=$charset";
			$options = [
			    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			    PDO::ATTR_EMULATE_PREPARES   => false,
			];
			try {
			     $pdo = new PDO($dsn, $user, $pass, $options);
			     return $pdo;
			} catch (\PDOException $e) {
			     throw new \PDOException($e->getMessage(), (int)$e->getCode());
			}
			return false;
	}

	function resultados_pdo($queryB,$args){
	  	$conexion=conectar();
	  	if (!$conexion) {
	      echo "Error: No se pudo conectar a la base de datos." . PHP_EOL;
	    }
	    $stmt = $conexion->prepare($queryB);
	    if (!(is_array($args))) {
	    	$args=[$args];
	    }
        $stmt->execute($args);
	  	return $stmt;
	}

	function id_pdo($queryB,$args){
	  	$conexion=conectar();
	  	if (!$conexion) {
	      echo "Error: No se pudo conectar a la base de datos." . PHP_EOL;
	    }
	    $stmt = $conexion->prepare($queryB);
	    if (!(is_array($args))) {
	    	$args=[$args];
	    }
        $stmt->execute($args);
	  	return $conexion->lastInsertId(); ;
	}

	function afectados_pdo($queryB,$args){
	  	$stmt=resultados_pdo($queryB,$args);
	  	return$stmt->rowCount();

	}

	function fila_pdo($queryB,$args){
		$resultados=resultados_pdo($queryB,$args);
		return $resultados->fetch();
	}

 ?>