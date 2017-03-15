<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small col-lg-12">
        <label class="control-label"><h5>Ex&aacute;menes Alterados</h5></label>
        <br>
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha Registro</th>
                    <th align="center" width="30%">Examen</th>
                    <th align="center" width="30%">Laboratorio</th>
                    <th align="center" width="10%">Fecha Toma Muestra</th>
                    <th align="center" width="10%">Fecha Resultado Muestra</th>
                    <th align="center" width="10%">Resultado</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrExamenesAlt as $exa}
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
            {/foreach}
            </tbody>
        </table>
        <div class="top-spaced"></div>
    </div>
</div>