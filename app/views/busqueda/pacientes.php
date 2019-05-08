<?php 
$filtros=$this->params['filtros'];
 ?>
<h1>Buscar Paciente</h1>

<div class="card bg-secondary">
	<div class="card-body">
		<form class="form-inline" action="busqueda/pacientes/">
		  <div class="form-group mx-sm-3 mb-2">
		    <label for="namei" class="sr-only">Nombre</label>
		    <input type="text" class="form-control" id="namei" placeholder="Nombre" name="na" value="<?php echo isset($filtros['na'])? $filtros['na']:''  ?>">
		  </div>
		  <div class="form-group mx-sm-3 mb-2">
		    <label for="Edr" class="sr-only">Edad en meses</label>
		    <input type="number" class="form-control" id="Edr" placeholder="Edad Meses Min" name="ei" value="<?php echo isset($filtros['ei'])? $filtros['ei']:''  ?>">
		    <input type="number" class="form-control" id="" placeholder="Edad Meses Max" name="ea" value="<?php echo isset($filtros['ea'])? $filtros['ea']:''  ?>">
		  </div>
		  <div class="form-group mx-sm-3 mb-2">
		    <label for="annac" class="sr-only">Año nacimiento</label>
		    <input type="number" class="form-control" id="annac" placeholder="Año nacimiento" name="an" value="<?php echo isset($filtros['an'])? $filtros['an']:''  ?>">
		  </div>
		  <div class="form-group mx-sm-3 mb-2">
		    <label for="annac" class="sr-only">Año registro</label>
		    <input type="number" class="form-control" id="annac" placeholder="Año registro" name="ar" value="<?php echo isset($filtros['ar'])? $filtros['ar']:''  ?>">
		  </div>
		  <button type="submit" class="btn btn-primary mb-2">Buscar</button>
		</form>
	</div>
</div>
		
<p>Resultados:<?php echo count($this->params['pacientes']); ?></p>
<div class="card text-center">
  <div class="card-body">
  	<div class="row">
  		<p class="card-text col-md-1">Clave Paciente</p>
  		<p class="card-text col-md-1">Estado</p>
  		<h5 class="card-title col-md-5">Nombre</h5>
  		<p class="card-text col-md-1">Fecha Nacimiento</p>
  		<p class="card-text col-md-1">Semanas Gestacion</p>
  		<p class="card-text col-md-1">Sexo</p>
	    <p class="card-text col-md-1">Opciones</p>
	</div>
  </div>
</div>
<?php foreach ($this->params['pacientes'] as $key => $paciente): ?>
	<div class="card text-center">
	  <div class="card-body">
	  	<div class="row">
	  		<p class="card-text col-md-1"><a href="pacientes/<?php echo $paciente['clave_paciente']; ?>"><?php echo $paciente['clave_paciente']; ?></a></p>
	  		<p class="card-text col-md-1"><?php echo $paciente['descripcion_estado_paciente']; ?></p>
	  		<h5 class="card-title col-md-5"><?php echo $paciente['nombre_paciente'].' '.$paciente['apellido_paterno_paciente'].' '.$paciente['apellido_materno_paciente']; ?></h5>
	  		<p class="card-text col-md-1"><?php echo $paciente['fecha_nacimiento_paciente']; ?></p>
	  		<p class="card-text col-md-1"><?php echo $paciente['semanas_gestacion']; ?></p>
	  		<p class="card-text col-md-1"><?php echo $paciente['sexo_paciente']; ?></p>
		    <a href="pacientes/<?php echo $paciente['clave_paciente']; ?>" class="btn btn-primary col-md-1">Ver</a>
		</div>
	  </div>
	</div>
<?php endforeach ?>