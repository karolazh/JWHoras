<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Ingresar EMPA</h1>
    <div class="col-md-12 text-right">
        <button type="button" id="ingresar" class="btn btn-success"
            onclick="location.href='{$base_url}/Paciente/index/{$id_pac}'">
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
</section>
<section class="content">
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
</section> 
<section class="content">
            <div class="panel panel-primary">
            <div class="panel-heading">Examen</div>
            
            <!-- Examen -->
            <div class="panel-body">
                <!-- a. Beber problema -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">a. Beber Problema</label>
                    </div>
                </div>
                <div class="form-group" align="center">
                    <div class="col-sm-3">
                        <div class="radio">
                            <label class="control-label required"><strong>¿Consume bebidas alcoh&oacute;licas?</strong></label>
                                <label><input type="radio" name="bo_consume_alcohol" 
                                     id="bo_consume_alcohol" value="1">NO</label>
                                &nbsp;&nbsp;
                                <label><input type="radio" name="bo_consume_alcohol" 
                                     id="bo_consume_alcohol" value="2">SI</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        AUDIT&nbsp;<label>
                            <input type="text" name="gl_puntos_audit" id="gl_puntos_audit" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>&nbsp;puntos
                        
                    </div>
                    
                    <div class="col-sm-2">
                            <label class="control-label required"><strong>(*) Consejer&iacute;a seg&uacute;n tipo de consumo</strong></label>
                    </div>
                </div>
                
                <!-- b. Tabaquismo -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">b. Tabaquismo</label>
                    </div>
                </div>    
                <div class="form-group">    
                    <div class="col-sm-3">
                            <label class="control-label required">¿Usted fuma?</label>
                    </div>

                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="bo_fuma" 
                                     id="bo_fuma" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="bo_fuma" 
                                     id="bo_fuma" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                            <label class="control-label required">
                                <strong>(*) Consejer&iacute;a breve</strong></label>
                    </div>
                </div>
                
                <!-- c. Obesidad -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">c. Obesidad</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        PESO
                        <label>
                            <input type="text" name="gl_peso" id="gl_peso" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        Kg
                    </div>
                    <div class="col-sm-3">
                        TALLA
                        <label>
                            <input type="text" name="gl_estatura" id="gl_estatura" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        Kg
                    </div>
                    <div class="col-sm-3">
                        IMC
                        <label>
                            <input type="text" name="gl_imc" id="gl_imc" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                    </div>
                    <div class="col-sm-3">
                        Clasificación IMC
                        <label>
                        <input type="text" name="id_clasificacion_imc" id="id_clasificacion_imc" 
                                   value="" placeholder="" class="form-control" disabled/>
                        <span class="help-block hidden"></span>
                        </label>
                    </div>
                </div>  
                
                <div class="form-group">
                    <div class="col-sm-12">
                            <label class="control-label required">
                                Circunferencia abdominal (Punto medio entre margen inferior de 
                                la &uacute;ltima costilla y la cresta iliaca)</label>
                    </div>
                </div>    
                <div class="form-group">
                    <div class="col-sm-2">
                            <label class="control-label required">Mujer >= 88 cm.</label>
                    </div>

                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="gl_circunferencia_abdominal" 
                                     id="gl_circunferencia_abdominal" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="gl_circunferencia_abdominal" 
                                     id="gl_circunferencia_abdominal" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                            <label class="control-label required"><strong>(*) Consejería en alimentación y actividad física</strong></label>
                    </div>
                </div>
                
                <!-- d. Hipertensión -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">d. Hipertensi&oacute;n</label>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-sm-3">
                        PAS
                        <label>
                            <input type="text" name="gl_pas" id="gl_pas" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm Hg
                    </div>
                    <div class="col-sm-2">
                            <label class="control-label required">>= 140 mm Hg</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn7" 
                                     id="rdBtn7" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn7" 
                                     id="rdBtn7" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        PAD
                        <label>
                            <input type="text" name="gl_pad" id="gl_pad" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm Hg
                    </div>
                    <div class="col-sm-2">
                            <label class="control-label required">>= 90 mm Hg</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn8" 
                                     id="rdBtn8" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn8" 
                                     id="rdBtn8" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <div class="col-sm-12">
                            <label class="control-label required">(*) Referir a perfil de presi&oacute;n arterial</label>
                    </div>
                </div>
                
                <!-- e. Diabetes Mellitus (DM) -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">e. Diabetes Mellitus (DM)</label>
                    </div>
                </div>   
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Mayor de 40 años, obeso o antecedente de DM en padre o hermanos</label>
                    </div>
                </div>   
                <div class="form-group">    
                    <div class="col-sm-3">
                        Glicemia en ayunas
                        <label>
                            <input type="text" name="gl_glicemia" id="gl_glicemia" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mg/dl
                    </div>
                </div>
                <div class="form-group">     
                    <div class="col-sm-2">
                            <label class="control-label required">100-125 mg/dl</label>
                    </div>

                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn9" 
                                     id="rdBtn9" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn9" 
                                     id="rdBtn9" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label>(*) Consejer&iacute;a alimentaci&oacute;n y A. Fca</label>
                    </div>
                        &nbsp;
                </div>
                <div class="form-group">     
                    <div class="col-sm-2">
                            <label class="control-label required">>= 126 mg/dl</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn10" 
                                     id="rdBtn10" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn10" 
                                     id="rdBtn10" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>(*) Referir a confirmaci&oacute;n diagn&oacute;stica</label>
                    </div>
                </div>
                
                <!-- f. Sífilis -->
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label required">f. S&iacute;filis</label>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-sm-5">
                            <label class="control-label required">Trabajadores sexuales y personas en centros de reclusi&oacute;n</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="bo_vdrl" 
                                     id="bo_vdrl" value="1">
                              VDRL
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="bo_rpr" 
                                     id="bo_rpr" value="1">
                              RPR
                            </label>
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn12" 
                                     id="rdBtn12" value="1">
                              Negativo
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn12" 
                                     id="rdBtn12" value="2">
                              Positivo
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                            <label class="control-label required">(*) Referir a programa ITS</label>
                    </div>
                </div>
                
                <!-- g. Tuberculósis -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">g. Tubercul&oacute;sis</label>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-sm-4">
                            <label class="control-label required">¿Ha tenido tos productiva por m&aacute;s de 15 d&iacute;as?</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="bo_tos_productiva" 
                                     id="bo_tos_productiva" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="bo_tos_productiva" 
                                     id="bo_tos_productiva" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="bo_baciloscopia_toma">Baciloscop&iacute;a
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">    
                    <div class="col-sm-12" hidden="hidden">
                        <!-- Si toma Baciloscopía, muestra indicaciones y resultado -->
                    </div>
                </div>  
                <div class="form-group">     
                    <div class="col-sm-12">
                            <label class="control-label required">(1ra muestra de inmediato y entrega de una caja para muestra
                                         del d&iacute;a siguiente al despertar)</label>
                    </div>
                </div>
                
                <!-- h. Mujeres de 25 a 64 años -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">
                            h. Mujeres de 25 a 64 años (c&aacute;ncer cervico uterino)</label>
                    </div>
                </div>   
                <div class="form-group">
                    <div class="col-sm-3">
                        Fecha &uacute;ltimo Papanicolau
                        <label>
                            <input type="date" name="fc_ultimo_pap" id="fc_ultimo_pap" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                    </div>
                    
                    <div class="col-sm-1">
                            <label class="control-label required">PAP Vigente</label>
                    </div>

                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="bo_pap_vigente" 
                                     id="bo_pap_vigente" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="bo_pap_vigente" 
                                     id="bo_pap_vigente" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                   
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="bo_pap_toma">Toma de PAP
                            </label>
                        </div>
                    </div>
                </div>   
                <div class="form-group">     
                    <div class="col-sm-12" hidden="hidden">
                        <!-- Si toma PAP muestra indicaciones y resultado -->
                    </div>
                </div>
                
                <!-- i. Personas de 40 años y más -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">i. Personas de 40 años y m&aacute;s (dislipidemia)</label>
                    </div>
                </div>   
                <div class="form-group">     
                    <div class="col-sm-3">
                        Colesterol total
                        <label>
                            <input type="text" name="gl_colesterol" id="gl_colesterol" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm/dl
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="bo_colesterol_toma">Toma de Colesterol
                            </label>
                        </div>
                    </div>
                </div>   
                <div class="form-group">     
                    <div class="col-sm-1">
                            <label class="control-label required">200-239 ml/dl</label>
                    </div>

                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn14" 
                                     id="rdBtn14" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn14" 
                                     id="rdBtn14" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label>(*) Consejer&iacute;a en alimentaci&oacute;n saludable y actividad f&iacute;sica</label>
                    </div>
                </div>   
                <div class="form-group">     
                    <div class="col-sm-1">
                        <label class="control-label required">>= 240 mg/dl</label>
                    </div>

                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn15" 
                                     id="rdBtn15" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn15" 
                                     id="rdBtn15" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <label>(*) Referir a confirmaci&oacute;n diagn&oacute;stica</label>
                    </div>
                </div>
                
                <!-- j. Mujeres de 50 años (cáncer de mama) -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="control-label required">
                            j. Mujeres de 50 años (c&aacute;ncer de mama)</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1">
                        Mamograf&iacute;a
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="bo_mamografia_realizada" 
                                     id="bo_mamografia_realizada" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="bo_mamografia_realizada" 
                                     id="bo_mamografia_realizada" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="radio">
                            <label class="control-label required">
                            Mamograf&iacute;a vigente</label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                              <input type="radio" name="bo_mamografia_vigente" 
                                     id="bo_mamografia_vigente" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="bo_mamografia_vigente" 
                                     id="bo_mamografia_vigente" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="bo_mamografia_toma">Toma Mamograf&iacute;a
                            </label>
                        </div>
                    </div>
                </div>    
                <div class="form-group">    
                    <div class="col-sm-6">
                        Mamograf&iacute;a a otras edades
                    </div>
                </div>
                
                
            <!-- Observaciones -->    
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Observaciones</label>
                        <textarea class="form-control" rows="3" id="gl_observaciones_empa" nombre="gl_observaciones_empa"
                            placeholder="Ingrese Observaciones" style="resize: none"></textarea>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkDeriva"><strong>Deriva</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkReconoce"><strong>Reconoce</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-12" hidden="hidden">
                        <!-- Si Deriva, muestra listado de especialidades a las que puede derivar -->
                    </div>
                </div>
                
                <div class="form-group text-right">
                    <button type="button" id="guardar" class="btn btn-success">
                        <i class="fa fa-save"></i>  Guardar
                    </button>&nbsp;
                    <button type="button" id="cancelar"  class="btn btn-default" 
                            onclick="location.href='{$base_url}/Empa/index'">
                        <i class="fa fa-remove"></i>  Cancelar
                    </button>
                </div>
            </div>
        </div> 
</section>
                
</form>