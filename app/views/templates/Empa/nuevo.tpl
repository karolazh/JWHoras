<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Ingresar EMPA</h1>
    <div class="col-md-12 text-right">
        <button type="button"
                href='javascript:void(0)' 
                onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$id_paciente}', 'Registro número : {$id_paciente}', 85);" 
                data-toggle="tooltip" 
                title="Bitácora"
                class="btn btn-sm btn-flat btn-primary">
			<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Bitácora
        </button>
    </div>
    <br/><br/>
</section>

<form id="form" class="form-horizontal">
	<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
    <input type="text" value="{$bo_finalizado}" id="bo_finalizado" name="bo_finalizado" class="hidden">
    <input type="text" value="{$id_centro_salud}" id="id_centro_salud" name="id_centro_salud" class="hidden">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Examen de medicina preventiva de las personas de 15 años o m&aacute;s
            </div>

            <!-- Cabecera EMPA -->
            <div class="panel-body">  

                <div class="form-group">
                    <label class="control-label col-sm-3">Comuna</label>
                    <div class="col-sm-3">
                        <input type="text" name="gl_comuna" id="gl_comuna" value="{$gl_comuna}" 
                               placeholder="Comuna" class="form-control" readonly/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gl_institucion" class="control-label col-sm-3">Centro de Salud (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="gl_institucion" id="gl_institucion" value="{$gl_institucion}"
                               placeholder="Institución" class="form-control" readonly/>
                        <span class="help-block hidden"></span>
                    </div>
                    <label for="nr_ficha" class="control-label col-sm-1">N° de Ficha (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="nr_ficha" id="nr_ficha" value="{$nr_ficha}" 
                               placeholder="N° de Ficha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                </div>

                <div class="form-group">
                    <label for="id_sector" class="control-label col-sm-3">Sector (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="gl_sector" id="gl_sector" value="{$gl_sector}" 
                               placeholder="Sector" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <label for="fc_empa" class="control-label col-sm-1">Fecha (*)</label>
					<div class='col-lg-3'>
						    <div class="input-group">
								<input type='text' class="form-control datepicker"
									   id='fc_empa' 
									   name='fc_empa'
									   value="{$fc_empa|date_format:"%d/%m/%Y"}"
									   />
								<span class="help-block hidden fa fa-warning"></span>
								<span class="input-group-addon"><i class="fa fa-calendar" onClick="$('#fc_empa').focus();"></i></span>
								
							</div>
					</div>
                </div>    
                <div class="form-group">
                    <label class="control-label col-sm-3">Nro. Registro</label>
                    <div class="col-sm-3">
                        <input type="text" name="nro_registro" id="nro_registro" value="" 
                               placeholder="N° Registro" class="form-control" readonly/>
                    </div>
                </div>

            </div>
        </div>

        <div class="top-spaced"></div> 


		<!-- Datos del Paciente -->
        <div class="panel panel-primary">
            <div class="panel-heading">Datos del Paciente</div>

            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-3 ">RUT/RUN/Pasaporte</label>
                    <div class="col-md-3 col-sm-3">
			<span class="form-control" readonly>{$gl_rut}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Nombres</label>
                    <div class="col-md-3 col-sm-3">
			<span class="form-control" readonly>{$gl_nombres}</span>
                    </div>
                    <label class="control-label col-sm-1">Apellidos</label>
                    <div class="col-md-3 col-sm-3">
			<span class="form-control" readonly>{$gl_apellidos}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Fecha Nacimiento</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$fc_nacimiento}</span>
                    </div>
                    <label class="control-label col-sm-1">Edad</label>
                    <div class="col-md-3 col-sm-3">
						<input type="text" class="form-control" name="nr_edad" id="nr_edad" value="{$edad}" readonly/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">G&eacute;nero</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>Femenino</span>
                    </div>   
                    <label class="control-label col-sm-1">E-mail</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_email}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Fono</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_fono}</span>
                    </div>
                    <label class="control-label col-sm-1">Celular</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_celular}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Direcci&oacute;n</label>
                    <div class="col-md-7 col-sm-3">
						<span class="form-control" readonly>{$gl_direccion}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-spaced"></div>

        <div class="panel panel-primary">
            <div class="panel-heading">Examen</div>

			<!-- Examen -->
            <div class="panel-body">
				
				<!-- Embarazo -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Embarazada</h3></div>
                    <div class="box-body">  
                        <div class="form-group">   
                            <label class="control-label required col-sm-3">¿Está Embarazada?</label>
                            <div class="col-sm-1">
                                <label><input class="bo_embarazo" type="radio" name="bo_embarazo" 
                                              id="bo_embarazo_0" value="0" {$bo_embarazo_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_embarazo" type="radio" name="bo_embarazo"
                                              id="bo_embarazo_1" value="1" {$bo_embarazo_1}>SI</label>
                            </div>
                    </div>
                    </div>
                </div>

                <!-- Alcoholismo -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Consumo de alcohol</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3 required">¿Consume bebidas alcoh&oacute;licas?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_consume_alcohol" type="radio" name="bo_consume_alcohol" 
                                              id="bo_consume_alcohol_0" value="0" {$bo_consume_alcohol_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_consume_alcohol" type="radio" name="bo_consume_alcohol"
                                              id="bo_consume_alcohol_1" value="1" {$bo_consume_alcohol_1}>SI</label>
								&nbsp;&nbsp;
                                <label><input class="bo_consume_alcohol" type="radio" name="bo_consume_alcohol"
                                              id="bo_consume_alcohol_2" value="2" {$bo_consume_alcohol_2}>NO RESPONDE</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="div_alcoholismo1" style="{if $bo_consume_alcohol_1 != 'checked'}display: none{/if}">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-1">
                                    <button href='javascript:void(0)'
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Empa/audit/{$id_empa}', 'AUDIT (Auto-diagnostico sobre Riesgos en el Uso de Alcohol)', 80);"
                                            data-toggle="tooltip"
                                            title="Ver Registro"
                                            type="button" id="btnaudit" class="btn btn-sm btn-info btn-flat">
                                        <i class="fa fa-file-text-o"></i>&nbsp;AUDIT 
                                    </button>
									<input type="text" name="id_clasificacion_audit" id="id_clasificacion_audit" 
										value="{$id_clasificacion_audit}" placeholder="" class="form-control hidden"/>
                                </div>
                            </div>
                        </div>
								<input id="redirige_empa" class="redirige_empa hidden" value="0">
                        <div class="form-group">
                            <div id="div_alcoholismo2" style="{if ($bo_consume_alcohol_1 != 'checked')}display: none{/if}">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <input type="text" name="gl_puntos_audit" id="gl_puntos_audit" value="{$gl_puntos_audit}"
                                           placeholder="AUDIT Puntos" class="form-control" readonly/>
									
                                    <span class="help-block hidden"></span>
                                </div>
                                <div id="div_consejeria_alcohol" class="col-sm-1">
                                    {$botonAyudaAlcoholico}
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabaquismo -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Tabaquismo</h3></div>
                    <div class="box-body">   
                        <div class="form-group">
                            <label class="control-label required col-sm-3">¿Usted fuma?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_fuma" type="radio" name="bo_fuma" 
                                              id="bo_fuma_0" value="0" {$bo_fuma_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_fuma" type="radio" name="bo_fuma" 
                                              id="bo_fuma_1" value="1" {$bo_fuma_1}>SI</label>
                            </div>
                            <div class="col-sm-1" id="lbl_fuma" style="{if $bo_fuma_1 != 'checked'}display: none{/if}">
                                {$botonAyudaFumador}
                            </div>
                        </div>
                    </div>
                </div>
				
                <!-- Obesidad -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Obesidad</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label required col-sm-3">Peso (Kg)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_peso" id="gl_peso" maxlength="4"
                                       onKeyPress="return soloNumeros(event)"
                                       value="{$gl_peso}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div> 
                        <div class="form-group">   
                            <label class="control-label required col-sm-3">Estatura (cm)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_estatura" id="gl_estatura" maxlength="4"
                                       onKeyPress="return soloNumeros(event)"
                                       value="{$gl_estatura}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="form-group">   

                            <label class="control-label required col-sm-3">Circunferencia Abdominal (cm)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_circunferencia_abdominal" id="gl_circunferencia_abdominal" maxlength="5"
                                       onKeyPress="return soloNumeros(event)" maxlength="4"
                                       value="{$gl_circunferencia_abdominal}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-2">  
                                <div>
                                    {$botonAyudaCircunferenciaAbdominal}
                                </div>
                                <div id="botonayudaCAbdominal88" style="{if !($gl_circunferencia_abdominal >= 88)}display: none{/if}">
                                    {$botonAyudaCAbdominal88}
                                </div>    
                            </div>    
                        </div>
                        <div class="form-group">     
                            <label class="control-label required col-sm-3">IMC</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_imc" id="gl_imc" 
                                       value="{$gl_imc}" placeholder="" class="form-control" readonly/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-1">
                                {$botonAyudaIMC} &nbsp;
								{if $bo_finalizado != 1}
                                <button type="button" id="calcular" onclick="calculaIMC()" class="btn btn-sm btn-success">
                                    <i class="fa fa-success"></i> Calcular IMC</button>
								{/if}
                            </div>
                            <input type="text" name="id_clasificacion_imc" id="id_clasificacion_imc" 
                                   value="{$id_clasificacion_imc}" placeholder="" class="form-control hidden"/>
                        </div>
                    </div>
                </div>
                
                <!-- Hipertensión -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Hipertensión Arterial</h3></div>
                    <div class="box-body"> 
                        <div class="form-group">
                            <label class="control-label required col-sm-3">PAS (mm/Hg)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_pas" id="gl_pas" maxlength="4" onKeyPress="return soloNumeros(event)"
                                       value="{$gl_pas}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-1">
                                {$botonAyudaPAS}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label required col-sm-3">PAD (mm/Hg)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_pad" id="gl_pad" maxlength="4" onKeyPress="return soloNumeros(event)" 
                                       value="{$gl_pad}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
							<div class="col-sm-1">	
								{$botonAyudaPAD}
							</div>
						</div>
                        <div class="form-group" id="verAgendaHipertension" style="{if $gl_pad < 90 and $gl_pas < 140 and $examen_hipertension == 0}display: none{/if}">
							<div class="col-sm-3"></div>
                            <div class="col-sm-2">
								{if $bo_finalizado != 1}
                                {$botonInformacionAgenda}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_hipertension}"
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_hipertension}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_hipertension == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
								{/if}
								<input type="text" value="{$id_paciente_examen_hipertension}" id="id_paciente_examen_hipertension" name="id_paciente_examen_hipertension" class="hidden">
								<button type="button" id="verExamen_{$id_hipertension}" style="{if $bo_finalizado != 1 and $examen_hipertension == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_hipertension').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Diabetes Mellitus (DM) -->
                <div class="box box-success" id="diabetes">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Diabetes Mellitus (DM)</h3></div>
                    <div class="box-body">
                        <div class="form-group" id="antecedentes">
                            <label class="control-label required col-sm-3">¿Tiene Antecedentes Familiares de Diabetes Mellitus?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_antecedente" type="radio" name="bo_antecedente" 
                                              id="bo_antecedente_0" value="0" {$bo_antecedente_diabetes_0}>No</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_antecedente" type="radio" name="bo_antecedente" 
                                              id="bo_antecedente_1" value="1" {$bo_antecedente_diabetes_1}>Si</label>
                            </div>
                        </div>   
                        <div class="form-group" id="glicemia" style="{$diabetes}">
                            <label class="control-label required col-sm-3">Glicemia en Ayunas (mg/dl)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_glicemia" maxlength="4" id="gl_glicemia" value="{$gl_glicemia}" 
                                       onKeyPress="return soloNumeros(event)" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>   
                            <div class="col-sm-1">
                                {$botonAyudaGlicemia}
                            </div>
                        </div>
                        <div class="form-group" id="group_glicemia" style="{$diabetes}">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-2" style="{if !($gl_glicemia >= 100 and $gl_glicemia <= 125) and $examen_glicemia == 0}display: none{/if}" id="div_glicemia_toma">
                                    {$botonConsejeriaGlicemia}&nbsp;&nbsp;
                            </div>
                            <div class="col-sm-2" id="div_glicemia_agenda" style="{if !($gl_glicemia > 125) and $bo_finalizado != 1}display: none{/if}">
								{if $bo_finalizado != 1} 
                                {$botonInformacionAgenda}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_glicemia}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_glicemia}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_glicemia == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
								{/if}
								<input type="text" value="{$id_paciente_examen_glicemia}" id="id_paciente_examen_glicemia" name="id_paciente_examen_glicemia" class="hidden">
								<button type="button" id="verExamen_{$id_glicemia}" style="{if $bo_finalizado != 1 and $examen_glicemia == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_glicemia').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sífilis -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Enfermedades de Transmisión Sexual</h3></div>
                    <div class="box-body">    
                        <div class="form-group">
                            <label class="control-label required col-sm-3">¿Es trabajadora sexual o persona en centro de reclusión?</label>
                            <div class="col-sm-1">
                                <label><input class="bo_trabajadora_reclusa" type="radio" name="bo_trabajadora_reclusa" 
                                              id="bo_trabajadora_reclusa_0" value="0" {$bo_trabajadora_reclusa_0}>No</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_trabajadora_reclusa" type="radio" name="bo_trabajadora_reclusa" 
                                              id="bo_trabajadora_reclusa_1" value="1" {$bo_trabajadora_reclusa_1}>Si</label>
                            </div>
                        </div> 
                        <!-- VDRL -->
                        <div class="form-group" id="id_vdrl" style="{if $bo_trabajadora_reclusa_1 != 'checked' and $examen_vdrl == 0}display: none{/if}">
                            <label class="control-label required col-sm-3">¿Examen VDRL? (Sifilis)</label>
                            <div class="col-sm-2" id="div_vdrl_agenda">
								{if $bo_finalizado != 1}
                                {$botonInformacionAgendaITS}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_vdrl}"
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_vdrl}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_vdrl == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
								{/if}
								<input type="text" value="{$id_paciente_examen_vdrl}" id="id_paciente_examen_vdrl" name="id_paciente_examen_vdrl" class="hidden">
								<button type="button" id="verExamen_{$id_vdrl}" style="{if $bo_finalizado != 1 and $examen_vdrl == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_vdrl').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
                        </div>
                        <!-- RPR -->
                        <div class="form-group" id="id_rpr" style="{if $bo_trabajadora_reclusa_1 != 'checked' and $examen_rpr == 0}display: none{/if}">
                            <label class="control-label required col-sm-3">¿Examen RPR? (Sifilis)</label>
                            <div class="col-sm-2" id="div_rpr_agenda">
								{if $bo_finalizado != 1}
                                {$botonInformacionAgendaITS}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_rpr}"
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_rpr}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_rpr == 0}display: none{/if}">
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
									{/if}
									<input type="text" value="{$id_paciente_examen_rpr}" id="id_paciente_examen_rpr" name="id_paciente_examen_rpr" class="hidden">
								<button type="button" id="verExamen_{$id_rpr}" style="{if $bo_finalizado != 1 and $examen_rpr == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_rpr').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
                        </div>
                        <!-- VIH -->
						<div class="form-group" id="id_vih" style="{if $bo_trabajadora_reclusa_1 != 'checked' and $examen_vih == 0}display: none{/if}">
                            <label class="control-label required col-sm-3">¿Examen Test Elisa? (VIH)</label>
                            <div class="col-sm-2" id="div_vih_agenda">
								{if $bo_finalizado != 1}
                                {$botonInformacionAgendaVIH}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_vih}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_vih}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_vih == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
									{/if}
									<input type="text" value="{$id_paciente_examen_vih}" id="id_paciente_examen_vih" name="id_paciente_examen_vih" class="hidden">
								<button type="button" id="verExamen_{$id_vih}" style="{if $bo_finalizado != 1 and $examen_vih == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_vih').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tuberculósis -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Tuberculosis</h3></div>
                    <div class="box-body">  
                        <div class="form-group">
                            <label class="control-label required col-sm-3">¿Ha tenido tos productiva por m&aacute;s de 15 d&iacute;as?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_tos_productiva" type="radio" name="bo_tos_productiva" 
                                              id="bo_tos_productiva_0" value="0" {$bo_tos_productiva_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_tos_productiva" type="radio" name="bo_tos_productiva" 
                                              id="bo_tos_productiva_1" value="1" {$bo_tos_productiva_1}>SI</label>	
                            </div>
                        </div>
                        <div class="form-group" id="id_baciloscopia" style="{if $bo_tos_productiva_1 != 'checked' and $examen_baciloscopia == 0}display: none{/if}">
                            <label class="control-label required col-sm-3">Basiloscopia</label>
							<div class="col-sm-2" id="div_b_agenda">
								{if $bo_finalizado != 1}
                                {$botonAyudaBasiloscopia}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_baciloscopia}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_baciloscopia}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_baciloscopia == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
								{/if}
								<input type="text" value="{$id_paciente_examen_baciloscopia}" id="id_paciente_examen_baciloscopia" name="id_paciente_examen_baciloscopia" class="hidden">
								<button type="button" id="verExamen_{$id_baciloscopia}" style="{if $bo_finalizado != 1 and $examen_baciloscopia == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_baciloscopia').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
							
							
                        </div>
                    </div>
                </div>

                <!-- PAP -->
                <div class="box box-success" id="pap" style="{$pap}">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> PAP (Mujeres de 25 a 64 años Cáncer Cervicouterino)</h3></div>
                    <div class="box-body">  
                        <div class="form-group">
                            <label class="control-label required col-sm-3">¿Se ha realizado PAP?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_pap_realizado" type="radio" name="bo_pap_realizado" 
                                              id="bo_pap_realizado_0" value="0" {$bo_pap_realizado_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_pap_realizado" type="radio" name="bo_pap_realizado" 
                                              id="bo_pap_realizado_1" value="1" {$bo_pap_realizado_1}>SI</label>
                            </div>
                        </div>
                            
                        <input type="date" name="fc_ultimo_pap" id="fc_ultimo_pap" value="{$fc_ultimo_pap}" placeholder="" class="form-control hidden"/>
                        <input type="text" id="ultimo_pap_ano" value="{$fc_ultimo_pap_ano}" class="form-control hidden"/>
                        <input type="text" id="ultimo_pap_mes" value="{$fc_ultimo_pap_mes}" class="form-control hidden"/>
								
                        <div class="form-group" id="ultimo_pap" style="{if $bo_pap_realizado_1 != 'checked'}display: none{/if}">         
                            <label class="control-label required col-sm-3">Fecha &uacute;ltimo PAP</label>
							<div class="col-sm-1">	
								<select class="form-control col-sm-1" id="fc_ultimo_pap_mes" name="fc_ultimo_pap_mes">
									<option value="0">Seleccione Mes</option>
									{foreach $arrMes as $item}
										<option value="{$item->id_mes}" >{$item->gl_mes}</option>
									{/foreach}
								</select>
                            </div>
                            <div class="col-sm-1">
								<select class="form-control col-sm-1" id="fc_ultimo_pap_ano" name="fc_ultimo_pap_ano">
									<option value="0">Seleccione Año</option>
									{for $i = 2017 to 1900 step=-1}
										<option value="{$i}" >{$i}</option>
									{/for}
								</select>
							</div>
                        </div>
                        <div class="form-group" style="{if !($bo_pap_vigente_0 or $bo_pap_vigente_1)}display: none{/if}" id="pap_vigente">    
                            <label class="control-label required col-sm-3">PAP Vigente</label>
                            <div class="col-sm-2">
                                <label><input class="bo_pap_vigente"  type="radio" name="bo_pap_vigente" 
                                              id="bo_pap_vigente_0" value="0" {$bo_pap_vigente_0} readonly>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_pap_vigente" type="radio" name="bo_pap_vigente" 
                                              id="bo_pap_vigente_1" value="1" {$bo_pap_vigente_1} readonly>SI</label>
                            </div>
                            <div class="col-sm-1">
                                {$botonAyudaPAPVigente}
                            </div>
                        </div>
                        <div class="form-group" id="resultado_pap" style="{if $bo_pap_realizado_1 != 'checked'}display: none{/if}">
                            <label class="control-label required col-sm-3">Resultado PAP</label>
                            <div class="col-sm-2">
                                <label><input class="bo_pap_resultado"  type="radio" name="bo_pap_resultado" 
                                              id="bo_pap_resultado_0" value="0" {$bo_pap_resultado_0}>Alterado</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_pap_resultado" type="radio" name="bo_pap_resultado" 
                                              id="bo_pap_resultado_1" value="1" {$bo_pap_resultado_1}>Normal</label>
								&nbsp;&nbsp;
                                <label><input class="bo_pap_resultado" type="radio" name="bo_pap_resultado" 
                                              id="bo_pap_resultado_2" value="2" {$bo_pap_resultado_2}>NO SABE</label>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" id="verPAP" class="btn btn-sm btn-info">
                                    <i class="fa fa-info"></i> Ver Resultado</button>
                            </div>
                        </div>
                        <div class="form-group" id="tomar_fecha">         
                            <label class="control-label required col-sm-3">Tomar Fecha para PAP</label>
							<div class="col-sm-2">
							{if $bo_finalizado != 1}
                            {$botonAyudaTomarFecha}&nbsp;&nbsp;
                            <button type="button" id="verAgenda_{$id_pap}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_pap}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_pap == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
							{/if}
							<input type="text" value="{$id_paciente_examen_pap}" id="id_paciente_examen_pap" name="id_paciente_examen_pap" class="hidden">
							<button type="button" id="verExamen_{$id_pap}" style="{if $bo_finalizado != 1 and $examen_pap == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_pap').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
							</div>
                        </div>
                    </div>
                </div>
                                        
                <!-- Dislipidemia -->
                <div class="box box-success" style="{$dislipidemia}">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Dislipidemia (Mujeres de 40 años o mas)</h3></div>
                    <div class="box-body">  
                        <div class="form-group">   
                            <label class="control-label required col-sm-3">Colesterol total (mg/dl)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_colesterol" id="gl_colesterol" maxlength="4"
                                       onKeyPress="return soloNumeros(event)"
                                       value="{$gl_colesterol}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-3" style="{if !($gl_colesterol > 199 and $gl_colesterol < 240)}display: none{/if}" id="div_colesterol">
                                    {$botonConsejeriaColesterol}&nbsp;&nbsp;
                                <input type="checkbox" id="bo_colesterol_toma" {$bo_colesterol_toma}>
                                <label for="bo_colesterol_toma" class="control-label required">Toma de Colesterol</label>
                            </div>
                            <div class="col-sm-3" style="{if !($gl_colesterol >= 240) and $examen_colesterol == 0}display: none{/if}" id="div_colesterol_agenda">
								{if $bo_finalizado != 1}
                                    {$botonInformacionAgenda}&nbsp;&nbsp;
                                <button type="button" id="verAgenda_{$id_colesterol}" style="{if !($gl_colesterol >= 240) }display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_colesterol}', 'Agenda Registro número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-success" style="{if $agenda_colesterol == 0}display: none{/if}">                                        
                                    <i class="fa fa-calendar"></i> Agenda Examen</button>
									{/if}
									<input type="text" value="{$id_paciente_examen_colesterol}" id="id_paciente_examen_colesterol" name="id_paciente_examen_colesterol" class="hidden">
								<button type="button" id="verExamen_{$id_colesterol}" style="{if $bo_finalizado != 1 and $examen_colesterol == 0}display: none{/if}" 
                                        onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_colesterol').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
                                        class="btn btn-sm btn-info">                                        
                                    <i class="fa fa-eye"></i> Ver Examen</button>
                            </div>
                    </div>
                    </div>
                </div>

                <!-- Cáncer de mama -->
                <div class="box box-success" id="cancer_de_mama" style="{$mamografia}">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Cáncer de mama</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label required col-sm-3">¿Se ha realizado Examen de Mamografía?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_realizada" type="radio" name="bo_mamografia_realizada" 
                                              id="bo_mamografia_realizada_0" value="0" {$bo_mamografia_realizada_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_realizada" type="radio" name="bo_mamografia_realizada" 
                                              id="bo_mamografia_realizada_1" value="1" {$bo_mamografia_realizada_1}>SI</label>
                            </div>
                        </div>
                        <div class="form-group" id="fecha_mamografia" style="{if $bo_mamografia_realizada_1 != 'checked'}display: none{/if}">
                            <label class="control-label required col-sm-3">Fecha Mamografía</label>
							<div class="col-sm-1">
								<select class="form-control" id="fc_mamografia_mes" name="fc_mamografia_mes">
									<option value="0">Seleccione Mes</option>
									{foreach $arrMes as $item}
										<option value="{$item->id_mes}" >{$item->gl_mes}</option>
									{/foreach}
								</select>
                            </div>
                            <div class="col-sm-1">
                                <input type="date" name="fc_mamografia" id="fc_mamografia" value="" 
                                       placeholder="" class="form-control hidden"/>
								<input type="text" id="mamografia_ano" value="{$fc_mamografia_ano}" class="form-control hidden"/>
								<input type="text" id="mamografia_mes" value="{$fc_mamografia_mes}" class="form-control hidden"/>
								<select class="form-control" id="fc_mamografia_ano" name="fc_mamografia_ano">
									<option value="0">Seleccione Año</option>
									{for $i = 2017 to 1900 step=-1}
										<option value="{$i}" >{$i}</option>
									{/for}
								</select>
							</div>
                        </div>
                        <div class="form-group" id="mam_vigente" style="{if $fc_mamografia_ano == 0 and $fc_mamografia_mes == 0}display: none{/if}">    
                            <label class="control-label required col-sm-3">¿Mamografía Vigente?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_vigente" type="radio" name="bo_mamografia_vigente" 
                                              id="bo_mamografia_vigente_0" value="0" {$bo_mamografia_vigente_0} readonly>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_vigente" type="radio" name="bo_mamografia_vigente" 
                                              id="bo_mamografia_vigente_1" value="1" {$bo_mamografia_vigente_1} readonly>SI</label>
                            </div>
                            <div class="col-sm-1">
                                {$botonAyudaMamografiaVigente}
                            </div>
                        </div>
                        <div class="form-group" id="mam_resultado" style="{if $fc_mamografia_ano == 0 and $fc_mamografia_mes == 0}display: none{/if}"> 
                                <label class="control-label required col-sm-3">Resultado Mamografía</label>
                                <div class="col-sm-2">
                                    <label><input class="bo_mamografia_resultado_pasado" type="radio" name="bo_mamografia_resultado_pasado" 
                                                  id="bo_mamografia_resultado_pasado_0" value="0" {$bo_mamografia_resultado_pasado_0}>Alterado</label>
                                    &nbsp;&nbsp;
                                    <label><input class="bo_mamografia_resultado_pasado" type="radio" name="bo_mamografia_resultado_pasado" 
                                                  id="bo_mamografia_resultado_pasado_1" value="1" {$bo_mamografia_resultado_pasado_1}>Normal</label>
									&nbsp;&nbsp;
									<label><input class="bo_mamografia_resultado_pasado" type="radio" name="bo_mamografia_resultado_pasado" 
												  id="bo_mamografia_resultado_pasado_2" value="1" {$bo_mamografia_resultado_pasado_2}>NO SABE</label>
                                </div>
                        </div>        
                        <div class="form-group" id="mam_requiere"> 
                            <label class="control-label required col-sm-3">¿Requiere Mamografía?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_requiere" type="radio" name="bo_mamografia_requiere" 
                                              id="bo_mamografia_requiere_0" value="0"{$bo_mamografia_requiere_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_requiere" type="radio" name="bo_mamografia_requiere" 
                                              id="bo_mamografia_requiere_1" value="1" {$bo_mamografia_requiere_1}>SI</label>
                            </div>
                        </div>
                        <div class="form-group" id="requiere_mamografia2" style="{if $bo_mamografia_requiere_1 != 'checked'}display: none{/if}">
                            <div id="mam_resultado2" style="{if $bo_mamografia_requiere_1 != 'checked' and $examen_mamografia == 0}display: none{/if}"> 
                                <label class="control-label required col-sm-3">Toma Fecha para Mamografía</label>
                                <div class="col-sm-3" id="div_mamografia_agenda">
									{if $bo_finalizado != 1}
									{$botonInformacionAgendaMamografia}&nbsp;&nbsp;
									<button type="button" id="verAgenda_{$id_mamografia}" 
											onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}/{$id_empa}/{$id_centro_salud}/{$id_mamografia}', 'Agenda Registro número : {$id_paciente}', 85);" 
											class="btn btn-sm btn-success" style="{if $agenda_mamografia == 0}display: none{/if}">                                        
										<i class="fa fa-calendar"></i> Agenda Examen</button>
									{/if}
									<input type="text" value="{$id_paciente_examen_mamografia}" id="id_paciente_examen_mamografia" name="id_paciente_examen_mamografia" class="hidden">
									<button type="button" id="verExamen_{$id_mamografia}" style="{if $bo_finalizado != 1 and $examen_mamografia == 0}display: none{/if}" 
											onClick="xModal.open('{$smarty.const.BASE_URI}/Laboratorio/buscar/1/'+$('#id_paciente_examen_mamografia').val()+'/', 'Agenda Examen número : {$id_paciente}', 85);" 
											class="btn btn-sm btn-info">                                        
										<i class="fa fa-eye"></i> Ver Examen</button>
								</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Observaciones</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <label>Observaciones</label>
                                <textarea type="text" class="form-control col-sm-10" rows="5" id="gl_observaciones_empa" name="gl_observaciones_empa"
                                          placeholder="Ingrese Observaciones" style="resize: none">{$gl_observaciones_empa}</textarea>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>


                    {*    <div class="form-group">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="chkDeriva">&nbsp;&nbsp;<strong>Deriva</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" {$check} id="chkReconoce">&nbsp;&nbsp;<strong>Reconoce Maltrato</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12" hidden="hidden">
                                <!-- Si Deriva, muestra listado de especialidades a las que puede derivar -->
                            </div>
                        </div> *}
                        
                        <div class="form-group col-sm-11" align="right" id="btn_guardar" style="display: block">
                            <button type="button" id="guardar" class="btn btn-success">
                                <i class="fa fa-save"></i>  Guardar
                            </button>&nbsp;
                            <button type="button" id="cancelar"  class="btn btn-default" 
                                    onclick="location.href = '{$base_url}/Paciente/index'">
                                <i class="fa fa-remove"></i>  Cancelar
                            </button>
                        </div>
						<div class="form-group col-sm-11" align="right" id="btn_aceptar" style="display: none">
                            <button type="button" id="aceptar" class="btn btn-default"
									onclick="history.back(-1)">
                                <i class="fa fa-arrow-circle-left"></i> Volver
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</form>