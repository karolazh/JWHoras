<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css"  rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Editar Solicitud</h1>
     <ol class="breadcrumb">
        <li><a href="{$base_url}/MantenedorArchivos"><i class="fa fa-folder-open"></i>Documentación</a></li>
        <li><a href="{$base_url}/Solicitudes"><i class="fa fa-folder-open"></i>Solicitud Modificación</a></li>
        <li class="active">Editar solicitud</li>
     </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <form role="form" class="form-horizontal">
                <div class="row">
                    <div class="col-md-6 top-spaced">
                        <div class="margin-bottom-10"></div>

						<div class="form-group">
                            <label  class="col-lg-4 control-label">Tipo Solicitud</label>
								<div class="col-lg-8">
								   <select class="form-control" id="id_estado_solicitudes" name="id_estado_solicitudes">
									   <option value="0">-- Seleccione --</option>									
											{foreach from=$estado_solicitudes item=it}
									   <option value="{$it->id_estado_solicitud}" {if $it->id_estado_solicitud == $arrResultado->id_estado_solicitud} selected {/if}>{$it->nombre_estado_solicitud}</option>
											{/foreach}                
								   </select>
								</div>
                        </div>
						
						<div class="form-group">
                            <label  class="col-lg-4 control-label">Archivo</label>
								<div class="col-lg-8">
								   <select class="form-control" id="id_archivo" name="id_archivo">
									   <option value="0">-- Seleccione --</option>
											{foreach from=$archivos_almacenados item=it}
									   <option value="{$it->id_archivo}" {if $it->id_archivo == $arrResultado->id_archivo} selected {/if}>{$it->nombre_archivo}</option>
											{/foreach}                
									</select>
								</div>
                        </div>
						
						<div class="form-group">
							<label  class="col-lg-4 control-label">Comentario</label>
								<div class="col-lg-8">
									 <div class="box-header">
										<textarea class="form-control form-control-textarea" name="gl_comentario" id="gl_comentario" value="{$arrResultado->gl_comentario}" rows="4">{$arrResultado->gl_comentario}</textarea>
									 </div>
								</div>
						</div>
						
						
						<!--
						<div class="form-group">
                            <label  class="col-lg-4 control-label">Seleccione Archivo</label>
								<div class="col-lg-8">
								   <div class="box-header">
										<button type="button" class="btn btn-success btn-xs btn-flat" onClick="xModal.open('{$smarty.const.BASE_URI}/Solicitudes/SeleccionarArchivo','Seleccione Archivo',50,'adjuntar',true,280);"><i class="fa fa-upload"></i></button>
								   </div>
								</div>
                        </div>
						-->
						
                    </div>
                </div>
					
					<!--
					 <div class="panel-body">
						<div class="table-responsive" id="lista_adjuntos"></div>
					 </div>
					
					 <table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">
						<thead>
							<tr role="row">
									<th align="center">Fecha Ingreso</th>
									<th align="center">Nombre de archivo</th>
									<th align="center">Accion</th>                              
							</tr>
						</thead>                 
						<tbody>
							{foreach $revisar_solicitud_archivos as $item}
								 <tr>
									 <td nowrap width="100px" align="center">{$item->fc_fecha_archivo}</td>
									 <td nowrap width="100px" align="center">{$item->nombre_archivo}</td>
									 <td nowrap width="100px" align="center"> 
										<button type="button" class="btn btn-sm btn-flat btn-success" onclick="window.open('{$smarty.const.BASE_URI}/MantenedorArchivos/verAdjuntoCarpeta/{$item->id_archivo}','_blank');" data-toggle="tooltip" title="Ver Adjunto Carpeta"><i class="fa fa-file-o"></i></button>
									  </td>                                                          
								</tr>
							{/foreach}
						</tbody>                  
					</table> 
					-->
                <div class="margin-bottom-10"></div>
                <input  type="hidden" name="id_usuario"     id="id_usuario"     value="{$id_usuario}"></input>
				<input  type="hidden" name="id_solicitud"   id="id_solicitud"   value="{$id_solicitud}"></input>
                <button type="button" class="btn btn-success pull-right btn-flat" onclick="Solicitudes.updateSolicitud(this.form,this);">Actualizar Solicitud</button>
            </form>
        </div>
    </div>
</section>