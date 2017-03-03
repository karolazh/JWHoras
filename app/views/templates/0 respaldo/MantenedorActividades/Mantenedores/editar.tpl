<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css"  rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Editar Actividad {$revisar->id_actividad}</h1>          
        <ol class="breadcrumb">
            <li>
				<a href="{$base_url}/MantenedorActividades"><i class="fa fa-folder-open"></i>Información de Actividades</a>
			</li>
            <li class="active">Editar Actividad</li>
        </ol>     
</section>

<section class="content">
	<div class="box box-success">
		<div class="box-body">
			<form role="form" class="form-horizontal">
				<div class="col-md-2">
					<div class="form-group clearfix">
						<label class="control-label required">Respuesta (*)</label>                    
							<select class="form-control" id="id_tipo_respuesta" name="id_tipo_respuesta"> 
									<option value="0">-- Seleccione --</option>
										{foreach from=$respuestas item=it}
									<option value="{$it->id_tipo_respuesta}" {if $it->id_tipo_respuesta == $revisar->id_tipo_respuesta} selected {/if}>{$it->nombre_tipo_respuesta}</option>
										{/foreach}                
							</select>
					</div>
				</div>
				
				<div class="row top-spaced margin-bottom-10">
					<div class="col-xs-8 top-spaced">							
						<label class="col-xs-8  col-md-2 control-label">Comentario</label>
							<div class="col-xs-8 col-md-8">
								<textarea class="form-control form-control-textarea" name="comentario" id="comentario" value="{$revisar->comentario}" rows="4">{$revisar->comentario}</textarea>
							</div>							
					</div>
				</div>				
				
				<div class="box-header">Adjuntar Nuevos archivos
					<button type="button" class="btn btn-success btn-xs btn-flat" onClick="xModal.open('{$smarty.const.BASE_URI}/MantenedorActividades/adjuntarArchivoNuevo','Adjuntar Archivos a actividad',50,'adjuntar',true,280);"><i class="fa fa-upload"></i></button>
				</div>						
									
				<div class="panel-body">
					<div class="table-responsive" id="lista_adjuntos"></div>
				</div>					
				
				<section class="content-header">
					<h1>Archivos adjuntados</h1>
				</section>

				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
					<thead>
						<tr role="row">
							<th align="center">Nombre Archivo</th>
							<th align="center">Fecha Subida</th>
							<th align="center">Nombre Archivo</th>
							<th align="center">Acción</th>
						</tr>
					</thead>
					<tbody>
						{foreach $revisar_documentos as $item}
							<tr>
								 <td nowrap width="100px" align="center">{$item->gl_nombre_archivo}</td>
								 <td nowrap width="100px" align="center">{$item->fecha_subida}</td>
								 <td nowrap width="100px" align="center">{$item->nombre_archivo}</td>
								 <td nowrap width="100px" align="center"> 
									<button type="button" class="btn btn-sm btn-flat btn-success" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorActividades/verAdjuntoActividades/{$item->id_archivo_actividad}','_blank');" data-toggle="tooltip" title="Ver Adjunto Actividad"><i class="fa fa-file-o"></i></button>
								 </td>                             
							</tr>
						{/foreach}
					</tbody>
				</table> 

				<div class="box-header">
					<!-- Campos carga Automatica -->
					<input  type="hidden" name="id_actividad" id="id_actividad" value="{$id_actividad}"></input>
					<input  type="hidden" name="id_usuario" id="id_usuario" value="{$id_usuario}"></input>				
									
						{if $revisar->respondio != SI}
							<button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorActividades.modificarActividad(this.form,this);">Actualizar Actividad</button>
						{/if}
						
						{if $revisar->respondio == SI}
							<button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorActividades.modificarActividadModificada(this.form,this);">Actualizar Actividad</button>
						{/if}
										
				</div>
			</form>
		</div>
	</div>
</section>
