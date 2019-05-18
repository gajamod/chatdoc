$(function() {
	$.validator.setDefaults({
		errorClass: 'alert alert-danger',
		errorElement: 'div',
		errorPlacement: function(error, element) {
	        if(element.closest('.input-group').length) {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    },
		highlight: function(element) {
			$(element)
				.closest('.form-group')
				.addClass('text-danger');
		},
		unhighlight: function(element) {
			$(element)
				.closest('.form-group')
				.removeClass('text-danger');
		}
	});

	$.validator.addMethod('strongPassword', function(value,element){
		return this.optional(element)
		|| value.length >=6
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);
	},'La contraseña debe tener al menos 6 caracteres,entre numeros y letras');

	/*$.validator.addMethod("strongPassword2",function(value,element){
                return this.optional(element) 
                || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
            },'Escriba una mejor Contraseña');

*/
	$("#register-form").validate({
		rules: {
			ar:{
				required:true
			},
			mot:{
				required:true
			},
			descr: {
				required:true,
			}
			


		},

		messages: {
			ar:{
				required:"Campo Obligatorio"
			},
			mot:{
				required:"Campo Obligatorio"
			},
			descr:{
				required:"Campo Obligatorio"
			}
			

		}


	});


});