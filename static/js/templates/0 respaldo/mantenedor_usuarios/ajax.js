$(document).ready(function() {
    $("#guardarPrioridad").on('click', function(e) {
        var param= $("#form").serialize();
 
             $.ajax({         
                dataType: "json",
                cache:false,
                async: true,
                url:BASE_URI + 'index.php/Prioridad/guardar',
                type: 'POST',
                data:param,
                beforeSend: function(){
                    //alert("button proccess")
                },
                success:function(obj){
                     
                }
            }); 
    });
});

$(document).ready(function() {
    $("#guardarPerfil").on('click', function(e) {
        //var button_process = buttonStartProcess($(this), e);
        var param= $("#formPerfil").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            url:BASE_URI + 'index.php/Perfiles/guardarNuevoPerfil',
            type: 'POST',
            data:param,
            beforeSend: function(){

            },
            success:function(obj){
                        
            }
        }); 
    });
});

$(document).ready(function() {
    $("#guardarEstado").on('click', function(e) {
        //var button_process = buttonStartProcess($(this), e);
        var param= $("#formEstado").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            url:BASE_URI + 'index.php/Estados/guardarNuevoEstado',
            type: 'POST',
            data:param,
            beforeSend: function(){

            },
            success:function(obj){
                        
            }
        }); 
    });
});

$(document).ready(function() {
    $("#guardarProyecto").on('click', function(e) {
        //var button_process = buttonStartProcess($(this), e);
        var param= $("#formProyecto").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            url:BASE_URI + 'index.php/Proyecto/guardarNuevoProyecto',
            type: 'POST',
            data:param,
            beforeSend: function(){

            },
            success:function(obj){
                        
            }
        }); 
    });
});

$(document).ready(function() {
    $("#editarPrioridadBtn").on('click', function(e) {
        //var button_process = buttonStartProcess($(this), e);
        var param= $("#editarPrioridad").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            url:BASE_URI + 'index.php/Prioridad/editarPrioridad',
            type: 'POST',
            data:param,
            beforeSend: function(){

            },
            success:function(obj){
                        
            }
        }); 
    });
});