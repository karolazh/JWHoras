<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha Asignado</th>
                    <th align="center" width="10%">Fecha Toma</th>
                    <th align="center" width="30%">Examen</th>
                    <th align="center" width="30%">RUT</th>
                    <th align="center" width="30%">Paciente</th>
                    <th align="center" width="10%">Fecha Resultado Examen</th>
                    <th align="center" width="5%">Resultado</th>
                    <th align="center" width="5%">Acciones</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrExamenes as $exa}
				{assign var="color" value=""}
				{if $exa->gl_resultado == "A"}
					{assign var="color" value="color:#ff0000; background: #F7D3D2; font-weight: bold;"}
				{/if}

                <tr>
                    <td style="{$color}">
						{if $exa->gl_resultado == "A" && $exa->id_paciente_examen == 0}                        
                            {$exa->fc_ultimo_pap_mes}-{$exa->fc_ultimo_pap_ano}
                        {else}
							{$exa->fc_crea}
                        {/if}
                    </td>
                    <td style="{$color}">
                        {if $exa->fc_toma}
                            {$exa->fc_toma}
                        {else}
                            SIN INFORMACION
                        {/if}
                    </td>
                    <td style="{$color}">{$exa->gl_nombre_examen}</td>
                    <td style="{$color}">{$exa->gl_rut}</td>
                    <td style="{$color}">{$exa->gl_nombres} {$exa->gl_apellidos}</td>
                    <td style="{$color}">{$exa->fc_resultado}</td>
                    <td style="{$color}" align="center">
						{if $exa->gl_resultado == "N"}
                            <h6><b><span class="label label-success">NORMAL</span></b></h6>
                        {else if $exa->gl_resultado == "A"}
							<h6><b><span class="label label-danger" style="color:#ffffff">ALTERADO</span></b></h6>
                        {else}
                            <h6><b><span class="label label-warning">AGENDADO</span></b></h6>
                        {/if}
                    </td>
                    <td style="{$color}" class="text-center" style="width:70px;">
                        {if $exa->gl_resultado == "N" and $exa->id_paciente_examen != 0}
                        <button type="button" 
                            onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/{$exa->id_paciente_examen}/', 'Agenda Examen Paciente : {$exa->id_paciente}', 85);" 
                            class="btn btn-xs btn-info"
                            data-toggle="tooltip" 
                            title="Ver Examen">
                            <i class="fa fa-eye"></i>
                        </button>
                        {else}
                            &nbsp;
                        {/if}
                   </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>