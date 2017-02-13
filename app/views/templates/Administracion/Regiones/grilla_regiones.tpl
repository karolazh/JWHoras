<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
        <tr role="row">
            <th align="center"># ID</th>
            {*<th align="center">Código</th>*}
            <th align="center">Nombre</th>
            <th width="1px" align="center">Acciones</th>
        </tr>
    </thead>
    
    <tbody>
    {foreach $arrResultado as $item}
        <tr>
            <td nowrap width="100px" align="center"> {$item->id} </td>
            {*<td class="text-center">{$item->asunto|truncate:60:"...":true}</td>*}
            <td class="text-center">{$item->nombre}</td>
            
            <td align="center">
                {*<button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                        onClick="xModal.open('{$smarty.const.BASE_URI}/Solicitudes/revisarSolicitud/{$item->id_solicitud}',
                                             'Revisar Solicitud',85);">
                    <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                </button>*}
                <button data-toggle="tooltip" type="button" class="btn btn-sm btn-success btn-flat" title="Ver Detalle" 
                        onClick="">
                    <i class="fa fa-edit"></i>&nbsp;&nbsp;Ver
                </button>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>