<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>Editar Archivo</h1>
</section>

<div class="box box-success">
    <div class="box-body">
        <form role="form" class="form-horizontal">
            <div class="row">
                <div class="col-md-6 top-spaced">
                    <div class="margin-bottom-10"></div> 
        		
        			<div class="form-group">
                        <label for="exampleInputPassword1" class="col-lg-4 control-label">Nombre Archivo</label>
							<div class="col-lg-8">
								<input type="text" name="nombre_archivo" id="nombre_archivo" value="{$arr->nombre_archivo}" class="form-control"/>                     
							</div>
                    </div>

                    <div class="form-group">
						<label for="exampleInputPassword1" class="col-lg-4 control-label">Estado archivo</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="id_estado_archivo" name="id_estado_archivo">
										<option value="0">-- Seleccione --</option>
                                    {foreach from=$lista_estado_archivos item=item}
										<option value="{$item->id_estado_archivo}" {if $item->id_estado_archivo == $arr->id_estado_archivo} selected {/if}>{$item->nombre_archivo_estado}</option>
                                    {/foreach}
                                </select>
                            </div>
                    </div>

                    <div class="margin-bottom-10"></div>
                        <!-- Campos carga Automatica -->
                        <input  type="hidden" name="id_archivo" id="id_archivo" value="{$arr->id_archivo}"></input>
                        <input  type="hidden" name="id_usuario" id="id_usuario" value="{$id_usuario}"></input>
                        <input  type="hidden" name="cd_solicitud_fk_archivo" id="cd_solicitud_fk_archivo" value="{$arr->cd_solicitud_fk_archivo}"></input>
                        <button type="button" class="btn btn-success pull-right btn-flat" onclick="MantenedorArchivos.updateArchivoCarpeta(this.form,this);">Modificar Archivo</button>
        		</div>	
            </div>
        </form>
    </div>
</div>
