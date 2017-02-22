<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                    <tr role="row">
                        <th align="center" width="5%">Fecha</th>
                        <th align="center" width="">Examen</th>
                        <th align="center" width="">Laboratorio</th>
                        <th align="center" width="10%">Resultado</th>
                        <th align="center" width="15%">Acciones</th>
                    </tr>
                </thead>
            <tbody>
            <!-- PRUEBA -->
            <tr>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td align="center"><span class="label label-success">NORMAL</span></td>
                <td class="text-center" style="width:100px;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                onClick="xModal.open('{$base_url}/Registro/ver/{$item->id_empa}', 'Registro número : {$item->id_registro}', 85);" 
                                data-toggle="tooltip" title="Ver Examen">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                        </button>&nbsp;
                        <button type="button" class="btn btn-sm btn-success btn-flat" 
                                onClick="xModal.open('{$base_url}/Empa/verEmpa/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
                                data-toggle="tooltip" title="Editar Exámen">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;Editar
                        </button>&nbsp;
                    </div>
                </td>
            </tr>
            <tr>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td align="center"><span class="label label-danger">ALTERADO</span></td>
                <td class="text-center" style="width:100px;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                onClick="xModal.open('{$base_url}/Registro/ver/{$item->id_empa}', 'Registro número : {$item->id_registro}', 85);" 
                                data-toggle="tooltip" title="Ver Examen">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                        </button>&nbsp;
                        <button type="button" class="btn btn-sm btn-success btn-flat" 
                                onClick="xModal.open('{$base_url}/Empa/verEmpa/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
                                data-toggle="tooltip" title="Editar Exámen">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;Editar
                        </button>&nbsp;
                    </div>
                </td>
            </tr>
            <!-- FIN PRUEBA -->
            {foreach $arrExamenes as $exa}
                <tr>
                    <td>{$exa->fc_crea}</td>
                    <td>{$exa->nombre_examen}</td>
                    <td>{$exa->nombre_laboratorio}</td>
                    <td>{$exa->resultado}</td>
                    {*<td class="text-center" style="width:100px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn btn-danger btn-flat" 
                                    onClick="xModal.open('{$base_url}/Registro/ver/{$item->id_empa}', 'Registro número : {$item->id_registro}', 85);" 
                                    data-toggle="tooltip" title="Ver Examen">
                                <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver
                            </button>&nbsp;
                            <button type="button" class="btn btn-sm btn-success btn-flat" 
                                    onClick="xModal.open('{$base_url}/Empa/verEmpa/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
                                    data-toggle="tooltip" title="Editar Exámen">
                                <i class="fa fa-eye"></i>&nbsp;&nbsp;Editar
                            </button>&nbsp;
                        </div>
                    </td>*}
                </tr>
            {/foreach}
            </tbody>
        </table>            
    </div>
</div>