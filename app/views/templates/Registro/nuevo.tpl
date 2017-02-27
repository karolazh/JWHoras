<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-plus"></i>Nuevo</h1>
        <ol class="breadcrumb">
            <li><a href="{$base_url}/Administracion/noticias">
            <i class="fa fa-folder-open"></i>&nbsp;Registros</a></li>
            <li class="active"> &nbsp;Nuevo Registro</li>
        </ol>
</section>

<form id="form" class="form-horizontal">

	<section class="content">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Datos del Paciente {$botonAyudaPaciente}
			</div>
			<div class="panel-body">
				<div class="form-group">
                                    <input type="text" value="0" id="id_registro" name="id_registro" class="hidden">
					<label for="rut" class="control-label col-sm-2 required">Rut Paciente (*)</label>
					<div class="col-sm-2">
						<input type="text" name="rut" id="rut" maxlength="12" onkeyup="formateaRut(this),validaRut(this),this.value = this.value.toUpperCase()" onkeypress ="return soloNumerosYK(event)" onblur="validarVacio(this,'Por favor Ingrese Rut')" placeholder="Rut paciente" class="form-control">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<div class="col-sm-1">
						<button type="button" id="buscar" class="btn btn-info btn-sm form-control" onclick="Registro.cargarRegistro()"><i class="fa fa-search"></i></button>
					</div>
					<div>
						<label>
							<input id="chkextranjero" type="checkbox" value='1' onchange="showChk('extranjero','chkextranjero','rut','buscar')">
							<strong>Extranjero</strong>
						</label>
					</div>
				</div>

				<div class="form-group" style="display: none" id="extranjero">
									<label for="nombres" class="control-label col-sm-2 required">N°/Pasaporte Extranjero</label>
					<div class="col-sm-2">
						<input type="text" name="inputextranjero" id="inputextranjero" maxlength="12" id="inputextranjero" value='' class="form-control" placeholder="Ingrese N°/Pasaporte Extranjero" onblur="validarVacio(this,'Por favor Ingrese N°/Pasaporte Extranjero')">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<div class="col-sm-1" id="btnbuscarex">
						<button type="button" id="buscarex" class="btn btn-info btn-sm form-control">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</div>
				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2 required">Nombres (*)</label>
					<div class="col-sm-3">
						<input type="text" name="nombres" id="nombres" onblur="validarVacio(this,'Por favor Ingrese Nombres')" onkeyup="validarVacio(this,'Por favor Ingrese Nombres')" placeholder="Nombres" class="form-control">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<label for="apellidos" class="control-label col-sm-2 required">Apellidos (*)</label>
					<div class="col-sm-3">
						<input type="text" name="apellidos" id="apellidos" onblur="validarVacio(this,'Por favor Ingrese Apellidos')" onkeyup="validarVacio(this,'Por favor Ingrese Apellidos')" placeholder="Apellidos" class="form-control">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

				<div class="form-group">
					<label for="fc_nacimiento" class="control-label col-sm-2 required">Fecha Nacimiento(*)</label>
					<div class="col-sm-3">
						<input type="date" class="form-control col-sm-2" onblur="validarVacio(this,'Por favor Ingrese Fecha'),calcularEdad(this.value)" name="fc_nacimiento" id="fc_nacimiento">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<label for="edad" class="control-label col-sm-2 required">Edad (*)</label>
					<div class="col-sm-1">					
						<input type="text" name="edad" id="edad" placeholder="Edad" class="form-control" readonly />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="edad" class="control-label col-sm-2 required">Género(*)</label>
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
						<select for="prevision" class="form-control" id="prevision" name="prevision" onblur="validarVacio(this,'Por favor Seleccione una Previsión')">
							<option value="0">Seleccione una Previsión</option>
							{foreach $arrPrevision as $item}
								<option value="{$item->id_prevision}" >{$item->gl_nombre_prevision}</option>
							{/foreach}
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
			</div>
		</div>    
		
		<div class="top-spaced"></div>
		<div class="panel panel-primary">
					<div class="panel-heading">Datos de Contacto</div>
			<div class="panel-body">
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label for="direccion" class="control-label required col-sm-4">Dirección (*)</label>
						<div class="col-sm-8">
							<input type="text" name="direccion" id="direccion" value="" onblur="validarVacio(this,'Por favor Ingrese Dirección')" onkeyup="validarVacio(this,'Por favor Ingrese Dirección')" placeholder="Dirección" class="form-control"/>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label required col-sm-4">Región (*)</label>
						<div class="col-sm-6">
							<select for="region" class="form-control" id="region" name="region" onchange="Region.cargarComunasPorRegion(this.value,'comuna')" onblur="validarVacio(this,'Por favor Seleccione una Región')">
								<option value="0">Seleccione una Región</option>
								{foreach $arrRegiones as $item}
									<option value="{$item->id_region}" >{$item->gl_nombre_region}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>
					<div class="form-group"> 
						<label class="control-label required col-sm-4">Comuna (*)</label>
						<div class="col-sm-6">
							<select for="comuna" class="form-control" id="comuna" name="comuna" 
									onchange="Registro.cargarCentroSaludporComuna(this.value,'centrosalud')"
									onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
									<option value="0">Seleccione una Comuna</option>
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="fono" class="control-label required col-sm-4">Fono</label>
						<div class="col-md-5">
							<input type="text" name="fono" id="fono" value="" maxlength="11" onKeyPress="return soloNumeros(event)" placeholder="Fono" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">    
						<label for="celular" class="control-label required col-sm-4">Celular</label>
						<div class="col-sm-5">
							<input type="text" name="celular" id="celular" value="" maxlength="11" onKeyPress="return soloNumeros(event)" placeholder="Celular" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">    
						<label for="email" class="control-label required col-sm-4">E-mail</label>
						<div class="col-sm-6">
							<input type="text" name="email" id="email" value="" onblur="validaEmail(this,'Correo Inválido!')" placeholder="E-mail" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="centrosalud" class="control-label required col-sm-4">Centro de Salud</label>
						<div class="col-sm-6">
							<select for="centrosalud" class="form-control" id="centrosalud" name="centrosalud" onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
								<option value="0">Seleccione un Centro de Salud</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="motivoconsulta" class="control-label required col-sm-4">Motivo de la Consulta</label>
						<div class="col-sm-6">
							<textarea type="text" style="resize: none" name="motivoconsulta" id="motivoconsulta" value="" onblur="validarVacio(this,'Por favor Ingrese Motivo de Consulta')" placeholder="Motivo de la Consulta" class="form-control"></textarea>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="fechaingreso" class="control-label required col-sm-4">Fecha Ingreso</label>
						<div class="col-sm-6">
							<input type="date" name="fechaingreso" id="fechaingreso" value="{$smarty.now|date_format:"%Y-%m-%d"}" onblur="validarVacio(this,'Por favor Ingrese Fecha y Hora de Ingreso')" placeholder="Fecha y Hora de Ingreso" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>   
					<div class="form-group">
						<label for="horaingreso" class="control-label required col-sm-4">Hora Ingreso</label>
						<div class="col-sm-6">
							<input type="time" name="horaingreso" id="horaingreso" value="{$smarty.now|date_format:"%H:%M"}" onblur="validarVacio(this,'Por favor Ingrese Fecha y Hora de Ingreso')" placeholder="Fecha y Hora de Ingreso" class="form-control"/>
							<span class="help-block hidden"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="chkReconoce" class="control-label col-sm-4">¿Reconoce Maltrato?</label>
						<div class="col-sm-1">
							<input id="chkReconoce" value="1" type="checkbox">
						</div>
					</div>
					<div class="form-group">
						<label for="chkAcepta" class="control-label col-sm-4">¿Consciente Participar?</label>
							<div class="col-sm-1">
								<input id="chkAcepta" type="checkbox">
							</div>
					</div>
					<div id="files" style="display: none">
						<div class="form-group">
							<label for="files" class="control-label col-sm-4">Consentimiento</label>
							<div class="col-sm-3">
								<a class="btn btn-sm btn-info" id="btnDescarga" href = '{$smarty.const.DIR_BASE}archivos/sistema/consentimiento.pdf' download target="_blank">
									<i class="fa fa-download"></i>Descargar
								</a>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<button type="button" id="btnUpload" class="btn btn-sm btn-success">
									<i class="fa fa-upload" aria-hidden="true"></i> Subir Firmado
								</button>
								
							</div>
							<div class="col-sm-1">
								<span class="help-block hidden" id="spanUpload"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div id="map" data-editable="1" style="width:100%;height:300px;"></div>
					<div class="form-group">
						<label for="email" class="control-label col-sm-3">Latitud</label>
						<div class="col-sm-3">
							<input type="text" name="gl_latitud" id="gl_latitud" value="" placeholder="latitud" class="form-control"/>
						</div>
						<label for="email" class="control-label col-sm-1">Longitud</label>
						<div class="col-sm-3">
							<input type="text" name="gl_longitud"  id="gl_longitud" value="" placeholder="Longitud" class="form-control"/>
						</div>
					</div>
				</div>

				<div class="form-group clearfix col-md-12 text-right">
					<button type="button" id="guardar" class="btn btn-success">
						<i class="fa fa-save"></i>  Guardar
					</button>&nbsp;
					<button type="button" id="cancelar"  class="btn btn-default" 
							onclick="location.href='{$base_url}/Registro/index'">
						<i class="fa fa-remove"></i>  Cancelar
					</button>
					<br/><br/>
				</div>
        </div>
		
    </div>
</section>
</form>