var cargar_mapa = true;

var Home = {


    graficoEstadosNacional : function(data,titulo){

        if(titulo !== undefined){
          $("#titulo_registros_estados").html(titulo);
        }
        
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


    graficoReconoceAbuso : function(data,titulo){

      if(titulo !== undefined){
        $("#titulo_reconoce_abuso").html(titulo);
      }

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

    graficoAceptaPrograma : function(data,titulo){
      
      if(titulo !== undefined){
        $("#titulo_acepta_programa").html(titulo);
      }

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


    graficoFechasRegistros : function(data, titulo){
      if(titulo !== undefined){
        $("#titulo_fechas_registros").html(titulo);
      }

      var datos = [];
      $.each(data, function(i, item){
        var fecha = {date: item.fecha, value: parseInt(item.total)};
        datos.push(fecha);
      });

      var chart = AmCharts.makeChart("grafico_fechas_registros", {
          "type": "serial",
          "path" : BASE_URI + 'static/js/plugins/amcharts',
          "theme": "light",
          "language" : "es",
          "marginRight": 40,
          "marginLeft": 40,
          "autoMarginOffset": 20,
          "mouseWheelZoomEnabled":true,
          "dataDateFormat": "YYYY-MM-DD",
          "valueAxes": [{
              "id": "v1",
              "axisAlpha": 0,
              "position": "left",
              "ignoreAxisWidth":true,
              "integersOnly" : true
          }],
          "balloon": {
              "borderThickness": 1,
              "shadowAlpha": 0
          },
          "graphs": [{
              "id": "g1",
              "balloon":{
                "drop":true,
                "adjustBorderColor":false,
                "color":"#ffffff"
              },
              "bullet": "round",
              "bulletBorderAlpha": 1,
              "bulletColor": "#FFFFFF",
              "bulletSize": 5,
              "hideBulletsCount": 50,
              "lineThickness": 2,
              "title": "red line",
              "useLineColorForBulletBorder": true,
              "valueField": "value",
              "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
          }],
          "chartScrollbar": {
              "graph": "g1",
              "oppositeAxis":false,
              "offset":30,
              "scrollbarHeight": 80,
              "backgroundAlpha": 0,
              "selectedBackgroundAlpha": 0.1,
              "selectedBackgroundColor": "#888888",
              "graphFillAlpha": 0,
              "graphLineAlpha": 0.5,
              "selectedGraphFillAlpha": 0,
              "selectedGraphLineAlpha": 1,
              "autoGridCount":true,
              "color":"#AAAAAA"
          },
          "chartCursor": {
              "pan": true,
              "valueLineEnabled": true,
              "valueLineBalloonEnabled": true,
              "cursorAlpha":1,
              "cursorColor":"#258cbb",
              "limitToGraph":"g1",
              "valueLineAlpha":0.2,
              "valueZoomable":true
          },
          "valueScrollbar":{
            "oppositeAxis":false,
            "offset":50,
            "scrollbarHeight":10
          },
          "categoryField": "date",
          "categoryAxis": {
              "parseDates": true,
              "dashLength": 1,
              "minorGridEnabled": true
          },
          "export": {
              "enabled": true
          },
          "dataProvider": datos
      });

      chart.addListener("rendered", zoomChart);

      zoomChart();

      function zoomChart() {
          chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
      }
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
              if(response.pacientes){
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
              
            }
          });
          
        }
        
        
        

    }

}