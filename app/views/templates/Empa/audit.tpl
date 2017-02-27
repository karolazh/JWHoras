
	<div class="panel panel-primary">

		<div class="panel-body">
			
			<div class="table-responsive col-lg-12" data-row="10">
				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered ">
					<thead>
						<tr role="row">
							<th class="text-center" width="40%">Pregunta</th>
							<th class="text-center" width="10%">0</th>
							<th class="text-center" width="10%">1</th>
							<th class="text-center" width="10%">2</th>
							<th class="text-center" width="10%">3</th>
							<th class="text-center" width="10%">4</th>
							<th class="text-center" width="10%">Puntos</th>
						</tr>
					</thead>
					<tbody>
                                                {$i = 0}
						{foreach $registro as $item}
							<tr>
                                                            <td class="text-center"> {$item->gl_pregunta} </td>
								<td class="text-center" for="pregunta_{$i}">  <input id="pregunta_{$i}" name="pregunta_{$i}" type="radio" title="{$item->gl_respuesta1}"> {$item->gl_respuesta1} </td>
								<td class="text-center" for="pregunta_{$i}">  <input id="pregunta_{$i}" name="pregunta_{$i}" type="radio" title="{$item->gl_respuesta2}"> {$item->gl_respuesta2} </td>
								<td class="text-center" for="pregunta_{$i}">  <input id="pregunta_{$i}" name="pregunta_{$i}" type="radio" title="{$item->gl_respuesta3}"> {$item->gl_respuesta3} </td>
								<td class="text-center" for="pregunta_{$i}">  <input id="pregunta_{$i}" name="pregunta_{$i}" type="radio" title="{$item->gl_respuesta4}"> {$item->gl_respuesta4} </td>
								<td class="text-center" for="pregunta_{$i}">  <input id="pregunta_{$i}" name="pregunta_{$i}" type="radio" title="{$item->gl_respuesta5}"> {$item->gl_respuesta5} </td>
								<td class="text-center" for="pregunta_{$i}"> <span id="puntos_{$item->id_pregunta}"> </span>  </td>
							</tr>
                                                        {$i++}
						{/foreach}
							<tr>
								<td colspan="6" class="text-right">  TOTAL </td>
								<td  class="text-center"> <input id="total" value="10"> </td>
							</tr>
					</tbody>
				</table>
			</div>

			<div class="top-spaced"></div>

			<div class="form-group col-sm-11" align="right">
				<button type="button" id="guardaraudit" class="btn btn-success">
					<i class="fa fa-save"></i>  Guardar
				</button>
			</div>

		</div>
	</div>