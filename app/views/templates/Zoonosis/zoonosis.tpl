<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-envelope"></i><span>&nbsp;Notificaciones de Zoonosis</span></h1>
    <div class="col-md-12 text-right">
        <button type="button" id="notificar" onclick="location.href='{$base_url}/Zoonosis/notificar'"
                class="btn btn-success">
            <i class="fa fa-envelope"></i>&nbsp;&nbsp;Notificar Zoonosis
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
                        
                        <div class="form-group" align="right">
                            <div class="form-group col-md-12">
                                <div class="form-group col-md-3">
                                    <label for="region" class="control-label required">Región {$prueba}</label>
                                    <select for="region" class="form-control">
                                            <option>Todas las Regiones</option>
                                            {foreach $arrRegiones as $item} 
                                                <option value="{$item->reg_id}" >{$item->reg_nombre}</option>
                                            {/foreach}
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="columna" class="control-label required">Comuna</label>
                                    <select for="comuna" class="form-control">
                                            <option selected="selected">Todas las Comunas</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="busqueda" class="control-label required">&nbsp;</label>
                                    <input type="text" name="busqueda" id="rut" value="" 
                                           placeholder="Búsqueda" class="form-control"/>
                                    <span class="help-block hidden"></span>
                                </div>
                                
                                <div class="form-group col-md-1">
                                    <label for="busqueda" class="control-label required">&nbsp;</label>
                                    <button type="button" id="buscar" class="btn btn-info form-control">
                                            <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                
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
                                        <th align="center">Especie</th>
                                        <th align="center">Patología</th>
                                        <th align="center">Método de Diagnóstico</th>
                                        <th align="center">Comuna</th>
                                        <th align="center">Dirección</th>
                                        <th align="center">Acciones</th>
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