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
                <form class="form-horizontal" name="form-adjunto" id="form-adjunto" 
                      enctype="multipart/form-data" method="post" >
                    <input type="hidden" name="id_paciente" id="id_paciente" value="{$id_paciente}" />
                    <div id="seccionAdjunto" style="display:none">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="tipoDoc">Tipo de documento</label>
                                        <select class="form-control" id="tipoDoc" name="tipoDoc">
                                            <option value="0">Seleccione Tipo de Documento</option>
                                            {foreach $arrTipoDocumento as $tipodoc}
                                                <option value="{$tipodoc->id_adjunto_tipo}" >
                                                    {$tipodoc->gl_nombre_tipo_adjunto}
                                                </option>
                                            {/foreach}
                                        </select>

                                        <br>
                                        <label class="control-label" for="archivo">Adjuntar documento</label>
                                        <input type="file" name="archivo" id="archivo" class="form-control" >

                                        <br>
                                        <label class="control-label">Comentario (opcional)</label>
                                        <textarea style="resize:none" class="form-control" value=""
                                                  id="comentario_adjunto"
                                                  name="comentario_adjunto">
                                        </textarea>
                                        <br>
                                    </div>

                                    <div class="btn-group">
                                        <button id="" type="button" 
                                                class="btn btn-success btn-sm "
                                                onclick="Bitacora.guardarNuevoAdjunto(this.form,this)">
                                            <i class="fa fa-save"></i>&nbsp;&nbsp;Guardar
                                        </button>
                                    </div>
                                    
                                </div><!-- <div class="col-md-6"> -->
                            </div><!-- <div class="row"> -->
                        </div>
                    </div><!-- <div class="box-body"> -->
                </form>
            </section>
        </div>
    </div>
</div>