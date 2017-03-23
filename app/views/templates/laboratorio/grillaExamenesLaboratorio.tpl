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
                    <th align="center" width="10%">Acciones</th>
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
                    <td style="background: #F7D3D2;" align="center">
                        <h6><b><span class="label label-danger" style="color:#ffffff">ALTERADO</span></b></h6>
                    </td>
                    <td style="background: #F7D3D2;" class="text-center" style="width:70px;">
                       <button type="button" 
                           {*onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen});"*}
                           onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/{$exa->id_paciente_examen}/', 'Agenda Examen registro número : {$exa->id_paciente}', 85);" 
                           class="btn btn-xs btn-info"
                           data-toggle="tooltip" 
                           title="Ver Examen">
                           <i class="fa fa-eye"></i>
                       </button>
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
                    <td class="text-center" style="width:70px;">
                        {if $exa->gl_resultado == "N"}
                            <button type="button" 
                                {*onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen});"*}
                                onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/{$exa->id_paciente_examen}/', 'Agenda Examen registro número : {$exa->id_paciente}', 85);" 
                                class="btn btn-xs btn-info"
                                data-toggle="tooltip" 
                                title="Ver Examen">
                                <i class="fa fa-eye"></i>
                            </button>
                        {else}
                            <button type="button" 
                                {*onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen});"*}
                                onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/2/{$exa->id_paciente_examen}/', 'Agenda Examen número : {$exa->id_paciente}', 85);" 
                                class="btn btn-xs btn-success"
                                data-toggle="tooltip" 
                                title="Registrar Resultado">
                                <i class="fa fa-pencil"></i>
                            </button>
                        {/if}
                   </td>
                </tr>
                {/if}
            {/foreach}
            </tbody>
        </table>
    </div>
</div>