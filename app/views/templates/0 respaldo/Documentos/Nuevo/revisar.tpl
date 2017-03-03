<div class="box box-success">
    <div class="box-body">
        <form role="form" class="form-horizontal">

                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Subsecretaria</label>
                            <div class="col-lg-8">
                                <p class="form-control-static well well-sm">{$solicitud->nombre_subsecretaria}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Tipo Documento</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">{$solicitud->nombre_tipodocumento}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nro del Documento</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">{$solicitud->nr_numero_documento_solicitud}
                                </p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">RUT emisor</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">{$solicitud->gl_rut_emisor_solicitud}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nro.Orden de compra</label>
                            <div class="col-lg-8">
                                <p class="form-control-static  well well-sm">
                                    {$solicitud->nr_numero_order_compra_solicitud}</p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Centro de
                                Responsabilidad</label>
                            <div class="col-lg-8">
                                <p class="form-control-static well well-sm">{$solicitud->nombre_centroresponsabilidad}
                                </p>

                            </div>
                        </div>


                    </div>

                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha ingreso a Oficina de
                                partes</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">
                                    {Fechas::formatearHtml($solicitud->fc_fecha_ingreso_partes_solicitud)}
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">ID registro en SIGFE</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">{$solicitud->gl_id_registro_sigfe_solicitud}
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Tipo de compra</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">{$solicitud->nombre_tipocompra}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre Emisor</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">{$solicitud->gl_nombre_emisor_solicitud}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Subtitulo
                                Presupuestario</label>
                            <div class="col-lg-7">
                                <p class="form-control-static well well-sm">
                                    {$solicitud->cd_subtitulo_presupuestario_solicitud}</p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Asignación de visador</label>
                            <div class="col-lg-7">
                                {if $visadores and $smarty.session.perfil == 1}
                                    <div class="input-group">
                                        <select class="form-control" name="visador" id="visador">
                                            {foreach from=$visadores item=item}
                                                <option value="{$item->id}" {if $item->id == $solicitud->cd_asignacion_visador_solicitud} selected {/if}>{$item->nombres} {$item->apellidos}</option>
                                            {/foreach}
                                        </select>
                                        <div class="input-group-button">
                                            <button type="button" class="btn btn-flat btn-primary" onclick="parent.Documento.cambiarVisador(this.form.visador.value,{$solicitud->id_solicitud});">Cambiar</button>
                                        </div>
                                    </div>

                                {else}
                                    <p class="form-control-static well well-sm">
                                        {$solicitud->nombres} {$solicitud->apellidos}</p>
                                {/if}


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Monto ($)</label>
                            <div class="col-lg-7">
                                <p class="form-control-static  well well-sm">
                                    {number_format($solicitud->nr_monto_solicitud,0,',','.')}</p>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Número Folio SIGFE</label>
                            <div class="col-lg-7">
                                <p class="form-control-static  well well-sm">{$solicitud->nr_folio_sigfe_solicitud}</p>


                            </div>
                        </div>


                    </div>


                </div>

                <div class="row top-spaced margin-bottom-10">
                    <div class="col-md-12 col-xs-12 top-spaced">

                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-md-2 control-label">Descripción</label>
                            <div class="col-md-10 col-xs-12">
                                <p class="form-control-static  well well-sm">{$solicitud->gl_descripcion_solicitud}</p>
                            </div>
                        </div>
                    </div>

                    {if $solicitud->gl_comentario_rechazo != ""}
                        <div class="col-md-12 col-xs-12 top-spaced">

                            <div class="margin-bottom-10"></div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-lg-2 control-label">Comentario de Rechazo</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static  well well-sm">{$solicitud->gl_comentario_rechazo}</p>
                                </div>
                            </div>
                        </div>
                    {/if}


                    <div class="col-md-12 col-xs-12 top-spaced">

                        {if $smarty.session.perfil == 2 and $solicitud->cd_estado_solicitud == 0}
                            {if !isset($lectura)}
                                <iframe src="{$smarty.const.BASE_URI}/Documento/adjuntarArchivo/{$solicitud->id_solicitud}" frameborder="none" class="col-xs-12"></iframe>
                            {/if}
                        {/if}
                        <label class="col-xs-12">Adjuntos

                        </label>
                        <div class="col-xs-12" id="lista_adjuntos">
                            {include file="Documentos/Nuevo/grilla_adjuntos.tpl"}
                        </div>
                    </div>

                </div>


                {if $usuario == $solicitud->cd_asignacion_visador_solicitud}
                    {if $solicitud->cd_estado_solicitud == 2}
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="well">
                                    <label>Comentario Rechazo
                                        ({Fechas::formatearHtml($solicitud->fc_fecha_cambio_estado)})</label>
                                    <p>{$solicitud->gl_comentario_rechazo}</p>
                                </div>
                            </div>
                        </div>
                    {/if}
                    <div class="margin-bottom-10"></div>
                    {if !isset($lectura)}
                        {if $solicitud->cd_estado_solicitud == 0}
                            <div class="text-center">
                                <button type="button" class="btn btn-flat btn-success" onclick="parent.Documento.aprobar({$solicitud->id_solicitud},this);">
                                    Aprobar
                                </button>
                                <button type="button" class="btn btn-flat btn-danger" onclick="document.getElementById('contenedor_comentario_rechazo').style.display='block';">
                                    Rechazar
                                </button>
                            </div>
                        {/if}
                    {/if}
                {/if}


                <!-- <button type="button" class="btn btn-flat btn-success pull-right" onclick="Documento.guardarNuevoDocumento(this.form,this);">Guardar documento</button> -->



        </form>
        {if !isset($lectura)}
            {if $solicitud->cd_estado_solicitud == 0}
                <div class="col-xs-12 " id="contenedor_comentario_rechazo" style="display:none">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-xs-12">Ingrese comentario de rechazo</label>
                            <div class="col-xs-12">
                                <textarea class="form-control" rows="5" name="comentario_rechazo" id="comentario_rechazo" style="height:100px !important"></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-flat btn-primary" type="button" onclick="parent.Documento.guardarRechazo(this.form,{$solicitud->id_solicitud},this);">
                                Guardar Rechazo
                            </button>
                        </div>
                    </form>
                </div>
            {/if}
        {/if}

        {if !isset($lectura)}
            {if ($solicitud->cd_estado_solicitud == 1 or $solicitud->cd_estado_solicitud == 2) and $smarty.session.perfil == 1}
                <div class="col-xs-12">
                    <div class="text-center">
                        <button type="button" class="btn btn-flat btn-primary" onclick="parent.Documento.devolverProveedor({$solicitud->id_solicitud});">
                            Devolver Proveedor
                        </button>
                        <button type="button" class="btn btn-flat btn-success" onclick="document.getElementById('contenedor_folio_sigfe').style.display='block';"
                        ">
                        Devengar
                        </button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 text-left well well-lg" id="contenedor_folio_sigfe" style="display:none">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label class="control-label">Número Folio SIGFE</label>
                            <input type="text" id="numero_folio" name="numero_folio" class="form-control"/>
                            <button class="btn btn-flat btn-warning" type="button" onclick="parent.Documento.devengar(this.form,{$solicitud->id_solicitud});">
                                Registrar como Devengado
                            </button>
                            <button type="button" class="btn btn-flat btn-primary" onclick="parent.$.colorbox.close();">Cerrar
                            </button>
                        </div>

                    </form>
                </div>
            {/if}
        {/if}


        {if $historial}
            <div class="col-md-12 col-xs-12 top-spaced">
                <label class="col-xs-12">Historial</label>
                <div class="col-xs-12">
                    {include file="Documentos/Grillas/grilla_historial.tpl"}
                </div>
            </div>
        {/if}
    </div>
</div>
