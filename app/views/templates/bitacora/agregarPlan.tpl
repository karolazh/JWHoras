<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">
	<div class="table-responsive col-lg-12" data-row="10">
		<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
			<thead>
				<tr role="row">
					<th class="text-center" width="10%">Especialista</th>
					<th class="text-center" width="5%">Observación</th>
					<th class="text-center" width="25%">Fecha</th>
				</tr>
			</thead>
			<tbody>
				{foreach $arr_plan as $item}
					<tr>
						<td class="text-center" nowrap> {$item->gl_nombre_especialidad} </td>
						<td class="text-center" nowrap> {$item->gl_agenda_observacion} {$item->gl_observacion_diagnostico}</td>
						<td class="text-center" nowrap> {$item->fecha_agenda} {$item->hora_agenda} {$item->fecha_diagnostico} {$item->hora_diagnostico}</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>  