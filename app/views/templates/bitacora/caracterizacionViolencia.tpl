<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<div class="box-body">

	<div class="form-group">
		<div class="form-group col-md-12">
			<div class="table-responsive small" align="center" data-row="10">
				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
					<thead>
						<tr role="row">
							<th align="center" width="35%">Tipo de Violencia</th>
							<th align="center" width="10%">Ausente</th>
							<th align="center" width="10%">Leve</th>
							<th align="center" width="10%">Moderada</th>
							<th align="center" width="10%">Severa</th>
						</tr>
					</thead>
					<tbody>
						{$cant_pre = 0}
						{foreach $arrTipoViolencia as $item}
							{$i = $item->id_tipo_violencia}
							{$n = $i - 1}
							{$row = "row_"}
							{$cant_pre = $cant_pre + 1}
							{assign var="row_n" value="`$row``$n`"}
							<tr>
								<td class="text-center" nowrap>{$item->gl_tipo_violencia}</td>
								<td class="text-center"><input class="id_tipo_violencia" disabled value="{$item->gl_respuesta_1}" data='{$i}' {if $item->gl_respuesta_1 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
								<td class="text-center"><input class="id_tipo_violencia" disabled value="{$item->gl_respuesta_2}" data='{$i}' {if $item->gl_respuesta_2 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
								<td class="text-center"><input class="id_tipo_violencia" disabled value="{$item->gl_respuesta_3}" data='{$i}' {if $item->gl_respuesta_3 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
								<td class="text-center"><input class="id_tipo_violencia" disabled value="{$item->gl_respuesta_4}" data='{$i}' {if $item->gl_respuesta_4 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
			<input type="text" value="{$cant_pre}" id="cant_pre" name="cant_pre" class="hidden">
		</div>
    </div>
		
	<div class="form-group col-md-12">
		<div class="col-md-1">
            <label class="control-label">Tipo de Riesgo : </label>
        </div>
		<div class="col-md-1">
		<label><span class="label label-{$color}">{$tipo_riesgo}</span></label>
		</div>
	</div>

</div>