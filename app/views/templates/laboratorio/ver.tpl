<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden" />
<input type="text" value="{$id_centro_salud}" id="id_centro_salud" name="id_centro_salud" class="hidden" />
<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Detalle Examen</h1>
    <div class="col-md-12 text-right">
        {*{if $_SESSION['perfil'] == "1" or $_SESSION['perfil'] == "2" or $_SESSION['perfil'] == "3"}*}
        <button type="button"
                href='javascript:void(0)' 
                onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/nuevo/{$id_paciente}/{$id_centro_salud}', 'Agenda Registro número : {$id_paciente}', 85);" 
                data-toggle="tooltip" 
                title="Nuevo Examen"
                class="btn btn-sm btn-flat btn-success">
			<i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Examen
        </button>&nbsp;
        {*{/if}*}
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
            {include file='bitacora/datosPaciente.tpl'}
            
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
</script>