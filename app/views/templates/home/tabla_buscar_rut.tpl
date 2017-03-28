<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  dataTable no-footer" width="100%">
	<thead>
		<tr role="row">
			<th align="center">ID</th>
			<th align="center">Rut</th>
			<th align="center">Razón social</th>
			<th align="center">Nombre de fantasía</th>
			<th align="center">Direcci&oacute;n</th>
			<th align="center">N&uacute;mero</th>
			<th align="center">Comuna</th>
			<th align="center">Oficina</th>
			<th align="center">Coordenadas</th>
			<th align="center">Ambitos</th>
			<th align="center">Actividades</th>
			<th width="1px" align="center">&nbsp;</th></tr>
	</thead>
	<tbody>
	
	{foreach $arrResultado as $itm}
		<tr>
			<td nowrap width="100px" align="center" {if $itm->gl_origen|trim == "ASD"} style="background-color:#76EC76 !important" {/if} >{$itm->ins_ia_id}</td>
			<td nowrap width="100px" align="center">{$itm->ins_c_rut}</td>
			<td>{$itm->ins_c_razon_social}</td>
			<td>{$itm->ins_c_nombre_fantasia}</td>
			<td>
				{$itm->ins_c_nombre_direccion}<br>
				{$itm->ins_c_resto_direccion}
			</td>

			<td align="center">{$itm->ins_c_numero_direccion}</td>
			<td align="center">{$itm->nombre_comuna}</td>
			<td align="center" nowrap>{$itm->nombre_oficina}</td>
			<td align="center">
				{if $itm->ins_c_coordenada_e != "" }
					SI
				{else}
					--
				{/if}
			</td>			
			<td align="center">{$itm->nr_total_ambitos}</td>
			<td align="center">{$itm->nr_total_actividades}</td>
			<td nowrap>
				<button data-toggle="tooltip" type="button" class="btn btn-xs btn-success" data-title="Ver Detalle" onClick="detalle({$itm->ins_ia_id})">
					<i class="fa fa-edit"></i>&nbsp;&nbsp;VER
				</button>
				<button data-toggle="tooltip" type="button" class="btn btn-xs btn-success" data-title="Ver Detalle" onClick="colorbox('carpeta_digital/index.php/AdjuntosInstalacion/editar/?id_instalacion={$itm->ins_ia_id}');">
					<i class="fa fa-edit"></i>&nbsp;&nbsp;Editar
				</button>				
			</td>
		</tr>
	{/foreach}	
	</tbody>
</table>		