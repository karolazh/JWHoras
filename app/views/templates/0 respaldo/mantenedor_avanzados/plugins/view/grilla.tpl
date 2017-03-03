<table class="table table-hover table-condensed table-bordered datatable paginada">
    <thead>
        <tr>
            <th>Rut</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        {foreach $grilla as $item}
        <tr>
            <td class="text-center">{$item->rut}</td>
            <td class="text-center">{$item->nombres}</td>
            <td class="text-center">{$item->apellidos}</td>
            <td class="text-center">{$item->email}</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-success" title="Editar Usuario" onclick="location.href='{$base_url}/MantenedorUsuarios/editar/{$item->id}'">
                    <i class="fa fa-edit"></i>
                </button>

                <!--<button tpye="button" class="btn btn-sm btn-success" title="Resetear Password"><i class="fa fa-lock"></i></button>-->
                <button type="button" class="btn btn-sm btn-danger" title="Eliminar Usuario"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>