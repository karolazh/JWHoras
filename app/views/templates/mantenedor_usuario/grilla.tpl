<table class="table table-hover table-condensed table-bordered datatables small table-middle" id="grilla">
	<thead>
		<tr>
			<th>N°</th>
			<th>Nombre</th>
			<th>RUT</th>
			<th>Perfil</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$arr_data item=itm}
		<tr>
			<td>{$itm->id_usuario}</td>
			<td>{$itm->gl_nombres} {$itm->gl_apellidos}</td>
			<td>{$itm->gl_rut}</td>
			<td>{$itm->gl_nombre_perfil}</td>
			<td>
				{if $itm->bo_activo == 1}
					<div style="color:green;"> Activo </div>
				{else}
					<div style="color:red;"> Inactivo </div>
				{/if}
			</td>
			<td>
				<button type="button"
						onclick="xModal.open('{$smarty.const.BASE_URI}/Mantenedor/editarUsuario/{$itm->id_usuario}','Editar Usuario',80);"
						data-toggle="tooltip"
						class="btn btn-xs btn-success" 
						title="Editar Perfil">
						<i class="fa fa-edit"></i>
				</button>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>