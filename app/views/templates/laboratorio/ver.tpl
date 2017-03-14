<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{$static}/template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>


<form id="form" class="form-horizontal">
	<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
    
    <section class="content">
        <!-- DATOS DE REGISTRO -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos del Paciente {$botonAyudaPaciente}
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
                            <input type="text" value="{$fc_nacimiento}" class="form-control" readonly>
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
                            <label class="control-label">Sexo : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_sexo}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Estado Caso : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_nombre_estado_caso}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Previsi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_nombre_prevision}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Grupo : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_grupo_tipo}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <!--
                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Direcci&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_direccion}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fono : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_fono}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Celular : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_celular}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">E-mail : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_email}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Comuna : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_nombre_comuna}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Provincia : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_nombre_provincia}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Regi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$gl_nombre_region}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fecha Registro : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$fc_crea}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                -->

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Reconoce: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$bo_reconoce}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Acepta Programa : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$bo_acepta_programa}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="top-spaced"></div>
        </div>
                        
        <div class="top-spaced"></div>
    
        <!-- DATOS DEL EXAMEN -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                    Datos del Examen
            </div>

            <div class="panel-body">

                <!-- LABORATORIO -->
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
                                    {foreach $arrLaboratorios as $item}
                                        <option  value="{$item->id_laboratorio}" >{$item->gl_nombre_laboratorio}</option>
                                    {/foreach}
                                </select>
                                <span class="help-block hidden fa fa-warning"></span>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    {foreach $arrExamenes as $item2}
                                        <option  value="" ></option>
                                    {/foreach}
                                </select>
                                <span class="help-block hidden fa fa-warning"></span>
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
                            <label class="control-label required col-sm-3">RUT persona que toma examen</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_rut_toma" id="gl_rut_toma" maxlength="9" 
                                       onKeyPress="return soloNumeros(event)"
                                       value="" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label required col-sm-3">Nombre persona que toma examen</label>
                            <div class="col-sm-4">
                                <input type="text" name="gl_nombre_toma" id="gl_nombre_toma" maxlength="" 
                                       value="" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
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
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker col-sm-2" readonly
                                           style="border-radius: 0" 
										   id="fc_toma"
                                           name="fc_toma"
										   value="{$smarty.now|date_format:"%d/%m/%Y"}"
                                           placeholder="Fecha y Hora de Ingreso">
                                    <span class="input-group-addon"><i class="fa fa-calendar" onClick="$('#fc_toma').focus();"></i></span>
									<span class="help-block hidden fa fa-warning"></span>
                                </div>
							</div>
						<!--<div class="col-sm-2">
                                <input type="date" class="form-control col-sm-2" 
                                       name="fc_toma" id="fc_toma">
                                <span class="help-block hidden fa fa-warning"></span>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label class="control-label required col-sm-3">Fecha resultado de examen</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker col-sm-2" readonly
                                           style="border-radius: 0" 
										   id="fc_resultado"
                                           name="fc_resultado"
										   value="{$smarty.now|date_format:"%d/%m/%Y"}"
                                           placeholder="Fecha y Hora de Ingreso">
                                    <span class="input-group-addon"><i class="fa fa-calendar" onClick="$('#fc_resultado').focus();"></i></span>
									<span class="help-block hidden fa fa-warning"></span>
                                </div>
							</div>
							<!--
							<div class="col-sm-2">
                                <input type="date" class="form-control col-sm-2" 
                                       name="fc_resultado" id="fc_resultado">
                                <span class="help-block hidden fa fa-warning"></span>
                            </div> -->
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
                            <i class="fa fa-sticky-note"></i> Resultado Descripci&oacute;n</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <label>Resultado Descripci&oacute;n</label>
                                <textarea type="text" class="form-control col-sm-10" rows="5" 
                                          id="gl_resultado_descripcion" name="gl_resultado_descripcion"
                                          placeholder="Ingrese resultado descripci&oacute;n" style="resize: none">
                                    {$gl_resultado_descripcion}</textarea>
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
                                <label>Indicaciones</label>
                                <textarea type="text" class="form-control col-sm-10" rows="5" 
                                          id="gl_indicacion" name="gl_indicacion"
                                          placeholder="Ingrese indicaciones" style="resize: none">
                                    {$gl_indicacion}</textarea>
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
                            onclick="location.href = '{$base_url}/Laboratorio/index'">
                        <i class="fa fa-remove"></i>  Cancelar
                    </button>
                </div>
                
            </div>
            <div class="top-spaced"></div>
        </div>
    </section>
</form>