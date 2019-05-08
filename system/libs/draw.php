<?php 

class draw
{
	public static function select($datos,$value,$opcion,$nombre, $class="",$id=null){
		if (is_array($datos)) {
			# code...
		}
		ob_start();
    	?>
	    <div class="form-group">
	      <select name="<?php echo $nombre; ?>" class="<?php echo $class; ?>" >
	        <?php 
	          foreach ($datos as $key => $fila) {
	            ?>
	              <option value="<?php echo $fila[$value]; ?>"><?php echo $fila[$opcion]; ?></option>
	            <?php
	          }
	        ?>
	      </select>
	    </div>
    	<?php
    	$sel=ob_get_clean();
    	echo $sel; 
	}
}


 ?>