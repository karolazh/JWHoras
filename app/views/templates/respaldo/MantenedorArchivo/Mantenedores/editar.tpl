<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Editar Carpeta {$revisar_carpeta->id_archivo}</h1>          
        <ol class="breadcrumb">
            <li><a href="{$base_url}/MantenedorArchivos"><i class="fa fa-folder-open"></i>Información Documentada</a></li>
            <li class="active">Editar Carpeta</li>
        </ol>     
</section>

<div class="box box-success">
    <div class="box-body">
		<form role="form" class="form-horizontal">
				<div class="row">
					<div class="col-md-6 top-spaced">
						<div class="margin-bottom-10"></div>            
							<div class="box-header">Ver detalle de carpeta {$revisar_carpeta->nombre}
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
							<button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorArchivos.guardarNuevoArchivo(this.form,this);">Adjuntar Nuevo Archivo</button>
						</div>
						
						<div class="panel-body">
							<div class="table-responsive" id="lista_adjuntos_nuevos"></div>
						</div>

						<div class="panel-body">
							<div class="table-responsive" id="lista_adjuntos_nuevos_versiones"></div>
						</div>
					</div>
				</div>

				<section class="content-header">
					<h1>Archivos adjuntados</h1>
				</section>

				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
					<thead>
						<tr role="row">
							<th align="center">Nombre archivo</th>
							<th align="center">Fecha Subida</th>
							<th align="center">Fecha modificaci&oacuten</th>
							<th align="center">Usuario</th>
							<th align="center">Estado</th>
							<th align="center">Version</th>
							<th align="center">Accion</th>
						</tr>
					</thead>
					<tbody>
						{foreach $revisar as $item}
							<tr>
								<td nowrap width="100px" align="center">{$item->nombre_archivo}</td>
								<td nowrap width="100px" align="center">{$item->fc_fecha_archivo}</td>
								<td nowrap width="100px" align="center">{$item->fecha_update}</td>
								<td nowrap width="100px" align="center">{$item->nombres}</td>
								<td nowrap width="100px" align="center">{$item->nombre_archivo_estado}</td>
								<td nowrap width="100px" align="center">{$item->version}</td>
								<td nowrap width="100px" align="center"> 
									<button type="button" class="btn btn-sm btn-flat btn-success" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verAdjuntoCarpeta/{$item->id_archivo}','_blank');" data-toggle="tooltip" title="Ver Adjunto Carpeta"><i class="fa fa-file-o"></i></button>
									<a href='javascript:void(0)' onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/ModificarArchivo/{$item->id_archivo}','Modificar {$item->id_archivo} {$item->nombre_archivo} ',85);" data-toggle="tooltip" title="Editar Documento" class="btn btn-sm btn-flat btn-primary" title="Ver Detalle"><i class="fa fa-search"></i></a>
									<button type="button" class="btn btn-success btn-xs btn-flat" onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/adjuntarArchivoNuevoVersion//{$item->id_archivo}/{$item->id_archivo_relacionado}/{$item->version}','Adjuntar nueva versión' ,50,'adjuntar',true,280);" data-toggle="tooltip" title="Adjuntar nueva versión" class="btn btn-sm btn-flat btn-primary" ><i class="fa fa-upload"></i></button>
									<a href='javascript:void(0)' onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/BitacoraVersion/{$item->id_archivo_relacionado}','Bitacora Archivo {$item->id_archivo} {$item->nombre_archivo} ',85);" data-toggle="tooltip" title="Bitacora Documento" class="btn btn-sm btn-flat btn-primary" title="Bitacora Documento"><i class="fa fa-search"></i></a>
								</td>                             
							</tr>
						{/foreach}
					</tbody>
				</table> 

				<div class="box-header">
					<button type="button" class="btn btn-success pull-right btn-flat" onClick="location.href='{$base_url}/MantenedorArchivos/crearsubcarpeta/{$revisar_carpeta->id_carpeta_archivo}'"></i> Crear nueva Subcarpeta</button>
				</div>

				<section class="content-header">
					<h1>Sub Carpetas</h1>
				</section>

				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
					<thead>
						<tr role="row">
							<th align="center"># Sub Carpeta</th>
							<th align="center">Nombre Sub Carpeta</th>
							<th align="center">CreadorSub Carpeta</th>
							<th align="center">Fecha creaci&oacuten</th>
							<th width="1px" align="center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						{foreach $arrResultado as $itm}
						<tr>
							<td nowrap width="100px" align="center"> {$itm->id_carpeta_archivo} </td>
							<td class="text-center">{$itm->nombre}</td>
							<td nowrap width="100px" align="center">{$itm->nombres}</td>           
							<td class="text-center">{$itm->fc_fecha_creacion}</td>
							<td class="text-center" style="width:100px;">
							<div class="btn-group">
									<button type="button" class="btn btn-sm btn-success btn-flat" onClick="location.href='{$base_url}/MantenedorArchivos/revisarSubCarpeta/{$itm->id_carpeta_archivo}'" data-toggle="tooltip" title="Ver Carpeta"><i class="fa fa-file-o"></i></button>
								   <!-- <a href='javascript:void(0)' onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/BitacoraCarpeta/{$itm->id_carpeta_archivo}','Bitácora Carpeta {$itm->id_carpeta_archivo}: {$itm->nombre} ',85);" data-toggle="tooltip" title="Bitácora" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-search"></i></a>-->
							</div>
						   </td>          
						</tr>
						{/foreach}
					</tbody>
				</table>
		</form>
	</div>
</div>
