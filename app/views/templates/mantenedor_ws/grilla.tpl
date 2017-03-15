<table class="table table-hover table-condensed table-bordered datatables small table-middle" id="grilla">
	<thead>
		<tr>
			<th>N°</th>
			<th>Nombre</th>
			<th>Ambiente</th>
			<th>WSDL</th>
			<th>URL</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$arr_data item=itm}
		<tr>
			<td>{$itm->id_sistema}</td>
			<td>{$itm->gl_nombre}</td>
			<td>{$itm->gl_ambiente|strtoupper}</td>
			<td>{$itm->sistema_wsdl}</td>
			<td>{$itm->sistema_url}</td>
			<td>
				{if $itm->bo_estado == 1}
					<div style="color:green;"> Activo </div>
				{else}
					<div style="color:red;"> Inactivo </div>
				{/if}
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-success" title="Editar" onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/editarWebService/{$itm->id_sistema}','Editar WebService','70');"><i class="fa fa-edit"></i></button>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>