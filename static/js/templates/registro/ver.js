
var MantenedorEmt = Class({

	loadGrid : function(){
		setTimeout(this.bindMapa,1000);
	},

    bindMapa : function(){        
		var mapa = new MapaFormulario("map");
		mapa.seteaIcono("static/images/referencia.png");
		mapa.seteaZoom(12);
		mapa.inicio();
		mapa.cargaMapa();
		mapa.setMarkerInputs();
    }
});

$(document).ready(function() {
    var listado = new MantenedorEmt();
	listado.loadGrid();
});
