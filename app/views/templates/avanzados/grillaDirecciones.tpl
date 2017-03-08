<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small col-lg-12">
        <br>
        <label class="control-label"><h5>Historial de Direcciones</h5></label>
        <br>
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <th align="center" width="10%">Fecha</th>
                <th align="center" width="20%">Direcci&oacute;n</th>
                <th align="center" width="20%">Comuna</th>
                <th align="center" width="20%">Regi&oacute;n</th>
                <th align="center" width="10%">Estado</th>
                <th align="center" width="20%">Funcionario</th>
            </thead>
            <tbody>
            {foreach $arrDirecciones as $dir}
                <tr>
                    <td>{$dir->fc_crea}</td>
                    <td>{$dir->gl_direccion}</td>
                    <td>{$dir->gl_nombre_comuna}</td>
                    <td>{$dir->gl_nombre_region}</td>
                    <td align="center">
                        {if $dir->bo_estado == 1}
                            <h6><b><span class="label label-success small">VIGENTE</span></b></h6>                            
                        {else}
                            <h6><b><span class="label label-danger small">NO VIGENTE</span></b></h6>
                        {/if}
                    </td>
                    <td>{$dir->funcionario}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>