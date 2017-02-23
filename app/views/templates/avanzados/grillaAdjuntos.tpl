<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                
                <th align="center" width="10%">Fecha</th>
                <th align="center" width="20%">Tipo</th>
                <th align="center" width="30">Nombre Documento</th>
                <th align="center" width="30">Comentario</th>
                <th align="center" width="10%">Usuario</th>
            </thead>
            <tbody>
            {foreach $arrAdjuntos as $adj}
                <tr>
                    <td>{$adj->fc_crea}</td>
                    <td>{$adj->nombre_tipo_adjunto}</td>
                    <td>{$adj->path}</td>
                    <td>{$adj->glosa}</td>
                    <td>{$adj->rut}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>