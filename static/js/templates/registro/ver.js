$(document).ready(function() {


            var mapa = new MapaFormulario("map");
            mapa.seteaIcono("static/images/referencia.png");
            mapa.seteaZoom(12);
            mapa.inicio();
            mapa.cargaMapa();

            //if($("#eme_id").val()!=""){
                mapa.setMarkerInputs();
            //}



});