<table class="table table-hover table-condensed table-bordered datatables small table-middle" id="grilla">
	<thead>
		<tr>
			<th>N°</th>
			<th>Nombre Padre</th>
			<th>Nombre Opción</th>
			<th>URL</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$arr_data item=itm}
		<tr>
			<td>{$itm->id_opcion}</td>
			<td>{$itm->gl_nombre_padre}</td>
			<td>{$itm->gl_nombre_opcion}</td>
			<td>{$itm->gl_url}</td>
			<td>
				{if $itm->bo_estado == 1}
					<div style="color:green;"> Activo </div>
				{else}
					<div style="color:red;"> Inactivo </div>
				{/if}
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-success" title="Editar" onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/editarMenuOpcion/{$itm->id_opcion}','Editar Menú Opción','70');"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-xs btn-info" title="Editar MENU" onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/editarMenuPerfil/{$itm->id_opcion}','Editar Menú Perfil','70');"><i class="fa fa-cogs"></i></button>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>