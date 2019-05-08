<link rel="stylesheet" href="css/pwdBox.css">
<div class="invisible" id="pwdBox">
  <div class="card p-5 border-info">
    <h5 class="card-title">Copie el enlace de recuperacion</h5>
    <div class="input-group mb-2 input-group-lgh">
        <input type="text" class="form-control input-lg" id="txtEnlace" disabled="disabled" onclick="">
        <div class="input-group-append">
          <button class="btn btn-info" onclick="Copiar();" id="btnCopiar"><i class="fas fa-paste"></i> Copiar</button>
        </div>
    </div>
    <button class="btn btn-primary mt-5 mx-5" onclick="ocultar();"> Listo </button>
  </div>
</div>
<h1>Lista de usuarios</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Usuario</th>
      <th scope="col">Activo</th>
      <th scope="col">Administrador</th>
      <th scope="col">Fecha de registro</th>
      <th scope="col" colspan="3">Opciones</th>
    </tr>
  </thead>
  <tbody>
	<?php foreach ($this->params['usuarios'] as $key => $usuario): ?>
	    <tr>
	      <th scope="row"><?php echo $usuario['id']; ?></th>
	      <td><?php echo $usuario['nombre']; ?></td>
	      <td><?php echo $usuario['usuario']; ?></td>
	      <td id="<?php echo "Est".$usuario['id']; ?>"><?php echo ($usuario['activo']==1)?'Si':'No'; ?></td>
	      <td id="<?php echo "Adm".$usuario['id']; ?>"><?php echo ($usuario['admin']==1)?'Si':'No'; ?></td>
	      <td><?php echo $usuario['fecha_registro']; ?></td>
	      
	      <?php if ($usuario['id']==$_SESSION['idE']): ?>
          <td>No disponible</td>
	      	<td>No disponible</td>
	      	<td>No disponible</td>
	      <?php else: ?>
          <td><button class="btn btn-info" onclick="recuperarP(<?php echo $usuario['id']; ?>);">Recuperar contraseña</button></td>
	      	<td><button class="btn btn-warning"  id="<?php echo "EstB".$usuario['id']; ?>" onclick="activoP(<?php echo $usuario['id']; ?>);"><?php echo ($usuario['activo']==1)?'Desactivar':'Activar'; ?></button></td>
	      	<td><button class="btn btn-alert"  id="<?php echo "AdmB".$usuario['id']; ?>" onclick="adminP(<?php echo $usuario['id']; ?>);" ><?php echo ($usuario['admin']==1)?'Quitar Permisos':'Dar permisos'; ?></button></td>
	      <?php endif ?>
	      
	    </tr>
	<?php endforeach ?>
	</tbody>
</table>
<script>

  $(document).ready(function(){
    $('#btnCopiar').tooltip({title: "Copiado!", trigger: "click",delay: {show: 100, hide: 300}}); 
  });
  $(function () {
   $(document).on('shown.bs.tooltip', function (e) {
      setTimeout(function () {
        $(e.target).tooltip('hide');
      }, 1000);
   });
});
</script>
<script>
  function ocultar() {
   $( "#pwdBox" ).last().addClass( "invisible" );
  }

  function mostrar() {
   $( "#pwdBox" ).last().removeClass( "invisible" );
  }

  function copyRecuperar() {
    /* Get the text field */
    var copyText = document.getElementById("txtEnlace");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
  }

  function Copiar() {
      element='#txtEnlace';
       //creamos un input que nos ayudara a guardar el texto temporalmente
       var $temp = $("<input>");
       //lo agregamos a nuestro body
       $("body").append($temp);
       //agregamos en el atributo value del input el contenido html encontrado
       //en el td que se dio click
       //y seleccionamos el input temporal
       $temp.val($(element).val()).select();
       //ejecutamos la funcion de copiado
       document.execCommand("copy");
       //eliminamos el input temporal
       $temp.remove();
   }

	function recuperarP(us) {
        //ajax
        userAJAX=new XMLHttpRequest();
        userAJAX.open('POST','ajax/recuperar.php',true);
        userAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        userAJAX.send('us='+us);
        console.log(userAJAX);
        userAJAX.onreadystatechange=function(){
          if(userAJAX.readyState==4 && userAJAX.status==200){
            if (userAJAX.responseText.length>7) {
              mostrar();
              document.getElementById('txtEnlace').value=userAJAX.responseText;
              
            }else{
            	alert("Error");
            }
            
          }
        }
  }
	function adminP(us) {

		elemento='Adm'+us;
		elementoB='AdmB'+us;
		var val=document.getElementById(elemento).innerText;
		if (val=='No'){
			val='v';
		}else if (val=='Si'){
			val='f';
		}else{
			val='f';
		}
        //ajax
        userAJAX=new XMLHttpRequest();
        userAJAX.open('POST','ajax/usuarios.php',true);
        userAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        userAJAX.send('us='+us+'&op='+3+'&val='+val+'&per='+1);
        console.log(userAJAX);
        userAJAX.onreadystatechange=function(){
          if(userAJAX.readyState==4 && userAJAX.status==200){
            if (userAJAX.responseText==1) {
            	if (val=='v'){
					respuesta='Si';
					respuestaB='Quitar Permisos';
					al="Se concede administrador";
				}else{
					respuesta='No';
					respuestaB='Dar permisos';
					al="Se quitado como administrador";
				}
              document.getElementById(elemento).innerHTML=respuesta;
              document.getElementById(elementoB).innerHTML=respuestaB;
              swal("Proceso Correcto!", al, "success");
            }else if (userAJAX.responseText==-2){
              swal("Error!", "Error al procesar la solicitud", "error");
            }else{
            	swal("Error!", "Error desconocido", "error");
            }
            
          }
        }
  }
  function activoP(us) {

		elemento='Est'+us;
		elementoB='EstB'+us;
		var val=document.getElementById(elemento).innerText;
		if (val=='No'){
			val='v';
		}else if (val=='Si'){
			val='f';
		}else{
			val='f';
		}
        //ajax
        actAJAX=new XMLHttpRequest();
        actAJAX.open('POST','ajax/usuarios.php',true);
        actAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        actAJAX.send('us='+us+'&op='+2+'&val='+val+'&act='+1);
        console.log(actAJAX);
        actAJAX.onreadystatechange=function(){
          if(actAJAX.readyState==4 && actAJAX.status==200){
            if (actAJAX.responseText==1) {
            	if (val=='v'){
					respuesta='Si';
					respuestaB='Desactivar';
					al="Se ha Activado el usuario";
				}else{
					respuesta='No';
					respuestaB='Activar';
					al="Se ha Desactivado el usuario";
				}
              document.getElementById(elemento).innerHTML=respuesta;
              document.getElementById(elementoB).innerHTML=respuestaB;
              swal("Proceso Correcto!", al, "success");
            }else if (actAJAX.responseText==-2){
              swal("Error!", "Error al procesar la solicitud", "error");
            }else{
              swal("Error!", "Error desconocido", "error");
            }
            
          }
        }
  }
	
</script>