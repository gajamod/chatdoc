<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand p-0 m-0" href="<?php echo BASE_URL ?>"><img src="img/logo1.png" width="" height="50" class="d-inline-block align-top p-0 mr-5" alt="Neuropediatria" min-width="175px" id="hlogoi"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSVA" aria-controls="navbarSVA" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSVA">
    
    
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL ?>">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn btn-info" href="<?php echo BASE_URL ?>conversacion/nueva">Nueva Consulta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL ?>medico/">Ver Medicos</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if (Session::valid_session()): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="ddmlPerfil" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-laugh-beam"></i> <?php echo $_SESSION['apodo']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ddmlPerfil">
            <a class="dropdown-item" href="#">Cambiar Contraseña</a>
            <a class="dropdown-item" href="<?php echo BASE_URL; ?>login/logout">Cerrar Sesion</a>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL; ?>login">Iniciar Sesion</a>
        </li>
      <?php endif ?>
      
    </ul>
    
  </div>
</nav>
<span class="d-block bg-sv divu"></span>

<?php  
    
 ?>


