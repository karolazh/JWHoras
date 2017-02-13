<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
    <thead>
		<tr role="row">
			<th align="center"># Actividad</th>
			<th align="center">Actividad</th>
			<th align="center">Fecha Creación</th>
			<th align="center">Creador Actividad</th>
			<th width="1px" align="center">Acciones</th>
		</tr>
    </thead>
    <tbody>
        {foreach $arrResultado as $itm}
            <tr>
                <td nowrap width="100px" align="center"> {$itm->id_actividad} </td>
				<td nowrap width="100px" align="center"> {$itm->actividad} </td>
                <td class="text-center">{$itm->fecha_creacion_actividad}</td>
                <td nowrap width="100px" align="center">{$itm->nombres} {$itm->apellidos}</td>           
                <td class="text-center" style="width:100px;">				
                <div class="btn-group">
					<button type="button" class="btn btn-sm btn-success btn-flat" onClick="location.href='{$base_url}/MantenedorActividades/revisarActividad/{$itm->id_actividad}'" data-toggle="tooltip" title="Ver Actividad"><i class="fa fa-file-o"></i></button>
				</div>			
               </td>          
            </tr>
        {/foreach}
    </tbody>
</table>        