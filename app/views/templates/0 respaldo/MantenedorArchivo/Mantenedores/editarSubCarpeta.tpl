<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Editar Sub Carpeta {$revisar_carpeta->id_archivo}</h1>
</section>

<div class="box box-success">
    <div class="box-body">

<form role="form" class="form-horizontal">
    <div class="row">

        <div class="col-md-6 top-spaced">
            <div class="margin-bottom-10"></div>
            
            <div class="box-header">Ver detalle de Sub carpeta {$revisar_carpeta->nombre}
                <a href='javascript:void(0)' onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verDetalleCarpeta/{$revisar_carpeta->id_carpeta_archivo}','Detalle {$revisar_carpeta->nombre}',85);" data-toggle="tooltip" title="Ver detalle" class="btn btn-sm btn-flat btn-primary" title="Ver Detalle"><i class="fa fa-search"></i></a>
             </div>             
        </div>      
    </div>
   
    <div class="top-spaced">
        <div class="box box-info">
            <div class="box-header">Adjuntar Nuevos archivos a editar
                <button type="button" class="btn btn-success btn-xs btn-flat" onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/adjuntarArchivoNuevo','Adjuntar Archivos',50,'adjuntar',true,280);"><i class="fa fa-upload"></i></button>
            </div>
            
            <!-- Campos carga Automatica -->
            <input  type="hidden" name="id_carpeta_archivo" id="id_carpeta_archivo" value="{$id_carpeta_archivo}"></input>
            <input  type="hidden" name="id_usuario_modifica" id="id_usuario_modifica" value="{$id_usuario}"></input>

            <div class="box-header">
            	<button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorArchivos.guardarNuevoArchivoSubCarpeta(this.form,this);">Adjuntar Nuevo Archivo</button>
               <!-- <button type="button" class="btn btn-success pull-right btn-flat" onClick="location.href='{$base_url}/MantenedorArchivos/crearsubcarpeta/{$revisar_carpeta->id_carpeta_archivo}'"></i> Crear nueva Subcarpeta</button>-->
            </div>
            
            <div class="panel-body">
                <div class="table-responsive" id="lista_adjuntos_nuevos"></div>

            </div>
        </div>
    </div>

    <section class="content-header">
        <h1>Archivos adjuntados a la sub carpeta</h1>
    </section>

    <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
        <thead>
            <tr role="row">
                    <th align="center"># Archivo</th>
                    <th align="center">Nombre archivo</th>
                    <th align="center">Fecha Subida</th>
                    <th align="center">Fecha modificaci&oacuten</th>
                    <th align="center">Usuario</th>
                    <th align="center">Estado</th>
                    <th align="center">Accion</th>
            </tr>
        </thead>
        <tbody>
            {foreach $revisar as $item}
                 <tr>
                     <td nowrap width="100px" align="center">{$item->id_archivo}</td>
                     <td nowrap width="100px" align="center">{$item->nombre_archivo}</td>
                     <td nowrap width="100px" align="center">{$item->fc_fecha_archivo}</td>
                     <td nowrap width="100px" align="center">{$item->fecha_update}</td>
                     <td nowrap width="100px" align="center">{$item->nombres}</td>
                     <td nowrap width="100px" align="center">{$item->nombre_archivo_estado}</td>
                     <td nowrap width="100px" align="center"> 
                        <button type="button" class="btn btn-sm btn-flat btn-success" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verAdjuntoCarpeta/{$item->id_archivo}','_blank');" data-toggle="tooltip" title="Ver Adjunto Carpeta"><i class="fa fa-file-o"></i></button>
                        <a href='javascript:void(0)' onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/ModificarArchivo/{$item->id_archivo}','Modificar {$item->id_archivo} {$item->nombre_archivo} ',85);" data-toggle="tooltip" title="Editar Documento" class="btn btn-sm btn-flat btn-primary" title="Ver Detalle"><i class="fa fa-search"></i></a>
                         <button type="button" class="btn btn-success btn-xs btn-flat" onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/adjuntarArchivoNuevo/{$item->id_archivo}','Adjuntar Nueva version',50,'adjuntar',true,280);"><i class="fa fa-upload"></i></button>
                     </td>                             
                </tr>
            {/foreach}
        </tbody>
    </table> 
</form>
</div>
</div>
