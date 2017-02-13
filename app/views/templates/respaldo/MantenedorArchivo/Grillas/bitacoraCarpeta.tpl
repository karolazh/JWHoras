<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Bitacora</h1>
{$id_carpeta_archivo}
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small">
             {include file="MantenedorArchivo/Grillas/grilla_bitacora.tpl"}
             </div>
        </div>
        
    </div>
</section>
