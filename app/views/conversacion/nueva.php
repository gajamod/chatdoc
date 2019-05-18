<?php 
   $this->title="Nueva consulta| Chatdoc";
   $dareas=$this->params['dareas'];   	  
?>
<div class="row my-5">
  <div class="col-lg-8 offset-lg-2">
    <div class="container col-md-8">
		<?php 
		//$action="ph/registrarU.php" 
		$action=BASE_URL."conversacion/nueva/";
		?>
		<div class="card ">
			<header class="card-header">
				<h1>Nueva Consulta</h1>
			</header>
			<div class="card-body">
				<form id="register-form" method="post" action="<?php echo htmlspecialchars($action);?>" role="form" onkeypress="return leer(event)" onsubmit="return valid()">
					<div class="form-group">
						<label class="sr-only" for="mot">Motivo / Titulo</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
						<input class="form-control form-control-lg" type="text" placeholder="Motivo / Titulo de la consulta" name="mot" aarequired="required">
						</div>
						<span class="help-block" id="error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="usuario">Area</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
						<select class="form-control form-control-lg" name="ar">
				    		<option value="">--- Area ---</option>
						  <?php foreach ($dareas as $id => $area): ?>
						  	<option value="<?php echo $id; ?>" ><?php echo $area; ?></option>
						  <?php endforeach ?>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="descr">Descripcion</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
						<textarea class="form-control form-control-lg" name="descr" placeholder="Descripcion completa y Sintomas"></textarea>
						</div>
						<span class="help-block" id="error"></span>
					</div>
					<div>
						<input type="hidden" name="tkn" value="<?php echo Session::generateToken(); ?>">
						<input type="submit" id="submit-button" class="btn btn-primary" value="Registrar" name="btnregistrar" onclick="valid();">	
					</div>
				</form>
			</div>
		</div>
    </div>
  </div>
</div>
<script src="js/validationnewcons.js"></script>