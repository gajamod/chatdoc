<script>
    
    total = 0;
    bol = 0;
<?php 
    $paga2=$paga0-$paga1;
    if (!(is_numeric($paga2) and $paga2>0)) {
        $paga2=0;
    }
?>
function getTotal() {    
    
    __('totales').innerHTML = "<h1>" + fNumber.go(<?php echo $paga2; ?>, "$") + "</h1>";
   
}
function getPagado(){
    ctpag=0;
    var y = document.getElementsByClassName("vp");
    var i;
    for (i = 0; i < y.length; i++) {
      pid=y[i].id;
      if (_float('f'+pid)==<?php echo DOLARES; ?>) {
        ctpag+=parseFloat(__("tCambio").innerHTML)*_float(pid);
      }else{
        ctpag+=_float(pid);
      }
    }
    tpag=__('tpagado');
    tpag.innerHTML = "<h2>" + fNumber.go(ctpag, "$") + "</h2>";
    return ctpag;
}

function caja() {

    getTotal();

    pagado = getPagado();
    cambia = pagado - total;
    pcambio = __('cambio');
    if (cambia < 0) {
        pcambio.classList.add('rojo');
    } else {
        pcambio.classList.remove('rojo');
    }
    pcambio.innerHTML = "<h2>" + fNumber.go(cambia, "$") + "</h2>";
    __('tbol').innerHTML = "<h4>Cant Boletos: " + bol + "</h4>";
    //alert("Hello! I am an alert box!!");
}


function pregunta() {
    if (validarP() && confirm('¿Estas seguro de enviar este formulario?')) {
        pcambio.innerHTML = "<h2>" + fNumber.go(cambia, "$") + "</h2> "+'<input type="hidden" name="cambiot" value="'+cambia+'">';
        return true;
    } else {

        return false;
    }

}

function validarP() {
    var err=0;
    var y = document.getElementsByClassName("selectfp");
    var i;
    for (i = 0; i < y.length; i++) {
      pid=y[i].id;
      select_value=_int(pid);
      input_aut=__('a'+pid);
      oselect=__(pid);
      if (select_value==0) {
        oselect.classList.add('error');
        input_aut.classList.remove('error');
        err++;
      }else{
        oselect.classList.remove('error');
        if ( (select_value == <?php echo TARJETA; ?> || select_value == <?php echo DEPOSITO; ?> || select_value == <?php echo DEPOSITONR; ?> ) && input_aut.value.length<4){
            input_aut.classList.add('error');
            err++;
        }else{
            input_aut.classList.remove('error');
        }
      }
    }
    


    if (checked('rPagar') && cambia < 0) {
        __('tpagado').classList.add('error');
        __('comentarios').classList.remove('error');
        err++;
    } else if (checked('rDeuda') && __('comentarios').value.length < 7) {
        __('comentarios').classList.add('error');
        __('tpagado').classList.remove('error');
        err++;
    } else if (bol <= 0) {
        err++;
    } 

    if (err>0) {
        return false;
    }else{
        return true;
    }
}
</script>
<script>
$(document).ready(function(){
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_pago').append('<div id="row'+i+'" class="form-group"><br/><div class="input-group col-md-6"><div class="input-group-addon">$</div><input type="number" name="Cpagada['+i+']" id="p'+i+'" value="0" min="0" required="required" onchange="caja();" class="form-control vp"></div><div class="input-group col-md-5"><?php echo trim($sfp); ?></div><div class="input-group col-md-6"><input type="text" name="afp['+i+']" disabled="disabled" class="form-control atfpi disabled" id="afp'+i+'" placeholder="#Autorizacion" required pattern=".{4,30}"></div><div class="input-group col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove col-md-4">X</button></div></div>');
    });

    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
    $(document).on('change', '.vp', caja());

    $(document).on('change', '.selectfp', function(){
        //alert("sfp");
        var select_id = $(this).attr("id"); 
        aut=__('a'+select_id);
        select_value=_int(select_id);
        if ( select_value == <?php echo TARJETA; ?> || select_value == <?php echo DEPOSITO; ?> || select_value == <?php echo DEPOSITONR; ?> ) {
            aut.classList.remove('disabled');
            aut.removeAttribute("disabled");
            aut.focus();
        }else{
            aut.classList.add('disabled');
            var att = document.createAttribute("disabled");       // Create a "class" attribute
            att.value = "disabled"; 
            aut.setAttributeNode(att);
            
        }
        if (select_value!=0) {
            __(select_id).classList.remove('error');
        }
        caja();
    });
    $(document).on('change', '.atfpi', function(){
         var aut_id = $(this).attr("id"); 
         aut_i=__(aut_id);
         if (aut_i.value.length>=4) {
            aut_i.classList.remove('error');
         }
    });
});
</script>
