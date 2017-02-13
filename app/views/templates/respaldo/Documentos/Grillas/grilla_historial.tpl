<table class="table table-hover table-bordered table-middle">
    <thead>
    <tr>
        <th>Fecha Evento</th>
        <th>Descripción</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$historial item=item}
        <tr>
            <td class="text-center">{Fechas::formatearHtml($item->fc_fecha_historial)}</td>
            <td class="text-center">{$item->gl_evento_historial}</td>
            <td class="text-center">{$item->nombres|mb_strtoupper} {$item->apellidos|mb_strtoupper}</td>
        </tr>
    {/foreach}
    </tbody>
</table>