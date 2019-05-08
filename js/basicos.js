function __(element){
	return document.getElementById(element);
}

function _int(element){
	return parseInt(__(element).value);
}

function _float(element){
	return parseFloat(__(element).value);
}

function check(cb) {
    __(cb).checked = true;
}

function uncheck(cb) {
    __(cb).checked = false;
}

function checked(cb) {
	return __(cb).checked;
}


function sumClass(clase){
	var x = document.getElementsByClassName(clase);
	var i;
	totalC=0;
	for (i = 0; i < x.length; i++) {
	    totalC+=parseInt(x[i].value);
	}
	return totalC;
}
var fNumber = {
	sepMil: ",", // separador para los miles
	sepDec: '.', // separador para los decimales
	formatear:function (num){
		num +='';
		var splitStr = num.split('.');
		var splitLeft = splitStr[0];
		var splitRight = splitStr.length > 1 ? this.sepDec + splitStr[1] : '';
		var regx = /(\d+)(\d{3})/;
		while (regx.test(splitLeft)) {
			splitLeft = splitLeft.replace(regx, '$1' + this.sepMil + '$2');
		}
			return this.simbol + splitLeft + splitRight;
	},
	go:function(num, simbol){
		this.simbol = simbol ||'';
		return this.formatear(num);
	}
}

