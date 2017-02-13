var Documento = {

    guardarNuevoDocumento: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.subsecretaria.value == 0) {
            msg_error += '- Debe seleccionar Subsecretaría<br/>';
            error = true;
        }
        if (form.tipo_documento.value == 0) {
            msg_error += '- Debe seleccionar Tipo de Documento<br/>';
            error = true;
        }
        if (form.numero_documento.value == "") {
            msg_error += '- Debe ingresar Número de Documento<br/>';
            error = true;
        }
        if (form.rut_emisor.value == "") {
            msg_error += '- Debe ingresar Rut Emisor\n';
            error = true;
        }
        if (form.centro_responsabilidad.value == 0) {
            msg_error += '- Debe seleccionar Centro de Responsabilidad<br/>';
            error = true;
        }
        if (form.fecha_oficina.value == "") {
            msg_error += '- Debe seleccionar Fecha Ingreso Oficina de Partes<br/>';
            error = true;
        }
        if (form.nombre_emisor.value == "") {
            msg_error += '- Debe ingresar Nombre de Emisor<br/>';
            error = true;
        }
        if (form.asignacion_visador.value == 0) {
            msg_error += '- Debe seleccionar Asignación de Visador<br/>';
            error = true;
        }


        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });

        } else {
            var formulario = $(form).serialize();

            $.post(BASE_URI + 'index.php/Documento/guardarNuevoDocumento', {data: formulario}, function (response) {
                if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/Documento/Nuevo';
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                });

            });
        }

    },


    rechazar: function (solicitud) {
        $("#contenedor_comentario_rechazo").show();
    },

    aprobar: function (solicitud, btn) {
        btn.disabled = true;
        $.post(BASE_URI + 'index.php/Documento/aprobarDocumento', {solicitud: solicitud}, function (response) {
            if (response.estado == true) {
                xModal.success(response.mensaje,function(){
                    Documento.cargarGrillaAsignados();
                    xModal.closeAll();
                });

            } else {
                xModal.danger(response.mensaje,function(){
                    btn.disabled = false;
                });

            }
        }, 'json').fail(function () {
            xModal.danger("Error en sistema. Intente nuevamente",function(){
                btn.disabled = false;
            });

        });
    },


    guardarRechazo: function (form, solicitud, btn) {
        btn.disabled = true;
        if (form.comentario_rechazo.value == "") {
            xModal.danger("Debe registrar un comentario");
            btn.disabled = false;
        } else {
            var comentario = form.comentario_rechazo.value;
            $.post(BASE_URI + 'index.php/Documento/guardarRechazo', {
                comentario: comentario,
                solicitud: solicitud
            }, function (response) {
                if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        Documento.cargarGrillaAsignados();
                        xModal.closeAll();
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                });

            });
        }
    },


    cargarCentrosResponsabilidad: function (subsecretaria, combo) {
        $.post(BASE_URI + 'index.php/Documento/centrosResponsabilidad', {subsecretaria: subsecretaria}, function (response) {
            var total = response.length;
            var options = '';
            for (var i = 0; i < total; i++) {
                options += '<option value="' + response[i].codigo + '">' + response[i].nombre + '</option>';
            }
            $("#" + combo).html(options).trigger('change');
        }, 'json');
    },


    initAutocompleteRutEmisor: function () {
        $("input.typeahead").typeahead({
            onSelect: function (item) {
                $("#nombre_emisor").val(item.value);
            },
            ajax: {
                url: BASE_URI + 'index.php/Documento/getEmisores',
                timeout: 250,
                displayField: "rut",
                valueField: 'nombre',
                triggerLength: 1,
                method: "post",
                loadingClass: "loading-circle",
                preDispatch: function (query) {
                    //showLoadingMask(true);
                    return {
                        search: query
                    }
                },
                preProcess: function (data) {
                    //showLoadingMask(false);
                    if (data.success === false) {
                        // Hide the list, there was some error
                        $("#nombre_emisor").val('');
                        return false;
                    }
                    // We good!
                    return data.listado;
                }
            }
        });
    },


    cargarGrillaAsignados: function () {
        $.post(BASE_URI + 'index.php/Documento/grillaAsignados', function (response) {
            $("#contenedor-grilla-asignados").html(response);
            $("#tablaPrincipal").dataTable({
                "pageLength": 10,
                "aaSorting": [],
                "language": {
                    "url": url_base + "static/js/plugins/DataTables-1.10.5/lang/es.json"
                },
                "fnDrawCallback": function (oSettings) {
                    $(this).fadeIn("slow");
                },
                dom: 'Bfrtip',
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
            });
        }, 'html');
    },


    cargarGrillaRevision: function () {
        $.post(BASE_URI + 'index.php/Documento/grillaRevision', function (response) {
            $("#contenedor-grilla-revision").html(response);
            $("#tablaPrincipal").dataTable({
                "pageLength": 10,
                "aaSorting": [],
                "language": {
                    "url": url_base + "static/js/plugins/DataTables-1.10.5/lang/es.json"
                },
                "fnDrawCallback": function (oSettings) {
                    $(this).fadeIn("slow");
                },
                dom: 'Bfrtip',
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
            });
        }, 'html');
    },


    cargarVisadores: function (cr, combo) {
        $.post(BASE_URI + 'index.php/Documento/cargarVisadores', {centro: cr}, function (response) {
            var total = response.length;
            var options = '';
            var selected = '';
            if (total == 1) {
                selected = ' selected ';
            }
            for (var i = 0; i < total; i++) {
                options += '<option value="' + response[i].id + '" ' + selected + '>' + response[i].nombre + '</option>';
            }
            $("#" + combo).html(options);
        }, 'json');
    },


    validarSoloNumeros: function (input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
            $("#mensaje_monto").html('');
        }

        else {
            $("#mensaje_monto").html('Sólo se permiten números');
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    },


    subirArchivo: function (form) {
        $(form).submit(function () {
            $.post(BASE_URI + 'index.php/Documento/cargarGrillaAdjuntos', function (response) {
                $("#lista_adjuntos").html(response);
            }, 'html');
        });
    },


    cargarGrillaAdjuntos: function (template, visador_true) {
        var visador = 0;
        if (visador_true !== undefined) {
            visador = visador_true;
        }
        $.post(BASE_URI + 'index.php/Solicitudes/cargarGrillaAdjuntos', {visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos").html(response);

            }

        }, 'html');
    },


    borrarAdjunto: function (indice, template) {
        var visador = 0;
        if (template !== undefined) {
            visador = 1;
        }
        $.post(BASE_URI + 'index.php/Documento/borrarAdjunto', {indice: indice, visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos").html(response);

            }
        }, 'html');
    },


    mostrarFolioSigfe: function () {
        $("#contenedor-folio-sigfe").show();
    },


    devengar: function (form, solicitud) {
        if (form.numero_folio.value == "" || isNaN(form.numero_folio.value)) {
            xModal.danger('Debe ingresar el número de folio correspondiente');
        } else {
            $.post(BASE_URI + 'index.php/Documento/devengarSolicitud', {
                numero: form.numero_folio.value,
                solicitud: solicitud
            }, function (response) {
                if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        Documento.cargarGrillaRevision();
                        xModal.closeAll();
                    });

                }else{
                    xModal.danger(response.mensaje);
                }
            }, 'json').fail(function () {
                xModal.danger('Error en Sistema. Intente nuevamente');
            });
        }
    },


    devolverProveedor: function (solicitud) {
        $.post(BASE_URI + 'index.php/Documento/devolverProveedor', {solicitud: solicitud}, function (response) {
            if (response.estado == true) {
                xModal.success(response.mensaje,function(){
                    Documento.cargarGrillaRevision();
                    xModal.closeAll();
                });

            }else{
                xModal.danger(response.mensaje);
            }
        }, 'json').fail(function () {
            xModal.danger('Error en Sistema. Intente nuevamente');
        });
    },


    filtrarDocumentos: function (form) {
        var dias = form.numero_dias.value;
        if (dias === undefined || dias == "") {
            xModal.danger('Debe ingresar un valor para realizar el filtro');
        } else {
            var condicion = form.condicion.value;
            $.post(BASE_URI + 'index.php/Documento/filtrarDocumentos', {
                dias: dias,
                condicion: condicion
            }, function (response) {
                $("#contenedor-grilla-asignados").html(response);
                $("#tablaPrincipal").dataTable({
                    "pageLength": 10,
                    "aaSorting": [],
                    "language": {
                        "url": url_base + "static/js/plugins/DataTables-1.10.5/lang/es.json"
                    },
                    "fnDrawCallback": function (oSettings) {
                        $(this).fadeIn("slow");
                    },
                    dom: 'Bfrtip',
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
                });
            }, 'html');
        }
    },


    cambiarVisador : function(visador,doc){
        $.post(BASE_URI + 'index.php/Documento/cambiarVisador',{visador:visador,doc:doc},function(response){
            if(response.estado == true){
                Documento.cargarGrillaTodos();
                xModal.closeAll();
            }else{
                xModal.danger(response.mensaje);
            }
        },'json').fail(function(){
            xModal.danger('Error en sistema. Intente nuevamente');
        });
    },


    cargarGrillaTodos: function () {
        $.post(BASE_URI + 'index.php/Documento/grillaTodos', function (response) {
            $("#contenedor-grilla-asignados").html(response);
            $("#tablaPrincipal").dataTable({
                "pageLength": 10,
                "aaSorting": [],
                "language": {
                    "url": url_base + "static/js/plugins/DataTables-1.10.5/lang/es.json"
                },
                "fnDrawCallback": function (oSettings) {
                    $(this).fadeIn("slow");
                },
                dom: 'Bfrtip',
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
            });
        }, 'html');
    },



// BC


    guardarNuevaBoleta: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.subsecretaria_boleta.value == 0) {
            msg_error += '- Debe seleccionar Subsecretaría<br/>';
            error = true;
        }
        if (form.tipo_boleta.value == 0) {
            msg_error += '- Debe seleccionar Tipo de boleta<br/>';
            error = true;
        }
        if (form.numero_boleta.value == "") {
            msg_error += '- Debe ingresar Número de la boleta<br/>';
            error = true;
        }
        if (form.rut_emisor.value == "") {
            msg_error += '- Debe ingresar Rut Emisor\n';
            error = true;
        }
        
        if (form.fecha_oficina_boleta.value == "") {
            msg_error += '- Debe seleccionar Fecha Ingreso Oficina de Partes<br/>';
            error = true;
        }
        if (form.nombre_emisor.value == "") {
            msg_error += '- Debe ingresar Nombre de Emisor<br/>';
            error = true;
        }
       

        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });

        } else {
            
            //return 0
            var formulario = $(form).serialize();
            //alert(BASE_URI);
            $.post(BASE_URI + 'index.php/Documento/guardarNuevaBoleta', {data: formulario}, function (response) {
                form.guardarBoleta.disabled=false
                //document.getElementById("divDetalle").style.display = "block";
                xModal.success("Boleta guardada correctamente",function(){
                    btn.disabled = false;
                    //xModal.open('index.php/Documento/detalleBoleta','Detalle de boleta',50,'adjuntar',true,280);
                });
                form.rut_emisor_boleta.disabled=true
                form.subsecretaria_boleta.disabled=true
                form.tipo_boleta.disabled=true
                form.numero_boleta.disabled=true
                //xModal.open('index.php/Documento/detalleBoleta','Detalle de boleta',50,'adjuntar',true,280);

                /*if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        //location.href = BASE_URI + 'index.php/Documento/boletas';
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }*/
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                   //alert("hasta aca")
                });

            });
        }

    },

    guardarDetalle:function  (form, btn) {
        /*
         realizar validacion formulario
         */
       
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.codigo.value == 0) {
            msg_error += '- Debe ingresar código del producto<br/>';
            error = true;
        }
        if (form.glosa.value == 0) {
            msg_error += '- Debe ingresar la glosa<br/>';
            error = true;
        }
        if (form.cantidad.value == "") {
            msg_error += '- Debe ingresar la cantidad<br/>';
            error = true;
        }
        if (form.precio.value == "") {
            msg_error += '- Debe ingresar el precio\n';
            error = true;
        }
        //alert(BASE_URI)
        //return 0
        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
        } else {
            
            //return 0
            var formulario = $(form).serialize();
            //alert(BASE_URI);
            $.post(BASE_URI + 'index.php/Documento/guardarDetalleBoleta', {data: formulario}, function (response) {
                //form.guardarBoleta.disabled=false
                //document.getElementById("divDetalle").style.display = "block";
                xModal.success("Detalle guardado correctamente",function(){
                    btn.disabled = false;
                });
                /*form.rut_emisor_boleta.disabled=true
                form.subsecretaria_boleta.disabled=true
                form.tipo_boleta.disabled=true
                form.numero_boleta.disabled=true*/

                /*if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        //location.href = BASE_URI + 'index.php/Documento/boletas';
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }*/
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                   //alert("hasta aca")
                });

            });
        }
    },

     guardarNuevoPerfil: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.nombre_perfil.value == 0) {
            msg_error += '- Debe ingresar el nombre del perfil<br/>';
            error = true;
        }
        if (form.descripcion.value == 0) {
            msg_error += '- Debe ingresar la descripción del perfil<br/>';
            error = true;
        }
              

        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
            //return 0
        } else {
            
            //return 0
            var formulario = $(form).serialize();
            //alert(BASE_URI);
            $.post(BASE_URI + 'index.php/Perfiles/guardarNuevoPerfil', {data: formulario}, function (response) {
                form.guardarBoleta.disabled=false
                //document.getElementById("divDetalle").style.display = "block";
                xModal.success("Perfil guardado correctamente",function(){
                    btn.disabled = false;
                    //xModal.open('index.php/Documento/detalleBoleta','Detalle de boleta',50,'adjuntar',true,280);
                });
                /*form.rut_emisor_boleta.disabled=true
                form.subsecretaria_boleta.disabled=true
                form.tipo_boleta.disabled=true
                form.numero_boleta.disabled=true*/
                //xModal.open('index.php/Documento/detalleBoleta','Detalle de boleta',50,'adjuntar',true,280);

                /*if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        //location.href = BASE_URI + 'index.php/Documento/boletas';
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }*/
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                   //alert("hasta aca")
                });

            });
        }
    }


   
}