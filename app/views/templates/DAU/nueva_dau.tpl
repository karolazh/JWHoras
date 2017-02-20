<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i> Ingresar DAU</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion/noticias">
            <i class="fa fa-folder-open"></i> DAU</a></li>
            <li class="active"> Ingresar DAU</li>
        </ol>
</section>

<form id="form">

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Datos del Paciente</h3>
            </div>
            
            <div class="form-group">
                <div class="form-group col-md-12">
                    <div class="form-group col-md-3">
                        <label for="region" class="control-label required">Rut Paciente (*)</label>
                        <input type="text" name="rut" id="rut" maxlength="12"
                               onkeyup="formateaRut(this),validaRut(this),this.value = this.value.toUpperCase()"
                               onkeypress ="return soloNumerosYK(event)" onblur="validarVacio(this,'Por favor Ingrese Rut')"
                               placeholder="Rut paciente" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="buscar" class="control-label required">&nbsp;</label>
                        <button type="button" id="buscar" class="btn btn-info btn-sm form-control"
                                onclick="Pacientes.cargarPaciente(this.value)">
                                <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="nombres" class="control-label required">Nombres (*)</label>
                        <input type="text" name="nombres" id="nombres" 
                               onblur="validarVacio(this,'Por favor Ingrese Nombres')"
                               onkeyup="validarVacio(this,'Por favor Ingrese Nombres')"
                               placeholder="Nombres" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="apellidos" class="control-label required">Apellidos (*)</label>
                        <input type="text" name="apellidos" id="apellidos"
                               onblur="validarVacio(this,'Por favor Ingrese Apellidos')"
                               onkeyup="validarVacio(this,'Por favor Ingrese Apellidos')"
                               placeholder="Apellidos" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="fecnacimiento" class="control-label required">Fecha Nacimiento (*)</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control datepicker"
                                   onblur="validarVacio(this,'Por favor Ingrese Fecha'),calcularEdad(this.value)"
                                   name="fecnacim" id="fecnacim">
                        </div>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="edad" class="control-label required">Edad (*)</label>
                        <input type="text" name="edad" id="edad"
                               placeholder="Edad" class="form-control" disabled/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="genero" class="control-label required">G&eacute;nero (*)</label>
                        <select for="genero" class="form-control" id="genero" name="genero" disabled>
                                <option>Femenino</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="prevision" class="control-label required">Previsión (*)</label>
                        <select for="prevision" class="form-control" 
                                id="prevision" name="prevision" disabled>
                                <option>FONASA</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="convenio" class="control-label required">Convenio (*)</label>
                        <select for="convenio" class="form-control" id="convenio" name="convenio"
                                onblur="validarVacio(this,'Por favor Seleccione una Convenio')">
                                <option>Seleccione un Convenio</option>
                                <option>1. Convenio1</option>
                                <option>2. Convenio2</option>
                                <option>3. Otro</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
                
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Datos de Contacto</h3>
            </div>
            
            <div class="form-group">
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label for="direccion" class="control-label required">Dirección (*)</label>
                        <input type="text" name="direccion" id="direccion" value=""
                               onblur="validarVacio(this,'Por favor Ingrese Dirección')"
                               onkeyup="validarVacio(this,'Por favor Ingrese Dirección')"
                               placeholder="Dirección" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Región (*)</label>
                        <select for="region" class="form-control" id="region" name="region"
                                onchange="Dau.cargarComunasPorRegion(this.value,'comuna')"
                                onblur="validarVacio(this,'Por favor Seleccione una Región')">
                                <option>Seleccione una Región</option>
                                {foreach $arrRegiones as $item}
                                        <option value="{$item->reg_id}" >{$item->reg_nombre}</option>
                                {/foreach}
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Comuna (*)</label>
                        <select for="comuna" class="form-control" id="comuna" name="comuna"
                                onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
                                <option value="0">Seleccione una Comuna</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="fono" class="control-label required">Fono</label>
                        <input type="text" name="fono" id="fono" value="" maxlength="11"
                               onKeyPress="return soloNumeros(event)"
                               placeholder="Fono" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="celular" class="control-label required">Celular</label>
                        <input type="text" name="celular" id="celular" value="" maxlength="11"
                               onKeyPress="return soloNumeros(event)"
                               placeholder="Celular" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="email" class="control-label required">E-mail</label>
                        <input type="text" name="email" id="email" value=""
                               onblur="validaEmail(this,'Correo Inválido!')"
                               placeholder="E-mail" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input id="extranjero" type="checkbox" onchange="showContent('upDoc','extranjero')">
                                <strong>Extranjero</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-6" id="upDoc" style="display: none">
                        <label for="upDoc">Subir documento</label>
                        <input type="file" id="upDoc">
                    </div>
                </div>
            </div>

        </div>
    </div>    
</section>
            
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Datos de Urgencia</h3>
            </div>
            
            <div class="form-group">
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="fecing" class="control-label required">Fecha ingreso (*)</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control datepicker"
                                   onblur="validarVacio(this,'Por favor Ingrese Fecha'),calcularEdad(this.value)"
                                   name="fecing" id="fecing">
                        </div>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="horaing" class="control-label required">Hora ingreso (*)</label>
                        <input type="time" name="horaing" id="horaing" value="" 
                               onblur="validarVacio(this,'Por favor Ingrese Hora Ingreso')"
                               placeholder="Hora ingreso" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Motivo consulta (*)</label>
                        <textarea class="form-control" rows="3" id="motivo" value=""
                                  onblur="validarVacio(this,'Por favor Ingrese el Motivo de la Consulta')"
                                  placeholder="Ingrese motivo de consulta"></textarea>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Historia de la enfermedad actual (*)</label>
                        <textarea class="form-control" rows="3" id="historia" value=""
                                  onblur="validarVacio(this,'Por favor Ingrese Historia de la Enfermedad Actual')"
                                  placeholder="Ingrese historia de la enfermedad actual"></textarea>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="codcie10" class="control-label required">Cod. CIE-10 (*)</label>
                        <input type="text" name="codcie10" id="codcie10" value=""
                               onblur="validarVacio(this,'Por favor Seleccione un Cod. CIE-10')"
                               placeholder="Cod." class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="clasificacion" class="control-label required">Clasificación diagnóstica (*)</label>
                        <input type="text" name="clasificacion" id="clasificacion" value=""
                               onblur="validarVacio(this,'Por favor Seleccione Clasificación Diagnóstica')"
                               placeholder="Clasificación diagnóstica" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <label for="estado" class="control-label required">Estado(*)</label>
                        <input type="text" name="estado" id="estado" value=""
                               onblur="validarVacio(this,'Por favor Ingrese Estado')"
                               placeholder="Estado" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Diagn&oacute;stico (*)</label>
                        <textarea class="form-control" rows="3" id="diagnostico"
                                  onblur="validarVacio(this,'Por favor Ingrese Diagnóstico')"
                                  placeholder="Diagnóstico"></textarea>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Indicaci&oacute;n m&eacute;dica (*)</label>
                        <textarea class="form-control" rows="3" id="indicacion"
                                  onblur="validarVacio(this,'Por favor Ingrese Indicación Médica')"
                                  placeholder="Ingrese motivo de consulta"></textarea>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="horaegr" class="control-label required">Hora egreso (*)</label>
                        <input type="time" name="horaegr" id="horaegr" value="" 
                               onblur="validarVacio(this,'Por favor Ingrese Hora Egreso')"
                               placeholder="Hora egreso" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="casoegreso" class="control-label required">Caso de egreso (*)</label>
                        <select for="casoegreso" class="form-control" id="casoegreso" name="casoegreso"
                                onchange="Dau.cargarComunasPorRegion(this.value,'comuna')"
                                onblur="validarVacio(this,'Por favor Seleccione un Caso de Egreso')">
                                <option>Seleccione un Caso de Egreso</option>
                                {foreach $arrCasoEgreso as $item}
                                        <option value="{$item->cas_egr_id}" >{$item->cas_egr_nombre}</option>
                                {/foreach}
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkSospecha"
                                       onchange="showContent('acepta','chkSospecha')">
                                <strong>Sospecha</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3" id="reconoce">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkReconoce"
                                       onchange="showContent('acepta','chkReconoce')">
                                <strong>Reconoce</strong>
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group col-md-12" id="acepta" style="display: none">    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkAcepta"
                                       onchange="showContent('upDoc2','chkAcepta')">
                                <strong>Acepta Programa</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3" id="upDoc2" style="display: none">
                        <label for="upDoc2">Subir consentimiento</label>
                        <input type="file" id="upDoc2">
                    </div>
                </div>

                <div class="form-group clearfix col-md-12 text-right">
                    <button type="button" id="guardar" class="btn btn-success">
                        <i class="fa fa-save"></i>  Guardar
                    </button>&nbsp;
                    <button type="button" id="cancelar"  class="btn btn-default" 
                            onclick="location.href='{$base_url}/Dau/index'">
                        <i class="fa fa-remove"></i>  Cancelar
                    </button>
                    <br/><br/>
                </div>
            </div>

        </div>
    </div>    
</section>
                
</form>