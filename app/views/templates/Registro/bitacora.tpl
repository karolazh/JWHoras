<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<form id="form">
    <section class="content">
        <!-- CARO -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                    Datos del Paciente
            </div>
            
            <div class="panel-body">
                
                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">RUT/RUN/Pasaporte : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$run}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Nombres : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$nombres}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fecha Nacimiento : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$fecha_nac}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Edad : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$edad}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">G&eacute;nero : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$genero}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Estado Caso : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$estado}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Previsi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$prevision}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Grupo : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$grupo}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Direcci&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$direccion}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fono : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$fono}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Celular : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$celular}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">E-mail : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$email}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Comuna : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$comuna}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Provincia : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$provincia}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Regi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$region}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fecha Registro : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$fecha_reg}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Reconoce: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$reconoce}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Acepta Programa : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$acepta}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
          
            </div>
                        
            <div class="top-spaced"></div>
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel panel-primary">
            <div class="top-spaced"></div>
            
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#historial">HISTORIAL</a></li>
                    <li><a data-toggle="tab" href="#bitacora">BIT&Aacute;CORA</a></li>
                    <li><a data-toggle="tab" href="#empa">EMPA</a></li>
                    <li><a data-toggle="tab" href="#consultas">MOTIVO DE CONSULTA</a></li>
                    <li><a data-toggle="tab" href="#documentos">DOCUMENTOS</a></li>
                    <li><a data-toggle="tab" href="#adjuntos">ADJUNTOS</a></li>
                    <li><a data-toggle="tab" href="#examenes">EX&Aacute;MENES</a></li>
                </ul>

                <div class="tab-content">

                    <!-- HISTORIAL -->
                    <div id="historial" class="tab-pane fade in active">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaHistorial.tpl'}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BITACORA -->
                    <div id="bitacora" class="tab-pane fade">
                        <div class="box-body">
                            <div class="col-md-12">
                                <br>
                                <div class="btn-group">
                                    <button type="button" id="aceptar" onclick="habilitar()"
                                            class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo comentario
                                    </button>
                                </div>

                                <div class="form-group">
                                    <section class="content-header" >
                                        <form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
                                            <input type="hidden" name="idreg" id="idreg" value="{$idreg}" >
                                            <div id="seccionComentario" style="display:none">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Tipo de evento</label>
                                                                <select for="tipoEv" class="form-control" id="tipoEv" 
                                                                        name="tipoEv" onblur="validarVacio(this,'Seleccione Tipo de evento')">
                                                                    <option value="0">Seleccione Tipo de Evento</option>
                                                                    {foreach $arrTipoEvento as $tipoeve}
                                                                            <option value="{$tipoeve->id_evento_tipo}">
                                                                                {$tipoeve->gl_nombre_evento_tipo}
                                                                            </option>
                                                                    {/foreach}
                                                                </select>
                                                                <span class="help-block hidden fa fa-warning"></span>

                                                                <br>
                                                                <label for="nuevo_comentario" class="control-label">Nuevo Comentario</label>
                                                                <textarea class="form-control" name="nuevo_comentario" id="nuevo_comentario" 
                                                                    style="resize:none" rows="10">
                                                                </textarea>
                                                                <br>
                                                            </div>

                                                            <div class="btn-group">
                                                                <div id="div_tabla" class="table-responsive small"> 
                                                                    <button type="button" class="form-control btn btn-success" 
                                                                            onclick="Comentario.guardarComentario(this.form, this)">Guardar</button>
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
                    </div>

                    <!-- EMPA  -->
                    <div id="empa" class="tab-pane fade">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaEmpa.tpl'}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    
                    <!-- MOTIVO DE CONSULTA -->
                    <div id="consultas" class="tab-pane fade">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaConsultas.tpl'}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- DOCUMENTOS -->
                    <div id="documentos" class="tab-pane fade">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaAdjuntos.tpl'}
                                </div>
                            </div>
                        </div>
                    </div>
                                
                    <!-- ADJUNTOS -->
                    <div id="adjuntos" class="tab-pane fade">
                        <div class="box-body">
                            <br>
                            <div class="col-md-12">
                                <div class="btn-group">
                                    <button type="button" id="aceptar" onclick="habilitarAdjunto()"
                                            class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Adjunto
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
                                                                    <button type="button" class="form-control btn btn-success" 
                                                                            onclick="Comentario.guardarComentario(this.form, this)">Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {*<div class="top-spaced">
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

                                                            <div class="btn-group">
                                                                <div class="box-header">
                                                                    <button class="btn btn-success form-control" type="button" 
                                                                            onclick="this.form.submit()">Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>*}
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- EXÁMENES -->
                    <div id="examenes" class="tab-pane fade">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaExamenes.tpl'}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="top-spaced"></div>
            </div>
        </div>

        <div class="top-spaced"></div>
    </section>
</form>


<!--agregar un comentario desde la bitacora-->
<!--
{*<section class="content-header" >
    <h3 class="panel-title"><span class="fa fa-plus" onclick="habilitar()"> Agregar comentario</span></h3>
    <form id="form" name="form-inline" enctype="application/x-www-form-urlencoded" action="" method="post">
        <input value="{$p->id_ticket}" id="ticket" name="ticket" type="hidden">
        <div class="box box-primary" id="seccionComentario" style="display:none">
            <div class="box-header">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label">Nuevo Comentario</label>
                            <textarea class="form-control" name="nuevo_comentario" id="nuevo_comentario" style="resize:none" rows="10"></textarea> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <div id="div_tabla" class="table-responsive small"> 
                            <button type="button" class="form-control btn btn-primary" onclick="Comentario.guardarComentario(this.form, this)">Guardar comentario</button>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>*}
-->

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

<script type="text/javascript">
    function habilitar() {
        $('#seccionComentario').toggle()
    }

    function habilitarAdjunto() {
        $('#seccionAdjunto').toggle()
    }
</script>