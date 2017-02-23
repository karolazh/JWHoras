<div class="box-body">
    <div class="col-md-12">
        <br>
        <div class="btn-group">
            <button type="button" id="aceptar" onclick="habilitar()"
                    class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Evento
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
                                            <button id="guardarEvento" type="button" 
                                                    class="btn btn-success btn-sm " 
                                                    {*onclick="Comentario.guardarComentario(this.form, this)"*}
                                                    >
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