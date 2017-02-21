<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; Registros</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" onclick="location.href = '{$base_url}/Registro/nuevo'"
                class="btn btn-danger">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Registro
        </button>
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th align="center" width="10%">#ID</th>
                        <th align="center" width="22%">RUT Paciente</th>
                        <th align="center" width="22%">Nombres</th>
                        <th align="center" width="22%">Apellidos</th>
                        <th align="center" width="23%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrResultado as $item}
                        <tr>
                            <td nowrap width="100em" align="center"> {$item->reg_id} </td>
                            <td nowrap width="100em" align="center"> {$item->reg_rut} </td>
                            <td class="text-center">{$item->reg_nombres}</td>
                            <td class="text-center">{$item->reg_apellidos}</td>
                            <td class="text-center" style="width:100px;">
                                <div class="btn-group">
                                    <button href='javascript:void(0)'
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/ver/{$item->reg_id}', 'Registro número : {$item->reg_id}', 85);" 
                                            data-toggle="tooltip" 
                                            class="btn btn-sm btn-success btn-flat"
                                            title="Ver Registro">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                    </button>
                                    <button href='javascript:void(0)' 
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/detalleRegistro/{$item->reg_rut}', 'Bitácora paciente RUT : {$item->reg_rut}', 85);" 
                                            data-toggle="tooltip" 
                                            title="Bitácora" 
                                            class="btn btn-sm btn-flat btn-primary" 
                                        <i class="fa fa-search">&nbsp;&nbsp;Bitácora</i></button>
                                </div>			
                            </td>          
                        </tr>
                    {/foreach}
                </tbody>
            </table>

        </div>
    </div>    
</section>