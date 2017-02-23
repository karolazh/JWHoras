	$(document).ajaxStart(function () {
		$("#div_cargando").fadeIn();
	});

	$(document).ajaxComplete(function () {
		$("#div_cargando").fadeOut();
	});


	$.fn.hasAttr = function (name) {
		return this.attr(name) !== undefined;
	};

	var url = window.location.pathname;
	url = url.split("index.php");
	if (url[0] !== undefined) {
		var url_base = url[0];
	} else {
		var url_base = '/';
	}

	var BASE_URI = url_base;
	var HOST = window.location.protocol + "//" + window.location.hostname;

	var tablas;

	$(document).ready(function () {
		tablas = new Array();

		$(".select2").select2();

		$("table.dataTable").DataTable({
			pageLength	: 10,
			/*sorting	: [],*/
			language	: {
							"url": url_base + "static/js/plugins/DataTables/lang/es.json"
						},
			fnDrawCallback: function (oSettings) {
				$(this).fadeIn("slow");
			},
			dom			: 'Bfrtip',
			buttons: [
				{
					extend: 'excelHtml5',
					text: 'Exportar a Excel',
					filename: 'Grilla',
					exportOptions: {
						modifier: {
							page: 'all'
						}
					}
				}
			]
			/*dom: 'Bfrtip',
			buttons: [
				'excelHtml5'
			]*/
		});


		/*$(".datepicker").datepicker({
			dateFormat: 'dd/mm/yy'
		});
	*/

		//called when key is pressed in textbox
		$(".numbers").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});


		// se inician tablas
		/*$("table.dataTable").livequery(function () {
			;
			if ($(this).parent().hasAttr('data-row')) {
				var filas = parseInt($(this).parent().attr("data-row"));
			} else {
				var filas = 10;
			}

		   var id = $(this).attr("id");
			$(".dataTable.paginada").DataTable({
				"pageLength": filas,
				"aaSorting": [],
				"language": {
					"url": url_base + "static/js/plugins/DataTables-1.10.5/lang/es.json"
				},
				"fnDrawCallback": function (oSettings) {
					$(this).fadeIn("slow");
				},
				"dom": 'Bfrtip',
				"buttons": [
					'excelHtml5'
				]
			});

		});*/

		//$(".rut").mask('000000000-A', {reverse: true});


	});

	$(window).load(function () {
		$("#contenido").fadeIn("slow");
		//$( ".div-contenido-cargando").hide();
	});

	/**
	 * Boquea el boton despues de hacer click
	 * @param {type} boton
	 * @param {type} e
	 * @returns {buttonStartProcess.retorno}
	 */
	function buttonStartProcess(boton, e) {
		e.preventDefault();
		$(boton).prop('disabled', true);

		var clase_boton = $(boton).children("i").attr("class");
		$(boton).children("i").attr("class", "fa fa-refresh fa-spin");

		var retorno = {"boton": boton, "clase": clase_boton};
		
		return retorno;
		alert("SI LLEGA")
	}

	/**
	 * Desbloquea el boton
	 * @param {type} retorno
	 * @returns {undefined}
	 */
	function buttonEndProcess(retorno) {
		$(retorno.boton).prop('disabled', false);
		$(retorno.boton).children("i").attr("class", retorno.clase);
	}

	/**
	 * Procesa errores en llamadas ajax
	 * @returns {undefined}
	 */
	function errorAjax() {
		// procesar error
	}

	/**
	 * Procesa los errores en la validacion de formularios
	 * Ilumina los input con error
	 * @param {type} errores
	 * @returns {undefined}
	 */
	function procesaErrores(errores) {
		$.each(errores, function (i, valor) {
			var parent = getFormParent($("#" + i).parent(), 1);

			if (parent != null) {
				if (valor != "") {
					$(parent).addClass("has-error");
					$(parent).children(".help-block").removeClass("hidden");
					$(parent).children(".help-block").html("<i class=\"fa fa-warning\"></i> " + valor);
				} else {
					$(parent).removeClass("has-error");
					$(parent).children(".help-block").addClass("hidden");
				}
			}
		});
	}

	function limpiaErrores(errores) {
		$.each(errores, function (i) {
			var parent = getFormParent($("#" + i).parent(), 1);

			if (parent != null) {
					$(parent).removeClass("has-error");
					$(parent).children(".help-block").addClass("hidden");
					$(parent).children(".help-block").html("");
			}
		});
	}


	function getFormParent(parent, intento) {
		if (intento > 4) {
			return null;
		} else {
			if ($(parent).hasClass("form-group")) {
				return parent;
			} else {
				return getFormParent($(parent).parent(), intento + 1);
			}
		}
	}

	/**
	 * Oculta un div con el efecto Fade
	 * @param {type} div
	 * @returns {undefined}
	 */
	function ocultarConFade(div) {
		$("#" + div).stop().animate({opacity: 0.05}, 3000, function () {
			$("#" + div).hide();
			$("#" + div).css("opacity", 1);
		});
	}

	function colorbox(url) {


		$().colorbox({
			iframe: true,
			href: url,
			width: "90%",
			height: "90%"
		});
	}

	function colorbox_upload(url) {


		$().colorbox({
			iframe: true,
			href: url,
			width: "50%",
			height: "50%"
		});
	}

	$(".infoTip").livequery(function(){
		var titulo	= 'Explicación de la Funcionalidad';
		var texto	= '';
        var pos = '';

		if($(this).attr("data-titulo") != "" && $(this).attr("data-titulo") != "undefined"){
            titulo = $(this).attr("data-titulo");
        }
		if($(this).attr("data-texto") != "" && $(this).attr("data-texto") != "undefined"){
            texto = $(this).attr("data-texto");
        }
		
        var auxPos = $(this).attr("data-pos");
        if(auxPos == "pull-right")
        {
            var pos = "top right";
        }
        else
        {
            var pos = "top left";
        }

		$(this).qtip({
			show	: 'click',
			hide	: 'click',
			content	: {
						button	: true,
						title	: titulo,
						text	: texto
					},
          position: {
                     my: pos, 
                     at: 'bottom left'
                },
			events	: {
						render: function(event, api) {
							var elem = api.elements.overlay;
						}
					}
		});
	});

	//datatable con Funcionalidad de Elegir Columnas a Exportar, Titulo del archivo
    $(".datatable.paginada").livequery(function(){
        
        if($(this).parent().hasAttr('data-row')) {
            var filas = parseInt($(this).parent().attr("data-row"));
        } else {
            var filas = 10;
        }
        
        var id			= $(this).attr("id");
		var columnas	= ':visible';
		var titulo		= 'Prevencion_de_Femicidios';
        var buttons		= [];

		if($(this).hasAttr('data-exportar')) {
            columnas	= $(this).attr("data-exportar");
        }
		if($(this).hasAttr('data-titulo')) {
            titulo		+= ' - '+$(this).attr("data-titulo");
        }

		buttons	= [
					{
						extend	: 'excelHtml5',
						title	: titulo,
						exportOptions: {
							columns: [columnas]
						}
					},
					{
						extend	: 'pdfHtml5',
						title	: titulo,
						exportOptions: {
							columns: [columnas]
						}
					}
				];

        var tb = $(this).DataTable({
            "lengthMenu"	: [[5,10, 20, 25, 50, 100], [5, 10, 20, 25, 50, 100]],
            "pageLength"	: filas,
            "destroy"		: true,
            "aaSorting"		: [],
            "deferRender"	: true,
            dom				: 'Bfrtip',
            buttons			: buttons,
            language		: {
								"url": url_base + "static/js/plugins/DataTables/lang/es.json"
							 },
            "fnDrawCallback": function( oSettings ) {
                $("#" + id).removeClass("hidden");
             }
        });
    });

    //boton para exportar tabla a excel
    $(".buttons-excel").livequery(function(){
       $(this).html("<i class=\"fa fa-download\"></i> Exportar a EXCEL");
       $(this).removeClass("dt-button");
       $(this).addClass("btn btn-primary btn-xs");
    });
    
    $(".buttons-pdf").livequery(function(){
       $(this).html("<i class=\"fa fa-file-pdf-o\"></i> EXPORTAR a PDF");
       $(this).removeClass("dt-button");
       $(this).addClass("btn btn-success btn-xs");
    });
    
    $(".buttons-print").livequery(function(){
       $(this).html("<i class=\"fa fa-print\"></i> Imprimir");
       $(this).removeClass("dt-button");
       $(this).addClass("btn btn-default btn-xs");
    });

