<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha Registro</th>
                    <th align="center" width="30%">Examen</th>
                    <th align="center" width="30%">Laboratorio</th>
                    <th align="center" width="10%">Fecha Toma Examen</th>
                    <th align="center" width="10%">Fecha Resultado Examen</th>
                    <th align="center" width="10%">Resultado</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrExamenes as $exa}
                {if $exa->gl_resultado == "A"}
                <tr>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->fc_crea}</td>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->gl_nombre_examen}</td>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->gl_nombre_laboratorio}</td>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->fc_toma}</td>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->fc_resultado}</td>
                    <td style="background: #F7D3D2;"align="center">
                        <h6><b><span class="label label-danger" style="color:#ffffff">ALTERADO</span></b></h6>
                    </td>
                </tr>
                {else}
                <tr>
                    <td>{$exa->fc_crea}</td>
                    <td>{$exa->gl_nombre_examen}</td>
                    <td>{$exa->gl_nombre_laboratorio}</td>
                    <td>{$exa->fc_toma}</td>
                    <td>{$exa->fc_resultado}</td>
                    <td align="center">
                        {if $exa->gl_resultado == "N"}
                            <h6><b><span class="label label-success">NORMAL</span></b></h6>
                        {else}
                            <h6><b><span class="label label-warning">AGENDADO</span></b></h6>
                        {/if}
                    </td>
                </tr>
                {/if}
            {/foreach}
            </tbody>
        </table>
    </div>
</div>