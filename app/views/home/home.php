<?php defined('BASEPATH') or exit('No se permite acceso directo'); 
	$this->title="Bienvenidos!";
	mose("params",$this->params);
	$texto=$this->params['texto'];
	$areaSelected=$this->params['area'];
	$resultados=$this->params['resultados'];
	$dareas=$this->params['dareas'];

?>


	<div class="card bg-secondary rounded-left">
		<div class="card-body">
			<form class="form-inline" action="home/">
			  <div class="form-group mx-sm-3 mb-2">
			    <label for="namei" class="sr-only">Motivo</label>
			    <input type="text" class="form-control" id="namei" placeholder="Motivo" name="t" value="<?php echo isset($texto)? $texto:''  ?>">
			  </div>
			  <div class="form-group ">
		    	<label for="nEstudio">Area</label>
		    	<select class="form-control form-control-lg" name="a" id="nEstudio">
		    		<option>Todas</option>
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
				 		$borde='primary';
				 		break;
				 	
				 	default:
				 		$borde='dark';
				 		break;
				 } ?>
				<div class="card col-md-4">
					<div class="card-body">
						<h3 class="card-title"><?php echo $r['motivo']; ?></h3>
						<h4 class="card-subtitle mb-2 text-muted"><?php echo $r['nombre_area']; ?></h4>
						<hr class="bg-secondary">
						
						<?php echo $r['estatus']; ?>
						<span class="border border-primary"></span>
						<h5><small><?php echo $r['fecha']; ?></small></h5>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		
	<?php endif ?>
</div>
		