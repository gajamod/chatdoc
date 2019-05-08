<?php 
   $this->title="Registro| Neuropediatria";    	  
?>
<div class="row my-5">
  <div class="col-lg-8 offset-lg-2">
    <div id="resultados">
      <div class="alert alert-dismissible alert-info">
        <strong>Bienvenido!</strong>
      </div>
    </div>
    <div class="container col-md-8">
		<?php 
		//$action="ph/registrarU.php" 
		$action=BASE_URL."login/registro/";
		?>
		<div class="card ">
			<header class="card-header">
				<h1>Registro</h1>
			</header>
			<div class="card-body">
				<form id="register-form" method="post" action="<?php echo htmlspecialchars($action);?>" role="form" onkeypress="return leer(event)" onsubmit="return valid()">
					<div class="form-group">
						<label class="sr-only" for="nombre">Nombre Completo</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
						<input class="form-control" type="text" placeholder="Nombre Completo" name="nombre" required="required">
						</div>
						<span class="help-block" id="error"></span>
					</div>
					
					<div class="form-group">
						<label class="sr-only" for="usuario">Usuario</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
						<input class="form-control" name="usuario" type="text" placeholder="Nombre usuario" required="required" >
						</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password">Contraseña</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
						<input class="form-control" type="password" placeholder="Contraseña" id="password" name="password" required="required">
						</div>
						<span class="help-block" id="error"></span>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password2">Confirmar Contraseña</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
						<input class="form-control" type="password" placeholder="Confirmar Contraseña" name="password2" required="required" id="password2">
						</div>
						<span class="help-block" id="error"></span>
					</div>
					<div class="row p-3">
						<div class="form-check col-md-8">
						  <input class="form-check-input" type="checkbox" name="act" id="act" value="1" checked="checked">
						  <label class="form-check-label" for="act">
						    Activo
						  </label>
						</div>
						<div class="form-check col-md-4">
						  <input class="form-check-input" type="checkbox" name="ad" id="ad" value="1">
						  <label class="form-check-label" for="ad">
						    Admin
						  </label>
						</div>
					</div>
					
					<div>
						<input type="submit" id="submit-button" class="btn btn-primary" value="Registrar" name="btnregistrar" onclick="valid();">	
					</div>
				</form>
			</div>
		</div>
    </div>
  </div>
</div>
<script src="js/validationreg.js"></script>