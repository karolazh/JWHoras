<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href='{$static}template/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='{$static}template/plugins/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<section class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">
           Horas Agendadas
        </div>
        
        <div class="panel-body">
            
            <!-- HORAS ESPECIALISTA -->
            <div class="form-group">
                {include file='agenda/grillaHoraEspecialista.tpl'}
            </div>
            <!-- FIN HORA ESPECIALISTA -->
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