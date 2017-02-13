$(document).ready(function() {
    
    /**
     * Efecto en el evento hover
     * para cada imagen
     */
    $(".element-flip").livequery(function(){
        $(this).flip({
          trigger: 'hover',
          axis: 'y',
          reverse: true
        });
    });
    
    //inicia plugin
    _iniciaWaterfall();
    
    /**
     * Captura click en boton buscar
     * y recarga resultados
     */
    $("#boton-buscar").on("click", function(e){
        
        //se deja pausada la busqueda anterior
        $('#container-waterfall').waterfall('pause', function(){
            //void
        });
        
        //se genera un nuevo contenedor para los resultados
         $("#contenedor-galeria").html("<div id=\"container-waterfall\"></div>");
         _iniciaWaterfall();
         e.preventDefault();
         e.stopPropagation();
    });
    
    /**
     * Limpia formularios de busqueda y recarga
     * los resultados
     */
    $("#limpiar").on("click", function(e){
        $(".elemento-busqueda").val("");
        $(".letra-abecedario").removeClass("badge");
        $("#boton-buscar").trigger("click");
        e.preventDefault();
        e.stopPropagation();
    });
    
    /**
     * Captura "Enter" en los campos de busqueda
     */
    $(".elemento-busqueda").keypress(function (evt) {
        var charCode = evt.charCode || evt.keyCode;
        if (charCode  == 13) {
            $("#boton-buscar").trigger("click");
            return false;
        }
    });
    
    /**
     * Captura click en la lista de abecedario
     */
    $(".letra-abecedario").on("click", function(e){
        e.preventDefault();
        $(".letra-abecedario").removeClass("badge");
        $(this).addClass("badge");
        //asigna la letra al campo oculto letra
        $("#letra").val($(this).html());
        //ejecuta evento click del boton buscar
        $("#boton-buscar").trigger("click");
        return false;
    });
});

/**
 * Inicia plugin para desplegar
 * items al estilo pinterest
 * @returns {undefined}
 */
function _iniciaWaterfall(){
    $('#container-waterfall').waterfall({
        itemCls: 'item',
        colWidth: 140,
        gutterWidth: 15,
        gutterHeight: 15,
        isAnimated: true,
        animationOptions: {
        },
         
        path: function(page) {
            // envia parametros y carga resultados
            var parametros = $("#form-busqueda").serialize();
            return BASE_URI + "index.php/BuscaPersonas/buscar/?page=" + page + "&" + parametros;
        },
        callbacks: {
            renderData: function (data, dataType) {
               var tpl,
                template,
                resultNum = data.total;

                if ( resultNum == 0 ) { //no hay mas resultados
                    $("#container-waterfall").waterfall('pause', function() {
                        $('#waterfall-message').html('<p class="alert alert-warning">No hay mas resultados</p>')
                    });
                } else { // muetra resultados siguientes
                    if ( dataType === 'json' ||  dataType === 'jsonp'  ) { // json or jsonp format
                        tpl = $('#waterfall-tpl').html();
                        template = Handlebars.compile(tpl);

                        return template(data);
                    } else { // html format
                        return data;
                    }
                }
            }
        }
    });
}




