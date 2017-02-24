<div class="box-body">
    <br>
    <div class="col-md-12">
        <div class="btn-group">
            <button type="button" id="aceptar" onclick="habilitarAdjunto()"
                    class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Adjuntar Archivo
            </button>
        </div>

        <div class="form-group">
            <section class="content-header" >
                <form id="form" role="form" name="form-inline" enctype="multipart/form-data" 
                      action="{$smarty.const.BASE_URI}/Solicitudes/guardarNuevoAdjunto" method="post">
                    <input type="hidden" name="idreg" id="idreg" value="{$idreg}" >
                    <div id="seccionAdjunto" style="display:none">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tipo de documento</label>
                                        <select for="tipoDoc" class="form-control" id="tipoDoc" name="tipoDoc" 
                                                onblur="validarVacio(this,'Seleccione Tipo de documento')">
                                            <option value="0">Seleccione Tipo de Documento</option>
                                            {foreach $arrTipoDocumento as $tipodoc}
                                                    <option value="{$tipodoc->id_tipo_adjunto}" >
                                                        {$tipodoc->gl_nombre_tipo_adjunto}
                                                    </option>
                                            {/foreach}
                                        </select>
                                        <span class="help-block hidden fa fa-warning"></span>

                                        <br>
                                        <label class="control-label">Adjuntar documento</label>
                                        <input type="file" name="archivo" id="archivo" class="form-control"/>

                                        <br>
                                        <label class="control-label">Comentario (opcional)</label>
                                        <textarea style="resize:none" class="form-control" 
                                                  id="comentario_adjunto" 
                                                  name="comentario_adjunto">
                                        </textarea>
                                        <br>
                                    </div>

                                    <div class="btn-group">
                                        <div id="div_tabla" class="table-responsive small">
                                            <button id="guardarArchivo" type="button" 
                                                    class="btn btn-success btn-sm " 
                                                    onclick="this.form.submit()">
                                                <i class="fa fa-save"></i>&nbsp;&nbsp;Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
                    
<!--agregar un adjunto (! version) desde la bitacora-->
<!--
{*<section class="content-header" >
    <h3 class="panel-title"><span class="fa fa-plus" onclick="habilitarAdjunto()"> Agregar adjunto</span></h3>
    <form id="form" role="form" name="form-inline" enctype="multipart/form-data" action="{$smarty.const.BASE_URI}/Solicitudes/guardarNuevoAdjunto" method="post">
        <input value="{$p->id_ticket}" id="ticket" name="ticket" type="hidden">
        <div class="box box-primary" id="seccionAdjunto" style="display:none">
            <div class="top-spaced">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="box-header">
                                Adjuntar nuevo archivo
                                <input type="file" name="archivo" id="archivo" class="form-control"/>
                                <input type="hidden" value="{$p->id_ticket}" name="id_ticket" id="id_ticket">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-header">
                                Comentario (opcional)
                                <textarea style="resize:none" class="form-control" id="comentario_adjunto" name="comentario_adjunto"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="box-header">
                            <button class="btn btn-primary form-control" type="button" onclick="this.form.submit()">Guardar adjunto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>*}
-->