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
                    <!-- si perfil es "ADMINISTRADOR", "MÉDICO", "ENFERMERA", "LABORATORIO"-->
                    {*{if $_SESSION['perfil'] == "1" or $_SESSION['perfil'] == "2" or
                        $_SESSION['perfil'] == "3" or $_SESSION['perfil'] == "7" }*}
                         <th align="center" width="15%">Acciones</th>
                    {*{/if}*}
                </tr>
            </thead>
            <tbody>
            {foreach $arrExamenes as $exa}
                {if $exa->gl_resultado == "A"}
                <tr>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->fc_crea}</td>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->gl_nombre_examen}</td>
                    <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->gl_nombre_laboratorio}</td>
                    <td style="background: #F7D3D2;" align="center">
                        <h6><b><span class="label label-danger" style="color:#ffffff">ALTERADO</span></b></h6>
                    </td>
                    <!-- si perfil es "ADMINISTRADOR", "MÉDICO", "ENFERMERA", "LABORATORIO"-->
                    {*{if $_SESSION['perfil'] == "1" or $_SESSION['perfil'] == "2" or
                        $_SESSION['perfil'] == "3" or $_SESSION['perfil'] == "7" }*}
                         <td style="background: #F7D3D2;" class="text-center" style="width:70px;">
                            <button type="button" 
                                {*onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" *}
                                {*onclick="habilitarExamen({$exa->id_paciente_examen})"*}
                                onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen},this.form,this);"
                                class="btn btn-xs btn-info"
                                data-toggle="tooltip" 
                                title="Ver Examen">
                                <i class="fa fa-eye"></i>
                            </button>&nbsp;
                            <button type="button" 
                                {*onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" *}
                                {*onclick="habilitarExamen({$exa->id_paciente_examen})"*}
                                onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen},this.form,this);"
                                class="btn btn-xs btn-success"
                                data-toggle="tooltip" 
                                title="Ver Examen">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    {*{/if}*}
                </tr>
                {else}
                <tr>
                    <td>{$exa->fc_crea}</td>
                    <td>{$exa->gl_nombre_examen}</td>
                    <td>{$exa->gl_nombre_laboratorio}</td>
                    <td align="center">
                        {if $exa->gl_resultado == "N"}
                            <h6><b><span class="label label-success">NORMAL</span></b></h6>
                        {else}
                            <h6><b><span class="label label-warning">SIN INFORMACI&Oacute;N</span></b></h6>
                        {/if}
                    </td>
                    <!-- si perfil es "ADMINISTRADOR", "MÉDICO", "ENFERMERA", "LABORATORIO"-->
                    {*{if $_SESSION['perfil'] == "1" or $_SESSION['perfil'] == "2" or
                        $_SESSION['perfil'] == "3" or $_SESSION['perfil'] == "7" }*}
                         <td class="text-center" style="width:70px;">
                            <button type="button" 
                                {*onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" *}
                                {*onclick="habilitarExamen({$exa->id_paciente_examen})"*}
                                onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen},this.form,this);"
                                class="btn btn-xs btn-info"
                                data-toggle="tooltip" 
                                title="Ver Examen">
                                <i class="fa fa-eye"></i>
                            </button>&nbsp;
                            <button type="button" 
                                {*onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" *}
                                {*onclick="habilitarExamen({$exa->id_paciente_examen})"*}
                                onclick="Laboratorio.buscarExamen({$exa->id_paciente_examen},this.form,this);"
                                class="btn btn-xs btn-success"
                                data-toggle="tooltip" 
                                title="Ver Examen">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    {*{/if}*}
                </tr>
                {/if}
            {/foreach}
            </tbody>
        </table>
    </div>
</div>