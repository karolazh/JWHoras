<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
    <tr role="row">
        <th align="center"># Carpeta</th>
        <th align="center">Nombre Carpeta</th>
        <th align="center">Creador Carpeta</th>
        <th align="center">Fecha creaci&oacuten</th>
        <th width="1px" align="center">Acciones</th>
    </tr>
    </thead>
    <tbody>
        {foreach $arrResultado as $itm}
            <tr>
                <td nowrap width="100px" align="center"> {$itm->id_carpeta_archivo} </td>
                <td class="text-center">{$itm->nombre}</td>
                <td nowrap width="100px" align="center">{$itm->nombres}</td>           
                <td class="text-center">{$itm->fc_fecha_creacion}</td>
                <td class="text-center" style="width:100px;">
                <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success btn-flat" onClick="location.href='{$base_url}/MantenedorArchivos/revisarSolicitud/{$itm->id_carpeta_archivo}'" data-toggle="tooltip" title="Ver Carpeta"><i class="fa fa-file-o"></i></button>
                        <a href='javascript:void(0)' onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/BitacoraCarpeta/{$itm->id_carpeta_archivo}','Bitácora Carpeta {$itm->id_carpeta_archivo}: {$itm->nombre} ',85);" data-toggle="tooltip" title="Bitácora" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-search"></i></a>
                </div>
               </td>          
            </tr>
        {/foreach}
    </tbody>
</table>        