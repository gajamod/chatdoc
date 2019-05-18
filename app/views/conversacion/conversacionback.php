


<?php defined('BASEPATH') or exit('No se permite acceso directo'); 
	$this->title="Conversacion";
	mose("params",$this->params);
	/*$respuesta=$this->params['respuesta'];
	$tipo=$this->params['tipo'];
	$nombre=$this->params['nombre'];
	$fecha=$this->params['fecha'];
    */
$prueba[1] = array('respuesta'=>"respuesta uno",'tipo'=>0,'nombre'=>'paciente1','fecha'=>'2019-05-16 10:44:23');
$prueba[2] = array('respuesta'=>"respuesta dos",'tipo'=>1,'nombre'=>'Doctor1','fecha'=>'2019-05-16 11:44:23');
?>

<div class="card border-2">
    <?php foreach ($prueba as $id=> $r): ?>
    <?php if ($tipo == 0): ?>
            <div class="text-primary">
                <pull class="rigth">
                    <table class="table">
				<tr>
                    <td>
                        <? php echo $r['nombre'];?>
                    </td>
                    <td>
                        <? php echo $r['respuesta'];?>
                    </td>
                    <td>
                        <? php echo $r['fecha'];?>
                    </td>
                </tr>
               
            </table>
            </pull>
        </div>
         <?php else: ?>
        <div class="text-info">
                <pull class="left">
                    <table class="table">
				<tr>
                    <td>
                        <? php echo $r['nombre'];?>
                    </td>
                    <td>
                        <? php echo $r['respuesta'];?>
                    </td>
                    <td>
                        <? php echo $r['fecha'];?>
                    </td>
                </tr>
               
            </table>
            </pull>
        </div>
       <?php endif ?> 
     <?php endforeach ?>
</div>