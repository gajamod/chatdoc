<?php defined('BASEPATH') or exit('No se permite acceso directo'); 
	$this->title="Paciente | Neurodesarrollo";
	function  __($text){
		return empty($text) ? '----':$text;
	}
	if (!(empty($this->params['datos'][0])) and is_array($this->params['datos'][0])) {
		$datos=$this->params['datos'][0];
		$estudios=$this->params['estudios'];
		$estudiosDisponibles=$this->params['estudiosDisponibles'];
		$direccion_p=$datos['direccion_paciente']." Col. ".$datos['colonia_paciente']." C. P. ".$datos['cp_paciente']." ".$datos['municipio_paciente'].", ".$datos['entidad_federativa_paciente'];
		$direccion_p=ucwords(strtolower($direccion_p));
		?>
		<div class="card">
			<div class="card-body">
			    <h5 class="card-title">Clave Paciente: <?php echo $datos['clave_paciente']; ?></h5>
			    <h6 class="card-subtitle mb-2 text-muted">Codigo: <?php echo __($datos['codigo_paciente']); ?></h6>
			    <div class="table-responsive">
			    	<table class="table">
				    	<tr>
				    		<th colspan="2">Nombre completo: <strong><?php echo $datos['nombre_paciente'].' '.$datos['apellido_paterno_paciente'].' '.$datos['apellido_materno_paciente']; ?></strong></th>
				    		<th>Sexo:</th>
				    		<td><?php echo __($datos['sexo_paciente']); ?></td>
				    		<th>Apgar:</th>
				    		<td><?php echo __($datos['apgar_paciente']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Fecha de Nacimiento:</th>
				    		<td><?php echo __($datos['fecha_nacimiento_paciente']); ?></td>
				    		<th>Semanas de gestacion:</th>
				    		<td><?php echo __($datos['semanas_gestacion']); ?></td>
				    		<th>FUM:</th>
				    		<td><?php echo __($datos['fum']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Peso:</th>
				    		<td><?php echo __($datos['peso_paciente']); ?></td>
				    		<th>Talla:</th>
				    		<td><?php echo __($datos['talla_paciente']); ?></td>
				    		<th>Fecha Nacimiento de la Madre:</th>
				    		<td><?php echo __($datos['fecha_nacimiento_madre']); ?></td>
				    	</tr>
				    </table>
			    </div>
			    <!--<a href="#" class="card-link">Card link</a>
			    <a href="#" class="card-link">Another link</a>-->
			 </div>
			 <div class="card-footer text-muted">
			    <p>
				  <a class="btn btn-primary" data-toggle="collapse" href="#collapseFormN" role="button" aria-expanded="false" aria-controls="collapseFormN">
				    Nuevo Estudio
				  </a>
				  <a class="btn btn-primary" data-toggle="collapse" href="#collapseFormET" role="button" aria-expanded="false" aria-controls="collapseFormET">
				    Estudios Tomados
				  </a>
				</p>
			 </div>
			 
			<div class="collapse" id="collapseFormN">
			  <div class="card card-body">
			    <form action="estudios/tomar/" method="POST" name="CNEstudio">
					<div class="form-group">
				    	<label for="nEstudio">Nombre Estudio</label>
				    	<select class="form-control form-control-lg" name="estudio">
						  <?php foreach ($estudiosDisponibles as $key => $disponible): ?>
						  	<option value="<?php echo $disponible['id']; ?>"><?php echo $disponible['nombre'].'| '.$disponible['area']; ?></option>
						  <?php endforeach ?>
						</select>
					</div>
					<input type="hidden" name="tkn" value="<?php echo $datos['clave_paciente'].md5(time()); ?>">
					<input type="hidden" name="paciente" value="<?php echo $datos['clave_paciente']; ?>">
					<input type="button" onclick="pregunta()" class="btn btn-primary" value="Tomar Estudio">
				</form>
			  </div>
			</div>
			<div class="collapse" id="collapseFormET">
			  <div class="card card-body table-responsive">
			    <?php if (count($estudios)>=1): ?>
			    	<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Estudio</th>
					      <th scope="col">Area</th>
					      <th scope="col">Comentarios</th>
					      <th scope="col">Fecha</th>
					      <th scope="col">Registrado por</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php foreach ($estudios as $key => $record): ?>
					  		<tr>
						      <th scope="row"><a href="estudios/registrado/<?php echo $record['id']; ?>" class="btn btn-link"><?php echo $record['id']; ?></a></th>
						      <td><?php echo $record['nombre_estudio']; ?></td>
						      <td><?php echo $record['area']; ?></td>
						      <td><?php echo $record['comentarios']; ?></td>
						      <td><?php echo $record['fecha']; ?></td>
						      <td><?php echo $record['nombre_personal']; ?></td>
						      <td><a href="estudios/registrado/<?php echo $record['id']; ?>" class="btn btn-primary">Ver</a></td>
						    </tr>
					  	<?php endforeach ?>
					  </tbody>
					</table>
			    <?php else: ?>
			    	<h2>Aun no ha registrado ningun estudio</h2>
			    <?php endif ?>
			  </div>
			</div>
		</div>
		
		<div id="accordion">
		  <div class="card">
		    <div class="card-header" id="Cprotocolo">
		      <h5 class="mb-0">
		        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Datos Protocolo
		        </button>
		      </h5>
		    </div>
		    <div id="collapseOne" class="collapse show" aria-labelledby="Cprotocolo" data-parent="#accordion">
		      <div class="card-body">
			    <!--<h5 class="card-title">Datos Protocolo</h5>-->
			    <div class="table-responsive">
			    	<table class="table">
				    	<tr>
				    		<th>Estatus:</th>
				    		<td><?php echo __($datos['estatus']); ?></td>
				    		<th>Protocolo:</th>
				    		<td><?php echo __($datos['protocolo_paciente']); ?></td>
				    		<th>Instituto procedencia:</th>
				    		<td><?php echo __($datos['instituto_procedencia_paciente']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Fecha ingreso:</th>
				    		<td><?php echo __($datos['fecha_ingreso_paciente']); ?></td>
				    		<th>Usuario Registro:</th>
				    		<td><?php echo __($datos['usuario_registro']); ?></td>
				    		<th>Fecha registro:</th>
				    		<td><?php echo __($datos['fecha_registro']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Fecha Actualizacion:</th>
				    		<td><?php echo __($datos['fecha_actualizacion']); ?></td>
				    		<th>Usuario Actualizacion:</th>
				    		<td><?php echo __($datos['usuario_actualizacion']); ?></td>
				    		<th>Motivo baja:</th>
				    		<td><?php echo __($datos['motivo_baja']); ?></td>
				    	</tr>
				    </table>
			    </div>
			    <!--<a href="#" class="card-link">Card link</a>
			    <a href="#" class="card-link">Another link</a>-->
			 </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="Ccontacto">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Datos de contacto
		        </button>
		      </h5>
		    </div>
		    <div id="collapseTwo" class="collapse" aria-labelledby="Ccontacto" data-parent="#accordion">
		      <div class="card-body">
		        <!--<h5 class="card-title">Datos de contacto</h5>-->
			    <div class="table-responsive">
			    	<table class="table">
			    		<tr>
				    		<th>Telefono:</th>
				    		<td><?php echo __($datos['telefono_paciente']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Celular:</th>
				    		<td><?php echo __($datos['celular_paciente']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Correo:</th>
				    		<td><?php echo __($datos['correo_contacto_paciente']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Direccion:</th>
				    		<td><?php echo __($direccion_p); ?></td>
				    	</tr>
				    </table>
			    </div>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingThree">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          Datos de Familiares
		        </button>
		      </h5>
		    </div>
		    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
		      <div class="card-body">
		        <!--<h5 class="card-title">Datos Familiares</h5>-->
			    <div class="table-responsive">
			    	<table class="table">
				    	<tr>
				    		<th>Nombre Madre:</th>
				    		<td><?php echo __($datos['nombre_madre_paciente']); ?></td>
				    		<th>Nombre Padre:</th>
				    		<td><?php echo __($datos['nombre_padre_paciente']); ?></td>
				    		<th>Seguridad Social:</th>
				    		<td><?php echo __($datos['seguridad_social']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Escolaridad Materna:</th>
				    		<td><?php echo $datos['escolaridad_materna']; ?></td>
				    		<th>Escolaridad Paterna:</th>
				    		<td><?php echo __($datos['escolaridad_paterna']); ?></td>
				    		<th>Integrantes:</th>
				    		<td><?php echo __($datos['numero_integrantes']); ?></td>
				    	</tr>
				    	<tr>
				    		<th>Ocupacion Materna:</th>
				    		<td><?php echo __($datos['ocupacion_materna']); ?></td>
				    		<th>Ocupacion Paterna:</th>
				    		<td><?php echo __($datos['ocupacion_paterna']); ?></td>
				    		<th>Nivel Socioeconomico:</th>
				    		<td><?php echo __($datos['nivel_socioeconomico']); ?></td>
				    	</tr>
				    </table>
			    </div>
		      </div>
		    </div>
		  </div>
		</div>
		<?php
		mose($estudiosDisponibles);
	}else{
		?>
		<h1>No se ha encontrado al paciente</h1>
		<?php
	}
?>
<script language="JavaScript"> 
function pregunta(){ 
    if (confirm('¿Estas seguro de enviar este formulario?')){ 
       document.CNEstudio.submit() 
    } 
} 
</script>
