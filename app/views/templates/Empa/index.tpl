<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> EMPA</h1>
    <ol class="breadcrumb">
        <li><a href="{$base_url}/Empa/index">
        <i class="fa fa-folder-open"></i> EMPA</a></li>
    </ol>
</section>

<section class="content">
    {*<div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Busqueda</h3>
            </div>
            
            <div class="form-group col-md-12">
                <div class="form-group col-md-3">
                    <label for="region" class="control-label required">Rut Paciente</label>
                    <input type="text" name="rut" id="rut" value="" 
                           placeholder="Ingrese Rut..." class="form-control"/>
                    <span class="help-block hidden"></span>
                </div>

                <div class="form-group col-md-1">
                    <label for="buscar" class="control-label required">&nbsp;</label>
                    <button type="button" id="buscar" class="btn btn-info btn-sm form-control">
                            <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>*}
    
    <div class="box box-primary">
        <div class="box-body">
            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th align="center" width="5%">#ID EMPA</th>
                        <th align="center" width="5%">Fecha</th>
                        <th align="center" width="5%">RUT Paciente</th>
                        <th align="center" width="">Comuna</th>
                        <th align="center" width="">Centro Salud</th>
                        <th align="center" width="5%">#ID DAU</th>
                        <th align="center" width="5%">Estado DAU</th>
                        <th align="center" width="20%">Acciones</th>
                    </tr>
                </thead>
                
                <!-- PRUEBA -->
                <tbody>
                    <tr>
                        <td nowrap align="center"> ?</td>
                        <td nowrap align="center"> dd/mm/aaaa</td>
                        <td nowrap align="center"> 99999999-9</td>
                        <td nowrap align="center"> ?</td>
                        <td class="text-center"> ?</td>
                        <td class="text-center"> ?</td>
                        <td class="text-center">
                            <span class="label label-success">ABIERTO</span>
                        </td>
                        <td class="text-center" style="width:100px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_id}'" 
                                        data-toggle="tooltip" title="Ver DAU">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;DAU
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-success btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_dau_id}'" 
                                        data-toggle="tooltip" title="Ver EMPA">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;EMPA
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-info btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_pac_id}'" 
                                        data-toggle="tooltip" title="Ver Paciente">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;Paciente
                                </button>
                            </div>			
                       </td>          
                    </tr>
                    <tr>
                        <td nowrap align="center"> ?</td>
                        <td nowrap align="center"> dd/mm/aaaa</td>
                        <td nowrap align="center"> 99999999-9</td>
                        <td nowrap align="center"> ?</td>
                        <td class="text-center"> ?</td>
                        <td class="text-center"> ?</td>
                        <td class="text-center">
                            <span class="label label-danger">CERRADO</span>
                        </td>
                        <td class="text-center" style="width:100px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_id}'" 
                                        data-toggle="tooltip" title="Ver DAU">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;DAU
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-success btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_dau_id}'" 
                                        data-toggle="tooltip" title="Ver EMPA">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;EMPA
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-info btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_pac_id}'" 
                                        data-toggle="tooltip" title="Ver Paciente">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;Paciente
                                </button>
                            </div>			
                       </td>          
                    </tr>
                    <tr>
                        <td nowrap align="center"> ?</td>
                        <td nowrap align="center"> dd/mm/aaaa</td>
                        <td nowrap align="center"> 99999999-9</td>
                        <td nowrap align="center"> ?</td>
                        <td class="text-center"> ?</td>
                        <td class="text-center"> ?</td>
                        <td class="text-center">
                            <span class="label label-warning">SIN ESTADO</span>
                        </td>
                        <td class="text-center" style="width:100px;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_id}'" 
                                        data-toggle="tooltip" title="Ver DAU">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;DAU
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-success btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_dau_id}'" 
                                        data-toggle="tooltip" title="Ver EMPA">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;EMPA
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-info btn-flat" 
                                        onClick="location.href='{$base_url}/Empa/ver/{$item->emp_pac_id}'" 
                                        data-toggle="tooltip" title="Ver Paciente">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;Paciente
                                </button>
                            </div>			
                       </td>          
                    </tr>
                </tbody>
                
                {*<tbody>
                    {foreach $arrResultado as $item}
                        <tr>
                            <td nowrap width="100px" align="center"> {$item->emp_id} </td>
                            <td nowrap width="100px" align="center"> {$item->emp_dau_id} </td>
                            <td nowrap width="100px" align="center"> {$item->emp_fec} </td>
                            <td nowrap width="100px" align="center"> {$item->emp_pac_id} ?</td>
                            <td class="text-center">?</td>
                            <td class="text-center">?</td>
                            <td class="text-center" style="width:100px;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                            onClick="location.href='{$base_url}/Empa/verEmpa/{$item->emp_id}'" 
                                            data-toggle="tooltip" title="Ver Actividad">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                    </button>
                                </div>			
                           </td>          
                        </tr>
                    {/foreach}
                </tbody>*}
            </table>

        </div>
    </div>
</section>