<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; {$titulo} </h1>
    <div class="col-md-12 text-right">
		{if $mostrar_plan != 1 and $mostrar_especialista != 1 and $mostrar_gestor != 1}
        <button type="button" id="ingresar" onclick="location.href = '{$base_url}/Paciente/nuevo'"
                class="btn btn-success">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Registro
        </button>
		{/if}
    </div>
    <br/><br/>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
                <div class="table-responsive col-lg-12" data-row="10">
                        <table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
                                <thead>
                                        <tr role="row">
                                                <th class="text-center" width="3%">RUT / Pasaporte</th>
                                                <th class="text-center" width="3%">Fecha Registro</th>
                                                <th class="text-center" width="25%">Nombre</th>
                                                <th class="text-center" width="10%">Comuna</th>
                                                <th class="text-center" width="25%">Centro Salud</th>
                                                <th class="text-center" width="5%">Cantidad atenciones</th>
                                                <th class="text-center" width="5%">Reconoce violencia</th>
                                                <th class="text-center" width="5%">Participa</th>
                                                <th class="text-center" width="5%">Exámen PAP o Mamografía Alterado</th>
                                                <th class="text-center" width="1px">Dias primera visita?</th>
                                                <th class="text-center">Opciones</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        {foreach $arrResultado as $item}
                                                {if $item->nr_examen_alterado > 0 or $item->gl_examen_alterado_externo > 0}
                                                <tr>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-center" nowrap> {$item->gl_identificacion} </td>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-center"> {$item->fc_crea} </td>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-left"> {$item->gl_nombres} {$item->gl_apellidos} </td>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-left"> {$item->gl_nombre_comuna} </td>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-center"> {$item->gl_institucion} </td>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-center" nowrap> {$item->nr_motivo_consulta} </td>
                                                        <td style="background: #F7D3D2;" class="text-center" nowrap>
                                                                {if $item->bo_reconoce == 1}
                                                                        <span class="label label-danger">Si</span>
                                                                {else}
                                                                        <span class="label label-success">No</span>
                                                                {/if}
                                                        </td>
                                                        <td style="background: #F7D3D2;" class="text-center" nowrap>
                                                                {if $item->bo_acepta_programa == 1}
                                                                        <span class="label label-danger">Si</span>
                                                                {else}
                                                                        <span class="label label-success">No</span>
                                                                {/if}
                                                        </td>
                                                        <td style="background: #F7D3D2;" class="text-center" nowrap>
                                                                <span class="label label-danger">Si</span>
                                                        </td>
                                                        <td style="color:#ff0000; background: #F7D3D2;" class="text-center" nowrap> {$item->nr_dias_primera_visita} </td>
                                                        <td style="background: #F7D3D2;" class="text-center" nowrap>
                                                                <button type="button" 
                                                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" 
                                                                        data-toggle="tooltip" 
                                                                        class="btn btn-xs btn-info"
                                                                        data-title="Ver Registro">
                                                                        <i class="fa fa-search"></i>
                                                                </button>
																{if $mostrar_especialista != 1 and $mostrar_gestor != 1}
                                                                <button type="button" 
                                                                        class="btn btn-xs btn-success" 
                                                                        onClick="location.href='{$base_url}/Empa/nuevo/{$item->id_paciente}';" 
                                                                        data-toggle="tooltip" data-title="Formulario EMPA">
                                                                        <i class="fa fa-book"></i>
                                                                </button>
																{/if}
                                                                {if $item->bo_reconoce == 0}
                                                                        <button type="button" class="btn btn-xs btn-danger" 
                                                                                onClick="location.href='{$base_url}/Reconoce/identificarAgresor/{$item->id_paciente}';"
                                                                                data-toggle="tooltip" data-title="Reconoce Violencia">
                                                                                <i class="fa fa-bullhorn"></i>
                                                                        </button>
                                                                {/if}
																{if $item->bo_reconoce == 1 and $mostrar_gestor == 1}
                                                                        <button type="button" class="btn btn-xs btn-info" 
                                                                                onClick=""
                                                                                data-toggle="tooltip" data-title="Dimensiones">
                                                                                <i class="fa fa-area-chart"></i>
                                                                        </button>
                                                                {/if}
                                                                {if $mostrar_plan == 1}
                                                                <button type="button"
                                                                        onclick="location.href = '{$base_url}/Medico/plan_tratamiento/{$item->id_paciente}'"
                                                                        data-toggle="tooltip" 
                                                                        data-title="Plan Tratamiento" 
                                                                        class="btn btn-xs btn-default">
                                                                        <i class="fa fa-medkit"></i>
                                                                </button>
                                                                {/if}
																{if $mostrar_especialista == 1}
                                                                <button type="button"
                                                                        onclick="location.href = '{$base_url}/Especialista/diagnostico/{$item->id_paciente}'"
                                                                        data-toggle="tooltip" 
                                                                        data-title="Diagnóstico" 
                                                                        class="btn btn-xs btn-default">
                                                                        <i class="fa fa-user-md"></i>
                                                                </button>
                                                                {/if}
																{if $mostrar_gestor == 1}
                                                                <button type="button"
                                                                        onclick="location.href = '{$base_url}/Gestor/seguimiento/{$item->id_paciente}'"
                                                                        data-toggle="tooltip" 
                                                                        data-title="Seguimiento" 
                                                                        class="btn btn-xs btn-default">
                                                                        <i class="fa fa-file-text"></i>
                                                                </button>
                                                                {/if}
                                                                <button type="button"
                                                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
                                                                        data-toggle="tooltip" 
                                                                        data-title="Revisar bitácora" 
                                                                        class="btn btn-xs btn-primary">
                                                                        <i class="fa fa-info-circle"></i>
                                                                </button>
																{if $mostrar_especialista != 1 and $mostrar_gestor != 1}
                                                                <button type="button"
                                                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/ver/{$item->id_paciente}', 'Agenda Examen Paciente : {$item->id_paciente}', 85);" 
                                                                        data-toggle="tooltip" 
                                                                        data-title="Agenda Examen"
                                                                        class="btn btn-xs btn-warning">
                                                                        <i class="fa fa-calendar"></i>
                                                                </button>
																{/if}
																{if $mostrar_especialista == 1 or $mostrar_gestor == 1}
                                                                <button type="button"
                                                                        onClick="" 
                                                                        data-toggle="tooltip" 
                                                                        data-title="ReAgendar"
                                                                        class="btn btn-xs btn-warning">
                                                                        <i class="fa fa-calendar"></i>
                                                                </button>
																{/if}
                                                        </td>
                                                </tr>
                                                {else}
                                                <tr>
                                                        <td class="text-center" nowrap> {$item->gl_identificacion} </td>
                                                        <td class="text-center"> {$item->fc_crea} </td>
                                                        <td class="text-left"> {$item->gl_nombres} {$item->gl_apellidos} </td>
                                                        <td class="text-left"> {$item->gl_nombre_comuna} </td>
                                                        <td class="text-center"> {$item->gl_institucion} </td>
                                                        <td class="text-center" nowrap> {$item->nr_motivo_consulta} </td>
                                                        <td class="text-center" nowrap> 
                                                                {if $item->bo_reconoce == 1}
                                                                        <span class="label label-danger">Si</span>
                                                                {else}
                                                                        <span class="label label-success">No</span>
                                                                {/if}
                                                        </td>
                                                        <td class="text-center" nowrap>
                                                                {if $item->bo_acepta_programa == 1}
                                                                        <span class="label label-danger">Si</span>
                                                                {else}
                                                                        <span class="label label-success">No</span>
                                                                {/if}								
                                                        </td>
                                                        <td class="text-center" nowrap>
                                                                <span class="label label-success">No</span>
                                                        </td>
                                                        <td class="text-center" nowrap> {$item->nr_dias_primera_visita} </td>
                                                        <td class="text-center" nowrap>
                                                                <button type="button" 
                                                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Paciente/ver/{$item->id_paciente}', 'Detalle Registro', 85);" 
                                                                        data-toggle="tooltip" 
                                                                        class="btn btn-xs btn-info"
                                                                        data-title="Ver Registro">
                                                                        <i class="fa fa-search"></i>
                                                                </button>
																{if $mostrar_especialista != 1 and $mostrar_gestor != 1}
                                                                <button type="button" 
                                                                        class="btn btn-xs btn-success" 
                                                                        onClick="location.href='{$base_url}/Empa/nuevo/{$item->id_paciente}';" 
                                                                        data-toggle="tooltip" data-title="Formulario EMPA">
                                                                        <i class="fa fa-book"></i>
                                                                </button>
																{/if}
                                                                {if $item->bo_reconoce == 0}
                                                                        <button type="button" class="btn btn-xs btn-danger" 
                                                                                onClick="location.href='{$base_url}/Reconoce/identificarAgresor/{$item->id_paciente}';"
                                                                                data-toggle="tooltip" data-title="Reconoce Violencia">
                                                                                <i class="fa fa-bullhorn"></i>
                                                                        </button>
                                                                {/if}
																
																{if $item->bo_reconoce == 1 and $mostrar_gestor == 1}
                                                                        <button type="button" class="btn btn-xs btn-info" 
                                                                                onClick=""
                                                                                data-toggle="tooltip" data-title="Dimensiones">
                                                                                <i class="fa fa-area-chart"></i>
                                                                        </button>
                                                                {/if}
                                                                {if $mostrar_plan == 1}
                                                                <button type="button"
                                                                        onclick="location.href = '{$base_url}/Medico/plan_tratamiento/{$item->id_paciente}'"
                                                                        data-toggle="tooltip" 
                                                                        data-title="Plan Tratamiento" 
                                                                        class="btn btn-xs btn-default">
                                                                        <i class="fa fa-medkit"></i>
                                                                </button>
                                                                {/if}
																{if $mostrar_especialista == 1}
                                                                <button type="button"
                                                                        onclick="location.href = '{$base_url}/Especialista/diagnostico/{$item->id_paciente}'"
                                                                        data-toggle="tooltip" 
                                                                        data-title="Diagnóstico" 
                                                                        class="btn btn-xs btn-default">
                                                                        <i class="fa fa-file-text"></i>
                                                                </button>
                                                                {/if}
																{if $mostrar_gestor == 1}
                                                                <button type="button"
                                                                        onclick="location.href = '{$base_url}/Gestor/seguimiento/{$item->id_paciente}'"
                                                                        data-toggle="tooltip" 
                                                                        data-title="Seguimiento" 
                                                                        class="btn btn-xs btn-default">
                                                                        <i class="fa fa-file-text"></i>
                                                                </button>
                                                                {/if}
                                                                <button type="button"
                                                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
                                                                        data-toggle="tooltip" 
                                                                        data-title="Revisar bitácora" 
                                                                        class="btn btn-xs btn-primary">
                                                                        <i class="fa fa-info-circle"></i>
                                                                </button>
																{if $mostrar_especialista != 1 and $mostrar_gestor != 1}
                                                                <button type="button"
                                                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/ver/{$item->id_paciente}', 'Agenda Examen Paciente : {$item->id_paciente}', 85);" 
                                                                        data-toggle="tooltip" 
                                                                        data-title="Agenda Examen"
                                                                        class="btn btn-xs btn-warning">
                                                                        <i class="fa fa-calendar"></i>
                                                                </button>
																{/if}
																{if $mostrar_especialista == 1 or $mostrar_gestor == 1}
                                                                <button type="button"
                                                                        onClick="" 
                                                                        data-toggle="tooltip" 
                                                                        data-title="ReAgendar"
                                                                        class="btn btn-xs btn-warning">
                                                                        <i class="fa fa-calendar"></i>
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
    </div>    
</section>