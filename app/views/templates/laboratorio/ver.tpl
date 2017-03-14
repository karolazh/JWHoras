<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{$static}/template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>


<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Detalle Examen</h1>
    <div class="col-md-12 text-right">
        <button type="button"
                href='javascript:void(0)' 
                onClick="habilitarNuevoExamen();" 
                data-toggle="tooltip" 
                title="Nuevo Examen"
                class="btn btn-sm btn-flat btn-success">
			<i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Examen
        </button>&nbsp;
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

<section class="content">    
    <div class="panel panel-primary">
        <div class="panel-heading">
                Datos del Paciente
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel-body">
            <!-- DATOS DE REGISTRO -->
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
            <!-- FIN DATOS DE REGISTRO -->
            
            <div class="top-spaced"></div>
                
            <!-- EXÁMENES -->
            <div class="box-body">
                <div class="col-md-12">
                    <div class="form-group">
                        {include file='laboratorio/grillaExamenesLaboratorio.tpl'}
                    </div>
                </div>
            </div>
            <!-- FIN EXÁMENES -->
        </div>

        <div class="top-spaced"></div>
        
    </div>

    <div class="top-spaced"></div>
    
    <div id="seccionExamen" style="display:none">
        <!-- DATOS DEL EXAMEN -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos del Examen
            </div>
            {include file='laboratorio/datosExamen.tpl'}
            
            <div class="top-spaced"></div>
        </div>
        <!-- FIN DATOS DEL EXAMEN -->
    </div>
            
    <div id="seccionNuevoExamen" style="display:none">
        <!-- DATOS DEL EXAMEN -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Nuevo Examen
            </div>
            {include file='laboratorio/nuevoExamen.tpl'}
            
            <div class="top-spaced"></div>
        </div>
        <!-- FIN DATOS DEL EXAMEN -->
    </div>
</section>
                    
<script type="text/javascript">
    function habilitarExamen() {
        $('#seccionExamen').toggle();
    }
    
    function deshabilitarExamen() {
        $('#seccionExamen').toggle();
    }
    
    function habilitarNuevoExamen() {
        $('#seccionNuevoExamen').toggle();
    }
    
    function deshabilitarNuevoExamen() {
        $('#seccionNuevoExamen').toggle();
    }
</script>