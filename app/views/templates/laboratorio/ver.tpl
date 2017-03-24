<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden" />
<input type="text" value="{$id_centro_salud}" id="id_centro_salud" name="id_centro_salud" class="hidden" />
<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Detalle Examen</h1>
    <div class="col-md-12 text-right">
        {if $perfil == "1" or $perfil == "2" or $perfil == "3"}
        <button type="button"
                href='javascript:void(0)' 
                onClick="xModal.open('{$smarty.const.BASE_URI}/Agenda/agendar/{$id_paciente}//{$id_centro_salud}/', 'Agenda Registro registro número : {$id_paciente}', 85);" 
                data-toggle="tooltip" 
                title="Nuevo Examen"
                class="btn btn-sm btn-flat btn-success">
			<i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Examen
        </button>&nbsp;
        {/if}
        <button type="button"
                href='javascript:void(0)' 
                onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$id_paciente}', 'Registro número : {$id_paciente}', 85);" 
                data-toggle="tooltip" 
                title="Bitácora"
                class="btn btn-sm btn-flat btn-primary">
			<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Bitácora
        </button>
        <button type="button"
                href='javascript:void(0)' 
                onclick="history.back(-1)"
                data-toggle="tooltip" 
                title="Bitácora"
                class="btn btn-sm btn-flat btn btn-default">
			<i class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Volver
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
                    <div class="form-group" id="grilla-examenes">
                        {include file='laboratorio/grillaExamenesLaboratorio.tpl'}
                    </div>
                </div>
            </div>
            <!-- FIN EXÁMENES -->
        </div>

        <div class="top-spaced"></div>
        
    </div>

    <div class="top-spaced"></div>
    
</section>