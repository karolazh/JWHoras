<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; Registros</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" onclick="location.href = '{$base_url}/Registro/nuevo'"
                class="btn btn-success">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Registro
        </button>
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
							<th class="text-center hidden" width="5%">ID</th>
							<th class="text-center" width="10%">RUT Paciente</th>
							<th class="text-center" width="5%">Fecha Registro</th>
							<th class="text-center" width="25%">Nombre</th>
							<th class="text-center" width="10%">Comuna</th>
							<th class="text-center" width="25%">Centro Salud</th>
							<th class="text-center" width="10%">Estado</th>
							<th class="text-center" width="5%">Cantidad atenciones</th>
							<th class="text-center" width="5%">Reconoce violencia</th>
							<th class="text-center" width="5%">Participa?</th>
							<th class="text-center" width="1px">Dias primera visita?</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						{foreach $arrResultado as $item}
							<tr>
								<td class="text-center hidden" nowrap> {$item->id_registro} </td>
								<td class="text-center" nowrap> {$item->gl_identificacion} </td>
								<td class="text-center"> {$item->fc_crea} </td>
								<td class="text-left"> {$item->gl_nombres} {$item->gl_apellidos} </td>
								<td class="text-left"> {$item->gl_nombre_comuna} </td>
								<td class="text-center"> {$item->gl_nombre} </td>
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
											<span class="label label-success">Si</span>
										{else}								
											<span class="label label-danger">No</span>										
										{/if}																
								
								</td>
								<td class="text-center" nowrap> {$item->nr_dias_primera_visita} </td>
								<td class="text-center" nowrap>
									
										<button type="button" 
												onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/ver/{$item->id_registro}', 'Detalle Registro', 85);" 
												data-toggle="tooltip" 
												class="btn btn-xs btn-info"
												title="Ver Registro">
											<i class="fa fa-search"></i>
										</button>
                                        <button type="button" class="btn btn-xs btn-success" 
                                                onClick="location.href='{$base_url}/Empa/nuevo/{$item->id_registro}'" 
                                                data-toggle="tooltip" title="Formulario EMPA">
                                            <i class="fa fa-book"></i>
                                        </button>
										{if $item->bo_reconoce == 0}
											<button type="button" class="btn btn-xs btn-danger guardarReconoce" 
													data="{$item->id_registro}" 
													data-toggle="tooltip" title="Reconoce Violencia">
												<i class="fa fa-bullhorn"></i>
											</button>
										{/if}
										
										<button type="button" 
												onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/bitacora/{$item->id_registro}', 'Registro número : {$item->id_registro}', 85);" 
												{*onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/detalleRegistro/{$item->gl_rut}', 'Bitácora paciente RUT : {$item->gl_rut}', 85);" *}
												data-toggle="tooltip" 
												title="Revisar bitácora" 
												class="btn btn-xs btn-primary">
											<i class="fa fa-info-circle"></i>
										</button>
												
								</td>          
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>

        </div>
    </div>    
</section>