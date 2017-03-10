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
				
                <!-- EXÁMENES ALTERADOS -->
                {if $muestra_examenes == "SI"}
                    <div class="form-group">
                        <div id="div_tabla" class="table-responsive small col-lg-12">
                            <label class="control-label"><h5>Ex&aacute;menes Alterados</h5></label>
                            <br>
                            {*<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">*}
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th align="center" width="5%">Fecha</th>
                                        <th align="center" width="">Examen</th>
                                        <th align="center" width="">Laboratorio</th>
                                        <th align="center" width="10%">Resultado</th>                        
                                    </tr>
                                </thead>
                                <tbody>
                                {foreach $arrExamenes as $exa}
                                    <tr>
                                        <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->fc_crea}</td>
                                        <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->gl_nombre_examen}</td>
                                        <td style="color:#ff0000; background: #F7D3D2; font-weight: bold;">{$exa->gl_nombre_laboratorio}</td>
                                        <td style="background: #F7D3D2;"align="center">
                                            <h6><b><span class="label label-danger" style="color:#ffffff">ALTERADO</span></b></h6>
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                            <div class="top-spaced"></div>
                        </div>
                    </div>
                {/if}
                <!-- FIN EXÁMENES ALTERADOS -->
                
                <!-- MOTIVOS DE CONSULTA -->
                <div id="div_tabla" class="table-responsive small col-lg-12">
                    <label class="control-label"><h5>Atenciones de Urgencia</h5></label>
                    <br>
                    {*<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">*}
                    <table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
                        <thead>
                            <tr role="row">
                                <th align="center" width="10%">Fecha Ing</th>
                                <th align="center" width="10%">Hora Ing</th>
                                <th align="center" width="30%">Motivo Consulta</th>
                                <th align="center" width="30%">Instituci&oacute;n</th>
                                <th align="center" width="20%">Funcionario</th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $arrMotivosConsulta as $item}
                            <tr>
                                <td>{$item->fc_ingreso}</td>
                                <td>{$item->gl_hora_ingreso}</td>
                                <td>{$item->gl_motivo_consulta}</td>
                                <td>{$item->gl_nombre_establecimiento}</td>
                                <td>{$item->funcionario}</td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                    <div class="top-spaced"></div>
                </div>
                <!-- FIN MOTIVOS DE CONSULTA -->
                
                            
                <!-- DIRECCIONES -->
                {if $muestra_direcciones == "SI"}
                    <div class="form-group">
                        <div id="div_tabla" class="table-responsive small col-lg-12">
                            <br>
                            <label class="control-label"><h5>Historial de Direcciones</h5></label>
                            <br>
                            {*<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  table-middle dataTable no-footer">*}
                            <table id="tablaPrincipal" class="table table-hover table-striped table-bordered dataTable no-footer">
                                <thead>
                                    <th align="center" width="10%">Fecha</th>
                                    <th align="center" width="20%">Direcci&oacute;n</th>
                                    <th align="center" width="20%">Comuna</th>
                                    <th align="center" width="20%">Regi&oacute;n</th>
                                    <th align="center" width="10%">Estado</th>
                                    <th align="center" width="20%">Funcionario</th>
                                </thead>
                                <tbody>
                                {foreach $arrDirecciones as $dir}
                                    <tr>
                                        <td>{$dir->fc_crea}</td>
                                        <td>{$dir->gl_direccion}</td>
                                        <td>{$dir->gl_nombre_comuna}</td>
                                        <td>{$dir->gl_nombre_region}</td>
                                        <td align="center">
                                            {if $dir->bo_estado == 1}
                                                <h6><b><span class="label label-success small">VIGENTE</span></b></h6>                            
                                            {else}
                                                <h6><b><span class="label label-danger small">NO VIGENTE</span></b></h6>
                                            {/if}
                                        </td>
                                        <td>{$dir->funcionario}</td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>            
                        </div>
                    </div>
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
                            <label class="control-label required">Fono : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text"  value="{$fono}" class="form-control" readonly>
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