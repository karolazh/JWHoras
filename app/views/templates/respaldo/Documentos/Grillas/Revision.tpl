<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Documentos <small>Revisión de Documentos</small></h1>
</section>


<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de documentos a revisar </h3>
            <button class="btn btn-xs btn-link pull-right" onClick="location.href='{$base_url}/MantenedorUsuarios/index'"
                    style="float: right">
                <i class="fa fa-backward"></i> Ir Atrás
            </button>
        </div>
        <div class="box-body">
            <div class="top-spaced table-responsive" id="contenedor-grilla-revision">
                {include file="Documentos/Grillas/grilla_revision.tpl"}
            </div>
        </div>
    </div>
</section>
