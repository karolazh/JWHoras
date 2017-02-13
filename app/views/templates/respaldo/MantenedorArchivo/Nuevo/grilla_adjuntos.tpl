{if $adjuntos}
    <table class="table table-hover table-bordered table-middle">
        <thead>
        <tr>
            <th>Nombre archivo</th>
            <th>Fecha Subida</th>
            <th>Usuario</th>
            <th style="width:100px;"></th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$adjuntos item=item}
            <tr>
                <td class="text-center">{$item.nombre_archivo}</td>
                <td class="text-center">{$item.fecha}</td>
                <td class="text-center">{$item.usuario}</td>
                <td class="text-center" style="width:100px;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger btn-flat" onclick="MantenedorArchivos.borrarAdjunto({$item.indice});" title="ELIMINAR ARCHIVO CARPETA"><i class="fa fa-remove"></i></button>
                        <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/Solicitudes/verAdjunto/{$item.indice}','_blank');" title="VER ADJUNTO CARPETA"><i class="fa fa-file-o"></i></button>
                     </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/if}