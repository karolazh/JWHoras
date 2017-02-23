<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Perfiles
        <small>Administración</small>
    </h1>

</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de perfiles</h3>
            <button class="btn btn-sm btn-success btn-flat pull-right"
                    onClick="location.href='{$base_url}/Perfiles/nuevo_perfil'">
                <i class="fa fa-plus"></i> Nuevo perfil
            </button>
        </div>
        <div class="box-body">
            <div id="div_tabla_perfil" class="table-responsive small">
                {grilla}
            </div>
        </div>
    </div>
</section>

