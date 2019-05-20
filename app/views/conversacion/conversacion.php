


<?php defined('BASEPATH') or exit('No se permite acceso directo'); 
	$this->title="Conversacion";
	//mose("params",$this->params);
    $info=$this->params['conversacion']['info'];
    $respuestas=($this->params['conversacion']['respuestas']);
    if(is_array($respuestas)){
       ksort($respuestas); 
    }
    switch ($info['estatus']) {
        case 1:
            $estat='success';
            $estatT="Activo";
            break;
        
        default:
            $estat='warning';
            $estatT="Cerrado";
            break;
     } 
    

?>
<div class="card">
    <div class="card-body">
        <h4><a class="card-title float-left"></a><?php echo  $info['motivo']?>   <small class="card-subtitle text-muted float-right">#<?php echo  $info['id']?></small> <a class=" float-right btn btn-<?php echo $estat; ?> disabled text-white"><?php echo $estatT; ?></a></h4>
        <p class="card-text"><?php echo  $info['descripcion']?></p>
        <div class="table-responsive">
          <table class="table">
            <tr>
                <th>Paciente:</th>
                <td><a><?php echo  $info['nombre_pac']?></a></td>
                <th>Area:</th>
                <td><a><?php echo  empty($info['nombre_area'])? "Desconocido":$info['nombre_area']; ?></a></td>
                <th>Medico:</th>
                <td><a href="medico/<?php echo empty($info['nombre_dr'])? '':$info['num_dr'] ?>"><?php echo  empty($info['nombre_dr'])? "Sin Asignar":$info['nombre_dr']; ?></a></td>
            </tr>
          </table>
        </div>
    </div>
</div>
<div class="card bg-light" style="height: 350px;">
    <div class="card-body">
        <?php if (is_array($respuestas)): ?>
            <?php foreach ($respuestas as $id=> $r): ?>
                <?php 
                    if ($r['tipo']==1) {
                        $lad="float-lefttt text-left col-md-4 mr-auto speech-bubble-left";
                        $lin="bg-info";
                    } else {
                        $lad="float-righttt text-right col-md-4 ml-auto  speech-bubble-right";
                        $lin="bg-primary";
                    }
                    
                ?>
                <div class="row container-fluid">
                    <div class="card <?php echo $lad; ?> mx-4">
                        <div class="card-body $lad2 p-1">
                            <?php echo $r['respuesta'];?>
                            <hr class="<?php echo $lin; ?> m-1 mt-2">
                            <p><small class=" text-muted"><a class="float-left text-left"><?php echo $r['nombre'];?></a><a class="float-right text-right"><?php echo $r['fecha'];?></a></small></p>
                        </div>
                           
                    </div>
                </div>
             <?php endforeach ?>
        <?php else: ?>
            <p class="card-text text-center">No hay mensajes en la conversacion</p>
        <?php endif ?>
            
     </div>
</div>
<div class="card bg-secondary rounded-left">
        <div class="card-body">
            <form method="post" class="form-row" action="conversacion/<?php echo $info['id']; ?>" >
              <!--<div class="input-group mx-sm-3 mb-2">
                <label for="namei" class="sr-only">Motivo</label>
               
              
               <input type="text" class="form-control form-control-lg" id="namei" placeholder="Motivo" name="t" value="<?php echo isset($texto)? $texto:''  ?>"></div>
 <button type="submit" class="btn btn-primary mb-2">Enviar</button>
           -->
    <div class="input-group">
    <input type="text" class="form-control" placeholder="Enviar un mensaje" name="msj">
    <input type="hidden" name="cht" value="<?php echo $info['id']; ?>">
    <div class="input-group-append">
      <button class="btn btn-success rounded-right px-5" type="submit" data-toggle="tooltip" data-placement="top" title="Enviar">
        <i class="fas fa-paper-plane"></i>
      </button>
    </div>
  </div>
             
            </form>
        </div>
    </div>