<?php defined('BASEPATH') or exit('No se permite acceso directo'); 
	$this->title="Bienvenidos!";
	
	$texto=$this->params['texto'];
	$area=$this->params['area'];
	$resultados=$this->params['resultados'];
	mose("params",$resultados);
?>

<div class="card-deck p-3">

	<div class="card bg-secondary">
		<div class="card-body">
			<form class="form-inline" action="home/">
			  <div class="form-group mx-sm-3 mb-2">
			    <label for="namei" class="sr-only">Motivo</label>
			    <input type="text" class="form-control" id="namei" placeholder="Motivo" name="t" value="<?php echo isset($texto)? $texto:''  ?>">
			  </div>
			  <div class="form-group ">
		    	<label for="nEstudio">Area</label>
		    	<select class="form-control form-control-lg" name="estudio">
		    		<option>Todas</option>
				  <?php foreach ($estudiosDisponibles as $key => $disponible): ?>
				  	<option value="<?php echo $disponible['id']; ?>"><?php echo $disponible['nombre'].'| '.$disponible['area']; ?></option>
				  <?php endforeach ?>
				</select>
			</div>
			  <button type="submit" class="btn btn-primary mb-2">Buscar</button>
			</form>
		</div>
	</div>
	<!--
	<div class="card text-center">
		<div class="card-body">
	    <h5 class="card-title">Alta Neuropediatria</h5>
	    <p class="card-text">Para poder registrar al nuevo paciente complete el siguiente formulario.</p>
	    <a href="alta/" class="btn btn-primary">Alta</a>
	  </div>
	</div>
	<div class="card text-center">
		<div class="card-body">
	    <h5 class="card-title">Estadisticas Pacientes</h5>
	    <p class="card-text">Vea estadisticas de los Pacientes. </p>
	    <a href="estadisticas/" class="btn btn-primary">Estadisticas</a>
	  </div>
	</div>
	-->
</div>
		
		
		