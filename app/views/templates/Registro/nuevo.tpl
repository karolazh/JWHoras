<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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
				<label for="rut" class="col-sm-1 control-label required">Rut Paciente (*)</label>
				<div class="col-sm-1">
					<input type="text" name="rut" id="rut" maxlength="12"
						   onkeyup="formateaRut(this),validaRut(this),this.value = this.value.toUpperCase()"
						   onkeypress ="return soloNumerosYK(event)" onblur="validarVacio(this,'Por favor Ingrese Rut')"
						   placeholder="Rut paciente" class="form-control"/>
					<span class="help-block hidden fa fa-warning"></span>
				</div>
				<div class="col-sm-1">
					<button type="button" id="buscar" class="btn btn-info btn-sm form-control"
                                                onclick="Pacientes.cargarPaciente()">
							<i class="fa fa-search"></i>
					</button>
				</div>
                                <div class="col-sm-1"></div>
                                <div class="form-group col-sm-1">
                                    <div class="checkbox">
                                        <label>
                                            <input id="chkextranjero" type="checkbox"
                                                   onchange="showChkExtranjero('extranjero','chkextranjero','rut')">
                                            <strong>Extranjero</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1" id="extranjero" style="display: none">
                                    <input type="text" name="inputextranjero" id="inputextranjero" maxlength="12"
                                           id="upDoc" class="form-control" placeholder="Ingrese N°/Pasaporte Extranjero"
                                           onblur="validarVacio(this,'Por favor Ingrese N°/Pasaporte Extranjero')">
                                    <span class="help-block hidden fa fa-warning"></span>
                                </div>
                                <div class="form-group col-sm-1" id="btnbuscarex" style="display: none">
                                    <button type="button" id="buscarex" 
                                            class="btn btn-info btn-sm form-control">
                                                    <i class="fa fa-search"></i>
                                    </button>
                                </div>
			</div>
				<div class="form-group">
					<label for="nombres" class="control-label col-sm-1 required">Nombres (*)</label>
					<div class="col-sm-2">
						<input type="text" name="nombres" id="nombres" 
							   onblur="validarVacio(this,'Por favor Ingrese Nombres')"
							   onkeyup="validarVacio(this,'Por favor Ingrese Nombres')"
							   placeholder="Nombres" class="form-control"/>
                                                <span class="help-block hidden fa fa-warning"></span>
					</div>
					<label for="apellidos" class="control-label col-sm-1 required">Apellidos (*)</label>			
					<div class="col-sm-2">
						<input type="text" name="apellidos" id="apellidos"
						   onblur="validarVacio(this,'Por favor Ingrese Apellidos')"
						   onkeyup="validarVacio(this,'Por favor Ingrese Apellidos')"
						   placeholder="Apellidos" class="form-control"/>
					<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

                                <div class="form-group col-md-12">
					<label for="fecnacim" class="control-label col-sm-1 required">Fecha Nacimiento(*)</label>
					<div class="input-group col-md-2">
                                            <input type="date" class="form-control"
                                                   onblur="validarVacio(this,'Por favor Ingrese Fecha'),calcularEdad(this.value)"
                                                   name="fecnacim" id="fecnacim">
                                            <span class="help-block hidden fa fa-warning"></span>
                                        </div>
                                </div>        
                                <div class="form-group col-md-12">
					<label for="edad" class="control-label col-sm-1 required">Edad (*)</label>					
					<div class="col-sm-2">					
						<input type="text" name="edad" id="edad"
						   placeholder="Edad" class="form-control" disabled/>
					<span class="help-block hidden fa fa-warning"></span>
					</div>
                                        <label for="edad" class="control-label col-sm-1 required">Género(*)</label>					
					<div class="col-sm-2">					
						<select for="genero" class="form-control" disabled id="genero" name="genero">
                                                        <option>Femenino</option>
                                                </select>
					<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

                <div class="form-group col-md-12">
                    
                        <label for="prevision" class="control-label col-sm-1">Previsión (*)</label>
                    <div class="form-group col-sm-2">
                        <select for="prevision" class="form-control" id="prevision" name="prevision"
                                onblur="validarVacio(this,'Por favor Seleccione una Previsión')">
                                <option>Seleccione una Previsión</option>
                                <option>FONASA</option>
                                <option>ISAPRE</option>
                                <option>Otra</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    
                        <label for="convenio" class="control-label col-sm-1">Convenio (*)</label>
                    <div class="form-group col-sm-2">
                        <select for="convenio" class="form-control" id="convenio" name="convenio"
                                onblur="validarVacio(this,'Por favor Seleccione una Convenio')">
                                <option>Seleccione un Convenio</option>
                                <option>CONVENIO</option>
                                <option>SIN CONVENIO</option>
                                <option>NN</option>
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
            
                <label for="direccion" class="control-label required col-sm-1">Dirección (*)</label>
                <div class="form-group col-sm-4">
                        <input type="text" name="direccion" id="direccion" value=""
                               onblur="validarVacio(this,'Por favor Ingrese Dirección')"
                               onkeyup="validarVacio(this,'Por favor Ingrese Dirección')"
                               placeholder="Dirección" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                </div>
                
                <div class="form-group col-md-12">
                    <label class="control-label required col-sm-1">Región (*)</label>
                    <div class="form-group clearfix col-sm-2">
                        
                        <select for="region" class="form-control" id="region" name="region"
                                onchange="Region.cargarComunasPorRegion(this.value,'comuna')"
                                onblur="validarVacio(this,'Por favor Seleccione una Región')">
                                <option>Seleccione una Región</option>
                                {foreach $arrRegiones as $item}
                                        <option value="{$item->reg_id}" >{$item->reg_nombre}</option>
                                {/foreach}
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                        
                    <label class="control-label required col-sm-1">Comuna (*)</label>
                    <div class="form-group clearfix col-sm-2">
                        
                        <select for="comuna" class="form-control" id="comuna" name="comuna"
                                onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
                                <option value="0">Seleccione una Comuna</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="fono" class="control-label required col-sm-1">Fono</label>
                    <div class="form-group clearfix col-md-2">
                        <input type="text" name="fono" id="fono" value="" maxlength="11"
                               onKeyPress="return soloNumeros(event)"
                               placeholder="Fono" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <label for="celular" class="control-label required col-sm-1">Celular</label>
                    <div class="form-group clearfix col-sm-2">
                        <input type="text" name="celular" id="celular" value="" maxlength="11"
                               onKeyPress="return soloNumeros(event)"
                               placeholder="Celular" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <label for="email" class="control-label required col-sm-1">E-mail</label>
                    <div class="form-group clearfix col-sm-2">
                        <input type="text" name="email" id="email" value=""
                               onblur="validaEmail(this,'Correo Inválido!')"
                               placeholder="E-mail" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                        
                <div class="form-group col-md-12">
                    <label for="centrosalud" class="control-label required col-sm-1">Centro de Salud</label>
                    <div class="form-group clearfix col-md-2">
                        <input type="text" name="centrosalud" id="centrosalud" value="" maxlength="11"
                               onblur="validarVacio(this,'Por favor Seleccione un Centro de Salud')"
                               placeholder="Centro de Salud" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <label for="motivoconsulta" class="control-label required col-sm-1">Motivo de Consulta</label>
                    <div class="form-group clearfix col-sm-2">
                        <textarea type="text" name="motivoconsulta" id="motivoconsulta" value="" maxlength="11"
                               onblur="validarVacio(this,'Por favor Seleccione Motivo de Consulta')"
                               placeholder="Motivo de Consulta" class="form-control"/></textarea>
                        <span class="help-block hidden"></span>
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