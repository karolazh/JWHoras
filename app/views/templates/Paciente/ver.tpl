<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<form id="form">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos de Seguimiento {$botonAyudaSeguimiento}
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                    <label class="control-label required">Registrado por : </label>
                            </div>
                            <div class="col-md-8">
                                    <input type="text"  value="{$nombre_registrador}" class="form-control" readonly>
                            </div>

                    </div>
                    <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                    <label class="control-label required">Estado : </label>
                            </div>
                            <div class="col-md-8">
                                    <input type="text" value="{$estado_caso}" class="form-control"  readonly>
                            </div>
                    </div>
                </div>
                            
                <div class="col-md-12">
                    <div class="clearfix col-md-6">
                            <div class="col-md-4">
                                    <label class="control-label required">Institución : </label>
                            </div>
                            <div class="col-md-8">
                                    <input type="text"value="{$institucion}" class="form-control"  readonly>
                            </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="clearfix col-md-3">
                            <div class="checkbox">
                                    <label>
                                            <input type="checkbox" id="chkReconoce" {if $reconoce}checked="checked"{/if} disabled="disabled">
                                            <strong>Reconoce maltrato</strong>
                                    </label>
                            </div>
                    </div>
                    <div class="clearfix col-md-3">
                            <div class="checkbox">
                                    <label>
                                            <input type="checkbox" id="chkAcepta" {if $acepta}checked="checked"{/if} disabled="disabled">
                                            <strong>Acepta Programa</strong>


                                    </label>
                            </div>
                    </div>
                    <div class="clearfix col-md-3">
                            {if $ruta_consentimiento != ""}
                                    <a class="btn btn-sm btn-primary" id="btnDescarga" href = '{$smarty.const.DIR_BASE}{$ruta_consentimiento}' target="_blank"><i class="fa fa-download"></i>Descargar Consentimiento</a>
                            {/if}
                    </div>
                    <div class="clearfix col-md-3">
                        <div class="top-spaced"></div>
                    </div>
                </div>
                    
                <div class="col-md-12">
                    <div class="top-spaced"></div>
                </div>
				
                <!-- EXÁMENES ALTERADOS -->
                {if $muestra_examenes == "SI"}
                    {include file='bitacora/grillaExamenesAlterados.tpl'}
                {/if}
                <!-- FIN EXÁMENES ALTERADOS -->
                
                <!-- MOTIVOS DE CONSULTA -->
                {include file='bitacora/grillaConsultas.tpl'}
                <!-- FIN MOTIVOS DE CONSULTA -->
                            
                <!-- DIRECCIONES -->
                {if $muestra_direcciones == "SI"}
                    {include file='bitacora/grillaDirecciones.tpl'}
                {/if}
                
            </div>
        </div>
                
        <div class="top-spaced"></div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos del Paciente {$botonAyudaPaciente}
            </div>
            <div class="panel-body">
				{if $extranjero }
					<div class="col-md-12">
						<div class="clearfix col-md-6">
							<div class="col-md-4">
								<label class="control-label required">Pasaporte Paciente :</label>
							</div>
							<div class="col-md-8">
								<input type="text" value="{$run_pass}" class="form-control" readonly>
							</div>

						</div>
						<div class="clearfix col-md-6">
							<div class="col-md-6">
								<a href="">Descargar documento identificación extranjero</a>
							</div>
						</div>
					</div>
				{else}
					<div class="col-md-12">
						<div class="clearfix col-md-6">
							<div class="col-md-4">
								<label class="control-label required">Rut Paciente : </label>
							</div>
							<div class="col-md-8">
								<input type="text"  value="{$rut}" class="form-control" readonly>
							</div>
						</div>
						<div class="clearfix col-md-6">
							<div class="col-md-4">
								<label class="control-label required">Previsión : </label>
							</div>
							<div class="col-md-8">
								<input type="text"  value="{$prevision}" class="form-control" readonly>
							</div>
						</div>
					</div>
				{/if}
				<div class="col-md-12">
					<div class="clearfix col-md-6">
						<div class="col-md-4">
							<label class="control-label required">Nombres : </label>
						</div>
						<div class="col-md-8">
							<input type="text"  value="{$nombres}" class="form-control" readonly>
						</div>
					</div>
					<div class="clearfix col-md-6">
						<div class="col-md-4">
							<label class="control-label required">Apellidos : </label>
						</div>
						<div class="col-md-8">
							<input type="text"  value="{$apellidos}" class="form-control" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="clearfix col-md-6">
						<div class="col-md-4">
							<label class="control-label required">Fecha Nacimiento : </label>
						</div>
						<div class="col-md-8">
							<input type="text"  value="{$fecha_nacimiento}" class="form-control" readonly>
						</div>
					</div>
					<div class="clearfix col-md-6">
						<div class="col-md-4">
							<label class="control-label required">Edad : </label>
						</div>
						<div class="col-md-8">
							<input type="text"  value="{$edad}" class="form-control" readonly>
						</div>
					</div>
				</div>
            </div>
                                                
            <div class="top-spaced"></div>
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos de Contacto {$botonAyudaContacto}
            </div>
            <div class="box-body">

                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">Direcci&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$gl_direccion}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">Comuna : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$gl_nombre_comuna}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">Provincia : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$gl_nombre_provincia}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">Regi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$gl_nombre_region}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">Teléfono : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$fono}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">¿Teléfono Seguro? </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{if $bo_fono_seguro==1}SI{else}NO{/if}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">Celular : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$celular}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label required">E-mail : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$email}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-sm-6 col-md-12">
                        <div id="map" data-editable="0" style="width:100%;height:300px;"></div>
                            <div class="col-sm-3">
                                <input type="text" name="gl_latitud" id="gl_latitud" value="{$latitud}" placeholder="latitud" class="form-control hidden"/>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="gl_longitud"  id="gl_longitud" value="{$longitud}" placeholder="Longitud" class="form-control hidden"/>
                            </div>					
                    </div>

                </div>
                            
            </div>

            <div class="top-spaced"></div>
            
        </div>
        
    </section>

</form>