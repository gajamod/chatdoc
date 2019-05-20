<?php defined('BASEPATH') or exit('No se permite acceso directo'); 
	$this->title="Bienvenidos!";
	//mose("params",$this->params);
	$texto=$this->params['texto'];
	$areaSelected=$this->params['area'];
	$resultados=$this->params['resultados'];
	$dareas=$this->params['dareas'];

?>


	<div class="card bg-secondary rounded-left">
		<div class="card-body">
			<form class="form-inline" action="medico/">
			  <div class="form-group mx-sm-3 mb-2">
			    <label for="namei" class="sr-only">Motivo</label>
			    <input type="text" class="form-control form-control-lg" id="namei" placeholder="Motivo" name="t" value="<?php echo isset($texto)? $texto:''  ?>">
			  </div>
			  <div class="form-group ">
		    	<select class="form-control form-control-lg" name="a">
		    		<option value="">--- Area ---</option>
				  <?php foreach ($dareas as $id => $area): ?>
				  	<option value="<?php echo $id; ?>" <?php echo ($areaSelected==$id)? "selected":'' ?>><?php echo $area; ?></option>
				  <?php endforeach ?>
				</select>
			</div>
			  <button type="submit" class="btn btn-primary mb-2">Buscar</button>
			</form>
		</div>
	</div>


		
<div class="card border-0">
	<?php if ($resultados==0): ?>
		<h3>No se han encontrado resultados</h3>
	<?php else: ?>
		<h5>Resultados: <?php echo $resultados['cantidad']; ?></h5>
		<div class="row">
			<?php foreach ($resultados['registros'] as $id => $r): ?>
				<?php 
				switch ($r['num_area']) {
				 	case 1:
				 		$borde='info';
				 		break;
				 	case 2:
				 		$borde='danger';
				 		break;
				 	case 3:
				 		$borde='primary';
				 		break;
				 	case 1:
				 		$borde='secondary';
				 		break;
				 	case 1:
				 		$borde='dark';
				 		break;
				 	default:
				 		$borde='default';
				 		break;
				 } 


				 switch ($r['estatus']) {
				 	case 1:
				 		$estat='success';
				 		$estatT="Activo";
				 		break;
				 	
				 	default:
				 		$estat='warning';
				 		$estatT="Inactivo";
				 		break;
				 } 
				 
				 	?>
				
					<div class="card col-md-4">
						<div class="card-body">
						<a >
							<h3 class="card-title"><a href="medico/<?php echo $id; ?>"><?php echo $r['nombre']; ?></a> <small class="text-right float-right text-muted">ID#<?php echo $id; ?></small> </h3>
							<h4 class="card-subtitle mb-2 text-muted"><a><?php echo $r['nombre_area']; ?></a><a class=" float-right btn btn-<?php echo $estat; ?> disabled text-white"><?php echo $estatT; ?></a></h4>
							<hr class="bg-<?php echo $borde; ?>">
							<div class="table-responsive-sm">
							  <table class="table">
							    <tr>
							    	<th>Cedula:</th>
							    	<td><?php echo $r['cedula']; ?></td>
							    </tr>
							    <tr>
							    	<th>Correo:</th>
							    	<td><?php echo $r['correo']; ?></td>
							    </tr>
							    <tr>
							    	<th>Fecha Registro:</th>
							    	<td><?php echo $r['fecha']; ?></td>
							    </tr>

							  </table>
							</div>
						</a>
						</div>
					</div>
				
			<?php endforeach ?>
		</div>
		
	<?php endif ?>
</div>
		