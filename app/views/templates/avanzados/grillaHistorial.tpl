<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <th align="center" width="10%">Usuario</th>
                <th align="center" width="10%">Fecha</th>
                <th align="center" width="20%">Tipo</th>
                <th align="center" width="">Comentario</th>
            </thead>
            <tbody>
            {foreach $arrHistorial as $his}
                <tr>
                    <td>{$his->rut}</td>
                    <td>{$his->fc_crea}</td>
                    <td>{$his->nombre_evento}</td>
                    <td>{$his->glosa}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>