<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{$static}/template/plugins/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>

<form class="form-horizontal" name="form-nuevo" id="form-nuevo" 
      enctype="multipart/form-data" method="post" >
    <div class="panel-body">
        <div class="top-spaced"></div>

        <!-- TIPO DE EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Tipo de Examen</h3>
            </div>
            <div class="box-body">            
                <div class="form-group">
                    <label class="control-label required col-sm-3">Tipo de Examen</label>
                    <div class="col-sm-3">
                        <select id="examen" for="examen" class="form-control" disabled
                                name="examen" onblur="validarVacio(this, 'Por favor Seleccione un Examen')">
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

        <!-- DATOS TOMA DE EXAMEN -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Datos Toma de Examen</h3></div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label required col-sm-3">Fecha toma de examen</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control col-sm-2"                                
                               name="fc_toma" id="fc_toma">
                        <span class="help-block hidden fa fa-warning"></span>
                        <span class="help-block hidden"></span>
                    </div>
                    <label for="fc_nacimiento" class="control-label col-sm-2 ">Hora toma de examen</label>
					<div class="col-sm-2">
                        <input type="time" name="horaingreso" id="horaingreso" value="{$smarty.now|date_format:"%H:%M"}" onblur="validarVacio(this, 'Por favor Ingrese Fecha y Hora de Ingreso')" placeholder="Fecha y Hora de Ingreso" class="form-control"/>
                        {*<span class="help-block hidden"></span>*}
                        
                        {*<input type="date" class="form-control col-sm-2"                                
                               name="fc_toma" id="fc_toma">*}
                        {*<span class="help-block hidden fa fa-warning"></span>*}
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
                                  id="gl_observacion" name="gl_observacion"
                                  placeholder="Ingrese observaci&oacute;n" style="resize: none">{$gl_observacion}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
    </div>
                    
    <!-- BOTONERA -->
    <div class="form-group col-sm-11" align="right">
        <button type="button" id="guardar" class="btn btn-success"
                onclick=""
                {*onclick="Laboratorio.guardarNuevoExamen(this.form,this);">*}
            <i class="fa fa-save"></i>  Guardar
        </button>
        {*&nbsp;
        <button type="button" id="cancelar"  class="btn btn-default" 
                onclick="deshabilitarNuevoExamen()">
            <i class="fa fa-remove"></i>  Cancelar
        </button>*}
    </div>
</form>