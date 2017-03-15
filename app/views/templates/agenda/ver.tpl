<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{$static}/template/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>

<section class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Datos del Paciente
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel-body">
            {include file='bitacora/datosPaciente.tpl'}
            
            <!-- EXÁMENES -->
            <div class="form-group">
                <div class="box-body">
                    <div id="div_tabla" class="table-responsive small col-lg-12">
                        <br><br>
                        <label class="control-label"><h5>Ex&aacute;menes</h5></label>
                    </div>
                </div>
                {include file='bitacora/grillaExamenes.tpl'}
            </div>
            <!-- FIN EXÁMENES -->
        </div>

        <div class="top-spaced"></div>
        
    </div>

    <div class="top-spaced"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Calendario
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel-body">
            <!-- CALENDARIO -->
        </div>

        <div class="top-spaced"></div>
        
    </div>
</section>