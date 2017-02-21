<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i> Detalle Registro</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" onclick="location.href='{$base_url}/Empa/nuevoEmpa/{$id_registro}'"
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
            [reg_seguimiento] => 
            [reg_est_cas_id] => 
            [reg_ins_id] => 
            [reg_usr_id_crea] => 1 
            [reg_fec_crea] => 2017-02-21 00:00:00
            <div class="form-group">
                {if ($registro->reg_extranjero == "N" || $registro->reg_extranjero == "") && $registro->reg_rut != ""}
                <div class="form-group col-md-12">
                    <div class="form-group col-md-3">
                        <label class="control-label required">Rut Paciente : </label>&nbsp;&nbsp;{$registro->reg_rut}<br>
                        
                    </div>
                </div>
                {else}
                    <div class="form-group col-md-12">
                    <div class="form-group col-md-3">
                        <label class="control-label required">Pasaporte Paciente : </label>&nbsp;&nbsp;{$registro->reg_run_pass}<br>
                        
                    </div>
                </div>
                {/if}
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Nombres : </label>&nbsp;&nbsp;{$registro->reg_nombres}<br>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Apellidos : </label>&nbsp;&nbsp;{$registro->reg_apellidos}<br>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Fecha Nacimiento : </label>&nbsp;&nbsp;{$registro->reg_fec_nac}<br>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Edad : </label>&nbsp;&nbsp;{$edad}<br>
                    </div>
<!--
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Género</label>&nbsp;&nbsp;{$registro->reg_sexo}<br>
                        
                    </div> -->
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Previsión : </label>&nbsp;&nbsp;{$prevision}<br>
                        
                    </div>
<!--
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Convenio</label><br>
                    </div> -->

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
                        <label class="control-label required">Direcci&oacute;n : </label>&nbsp;&nbsp;{$registro->reg_direccion}<br>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Regi&oacute;n : </label>&nbsp;&nbsp;{$region}<br>
                        
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Comuna : </label>&nbsp;&nbsp;{$comuna}<br>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Fono : </label>&nbsp;&nbsp;{$registro->reg_fono}<br>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Celular : </label>&nbsp;&nbsp;{$registro->reg_celular}<br>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">E-mail : </label>&nbsp;&nbsp;{$registro->reg_email}<br>
                    </div>
                </div>
                {if $registro->reg_extranjero }
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="">Descargar documento identificación extranjero</a>
                        </div>
                    </div>
                </div>
                {/if}
            </div>

        </div>
    </div>    
</section>
            
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Datos de Seguimiento</h3>
            </div>
            
            <div class="form-group">              
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Estado : </label><br>
                        {$estado} Estado
                    </div>
                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Institución : </label><br>
                        {$estado} Institución
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkReconoce" checked="checked" disabled="disabled">
                                <strong>Reconoce</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkAcepta" checked="checked" disabled="disabled">
                                <strong>Acepta</strong>
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
                    <button type="button" id="aceptar" onclick="location.href='{$base_url}/Registro/index'"
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