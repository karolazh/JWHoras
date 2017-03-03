<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
        <tr role="row">
            <th align="center"># evento</th>
            <th align="center">Nombre</th>
            <th align="center">Fecha</th>
        </tr>
    </thead>
    <tbody>
        {foreach $revisar_carpeta as $itm}
            <tr>
                <td class="text-center">{$itm->nombre} </td>
                <td class="text-center">{$itm->nombre} </td>
                <td class="text-center">{$itm->nombre} </td>
                <!--
                <td class="text-center">{$itm->fc_fecha_archivo}</td>
                <div class="btn-group">
                       <button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verAdjunto/{$itm.indice}','_blank');" title="VER ADJUNTO CARPETA"><i class="fa fa-file-o"></i></button>
                </div>
                </td> 
               -->      
            </tr>
        {/foreach}
    </tbody>
</table> 