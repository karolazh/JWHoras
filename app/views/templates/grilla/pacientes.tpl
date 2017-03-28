<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; {$origen} </h1>
    <div class="col-md-12 text-right">
		{if $origen == 'Pacientes'}
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
							<input type="text" value="{$item->id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
							{assign var="color" value=""}
							{assign var="alarmaExamen" value="<span class='label label-success'> No </span>"}
							{if $item->nr_examen_alterado > 0 or $item->gl_examen_alterado_externo > 0 or ($item->bo_reconoce == 1 and $mostrar_gestor == 1)}
								{* assign var="color" value="color:#ff0000; background: #F7D3D2;" *}
								{assign var="alarmaExamen" value="<span class='label label-danger'> Si </span>"}
							{/if}
							<tr>
								<td style="{$color}" class="text-center" nowrap> {$item->gl_identificacion} </td>
								<td style="{$color}" class="text-center"> {$item->fc_crea} </td>
								<td style="{$color}" class="text-left"> {$item->gl_nombres} {$item->gl_apellidos} </td>
								<td style="{$color}" class="text-left"> {$item->gl_nombre_comuna} </td>
								<td style="{$color}" class="text-center"> {$item->gl_centro_salud} </td>
								<td style="{$color}" class="text-center" nowrap> {$item->nr_motivo_consulta} </td>
								<td style="{$color}" class="text-center" nowrap>
									{if $item->bo_reconoce == 1}
										<span class="label label-danger"> Si </span>
									{else}
										<span class="label label-success"> No </span>
									{/if}
								</td>
								<td style="{$color}" class="text-center" nowrap>
									{if $item->bo_acepta_programa == 1}
										<span class="label label-success"> Si </span>
									{else}
										<span class="label label-danger"> No </span>
									{/if}
								</td>
								<td style="{$color}" class="text-center" nowrap>
									{$alarmaExamen}
								</td>
								<td style="{$color}" class="text-center" nowrap> {$item->nr_dias_primera_visita} </td>
								<td style="{$color}" class="text-center" nowrap>
									{if $item->bo_reconoce == 0}
										<button type="button" class="btn btn-xs btn-danger" 
											onClick="location.href='{$base_url}/Reconoce/identificarAgresor/{$item->id_paciente}';"
											data-toggle="tooltip" data-title="Reconoce Violencia">
											<i class="fa fa-bullhorn"></i>
										</button>
									
									{else if $item->bo_reconoce == 1 && ($origen == 'Pacientes Gestor Nacional' || $origen == 'Pacientes Gestor Regional')}
										<button type="button" class="btn btn-xs btn-default" 
											onClick=""
											data-toggle="tooltip" data-title="Dimensiones">
											<i class="fa fa-key"></i>
										</button>
									{/if}
									{$arrOpcion}
								</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
        </div>
    </div>    
</section>