<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Usuarios
        <small>Administración</small>
    </h1>

</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de usuarios</h3>
            <button class="btn btn-sm btn-success btn-flat pull-right"
                    onClick="location.href='{$base_url}/MantenedorUsuarios/nuevo'">
                <i class="fa fa-plus"></i> Nuevo usuario
            </button>
        </div>
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small">
                {grilla}
            </div>
        </div>
    </div>
</section>

