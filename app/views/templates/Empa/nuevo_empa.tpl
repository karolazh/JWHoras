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

<form id="form">

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Examen de medicina preventiva de las personas de 15 años o m&aacute;s</h3>
            </div>
            
            <!-- Cabecera EMPA -->
            <div class="form-group">
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="region" class="control-label required">Región (*)</label>
                        <input type="text" name="region" id="fecha" value=""
                               placeholder="Región" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="comuna" class="control-label required">Comuna (*)</label>
                        <input type="text" name="comuna" id="rut" value="" 
                               placeholder="Comuna" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="centro" class="control-label required">Centro de Salud (*)</label>
                        <input type="text" name="centro" id="fecha" value=""
                               placeholder="Intitución" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="sector" class="control-label required">Sector (*)</label>
                        <input type="text" name="sector" id="rut" value="" 
                               placeholder="Sector" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <label for="nroficha" class="control-label required">N° de Ficha (*)</label>
                        <input type="text" name="nroficha" id="rut" value="" 
                               placeholder="N° de Ficha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label for="fecha" class="control-label required">Fecha (*)</label>
                        <input type="text" name="fecha" id="rut" value="" 
                               placeholder="Fecha" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label class="control-label required">Nro. DAU</label><br>
                        {$id_dau}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Datos del Paciente</h3>
            </div>
            
            <!-- Datos del Paciente -->
            <div class="form-group">
                <div class="form-group col-md-6">
                    <div class="form-group col-md-3">
                        <label class="control-label required">Rut Paciente</label><br>
                        {$rut} 1-9
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Nombres</label><br>
                        {$nombres} Nombre Paciente
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Apellidos</label><br>
                        {$apellidos} Apellidos Paciente
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">Fecha Nacimiento</label><br>
                        {$fecnacimiento} dd/mm/aaaa
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">Edad</label><br>
                        {$edad} XX
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <label class="control-label required">G&eacute;nero</label><br>
                        {$genero} Genero
                    </div>
                </div>
                    
                <div class="form-group col-md-12">
                    <div class="form-group col-md-12">
                        <label class="control-label required">Direcci&oacute;n</label><br>
                        {$direccion} Dirección
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group col-md-3">
                        <label class="control-label required">Fono</label><br>
                        {$fono} 9900000000
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label class="control-label required">Celular</label><br>
                        {$celular} +56900000000
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <label class="control-label required">E-mail</label><br>
                        {$email} E-mail
                    </div>
                    
                    {*<div class="form-group clearfix col-md-12 text-right">
                        <button type="button" id="ingresar" class="btn btn-success"
                            onclick="location.href='{$base_url}/Dau/nuevaDau'">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;Ver Ficha Paciente
                        </button>
                    </div>*}
                </div>
                
            </div>
        </div>
    </div>    
</section>
                
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h3 class="box-title">Examen</h3>
            </div>
            
            <!-- Examen -->
            <div class="form-group">
                <!-- a. Beber problema -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">a. Beber Problema</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                                ¿Consume bebidas alcoh&oacute;licas?</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn1" 
                                     id="rdBtn1" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn1" 
                                     id="rdBtn1" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        AUDIT
                        <label>
                            <input type="text" name="txtPuntos" id="txtPuntos" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        puntos
                    </div>
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                <strong>(*) Consejer&iacute;a seg&uacute;n tipo de consumo</strong></label>
                        </div>
                    </div>
                </div>
                
                <!-- b. Tabaquismo -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">b. Tabaquismo</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            ¿Usted fuma?</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn2" 
                                     id="rdBtn2" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn2" 
                                     id="rdBtn2" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                <strong>(*) Consejer]&iacute;a breve</strong></label>
                        </div>
                    </div>
                </div>
                
                <!-- c. Obesidad -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">c. Obesidad</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        PESO
                        <label>
                            <input type="text" name="txtPeso" id="txtPeso" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        Kg
                    </div>
                    <div class="form-group clearfix col-md-3">
                        TALLA
                        <label>
                            <input type="text" name="txtTalla" id="txtTalla" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        Kg
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        IMC
                        <label>
                            <input type="text" name="txtIMC" id="txtIMC" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            25-29 Sobrepeso</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn3" 
                                     id="rdBtn3" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn3" 
                                     id="rdBtn3" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            >= 30 Obesidad</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn4" 
                                     id="rdBtn4" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn4" 
                                     id="rdBtn4" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                Circunferencia abdominal (Punto medio entre margen inferior de 
                                la &uacute;ltima costilla y la cresta iliaca)</label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            Mujer >= 88 cm.</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn5" 
                                     id="rdBtn5" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn5" 
                                     id="rdBtn5" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            >= 30 Obesidad</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn6" 
                                     id="rdBtn6" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn6" 
                                     id="rdBtn6" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                <strong>(*) Consejería en alimentación y actividad física</strong></label>
                        </div>
                    </div>
                </div>
                
                <!-- d. Hipertensión -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">d. Hipertensi&oacute;n</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        PAS
                        <label>
                            <input type="text" name="txtPas" id="txtPas" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm Hg
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            >= 140 mm Hg</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
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
                    
                    <div class="form-group clearfix col-md-6">
                        PAD
                        <label>
                            <input type="text" name="txtPad" id="txtPad" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm Hg
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            >= 90 mm Hg</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
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
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                <strong>(*) Referir a perfil de presi&oacute;n arterial</strong></label>
                        </div>
                    </div>
                </div>
                
                <!-- e. Diabetes Mellitus (DM) -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">e. Diabetes Mellitus (DM)</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-12">
                        <label>Mayor de 40 años, obeso o antecedente de DM en padre o hermanos</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        Glisemia en ayunas
                        <label>
                            <input type="text" name="txtPas" id="txtPas" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm/dl
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            100-125 ml/dl</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
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
                    
                    <div class="form-group clearfix col-md-12">
                        <label>(*) Consejer&iacute;a alimentaci&oacute;n y A. Fca</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        &nbsp;
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            >= 126 mg/dl</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
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
                    
                    <div class="form-group clearfix col-md-12">
                        <label>(*) Referir a confirmaci&oacute;n diagn&oacute;stica</label>
                    </div>
                </div>
                
                <!-- e. Sífilis -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">e. S&iacute;filis</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <div class="radio">
                            <label class="control-label required">
                            Hombres que tienen sexo con otros hombres</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn11" 
                                     id="rdBtn11" value="1">
                              VDRL
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn11" 
                                     id="rdBtn11" value="2">
                              RPR
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <div class="radio">
                            <label class="control-label required">
                                Trabajadores sexuales y personas en centros de reclusi&oacute;n</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-6">
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
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                <strong>(*) Referir a programa ITS</strong></label>
                        </div>
                    </div>
                </div>
                
                <!-- g. Tuberculósis -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">g. Tubercul&oacute;sis</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        <div class="radio">
                            <label class="control-label required">
                                ¿Ha tenido tos productiva por m&aacute;s de 15 d&iacute;as?</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn13" 
                                     id="rdBtn13" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn13" 
                                     id="rdBtn13" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkBaciloscopia">Baciloscop&iacute;a
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12" hidden="hidden">
                        <!-- Si toma Baciloscopía, muestra indicaciones y resultado -->
                    </div>
                    
                    <div class="form-group clearfix col-md-12">
                        <div class="radio">
                            <label class="control-label required">
                                <strong>(1ra muestra de inmediato y entrega de una caja para muestra
                                         del d&iacute;a siguiente al despertar)</strong></label>
                        </div>
                    </div>
                </div>
                
                <!-- h. Mujeres de 25 a 64 años -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">
                            h. Mujeres de 25 a 64 años (c&aacute;ncer cervico uterino)</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        Fecha &uacute;ltimo Papanicolau
                        <label>
                            <input type="text" name="txtFechaPap" id="txtFechaPap" 
                                   value="" placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            PAP Vigente</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn13" 
                                     id="rdBtn13" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn13" 
                                     id="rdBtn13" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkPap">Toma de PAP
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12" hidden="hidden">
                        <!-- Si toma PAP muestra indicaciones y resultado -->
                    </div>
                </div>
                
                <!-- i. Personas de 40 años y más -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">i. Personas de 40 años y m&aacute;s (dislipidemia)</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        Colesterol total
                        <label>
                            <input type="text" name="txtPas" id="rut" value="" 
                                   placeholder="" class="form-control"/>
                            <span class="help-block hidden"></span>
                        </label>
                        mm/dl
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            200-239 ml/dl</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
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
                    
                    <div class="form-group clearfix col-md-12">
                        <label>(*) Consejer&iacute;a en alimentaci&oacute;n saludable y actividad f&iacute;sica</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        &nbsp;
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            >= 240 mg/dl</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
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
                    
                    <div class="form-group clearfix col-md-12">
                        <label>(*) Referir a confirmaci&oacute;n diagn&oacute;stica</label>
                    </div>
                </div>
                
                <!-- j. Mujeres de 50 años (cáncer de mama) -->
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label class="control-label required">
                            j. Mujeres de 50 años (c&aacute;ncer de mama)</label>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        Mamograf&iacute;a
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label class="control-label required">
                            Mamograf&iacute;a vigente</label>
                        </div>
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="radio">
                            <label>
                              <input type="radio" name="rdBtn13" 
                                     id="rdBtn13" value="1">
                              NO
                            </label>
                            &nbsp;&nbsp;
                            <label>
                              <input type="radio" name="rdBtn13" 
                                     id="rdBtn13" value="2">
                              SI
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkMam1">Toma Mamograf&iacute;a
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12" hidden="hidden">
                        <!-- Si toma PAP muestra indicaciones y resultado -->
                    </div>
                    
                    <div class="form-group clearfix col-md-6">
                        Mamograf&iacute;a a otras edades
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        &nbsp;
                    </div>

                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkMam1">Toma Mamograf&iacute;a
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12" hidden="hidden">
                        <!-- Si toma PAP muestra indicaciones y resultado -->
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-12">
                        <label>Observaciones</label>
                        <textarea class="form-control" rows="3" id="observaciones"
                            placeholder="Ingrese motivo de consulta">
                        </textarea>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-6">
                        <label for="nombreresp" class="control-label required">Nombre responsable (*)</label>
                        <input type="text" name="nombreresp" id="fecha" value=""
                               placeholder="Nombre Responsable" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>

                    <div class="form-group clearfix col-md-6">
                        <label for="rutresp" class="control-label required">Rut Responsable (*)</label>
                        <input type="text" name="rutresp" id="rut" value="" 
                               placeholder="Rut Responsable" class="form-control"/>
                        <span class="help-block hidden"></span>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkDeriva"><strong>Deriva</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chkReconoce"><strong>Reconoce</strong>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group clearfix col-md-12" hidden="hidden">
                        <!-- Si Deriva, muestra listado de especialidades a las que puede derivar -->
                    </div>
                </div>
                
                <div class="form-group clearfix col-md-12 text-right">
                    <button type="button" id="guardar" class="btn btn-success">
                        <i class="fa fa-save"></i>  Guardar
                    </button>&nbsp;
                    <button type="button" id="cancelar"  class="btn btn-default" 
                            onclick="location.href='{$base_url}/Empa/index'">
                        <i class="fa fa-remove"></i>  Cancelar
                    </button>
                    <br/><br/>
                </div>
            </div>

        </div>
    </div>    
</section>
                
</form>