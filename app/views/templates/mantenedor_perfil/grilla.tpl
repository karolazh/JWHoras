<table class="table table-hover table-condensed table-bordered datatables small table-middle" id="grilla">
	<thead>
		<tr>
			<th>N°</th>
			<th>Nombre</th>
			<th>Descripción</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$arr_data item=itm}
		<tr>
			<td>{$itm->id_perfil}</td>
			<td>{$itm->gl_nombre_perfil}</td>
			<td>{$itm->gl_descripcion}</td>
			<td>
				{if $itm->bo_estado == "1"}
					<div style="color:green;"> Activo </div>
				{else}
					<div style="color:red;"> Inactivo </div>
				{/if}
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-success" data-title="Editar" onclick="xModal.open('{$smarty.const.BASE_URI}/Mantenedor/editarPerfil/{$itm->id_perfil}','Editar Perfil','70');"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-xs btn-info" data-title="Editar MENU" onclick="xModal.open('{$smarty.const.BASE_URI}/Mantenedor/editarPerfilOpcion/{$itm->id_perfil}','Editar Menú','70');"><i class="fa fa-cogs"></i></button>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>