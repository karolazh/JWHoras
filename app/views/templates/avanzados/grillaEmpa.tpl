<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                    <tr role="row">
                        <th align="center" width="10%">Fecha</th>
                        <th align="center" width="">Comuna</th>
                        <th align="center" width="">Institucion</th>
                        <th align="center" width="10%">Usuario</th>
                        {*<th align="center" width="20%">Acciones</th>*}
                    </tr>
                </thead>
            <tbody>
            <!-- PRUEBA -->
            {*<tr>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td class="text-center" style="width:100px;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                onClick="xModal.open('{$base_url}/Registro/ver/{$item->id_empa}', 'Registro número : {$item->id_registro}', 85);" 
                                data-toggle="tooltip" title="Ver EMPA">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;EMPA
                        </button>&nbsp;
                        <button type="button" class="btn btn-sm btn-success btn-flat" 
                                onClick="xModal.open('{$base_url}/Empa/verEmpa/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
                                data-toggle="tooltip" title="Ver Registro">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;REGISTRO
                        </button>&nbsp;
                    </div>
                </td>
            </tr>*}
            <!-- FIN PRUEBA -->
            {foreach $arrEmpa as $emp}
                <tr>
                    <td>{$emp->fc_empa}</td>
                    <td>{$emp->comuna}</td>
                    <td>{$emp->institucion}</td>
                    <td>{$emp->rut}</td>
                    <td class="text-center" style="width:100px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                    {*onClick="location.href='{$base_url}/Empa/verEmpa/{$emp->id_empa}'" *}
                                    onClick="xModal.open('{$base_url}/Registro/ver/{$item->id_empa}', 'Registro número : {$item->id_registro}', 85);" 
                                    data-toggle="tooltip" title="Ver EMPA">
                                <i class="fa fa-eye"></i>&nbsp;&nbsp;EMPA
                            </button>&nbsp;
                            <button type="button" class="btn btn-sm btn-success btn-flat" 
                                    {*onClick="location.href='{$base_url}/Empa/verEmpa/{$emp->id_registro}'" *}
                                    onClick="xModal.open('{$base_url}/Empa/verEmpa/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
                                    data-toggle="tooltip" title="Ver Registro">
                                <i class="fa fa-eye"></i>&nbsp;&nbsp;REGISTRO
                            </button>&nbsp;
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>