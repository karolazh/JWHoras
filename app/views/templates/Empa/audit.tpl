<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<form id="form">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="box-title">Datos de Seguimiento</h5>
            </div>
            <div class="panel-body">
                
            </div>
        </div>  
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="box-title">Datos del Paciente</h5>
            </div>
            <div class="panel-body">
                    {if $extranjero }
                        <div class="form-group">
                            <div class="clearfix col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label required">Pasaporte Paciente :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{$run_pass}" class="form-control" readonly>
                                </div>

                            </div>
                            <div class="clearfix col-md-6">
                                <div class="col-md-6">
                                    <a href="">Descargar documento identificación extranjero</a>
                                </div>
                            </div>
                        </div>
                    {else}
                        <div class="form-group">
                            <div class="clearfix col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label required">Rut Paciente : </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{$rut}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="clearfix col-md-6">
                                <div class="col-md-4">
                                    <label class="control-label required">Previsión : </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{$prevision}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    {/if}
                    <div class="form-group">
                        <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                <label class="control-label required">Nombres : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$nombres}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                <label class="control-label required">Apellidos : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$apellidos}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                <label class="control-label required">Fecha Nacimiento : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$fecha_nacimiento}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                <label class="control-label required">Edad : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$edad}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
            </div>    
            <div class="panel-footer">
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5 class="box-title">Datos de Contacto</h5>
                </div>
                <div class="box-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label required">Direcci&oacute;n : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$direccion}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label required">Regi&oacute;n : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$region}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label required">Comuna : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$comuna}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label required">Fono : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$fono}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label required">Celular : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$celular}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label required">E-mail : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text"  value="{$email}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="col-sm-6 col-md-12">
                            <div id="map" data-editable="1" style="width:100%;height:300px;"></div>
                            <div class="form-group">    
                                <div class="col-sm-3">
                                    <input type="text" name="gl_latitud" id="gl_latitud" value="{$latitud}" placeholder="latitud" class="form-control hidden"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="gl_longitud"  id="gl_longitud" value="{$longitud}" placeholder="Longitud" class="form-control hidden"/>
                                </div>					
                            </div>				
                        </div>

                    </div>





                </div>
            <div class="panel-footer"></div>
            </div>
        </div>    


    </section>

</form>