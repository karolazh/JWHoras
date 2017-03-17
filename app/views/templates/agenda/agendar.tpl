<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{$static}/template/plugins/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>

<form class="form-horizontal" name="form-agendar" id="form-agendar" method="post">
    <input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden" />
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden" />
    <input type="text" value="{$id_centro_salud}" id="id_centro_salud" name="id_centro_salud" class="hidden" />
    <input type="text" value="{$id_examen}" id="id_examen" name="id_examen" class="hidden" />
    <div class="panel-body">
        <div class="top-spaced"></div>
        {*{$id_centro_salud}*}
        <!-- TIPO DE EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Tipo de Examen</h3>
            </div>
            <div class="box-body">            
                <div class="form-group">
                    <label class="control-label required col-sm-3">Tipo de Examen</label>
                    <div class="col-sm-3">
                        <select id="examen" name="examen" for="examen" 
                                class="form-control" readonly
                                onblur="validarVacio(this, 'Por favor Seleccione un Examen')">
                            <option  value="0">Seleccione un Examen</option>
                                {foreach $arrTipoExamen as $examen}
                                    {if $id_examen == $examen->id_tipo_examen}
                                        <option  value="{$examen->id_tipo_examen}" selected="">{$examen->gl_nombre_examen}</option>
                                    {else}
                                        <option  value="{$examen->id_tipo_examen}">{$examen->gl_nombre_examen}</option>
                                    {/if}
                                {/foreach}
                        </select>
                    </div>
                </div>
            </div>
        </div>
                        
        <!-- LABORATORIOS -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Laboratorios</h3>
            </div>
            <div class="box-body">            
                <div class="form-group">
                    <label class="control-label required col-sm-3">Laboratorios</label>
                    <div class="col-sm-3">
                        <select id="laboratorio" name="laboratorio" 
                                for="laboratorio" class="form-control" readonly
                                onblur="validarVacio(this, 'Por favor Seleccione un Laboratorio')">
                            <option  value="0">Seleccione un Laboratorio</option>
                                {foreach $arrLaboratorios as $lab}
                                    <option  value="{$lab->id_laboratorio}">{$lab->gl_nombre_laboratorio}</option>
                                    {*{if $id_laboratorio == $lab->id_laboratorio}
                                        <option  value="{$lab->id_laboratorio}" selected="">{$lab->gl_nombre_laboratorio}</option>
                                    {else}
                                        <option  value="{$lab->id_laboratorio}">{$lab->gl_nombre_laboratorio}</option>
                                    {/if}*}
                                {/foreach}
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATOS TOMA DE EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Datos Toma de Examen</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label required col-sm-3">Fecha toma de examen</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control col-sm-2"                                
                               name="fc_toma" id="fc_toma"
                               {*onblur="validarVacio(this, 'Por favor Ingrese Fecha de Agenda')"*} />
                        {*<span class="help-block hidden"></span>*}
                    </div>
                    <label for="fc_nacimiento" class="control-label col-sm-2 ">Hora toma de examen</label>
					<div class="col-sm-2">
                        <input type="time" name="gl_hora_toma" id="gl_hora_toma" 
                               class="form-control" value="" 
                               {*onblur="validarVacio(this, 'Por favor Ingrese Hora de Agenda')"*} />
                        {*<span class="help-block hidden"></span>*}
                    </div>
                </div>
                {*<div class="form-group">
                    <label class="control-label required col-sm-3">Resultado examen</label>
                    <div class="col-sm-2">
                        <label><input class="gl_resultado"  type="radio" name="gl_resultado" 
                                      id="gl_resultado" value="0">NORMAL</label>
                        &nbsp;&nbsp;
                        <label><input class="gl_resultado" type="radio" name="gl_resultado" 
                                      id="gl_resultado" value="0">ALTERADO</label>
                    </div>
                </div>*}
            </div>
        </div>

         <!-- OBSERVACION -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Observaci&oacute;n</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control col-sm-10" rows="10" 
                                  id="gl_observacion_toma" name="gl_observacion_toma"
                                  placeholder="Ingrese observaci&oacute;n" style="resize: none"></textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
    </div>
                    
    <!-- BOTONERA -->
    <div class="form-group col-sm-11" align="right">
        <button type="button" id="guardar" class="btn btn-success"
                onclick="Agenda.guardarAgenda(this.form)"
                {*onclick="Laboratorio.guardarNuevoExamen(this.form,this);">*}
            <i class="fa fa-save"></i>  Guardar
        </button>
        &nbsp;
        <button type="button" id="cancelar"  class="btn btn-default" 
                onclick="xModal.close()">
            <i class="fa fa-remove"></i>  Cancelar
        </button>
    </div>
</form>