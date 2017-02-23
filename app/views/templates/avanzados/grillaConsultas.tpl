<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha Ing</th>
                    <th align="center" width="10%">Hora Ing</th>
                    <th align="center" width="">Motivo Consulta</th>
                    <th align="center" width="15%">Usuario</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrConsultas as $con}
                <tr>
                    <td>{$con->fc_ingreso}</td>
                    <td>{$con->hora_ingreso}</td>
                    <td>{$con->motivo_consulta}</td>
                    <td>{$con->rut}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>