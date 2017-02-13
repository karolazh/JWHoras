<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Proyectos <small>Asignados</small></h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Proyectos</h3>
            <button class="btn btn-xs btn-link pull-right" onClick="location.href='{$base_url}/MantenedorSolicitudes/index'"
                    style="float: right">
                <i class="fa fa-backward"></i> Ir Atras
            </button>
        </div>
        <div class="box-body">
            <div class="top-spaced table-responsive" id="contenedor-grilla-asignados">
                {include file="MantenedorArchivo/Grillas/grilla_asignados.tpl"}
            </div>
        </div>

    </div>
</section>
