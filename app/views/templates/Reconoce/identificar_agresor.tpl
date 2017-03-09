<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-bullhorn"></i>&nbsp;Identificación del Agresor</h1>
	<ol class="breadcrumb">
		<li><a href="{$base_url}/Registro/index">
				<i class="fa fa-folder-open"></i>&nbsp;Registros</a></li>
		<li class="active"> &nbsp;Identificación del Agresor</li>
	</ol>
</section>

<form id="form" class="form-horizontal" enctype="multipart/form-data">

	<section class="content">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Datos de la Víctima {$botonAyudaPaciente}
			</div>
			<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
			<div class="panel-body">
                                
                                <div class="form-group">
					<label for="nombres_apellidos" class="control-label col-sm-3">Nombres y Apellidos</label>
					<div class="col-sm-3">
						<input type="text" name="nombres_apellidos" id="nombres_apellidos" value="{$gl_nombres} {$gl_apellidos}"
                                                       placeholder="Nombres y Apellidos" class="form-control" readonly>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
                            
				<div class="form-group">
					<label for="gl_rut" class="control-label col-sm-3">RUT/RUN/Pasaporte</label>
					<div class="col-sm-3">
						<input type="text" name="gl_rut" id="gl_rut" value="{$gl_rut}"
							   placeholder="Rut paciente" class="form-control" readonly>
						<span class="help-block hidden fa fa-warning"></span>
					</div>  
					<label for="gl_nacionalidad" class="control-label col-sm-1">Nacionalidad:</label>
					<div class="col-sm-3">
						<input type="text" name="gl_nacionalidad" id="gl_nacionalidad"
							   placeholder="Nacionalidad" class="form-control">
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

				<div class="form-group">
					<label for="gl_direccion" class="control-label col-sm-3">Dirección Actual</label>
					<div class="col-sm-3">
						<input type="text" name="gl_direccion" id="gl_direccion" value="{$gl_direccion}"
                                                       placeholder="Dirección Actual" class="form-control" readonly />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
                                                       
					<label for="gl_direccion_alternativa" class="control-label col-sm-1">Dirección Alternativa</label>
					<div class="col-sm-3">					
						<input type="text" name="gl_direccion_alternativa" id="gl_direccion_alternativa" 
                                                       placeholder="Dirección Alternativa" class="form-control"/>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>

				<div class="form-group">
					<label for="fc_nacimiento" class="control-label col-sm-3">Fecha Nacimiento</label>
					<div class="col-sm-3">
						<input type="date" name="fc_nacimiento" id="fc_nacimiento" value="{$fc_nacimiento}"
                                                       placeholder="Fecha Nacimiento" class="form-control" readonly />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
                                        <label for="edad" class="control-label col-sm-1">Edad</label>
					<div class="col-sm-3">					
						<input type="text" name="edad" id="edad" value="{$edad}"
                                                       placeholder="Edad" class="form-control" readonly />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
                            
                                <div class="form-group">
					<label for="id_estado_civil" class="control-label col-sm-3">Estado Civil</label>
					<div class="col-sm-3">
                                                <select class="form-control" id="id_estado_civil" name="id_estado_civil">
                                                    <option value="0">Seleccione Estado Civil</option>
                                                    {foreach $arrTipoEstadoCivil as $item}
                                                        <option value="{$item->id_estado_civil}" >{$item->gl_estado_civil}</option>
                                                    {/foreach}
                                                </select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
                    <label for="nr_hijos" class="control-label col-sm-1">Numero de Hijos</label>
					<div class="col-sm-3">					
						<input type="number" name="nr_hijos" id="nr_hijos" value="" min="0" max="15"
                                                       placeholder="Numero Hijos" class="form-control" />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
                            
                <div class="form-group">
					<label for="id_tipo_ocupacion" class="control-label col-sm-3">Ocupación</label>
					<div class="col-sm-3">
						<select class="form-control" id="id_tipo_ocupacion" name="id_tipo_ocupacion">
                                                    <option value="0">Seleccione Tipo de Ocupación</option>
                                                    {foreach $arrTipoOcupacion as $item}
                                                        <option value="{$item->id_tipo_ocupacion}" >{$item->gl_tipo_ocupacion}</option>
                                                    {/foreach}
                                                </select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
                    <label for="gl_situacion_laboral" class="control-label col-sm-1">Situación Laboral</label>
					<div class="col-sm-3">
						<!-- input de situacion laboral En Veremos... -->
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
                            
                <div class="form-group">
					<label for="id_tipo_escolaridad" class="control-label col-sm-3">Escolaridad</label>
					<div class="col-sm-3">					
						<select class="form-control" id="id_tipo_escolaridad" name="id_tipo_escolaridad">
                                                    <option value="0">Seleccione Escolaridad</option>
                                                    {foreach $arrEscolaridad as $item}
                                                        <option value="{$item->id_tipo_escolaridad}" >{$item->gl_tipo_escolaridad}</option>
                                                    {/foreach}
                                                </select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
                            
                <div class="form-group">
					<label for="fc_reconoce" class="control-label col-sm-3">Fecha</label>
					<div class="col-sm-3">
						<input type="date" name="fc_reconoce" id="fc_reconoce" value="{$fc_reconoce}"
                                                       placeholder="Fecha" class="form-control" />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
                                        <label for="fc_hora_reconoce" class="control-label col-sm-1">Hora</label>
					<div class="col-sm-3">					
						<input type="time" name="fc_hora_reconoce" id="fc_hora_reconoce" value="{$fc_hora}"
                                                       placeholder="Hora" class="form-control" />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
                            
				<div class="form-group">
					<label for="gl_acompañante" class="control-label col-sm-3">Acompañante</label>
					<div class="col-sm-3">					
						<input type="text" name="gl_acompañante" id="gl_acompañante" value=""
                                                       placeholder="Acompañante" class="form-control" />
						<span class="help-block hidden fa fa-warning"></span>
					</div>
				</div>
			</div>
		</div>
		
				<div class="top-spaced"></div>
				<div class="panel panel-primary">
					<div class="panel-heading">Caracterización de la violencia {$botonAyudaViolencia}</div>
					<div class="panel-body">
						<div class="col-lg-3"></div>
						<div class="form-group">
							<div class="table-responsive col-lg-6" data-row="10">
								<table id="tablaPrincipal" class="table table-hover table-striped table-bordered">
									<thead>
										<tr role="row">
											<th class="text-center" width="35%">Tipo de Violencia</th>
											<th class="text-center" width="10%">Ausente</th>
											<th class="text-center" width="10%">Leve</th>
											<th class="text-center" width="10%">Moderada</th>
											<th class="text-center" width="10%">Severa</th>
										</tr>
									</thead>
									<tbody>
										{$cant_pre = 0}
										{foreach $arrTipoViolencia as $item}
											{$i = $item->id_tipo_violencia}
											{$n = $i - 1}
											{$row = "row_"}
											{$cant_pre = $cant_pre + 1}
											{assign var="row_n" value="`$row``$n`"}
											<tr>
												<td class="text-center" nowrap>{$item->gl_tipo_violencia}</td>
												<td class="text-center"><input class="id_tipo_violencia" value="{$item->gl_respuesta_1}" data='{$i}' {if $item->gl_respuesta_1 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
												<td class="text-center"><input class="id_tipo_violencia" value="{$item->gl_respuesta_2}" data='{$i}' {if $item->gl_respuesta_2 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
												<td class="text-center"><input class="id_tipo_violencia" value="{$item->gl_respuesta_3}" data='{$i}' {if $item->gl_respuesta_3 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
												<td class="text-center"><input class="id_tipo_violencia" value="{$item->gl_respuesta_4}" data='{$i}' {if $item->gl_respuesta_4 == $arrPuntos->$row_n->nr_valor}checked {/if} type='radio' id='id_tipo_violencia_{$i}' name='id_tipo_violencia_{$i}'></td>
											</tr>
										{/foreach}
									</tbody>
								</table>
							</div>
									<input type="text" value="{$cant_pre}" id="cant_pre" name="cant_pre" class="hidden">
						</div>
						<div class="col-lg-3"></div>
						<div class="form-group">
							<label for="id_tipo_riesgo" class="control-label">Nivel de Riesgo</label>
						</div>
						<div class="col-lg-3"></div>
						<div class="form-group col-lg-6">&nbsp;&nbsp;
							<label><input type="radio" class="id_tipo_riesgo" id="id_tipo_riesgo_1" name="id_tipo_riesgo"
										  value="0">Leve</label>&nbsp;&nbsp;
							<label><input type="radio" class="id_tipo_riesgo" id="id_tipo_riesgo_2" name="id_tipo_riesgo"
									   value="0">Moderado</label>&nbsp;&nbsp;
							<label><input type="radio" class="id_tipo_riesgo" id="id_tipo_riesgo_3" name="id_tipo_riesgo"
									   value="0">Grave</label>&nbsp;&nbsp;
							<label><input type="radio" class="id_tipo_riesgo" id="id_tipo_riesgo_4" name="id_tipo_riesgo"
									   value="0">Extremo</label>
						</div>
						

					</div>
				</div>
                        
                <div class="top-spaced"></div>
		<div class="panel panel-primary">
			<div class="panel-heading">Caracterización del Agresor {$botonAyudaAgresor}</div>
			<div class="panel-body">
                                        
					<div class="form-group">
						<label for="gl_rut_agresor" class="control-label col-sm-3">RUT/RUN/Pasaporte</label>
						<div class="col-sm-3">
							<input type="text" name="gl_rut_agresor" id="gl_rut_agresor" value=""
								   placeholder="Rut/Run/Pasaporte Agresor" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="id_tipo_vinculo" class="control-label col-sm-3">Vínculo con el Agresor</label>
						<div class="col-sm-3">
							<select for="id_tipo_vinculo" class="form-control" id="id_tipo_vinculo" name="id_tipo_vinculo">
								<option value="0">Seleccione Vinculo con Agresor</option>
								{foreach $arrTipoVinculo as $item}
									<option value="{$item->id_tipo_vinculo}" >{$item->gl_tipo_vinculo}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="gl_nombres_agresor" class="control-label col-sm-3">Nombres</label>
						<div class="col-sm-3">
							<input type="text" name="gl_nombres_agresor" id="gl_nombres_agresor" value=""
								   placeholder="Nombres Agresor" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="gl_apellidos_agresor" class="control-label col-sm-1">Apellidos</label>
						<div class="col-sm-3">					
							<input type="text" name="gl_apellidos_agresor" id="gl_apellidos_agresor" value=""
								   placeholder="Apellidos Agresor" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="fc_nacimiento_agresor" class="control-label col-sm-3">Fecha Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" name="fc_nacimiento_agresor" id="fc_nacimiento_agresor" value=""
								   onblur="calcularEdad(this.value,'#edad_agresor')"
								   placeholder="Fecha Nacimiento Agresor" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="edad_agresor" class="control-label col-sm-1">Edad</label>
						<div class="col-sm-3">					
							<input type="text" name="edad_agresor" id="edad_agresor" value=""
								   placeholder="Edad Agresor" class="form-control" readonly/>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="id_comuna_vive" class="control-label col-sm-3">Comuna de Residencia</label>
						<div class="col-sm-3">
							<select class="form-control" id="id_comuna_vive" name="id_comuna_vive">
								<option value="0">Seleccione Comuna donde Vive Agresor</option>
								{foreach $arrComuna as $item}
									<option value="{$item->id_comuna}" >{$item->gl_nombre_comuna}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="id_comuna_trabaja" class="control-label col-sm-1">Comuna del Trabajo</label>
						<div class="col-sm-3">
							<select class="form-control" id="id_comuna_trabaja" name="id_comuna_trabaja">
								<option value="0">Seleccione Comuna donde Trabaja Agresor</option>
								{foreach $arrComuna as $item}
									<option value="{$item->id_comuna}" >{$item->gl_nombre_comuna}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="id_estado_civil_agresor" class="control-label col-sm-3">Estado Civil</label>
						<div class="col-sm-3">
							<select class="form-control" id="id_estado_civil_agresor" name="id_estado_civil_agresor">
								<option value="0">Seleccione Estado Civil Agresor</option>
								{foreach $arrTipoEstadoCivil as $item}
									<option value="{$item->id_estado_civil}" >{$item->gl_estado_civil}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="nr_ingreso_mensual" class="control-label col-sm-1">Ingresos Mensuales</label>
						<div class="col-sm-3">
							<input type="number" name="nr_ingreso_mensual" id="nr_ingreso_mensual" min="0" value=""
								   placeholder="Ingresos Mensuales Estimados" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="nr_hijos_agresor" class="control-label col-sm-3">N° de Hijos</label>
						<div class="col-sm-3">					
							<input type="number" name="nr_hijos_agresor" id="nr_hijos_agresor" value="" min="0" max="15"
								   placeholder="Número de Hijos" class="form-control"/>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="nr_hijos_en_comun" class="control-label col-sm-1">N° Hijos en Común</label>
						<div class="col-sm-3">
							<input type="number" name="nr_hijos_en_comun" id="nr_hijos_en_comun" value="" min="0" max="15"
								   placeholder="Número de Hijos en Común" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="id_tipo_ocupacion_agresor" class="control-label col-sm-3">Ocupación</label>
						<div class="col-sm-3">					
							<select class="form-control" id="id_tipo_ocupacion_agresor" name="id_tipo_ocupacion_agresor">
								<option value="0">Seleccione Tipo de Ocupación</option>
								{foreach $arrTipoOcupacion as $item}
									<option value="{$item->id_tipo_ocupacion}" >{$item->gl_tipo_ocupacion}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="id_actividad_economica" class="control-label col-sm-1">Grupo Act. Económica</label>
						<div class="col-sm-3">
							<select class="form-control" id="id_actividad_economica" name="id_actividad_economica">
								<option value="0">Seleccione Grupo de Actividad Económica</option>
								{foreach $arrActividadEconomica as $item}
									<option value="{$item->id_actividad_economica}" >{$item->gl_nombre_actividad}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="id_tipo_sexo" class="control-label col-sm-3">Sexo</label>
						<div class="col-sm-3">					
							<select class="form-control" id="id_tipo_sexo" name="id_tipo_sexo">
								<option value="0">Seleccione Sexo</option>
								{foreach $arrSexo as $item}
									<option value="{$item->id_tipo_sexo}" >{$item->gl_tipo_sexo}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="id_tipo_genero" class="control-label col-sm-1">Género</label>
						<div class="col-sm-3">
							<select class="form-control" id="id_tipo_genero" name="id_tipo_genero">
								<option value="0">Seleccione Género</option>
								{foreach $arrGenero as $item}
									<option value="{$item->id_tipo_genero}" >{$item->gl_tipo_genero}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group">
						<label for="nr_denuncias_por_violencia" class="control-label col-sm-3">N° de Denuncias por Violencia</label>
						<div class="col-sm-3">
							<input type="text" name="nr_denuncias_por_violencia" id="nr_denuncias_por_violencia" value=""
								   placeholder="Número de Denuncias por Violencia" class="form-control" />
							<span class="help-block hidden fa fa-warning"></span>
						</div>
						<label for="id_orientacion_sexual" class="control-label col-sm-1">Orientación Sexual</label>
						<div class="col-sm-3">
							<select class="form-control" id="id_orientacion_sexual" name="id_orientacion_sexual">
								<option value="0">Seleccione Orientación Sexual</option>
								{foreach $arrOrientacion as $item}
									<option value="{$item->id_orientacion_sexual}" >{$item->gl_orientacion_sexual}</option>
								{/foreach}
							</select>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					</div>

					<div class="form-group clearfix col-md-10 text-right">
						<button type="button" id="guardar" class="btn btn-success">
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