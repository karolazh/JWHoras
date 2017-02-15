$(document).ready(function() {
    $("#enviar").on('click', function(e) {
        var button_process = buttonStartProcess($(this), e);
        var parametros = $("#form").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            data: parametros,
            type: "post",
            url: BASE_URI + "index.php/Login/recuperar_password_rut", 
            error: function(xhr, textStatus, errorThrown){

            },
            success:function(data){
                buttonEndProcess(button_process);
                if(data.correcto){
                    $("#form-contenedor").addClass("hidden");
                    $("#form-success").removeClass("hidden");
                    $("#mensaje-modificacion").html("Se han enviado los datos para recuperar contraseña al correo del Usuario");
                } else {
                    procesaErrores(data.error);
                    $("#form-error").removeClass("hidden");
                }
            }
        }); 
    }); 
});


function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = "kK0123456789";//Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 37, 39, 46, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false;
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial){
        return false;
      }
}

//Formateo Rut
function formateaRut(rut0)
{
        var cont = 0;
        var format;
        var rut1 = rut0.value;
        while (rut1.indexOf(".") != -1)
            rut1 = rut1.replace(".","");
        while (rut1.indexOf("-") != -1)
            rut1 = rut1.replace("-","");
        if (rut1 != "" && rut1.length > 1){
               format = "-" + rut1.substring(rut1.length - 1);
       } else {
               format = "" + rut1.substring(rut1.length - 1);
       }
        for (var i = rut1.length - 2; i >= 0; i--) {
            format = rut1.substring(i, i + 1) + format;
            cont++;
            if (cont == 3 && i != 0) {
                format = "." + format;
                cont = 0;
            }
        }
        document.getElementById("rut").value = format;
}

//Validar rut
function validaRut(objetoRut){
    	var tmpstr = "";
	var intlargo = objetoRut.value;
	if (intlargo.length> 0)
	{
		crut = objetoRut.value;
		largo = crut.length;
		if ( largo <2 )
		{
                        $('#rut').parent().addClass('has-error');
			return false;
		}
		for ( i=0; i <crut.length ; i++ )
		if ((crut.charAt(i) != ' ') && (crut.charAt(i) != '.') && (crut.charAt(i) != '-'))
		{
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut = tmpstr;
		largo = crut.length;
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else    rut = crut.charAt(0);
                    
		dv = crut.charAt(largo-1);
 
		if ( rut == null || dv == null )
		return 0;
 
		var dvr = '0';
		suma = 0;
		mul  = 2;
 
		for (i= rut.length-1 ; i>= 0; i--)
		{
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
 
		res = suma % 11;
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else
		{
			dvi = 11-res;
			dvr = dvi + "";
		}
                //Rut es Inválido
		if ( dvr != dv.toLowerCase() )
		{ 
                    $('#rut').parent().addClass('has-error');
                    return true;
		}
                //Rut Válido
		
                if ($('#rut').parent().hasClass('has-error')) {
                        $('#rut').parent().removeClass('has-error');
                    }
                $('#rut').parent().addClass('has-success');
                return false;
	}
}