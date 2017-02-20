<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; Registros</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" onclick="location.href='{$base_url}/Registro/nuevo'"
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
                        <th align="center" width="5%">#ID</th>
                        <th align="center" width="10%">RUT Paciente</th>
                        <th align="center" width="10%">Fecha Ingreso</th>
                        <th align="center" width="10%">Hora Ingreso</th>
                        <th align="center" width="10%">Hora Egreso</th>
                        <th align="center" width="">Caso Egreso</th>
                        <th align="center" width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrResultado as $item}
                        <tr>
                            <td nowrap width="100px" align="center"> {$item->reg_id} </td>
                            <td nowrap width="100px" align="center"> {$item->reg_pac_id} </td>
                            <td class="text-center">{$item->reg_fec_ingreso}</td>
                            <td class="text-center">{$item->reg_hora_ingreso}</td>
                            <td class="text-center">{$item->reg_hora_egreso}</td>
                            <td class="text-center">{$item->reg_cas_egr_id}</td>
                            <td class="text-center" style="width:100px;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-success btn-flat" 
                                            onClick="location.href='{$base_url}/Registro/ver/{$item->reg_id}'" 
                                            data-toggle="tooltip" title="Ver Actividad">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                                    </button>
                                </div>			
                           </td>          
                        </tr>
                    {/foreach}
                </tbody>
            </table>

        </div>
    </div>    
</section>