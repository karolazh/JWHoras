<div class="panel-body">
    <div class="top-spaced"></div>
    
    <!-- SI PERFIL ES LABORATORIO, NO MUESTRA COMBO -->
    {if $_SESSION['perfil'] != "7"}
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Laboratorio</h3>
            </div>
            <div class="box-body"> 
                <div class="form-group">
                    <label class="control-label required col-sm-3">Laboratorio</label>
                    <div class="col-sm-3">
                        <select id="laboratorio" for="laboratorio" class="form-control" 
                                name="laboratorio" onchange="mostrarExamenes(this.value, 'id_laboratorio')" 
                                onblur="validarVacio(this, 'Por favor Seleccione un Laboratorio')">
                            <option  value="0">Seleccione un Laboratorio</option>
                            {foreach $arrLaboratorios as $lab}
                                <option  value="{$lab->id_laboratorio}">{$lab->gl_nombre_laboratorio}</option>
                            {/foreach}
                        </select>
                        {*<span class="help-block hidden fa fa-warning"></span>*}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    <!-- TIPO DE EXAMEN -->
    <div class="box box-success">
        <div class="box-header with-border"><h3 class="box-title">
                <i class="fa fa-sticky-note"></i> Tipo de Examen</h3>
        </div>
        <div class="box-body"> 
            <div class="form-group">
                <label class="control-label required col-sm-3">Tipo de Examen</label>
                <div class="col-sm-3">
                    <select id="examen" for="examen" class="form-control" 
                            name="examen" onblur="validarVacio(this, 'Por favor Seleccione un Examen')">
                        <option  value="0">Seleccione un Examen</option>
                            {foreach $arrTipoExamen as $examen}
                                <option  value="{$examen->id_tipo_examen}">{$examen->gl_nombre_examen}</option>
                            {/foreach}
                    </select>
                    {*<span class="help-block hidden fa fa-warning"></span>*}
                </div>
            </div>
        </div>
    </div>

    <!-- DATOS TOMA DE EXAMEN -->
    <div class="box box-success">
        <div class="box-header with-border"><h3 class="box-title">
                <i class="fa fa-sticky-note"></i> Datos Toma de Examen</h3></div>
        <div class="box-body">
            <!-- SI PERFIL ES LABORATORIO, MUESTRA USUARIO X DEFECTO -->
            {if $_SESSION['perfil'] == "7"}
                <div class="form-group">
                    <label class="control-label required col-sm-3">RUT persona que toma examen</label>
                    <div class="col-sm-2">
                        <input type="text" name="gl_rut_toma" id="gl_rut_toma" maxlength="9" 
                               value="{$rut_lab}" class="form-control" readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">Nombre persona que toma examen</label>
                    <div class="col-sm-4">
                        <input type="text" name="gl_nombre_toma" id="gl_nombre_toma" maxlength="" 
                               value="{$nombre_lab}" class="form-control" readonly />
                    </div>
                </div>
            {else}
                <div class="form-group">
                    <label class="control-label required col-sm-3">RUT persona que toma examen</label>
                    <div class="col-sm-2">
                        <input type="text" name="gl_rut_toma" id="gl_rut_toma" maxlength="9" 
                               onkeyup="formateaRut(this), validaRut(this), this.value = this.value.toUpperCase()"
                               onkeypress ="return soloNumerosYK(event)"
                               value="" placeholder="" class="form-control"/>
                        {*<span class="help-block hidden"></span>*}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label required col-sm-3">Nombre persona que toma examen</label>
                    <div class="col-sm-4">
                        <input type="text" name="gl_nombre_toma" id="gl_nombre_toma" maxlength="" 
                               value="" placeholder="" class="form-control"/>
                        {*<span class="help-block hidden"></span>*}
                    </div>
                </div>
            {/if}

            <div class="form-group">
                <label class="control-label required col-sm-3">Folio examen</label>
                <div class="col-sm-2">
                    <input type="text" name="gl_folio" id="gl_folio" maxlength="" 
                           onKeyPress="return soloNumeros(event)"
                           value="" placeholder="" class="form-control"/>
                    {*<span class="help-block hidden"></span>*}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label required col-sm-3">Fecha toma de examen</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control col-sm-2" 
                           {*onblur="validarVacio(this, 'Por favor Ingrese Fecha')" *}
                           name="fc_toma" id="fc_toma">
                    <span class="help-block hidden fa fa-warning"></span>
                    {*<span class="help-block hidden"></span>*}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label required col-sm-3">Fecha resultado de examen</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control col-sm-2" 
                           {*onblur="validarVacio(this, 'Por favor Ingrese Fecha')" *}
                           name="fc_resultado" id="fc_resultado">
                    <span class="help-block hidden fa fa-warning"></span>
                    {*<span class="help-block hidden"></span>*}
                </div>
            </div>
                <div class="form-group">
                <label class="control-label required col-sm-3">Resultado examen</label>
                <div class="col-sm-2">
                    <label><input class="gl_resultado"  type="radio" name="gl_resultado" 
                                  id="gl_resultado" value="0">NORMAL</label>
                    &nbsp;&nbsp;
                    <label><input class="gl_resultado" type="radio" name="gl_resultado" 
                                  id="gl_resultado" value="0">ALTERADO</label>
                </div>
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
                    {*<label>Resultado Descripci&oacute;n</label>*}
                    <textarea type="text" class="form-control col-sm-10" rows="5" 
                              id="gl_resultado_descripcion" name="gl_resultado_descripcion"
                              placeholder="Ingrese resultado descripci&oacute;n" style="resize: none">{$gl_resultado_descripcion}</textarea>
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
                    {*<label>Indicaciones</label>*}
                    <textarea type="text" class="form-control col-sm-10" rows="5" 
                              id="gl_indicacion" name="gl_indicacion"
                              placeholder="Ingrese indicaciones" style="resize: none">{$gl_indicacion}</textarea>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>

    <!-- BOTONERA -->
    <div class="form-group col-sm-11" align="right">
        <button type="button" id="guardar" class="btn btn-success">
            <i class="fa fa-save"></i>  Guardar
        </button>&nbsp;
        <button type="button" id="cancelar"  class="btn btn-default" 
                onclick="deshabilitarNuevoExamen()">
            <i class="fa fa-remove"></i>  Cancelar
        </button>
    </div>

</div>