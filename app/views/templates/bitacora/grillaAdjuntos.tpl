<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small col-lg-12">
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                
                <th align="center" width="10%">Fecha</th>
                <th align="center" width="10%">Tipo</th>
                <th align="center" width="20%">Documento</th>
                <th align="center" width="30%">Comentario</th>
                <th align="center" width="20%">Funcionario</th>
                <th align="center" width="10%">Descargar</th>
            </thead>
            <tbody>
            {foreach $arrAdjuntos as $adj}
                <tr>
                    <td>{$adj->fc_crea}</td>
                    <td>{$adj->gl_nombre_tipo_adjunto}</td>
                    <td>{$adj->archivo}</td>
                    <td>{$adj->gl_glosa}</td>
                    <td>{$adj->funcionario}</td>
                    <td align="center">
                        <a class="btn btn-sm btn-primary" id="btnDescarga" href = '{$smarty.const.DIR_BASE}{$adj->gl_path}' target="_blank">
                            <i class="fa fa-download"></i>
                            Descargar</a>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>