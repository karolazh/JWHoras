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
				<label for="region" class="col-sm-2 control-label required">Rut Paciente (*)</label>
				<div class="col-sm-2">
					<input type="text" name="rut" id="rut" maxlength="12" class="form-control"
						   onkeyup="formateaRut(this),validaRut(this),this.value = this.value.toUpperCase()"
						   onkeypress ="return soloNumerosYK(event)" onblur="validarVacio(this,'Por favor Ingrese Rut')"
						   placeholder="Rut paciente" class="form-control"/>
					<span class="help-block hidden fa fa-warning"></span>
				</div>
				<div class="form-group col-md-1">
					<button type="button" id="buscar" class="btn btn-info btn-sm form-control">
							<i class="fa fa-search"></i>
					</button>
				</div>				
			</div>

				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2 required">Nombres (*)</label>
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

				<div class="form-group clearfix col-md-6">


				</div>


                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="fecnacimiento" class="control-label required">Fecha Nacimiento (*)</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control datepicker"
                                   onblur="validarVacio(this,'Por favor Ingrese Fecha'),calcularEdad(this.value)"
                                   name="fecnacim" id="fecnacim">
                            <span class="help-block hidden fa fa-warning"></span>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="edad" class="control-label required">Edad (*)</label>
                        <input type="text" name="edad" id="edad" value=""
                               placeholder="Edad" class="form-control" disabled/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="genero" class="control-label required">G&eacute;nero (*)</label>
                        <select for="genero" class="form-control" id="genero" name="genero"
                                onblur="validarVacio(this,'Por favor Seleccione un Género')">
                                <option>Seleccione un Género</option>
                                <option>1. Femenino</option>
                                <option>2. Masculino</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="prevision" class="control-label required">Previsión (*)</label>
                        <select for="prevision" class="form-control" id="prevision" name="prevision"
                                onblur="validarVacio(this,'Por favor Seleccione una Previsión')">
                                <option>Seleccione una Previsión</option>
                                <option>1. FONASA</option>
                                <option>2. ISAPRE</option>
                                <option>3. Otra</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="convenio" class="control-label required">Convenio (*)</label>
                        <select for="convenio" class="form-control" id="convenio" name="convenio"
                                onblur="validarVacio(this,'Por favor Seleccione una Convenio')">
                                <option>Seleccione un Convenio</option>
                                <option>1. Convenio1</option>
                                <option>2. Convenio2</option>
                                <option>3. Otro</option>
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
            
            <div class="form-group">
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label for="direccion" class="control-label required">Dirección (*)</label>
                        <input type="text" name="direccion" id="direccion" value=""
                               onblur="validarVacio(this,'Por favor Ingrese Dirección')"
                               onkeyup="validarVacio(this,'Por favor Ingrese Dirección')"
                               placeholder="Dirección" class="form-control"/>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Región (*)</label>
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

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Comuna (*)</label>
                        <select for="comuna" class="form-control" id="comuna" name="comuna"
                                onblur="validarVacio(this,'Por favor Seleccione una Comuna')">
                                <option value="0">Seleccione una Comuna</option>
                        </select>
                        <span class="help-block hidden fa fa-warning"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="fono" class="control-label required">Fono</label>
                        <input type="text" name="fono" id="fono" value="" maxlength="11"
                               onKeyPress="return soloNumeros(event)"
                               placeholder="Fono" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="celular" class="control-label required">Celular</label>
                        <input type="text" name="celular" id="celular" value="" maxlength="11"
                               onKeyPress="return soloNumeros(event)"
                               placeholder="Celular" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label for="email" class="control-label required">E-mail</label>
                        <input type="text" name="email" id="email" value=""
                               onblur="validaEmail(this,'Correo Inválido!')"
                               placeholder="E-mail" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input id="extranjero" type="checkbox" onchange="showContent('upDoc','extranjero')">
                                <strong>Extranjero</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-6" id="upDoc" style="display: none">
                        <label for="upDoc">Subir documento</label>
                        <input type="file" id="upDoc">
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
    </div>    
</section>
          
                
</form>