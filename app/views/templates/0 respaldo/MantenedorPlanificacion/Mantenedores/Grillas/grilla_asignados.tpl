<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
        <tr role="row">
            <th align="center">Seleccionar Archivo</th>
            <th align="center">Nombre Archivo</th>
        </tr>
    </thead>
    
    <tbody>
            {foreach $arrListaArchivos as $itm}
                <tr>
                    <td>
                        <input align="center" name="id_archivo" type="radio" value={$itm->id_archivo} />
                    </td> 
                    <td>{$itm->nombre_archivo}</td> 
                </tr>
            {/foreach}
            <input  type="hidden" name="usuario" id="usuario" value="{$usuario}"></input>
    </tbody>
</table>        