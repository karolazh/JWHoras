var cargar_mapa = true;

var Home = {


    graficoEstadosNacional : function(data){
        
        var datos = [];
        $.each(data, function(i, value){
          var item = {'estado' : value.nombre, 'total' : parseInt(value.total)};
          datos.push(item);
        });
        var chart = AmCharts.makeChart( "grafico_estados_general", {
          "type": "pie",
			  labelsEnabled: false,
			  autoMargins: false,
			  marginTop: 10,
			  marginBottom: 10,
			  marginLeft: 10,
			  marginRight: 10,
			  pullOutRadius: 10,		  
          "theme": "light",
  "legend":{
   	"position":"bottom",
    "marginRight":100,
    "autoMargins":false
  },		  
          "dataProvider": datos,
          "valueField": "total",
          "titleField": "estado",
           "balloon":{
            "fixedPosition":true
          },
          "export": {
            "enabled": true
          }
        } );
    },


    graficoReconoceAbuso : function(data){

      var chart = AmCharts.makeChart( "grafico_reconoce_abuso", {
        "type": "serial",
        "theme": "light",
        "dataProvider": [ {
          "reconoce": "Si",
          "total": parseInt(data[1])
        }, {
          "reconoce": "No",
          "total": parseInt(data[0])
        }],
        "valueAxes": [ {
          "gridColor": "#FFFFFF",
          "gridAlpha": 0.2,
          "dashLength": 0,
          "integersOnly" : true
        } ],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [ {
          "balloonText": "[[category]]: <b>[[value]]</b>",
          "fillAlphas": 0.8,
          "lineAlpha": 0.2,
          "type": "column",
          "valueField": "total"
        } ],
        "chartCursor": {
          "categoryBalloonEnabled": false,
          "cursorAlpha": 0,
          "zoomable": false
        },
        "categoryField": "reconoce",
        "categoryAxis": {
          "gridPosition": "start",
          "gridAlpha": 0,
          "tickPosition": "start",
          "tickLength": 20
        },
        "export": {
          "enabled": true
        }

      } );
    },

    graficoAceptaPrograma : function(data){
      
      var chart = AmCharts.makeChart( "grafico_acepta_programa", {
        "type": "serial",
        "theme": "light",
        "dataProvider": [ {
          "reconoce": "Si",
          "total": parseInt(data[1])
        }, {
          "reconoce": "No",
          "total": parseInt(data[0])
        }],
        "valueAxes": [ {
          "gridColor": "#FFFFFF",
          "gridAlpha": 0.2,
          "dashLength": 0,
          "integersOnly" : true
        } ],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [ {
          "balloonText": "[[category]]: <b>[[value]]</b>",
          "fillAlphas": 0.8,
          "lineAlpha": 0.2,
          "type": "column",
          "valueField": "total"
        } ],
        "chartCursor": {
          "categoryBalloonEnabled": false,
          "cursorAlpha": 0,
          "zoomable": false
        },
        "categoryField": "reconoce",
        "categoryAxis": {
          "gridPosition": "start",
          "gridAlpha": 0,
          "tickPosition": "start",
          "tickLength": 20
        },
        "export": {
          "enabled": true
        }

      } );
    },

    initMapaGestor : function(){
        
        if(cargar_mapa){
          var mapa = new MapaFormulario('mapa_gestor');

          mapa.seteaLatitud($("#latitud").val());
          mapa.seteaLongitud($("#longitud").val());
          mapa.seteaZoom(4);
          mapa.inicio();
          mapa.cargaMapa();  
          cargar_mapa = false;

          $.ajax({
            url : BASE_URI + 'index.php/Home/pacientesMapaDashboard',
            type : 'post',
            dataType : 'json',
            success : function(response){
              var total = response.pacientes.length;
              var icono = ''
              for(var i = 0; i < total; i++){
                var posicion = new google.maps.LatLng( parseFloat(response.pacientes[i].latitud), parseFloat(response.pacientes[i].longitud)) ;

                var paciente = new google.maps.Marker({
                    id : 'paciente_' + response.pacientes[i].id,
                    position: posicion,
                    map: mapa.getMapa(),
                    icon: BASE_URI + 'static/images/markers/femenino.png'
                });
                var id_paciente = response.pacientes[i].id;
                google.maps.event.addListener(paciente, 'click', function (){
                    xModal.open(BASE_URI + 'index.php/Paciente/bitacora/' + id_paciente, 'Registro número : ' + id_paciente, 85);
                });


              }
            }
          });
          
        }
        
        
        

    }

}