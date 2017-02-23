<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Ingresar EMPA</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" class="btn btn-success"
                onclick="location.href = '{$base_url}/Paciente/index/{$id_pac}'">
            <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver Ficha Paciente
        </button>
    </div>
    <br/><br/>
</section>

<form id="form" class="form-horizontal">

    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Examen de medicina preventiva de las personas de 15 años o m&aacute;s
            </div>

            <!-- Cabecera EMPA -->
            <div class="panel-body">  

                <div class="form-group">
                    <label class="control-label col-sm-2 required">Comuna</label>
                    <div class="col-sm-3">
                        <input type="text" name="id_comuna" id="id_comuna" value="{$id_comuna}" 
                               placeholder="Comuna" class="form-control" disabled/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="id_institucion" class="control-label col-sm-2 required">Centro de Salud (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="id_institucion" id="id_institucion" value=""
                               placeholder="Institución" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    <label for="nr_ficha" class="control-label col-sm-2 required">N° de Ficha (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="nr_ficha" id="nr_ficha" value="" 
                               placeholder="N° de Ficha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                </div>

                <div class="form-group">
                    <label for="id_sector" class="control-label col-sm-2 required">Sector (*)</label>
                    <div class="col-sm-3">
                        <input type="text" name="id_sector" id="id_sector" value="" 
                               placeholder="Sector" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <label for="fc_empa" class="control-label col-sm-2 required">Fecha (*)</label>
                    <div class="col-sm-3">
                        <input type="date" name="fc_emp" id="fc_emp" value="" 
                               placeholder="Fecha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>    
                <div class="form-group">
                    <label class="control-label col-sm-2 required">Nro. Registro</label>
                    <div class="col-sm-3">
                        <input type="text" name="id_registro" id="id_registro" value="{$id_registro}" 
                               placeholder="N° Registro" class="form-control" disabled/>
                    </div>
                </div>

            </div>
        </div>

        <div class="top-spaced"></div>   

        <div class="panel panel-primary">
            <div class="panel-heading">Datos del Paciente</div>

            <!-- Datos del Paciente -->
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2 required">Rut Paciente</label>
                    <div class="col-sm-3">
                        {$rut} 1-9
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2 required">Nombres</label>
                    <div class="col-sm-3">
                        {$nombres} Nombre Paciente
                    </div>
                    <label class="control-label col-sm-2 required">Apellidos</label>
                    <div class="col-sm-3">
                        {$apellidos} Apellidos Paciente
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2 required">Fecha Nacimiento</label>
                    <div class="col-sm-3">
                        {$fecnacimiento} dd/mm/aaaa
                    </div>
                    <label class="control-label col-sm-2 required">Edad</label>
                    <div class="col-sm-3">
                        {$edad} XX
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2 required">G&eacute;nero</label>
                    <div class="col-sm-3">
                        {$genero} Femenino
                    </div>
                    <label class="control-label col-sm-2 required">Direcci&oacute;n</label>
                    <div class="col-sm-3">
                        {$direccion} Dirección
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2 required">Fono</label>
                    <div class="col-sm-3">
                        {$fono} 9900000000
                    </div>
                    <label class="control-label col-sm-2 required">Celular</label>
                    <div class="col-sm-3">
                        {$celular} +56900000000
                    </div>
                </div>

                <div class="form-group">    
                    <label class="control-label col-sm-2 required">E-mail</label>
                    <div class="col-sm-3">
                        {$email} E-mail
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
                <div class="panel panel-success">
                    <div class="panel-heading">Alcoholismo</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2 required">¿Consume bebidas alcoh&oacute;licas?</label>
                            <div class="col-sm-2">
                                <label><input type="radio" name="bo_consume_alcohol" 
                                              id="bo_consume_alcohol" value="0">NO</label>
                                &nbsp;&nbsp;
                                <label><input type="radio" name="bo_consume_alcohol" 
                                              id="bo_consume_alcohol" value="1">SI</label>
                            </div>
                            <label class="control-label col-sm-1 required">AUDIT (pts.)</label>
                            <div class="col-sm-1">
                                    <input type="text" name="gl_puntos_audit" id="gl_puntos_audit" value="" 
                                           placeholder="AUDIT Puntos" class="form-control"/>
                                    <span class="help-block hidden"></span>

                            </div>

                            <div class="col-sm-2">
                                <span class=" fa fa-question-circle" >(*) Consejer&iacute;a seg&uacute;n tipo de consumo</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- b. Tabaquismo -->
                <div class="panel panel-success">
                    <div class="panel-heading">Tabaquismo</div>
                    <div class="panel-body">   
                        <div class="form-group">
                            <label class="control-label required col-sm-2">¿Usted fuma?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_fuma" 
                                               id="bo_fuma" value="0">NO</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_fuma" 
                                               id="bo_fuma" value="1">SI</label>
                            </div>
                                <label class="control-label required col-sm-1">(*) Consejer&iacute;a breve</label>
                        </div>
                    </div>
                </div>
                
                <!-- c. Obesidad -->
                <div class="panel panel-success">
                    <div class="panel-heading">Obesidad</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label required col-sm-2">Peso (Kg)</label>
                            <div class="col-sm-2">
                                    <input type="text" name="gl_peso" id="gl_peso" 
                                           value="" placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>
                            <label class="control-label required col-sm-1">Estatura (cm)</label>
                            <div class="col-sm-2">
                                    <input type="text" name="gl_estatura" id="gl_estatura" 
                                           value="" placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="form-group">   
                            <label class="control-label required col-sm-2">Circunferencia Abdominal</label>
                            <div class="col-sm-2">
                                <input type="text" name="gl_circunferencia_abdominal" id="gl_circunferencia_abdominal" 
                                       value="" placeholder="" class="form-control"/>
                                <span class="help-block hidden"></span>
                            </div>
                            <label class="control-label required col-sm-1">IMC</label>
                            <div class="col-sm-3">
                                <input type="text" name="gl_imc" id="gl_imc" 
                                       value="" placeholder="" class="form-control" disabled/>
                                <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="ver" class="btn btn-sm btn-info">
                                    <i class="fa fa-info"></i> Ver</button>
                            </div>
                        </div>  
                        <div class="form-group">
                                <label class="control-label required col-sm-6">
                                    Mujer >= 88 cm. Circunferencia abdominal (Punto medio entre margen inferior de 
                                    la &uacute;ltima costilla y la cresta iliaca)</label>
                        </div>
                        <div class="form-group">
                                <label class="control-label required col-sm-6">(*) Consejería en alimentación y actividad física</label>
                        </div>
                    </div>
                </div>
                <!-- d. Hipertensión -->
                <div class="panel panel-success">
                    <div class="panel-heading">Hipertensión Arterial</div>
                    <div class="panel-body"> 
                        <div class="form-group">
                            <label class="control-label required col-sm-2">PAS (mm/Hg)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_pas" id="gl_pas" 
                                           value="" placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>
                            <label class="control-label required col-sm-2">PAD (mm/Hg)</label>
                            <div class="col-sm-1">
                                <input type="text" name="gl_pad" id="gl_pad" value="" 
                                           placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>
                        </div>    
                        <div class="form-group">
                                <label class="control-label required col-sm-6">(*) Referir a perfil de presi&oacute;n arterial</label>
                        </div>
                    </div>
                </div>
                <!-- e. Diabetes Mellitus (DM) -->
                <div class="panel panel-success">
                    <div class="panel-heading">Diabetes Mellitus (DM)</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>(Mayor de 40 años, obeso o antecedente de DM en padre o hermanos)</label>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="control-label required col-sm-2">Glicemia en Ayunas (mg/dl)</label>
                            <div class="col-sm-3">
                                <input type="text" name="gl_glicemia" id="gl_glicemia" value="" 
                                           placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>   
                            <div class="col-sm-3">
                                    <input type="checkbox" id="bo_glicemia_toma">
                                    <label for="bo_glicemia_toma" class="control-label required">Toma de Glicemia</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- f. Sífilis -->
                <div class="panel panel-success">
                    <div class="panel-heading">Sifilis en población de riesgo</div>
                    <div class="panel-body">    
                        <div class="form-group">
                                <label class="control-label required col-sm-2">¿Es trabajadora sexual o persona en centro de reclusión?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_trabajadora_reclusa" 
                                               id="bo_trabajadora_reclusa" value="0">No</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_trabajadora_reclusa" 
                                               id="bo_trabajadora_reclusa" value="1">Si</label>
                            </div>
                        </div>  
                        <div class="form-group">
                                <label class="control-label required col-sm-2">¿Examen VDRL?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_vdrl" 
                                               id="bo_vdrl" value="0">Negativo</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_vdrl" 
                                               id="bo_vdrl" value="1">Positivo</label>
                            </div>
                                <label class="control-label required col-sm-1">¿Examen RPR?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_rpr" 
                                               id="bo_rpr" value="0">Negativo</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_rpr" 
                                               id="bo_rpr" value="1">Positivo</label>
                            </div>
                                <label class="control-label required col-sm-2">(*) Referir a programa ITS</label>
                        </div>
                    </div>
                </div>
                
                <!-- g. Tuberculósis -->
                <div class="panel panel-success">
                    <div class="panel-heading">Tuberculosis</div>
                    <div class="panel-body">  
                        <div class="form-group">
                                <label class="control-label required col-sm-2">¿Ha tenido tos productiva por m&aacute;s de 15 d&iacute;as?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_tos_productiva" 
                                               id="bo_tos_productiva" value="0">NO</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_tos_productiva" 
                                               id="bo_tos_productiva" value="1">SI</label>
                            </div>
                                <label class="control-label required col-sm-1">¿Basiloscopia?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_baciloscopia_toma" 
                                               id="bo_baciloscopia_toma" value="0">Negativo</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_baciloscopia_toma" 
                                               id="bo_baciloscopia_toma" value="1">Positivo</label>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label required col-sm-6">(1ra muestra de inmediato y entrega de una caja para muestra
                                    del d&iacute;a siguiente al despertar)</label>
                        </div>
                    </div>
                </div>
                
                <!-- h. Mujeres de 25 a 64 años -->
                <div class="panel panel-success">
                    <div class="panel-heading">PAP (Mujeres de 25 a 64 años Cáncer Cervicouterino)</div>
                    <div class="panel-body">  
                        <div class="form-group">
                                <label class="control-label required col-sm-2">¿Se ha realizado PAP?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_pap_realizado" 
                                               id="bo_pap_realizado" value="0">NO</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_pap_realizado" 
                                               id="bo_pap_realizado" value="1">SI</label>
                            </div>
                                <label class="control-label required col-sm-1">Fecha &uacute;ltimo Papanicolau</label>
                            <div class="col-sm-2">
                                <input type="date" name="fc_ultimo_pap" id="fc_ultimo_pap" 
                                           value="" placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>
                        </div>
                        <div class="form-group">    
                                <label class="control-label required col-sm-2">PAP Vigente</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_pap_vigente" 
                                               id="bo_pap_vigente" value="0">NO</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_pap_vigente" 
                                               id="bo_pap_vigente" value="1">SI</label>
                            </div>
                            <div class="col-sm-2">
                                    <input type="checkbox" id="bo_pap_toma">
                                    <label for="bo_pap_toma" class="control-label required">Toma de PAP</label>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" id="verPAP" class="btn btn-sm btn-info">
                                    <i class="fa fa-info"></i> Ver Resultado</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- i. Personas de 40 años y más -->
                <div class="panel panel-success">
                    <div class="panel-heading">Dislipidemia (Mujeres de 40 años y mas)</div>
                    <div class="panel-body">  
                        <div class="form-group">   
                            <label class="control-label required col-sm-2">Colesterol total (mm/dl)</label>
                            <div class="col-sm-2">
                                    <input type="text" name="gl_colesterol" id="gl_colesterol" value="" 
                                           placeholder="" class="form-control"/>
                                    <span class="help-block hidden"></span>
                            </div>
                            <div class="col-sm-3">
                                        <input type="checkbox" id="bo_colesterol_toma">
                                        <label for="bo_colesterol_toma" class="control-label required">Toma de Colesterol</label>
                            </div>
                        </div>   
                        <div class="form-group">     
                            <div class="col-sm-4">
                                <label>(*) Consejer&iacute;a en alimentaci&oacute;n saludable y actividad f&iacute;sica</label>
                            </div>
                        </div>   
                        <div class="form-group">     
                            <div class="col-sm-4">
                                <label>(*) Referir a confirmaci&oacute;n diagn&oacute;stica</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- j. Mujeres de 50 años (cáncer de mama) -->
                <div class="panel panel-success">
                    <div class="panel-heading">Cáncer de mama</div>
                    <div class="panel-body">
                        <div class="form-group">
                                <label class="control-label required col-sm-2">¿Se ha realizado Examen de Mamografía?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_mamografia_realizada" 
                                               id="bo_mamografia_realizada" value="1">NO</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_mamografia_realizada" 
                                               id="bo_mamografia_realizada" value="2">SI</label>
                            </div>
                                <label class="control-label required col-sm-1">¿Mamografía Vigente?</label>
                            <div class="col-sm-2">
                                    <label><input type="radio" name="bo_mamografia_vigente" 
                                               id="bo_mamografia_vigente" value="1">NO</label>
                                    &nbsp;&nbsp;
                                    <label><input type="radio" name="bo_mamografia_vigente" 
                                               id="bo_mamografia_vigente" value="2">SI</label>
                            </div>
                            <div class="col-sm-3">
                                        <input type="checkbox" id="bo_mamografia_toma">
                                        <label class="control-label required">Toma Mamograf&iacute;a</label>
                            </div>
                        </div>    
                        <div class="form-group">    
                            <label class="control-label required">Mamograf&iacute;a a otras edades</label>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="panel panel-success">
                    <div class="panel-heading">Observaciones</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <label>Observaciones</label>
                                <textarea class="form-control col-sm-10" rows="5" id="gl_observaciones_empa" nombre="gl_observaciones_empa"
                                          placeholder="Ingrese Observaciones" style="resize: none"></textarea>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>


                        <div class="form-group">
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
                                        <input type="checkbox" id="chkReconoce">&nbsp;&nbsp;<strong>Reconoce Maltrato</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12" hidden="hidden">
                                <!-- Si Deriva, muestra listado de especialidades a las que puede derivar -->
                            </div>
                        </div>
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