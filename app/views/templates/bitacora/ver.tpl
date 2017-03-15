<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content">
    <!-- DATOS DE REGISTRO -->
    <div class="panel panel-primary">
        <div class="panel-heading">
                Datos del Paciente {$botonAyudaPaciente}
        </div>

        <div class="panel-body">

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">RUT/RUN/Pasaporte : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$run}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Nombres : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$nombres}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Fecha Nacimiento : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$fc_nacimiento}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Edad : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$edad}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Sexo : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_sexo}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Estado Caso : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_nombre_estado_caso}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Previsi&oacute;n : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_nombre_prevision}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Grupo : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_grupo_tipo}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Regi&oacute;n : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_nombre_region}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Comuna : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_nombre_comuna}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Direcci&oacute;n : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_direccion}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">E-mail : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_email}" class="form-control" readonly>
                    </div>
                </div>
			</div>
			
            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Teléfono : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_fono}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">¿Teléfono Seguro? </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{if $bo_fono_seguro==1}SI{else}NO{/if}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Celular : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$gl_celular}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Fecha Registro : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$fc_crea}" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Reconoce: </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$bo_reconoce}" class="form-control" readonly>
                    </div>
                </div>

                <div class="clearfix col-md-6">
                    <div class="col-md-4">
                        <label class="control-label">Acepta Programa : </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{$bo_acepta_programa}" class="form-control" readonly>
                    </div>
                </div>
            </div>
            
            <!-- EXÁMENES ALTERADOS -->
            {if $muestra_examenes == "SI"}
                <div class="form-group">
                    {include file='bitacora/grillaExamenesAlterados.tpl'}
                </div>
            {/if}
            <!-- FIN EXÁMENES ALTERADOS -->

            <!-- MOTIVOS DE CONSULTA -->
            <div class="form-group">
                {include file='bitacora/grillaConsultas.tpl'}
            </div>
			
            <!-- DIRECCIONES -->
            {if $muestra_direcciones == "SI"}
                <div class="form-group">
                    {include file='bitacora/grillaDirecciones.tpl'}
                </div>
            {/if}

        </div>

    </div>

    <div class="top-spaced"></div>

    <div class="panel panel-primary">
        <div class="top-spaced"></div>

        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#empa">EMPA</a></li>
			{if $bo_reconoce == 1}	
                <li><a data-toggle="tab" href="#agresor">DATOS DEL AGRESOR</a></li>
                <li><a data-toggle="tab" href="#violencia">CARACTERIZACIÓN DE VIOLENCIA</a></li>
			{/if}	
                <li><a data-toggle="tab" href="#examenes">EX&Aacute;MENES</a></li>
                <li><a data-toggle="tab" href="#plan">PLAN TRATAMIENTO</a></li>
                <li><a data-toggle="tab" href="#eventos">EVENTOS</a></li>
                <li><a data-toggle="tab" href="#documentos">DOCUMENTOS</a></li>
            </ul>

            <div class="tab-content">
                {*<div class="form-group">
                    {$muestra_direcciones}<br>
                </div>*}

                <!-- EMPA  -->
                <div id="empa" class="tab-pane fade in active">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {include file='bitacora/grillaEmpa.tpl'}
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
							
				 <!-- DATOS DEL AGRESOR  -->
                <div id="agresor" class="tab-pane fade">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {include file='bitacora/datosAgresor.tpl'}
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
							
				 <!-- DATOS DEL AGRESOR  -->
                <div id="violencia" class="tab-pane fade">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {include file='bitacora/caracterizacionViolencia.tpl'}
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <!-- EXÁMENES -->
                <div id="examenes" class="tab-pane fade">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {include file='bitacora/grillaExamenes.tpl'}
                            </div>
                        </div>
                    </div>
                </div>
				
                <!-- Plan Tratamiento -->
                <div id="plan" class="tab-pane fade">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {include file='bitacora/agregarPlan.tpl'}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EVENTOS -->
                <div id="eventos" class="tab-pane fade">
                    {*{include file='bitacora/agregarEvento.tpl'}*}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                {include file='bitacora/grillaEventos.tpl'}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DOCUMENTOS -->
                <div id="documentos" class="tab-pane fade">
                    {include file='bitacora/adjuntarArchivo.tpl'}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group" id="grilla-adjuntos">
                                {include file='bitacora/grillaAdjuntos.tpl'}
                            </div>
                        </div>
                    </div>
                </div>
                                
            </div>

            <div class="top-spaced"></div>
        </div>
    </div>

    <div class="top-spaced"></div>
</section>

<script type="text/javascript">
    function habilitar() {
        $('#seccionComentario').toggle()
    }

    function habilitarAdjunto() {
        $('#seccionAdjunto').toggle()
    }
</script>