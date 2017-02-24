<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<form id="form">
    <section class="content">
        <!-- DATOS DE REGISTRO -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                    Datos del Paciente
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
                            <input type="text" value="{$fecha_nac}" class="form-control" readonly>
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
                            <label class="control-label">G&eacute;nero : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$genero}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Estado Caso : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$estado}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Previsi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$prevision}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Grupo : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$grupo}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Direcci&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$direccion}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fono : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$fono}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Celular : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$celular}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">E-mail : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$email}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Comuna : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$comuna}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Provincia : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$provincia}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Regi&oacute;n : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$region}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Fecha Registro : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$fecha_reg}" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Reconoce: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$reconoce}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix col-md-6">
                        <div class="col-md-4">
                            <label class="control-label">Acepta Programa : </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{$acepta}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                        
                <!-- MOTIVOS DE CONSULTA -->
                <div class="form-group">
                    {include file='avanzados/grillaConsultas.tpl'}
                </div>
                  
            </div>
            
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel panel-primary">
            <div class="top-spaced"></div>
            
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#empa">EMPA</a></li>
                    <li><a data-toggle="tab" href="#examenes">EX&Aacute;MENES</a></li>
                    <li><a data-toggle="tab" href="#eventos">EVENTOS</a></li>
                    <li><a data-toggle="tab" href="#documentos">DOCUMENTOS</a></li>
                </ul>

                <div class="tab-content">
                    
                    <!-- EMPA  -->
                    <div id="empa" class="tab-pane fade in active">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaEmpa.tpl'}
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
                                    {include file='avanzados/grillaExamenes.tpl'}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- EVENTOS -->
                    <div id="eventos" class="tab-pane fade">
                        {*{include file='avanzados/agregarEvento.tpl'}*}
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaEventos.tpl'}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DOCUMENTOS -->
                    <div id="documentos" class="tab-pane fade">
                        {include file='avanzados/adjuntarArchivo.tpl'}
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {include file='avanzados/grillaAdjuntos.tpl'}
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
</form>

<script type="text/javascript">
    function habilitar() {
        $('#seccionComentario').toggle()
    }

    function habilitarAdjunto() {
        $('#seccionAdjunto').toggle()
    }
</script>