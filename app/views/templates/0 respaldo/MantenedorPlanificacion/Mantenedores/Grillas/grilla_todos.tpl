<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  dataTable no-footer small">
    <thead>
    <tr role="row">
        <th># Solicitud</th>
        <th>Fecha creacion</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th width="1px" align="center">Accion</th>
    </tr>
    </thead>
    <tbody>

    {foreach $arrResultado as $itm}
        <tr>
            <td>{$itm->id_solicitud}</td> 
            <td>{$itm->fc_fecha_creacion}</td> 
            <td>{$itm->nombres} {$itm->apellidos}</td> 
            <td>{$itm->nombre_estado_solicitud}</td> 
            <td nowrap class="text-center">
                <button type="button" class="btn btn-sm btn-success btn-flat" onClick="location.href='{$base_url}/Solicitudes/revisarSolicitud/{$itm->id_solicitud}'" data-toggle="tooltip" title="Ver Solicitud"><i class="fa fa-file-o"></i></button>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>        