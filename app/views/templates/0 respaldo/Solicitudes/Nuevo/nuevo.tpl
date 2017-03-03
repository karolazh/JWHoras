<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<section class="content-header">
    <h1>Nuevo Registro
        <small>Ingresar nueva solicitud</small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Formulario de Registro</h3>
        </div>
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

                        <div class="form-group">
                            <label  class="col-lg-4 control-label">Proyecto</label>
                            <div class="col-lg-8">
                               <select class="form-control" id="id_proyecto" name="id_proyecto">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$lista_proyectos item=item}
                                        <option value="{$item->id_proyecto}">{$item->gl_nombre_proyecto}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-4 control-label">Asunto</label>
                            <div class="col-lg-8">
                                <input class="form-control" name="nombre" id="nombre" placeholder="Ingrese asunto"> </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha de entrega</label>
                            <div class="col-md-3 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" readonly
                                           style="border-radius: 0" id="fc_fecha_entrega"
                                           name="fc_fecha_entrega"
                                           placeholder="">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Prioridad</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="id_prioridad" name="id_prioridad">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$prioridad item=item}
                                        <option value="{$item->id}">{$item->gl_descripcion}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="col-lg-4 control-label">Asignar a</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="cd_id_usuario" name="cd_id_usuario">
                                    <option value="0">-- Seleccione --</option>
                                    {foreach from=$trabajadores item=item}
                                        <option value="{$item->id}">{$item->nombres} {$item->apellidos}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row top-spaced margin-bottom-10">
                    <div class="col-xs-12 top-spaced">

                        <div class="form-group">
                            <label for="exampleInputEmail1"
                                   class="col-xs-12  col-md-2 control-label">Comentario</label>
                            <div class="col-xs-12 col-md-10">
                                <textarea class="form-control form-control-textarea" name="gl_comentario" id="gl_comentario"
                                          rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="top-spaced">

                    <div class="box box-info">
                        <div class="box-header">
                            Archivos adjuntos
                            <button type="button" class="btn btn-success btn-xs btn-flat"
                                    onClick="xModal.open('{$smarty.const.BASE_URI}/Solicitudes/adjuntarArchivo','Adjuntar Archivos',50,'adjuntar',true,280);">
                                <i class="fa fa-upload"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" id="lista_adjuntos"></div>
                        </div>
                    </div>
                </div>


                <div class="margin-bottom-10"></div>
                <!-- Campos carga Automatica -->
                <input  type="hidden" name="fc_fecha_creacion" id="fc_fecha_creacion" value="{$fecha_creacion_controller}"></input>
                <input  type="hidden" name="fc_fecha_termino" id="fc_fecha_termino" value="0"></input>
                <input  type="hidden" name="cd_id_estado" id="cd_id_estado" value="1"></input>
                <input  type="hidden" name="fc_fecha_diferencia" id="fc_fecha_diferencia" value="0"></input>

                <button type="button" class="btn btn-success pull-right btn-flat"
                        onclick="Solicitudes.guardarNuevaSolicitud(this.form,this);">
                    Guardar Solicitud
                </button>


            </form>
        </div>
    </div>
</section>