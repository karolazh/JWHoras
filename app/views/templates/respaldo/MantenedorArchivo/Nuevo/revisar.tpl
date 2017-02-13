<link href="{$static}template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<div class="box box-success">
    <div class="box-body">
		<form role="form" class="form-horizontal">
			<div class="row">
				<div class="col-md-6 top-spaced">
					<div class="margin-bottom-10"></div>         
					
					<div class="form-group">
						<label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre Carpeta</label>
						 <div class="col-lg-8">
							<p class="form-control-static well well-sm">{$revisar_carpeta->nombre}</p>
						 </div>
					</div>
				</div>

				<div class="col-md-6 top-spaced">
					<div class="margin-bottom-10"></div>

					<div class="form-group">
						<label for="exampleInputEmail1" class="col-lg-4 control-label">Usuario Creador</label>
							<div class="col-lg-8">
								<p class="form-control-static well well-sm">{$revisar_carpeta->nombres}</p>
							</div>
					</div>           
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 top-spaced">
					<div class="margin-bottom-10"></div>         
					
					<div class="form-group">
						 <label for="exampleInputEmail1" class="col-lg-4 control-label">Estado Carpeta</label>
						 <div class="col-lg-8">
							<p class="form-control-static well well-sm">{$revisar_carpeta->nombre_estado_carpeta}</p>
						 </div>
					</div>
				</div>

				<div class="col-md-6 top-spaced">
					<div class="margin-bottom-10"></div>

					<div class="form-group">
						<label for="exampleInputEmail1" class="col-lg-4 control-label">Fecha creacion</label>
							<div class="col-lg-8">
								<p class="form-control-static well well-sm">{$revisar_carpeta->fc_fecha_creacion}</p>
							</div>
					</div>           
				</div>
			</div>

			 <div class="row">
				<div class="col-md-6 top-spaced">
					<div class="margin-bottom-10"></div>         
					
					<div class="form-group">
						 <label for="exampleInputEmail1" class="col-lg-4 control-label">Comentario</label>
							 <div class="col-lg-8">
								 <textarea class="form-control-static well well-sm" rows=4>{$revisar_carpeta->gl_comentario}</textarea>
							 </div>
					</div>
				</div>        
			</div>

			<div class="top-spaced">
				<div class="box box-info">
					<div class="box-header">Adjuntar Nuevos archivos a editar
						<button type="button" class="btn btn-success btn-xs btn-flat" onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorArchivos/adjuntarArchivoNuevo','Adjuntar Archivos',50,'adjuntar',true,280);"><i class="fa fa-upload"></i></button>
					</div>
					
					<div class="box-header">
							<button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorArchivos.guardarNuevoArchivo(this.form,this);">Adjuntar Nuevo Archivo</button>
					</div>
					
					<div class="panel-body">
						<div class="table-responsive" id="lista_adjuntos_nuevos"></div>
					</div>
				</div>
			</div>

			<div class="box box-info">
				<div class="box-header">Archivos adjuntos </div>
			</div>

			<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
				<thead>
					<tr role="row">
							<th align="center"># Archivo</th>
							<th align="center">Nombre archivo</th>
							<th align="center">Fecha Subida</th>
							<th align="center">Accion</th>
					</tr>
				</thead>
				<tbody>
					{foreach $revisar as $item}
						 <tr>
							 <td nowrap width="100px" align="center">{$item->id_archivo}</td>
							 <td nowrap width="100px" align="center">{$item->nombre_archivo}</td>
							 <td nowrap width="100px" align="center">{$item->fc_fecha_archivo}</td>
							 <td nowrap width="100px" align="center"> 
								<button type="button" class="btn btn-sm btn-info btn-flat" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verAdjuntosCarpetaSubido/{$item->id_archivo}','_blank');" title="VER ADJUNTO CARPETA"><i class="fa fa-file-o"></i></button>
							 </td>                             
						</tr>
					{/foreach}
				</tbody>
			</table>
		</form>
	</div>
</div>
