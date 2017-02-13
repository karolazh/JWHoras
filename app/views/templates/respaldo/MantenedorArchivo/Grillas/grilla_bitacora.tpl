<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
        <tr role="row">
            <th align="center"># evento</th>
            <th align="center">Nombre</th>
            <th align="center">Nombre Usuario</th>
            <th align="center">Fecha</th>
        </tr>
    </thead>
    <tbody>
        {foreach $arrResultadoBitacora as $itm}
            <tr>
                <td class="text-center">{$itm->id_bitacora}</td>
                <td class="text-center">{$itm->nombre_evento_bitacora}</td>
                <td class="text-center">{$itm->nombres}</td>
                <td class="text-center">{$itm->fecha_bitacora}</td>
            </tr>
        {/foreach}
    </tbody>
</table> 