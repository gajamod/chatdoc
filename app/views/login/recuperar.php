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
		$action=BASE_URL."login/recuperar/";
		?>
		<div class="card ">
			<header class="card-header">
				<h1>Recuperar password</h1>
			</header>
			<div class="card-body">
				<form id="recuperar-form" method="post" action="<?php echo htmlspecialchars($action);?>" role="form" onkeypress="return leer(event);" onsubmit="return valid();">	
					<input type="hidden" name="tkn" value="<?php echo $this->params['token'] ?>">	
					<input type="hidden" name="cr" value="<?php echo $this->params['tokenR'] ?>">
					<div class="form-group">
						<label class="sr-only" for="usuario">Usuario</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
							<input class="form-control" name="us" type="text" placeholder="Usuario" required="required" >
						</div>
						<div class="help-block alert">
	        			</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password">Contraseña</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
						<input class="form-control" type="password" placeholder="Contraseña" id="password" name="password" required="required">
						</div>
						<div class="help-block alert">
	        			</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for="password2">Confirmar Contraseña</label>
						<div class="input-group">
	                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
						<input class="form-control" type="password" placeholder="Confirmar Contraseña" name="password2" required="required" id="password2">
						</div>
						<div class="help-block alert">
	        			</div>
					</div>					
					<div>
						<input type="submit" id="submit-button" class="btn btn-primary" value="Registrar" name="btnrecup">	
					</div>
				</form>
			</div>
		</div>
    </div>
  </div>
</div>

<script src="js/validationrec.js"></script>