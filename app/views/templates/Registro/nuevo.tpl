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
			Datos del Paciente
        </div>
        <div class="panel-body">
			<div class="form-group">
				<label for="rut" class="control-label col-sm-2 required">Rut Paciente (*)</label>
				<div class="col-sm-2">
					<input type="text" name="rut" id="rut" maxlength="12" onkeyup="formateaRut(this),validaRut(this),this.value = this.value.toUpperCase()" onkeypress ="return soloNumerosYK(event)" onblur="validarVacio(this,'Por favor Ingrese Rut')" placeholder="Rut paciente" class="form-control">
					<span class="help-block hidden fa fa-warning"></span>
				</div>
				<div class="col-sm-1">
					<button type="button" id="buscar" class="btn btn-info btn-sm form-control" onclick="Registro.cargarRegistro()"><i class="fa fa-search"></i></button>
				</div>
                                <div class="checkbox">
                                        <label>
                                                <input id="chkextranjero" type="checkbox"
                                                           onchange="showChk('extranjero','chkextranjero','rut')">
                                                <strong>Extranjero</strong>
                                        </label>
                                </div>
                        </div>  
 
			<div class="form-group" style="display: none" id="extranjero">
                                <label for="nombres" class="control-label col-sm-2 required">N°/Pasaporte Extranjero</label>
				<div class="col-sm-2">
					<input type="text" name="inputextranjero" id="inputextranjero" maxlength="12" id="upDoc" class="form-control" placeholder="Ingrese N°/Pasaporte Extranjero" onblur="validarVacio(this,'Por favor Ingrese N°/Pasaporte Extranjero')">
					<span class="help-block hidden fa fa-warning"></span>
				</div>
				<div class="col-sm-1" id="btnbuscarex">
					<button type="button" id="buscarex" 
							class="btn btn-info btn-sm form-control">
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
				<label for="fecnacim" class="control-label col-sm-2 required">Fecha Nacimiento(*)</label>
				<div class="col-sm-3">
					<input type="date" class="form-control col-sm-2" onblur="validarVacio(this,'Por favor Ingrese Fecha'),calcularEdad(this.value)" name="fecnacim" id="fecnacim">
					<span class="help-block hidden fa fa-warning"></span>
				</div>
				<label for="edad" class="control-label col-sm-2 required">Edad (*)</label>					
				<div class="col-sm-2">					
					<input type="text" name="edad" id="edad" placeholder="Edad" class="form-control" disabled/>
					<span class="help-block hidden fa fa-warning"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="edad" class="control-label col-sm-2 required">Género(*)</label>					
				<div class="col-sm-3">					
					<select for="genero" class="form-control" disabled id="genero" name="genero">
						<option>Femenino</option>
					</select>
					<span class="help-block hidden fa fa-warning"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="prevision" class="control-label col-sm-2">Previsión (*)</label>
				<div class="col-sm-3">
					<select for="prevision" class="form-control" id="prevision" name="prevision" 
							onblur="validarVacio(this,'Por favor Seleccione una Previsión')">
							<option>Seleccione una Previsión</option>
                                                        {foreach $arrPrevision as $item}
                                                                        <option value="{$item->prev_id}" >{$item->prev_nombre}</option>
                                                        {/foreach}
					</select>
					<span class="help-block hidden fa fa-warning"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="convenio" class="control-label col-sm-2">Convenio (*)</label>
				<div class="col-sm-3">
					<select for="convenio" class="form-control" id="convenio" name="convenio"
							onblur="validarVacio(this,'Por favor Seleccione una Convenio')">
							<option>Seleccione un Convenio</option>
							<option>1. Convenio1</option>
							<option>2. Convenio2</option>
					</select>
					<span class="help-block hidden fa fa-warning"></span>
				</div>
			</div>
               
        </div>
    </div>    
</section>
                
<section class="content">
    <div class="panel panel-primary">
	            <div class="panel-heading">Datos de Contacto</div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="direccion" class="control-label required col-sm-3">Dirección (*)</label>
                    <div class="col-sm-9">
                        <input type="text" name="direccion" id="direccion" value="" onblur="validarVacio(this,'Por favor Ingrese Dirección')" onkeyup="validarVacio(this,'Por favor Ingrese Dirección')" placeholder="Dirección" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
		</div>	
                <div class="form-group">
                    <label class="control-label required col-sm-3">Región (*)</label>
                    <div class="col-sm-6">
                        <select for="region" class="form-control" id="region" name="region" onchange="Region.cargarComunasPorRegion(this.value,'comuna')" onblur="validarVacio(this,'Por favor Seleccione una Región')">
                                            <option>Seleccione una Región</option>
                                            {foreach $arrRegiones as $item}
                                                            <option value="{$item->reg_id}" >{$item->reg_nombre}</option>
                                            {/foreach}
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
		</div>
                <div class="form-group"> 
                    <label class="control-label required col-sm-3">Comuna (*)</label>
                    <div class="col-sm-6">
                        <select for="comuna" class="form-control" id="comuna" name="comuna" 
                                onchange="Registro.cargarCentroSaludporComuna(this.value,'centrosalud')"
                                onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
                                <option>Seleccione una Comuna</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fono" class="control-label required col-sm-3">Fono</label>
                    <div class="col-md-5">
                        <input type="text" name="fono" id="fono" value="" maxlength="11" onKeyPress="return soloNumeros(event)" placeholder="Fono" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
		</div>
                <div class="form-group">    
                    <label for="celular" class="control-label required col-sm-3">Celular</label>
                    <div class="col-sm-5">
                        <input type="text" name="celular" id="celular" value="" maxlength="11" onKeyPress="return soloNumeros(event)" placeholder="Celular" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                <div class="form-group">    
                    <label for="email" class="control-label required col-sm-3">E-mail</label>
                    <div class="col-sm-6">
                        <input type="text" name="email" id="email" value="" onblur="validaEmail(this,'Correo Inválido!')" placeholder="E-mail" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                <div class="form-group">    
                    <label for="centrosalud" class="control-label required col-sm-3">Centro de Salud</label>
                    <div class="col-sm-6">
                        <select for="centrosalud" class="form-control" id="centrosalud" name="centrosalud" 
                                onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
                                <option>Seleccione un Centro de Salud</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">    
                    <label for="motivoconsulta" class="control-label required col-sm-3">Motivo de la Consulta</label>
                    <div class="col-sm-6">
                        <input type="text" name="motivoconsulta" id="motivoconsulta" value="" onblur="validarVacio(this,'Por favor Ingrese Motivo de Consulta')" placeholder="Motivo de la Consulta" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                <div class="form-group">    
                    <label for="fechaingreso" class="control-label required col-sm-3">Fecha y Hora Ingreso</label>
                    <div class="col-sm-6">
                        <input type="input" name="fechaingreso" id="fechaingreso" value="" onblur="validarVacio(this,'Por favor Ingrese Fecha y Hora de Ingreso')" placeholder="Fecha y Hora de Ingreso" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
            </div>
			<div class="col-sm-6">
				<div id="map" data-editable="1" style="width:100%;height:300px;"></div>
                <div class="form-group">    
                    <label for="email" class="control-label required col-sm-3">Latitud</label>
                    <div class="col-sm-3">
                        <input type="text" name="gl_latitud" id="gl_latitud" value="" placeholder="latitud" class="form-control"/>
                    </div>
                    <label for="email" class="control-label required col-sm-1">Longitud</label>
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