<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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
                        <input type="text" name="rut" id="rut" value="" 
                               placeholder="Rut paciente" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="buscar" class="control-label required">&nbsp;</label>
                        <button type="button" id="buscar" class="btn btn-info btn-sm form-control">
                                <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="nombres" class="control-label required">Nombres (*)</label>
                        <input type="text" name="nombres" id="fecha" value=""
                               placeholder="Nombres" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="apellidos" class="control-label required">Apellidos (*)</label>
                        <input type="text" name="apellidos" id="rut" value="" 
                               placeholder="Apellidos" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="fecnacimiento" class="control-label required">Fecha Nacimiento (*)</label>
                        <input type="text" name="fecnacimiento" id="fecha" value=""
                               placeholder="Fecha Nacimiento" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="edad" class="control-label required">Edad (*)</label>
                        <input type="text" name="edad" id="rut" value="" 
                               placeholder="Edad" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="genero" class="control-label required">G&eacute;nero (*)</label>
                        <input type="text" name="genero" id="rut" value="" 
                               placeholder="Genero" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="prevision" class="control-label required">Previsión (*)</label>
                        <input type="text" name="prevision" id="fecha" value=""
                               placeholder="Previsión" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="convenio" class="control-label required">Convenio (*)</label>
                        <input type="text" name="convenio" id="rut" value="" 
                               placeholder="Convenio" class="form-control"/>
                        <span class="help-block hidden"></span>
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
                        <input type="text" name="direccion" id="fecha" value=""
                               placeholder="Dirección" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="region" class="control-label required">Región (*)</label>
                        <input type="text" name="region" id="fecha" value=""
                               placeholder="Región" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="comuna" class="control-label required">Comuna (*)</label>
                        <input type="text" name="comuna" id="rut" value="" 
                               placeholder="Comuna" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="fono" class="control-label required">Fono</label>
                        <input type="text" name="fono" id="rut" value="" 
                               placeholder="Fono" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="celular" class="control-label required">Celular</label>
                        <input type="text" name="celular" id="rut" value="" 
                               placeholder="Celular" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="email" class="control-label required">E-mail</label>
                        <input type="text" name="email" id="fecha" value=""
                               placeholder="E-mail" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"><strong>Extranjero</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
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
                        <label for="fecing" class="control-label required">Fecha ingreso</label>
                        <input type="text" name="fecing" id="rut" value="" 
                               placeholder="Fecha ingreso" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="horaing" class="control-label required">Hora ingreso</label>
                        <input type="text" name="horaing" id="rut" value="" 
                               placeholder="Hora ingreso" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Motivo consulta</label>
                        <textarea class="form-control" rows="3" id="motivo"
                            placeholder="Ingrese motivo de consulta">
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Historia de la enfermedad actual</label>
                        <textarea class="form-control" rows="3" id="historia"
                            placeholder="Ingrese historia de la enfermedad actual">
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="codcie10" class="control-label required">Cod. CIE-10 (*)</label>
                        <input type="text" name="codcie10" id="rut" value="" 
                               placeholder="Cod." class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="clasificacion" class="control-label required">Clasificación diagnóstica (*)</label>
                        <input type="text" name="clasificacion" id="fecha" value=""
                               placeholder="Clasificación diagnóstica" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <label for="estado" class="control-label required">Estado(*)</label>
                        <input type="text" name="estado" id="rut" value="" 
                               placeholder="Estado" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Diagn&oacute;stico</label>
                        <textarea class="form-control" rows="3" id="diagnostico"
                            placeholder="Diagnóstico">
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Indicaci&oacute;n m&eacute;dica</label>
                        <textarea class="form-control" rows="3" id="indicacion"
                            placeholder="Ingrese motivo de consulta">
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="horaegr" class="control-label required">Hora egreso</label>
                        <input type="text" name="horaegr" id="rut" value="" 
                               placeholder="Hora egreso" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="casoegreso" class="control-label required">Caso de egreso (*)</label>
                        <input type="text" name="casoegreso" id="fecha" value=""
                               placeholder="Caso de egreso" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkSospecha"><strong>Sospecha</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkReconoce"><strong>Reconoce</strong>
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group col-md-12">    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkAcepta"><strong>Acepta Programa</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <label for="upDoc2">Subir consentimiento</label>
                        <input type="file" id="upDoc2">
                    </div>
                </div>

                <div class="form-group clearfix col-md-12 text-right">
                    {*<div class="col-md-12 text-right">*}
                        <button type="button" id="guardar" class="btn btn-success">
                            <i class="fa fa-save"></i>  Guardar
                        </button>&nbsp;
                        <button type="button" id="cancelar"  class="btn btn-default" 
                                onclick="location.href='{$base_url}/Dau/index'">
                            <i class="fa fa-remove"></i>  Cancelar
                        </button>
                        <br/><br/>
                    {*</div>*}
                </div>
                {*</div>*}
            </div>

        </div>
    </div>    
</section>
                
</form>