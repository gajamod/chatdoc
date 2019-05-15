<?php defined('BASEPATH') or exit('No se permite acceso directo'); ?>
<?php
  $this->title="Login | NeuroPediatria";
  $action=BASE_URL."login/signin";
?>
    <div class="row my-5">
      <div class="col-lg-8 offset-lg-2">
        <div id="resultados">
          <div class="alert alert-dismissible alert-info">
            <strong>Bienvenido!</strong> Inicia sesion con tu usuario y contraseña. si aun no cuentas con solicitalos con la administracion :)
          </div>
        </div>
        <div class="container col-md-8">
          <form id="login-form" method="post" action="<?php echo $action;?>" role="form" onkeypress="return leer(event)" onsubmit="return logon()">
            <div class="form-header ">
                <h3 class="form-title"><i class="fa fa-user"></i> Ingreso</h3>                 
            </div>
            <div class="form-group">
              <label class="sr-only" for="nombre">Correo</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Correo">
              </div>
            </div>
            <div class="form-group">
              <label class="sr-only" for="nombre">Contraseña</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></div>
                <input class="form-control" type="password" name="password" id="password" placeholder="Contrasena">
              </div>
            </div>
            <input name="token" id="token" type="hidden" value='<?= md5(time()); ?>'>
            <div class="form-group">
              <input type="button" name="btnsubmit" id="submit-button" class="btn btn-primary" onclick="logon();" value="Iniciar Sesion">
            </div>
          </form>
        </div>
      </div>
    </div>
      
    
    <script type="text/javascript">
      function leer(e){
        if (e.keyCode==13) {
          logon();
        }
      }
      function logon(){
        var us=document.getElementById('usuario').value;
        var pw=document.getElementById('password').value;
        //ajax
        buscarAJAX=new XMLHttpRequest();
        buscarAJAX.open('POST','ajax/login.php',true);
        buscarAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        buscarAJAX.send('us='+us+'&pw='+pw);

        buscarAJAX.onreadystatechange=function(){
          if(buscarAJAX.readyState==4 && buscarAJAX.status== 200){
            if (buscarAJAX.responseText==1) {
              respuesta='<div class="alert alert-dismissible alert-success">';
              respuesta+='<strong>Bien!</strong> Por favor espere lo estamos redireccionando.</div>';
              document.getElementById('resultados').innerHTML=respuesta;
              document.getElementById('login-form').submit();
              return true;
            }else if (buscarAJAX.responseText==-1){
              respuesta='<div class="alert alert-dismissible alert-danger">';
              respuesta+='<h4 class="alert-heading">Error!</h4>';
               respuesta+='<p class="mb-0">Error en la solicitud</div>';
               document.getElementById('resultados').innerHTML=respuesta;
               return false;
            }else{
              respuesta='<div class="alert alert-dismissible alert-danger">';
              respuesta+='<h4 class="alert-heading">Error!</h4>';
               respuesta+='<p class="mb-0">Usuario y/o contraseña incorrectos</div>';
               document.getElementById('resultados').innerHTML=respuesta;
               return false;
            }
            
          }else{
            respuesta='<div class="alert alert-dismissible alert-info">';
            respuesta+='<h4 class="alert-heading">Espere por favor</h4>';
            respuesta+='<p class="mb-0">Estamos procesando su solicitud.</p></div>';
            document.getElementById('resultados').innerHTML=respuesta;
            return false;
          }
        }
      };
    </script>

  
