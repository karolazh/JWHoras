<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Proyectos
        <small>Administración</small>
    </h1>

</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de proyectos</h3>
            <button class="btn btn-sm btn-success btn-flat pull-right"
                    onClick="location.href='{$base_url}/Proyecto/nuevo_proyecto'">
                <i class="fa fa-plus"></i> Nuevo proyecto
            </button>
        </div>
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small">
                {grilla}                
            </div>
        </div>
    </div>
</section>

