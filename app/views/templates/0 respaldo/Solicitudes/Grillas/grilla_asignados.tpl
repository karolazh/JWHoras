<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
    <tr role="row">
        <th align="center">ID</th>
        <th align="center">Proyecto</th>
        <th align="center">Asunto</th>
        <th align="center">Comentario</th>
        <th align="center">Fecha Límite</th>
        <th align="center">Estado</th>
        <th align="center">Prioridad</th>
        <th align="center">Días restantes</th>
        <th width="1px" align="center">Acciones</th>
    </tr>
    </thead>
    <tbody>

    {foreach $arrResultado as $itm}
        <tr>
            <td nowrap width="100px" align="center"> {$itm->id_solicitud} </td>
            <td class="text-center">{$itm->nombre_proyecto}</td>
            <td class="text-center">{$itm->asunto|truncate:60:"...":true}</td>
            <td nowrap width="100px" align="center">{$itm->gl_comentario|truncate:60:"...":true}</td>
            <td class="text-center">{$itm->fecha_entrega}</td>
            <td class="text-center">{$itm->desc_estado}</td>
            <td nowrap class="text-center">{$itm->desc_prioridad}</td>
            <td align="center" nowrap>
                <div style="height: 25px; width: 50px;    margin-left: 5px;">
                    <div style="width:20px;float:left">{Fechas::diffDiasTickets({$fechaHoy},{$itm->fecha_entrega})}</div>
                    <div style="float:left; margin-top:-1px">
                        <img src ="../../static/images/estado_entrega_ticket/{Fechas::diffDiasAlerta({$fechaHoy},{$itm->fecha_entrega})}" width="12px" height="12px"/>
                    </div>
                    </div>
            </td>
            <td align="center">
                <button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" onClick="xModal.open('{$smarty.const.BASE_URI}/Solicitudes/revisarSolicitud/{$itm->id_solicitud}','Revisar Solicitud',85);">
                    <i class="fa fa-edit"></i>&nbsp;&nbsp;Revisar
                </button>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>        