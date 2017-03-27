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
            <div class="table-responsive col-lg-12" data-row="10">
                <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                    <thead>
                        <tr role="row">
                            <th align="center" width="5%">#ID REGISTRO</th>
                            <th align="center" width="5%">Fecha</th>
                            <th align="center" width="5%">RUT Paciente</th>
                            <th align="center" width="">Nombres</th>
                            <th align="center" width="">Comuna</th>
                            <th align="center" width="">Centro Salud</th>
                            <th align="center" width="5%">Estado Caso</th>
                            <th align="center" width="20%">Acciones</th>
                        </tr>
                    </thead>



                    <tbody>
                        {foreach $arrResultado as $item}
                            <tr>
                                <td nowrap width="100px" align="center"> {$item->id_registro} </td>
                                <td nowrap width="100px" align="center"> {$item->fc_crea} </td>
                                <td nowrap width="100px" align="center"> {$item->gl_rut} </td>
                                <td nowrap width="100px" align="center"> {$item->gl_nombres} </td>
                                <td nowrap width="100px" align="center"> {$item->gl_nombre_comuna} </td>
                                <td nowrap width="100px" align="center"> {$item->gl_nombre} </td>
                                <td nowrap width="100px" align="center"> {$item->gl_nombre_estado_caso} </td>
                                <td class="text-center" style="width:100px;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success btn-flat" 
                                                onClick="location.href='{$base_url}/Empa/nuevo/{$item->id_registro}'" 
                                                data-toggle="tooltip" title="Empa">
                                            <i class="fa fa-eye"></i>&nbsp;&nbsp;EMPA
                                        </button>
                                        <button href='javascript:void(0)' 
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/bitacora/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
                                            data-toggle="tooltip" 
                                            title="Bitácora" 
                                            class="btn btn-sm btn-flat btn-primary">
                                        <i class="fa fa-eye">&nbsp;&nbsp;Bitácora</i></button>
                                    </div>			
                                </td>          
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>