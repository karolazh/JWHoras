<table class="table table-hover table-condensed table-bordered datatable paginada table-striped" >
    <thead>
        <tr style="background-color:#01619E !important; color: white !important">
            <th width="45%">Nombre</th>
            <th width="50%">Descripción</th>
            <th width="50%" align="center">Color/Ícono</th>
            <th width="50%">Activo</th>
            <th width="5%">Acciones</th>
        </tr>
    </thead>
    <tbody>
        {foreach $grilla as $item}
        <tr>
            <td>{$item->nombre}</td>
            <td>{$item->descripcion}</td>
            <td align="center">
				<button class="btn btn-xs btn-{$item->gl_color}" style="float: center">
					<i class="fa {$item->gl_icono} fa-3x icono"></i>
				</button>
			</td>
            <td>{$item->gl_activo}</td>
            <td align="center">
                <button tpye="button" class="btn btn-xs btn-info" title="Editar Sistema" onclick="location.href='{$base_url}/MantenedorSistemas/editar/{$item->id}'">
                    <i class="fa fa-edit"></i>&nbsp;Editar
                </button>		
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>