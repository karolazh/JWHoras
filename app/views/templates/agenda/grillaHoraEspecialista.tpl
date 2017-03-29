<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
    <div id="div_tabla" class="table-responsive small"> 
        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
            <thead>
                <tr role="row">
                    <th align="center" width="10%">Fecha Asignado</th>
                    <th align="center" width="10%">Fecha Toma</th>
					{if $mostrar_agenda_paciente == 1}
                    <th align="center" width="25%">Especialidad</th>
					{/if}
                    <th align="center" width="15%">RUT / Pasaporte</th>
                    <th align="center" width="20%">Paciente</th>
                    <th align="center" width="25%">Observaciones</th>
                    <th align="center" width="5%">Acciones</th>
                </tr>
            </thead>
            <tbody>
            {foreach $arrHoraEspecialista as $esp}
				{assign var="color" value=""}
				{if $esp->gl_resultado == "A"}
					{assign var="color" value="color:#ff0000; background: #F7D3D2; font-weight: bold;"}
				{/if}

                <tr>
                    <td style="{$color}">
						{$esp->fc_crea}
                    </td>
                    <td style="{$color}">
                        {if $esp->fecha_agenda}
                            {$esp->fecha_agenda}
                        {else}
                            SIN INFORMACION
                        {/if}
                    </td>
					{if $mostrar_agenda_paciente == 1}
                    <td style="{$color}">{$esp->gl_especialidad}</td>
					{/if}
                    <td style="{$color}">{$esp->gl_identificacion}</td>
                    <td style="{$color}">{$esp->gl_nombres_paciente} {$esp->gl_apellidos_paciente}</td>
                    <td style="{$color}">{$esp->gl_agenda_observacion}</td>
                    <td style="{$color}" class="text-center" style="width:70px;">
                        {if $esp->gl_resultado == "N" and $esp->id_paciente_examen != 0}
                        <button type="button" 
                            onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/{$esp->id_paciente_examen}/', 'Agenda Examen Paciente : {$esp->id_paciente}', 85);" 
                            class="btn btn-xs btn-info"
                            data-toggle="tooltip" 
                            data-title="Ver Examen">
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