<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Ingresar EMPA</h1>
    <div class="col-md-12 text-right">
        <button type="button"
                href='javascript:void(0)' 
                onClick="xModal.open('{$smarty.const.BASE_URI}/Registro/bitacora/{$id_registro}', 'Registro número : {$id_registro}', 85);" 
                data-toggle="tooltip" 
                title="Bitácora"
                class="btn btn-sm btn-flat btn-primary">
			<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Bitácora
        </button>
    </div>
    <br/><br/>
</section>

<form id="form" class="form-horizontal">
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Examen de medicina preventiva de las personas de 15 años o m&aacute;s
            </div>

            <!-- Cabecera EMPA -->
            <div class="panel-body">  

                <div class="form-group">
                    <label class="control-label col-sm-2">Comuna</label>
                    <div class="col-sm-3">
                        <input type="text" name="gl_comuna" id="gl_comuna" value="{$gl_comuna}" 
                               placeholder="Comuna" class="form-control" readonly/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gl_institucion" class="control-label col-sm-2">Centro de Salud (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="gl_institucion" id="gl_institucion" value="{$gl_institucion}"
                               placeholder="Institución" class="form-control" readonly/>
                        <span class="help-block hidden"></span>
                    </div>
                    <label for="nr_ficha" class="control-label col-sm-2">N° de Ficha (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="nr_ficha" id="nr_ficha" value="" 
                               placeholder="N° de Ficha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                </div>

                <div class="form-group">
                    <label for="id_sector" class="control-label col-sm-2">Sector (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="id_sector" id="id_sector" value="" 
                               placeholder="Sector" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <label for="fc_empa" class="control-label col-sm-2">Fecha (*)</label>
                    <div class="col-sm-3">
                        <input type="date" name="fc_empa" id="fc_empa" value="{$fc_empa}" 
                               placeholder="Fecha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>    
                <div class="form-group">
                    <label class="control-label col-sm-2">Nro. Registro</label>
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
                    <label class="control-label col-sm-2 ">Rut Paciente</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$gl_rut}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Nombres</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$gl_nombres}</span>
                    </div>
                    <label class="control-label col-sm-1">Apellidos</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$gl_apellidos}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Fecha Nacimiento</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$fc_nacimiento}</span>
                    </div>
                    <label class="control-label col-sm-1">Edad</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$edad}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">G&eacute;nero</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>Femenino</span>
                    </div>   
                    <label class="control-label col-sm-1">E-mail</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$gl_email}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Fono</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$gl_fono}</span>
                    </div>
                    <label class="control-label col-sm-1">Celular</label>
                    <div class="col-md-4 col-sm-3">
						<span class="form-control" readonly>{$gl_celular}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Direcci&oacute;n</label>
                    <div class="col-lg-9 col-sm-10">
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
                <!-- a. Alcoholismo -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Alcoholismo</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3 required">¿Consume bebidas alcoh&oacute;licas?</label>
                            <div class="col-sm-1">
                                <label><input class="bo_consume_alcohol" type="radio" name="bo_consume_alcohol" 
                                              id="bo_consume_alcohol_0" value="0" {$bo_consume_alcohol_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_consume_alcohol" type="radio" name="bo_consume_alcohol" 

                                              id="bo_consume_alcohol_1" value="1" {$bo_consume_alcohol_1}>SI</label>
                            </div>
                            <div id="div_alcoholismo" style="{if $bo_consume_alcohol_1 != 'checked'}display: none{/if}">
                                <div class="col-sm-1">
                                    <button href='javascript:void(0)'
                                            onClick="xModal.open('{$smarty.const.BASE_URI}/Empa/audit/{$id_empa}', 'AUDIT (Auto-diagnostico sobre Riesgos en el Uso de Alcohol)', 80);"
                                            data-toggle="tooltip"
                                            title="Ver Registro"
                                            type="button" id="btnaudit" class="btn btn-sm btn-info btn-flat">
                                        <i class="fa fa-file-text-o"></i>&nbsp;AUDIT 
                                    </button>
                                </div>
                                <div class="col-sm-1">
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

                <!-- b. Tabaquismo -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Tabaquismo</h3></div>
                    <div class="box-body">   
                        <div class="form-group">
                            <label class="control-label required col-sm-3">¿Usted fuma?</label>
                            <div class="col-sm-1">
                                <label><input class="bo_fuma" type="radio" name="bo_fuma" 
                                              id="bo_fuma_0" value="0" {$bo_fuma_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_fuma" type="radio" name="bo_fuma" 
                                              id="bo_fuma_1" value="1" {$bo_fuma_1}>SI</label>
                            </div>
                            <div class="col-sm-2"></div>
                            <label class="control-label required col-sm-1" id="lbl_fuma" style="{if $bo_fuma_1 != 'checked'}display: none{/if}">{$botonAyudaFumador}</label>
                        </div>
                    </div>
                </div>

                <!-- c. Obesidad -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Obesidad</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label required col-sm-3">Peso (Kg)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_peso" id="gl_peso" maxlength="4"
                                       onKeyPress="return soloNumeros(event)"
                                       value="{$gl_peso}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div> 
                        <div class="form-group">   
                            <label class="control-label required col-sm-3">Estatura (cm)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_estatura" id="gl_estatura" maxlength="4"
                                       onKeyPress="return soloNumeros(event)"
                                       value="{$gl_estatura}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="form-group">   

                            <label class="control-label required col-sm-3">Circunferencia Abdominal (cm)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_circunferencia_abdominal" id="gl_circunferencia_abdominal" maxlength="5"
                                       onKeyPress="return soloNumeros(event)" maxlength="4"
                                       value="{$gl_circunferencia_abdominal}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-1">  
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
                            <div class="col-sm-1">
                                <input type="text" name="gl_imc" id="gl_imc" 
                                       value="{$gl_imc}" placeholder="" class="form-control" readonly/>
                                <span class="help-block hidden"></span>
                            </div>  
                            <div class="col-sm-1">
                                {$botonAyudaIMC} &nbsp;
                                <button type="button" id="calcular" onclick="calculaIMC()" class="btn btn-sm btn-success">
                                    <i class="fa fa-success"></i> Calcular IMC</button>
                            </div>
                            <input type="text" name="id_clasificacion_imc" id="id_clasificacion_imc" 
                                   value="{$id_clasificacion_imc}" placeholder="" class="form-control hidden"/>
                        </div>
                    </div>
                </div>
                <!-- d. Hipertensión -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Hipertensión Arterial</h3></div>
                    <div class="box-body"> 
                        <div class="form-group">
                            <label class="control-label required col-sm-2">PAS (mm/Hg)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_pas" id="gl_pas" maxlength="4" onKeyPress="return soloNumeros(event)"
                                       value="{$gl_pas}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-1">
                                {$botonAyudaPAS}
                            </div>
                            <label class="control-label required col-sm-1">PAD (mm/Hg)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_pad" id="gl_pad" maxlength="4" onKeyPress="return soloNumeros(event)" 
                                       value="{$gl_pad}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-1">
                                {$botonAyudaPAD}
                            </div>
                            <div class="col-sm-1"></div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" id="verAgendaHipertension" style="{if $gl_pad < 90 and $gl_pas < 140}display: none{/if}" 
                                    class="btn btn-sm btn-success"><i class="fa fa-file-o"></i>Agenda</button>
                        </div>
                    </div>
                </div>
                
                <!-- e. Diabetes Mellitus (DM) -->
                <div class="box box-success" id="diabetes">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Diabetes Mellitus (DM)</h3></div>
                    <div class="box-body">
                        <div class="form-group" id="antecedentes" style="{$antecedentes}">
                            <label class="control-label required col-sm-2">¿Tiene Antecedentes Familiares de Diabetes Mellitus?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_antecedente" type="radio" name="bo_antecedente" 
                                              id="bo_antecedente_0" value="0">No</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_antecedente" type="radio" name="bo_antecedente" 
                                              id="bo_antecedente_1" value="1">Si</label>
                            </div>
                        </div>   
                        <div class="form-group" id="glicemia" style="{$diabetes}">
                            <label class="control-label required col-sm-2">Glicemia en Ayunas (mg/dl)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_glicemia" maxlength="4" id="gl_glicemia" value="{$gl_glicemia}" 
                                       placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>   
                            <div class="col-sm-5">
                                {$botonAyudaGlicemia}
                            </div>
                            <div class="col-sm-2" style="{if !($gl_glicemia >= 100 and $gl_glicemia <= 125)}display: none{/if}" id="div_glicemia_toma">
                                <input type="checkbox" id="bo_glicemia_toma" {$bo_glicemia_toma}>
                                <label for="bo_glicemia_toma" class="control-label required">Toma de Glicemia</label>
                                <div class="col-sm-1">
                                    {$botonConsejeriaGlicemia}
                                </div>
                            </div>
                            <div class="col-sm-2">    
                                <div class="col-sm-1" id="div_glicemia_agenda" style="{if !($gl_glicemia > 125)}display: none{/if}">
                                    {$botonInformacionAgenda}
                                </div>
                                <button type="button" id="verAgendaDiabetes" style="{if !($gl_glicemia > 125)}display: none{/if}"
                                        class="btn btn-sm btn-success"><i class="fa fa-file-o"></i>Agenda</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- f. Sífilis -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Sifilis en población de riesgo</h3></div>
                    <div class="box-body">    
                        <div class="form-group">
                            <label class="control-label required col-sm-2">¿Es trabajadora sexual o persona en centro de reclusión?</label>
                            <div class="col-sm-1">
                                <label><input class="bo_trabajadora_reclusa" type="radio" name="bo_trabajadora_reclusa" 
                                              id="bo_trabajadora_reclusa_0" value="0" {$bo_trabajadora_reclusa_0}>No</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_trabajadora_reclusa" type="radio" name="bo_trabajadora_reclusa" 
                                              id="bo_trabajadora_reclusa_1" value="1" {$bo_trabajadora_reclusa_1}>Si</label>
                            </div>
                        </div>  
                        <div class="form-group" id="id_vdrl_rpr" style="{if $bo_trabajadora_reclusa_1 != 'checked'}display: none{/if}">
                            <label class="control-label required col-sm-2">¿Examen VDRL?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_vdrl" type="radio" name="bo_vdrl" 
                                              id="bo_vdrl_0" value="0" {$bo_vdrl_0}>Negativo</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_vdrl" type="radio" name="bo_vdrl" 
                                              id="bo_vdrl_1" value="1" {$bo_vdrl_1}>Positivo</label>
                            </div>
                            <label class="control-label required col-sm-1">¿Examen RPR?</label>
                            <div class="col-sm-3">
                                <label><input class="bo_rpr" type="radio" name="bo_rpr" 
                                              id="bo_rpr_0" value="0" {$bo_rpr_0}>Negativo</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_rpr" type="radio" name="bo_rpr" 
                                              id="bo_rpr_1" value="1" {$bo_rpr_1}>Positivo</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-sm-1" style="{if $bo_vdrl_1 != 'checked' and $bo_rpr_1 != 'checked'}display: none{/if}" id="div_ITS_agenda">
                                    {$botonInformacionAgendaITS}
                                </div>
                                <button type="button" id="verAgendaSifilis" style="{if $bo_vdrl_1 != 'checked' and $bo_rpr_1 != 'checked'}display: none{/if}"
                                        class="btn btn-sm btn-success"><i class="fa fa-file-o"></i>Agenda</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- g. Tuberculósis -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Tuberculosis</h3></div>
                    <div class="box-body">  
                        <div class="form-group">
                            <label class="control-label required col-sm-2">¿Ha tenido tos productiva por m&aacute;s de 15 d&iacute;as?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_tos_productiva" type="radio" name="bo_tos_productiva" 
                                              id="bo_tos_productiva_0" value="0" {$bo_tos_productiva_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_tos_productiva" type="radio" name="bo_tos_productiva" 
                                              id="bo_tos_productiva_1" value="1" {$bo_tos_productiva_1}>SI</label>	
                            </div>
                        </div>
                        <div class="form-group" id="id_baciloscopia" style="{if $bo_tos_productiva_1 != 'checked'}display: none{/if}">
                            <label class="control-label required col-sm-2">Basiloscopia</label>
                            <div class="col-sm-2">
                                <label><input class="bo_baciloscopia_toma" type="radio" name="bo_baciloscopia_toma" 
                                              id="bo_baciloscopia_toma_0" value="0" {$bo_baciloscopia_toma_0}>Negativo</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_baciloscopia_toma" type="radio" name="bo_baciloscopia_toma" 
                                              id="bo_baciloscopia_toma_1" value="1" {$bo_baciloscopia_toma_1}>Positivo</label>
                            </div>
							<div class="col-sm-1">
								{$botonAyudaBasiloscopia}
							</div>
                        </div>
                    </div>
                </div>

                <!-- h. PAP -->
                <div class="box box-success" style="{$pap}">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> PAP (Mujeres de 25 a 64 años Cáncer Cervicouterino)</h3></div>
                    <div class="box-body">  
                        <div class="form-group">
                            <label class="control-label required col-sm-2">¿Se ha realizado PAP?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_pap_realizado" type="radio" name="bo_pap_realizado" 
                                              id="bo_pap_realizado_0" value="0" {$bo_pap_realizado_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_pap_realizado" type="radio" name="bo_pap_realizado" 
                                              id="bo_pap_realizado_1" value="1" {$bo_pap_realizado_1}>SI</label>
                            </div>
                        </div>
                        <div class="form-group" id="ultimo_pap" style="{if $bo_pap_realizado_1 != 'checked'}display: none{/if}">         
                            <label class="control-label required col-sm-2">Fecha &uacute;ltimo PAP</label>
                            <div class="col-sm-2">
                                <input type="date" name="fc_ultimo_pap" id="fc_ultimo_pap" 
                                       value="{$fc_ultimo_pap}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            &nbsp;&nbsp;
                            <button type="button" id="verAgendaPap1" 
                                    class="btn btn-sm btn-success"><i class="fa fa-file-o"></i>Agenda</button>
                        </div>
                        <div class="form-group" style="{if !($bo_pap_vigente_0 or $bo_pap_vigente_1)}display: none{/if}" id="pap_vigente">    
                            <label class="control-label required col-sm-2">PAP Vigente</label>
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
                        <div class="form-group" id="tomar_fecha" style="{if $bo_pap_realizado_0 != 'checked'}display: none{/if}">         
                            <label class="control-label required col-sm-2">Tomar Fecha para PAP</label>
                            <div class="col-sm-2">
                                <input type="date" name="fc_tomar_pap" id="fc_tomar_pap" 
                                       value="{$fc_tomar_pap}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            &nbsp;&nbsp;
                            <button type="button" id="verAgendaPap" 
                                    class="btn btn-sm btn-success"><i class="fa fa-file-o"></i>Agenda</button>
                        </div>
                        <div class="form-group" id="resultado_pap">
                            <label class="control-label required col-sm-2">Resultado PAP</label>
                            <div class="col-sm-2">
                                <label><input class="bo_pap_toma"  type="radio" name="bo_pap_toma" 
                                              id="bo_pap_toma_0" value="0" {$bo_pap_toma_0}>Alterado</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_pap_toma" type="radio" name="bo_pap_toma" 
                                              id="bo_pap_toma_1" value="1" {$bo_pap_toma_1}>Normal</label>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="verPAP" class="btn btn-sm btn-info">
                                    <i class="fa fa-info"></i> Ver Resultado</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dislipidemia -->
                <div class="box box-success" style="{$dislipidemia}">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Dislipidemia (Mujeres de 40 años o mas)</h3></div>
                    <div class="box-body">  
                        <div class="form-group">   
                            <label class="control-label required col-sm-2">Colesterol total (mg/dl)</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_colesterol" id="gl_colesterol" maxlength="4"
                                       onKeyPress="return soloNumeros(event)"
                                       value="{$gl_colesterol}" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-3" style="{if !($gl_colesterol > 199 and $gl_colesterol < 240)}display: none{/if}" id="div_colesterol">
                                <input type="checkbox" id="bo_colesterol_toma" {$bo_colesterol_toma}>
                                <label for="bo_colesterol_toma" class="control-label required">Toma de Colesterol</label>
                                <div class="col-sm-1" id="div_consejeria_colesterol">
                                    {$botonConsejeriaColesterol}
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                            <button type="button" id="verAgendaDislipidemia" style="{if !($gl_colesterol >= 240) }display: none{/if}" 
                                    class="btn btn-sm btn-success"><i class="fa fa-file-o"></i>Agenda</button>
                            <div class="col-sm-3" style="{if !($gl_colesterol >= 240) }display: none{/if}" id="div_colesterol_agenda">
                                {$botonInformacionAgenda}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- j. Mujeres de 50 años (cáncer de mama) -->
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-sticky-note"></i> Cáncer de mama</h3></div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label required col-sm-2">¿Se ha realizado Examen de Mamografía?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_realizada" type="radio" name="bo_mamografia_realizada" 
                                              id="bo_mamografia_realizada_0" value="0" {$bo_mamografia_realizada_0}>NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_realizada" type="radio" name="bo_mamografia_realizada" 
                                              id="bo_mamografia_realizada_1" value="1" {$bo_mamografia_realizada_1}>SI</label>
                            </div>
                        </div>
                        <div class="form-group" id="fecha_mamografia" style="{if $bo_mamografia_realizada_1 != 'checked'}display: none{/if}">
                            <label class="control-label required col-sm-2">Fecha Mamografía</label>
                            <div class="col-sm-2">
                                <input type="date" name="fc_mamografia" id="fc_mamografia" value="{$fc_mamografia}" 
                                       placeholder="" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group" id="mam_vigente" style="{if $fc_mamografia == ""}display: none{/if}">    
                            <label class="control-label required col-sm-2">¿Mamografía Vigente?</label>
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
                        <div class="form-group" id="mam_resultado" style="{if $fc_mamografia == ""}display: none{/if}"> 
                            <label class="control-label required col-sm-2">Resultado Mamografía</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_resultado" type="radio" name="bo_mamografia_resultado" 
                                              id="bo_mamografia_resultado" value="0">Alterado</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_resultado" type="radio" name="bo_mamografia_resultado" 
                                              id="bo_mamografia_resultado" value="1">Normal</label>
                            </div>
                        </div>
                        <div class="form-group" id="mam_requiere"> 
                            <label class="control-label required col-sm-2">¿Requiere Mamografía?</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_requiere" type="radio" name="bo_mamografia_requiere" 
                                              id="bo_mamografia_requiere" value="0">NO</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_requiere" type="radio" name="bo_mamografia_requiere" 
                                              id="bo_mamografia_requiere" value="1">SI</label>
                            </div>
                            <div id="requiere_mamografia" style="display: none">
                                <div class="col-sm-2" id="toma_mamografia">
                                    <input type="checkbox" id="bo_mamografia_toma" {$bo_mamografia_toma}>
                                    <label for="bo_mamografia_toma" class="control-label required">Toma Mamograf&iacute;a</label>
                                </div>
                                    <div class="col-sm-2"></div>
                                <div class="col-sm-3">
                                    <div class="col-sm-1" id="div_mamografia_agenda">
                                        {$botonInformacionAgendaMamografia}
                                    </div>
                                    <button type="button" id="verAgendaMamografia" class="btn btn-sm btn-success">
                                        <i class="fa fa-file-o"></i> Agenda</button>
                                </div>    
                            </div>
                        </div>
                        <div class="form-group" id="mam_resultado2" style="display: none"> 
                            <label class="control-label required col-sm-2">Resultado Mamografía</label>
                            <div class="col-sm-2">
                                <label><input class="bo_mamografia_resultado2" type="radio" name="bo_mamografia_resultado2" 
                                              id="bo_mamografia_resultado2" value="0">Alterado</label>
                                &nbsp;&nbsp;
                                <label><input class="bo_mamografia_resultado2" type="radio" name="bo_mamografia_resultado2" 
                                              id="bo_mamografia_resultado2" value="1">Normal</label>
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
                        
                        <div class="form-group col-sm-11" align="right">
                            <button type="button" id="guardar" class="btn btn-success">
                                <i class="fa fa-save"></i>  Guardar
                            </button>&nbsp;
                            <button type="button" id="cancelar"  class="btn btn-default" 
                                    onclick="location.href = '{$base_url}/Empa/index'">
                                <i class="fa fa-remove"></i>  Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</form>