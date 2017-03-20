<form class="form-horizontal" name="form-agendar" id="form-agendar" method="post">
    <input type="text" value="{$id_paciente_examen}" id="id_paciente_examen" name="id_paciente_examen" class="hidden">
    <input type="text" value="{$id_tipo_examen}" id="id_tipo_examen" name="id_tipo_examen" class="hidden">
    <input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
    <div class="panel-body">
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
                                class="form-control" disabled>
                            <option  value="0">Seleccione un Examen</option>
                                {foreach $arrTipoExamen as $examen}
                                    {if $id_tipo_examen == $examen->id_tipo_examen}
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
                    <i class="fa fa-sticky-note"></i> Datos del Laboratorio</h3>
            </div>
            <div class="box-body">            
                <div class="form-group">
                    <label class="control-label required col-sm-3">Laboratorio</label>
                    <div class="col-sm-3">
                        <select id="laboratorio" name="laboratorio" 
                                for="laboratorio" class="form-control" disabled>
                            <option  value="0">Seleccione un Laboratorio</option>
                                {foreach $arrLaboratorios as $lab}
                                    {if $id_laboratorio == $lab->id_laboratorio}
                                        <option  value="{$lab->id_laboratorio}" selected="">{$lab->gl_nombre_laboratorio}</option>
                                    {else}
                                        <option  value="{$lab->id_laboratorio}">{$lab->gl_nombre_laboratorio}</option>
                                    {/if}
                                {/foreach}
                        </select>
                    </div>
                    <div class="col-sm-12"></div>
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">RUT persona toma examen</label>
                    <div class="col-sm-2">
                        <input type="text" name="gl_rut_toma" id="gl_rut_toma" maxlength="9" 
                               onkeyup="formateaRut(this), validaRut(this), this.value = this.value.toUpperCase()"
                               onkeypress ="return soloNumerosYK(event)" 
                               value="{$rut_lab}" class="form-control" 
                               {if $perfil == "7" or $accion == "1"}readonly{/if} />
                    </div>
                    <label class="control-label required col-sm-3">Nombre persona toma examen</label>
                    <div class="col-sm-4">
                        <input type="text" name="gl_nombre_toma" id="gl_nombre_toma" maxlength="" 
                               value="{$nombre_lab}" class="form-control"
                               {if $perfil == "7" or $accion == "1"}readonly{/if} />
                    </div>
                </div>
            </div>
        </div>

        <!-- DATOS TOMA DE EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Datos de Examen</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label required col-sm-3">Fecha toma de examen</label>
                    <!-- <div class='col-sm-2'>
                        <div class="input-group">
                                <input type='text' class="form-control datepicker col-sm-2"
                                           id='fc_toma' 
                                           name='fc_toma'
                                           />
                                <span class="help-block hidden fa fa-warning"></span>
                                <span class="input-group-addon" onClick="$('#fc_toma').focus();"><i class="fa fa-calendar" ></i></span>

                        </div>
                    </div>-->
                    <div class="col-sm-2">
                        <input type="date" class="form-control col-sm-2" 
                               name="fc_toma" id="fc_toma" value="{$fc_toma}" readonly />
                    </div>
                    <label class="control-label required col-sm-3">Fecha resultado de examen</label>
                    <!-- <div class='col-sm-2'>
                        <div class="input-group">
                                <input type='text' class="form-control datepicker col-sm-2"
                                           id='fc_resultado' 
                                           name='fc_resultado'
                                           />
                                <span class="help-block hidden fa fa-warning"></span>
                                <span class="input-group-addon" onClick="$('#fc_resultado').focus();"><i class="fa fa-calendar" ></i></span>

                        </div>
                    </div> -->
                    <div class="col-sm-2">
                        <input type="date" class="form-control col-sm-2"
                               name="fc_resultado" id="fc_resultado"  value="{$fc_resultado}"
                               {if $accion == "1"}readonly{/if} />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">Hora toma de examen</label>
                    <div class="col-sm-2">
                        <input type="time" class="form-control col-sm-2"                                
                               name="gl_hora_toma" id="gl_hora_toma" value="{$gl_hora_toma}" readonly />
                    </div>
                    <label class="control-label required col-sm-3">Folio examen</label>
                    <div class="col-sm-2">
                        <input type="text" name="gl_folio" id="gl_folio" maxlength="" 
                               onKeyPress="return soloNumeros(event)"
                               value="{$gl_folio}" placeholder="" class="form-control"
                               {if $accion == "1"}readonly{/if}/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">&nbsp;</label>
                    <div class="col-sm-2">&nbsp;</div>
                    <label class="control-label required col-sm-3">Resultado examen</label>
                    <div class="form-group col-sm-4">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {if $id_tipo_examen == "2" or $id_tipo_examen == "3" or $id_tipo_examen == "4"}
                            <label><input type="radio" name="gl_resultado" 
                                          id="gl_resultado_0" value="0" 
                                          {if $accion == "1"}readonly{/if} {$gl_resultado_0}>
                                <span class="label label-success">POSITIVO</span></label>&nbsp;&nbsp;
                            <label><input type="radio" name="gl_resultado" 
                                          id="gl_resultado_1" value="1" 
                                          {if $accion == "1"}readonly{/if} {$gl_resultado_1}>
                                <span class="label label-danger" style="color:#ffffff">NEGATIVO</span></label>
                        {else}
                            <label><input type="radio" name="gl_resultado" 
                                          id="gl_resultado_0" value="0" 
                                          {if $accion == "1"}readonly{/if} {$gl_resultado_0}>
                                <span class="label label-success">NORMAL</span></label>&nbsp;&nbsp;
                            <label><input type="radio" name="gl_resultado" 
                                          id="gl_resultado_1" value="1" 
                                          {if $accion == "1"}readonly{/if} {$gl_resultado_1}>
                                <span class="label label-danger" style="color:#ffffff">ALTERADO</span></label>
                        {/if}
                    </div>
                </div>
            </div>
        </div>

        <!-- OBSERVACIÒN EN TOMA DE EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Observaci&oacute;n</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control col-sm-10" rows="5" 
                                  id="gl_observacion_toma" name="gl_observacion_toma"
                                  placeholder="Observación en toma de examen" style="resize: none"
                                  readonly>{$gl_observacion_toma}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>

        <!-- RESULTADO DESCRIPCIÓN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Descripci&oacute;n</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control col-sm-10" rows="5" 
                                  id="gl_resultado_descripcion" name="gl_resultado_descripcion"
                                  placeholder="Indicaci&oacute;n de Resultado" style="resize: none"
                                  {if $accion == "1"}readonly{/if}>{$gl_resultado_descripcion}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>

        <!-- INDICACIONES -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Indicaciones</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control col-sm-10" rows="5" 
                                  id="gl_resultado_indicacion" name="gl_resultado_indicacion"
                                  placeholder="Indicaci&oacute;n de Resultado" style="resize: none"
                                  {if $accion == "1"}readonly{/if}>{$gl_resultado_indicacion}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>

        {if $accion == "2"}
            <!-- BOTONERA -->
            <div class="form-group col-sm-11" align="right">
                <button type="button" id="guardar" class="btn btn-success"
                        onclick="Laboratorio.guardarExamen(this.form)">
                    <i class="fa fa-save"></i>  Guardar
                </button>&nbsp;
                <button type="button" id="cancelar"  class="btn btn-default" 
                        {*onclick="deshabilitarExamen()"*}
                        onclick="xModal.close()">
                    <i class="fa fa-remove"></i>  Cancelar
                </button>
            </div>
        {/if}
    </div>
</form>