<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="{$static}template/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="{$static}template/plugins/fullcalendar/locale/es.js"></script>
<link href='{$static}template/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='{$static}template/plugins/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='{$static}template/plugins/fullcalendar/lib/moment.min.js'></script>

<section class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Datos del Paciente
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel-body">
            {include file='bitacora/datosPaciente.tpl'}
            
            <!-- HORAS ESPECIALISTAS -->
            <div class="form-group">
                <div class="box-body">
                    <div id="div_tabla" class="table-responsive small col-lg-12">
                        <label class="control-label"><h5>Horas con Especialistas</h5></label>
                    </div>
                </div>
                {include file='agenda/grillaHoraEspecialista.tpl'}
            </div>
            <!-- FIN HORAS ESPECIALISTAS -->
        </div>

        <div class="top-spaced"></div>
        
    </div>

    <div class="top-spaced"></div>
    
    <div class="panel panel-primary">
        <input type="text" value="{$arrAgenda}" id="arrAgenda" name="arrAgenda" class="hidden" />
        <div class="panel-heading">
            Calendario
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel-body">
            <div id='calendarEspecialista'></div>
        </div>

        <div class="top-spaced"></div>
        
    </div>
</section>