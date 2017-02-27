
var Home = {


    graficoEstadosNacional : function(data){
        
        var datos = [];
        $.each(data, function(i, value){
          var item = {'estado' : value.nombre, 'total' : parseInt(value.total)};
          datos.push(item);
        });
        var chart = AmCharts.makeChart( "grafico_estados_general", {
          "type": "pie",
          "theme": "light",
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
    }

}