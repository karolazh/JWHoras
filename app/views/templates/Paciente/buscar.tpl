<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; Buscar Paciente </h1>
    <br/><br/>
</section>

<section class="content">
	<div class="panel panel-primary">
		<div class="panel-heading">
			
		</div>
		<div class="panel-body">
		
			<form id="form" action="#" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="rut" class="control-label col-sm-2">Rut</label>
					<div class="col-sm-3">
						<input type="text" name="rut" id="rut" value="{$rut}"
							   placeholder="Rut" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
					<label for="pasaporte" class="control-label col-sm-1">Pasaporte</label>
					<div class="col-sm-3">
						<input type="text" name="pasaporte" id="pasaporte" value="{$pasaporte}" 
							   placeholder="Pasaporte (Extranjero)" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2">Nombres</label>
					<div class="col-sm-3">
						<input type="text" name="nombres" id="nombres" value="{$nombres}"
							   placeholder="Nombres" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
					<label for="apellidos" class="control-label col-sm-1">Apellidos</label>
					<div class="col-sm-3">
						<input type="text" name="apellidos" id="apellidos" value="{$apellidos}" 
							   placeholder="Apellidos" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="cod_fonasa" class="control-label col-sm-2">Código Fonasa</label>
					<div class="col-sm-3">
						<input type="text" name="cod_fonasa" id="cod_fonasa" value="{$cod_fonasa}"
							   placeholder="Código Fonasa" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
					<label for="centro_salud" class="control-label col-sm-1">Centro de Salud</label>
					<div class="col-sm-3">
						<select for="centro_salud" class="form-control" id="centro_salud" name="centro_salud">
						<option value="0">Seleccione un Centro de Salud</option>
						{foreach $arrCentroSalud as $item}
							<option value="{$item->id_centro_salud}" >{$item->gl_nombre_establecimiento}</option>
						{/foreach}
						</select>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="region" class="control-label col-sm-2">Región</label>
					<div class="col-sm-3">
						<select for="region" class="form-control" id="region" name="region" onchange="Region.cargarComunasPorRegion(this.value, 'comuna')">
							<option value="0">Seleccione una Región</option>
							{foreach $arrRegiones as $item}
								<option value="{$item->id_region}" >{$item->gl_nombre_region}</option>
							{/foreach}
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>

					<label for="comuna" class="control-label col-sm-1">Comuna</label>
					<div class="col-sm-3">
						<select for="comuna" class="form-control" id="comuna" name="comuna">
							<option value="0">Seleccione una Comuna</option>
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>

					<div class="col-sm-1">
						<button type="submit" id="buscar" class="btn btn-info">
							<i class="fa fa-search"></i>  Buscar
						</button>
					</div>
				</div>
			
			</form>
		</div>
	</div>

	<div class="top-spaced"></div>

	{if $mostrar==1}
		<div class="panel panel-primary">
			<div class="panel-heading">
				Resultado de la Búsqueda
			</div>
			<div class="panel-body">
				{if isset($errorWS)}
					<div class="alert alert-danger">Hubo un problema al obtener los Soportes.<br> Favor intentar nuevamente o contactarse con Administrador.</div>
				{else}
					<div class="table-responsive col-lg-12" data-row="10">
						<table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
							<thead>
								<tr role="row">
									<!-- th class="text-center" width="1%">ID</th -->
									<th class="text-center" width="5%">RUT / Pasaporte</th>
									<th class="text-center" width="5%">Fecha Registro</th>
									<th class="text-center" width="25%">Nombre</th>
									<th class="text-center" width="10%">Comuna</th>
									<th class="text-center" width="25%">Centro Salud</th>
									<th class="text-center" width="10%">Estado</th>
									<th class="text-center" width="5%">Cantidad atenciones</th>
									<th class="text-center" width="5%">Reconoce violencia</th>
									<th class="text-center" width="5%">Participa</th>
									<th class="text-center" width="5%">Exámen PAP o Mamografía Alterado</th>
									<th class="text-center" width="1px">Dias primera visita?</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								{foreach $arrResultado as $item}
									{if $item->nr_examen_alterado > 0}
										<tr>
												<!-- td class="text-center"> {$item->id_paciente} </td -->
											<td style="color:#ff0000; background: #F7D3D2;" class="text-center" nowrap> {$item->gl_identificacion} </td>
											<td style="color:#ff0000; background: #F7D3D2;" class="text-center"> {$item->fc_crea} </td>
											<td style="color:#ff0000; background: #F7D3D2;" class="text-left"> {$item->gl_nombres} {$item->gl_apellidos} </td>
											<td style="color:#ff0000; background: #F7D3D2;" class="text-left"> {$item->gl_nombre_comuna} </td>
											<td style="color:#ff0000; background: #F7D3D2;" class="text-center"> {$item->gl_institucion} </td>
											<td style="color:#ff0000; background: #F7D3D2;" class="text-center" nowrap> {$item->gl_nombre_estado_caso} </td>
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
														title="Ver Registro">
													<i class="fa fa-search"></i>
												</button>
												<button type="button" 
														class="btn btn-xs btn-success" 
														onClick="location.href = '{$base_url}/Empa/nuevo/{$item->id_paciente}';" 
														data-toggle="tooltip" title="Formulario EMPA">
													<i class="fa fa-book"></i>
												</button>
												{if $item->bo_reconoce == 0}
													<button type="button" class="btn btn-xs btn-danger" 
															onClick="location.href = '{$base_url}/Reconoce/identificarAgresor/{$item->id_paciente}';"
															data-toggle="tooltip" title="Reconoce Violencia">
														<i class="fa fa-bullhorn"></i>
													</button>
												{/if}
												{if $mostrar_plan == 1}
													<button type="button"
															onclick="location.href = '{$base_url}/Medico/plan_tratamiento/{$item->id_paciente}'"
															data-toggle="tooltip" 
															title="Plan Tratamiento" 
															class="btn btn-xs btn-default">
														<i class="fa fa-medkit"></i>
													</button>
												{/if}
												<button type="button"
														onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
														data-toggle="tooltip" 
														title="Revisar bitácora" 
														class="btn btn-xs btn-primary">
													<i class="fa fa-info-circle"></i>
												</button>
											</td>
										</tr>
									{else}
										<tr>
												<!-- td class="text-center"> {$item->id_paciente} </td -->
											<td class="text-center" nowrap> {$item->gl_identificacion} </td>
											<td class="text-center"> {$item->fc_crea} </td>
											<td class="text-left"> {$item->gl_nombres} {$item->gl_apellidos} </td>
											<td class="text-left"> {$item->gl_nombre_comuna} </td>
											<td class="text-center"> {$item->gl_institucion} </td>
											<td class="text-center" nowrap> {$item->gl_nombre_estado_caso} </td>
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
														title="Ver Registro">
													<i class="fa fa-search"></i>
												</button>
												<button type="button" 
														class="btn btn-xs btn-success" 
														onClick="location.href = '{$base_url}/Empa/nuevo/{$item->id_paciente}';" 
														data-toggle="tooltip" title="Formulario EMPA">
													<i class="fa fa-book"></i>
												</button>
												{if $item->bo_reconoce == 0}
													<button type="button" class="btn btn-xs btn-danger" 
															onClick="location.href = '{$base_url}/Reconoce/identificarAgresor/{$item->id_paciente}';"
															data-toggle="tooltip" title="Reconoce Violencia">
														<i class="fa fa-bullhorn"></i>
													</button>
												{/if}
												{if $mostrar_plan == 1}
													<button type="button"
															onclick="location.href = '{$base_url}/Medico/plan_tratamiento/{$item->id_paciente}'"
															data-toggle="tooltip" 
															title="Plan Tratamiento" 
															class="btn btn-xs btn-default">
														<i class="fa fa-medkit"></i>
													</button>
												{/if}
												<button type="button"
														onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$item->id_paciente}', 'Registro número : {$item->id_paciente}', 85);" 
														data-toggle="tooltip" 
														title="Revisar bitácora" 
														class="btn btn-xs btn-primary">
													<i class="fa fa-info-circle"></i>
												</button>
											</td>
										</tr>

									{/if}	

								{/foreach}
							</tbody>
						</table>
					</div>
				{/if}
			</div>
		</div>
	{/if}	
</section>