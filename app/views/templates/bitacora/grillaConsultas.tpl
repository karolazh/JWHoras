<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small col-lg-12">
        <br>
        <label class="control-label"><h5>Atenciones de Urgencia</h5></label>
        <br>
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha Ing</th>
                    <th align="center" width="10%">Hora Ing</th>
                    <th align="center" width="30%">Motivo Consulta</th>
                    <th align="center" width="30%">Instituci&oacute;n</th>
                    <th align="center" width="20%">Funcionario</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrConsultas as $con}
                <tr>
                    <td>{$con->fc_ingreso}</td>
                    <td>{$con->gl_hora_ingreso}</td>
                    <td>{$con->gl_motivo_consulta}</td>
                    <td>{$con->gl_nombre_establecimiento}</td>
                    <td>{$con->funcionario}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>