<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Bitacora Archivo</h1>
</section>


    <table class="table table-hover table-bordered table-middle">
        <thead>
        <tr>
            <th>Nombre archivo</th>
            <th>Fecha Subida</th>
            <th>Version</th>
            <th>Usuario</th>
            <th>Accion</th>
        </tr>
        </thead>
        <tbody>
       
        {foreach from=$arr item=item}
            <tr>
                <td class="text-center">{$item->nombre_archivo}</td>
                <td class="text-center">{$item->fc_fecha_archivo}</td>
                <td class="text-center">{$item->version}</td>
                <td class="text-center">{$item->nombres}</td>
                <td nowrap width="100px" align="center"> 
                <button type="button" class="btn btn-sm btn-flat btn-success" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verAdjuntoCarpeta/{$item->id_archivo}','_blank');" data-toggle="tooltip" title="Ver Adjunto Carpeta"><i class="fa fa-file-o"></i></button>
                </td>
            </tr>
        {/foreach}
       </tbody>
    </table>
