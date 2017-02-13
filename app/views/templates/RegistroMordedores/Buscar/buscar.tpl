<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-paw"></i><span>&nbsp;B&uacute;scar de Accidentes por Mordedura</span></h1>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Busqueda de accidentes por mordedura</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="fecha" class="control-label required">Fecha incidente</label>
                                    <input type="text" name="fecha" id="fecha" value=""
                                           placeholder="Fecha incidente" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="comuna" class="control-label required">Comuna incidente</label>
                                    <input type="text" name="comuna" id="rut" value="" 
                                           placeholder="Comuna incidente" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="rutafec" class="control-label required">Rut afectado</label>
                                    <input type="text" name="rutafec" id="nombre" value="" 
                                           placeholder="Rut afectado" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="rutdue" class="control-label required">Rut dueño</label>
                                    <input type="text" name="rutdue" id="apellido" value="" 
                                           placeholder="Rut dueño" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="microship" class="control-label required">Microship</label>
                                    <input type="text" name="microship" id="direccion" value="" 
                                           placeholder="Microship" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="estado" class="control-label required">Estado</label>
                                    <input type="text" name="estado" id="telefono" value="" 
                                           placeholder="Estado" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="tipoani" class="control-label required">Tipo animal</label>
                                    <input type="text" name="tipoani" id="direccion" value="" 
                                           placeholder="Tipo Animal" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="funcionario" class="control-label required">Funcionario</label>
                                    <input type="text" name="funcionario" id="telefono" value="" 
                                           placeholder="Funcionario" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="col-md-12 text-right">
                                <button type="button" id="guardar" class="btn btn-success">
                                    <i class="fa fa-search"></i>  Buscar
                                </button>
                                <button type="button" id="cancelar"  class="btn btn-default" 
                                        onclick="location.href='{$base_url}/Home/dashboard'">
                                    <i class="fa fa-remove"></i>  Cancelar
                                </button>
                                <br/><br/>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Listado de accidentes por mordedura</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th align="center" with="20%">Fecha</th>
                                        <th align="center">D&iacute;as trancurridos</th>
                                        <th align="center">Direcci&oacute;n</th>
                                        <th align="center">Comuna</th>
                                        <th align="center">Especie</th>
                                        <th align="center">Responsable</th>
                                        <th align="center">Estado</th>
                                        <th align="center" with="1px">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                {foreach $arrResultado as $item}
                                    <tr>
                                        <td align="center">{$item->inc_fec_mordida}</td>
                                        <td align="center">?</td>
                                        <td align="center">{$item->inc_direccion}</td>
                                        <td align="center">{$item->inc_com_id}</td>
                                        <td align="center">?</td>
                                        <td align="center">{$item->inc_usr_id_resp}</td>
                                        <td align="center">{$item->inc_estado}</td>
                                        <td align="center">
                                            {*<button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                                                    onClick="xModal.open('{$smarty.const.BASE_URI}/Solicitudes/revisarSolicitud/{$item->id_solicitud}',
                                                                         'Revisar Solicitud',85);">
                                                <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                                            </button>*}
                                            {*<button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                                                    onClick="">
                                                <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                                            </button>*}
                                            <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                    onClick="location.href='{$base_url}/RegistroMordedores/Buscar/verRegistro/{$item->not_id}'" 
                                                    data-toggle="tooltip" title="Ver Noticia">
                                                <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                            </button>
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                            <br/>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
        
    </div>
</section>