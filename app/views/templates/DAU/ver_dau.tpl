<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i> Detalle DAU</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" onclick="location.href='{$base_url}/Dau/nuevaDau'"
                class="btn btn-danger">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Ingresar EMPA
        </button>
    </div>
    <br/><br/>
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
                        <label class="control-label required">Rut Paciente</label><br>
                        {$rut} 1-9
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Nombres</label><br>
                        {$nombres} Nombre Paciente
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Apellidos</label><br>
                        {$apellidos} Apellidos Paciente
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Fecha Nacimiento</label><br>
                        {$fecnacimiento} dd/mm/aaaa
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Edad</label><br>
                        {$edad} XX
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">G&eacute;nero</label><br>
                        {$genero} Genero
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Previsión</label><br>
                        {$prevision} FONASA
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Convenio</label><br>
                        {$convenio} ...
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
                        <label class="control-label required">Direcci&oacute;n</label><br>
                        {$direccion} Dirección
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Regi&oacute;n</label><br>
                        {$region} Región
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Comuna</label><br>
                        {$comuna} Comuna
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Fono</label><br>
                        {$fono} 9900000000
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Celular</label><br>
                        {$celular} +56900000000
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">E-mail</label><br>
                        {$email} E-mail
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked="checked" disabled="disabled">
                                <strong>Extranjero</strong>
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="">Descargar documento</a>
                        </div>
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
                        <label class="control-label required">Fecha ingreso</label><br>
                        {$fechaing} dd/mm/aaaa
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Hora ingreso</label><br>
                        {$horaing} hh:mm
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">Motivo Consulta</label><br>
                        {$motivo} Descripción motivo
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">Historia de la enfermedad actual</label><br>
                        {$historia} Descripción historia
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Cod. CIE-10</label><br>
                        {$codigo} Código
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Clasificación diagnóstica</label><br>
                        {$clasificacion} Descripción clasificación
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Estado</label><br>
                        {$estado} Estado
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">Diagn&oacute;stico</label><br>
                        {$diagnostico} Descripción diagnóstico
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">Indicaci&oacute;n m&eacute;dica</label><br>
                        {$indicacion} Descripción indicación
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Hora egreso</label><br>
                        {$horaegr} hh:mm
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Caso de egreso</label><br>
                        {$casoegr} Descripción caso egreso
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkSospecha" checked="checked" disabled="disabled">
                                <strong>Sospecha</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkReconoce" checked="checked" disabled="disabled">
                                <strong>Reconoce</strong>
                            </label>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group col-md-12">    
                    <div class="form-group clearfix col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkAcepta" checked="checked" disabled="disabled">
                                <strong>Acepta Programa</strong>
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="">Descargar consentimiento</a>
                        </div>
                        
                        <div class="checkbox">
                            
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-12 text-right">
                    <button type="button" id="aceptar" onclick="location.href='{$base_url}/Dau/index'"
                            class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i>&nbsp;&nbsp;Aceptar
                    </button>
                    <br/><br/>
                </div>
            </div>

        </div>
    </div>    
</section>
                
</form>