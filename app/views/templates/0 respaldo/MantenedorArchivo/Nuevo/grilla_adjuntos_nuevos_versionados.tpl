{if $adjuntos}
    <table class="table table-hover table-bordered table-middle">
        <thead>
        <tr>
            <th>Nombre archivo Nuevo</th>
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
                <input  type="hidden" name="version" id="version" value="{$version}"></input>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger btn-flat" onclick="MantenedorArchivos.borrarAdjuntoNuevo({$item.indice});" title="ELIMINAR ARCHIVO NUEVO"><i class="fa fa-remove"></i></button>
                        <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/Solicitudes/verAdjunto/{$item.indice}','_blank');" title="VER ADJUNTO CARPETA"><i class="fa fa-file-o"></i></button>
                        <button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorArchivos.guardarNuevoArchivoVersion(this.form,this);">Adjuntar Nuevo Archivo version</button> 
                     </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/if}