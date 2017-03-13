<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i>Nuevo</h1>
	<ol class="breadcrumb">
		<li><a href="{$base_url}/Paciente/">
				<i class="fa fa-folder-open"></i>&nbsp;Pacientes</a></li>
		<li class="active"> &nbsp;Nuevo Paciente</li>
	</ol>
</section>

<form id="form" class="form-horizontal" enctype="multipart/form-data">

	<section class="content">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Datos del Paciente {$botonAyudaPaciente}
				<input type="text" value="0" id="id_paciente" name="id_paciente" class="hidden">
				<input type="text" value="0" id="gl_grupo_tipo" name="gl_grupo_tipo" class="hidden">
				<input type="text" value="0" id="cambio_direccion" name="cambio_direccion" class="hidden">
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label for="chkextranjero" class="control-label col-sm-2 ">¿Extranjero?</label>
					<div class="col-sm-3">
						<input id="chkextranjero" type="checkbox" value='1'>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

				<div class="form-group">
					<div id="nacional">
						<label for="rut" class="control-label col-sm-2 ">Rut Paciente (*)</label>
						<div class="col-sm-2">
							<input type="text" name="rut" id="rut" maxlength="12" onkeyup="formateaRut(this), this.value = this.value.toUpperCase()" onkeypress ="return soloNumerosYK(event)" onblur="validarVacio(this, 'Por favor Ingrese RUT');if (Valida_Rut(this)){ldelim}
										validarVacio(this, 'Por favor Ingrese Rut');
										Paciente.cargar();{rdelim}" placeholder="Rut paciente" class="form-control">
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<div class="col-sm-1">
							<button type="button" id="btnBitacora" style="display:none;"									
									data-toggle="tooltip" 
									title="Revisar bitácora" 
									class="btn btn-xs btn-primary">
								<i class="fa fa-info-circle"></i>
							</button>
						</div>
						{*}
						<div class="col-sm-1">
						<button type="button" id="buscar" class="btn btn-info btn-sm form-control" onclick="Paciente.cargarRegistro()"><i class="fa fa-search"></i></button>
						</div>
						{*}
					</div>

					<div style="display: none" id="extranjero">
						<label for="nombres" class="control-label col-sm-2 ">N°/Pasaporte Extranjero</label>
						<div class="col-sm-2">
							<input type="text" name="inputextranjero" id="inputextranjero" maxlength="12" id="inputextranjero" value='' class="form-control" placeholder="Ingrese N°/Pasaporte Extranjero" onblur="validarVacio(this, 'Por favor Ingrese N°/Pasaporte Extranjero');
									Paciente.cargar();">
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						{*
						<div class="col-sm-1" id="btnbuscarex">
						<button type="button" id="buscarex" class="btn btn-info btn-sm form-control">
						<i class="fa fa-search"></i>
						</button>
						</div>*}
					</div>

				</div>

				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2 ">Nombres (*)</label>
					<div class="col-sm-3">
						<input type="text" name="nombres" id="nombres" onblur="validarVacio(this, 'Por favor Ingrese Nombres')" onkeyup="validarVacio(this, 'Por favor Ingrese Nombres')" placeholder="Nombres" class="form-control">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<label for="apellidos" class="control-label col-sm-2 ">Apellidos (*)</label>
					<div class="col-sm-3">
						<input type="text" name="apellidos" id="apellidos" onblur="validarVacio(this, 'Por favor Ingrese Apellidos')" onkeyup="validarVacio(this, 'Por favor Ingrese Apellidos')" placeholder="Apellidos" class="form-control">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

				<div class="form-group">
					<label for="fc_nacimiento" class="control-label col-sm-2 ">Fecha Nacimiento(*)</label>
					<div class="col-sm-3">
						<input type="date" class="form-control col-sm-2" onblur="validarVacio(this, 'Por favor Ingrese Fecha'), calcularEdad(this.value, '#edad')" name="fc_nacimiento" id="fc_nacimiento">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<label for="edad" class="control-label col-sm-2 ">Edad (*)</label>
					<div class="col-sm-1">					
						<input type="text" name="edad" id="edad" placeholder="Edad" class="form-control" readonly />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="genero" class="control-label col-sm-2 ">Sexo(*)</label>
					<div class="col-sm-3">
						<select for="genero" class="form-control" disabled id="genero" name="genero">
							<option value="F">Femenino</option>
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="prevision" class="control-label col-sm-2">Previsión (*)</label>
					<div class="col-sm-3">
						<select id="opcionPrevision" for="prevision" class="form-control" id="prevision" name="prevision" onchange="mostrarFonasaExtranjero(this.value, 'id_prevision')" onblur="validarVacio(this, 'Por favor Seleccione una Previsión')">
							<option  value="0">Seleccione una Previsión</option>
							{foreach $arrPrevision as $item}
								<option  value="{$item->id_prevision}" >{$item->gl_nombre_prevision}</option>
							{/foreach}
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
				<div id="groupFonasaExtranjero" class="form-group hidden">
					<label for="gl_codigo_fonasa" class="control-label col-sm-2 ">Código Fonasa</label>
					<div class="col-sm-3">
						<input type="text" class="form-control col-sm-2" name="gl_codigo_fonasa" id="gl_codigo_fonasa">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<div class="col-sm-1">					
						<button type="button" id="btnUploadFonasa" class="btn btn-sm btn-success"
								onclick="xModal.open('{$smarty.const.BASE_URI}/Paciente/cargarAdjuntoFonasa', 'Cargar Adjunto', '', 1, true, '150');" >
							<i class="fa fa-upload" aria-hidden="true"></i> Subir Archivo Fonasa
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="mostrar_motivos_consulta" style="display:none">		
			<div class="top-spaced"></div>
			<div class="panel panel-primary">
				<div class="panel-heading">Atenciones de Urgencia</div>
				<div class="panel-body">
					<div id="div_tabla_motivos" class="form-group">

					</div>
				</div>
			</div>
		</div>
		<div class="top-spaced"></div>
		<div class="panel panel-primary">
			<div class="panel-heading">Datos de Contacto {$botonAyudaContacto}</div>
			<div class="panel-body">
				<div class="col-md-6 col-sm-12">

					<div class="form-group">
						<label class="control-label col-sm-4">Región (*)</label>
						<div class="col-sm-6">
							{if $es_admin}
							<select for="region" class="form-control" id="region" name="region" onchange="Region.cargarComunasPorRegion(this.value, 'comuna')" onblur="validarVacio(this, 'Por favor Seleccione una Región')">
								
									<option value="0">Seleccione una Región</option>
									{foreach $arrRegiones as $item}
										<option value="{$item->id_region}" >{$item->gl_nombre_region}</option>
									{/foreach}
							</select>	
								
							{else}
							<select  for="region" class="form-control" id="region" name="region" onblur="validarVacio(this, 'Por favor Seleccione una Región')" disabled>
										<option value="{$region_usuario->id_region}">{$region_usuario->gl_nombre_region}</option>
							</select>
							
							{/if}
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>
					<div class="form-group"> 
						<label class="control-label  col-sm-4">Comuna (*)</label>
						<div class="col-sm-6">
							

							<select for="comuna" class="form-control" id="comuna" name="comuna" 
									onchange="Paciente.cargarCentroSaludporComuna(this.value, 'centrosalud')"
									onblur="validarVacio(this, 'Por favor Seleccione una Comuna')">
								<option value="0">Seleccione una Comuna</option>
								{if !$es_admin}
									{foreach $arrComunas as $item}
										<option value="{$item->id_comuna}" >{$item->gl_nombre_comuna}</option>
									{/foreach}
								{/if}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="direccion" class="control-label col-sm-4">Dirección (*)</label>
						<div class="col-sm-5">
							<input type="text" name="direccion" id="direccion" value="" onblur="validarVacio(this, 'Por favor Ingrese Dirección')" onkeyup="validarVacio(this, 'Por favor Ingrese Dirección')" placeholder="Dirección" class="form-control"/>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<div id="groupConfirmaDir" class="form-group hidden">
							<label for="chk_confirma_dir" class="control-label col-sm-2 col-xs-6">Confirma Direccion</label>
							<div class="col-sm-1 col-xs-6">
								<input id="chk_confirma_dir" type="checkbox" value='1'>
								<span class="help-block hidden fa fa-warning"></span>
							</div>
						</div>
					</div>
					<div class="form-group" id="groupTablaDirecciones" style="display:none">
						
					</div>
					<div class="form-group">
						<label for="centrosalud" class="control-label col-sm-4">Centro de Salud</label>
						<div class="col-sm-6">
							<select for="centrosalud" class="form-control" id="centrosalud" name="centrosalud" onblur="validarVacio(this, 'Por favor Seleccione una Comuna')">
								<option value="0">Seleccione un Centro de Salud</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="fono" class="control-label col-sm-4">Teléfono</label>
						<div class="col-sm-3">
							<input type="text" name="fono" id="fono" value="" maxlength="11" onKeyPress="return soloNumeros(event)" placeholder="Fono" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
						<div class="col-sm-2"></div>
						<div id="groupConfirmaFono" class="form-group hidden">
							<label for="chk_confirma_fono" class="control-label col-sm-2 col-xs-6">Confirma Teléfono</label>
							<div class="col-sm-1 col-xs-6">
								<input id="chk_confirma_fono" type="checkbox" value='1'>
								<span class="help-block hidden fa fa-warning"></span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="celular" class="control-label col-sm-4 col-xs-6">¿Teléfono Seguro?</label>
						<div class="col-sm-3 col-xs-6">
							<input id="fono_seguro" name="fono_seguro" type="checkbox" value='1'>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="celular" class="control-label col-sm-4">Celular</label>
						<div class="col-sm-3">
							<input type="text" name="celular" id="celular" value="" maxlength="11" onKeyPress="return soloNumeros(event)" placeholder="Celular" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">    
						<label for="email" class="control-label col-sm-4">E-mail</label>
						<div class="col-sm-6">
							<input type="text" name="email" id="email" value="" onblur="validaEmail(this, 'Correo Inválido!')" placeholder="E-mail" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="motivoconsulta" class="control-label col-sm-4">Motivo de la Consulta</label>
						<div class="col-sm-6">
							<textarea type="text" style="resize: none" name="motivoconsulta" id="motivoconsulta" value="" onblur="validarVacio(this, 'Por favor Ingrese Motivo de Consulta')" placeholder="Motivo de la Consulta" class="form-control"></textarea>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="fechaingreso" class="control-label col-sm-4">Fecha Ingreso</label>
						<div class="col-sm-6">
							<input type="date" name="fechaingreso" id="fechaingreso" value="{$smarty.now|date_format:"%Y-%m-%d"}" onblur="validarVacio(this, 'Por favor Ingrese Fecha y Hora de Ingreso')" placeholder="Fecha y Hora de Ingreso" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>   
					<div class="form-group">
						<label for="horaingreso" class="control-label col-sm-4">Hora Ingreso</label>
						<div class="col-sm-6">
							<input type="time" name="horaingreso" id="horaingreso" value="{$smarty.now|date_format:"%H:%M"}" onblur="validarVacio(this, 'Por favor Ingrese Fecha y Hora de Ingreso')" placeholder="Fecha y Hora de Ingreso" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>

					{* 
					<div class="form-group">
					<label for="chkReconoce" class="control-label col-sm-4">¿Reconoce Maltrato?</label>
					<div class="col-sm-1">
					<input id="chkReconoce" value="1" type="checkbox">
					</div>
					</div>
					*}

					<div class="form-group">
						<label for="chkAcepta" class="control-label col-sm-4 col-xs-6">¿Consiente Participar?</label>
						<div class="col-sm-1 col-xs-6">
							<input id="chkAcepta" type="checkbox">
						</div>
					</div>
					<div id="files" style="display: none">
						<div class="form-group">
							<label for="files" class="control-label col-sm-4">Consentimiento</label>

							{*
							<div class="col-sm-3">
							<a class="btn btn-sm btn-info" id="btnDescarga" onclick="xModal.open('{$smarty.const.BASE_URI}/Paciente/generarConsentimiento', 'Cargar Adjunto', '70', 1, true,'700');" download target="_blank">
							<i class="fa fa-download"></i>Descargar
							</a>
							</div>
							*}

							<div class="col-sm-3">
								<a class="btn btn-sm btn-info" id="btnDescarga" download target="_blank">
									<i class="fa fa-download"></i>Descargar
								</a>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<button type="button" id="btnUploadUno" class="btn btn-sm btn-success"
										onclick="xModal.open('{$smarty.const.BASE_URI}/Paciente/cargarAdjunto', 'Cargar Adjunto', '', 1, true, '150');" >
									<i class="fa fa-upload" aria-hidden="true"></i> Subir Firmado
								</button>
							</div>
						</div>

						<!-- div class="form-group top-spaced">
							<label for="files" class="control-label col-sm-4">Subir Consentimiento</label>
							<div class="col-sm-2">
								<input type="file" value="Subir" id='subirFile'>
							</div>
						</div -->

						

					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div id="map" data-editable="1" style="width:100%;height:300px;"></div>
					<div class="form-group">
						<label for="gl_latitud" class="control-label col-sm-3">Latitud</label>
						<div class="col-sm-3">
							<input type="text" name="gl_latitud" id="gl_latitud" value="" placeholder="latitud" class="form-control"/>
						</div>
						<label for="gl_longitud" class="control-label col-sm-1">Longitud</label>
						<div class="col-sm-3">
							<input type="text" name="gl_longitud"  id="gl_longitud" value="" placeholder="longitud" class="form-control"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12" id="listado-adjuntos" name="listado-adjuntos"></div>
				</div>
				<div class="form-group clearfix  text-right">
					<button type="button" id="guardar" class="btn btn-success">
						<i class="fa fa-save"></i>  Guardar
					</button>
					<button type="button" id="guardarMotivo" class="btn btn-success" style="display: none">
						<i class="fa fa-save"></i>  Guardar
					</button>&nbsp;
					<button type="button" id="cancelar"  class="btn btn-default" 
							onclick="location.href = '{$base_url}/Paciente/index'">
						<i class="fa fa-remove"></i>  Cancelar
					</button>
					<br/><br/>
				</div>
			</div>

		</div>
	</section>
</form>