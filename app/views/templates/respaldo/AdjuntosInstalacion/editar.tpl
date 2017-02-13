<!DOCTYPE html>
<html lang="es">
<head>
    {include file="layout/css.tpl"}
</head>
    <body class="body-login">
        <div class="container">
		
	<legend>Modificar adjuntos instalaci&oacute;n / </legend>
	<div class="row hide">
		<div class="col-lg-5">
			&nbsp;
		</div>
		<div class="col-lg-5">
			<button type="button" class="btn btn-info"  onClick="detalle({$id_instalacion})" >Detalle de la instalación</button>
		</div>
	</div>
	
		<div class="row hide">
			<div class="col-lg-12 top-spaced">
				<div class="col-xs-12 " >
					<div class="panel panel-default" id="panel_mapa" >
						<div class="panel-body">
						{include "instalacion/bloques/bloqueDatosInstalacion.tpl"}
						</div>
					</div>	
				</div>		
			</div>
		</div>	
		
		<div class="row top-spaced">
			<div class="col-lg-12 top-spaced">
				&nbsp;
			</div>		
			<div class="col-lg-12 top-spaced">

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">

				{foreach $arrAmbitosBD as $itm_ambito}				
					{if in_array( $itm_ambito->id_ambito,$arrAmbitosPestana)}
						<li role="presentation" {if $itm_ambito->id_ambito == 1} class="active" {/if}> <a href="#{$itm_ambito->id_ambito}" aria-controls="home" role="tab" data-toggle="tab">{$itm_ambito->gl_nombre}</a></li>
					{else}	
					<li role="presentation" id="btn_ambito_{$itm_ambito->id_ambito}" style="display:none"> <a href="#{$itm_ambito->id_ambito}" aria-controls="home" role="tab" data-toggle="tab">{$itm_ambito->gl_nombre}</a></li>
					{/if}	
				{/foreach}	
				
				<li id="btnNuevoAmbito" name="btnNuevoAmbito" role="presentation" ><button type="button"  class="btn btn-xs btn-info" onClick="$('#btnNuevoAmbito').hide();$('.btnNuevoAmbitoCombo').slideDown();">+ AGREGAR &Aacute;MBITO</button></li>									

				<li class="btnNuevoAmbitoCombo" role="presentation" style="display:none" >
					<select class="form-control" id="selNuevoAmbito">
						{foreach $arrAmbitosBD as $itm_ambito_combo}				
							<option value="btn_ambito_{$itm_ambito_combo->id_ambito}">{$itm_ambito_combo->gl_nombre}</option>
						{/foreach}	
					</select>	
				</li>													
				<li class="btnNuevoAmbitoCombo" role="presentation" style="display:none" >
					<button type="button"  class="btn btn-xs btn-success" onClick="$('#'+$('#selNuevoAmbito').val()).show();">AGREGAR</button>
					<button type="button"  class="btn btn-xs btn-danger" onClick="$('#btnNuevoAmbito').slideDown();$('.btnNuevoAmbitoCombo').hide();">CANCELAR</button>
				</li>																	
				
				
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				{foreach $arrAmbitosBD as $itm_ambito}							  
					<div role="tabpanel" class="tab-pane{if $itm_ambito->id_ambito == 1} active in active {/if} fade" id="{$itm_ambito->id_ambito}">
						<div class="panel panel-info" id="panel_mapa" >
							<div class="panel-heading">
								<h1 class="panel-title">:: {$itm_ambito->gl_nombre} ::</h1>
							</div>										
							<div class="panel-body">

								<div class="row">
										
									{foreach $arrTipos as $itm_tipo}	
										{if $itm_tipo->id_ambito == $itm_ambito->id_ambito}
											
											{if !isset($arrAdjuntosTipo[$itm_ambito->id_ambito][$itm_tipo->id_tipo])}
											
													<div class="col-lg-12">
														<div class="panel panel-default" id="panel_mapa" >
														
															<div class="panel-heading">

																	<div class="row">
																	
																		<div class="form-group top-spaced">
																			<div class="col-xs-8">
																				<b>{$itm_tipo->gl_nombre}</b>
																			</div>	
																			<div class="col-xs-4">
																				<form method="post" id="form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}" name="form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}" enctype="multipart/form-data" />
																					<input type="hidden" id="accion" name="accion" value="adjunto_nuevo">
																					<input type="hidden" id="id_agregar" name="id_agregar" value="{$id_instalacion}">					
																					<input type="hidden" id="id_ambito_nuevo_archivo" name="id_ambito_nuevo_archivo" value="{$itm_ambito->id_ambito}">
																					<input type="hidden" id="id_tipo" name="id_tipo" value="{$itm_tipo->id_tipo}">
																					<div class="row" align="right">			
																						<div class="form-group" >
																							<div class="col-xs-12">
																								<input type="file" class="form-control hide nuevo_archivo_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}" id="nuevo_archivo" name="nuevo_archivo" onChange="subirArchivos('form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}','{$itm_ambito->id_ambito}')">
																							
																								<button type="button" class="btn btn-success btn-sm" onClick="javascript: $('.nuevo_archivo_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}').trigger('click');" >
																									<i class="fa fa-upload fa-lg"></i>
																								</button>																																					
																							</div>
																					</div>
																				
																				</div>
																				</form>	
																			</div>									
																		</div>
																	</div>																
															</div>										
														</div>										
													</div>										
											{else}	
													{*if $arrAdjuntosTipo[$itm_ambito->id_ambito][$itm_tipo->id_tipo]|count == 1*}
														<div class="col-lg-12">
															<div class="panel panel-success" id="panel_mapa" >
																<div class="panel-heading">
																		<div class="row">
																			<div class="form-group top-spaced">
																				<div class="col-xs-8">
																					<b>{$itm_tipo->gl_nombre}</b>
																				</div>	
																				<div class="col-xs-4">
																					<form method="post" id="form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}" name="form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}" enctype="multipart/form-data" />
																						<input type="hidden" id="accion" name="accion" value="adjunto_nuevo">
																						<input type="hidden" id="id_agregar" name="id_agregar" value="{$id_instalacion}">					
																						<input type="hidden" id="id_ambito_nuevo_archivo" name="id_ambito_nuevo_archivo" value="{$itm_ambito->id_ambito}">
																						<input type="hidden" id="id_tipo" name="id_tipo" value="{$itm_tipo->id_tipo}">
																						<div class="row" align="right">			
																							<div class="form-group" >
																								<div class="col-xs-12">
																									<input type="file" class="form-control hide nuevo_archivo_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}" id="nuevo_archivo" name="nuevo_archivo" onChange="subirArchivos('form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}','{$itm_ambito->id_ambito}')">
																								
																									<button type="button" class="btn btn-success btn-sm" onClick="javascript: $('.nuevo_archivo_{$itm_ambito->id_ambito}_{$itm_tipo->id_tipo}').trigger('click');" >
																										<i class="fa fa-upload fa-lg"></i>
																									</button>																																					
																								</div>
																						</div>
																					
																					</div>
																					</form>	
																				</div>									
																			</div>
																		</div>																
																</div>										
															</div>										
														</div>																
													{* /if *}	
												{foreach $arrAdjuntosTipo[$itm_ambito->id_ambito][$itm_tipo->id_tipo] as $itm}
													<!-- Inicio detalle de adjuntos -->
													<div class="col-lg-12 bloqueDetalle" id="bloque_individual_{$itm->id_adjunto}">
														<form id="frm_individual_{$itm->id_adjunto}" method="post" class="disabled">
															<input type="hidden" id="id_frm_individual" name="id_frm_individual" value="{$itm->id_adjunto}">
															<div class="panel panel-info" id="panel_mapa" >
																<div class="panel-heading hide">
																  {$itm_tipo->gl_nombre}
																</div>										
																<div class="panel-body">

																
															<div class="col-lg-2" align="center">
															{if strpos($itm->gl_ruta,'pdf') != 0}
																		<div class="embed-responsive embed-responsive-4by3">
																			<iframe class="embed-responsive-item" src="/carpeta_digital/documentos{$itm->gl_ruta}"></iframe>
																	{else}
																		<div class="img-responsive">
																			<img src="/carpeta_digital/documentos{$itm->gl_ruta}" width="100%">
																	 {/if}
																	</div>			
																	<br>
																	<button type="button" class="btn btn-info btn-xs" onClick="colorbox('/carpeta_digital/documentos{$itm->gl_ruta}')">Ver documento</button>
															</div>
															
															<div class="col-lg-7">
																<div class="row hide">
																	<div class="form-group">								
																		<label for="selectCDAType" class="col-xs-2 control-label clabel" id="txtNombre" name="txtNombre">Nombre</label>
																		<div class="col-xs-5">
																			<input type="text" class="form-control" id="gl_nombre" name="gl_nombre" value="{$itm->gl_nombre}">
																		</div>
																	</div>	
																</div>	
																<div class="row hide">								
																	<div class="form-group">
																		<label for="selectCDAType" class="col-xs-2 control-label clabel">Ambito</label>
																		<div class="col-xs-5">
																					<select class="form-control" id="id_ambito" name="id_ambito">
																						<option value="0">-- SELECCIONE --</option>
																						{foreach $arrAmbitosBD as $itm_ambito2}
																							<option value="{$itm_ambito2->id_ambito}" {if $itm_ambito2->id_ambito == $itm->id_ambito}selected{/if}>{$itm_ambito2->gl_nombre}</option>
																						{/foreach}
																					</select>
																				</div>											
																			</div>
																		</div>
																		<div class="row hide">								
																			<div class="form-group">
																				<label for="selectCDAType" class="col-xs-2 control-label clabel">Tipo</label>
																				<div class="col-xs-5">
																					<select class="form-control" id="cd_tipo" name="cd_tipo" onchange="javascript: cambiarTipo('frm_individual_{$itm->id_adjunto}','div_datos_especificos_{$itm->id_adjunto}',this.value);">
																						<option value="0">-- SELECCIONE --</option>
																						{foreach $arrTipos as $itm_tipo2}
																							<option value="{$itm_tipo2->id_tipo}" {if $itm_tipo2->id_tipo == $itm->id_tipo}selected{/if}>{$itm_tipo2->gl_nombre}</option>
																						{/foreach}
																					</select>
																				</div>											
																			</div>
																		</div>
																			<div id="div_datos_especificos_{$itm->id_adjunto}">	
																				{include "instalacion/bloques/bloqueCamposEspeciales.tpl"}
																			</div>	
																			<div class="row">								
																				<div class="form-group">
																					<label for="selectCDAType" class="col-xs-2 control-label clabel">Descripci&oacute;n</label>
																					<div class="col-xs-10">
																						<textarea onBlur="javascript: updateFileDataSilencio('frm_individual_{$itm->id_adjunto}');" class="form-control" id="gl_descripcion" name="gl_descripcion" rows="2">{$itm->gl_descripcion}</textarea>
																					</div>
																				</div>								
																			</div>	
																			
																			<div class="row hide">								
																				<div class="form-group">
																					<label for="selectCDAType" class="col-xs-2 control-label clabel">Datos de carga</label>
																					<div class="col-xs-3">
																						{$itm->fc_carga|fecha_hora}
																					</div>
																				</div>								
																			</div>	
																			<div class="row hide">								
																				<div class="form-group">
																					<label for="selectCDAType" class="col-xs-2 control-label clabel">Ultima modificaci&oacute;n</label>
																					<div class="col-xs-3" id="div_fecha_modificacion_{$itm->id_adjunto}">
																						{$itm->fc_modificado|fecha_hora}
																					</div>
																				</div>								
																			</div>										
																		</div>
																		</form>
																		<div class="col-lg-3">
																			<div class="row">
																				<div class="form-group top-spaced">
																					<div class="col-xs-12">
																						<form method="post" id="form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm->id_adjunto}" name="form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm->id_adjunto}" enctype="multipart/form-data" />
																							<input type="hidden" id="accion" name="accion" value="adjunto_nuevo">
																							<input type="hidden" id="id_agregar" name="id_agregar" value="{$id_instalacion}">					
																							<input type="hidden" id="id_ambito_nuevo_archivo" name="id_ambito_nuevo_archivo" value="{$itm_ambito->id_ambito}">
																							<input type="hidden" id="id_tipo" name="id_tipo" value="{$itm_tipo->id_tipo}">
																							<div class="row">			
																								<div class="form-group">								
																									<div class="col-xs-12" align="right">
																										<input type="file" class="form-control hide" id="nuevo_archivo_{$itm_ambito->id_ambito}_{$itm->id_adjunto}" name="nuevo_archivo" onChange="subirArchivos('form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm->id_adjunto}','{$itm_ambito->id_ambito}')">
																										<button type="button" class="btn btn-success btn-sm" onClick="javascript: $('#nuevo_archivo_{$itm_ambito->id_ambito}_{$itm->id_adjunto}').trigger('click');" >
																											<i class="fa fa-upload fa-lg"></i>
																										</button>														
																										<button type="button" class="btn btn-sm btn-success hide" id="btn_subir_adjunto2" name="btn_subir_adjunto2" onClick="subirArchivos('form_nuevo_adjunto_{$itm_ambito->id_ambito}_{$itm->id_adjunto}','{$itm_ambito->id_ambito}')">Agregar adjunto</button>
																										<button type="button" class="btn btn-success btn-sm hide" onClick="javascript: updateFileData('frm_individual_{$itm->id_adjunto}');"><i class="fa fa-floppy-o fa-lg"></i></button>					
																										<button type="button" class="btn btn-default btn-sm" onClick="window.open('/carpeta_digital/documentos{$itm->gl_ruta}')"><i class="fa fa-download fa-lg"></i></button>
																										|
																										<button type="button" class="btn btn-danger btn-sm" id="btn_eliminar_{$itm->id_adjunto}" onClick="javascript: $(this).hide('slow'); $('.confirmar_eliminar_{$itm->id_adjunto}').show('slow');" ><i class="fa fa-times fa-lg"></i></button>														
																										<button type="button" class="btn btn-info btn-sm confirmar_eliminar_{$itm->id_adjunto}" style="display:none" onClick="javascript: $('.confirmar_eliminar_{$itm->id_adjunto}').hide('slow'); $('#btn_eliminar_{$itm->id_adjunto}').show('slow');" >Cancelar</button>																							
																										<button type="button" class="btn btn-danger btn-sm confirmar_eliminar_{$itm->id_adjunto}" style="display:none" onclick="javascript: deleteFile('frm_individual_{$itm->id_adjunto}','bloque_individual_{$itm->id_adjunto}')">Confirmar</button>																															
																									</div>
																							</div>
																								
																							
																					</form>	
																							</div>
																					</div>									
																				</div>
																			</div>
																			<hr>																		
																			<div id="div_eliminar_{$itm->id_adjunto}" align="center" class="row" >

																			</div>
																		</div>
																</div>
																<div class="panel-footer hide">
																&nbsp;
																</div>
															</div>	
														
													</div>
													<!-- Fin de adjuntos -->
													{/foreach}
											
											{/if}
								

										{/if}
									{/foreach}
								</div>								
							</div>						
						</div>	
					</div>
				{/foreach}	
			  </div>

			</div>		
		</div>
		
				
	<div class="modal fade modal-enorme" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Detalle de instalación</h4>
		  </div>
		  <div class="modal-body">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>

        </div>
        {include file="layout/js.tpl"}
		{$js}
    </body>
</html>
