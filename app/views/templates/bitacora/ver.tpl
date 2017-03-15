<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content">
    <!-- DATOS DE REGISTRO -->
    <div class="panel panel-primary">
        <div class="panel-heading">
                Datos del Paciente {$botonAyudaPaciente}
        </div>

        <div class="panel-body">
            {include file='bitacora/datosPacienteBitacora.tpl'}
                    
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