<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Planificacion de actividades</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/MantenedorPlanificacion"><i class="fa fa-folder-open"></i>Planificacion de actividades</a></li>
        </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mantenedor de Archivos</h3>
          <!--  <button class="btn btn-sm btn-success btn-flat pull-right" onClick="location.href='{$base_url}/MantenedorArchivos/Nuevo'"><i class="fa fa-plus"></i> Crear nueva carpeta</button>-->
        </div>
      
        <div class="box-body">
            <div id="div_tabla" class="table-responsive small">
                {include file="MantenedorArchivo/Grillas/grilla_asignados.tpl"}
            </div>
        </div>
        
    </div>
</section>