<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Administración de Actividades</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/MantenedorActividades"><i class="fa fa-folder-open"></i>Información de Actividades</a></li>
        </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de Actividades</h3>
            <!--<button class="btn btn-sm btn-success btn-flat pull-right" onClick="location.href='{$base_url}/MantenedorArchivos/Nuevo'"><i class="fa fa-plus"></i> Crear nueva carpeta</button>-->
        </div>

      
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small">
                {include file="MantenedorActividades/Grillas/grilla_actividades.tpl"}
            </div>
        </div>
        
    </div>
</section>