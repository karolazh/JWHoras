/* global BASE_URI */

var Registro = {
    
    guardarNuevoAdjunto: function (form,btn) {
        var error = false;
        var msg_error = '';        
        var tipodoc = form.tipoDoc.value;
        var path = form.archivo.value;
        
        if (tipodoc == 0) {
            msg_error += 'Seleccione Tipo de documento<br/>';
            error = true;
        }
        
        if (path == "") {
            msg_error += 'Seleccione Archivo<br/>';
            error = true;
        }
        
        if (error) {
            xModal.danger(msg_error,function(){
            });
        } else {
            extensiones_permitidas = new Array('.jpeg', '.jpg', '.png', '.gif', 
                                               '.tiff', '.bmp', '.pdf', '.txt', 
                                               '.csv', '.doc', '.docx', '.ppt', 
                                               '.pptx', '.xls', '.xlsx');
            permitida		   = false;
            string		   = path;
            extension		   = (string.substring(string.lastIndexOf("."))).toLowerCase();

            for(var i = 0; i < extensiones_permitidas.length; i++) {
                if (extensiones_permitidas[i] == extension){
                        permitida = true;
                        break;
                }
            }

            if (!permitida) {
                msg_error += 'El Tipo de archivo que intenta subir no está permitido.<br><br>'
                msg_error += 'Favor elija un archivo con las siguientes extensiones: <br>'
                msg_error += extensiones_permitidas.join(' ')+'<br/>';
                xModal.warning(msg_error);
            }else{
                $(form).submit();
            }
        }
    }
}