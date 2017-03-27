
<div class="panel panel-primary">
	<div class="panel-body">
		<form id="formAudit"class="form-horizontal" role="form">
			<input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
			<div class="table-responsive col-lg-12" data-row="10">
				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered ">
					<thead>
						<tr role="row">
							<th class="text-center" width="30%">Pregunta</th>
							<th class="text-center" width="5%">0</th>
							<th class="text-center" width="15%">1</th>
							<th class="text-center" width="15%">2</th>
							<th class="text-center" width="15%">3</th>
							<th class="text-center" width="15%">4</th>
							<th class="text-right" width="5%">Puntos</th>
						</tr>
					</thead>
					<tbody>
						{$cant_pre = 0}
						{foreach $arrPreguntas as $item}
							{$i = $item->id_pregunta}
							{$n = $i - 1}
							{$row = "row_"}
							{$cant_pre = $cant_pre + 1}
							{assign var="row_n" value="`$row``$n`"} 
							<tr>
								<td class="text-center"> {$item->gl_pregunta} </td>
								<td class="text-center" for="pregunta_{$i}">
									{if $item->gl_respuesta1} 
										<input id="pregunta_{$i}" name="pregunta_{$i}" value="{$item->nr_respuesta1_puntos}" {if $item->nr_respuesta1_puntos == $arrAudit->$row_n->nr_valor}checked {/if} data='{$i}' type="radio" class="radio_audit" title="{$item->gl_respuesta1}"> {$item->gl_respuesta1}
									{/if}
								</td>
								<td class="text-center" for="pregunta_{$i}">
									{if $item->gl_respuesta2} 
										<input id="pregunta_{$i}" name="pregunta_{$i}" value="{$item->nr_respuesta2_puntos}" {if $item->nr_respuesta2_puntos == $arrAudit->$row_n->nr_valor}checked {/if} data='{$i}' type="radio"  class="radio_audit" title="{$item->gl_respuesta2}"> {$item->gl_respuesta2}
									{/if}
								</td>
								<td class="text-center" for="pregunta_{$i}">
									{if $item->gl_respuesta3} 
										<input id="pregunta_{$i}" name="pregunta_{$i}" value="{$item->nr_respuesta3_puntos}" {if $item->nr_respuesta3_puntos == $arrAudit->$row_n->nr_valor}checked {/if} data='{$i}' type="radio"  class="radio_audit" title="{$item->gl_respuesta3}"> {$item->gl_respuesta3}
									{/if}
								</td>
								<td class="text-center" for="pregunta_{$i}">
									{if $item->gl_respuesta4} 
										<input id="pregunta_{$i}" name="pregunta_{$i}" value="{$item->nr_respuesta4_puntos}" {if $item->nr_respuesta4_puntos == $arrAudit->$row_n->nr_valor}checked {/if} data='{$i}' type="radio"  class="radio_audit" title="{$item->gl_respuesta4}"> {$item->gl_respuesta4}
									{/if}
								</td>
								<td class="text-center" for="pregunta_{$i}">
									{if $item->gl_respuesta5} 
										<input id="pregunta_{$i}" name="pregunta_{$i}" value="{$item->nr_respuesta5_puntos}" {if $item->nr_respuesta5_puntos == $arrAudit->$row_n->nr_valor}checked {/if} data='{$i}' type="radio"  class="radio_audit" title="{$item->gl_respuesta5}"> {$item->gl_respuesta5}
									{/if}
								</td>
								<td class="col-xs-12" for="pregunta_{$i}">
									<input id="puntos_{$i}" class="text-right col-xs-12 subTotal" disabled value="{$arrAudit->$row_n->nr_valor}" >
								</td>
							</tr>
						{/foreach}
						<tr>
							<td colspan="6" class="text-right"><b> TOTAL </b></td>
							<td class="col-xs-12"> <input id="total" class="text-right col-xs-12" value="{$total}" readonly> </td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="top-spaced"></div>
			<div class="form-group col-sm-11" align="right">
				{if $bo_finalizado != 1}
				<button type="button" id="guardaraudit" class="btn btn-success">
					<i class="fa fa-save"></i>  Guardar
				</button>
				{/if}
				{if $bo_finalizado == 1}
				<button type="button" id="volver" class="btn btn-default"
						onclick="xModal.close()">
					<i class="fa fa-arrow-circle-left"></i>  Volver
				</button>
				{/if}
			</div>
			<input type="text" value="{$cant_pre}" id="cant_pre" name="cant_pre" class="hidden">
		</form>
	</div>
</div>