function detalle(id) {
    $('.modal-body').html("CARGANDO DATOS...Tardaré un par de segundos");
    $('.modal-body').load("index.php/Instalacion/detalleInstalacion/" + id, function () {
        $('#myModal').modal('show');
    });
    $(".dataTable").DataTable();
}


$(document).ready(function () {

    $('#myModal').on('shown.bs.modal', function (e) {


        var map;

        function initialize() {

            var Lat = $("#txtLatitud").val();
            var Lng = $("#txtLongitud").val();

            var myLatlng = new google.maps.LatLng(Lat, Lng);
            var mapOptions = {
                zoom: 17,
                center: myLatlng
            }
            var map = new google.maps.Map(document.getElementById('mapa_ubicacion'), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Instalación'
            })
        }

        initialize();
    });


    $('#botones_tipo_busqueda_volver').on('click', function (e) {
        $("#botones_tipo_busqueda").slideDown("slow");
        $("#botones_tipo_busqueda_volver").hide("slow");
    });

    //Control de paneles

    $('#region').on('change', function (e) {
        $('#id_comuna').load("index.php/Comuna/listaComuna/" + $(this).val());
    });

    $('#panel_rut').on('click', function (e) {
        $("#botones_tipo_busqueda_volver").show("slow");
        $("#botones_tipo_busqueda").slideUp("slow");

        $(".div_busqueda").hide();
        $("#div_resultado").show();
        $("#div_rut").show();
    });

    $('#panel_mapa').on('click', function (e) {
        $("#botones_tipo_busqueda_volver").show("slow");
        $("#botones_tipo_busqueda").slideUp("slow");

        $("#div_resultado").empty();

        $(".div_busqueda").hide(0, function () {
            $("#div_mapa").show();
        });
    });

    $('#panel_direccion').on('click', function (e) {

        $("#botones_tipo_busqueda_volver").show("slow");
        $("#botones_tipo_busqueda").slideUp("slow");

        $("#div_resultado").empty();

        $(".div_busqueda").hide(0, function () {
            $("#div_direccion").show();
        });
    });

    //Fin control de paneles

    $('#btn_rut').on('click', function (e) {

        var error = "";

        if ($("#rut").val() == "") {
            error = "- Debe ingresar un rut\n"
        }

        if (error == "") {
            $.post("index.php/Home/buscarRut/", $("#form_buscar").serialize(), function (response) {
                $('#div_resultado').html(response);
                $('#tablaPrincipal').DataTable();
                $("#div_resultado").show();
            });

        } else {
            alert("Por favor revisar: \n\n" + error);
        }


        $("#div_resultado").show();
    });

    $('#btn_direccion').on('click', function (e) {

        var error = "";

        if ($("#region").val() == "") {
            error = "- Debe seleccionar una región\n"
        }

        /*
         if($("#id_comuna").val() == "" || $("#id_comuna").val() == null){
         error = error + "- Debe seleccionar una comuna\n"
         }
         */
        /*
         if($("#gl_calle").val() == "" 	){
         error = error + "- Debe ingresar una calle\n"
         }
         */
        /*
         if($("#nr_numero").val() == "" 	){
         error = error + "- Debe ingresar un número\n"
         }
         */
        if (error == "") {
            $.post("../../index.php/Home/buscarDireccion/", $("#form_buscar").serialize(), function (response) {
                $('#div_resultado').html(response);
                $("#tablaPrincipal").DataTable(
                    {
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                title: 'listado_de_instalaciones',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            },
                            'colvis'

                        ],
                        language: {
                            buttons: {
                                colvis: 'Columnas'
                            }
                        }
                    }
                );

                $("#div_resultado").show();
            });

        } else {
            alert("Por favor revisar: \n\n" + error);
        }
    });


    $(".panel").hover(
        function () {
            $(this).find(".card").flip(true);
        }, function () {
            $(this).find(".card").flip(false);
        }
    );

    /*$(".card").flip({
        trigger: 'manual',
        axis: 'y',
        reverse: true
    });*/


    /*var ctx = $("#graficoB").get(0).getContext("2d");
     var data = {
     labels: ["January", "February", "March", "April", "May", "June", "July"],
     datasets: [
     {
     label: "My First dataset",
     fillColor: "rgba(220,220,220,0.5)",
     strokeColor: "rgba(220,220,220,0.8)",
     highlightFill: "rgba(220,220,220,0.75)",
     highlightStroke: "rgba(220,220,220,1)",
     data: [65, 59, 80, 81, 56, 55, 40]
     },
     {
     label: "My Second dataset",
     fillColor: "rgba(151,187,205,0.5)",
     strokeColor: "rgba(151,187,205,0.8)",
     highlightFill: "rgba(151,187,205,0.75)",
     highlightStroke: "rgba(151,187,205,1)",
     data: [28, 48, 40, 19, 86, 27, 90]
     }
     ]
     };
     var myBarChart = new Chart(ctx).Bar(data,{responsive: true});*/


});


var Home = {

    graficoEstados: function (data) {
        var ctx = $("#graficoA").get(0).getContext("2d");

            ctx.canvas.width = 1000;
            ctx.canvas.height = 1000;

            var options = {
                segmentShowStroke : true,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 0,
                percentageInnerCutout : 0, // This is 0 for Pie charts
                animationSteps : 100,
                animationEasing : "easeOutBounce",
                animateRotate : true,
                animateScale : false,
            	responsive: true,		
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label + ' (' + segments[i].value+')'%><%}%></li><%}%></ul>"

            };
		
        // For a pie chart
        // For a pie chart
        var data = [
            {
                value: data.creadas,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "Creada"
            },
            {
                value: data.recibidas,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Recibida"
            },
            {
                value: data.desarrollo,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "En desarrollo"
            },
            {
                value: data.finalizadas,
                color: "#41a5e0",
                highlight: "#69bbea",
                label: "Finalizada"
            },
            {
                value: data.derivadas,
                color: "#1f9651",
                highlight: "#3bba70",
                label: "Derivada"
            },
            {
                value: data.archivadas,
                color: "#FF4000",
                highlight: "#FE642E",
                label: "Archivada"
            }

        ];
        var myPieChart = new Chart(ctx).Pie(data, options);

		var legend = myPieChart.generateLegend();
		$("#graficoA_legend").html(legend);

    },

    graficoEstados1: function (data) {
        var ctx = $("#graficoB").get(0).getContext("2d");

        ctx.canvas.width = 1000;
        ctx.canvas.height = 1000;

        var options = {
            segmentShowStroke : true,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 0,
            percentageInnerCutout : 0, // This is 0 for Pie charts
            animationSteps : 100,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : false,
            responsive: true,       
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label + ' (' + segments[i].value+')'%><%}%></li><%}%></ul>"

        };
        
        // For a pie chart
        // For a pie chart
        var data = [
            {
                value: data.cero_ocho,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "0 a 8 días"
            },
            {
                value: data.nueve_quince,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "9 a 15 días"
            },
            {
                value: data.dieciseis_treinta,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "16 a 30 días"
            },
            {
                value: data.treinta_mas,
                color: "#41a5e0",
                highlight: "#69bbea",
                label: "+ 30 días"
            }

        ];
        var myPieChart = new Chart(ctx).Pie(data, options);

        var legend = myPieChart.generateLegend();
        $("#graficoB_legend").html(legend);

    },



    graficoRangos : function(data){
        var ctx2 = $("#graficoB").get(0).getContext("2d");

        ctx2.canvas.width = 1000;
        ctx2.canvas.height = 1000;

        var options = {
            segmentShowStroke : true,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 0,
            percentageInnerCutout : 0, // This is 0 for Pie charts
            animationSteps : 100,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : false,
            responsive: true,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label + ' (' + segments[i].value+')'%><%}%></li><%}%></ul>"

        };

        // For a pie chart
        // For a pie chart
        var data = [
            {
                value: data.cero_ocho,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "0 a 8 días"
            },
            {
                value: data.nueve_quince,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "9 a 15 días"
            },
            {
                value: data.dieciseis_treinta,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "16 a 30 días"
            },
            {
                value: data.treinta_mas,
                color: "#41a5e0",
                highlight: "#69bbea",
                label: "+30 días"
            }
        ];
        var myPieChart2 = new Chart(ctx2).Pie(data, options);

        var legend = myPieChart2.generateLegend();
        $("#graficoB_legend").html(legend);
    }
}


