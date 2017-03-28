<form class="form-horizontal" name="form-agendar" id="form-agendar" method="post">
    <input type="text" value="{$id_paciente_examen}" id="id_paciente_examen" name="id_paciente_examen" class="hidden">
    <input type="text" value="{$id_tipo_examen}" id="id_tipo_examen" name="id_tipo_examen" class="hidden">
    <input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
    <div class="panel-body">
		
        <!-- DATOS DEL EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Datos del Examen</h3>
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
                               {if $perfil == "7" or $accion == "1" or $accion == "3"}readonly{/if} />
                    </div>
                    <label class="control-label required col-sm-3">Nombre persona toma examen</label>
                    <div class="col-sm-4">
                        <input type="text" name="gl_nombre_toma" id="gl_nombre_toma" maxlength="" 
                               value="{$nombre_lab}" class="form-control"
                               {if $perfil == "7" or $accion == "1" or $accion == "3"}readonly{/if} />
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
                    <label for="fc_toma" class="control-label col-sm-3">Fecha toma de examen</label>
                    <div class='col-sm-2'>
                        <div class="input-group">
                            <input type='text' class="form-control datepicker"
                                   id='fc_toma' 
                                   name='fc_toma'
                                   value="{$fc_toma|date_format:"%d/%m/%Y"}" 
                                   {if $accion != 3}readonly{/if} />
                            <span class="help-block hidden fa fa-warning"></span>
                            <span class="input-group-addon"><i class="fa fa-calendar" onClick="$('#fc_toma').focus();"></i></span>
                        </div>
                    </div>
                    <!--<div class="col-sm-2">
                        <input type="date" class="form-control col-sm-2" 
                               name="fc_toma" id="fc_toma" value="{$fc_toma}" readonly />
                    </div>-->
					{if $accion != 3}
                    <label for="fc_resultado" class="control-label col-sm-3">Fecha resultado de examen</label>
                    <div class='col-sm-2'>
                        <div class="input-group">
                            <input type='text' class="form-control datepicker" 
                                   id='fc_resultado' 
                                   name='fc_resultado'
                                   value="{$fc_resultado|date_format:"%d/%m/%Y"}"
                                   {if $accion == "1"}readonly{/if} />
                            <span class="help-block hidden fa fa-warning"></span>
                            <span class="input-group-addon"><i class="fa fa-calendar" onClick="$('#fc_resultado').focus();"></i></span>
                        </div>
                    </div>
					{/if}
                    <!-- <div class="col-sm-2">
                        <input type="date" class="form-control col-sm-2"
                               name="fc_resultado" id="fc_resultado"  value="{$fc_resultado}"
                               {if $accion == "1"}readonly{/if} />
                    </div> -->
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">Hora toma de examen</label>
                    <div class="col-sm-2">
                        <input type="time" class="form-control col-sm-2"                                
                               name="gl_hora_toma" id="gl_hora_toma" value="{$gl_hora_toma}" {if $accion != 3}readonly{/if} />
                    </div>
					{if $accion != 3}
                    <label class="control-label required col-sm-3">Folio examen</label>
                    <div class="col-sm-2">
                        <input type="text" name="gl_folio" id="gl_folio" maxlength="" 
                               onKeyPress="return soloNumeros(event)"
                               value="{$gl_folio}" placeholder="" class="form-control"
                               {if $accion == "1"}readonly{/if}/>
                    </div>
					{/if}
                </div>
				{if $accion != 3}
                <div class="form-group">
                    <label class="control-label required col-sm-3">&nbsp;</label>
                    <div class="col-sm-2">&nbsp;</div>
                    {if $id_tipo_examen == "1"}
                        {include file='laboratorio/inputGlicemia.tpl'}                        
                    {else}
                        {if $id_tipo_examen == "7"}
                            {include file='laboratorio/inputColesterol.tpl'}                            
                        {else}
                            {if $id_tipo_examen == "9"}
                                {include file='laboratorio/inputHipertension.tpl'}
                            {else}
                                {if $id_tipo_examen == "2" or $id_tipo_examen == "3" or $id_tipo_examen == "4"}
                                    {include file='laboratorio/selectPositivoNegativo.tpl'}
                                {else}
                                    {include file='laboratorio/selectNormalAlterado.tpl'}
                                {/if}
                            {/if}
                        {/if}
                    {/if}
                </div>
                <div class="form-group">
                    {if $id_tipo_examen == "1" or $id_tipo_examen == "7" or $id_tipo_examen == "9"}
                        <label class="control-label required col-sm-3">&nbsp;</label>
                        <div class="col-sm-2">&nbsp;</div>
                        {include file='laboratorio/selectNormalAlterado.tpl'}
                    {/if}
                </div>
            </div>
        </div>

        <!-- RESULTADO DESCRIPCIÓN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Descripci&oacute;n</h3></div>
            <div class="box-body">
				<div class="form-group">
					<label class="control-label required col-sm-3">Observación</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control col-sm-6" rows="5" 
                                  id="gl_observacion_toma" name="gl_observacion_toma"
                                  placeholder="Observación en toma de examen" style="resize: none"
                                  readonly>{$gl_observacion_toma}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">Descripción</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control col-sm-6" rows="5" 
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
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control col-sm-6" rows="5" 
                                  id="gl_resultado_indicacion" name="gl_resultado_indicacion"
                                  placeholder="Indicaci&oacute;n de Resultado" style="resize: none"
                                  {if $accion == "1"}readonly{/if}>{$gl_resultado_indicacion}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
		{/if}
        {if $accion == "2"}
            <!-- BOTONERA -->
            <div class="form-group col-sm-11" align="right">
                <button type="button" id="guardar" class="btn btn-success"
                        onclick="Laboratorio.guardarExamen(this.form)">
                    <i class="fa fa-save"></i>  Guardar
                </button>&nbsp;
                <button type="button" id="cancelar"  class="btn btn-default" 
                        onclick="xModal.close()">
                    <i class="fa fa-remove"></i>  Cancelar
                </button>
            </div>
        {/if}
		{if $accion == "3"}
            <!-- BOTONERA -->
            <div class="form-group col-sm-11" align="right">
                <button type="button" id="reagendar" class="btn btn-warning">
                    <i class="fa fa-save"></i>  ReAgendar
                </button>&nbsp;
                <button type="button" id="cancelar"  class="btn btn-default" 
                        onclick="xModal.close()">
                    <i class="fa fa-remove"></i>  Cancelar
                </button>
            </div>
        {/if}
    </div>
</form>