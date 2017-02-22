<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i> Detalle Registro</h1>
</section>

<form id="form">

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header">
                    <h3 class="box-title">Datos de Seguimiento</h3>
                </div>

                <div class="form-group">              
                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">Registrado por : </label>&nbsp;&nbsp;{$nombre_registrador} <br>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-6">
                            <label class="control-label required">Estado : </label>&nbsp;&nbsp;{$estado_caso}<br>
                        </div>
                        <div class="form-group clearfix col-md-6">
                            <label class="control-label required">Institución : </label>&nbsp;&nbsp;{$institucion}<br>
                        </div>

                    </div>

                    <div class="form-group col-md-12">

                        <div class="form-group clearfix col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chkReconoce" {if $reconoce}checked="checked"{/if} disabled="disabled">
                                    <strong>Reconoce</strong>
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chkAcepta" {if $acepta}checked="checked"{/if} disabled="disabled">
                                    <strong>Acepta Programa</strong>
                                    <a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descargar consentimiento</a>
                                </label>
                            </div>
                        </div>

                    </div>
                                    
                </div>
                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th align="center" width="5%">#ID</th>
                        <th align="center" width="27%">Motivo Consulta</th>
                        <th align="center" width="18%">Fecha Ingreso</th>
                        <th align="center" width="22%">Registrador</th>
                        <th align="center" width="18%">Fecha Registro</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrMotivosConsulta as $item}
                        <tr>
                            <td nowrap width="100em" align="center"> {$item->id_motivo_consulta} </td>
                            <td nowrap align="center"> {$item->gl_motivo_consulta} </td>
                            <td nowrap align="center">{$item->fc_ingreso}&nbsp;{$item->gl_hora_ingreso}</td>
                            <td nowrap align="center">{$item->gl_nombres}&nbsp;{$item->gl_apellidos}</td> 
                            <td nowrap align="center">{$item->fc_crea}</td> 
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            </div>
        </div>  
        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header">
                    <h3 class="box-title">Datos del Paciente</h3>
                </div>
                <div class="form-group">
                    {if $extranjero }
                        <div class="form-group col-md-12">
                            <div class="form-group col-md-3">
                                <label class="control-label required">Pasaporte Paciente : </label>&nbsp;&nbsp;{$extranjero}<br>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group clearfix col-md-6">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="">Descargar documento identificación extranjero</a>
                            </div>
                        </div>
                    {else}
                        <div class="form-group col-md-12">
                            <div class="form-group col-md-3">
                                <label class="control-label required">Rut Paciente : </label>&nbsp;&nbsp;{$rut}<br>
                            </div>
                        </div>
                    {/if}
                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-6">
                            <label class="control-label required">Nombres : </label>&nbsp;&nbsp;{$nombres}<br>
                        </div>

                        <div class="form-group clearfix col-md-6">
                            <label class="control-label required">Apellidos : </label>&nbsp;&nbsp;{$apellidos}<br>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-6">
                            <label class="control-label required">Fecha Nacimiento : </label>&nbsp;&nbsp;{$fecha_nacimiento}<br>
                        </div>

                        <div class="form-group clearfix col-md-3">
                            <label class="control-label required">Edad : </label>&nbsp;&nbsp;{$edad}<br>
                        </div>

                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group clearfix col-md-6">
                            <label class="control-label required">Previsión : </label>&nbsp;&nbsp;{$prevision}<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header">
                    <h3 class="box-title">Datos de Contacto</h3>
                </div>

                    <div class="form-group col-md-6">
                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">Direcci&oacute;n : </label>&nbsp;&nbsp;{$direccion}<br>
                        </div>
                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">Regi&oacute;n : </label>&nbsp;&nbsp;{$region}<br>

                        </div>
                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">Comuna : </label>&nbsp;&nbsp;{$comuna}<br>
                        </div>
                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">Fono : </label>&nbsp;&nbsp;{$fono}<br>
                        </div>

                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">Celular : </label>&nbsp;&nbsp;{$celular}<br>
                        </div>
                        <div class="form-group clearfix col-md-12">
                            <label class="control-label required">E-mail : </label>&nbsp;&nbsp;{$email}<br>
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

        </div>
        </div>    


    </section>

</form>
