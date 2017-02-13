<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i><span>&nbsp;Vacunas</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="registrar" onclick="location.href='{$base_url}/Vacunas/registrar'"
                class="btn btn-danger">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Registrar Vacunas
        </button>
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="row">
        
        <form  id="form" name="form" enctype="application/x-www-form-urlencoded" action="" method="post">
            
            <div class="col-xs-12 col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title">Busqueda de vacunas</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="agno" class="control-label required">Año</label>
                                    <input type="text" name="agno" id="fecha" value=""
                                           placeholder="Año" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="semestre" class="control-label required">Semestre</label>
                                    <input type="text" name="Semestre" id="rut" value="" 
                                           placeholder="Semestre" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="form-group clearfix col-md-6">
                                    <label for="comuna" class="control-label required">Comuna</label>
                                    <input type="text" name="comuna" id="rut" value="" 
                                           placeholder="Comuna" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group clearfix col-md-6">
                                    <label for="busqueda" class="control-label required">Búsqueda</label>
                                    <input type="text" name="busqueda" id="apellido" value="" 
                                           placeholder="Búsqueda" class="form-control"/>
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
                            <h3 class="box-title">Listado de vacunas</h3>
                        </div>
                        <br>
                        
                        <div class="form-group ">
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th align="center">Fecha Ing</th>
                                        <th align="center">Año</th>
                                        <th align="center">Semestre</th>
                                        {*<th align="center">Inicio Periodo</th>
                                        <th align="center">Termino Periodo</th>*}
                                        <th align="center">Comuna</th>
                                        <th align="center">Tipo Animal</th>
                                        <th align="center">Instituci&oacute;n</th>
                                        {*<th align="center">Responsable</th>*}
                                        <th align="center">Cantidad</th>
                                        <th align="center" with="1px">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                {foreach $arrResultado as $item}
                                    <tr>
                                        <td align="center">{$item->vac_fec_crea}</td>
                                        <td align="center">{$item->vac_agno}</td>
                                        <td align="center">{$item->vac_periodo}</td>
                                        {*<td align="center">{$item->vac_fec_ini}</td>
                                        <td align="center">{$item->vac_fec_ter}</td>*}
                                        <td align="center">{$item->com_nombre}</td>
                                        <td align="center">{$item->esp_nombre}</td>
                                        <td align="center">{$item->ins_nombre}</td>
                                        {*<td align="center">{$item->usr_nombres}</td>*}
                                        <td align="center">{$item->vac_cantidad}</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                    onClick="location.href='{$base_url}/Vacunas/verRegistro/{$item->vac_id}'" 
                                                    data-toggle="tooltip" title="Ver Vacuna">
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