<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">{$arrSipresa->ins_c_nombre_direccion} #{$arrSipresa->ins_c_numero_direccion} / {$arrSipresa->gl_resolucion}</h3>
            </div>
            <div class="panel-body">
              <div class="row2">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
					  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Informaci&oacute;n general</a></li>
					  <li role="presentation" class="hide"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ámbitos</a></li>
					  <li role="presentation" class="hide"><a href="#sumarios" role="tab" id="profile-tab" data-toggle="tab" aria-controls="sumarios" aria-expanded="false">Sumarios</a></li>
					  <li role="presentation" class="hide"><a href="#actividades" role="tab" id="profile-tab" data-toggle="tab" aria-controls="actividades" aria-expanded="false">Actividades</a></li> 
					  <li role="presentation" class="hide"><a href="#eventos" role="tab" id="eventos-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Eventos</a></li>
					  <li role="presentation" class="hide"><a href="#comentarios" role="tab" id="comentarios-tab" data-toggle="tab" aria-controls="comentarios" aria-expanded="false">Comentarios</a></li>
					  <li role="presentation" class="hide"><a href="#archivos" role="tab" id="archivos-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Documentos adjuntos</a></li>
					  <li role="presentation" class="hide"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Info. DPA Menú</a></li>
					  <li role="presentation" ><a href="#adjuntos" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Adjuntos ASD</a></li>					  
					</ul>
					<div id="myTabContent" class="tab-content">
					  <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
						<div class="panel panel-default" id="panel_mapa" >
							<div class="panel-body fondo">
								<div class="form-group top-spaced col-xs-6">
									{include "instalacion/bloques/bloqueDatosInstalacion.tpl"}
								</div>
								<div class="form-group top-spaced col-xs-6">
										<input type="hidden" id="txtLatitud" name="txtLatitud" value="{$arrSipresa->lat}"> 
										<input type="hidden" id="txtLongitud" name="txtLongitud" value="{$arrSipresa->lon}">								
									{if $arrSipresa->ins_c_coordenada_e != ""}
										<div id="mapa_ubicacion" name="mapa_ubicacion" style="width:98%;height:200px;background-color:white"></div>
									{else}
										SIN COORDENADAS
										<div id="mapa_ubicacion" class="hide"></div>
										<div><img width="98%" height="200px" src="https://maps.googleapis.com/maps/api/staticmap?zoom=1&size=600x300&maptype=roadmap&markers=color:red%7Clabel:A%7C"></div>										
									{/if}	
								</div>
							</div>
						</div>	
							<div class="form-group top-spaced col-xs-6">
								<div class="panel panel-info" >						
									<div class="panel-heading">
										&Aacute;mbitos
									</div>
									<div class="panel-body fondo">
										<div class="form-group top-spaced col-xs-6" style="padding-left: 0px !important;  padding-right: 0px !important">
											<div class="list-group">
											
											  <a class="list-group-item" >
											  {if isset($arrAmbitosResumen[2])}
												<span class="badge">{$arrAmbitosResumen[2]}</span>
											  {/if}	
												<p class="list-group-item-text">AGUA</p>
											  </a>
											  <a class="list-group-item {if isset($arrAmbitosResumen[6])}active{/if}"  >
											  {if isset($arrAmbitosResumen[6])}
												<span class="badge">{$arrAmbitosResumen[6]}</span>
											  {/if}	
												<p class="list-group-item-text">AIRE</p>
											  </a>
											  <a class="list-group-item {if isset($arrAmbitosResumen[1])}active{/if}"  >
											  {if isset($arrAmbitosResumen[1])}
												<span class="badge">{$arrAmbitosResumen[1]}</span>
											  {/if}	
												<p class="list-group-item-text">ALIMENTO</p>
											  </a>											  		
											  <a class="list-group-item {if isset($arrAmbitosResumen[10])}active{/if}"  >
											  {if isset($arrAmbitosResumen[10])}
												<span class="badge">{$arrAmbitosResumen[10]}</span>
											  {/if}	
												<p class="list-group-item-text">LOCALES DE USO COMUNITARIO</p>
											  </a>											  											
											  <a class="list-group-item {if isset($arrAmbitosResumen[8])}active{/if}"  >
											  {if isset($arrAmbitosResumen[8])}
												<span class="badge">{$arrAmbitosResumen[8]}</span>
											  {/if}	
												<p class="list-group-item-text">POLITICAS FARMACEUTICAS</p>
											  </a>

											</div>
										</div>	
										<div class="form-group top-spaced col-xs-6" style="padding-left: 0px !important;  padding-right: 0px !important">
											<div class="list-group">

											  <a class="list-group-item {if isset($arrAmbitosResumen[4])}active{/if}"  >
											  {if isset($arrAmbitosResumen[4])}
												<span class="badge">{$arrAmbitosResumen[4]}</span>
											  {/if}	
												<p class="list-group-item-text">PROFESIONES MEDICAS</p>
											  </a>											  											
											  <a class="list-group-item {if isset($arrAmbitosResumen[7])}active{/if}"  >
											  {if isset($arrAmbitosResumen[7])}
												<span class="badge">{$arrAmbitosResumen[7]}</span>
											  {/if}	
												<p class="list-group-item-text">RESIDUOS</p>
											  </a>
											  <a class="list-group-item {if isset($arrAmbitosResumen[9])}active{/if}"  >
											  {if isset($arrAmbitosResumen[9])}
												<span class="badge">{$arrAmbitosResumen[9]}</span>
											  {/if}	
												<p class="list-group-item-text">SALUD LABORAL</p>
											  </a>
											  <a class="list-group-item {if isset($arrAmbitosResumen[5])}active{/if}"  >
											  {if isset($arrAmbitosResumen[5])}
												<span class="badge">{$arrAmbitosResumen[5]}</span>
											  {/if}	
												<p class="list-group-item-text">SEGURIDAD QUIMICA</p>
											  </a>
											  <a class="list-group-item {if isset($arrAmbitosResumen[3])}active{/if}"  >
											  {if isset($arrAmbitosResumen[3])}
												<span class="badge">{$arrAmbitosResumen[3]}</span>
											  {/if}	
												<p class="list-group-item-text">ZOONOSIS Y VECTORES</p>
											  </a>
											</div>
										</div>	
									</div>
								</div>
							</div>
							<div class="form-group top-spaced col-xs-3 hide">
								<div class="panel panel-info" >						
									<div class="panel-heading">
										Antecedentes
									</div>
									<div class="panel-body fondo">
									
										<div class="list-group">
											{foreach $arrTipos as $itm}										
												<a class="list-group-item {if isset($arrAdjuntosResumen[$itm->id_tipo])}active{/if}" >
													{if isset($arrAdjuntosResumen[$itm->id_tipo])}		
														<span class="badge">{$arrAdjuntosResumen[$itm->id_tipo]}</span>
													{/if}
													<p class="list-group-item-text">{$itm->gl_nombre}</p>
												</a>
											{/foreach}	
										</div>

									</div>
								</div>
							</div>
							<div class="form-group top-spaced col-xs-6">
								<div class="panel panel-info" >						
									<div class="panel-heading">
										Sumarios
									</div>
									<div class="panel-body fondo">
										
											  
												{if count((array)$arrSumarios) == 0}										
												<a class="list-group-item"  >
													<h5 class="list-group-item-heading">SIN SUMARIOS</h5>
												</a>	
												{else}
													{foreach $arrSumarios as $itm}										
												
									<div class="form-group top-spaced col-xs-12">
										<div class="form-group col-xs-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title">{$itm->gl_codigo} (Id: {$itm->id_expediente})</h3>
												</div>
												
												<div class="panel-body">
													<div class="form-group col-xs-12">
														<div class="row">
															<div class="form-group top-spaced">
																	<label for="selectCDAType" class="col-xs-4 control-label clabel">Fecha creación</label>
																	<div class="col-xs-8">
																		{$itm->fc_creacion|fecha_hora}
																	</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group top-spaced">
																	<label for="selectCDAType" class="col-xs-4 control-label clabel">Estado actual</label>
																	<div class="col-xs-8">
																		{$itm->nombre_estado}
																	</div>
															</div>
														</div>		
												
														<div class="row">
															<div class="form-group top-spaced">
																	<label for="selectCDAType" class="col-xs-4 control-label clabel">Materia</label>
																	<div class="col-xs-8">
																		{$itm->rkn_gl_materia}
																	</div>
															</div>
														</div>		
													</div>	
												</div>					
												
											</div>
										</div>
									
									</div>	

													{/foreach}												
												{/if}

											  
											
									</div>
								</div>
							</div>							
					</div>
					<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								<legend>&Aacute;mbitos</legend>
								<div class="form-group top-spaced col-xs-12">	
									<div>
									  <!-- Nav tabs -->
									  <ul class="nav nav-tabs" role="tablist">
										{foreach $arrAmbitosBD as $itmAmbitoPestana}
											<li role="presentation" {if $itmAmbitoPestana->id_ambito == 1}class="active"{/if}><a href="#amb_{$itmAmbitoPestana->id_ambito}" aria-controls="amb_{$itmAmbitoPestana->id_ambito}" role="tab" data-toggle="tab">{$itmAmbitoPestana->gl_nombre}</a></li>
										{/foreach}
									  </ul>

									  <!-- Tab panes -->
									  <div class="tab-content">
  										{foreach $arrAmbitosBD as $itmAmbitoPestana }
											<div role="tabpanel" class="tab-pane {if $itmAmbitoPestana->id_ambito == 1}active{/if}" id="amb_{$itmAmbitoPestana->id_ambito}">
												<div class="col-lg-12">
														<div class="panel panel-success" id="panel_mapa" >
															<div class="panel-heading">
																	<div class="row">
																		<div class="form-group top-spaced">
																			<div class="col-xs-8">
																				<b>{$itmAmbitoPestana->gl_nombre}</b>
																			</div>	
																		</div>
																	</div>																
															</div>																					
												<div class="panel-body">
													{foreach $arrTipos as $itemTipoPestana}
														{if $itemTipoPestana->id_ambito == $itmAmbitoPestana->id_ambito}
															<div class="col-lg-12">
																<div class="panel panel-default" id="panel_mapa" >
																	<div class="panel-heading">
																			<div class="row">
																				<div class="form-group top-spaced">
																					<div class="col-xs-8">
																						<b>{$itemTipoPestana->gl_nombre}::({$itmAmbitoPestana->id_ambito}/{$itemTipoPestana->id_tipo})</b>
																					</div>	
																				</div>
																			</div>																
																	</div>										
																</div>										
															</div>
													
															{foreach $arrAdjuntosTipo[$itmAmbitoPestana->id_ambito][$itemTipoPestana->id_tipo] as $itemAdjuntoPestana}
																<div class="col-lg-12 bloqueDetalle" id="bloque_individual_{$itm->id_adjunto}">
																	<div class="panel panel-default" id="panel_mapa" >
																		<div class="panel-body">
																			<div class="col-lg-4">
																			{if strpos($itemAdjuntoPestana->gl_ruta,'pdf') != 0}
																						<div class="embed-responsive embed-responsive-4by3" style="height: 200px !important ">
																							<embed class="embed-responsive-item" src="/carpeta_digital/documentos{$itemAdjuntoPestana->gl_ruta}#view=FitH"></iframe>
																					{else}
																						<div class="img-responsive">
																							<img src="/carpeta_digital/documentos{$itemAdjuntoPestana->gl_ruta}" height="200px">
																					 {/if}
																					</div>	
																					<div class="row" align="center">																					
																							<button type="button" class="btn btn-info btn-xs" onClick="colorbox('/carpeta_digital/documentos{$itemAdjuntoPestana->gl_ruta}')"><i class="fa fa-download fa-lg">Ver documento</i></button>
																							<button type="button" class="btn btn-success btn-xs" onClick="window.open('/carpeta_digital/documentos{$itemAdjuntoPestana->gl_ruta}')"><i class="fa fa-download fa-lg">Abrir en nueva pestaña</i></button>
																					</div>	
																			</div>
																			<div class="col-lg-8">
																				<div id="div_datos_especificos_{$itemAdjuntoPestana->id_adjunto}">	
																					{include "instalacion/bloques/bloqueCamposEspecialesVista.tpl"}
																				</div>	
																				<div class="row">								
																					<div class="form-group">
																						<label for="selectCDAType" class="col-xs-2 control-label clabel">Descripci&oacute;n</label>
																						<div class="col-xs-10">
																							{$itemAdjuntoPestana->gl_descripcion}
																						</div>
																					</div>								
																				</div>	
																			</div>
																		</div>	
																	</div>													
																</div>
															{/foreach}	

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
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="sumarios" aria-labelledby="sumarios-tab">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								<legend>Sumarios sanitarios</legend>
								
									{foreach $arrSumarios as $itm }
									<div class="form-group top-spaced col-xs-12">
										<div class="form-group col-xs-12">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title">{$itm->gl_codigo} (Id: {$itm->id_expediente})</h3>
												</div>
												
												<div class="panel-body">
													<div class="form-group col-xs-12">
														
														<div class="row">
															<table class="table table-bordered table-striped datos">
																<tbody>
																<tr>
																	<th width="100px">Fecha creacion</th><td>{$itm->fc_creacion|fecha_hora}</td>
																</tr>
																<tr>
																	<th>Estado actual</th><td>{$itm->nombre_estado}</td>
																</tr>
																<tr>																	
																	<th>Bandeja actual</th><td>{$itm->nombre_bandeja}</td>
																</tr>
																<tr>																	
																	<th>Materia</th><td>{$itm->rkn_gl_materia}</td>
																</tr>
																
																<tr>																	
																	<th>N&uacute;mero acta</th><td>{$itm->gl_acta}</td>
																</tr>
																<tr>																	
																	<th>Resolución</th>
																	<td>
																		{if $itm->gl_resolucion != ""}
																			{$itm->gl_resolucion} ({$itm->fc_firma|fecha_hora}) 
																		{else}	
																			--
																		{/if}																		
																	</td>
																</tr>
																<tr>																	
																	<th>Descripci&oacute;n</th><td>{$itm->rkn_gl_materia}</td>
																</tr>																
																</tbody>
															</table>
														</div>
														<div class="row">
															<table class="table table-bordered table-striped">
																<thead>
																<tr>
																	<th>
																		Archivo 
																	</th>
																	<th>
																		Tipo
																	</th>															
																	<th>
																		Fecha de carga
																	</th>																		
																	<th align="center">
																		Descargar
																	</th>																																																
																</tr>	
																</thead>
																<tbody>
															{foreach $arrSumariosArchivos as $itmAdjunto }													
																{if $itmAdjunto->id_expediente == $itm->id_expediente}
																	<tr>
																		<td>
																		{$itmAdjunto->nombre}
																		</td>
																		<td>
																		{$itmAdjunto->nombre_tipo_archivo}
																		</td>
																		<td>
																		{$itmAdjunto->fc_ingreso|fecha_hora}
																		</td>
																		<td align="center">
																			<button type="button" class="btn btn-xs btn-success boton_accion"><i class="fa fa-download fa-1x" onClick="window.open('http://sumanet.minsal.cl/sumanet3/index.php/Archivos/descargar/{$itmAdjunto->codigo}')"></i></button>
																		</td>															
																	</tr>
																{/if}	
															{/foreach}	
																<tbody>
															</table>
														</div>
													</div>	
												</div>					
											</div>
										</div>
									</div>	
									{/foreach}									
								
								
							</div>
						</div>						
					  </div>
					<div role="tabpanel" class="tab-pane fade" id="archivos" aria-labelledby="archivos-tab">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								<form action="carpeta_digital/index.php/AdjuntosInstalacion/editar/" method="POST">
									<input type="hidden" id="id_instalacion" name="id_instalacion" value="{$idInstalacion}">
									<legend>Archivos <button class="btn btn-success">Administrar adjuntos</button></legend>
								</form>
									<div class="form-group top-spaced col-xs-12" >
										<div class="panel panel-warning" style="display:none" id="div_subir_adjunto">
											<div class="panel-heading">
												Subir nuevo documento
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="form-group top-spaced col-xs-12" >
															<label for="selectCDAType" class="col-xs-3 control-label clabel">Tipo de documento</label>
															<div class="col-xs-7">
																<select>
																	<option>
																		asdasdadsd
																	</option>
																</select>
															</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group top-spaced col-xs-12">
														<h4>&nbsp;&nbsp;Detalles del documento</h4>
													</div>																										
													<div class="form-group top-spaced col-xs-12">
															<label for="selectCDAType" class="col-xs-3 control-label clabel">Descripción</label>
															<div class="col-xs-7">
																<input class="form-control">
															</div>
													</div>
													<div class="form-group top-spaced col-xs-12">
															<label for="selectCDAType" class="col-xs-3 control-label clabel">Archivo</label>
															<div class="col-xs-7">
																<input  type="file">
															</div>
													</div>													
													<div class="form-group top-spaced col-xs-12">
															<label for="selectCDAType" class="col-xs-3 control-label clabel">&nbsp;</label>
															<div class="col-xs-7">
																<button>GUARDAR</button>
															</div>
													</div>													
												</div>
												
											</div>
										</div>
									</div>	
								<div class="form-group top-spaced col-xs-12">
										
										<div class="form-group top-spaced col-xs-12">
											<div class="panel panel-success">
												<div class="panel-body">
													<div class="form-group top-spaced col-xs-12">
													
													
													<table class="table table-bordered table-striped">
														{foreach $arrTipos as $itmTipo }													
														<tr>
															<th>
																{$itmTipo->gl_nombre}
															</th>
															<td>
																<table class="table table-bordered table-striped">
																	<tbody>
																{foreach $arrAdjuntos as $itm }		
																	{if $itmTipo->id_tipo == $itm->id_tipo}		
																		<tr>
																			<td width="20%">
																				{$itm->gl_nombre}
																			</td>
																			<td width="40%">
																				{$itm->gl_descripcion}
																			</td>
																			<td width="10%">
																				{$itm->fc_carga}
																			</td>
																			<td width="10%">
																				{$itm->gl_usuario}
																			</td>
																			<td align="center" width="10%">
																			<button type="button" class="btn btn-success btn-sm" onClick="window.open('http://asdigital.minsal.cl/carpeta_digital/documentos{$itm->gl_ruta}')">Descargar</button>
																			</td>															
																		</tr>
																	{/if}	
																{/foreach}	
																	<tbody>
																</table>															
															</td>
														</tr>
														{/foreach}
													</table>

													</div>	
												</div>											
												
											</div>
										</div>
																		
								</div>
								
							</div>
						</div>
					</div>			
					<div role="tabpanel" class="tab-pane fade" id="eventos" aria-labelledby="eventos">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								<legend>Eventos</legend>
								<div class="form-group top-spaced col-xs-12">
									
										<div class="form-group top-spaced col-xs-12">
											<div class="panel panel-success">

												
												<div class="panel-body">
													<table class="table table-striped table-bordered " >
														<thead>
															<tr>
																<th>
																	Fecha
																</th>
																<th>
																	Tipo
																</th>
																<th>
																	Usuario
																</th>																
																<th>
																	Detalle
																</th>																																
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	adasdsd
																</td>
																<td>
																	adasdsd
																</td>
																<td>
																	adasdsd
																</td>																
																<td>
																	adasdsd
																</td>																																
															</tr>
														</tbody>														
													</table>													
												</div>											
												
											</div>
										</div>
																		
								</div>
								
							</div>
						</div>
					</div>					
					<div role="tabpanel" class="tab-pane fade" id="comentarios" aria-labelledby="comentarios">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								<legend>Comentarios</legend>
								<div class="form-group top-spaced col-xs-12">
									
										<div class="form-group top-spaced col-xs-12">
											<div class="panel panel-success">

												
												<div class="panel-body">
													<table class="table table-striped table-bordered " >
														<thead>
															<tr>
																<th>
																	Fecha
																</th>
																<th>
																	Tipo
																</th>
																<th>
																	Usuario
																</th>																
																<th>
																	Detalle
																</th>																																
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	adasdsd
																</td>
																<td>
																	adasdsd
																</td>
																<td>
																	adasdsd
																</td>																
																<td>
																	adasdsd
																</td>																																
															</tr>
														</tbody>														
													</table>													
												</div>											
												
											</div>
										</div>
																		
								</div>
								
							</div>
						</div>
					</div>			
				<div role="tabpanel" class="tab-pane fade" id="actividades" aria-labelledby="eventos">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								<legend>Actividades</legend>
								<div class="form-group top-spaced col-xs-12">
									
										<div class="form-group top-spaced col-xs-12">
											<div class="panel panel-success">

												
												<div class="panel-body">
													<table class="table table-striped table-bordered " >
														<thead>
															<tr>
																<th>
																	Instalaci&oacute;n
																</th>																
																<th>
																	&Aacute;mbito
																</th>
																<th>
																	Inspector
																</th>								
																<th>
																	Estado
																</th>		
																<th>
																	Detalle
																</th>																																																
																<th>
																	Fecha
																</th>																																
															</tr>
														</thead>
														<tbody> 
														{foreach $arrActividades as $itm}										
															<tr>
																<td>
																	{$itm->tipo_instalacion}<br>
																	{$itm->subtipo_instalacion}<br>
																	{$itm->ciuu_clase}
																</td>																
																
																<td>
																	{$itm->amb_c_nombre}
																</td>
																<td>
																	{$itm->nombre_usuario}
																</td>																
																<td>
																	{$itm->est_c_nombre}
																</td>																
																<td>
																	{$itm->detalle}
																</td>																																
																
																<td>
																	{$itm->fecha_realizado|fecha}
																</td>																																
															</tr>
														{/foreach}	
														</tbody>														
													</table>													
												</div>											
												
											</div>
										</div>
																		
								</div>
								
							</div>
						</div>
					</div>					
					<div role="tabpanel" class="tab-pane fade" id="adjuntos" aria-labelledby="eventos">
						<div class="panel panel-default">
							<div class="panel-body fondo">
								{foreach $arrAdjuntosASD as $itmResolucion key=glResolucion}
						 
  
								<legend>Adjuntos ASD ({$glResolucion}) / {$arrResoluciones[$glResolucion]->gl_clasificacion_instalacion}</legend>
								<div class="form-group top-spaced col-xs-12">
											<div class="form-group top-spaced col-xs-4">
												<h5>Datos instalación</h5>
													<table class="table" >
														<thead>
															<tr>
																<th>Resolución</th>																
																<td>Resolución</td>																
															</tr>	
															<tr>	
																<th>Tipo</th>
																<td>Tipo</td>     
															</tr>	
															<tr>	
																<th>Tipo</th>
																<td>Tipo</td>    
															</tr>	
															<tr>	
																<th>Tipo</th>
																<td>Tipo</td>    
															</tr>																
														</thead>    
													</table>													
												
											
											</div>								
										<div class="form-group top-spaced col-xs-12">
												<h5>Antecedentes</h5>
												
													<table class="table table-striped table-bordered " >
														<thead>
															<tr>
																<th>
																	Nombre
																</th>																
																<th>
																	Tipo
																</th>
																<th>
																	Fecha
																</th>
																<th width="80px">
																	Descargar
																</th>																																
															</tr>
														</thead>    
														<tbody> 
															
															{foreach $itmResolucion as $itm}										
															{if $itm->arr_tipo == "antecedentes"}
															<tr>
																<td>
																	{$itm->gl_nombre_archivo}<br>
																</td>																
																<td>
																	{$itm->gl_nombre}
																</td>																																
																
																<td>
																	{$itm->fc_carga|fecha_hora}
																</td>
																<td align="center">
																	<button type="button" class="btn btn-info btn-xs" onclick="colorbox('http://asdigital.minsal.cl/asdigital/{$itm->gl_ruta_archivo}{$itm->ruta_documento}')"><i class="fa fa-file-text-o fa-lg"></i></button>																	
																	<button type="button" class="btn btn-success btn-xs" onclick="window.open('http://asdigital.minsal.cl/asdigital/{$itm->gl_ruta_archivo}{$itm->ruta_documento}')"><i class="fa fa-download fa-lg"></i></button>																																		
																</td>																																
															</tr>
															{/if}

														{/foreach}	
														</tbody>														
													</table>													
												
											
											</div>
											<div class="form-group top-spaced col-xs-6">
												<h5>Documentos oficiales</h5>
												
													<table class="table table-striped table-bordered " >
														<thead>
															<tr>
																<th>Tipo</th>																
																<th>Fecha</th>
																<th width="80px">Descargar</th>																																
															</tr>
														</thead>
														<tbody> 
															{foreach $itmResolucion as $itm}										
																{if $itm->arr_tipo == "documentos"}
																<tr>
																	<td>
																		{$itm->gl_nombre_documento}
																	</td>																
																	<td>
																		{$itm->fc_documento|fecha_hora}
																	</td>
																	<td align="center">

																	<button type="button" class="btn btn-info btn-xs" onclick="colorbox('http://asdigital.minsal.cl/asdigital/{$itm->gl_ruta_archivo}{$itm->ruta_documento}')"><i class="fa fa-file-text-o fa-lg"></i></button>																	
																	<button type="button" class="btn btn-success btn-xs" onclick="window.open('http://asdigital.minsal.cl/asdigital/{$itm->gl_ruta_archivo}{$itm->ruta_documento}')"><i class="fa fa-download fa-lg"></i></button>																																																				
																		
																	</td>																																
																</tr>
																{/if}
														{/foreach}	
														</tbody>														
													</table>													
												
											
											</div>
											<div class="form-group top-spaced col-xs-6">
												<h5>Otros adjuntos </h5>
												
													<table class="table table-striped table-bordered " >
														<thead>
															<tr>
																<th>
																	nombre
																</th>																
																<th>
																	Tipo
																</th>
																<th>
																	Fecha
																</th>
																<th width="80px">
																	Descargar
																</th>																																
															</tr>
														</thead>
														<tbody> 
															{foreach $itmResolucion as $itm}										
															{if $itm->arr_tipo == "adjunto"}														
															<tr>
																<td>
																	{$itm->gl_nombre_archivo}
																</td>																
																
																<td>
																	{$itm->nombre_tipo_documento}
																</td>
																<td>
																	{$itm->fc_carga|fecha}
																</td>
																<td align="center">
																	<button type="button" class="btn btn-info btn-xs" onclick="colorbox('http://asdigital.minsal.cl/asdigital/{$itm->gl_ruta_archivo}{$itm->ruta_documento}')"><i class="fa fa-file-text-o fa-lg"></i></button>																	
																	<button type="button" class="btn btn-success btn-xs" onclick="window.open('http://asdigital.minsal.cl/asdigital/{$itm->gl_ruta_archivo}{$itm->ruta_documento}')"><i class="fa fa-download fa-lg"></i></button>																																																				
																</td>																																
															</tr>
															{/if}
														{/foreach}	
														</tbody>														
													</table>													
												
											
										</div>
																		
								</div>
								{/foreach}
							</div>
						</div>
					</div>							
					  <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
						<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
					  </div>
					</div>
				  </div>
              </div>
            </div>
            
          </div>