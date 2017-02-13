{if $adjuntos}
    <table class="table table-hover table-bordered table-middle">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha Subida</th>
            <th>Usuario</th>
            <th style="width:100px;"></th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$adjuntos item=item}
            <tr>
                <td class="text-center">{$item.name}</td>
                <td class="text-center">{$item.fecha}</td>
                <td class="text-center">{$item.usuario}</td>
                <td class="text-center" style="width:100px;">
                    <div class="btn-group">
                    {if $smarty.session.perfil == 2 and ($solicitud->cd_estado_solicitud == 0)}
                        <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/Solicitudes/verAdjunto/{$item.indice}','_blank');" title="VER ADJUNTO">
                            <i class="fa fa-file-o"></i></button>
                        {if !isset($lectura)}
                            {if !isset($item.visador)}
                                <button type="button" class="btn btn-sm btn-danger btn-flat" onclick="Solicitudes.borrarAdjunto({$item.indice});" title="ELIMINAR">
                                    <i class="fa fa-remove"></i></button>
                            {else}
                                <button type="button" class="btn btn-sm btn-danger btn-flat" onclick="parent.Solicitudes.borrarAdjunto({$item.indice},'visador');" title="ELIMINAR">
                                    <i class="fa fa-remove"></i></button>
                            {/if}
                        {/if}
                    {elseif $smarty.session.perfil == 2 and $solicitud->cd_estado_solicitud != 0}
                        <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/Solicitudes/verAdjunto/{$item.indice}','_blank');" title="VER ADJUNTO">
                            <i class="fa fa-file-o"></i></button>
                    {elseif $smarty.session.perfil == 1}
                        {if !isset($solicitud)}
                            <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/Solicitudes/verAdjunto/{$item.indice}','_blank');" title="VER ADJUNTO">
                                <i class="fa fa-file-o"></i></button>
                            {if !isset($lectura)}
                                <button type="button" class="btn btn-sm btn-danger btn-flat" onclick="Solicitudes.borrarAdjunto({$item.indice});" title="ELIMINAR">
                                    <i class="fa fa-remove"></i></button>
                            {/if}
                        {else}
                            <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/Solicitudes/verAdjunto/{$item.indice}','_blank');" title="VER ADJUNTO">
                                <i class="fa fa-file-o"></i></button>
                        {/if}

                    {/if}
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/if}