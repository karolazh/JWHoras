<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href='{$static}template/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='{$static}template/plugins/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<section class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">
           Ex&aacute;menes
        </div>
        
        <div class="panel-body">
            
            <!-- EXÁMENES -->
            <div class="form-group">
                {include file='agenda/grillaExamenLaboratorio.tpl'}
            </div>
            <!-- FIN EXÁMENES -->
        </div>

        <div class="top-spaced"></div>
        
    </div>

    <div class="top-spaced"></div>
    
    <div class="panel panel-primary">
        <input type="text" value="{$arrAgendaExamenes}" id="arrAgendaExamenes" name="arrAgendaExamenes" class="hidden" />
        <div class="panel-heading">
            Calendario
        </div>
        
        <div class="top-spaced"></div>
        
        <div class="panel-body">
            <div id='calendarExamenes'></div>
        </div>

        <div class="top-spaced"></div>
        
    </div>
</section>