<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href='{$static}template/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='{$static}template/plugins/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<section class="content-header">
    <h1><i class="fa fa-cogs"></i> Seguimiento</h1>
    {*<div class="col-md-12 text-right">
	<button type="button"
	href='javascript:void(0)' 
	onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$id_paciente}', 'Registro número : {$id_paciente}', 85);" 
	data-toggle="tooltip" 
	data-title="Bitácora"
	class="btn btn-sm btn-flat btn-primary">
	<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Bitácora
	</button>
    </div>
    <br/><br/>*}
</section>

<form id="form" class="form-horizontal">
	<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
    <input type="text" value="{$bo_finalizado}" id="bo_finalizado" name="bo_finalizado" class="hidden">
    <input type="text" value="{$id_centro_salud}" id="id_centro_salud" name="id_centro_salud" class="hidden">
    <input type="text" value="1" id="seguimiento" name="seguimiento" class="hidden">
    <section class="content">



		<!-- Datos del Paciente -->
        <div class="panel panel-primary">
            <div class="panel-heading">Datos del Paciente</div>

            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-3 ">RUT/RUN/Pasaporte</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_rut}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Nombres</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_nombres}</span>
                    </div>
                    <label class="control-label col-sm-1">Apellidos</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_apellidos}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Fecha Nacimiento</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$fc_nacimiento}</span>
                    </div>
                    <label class="control-label col-sm-1">Edad</label>
                    <div class="col-md-3 col-sm-3">
						<input type="text" class="form-control" name="nr_edad" id="nr_edad" value="{$edad}" readonly/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">G&eacute;nero</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>Femenino</span>
                    </div>   
                    <label class="control-label col-sm-1">E-mail</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_email}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Fono</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_fono}</span>
                    </div>
                    <label class="control-label col-sm-1">Celular</label>
                    <div class="col-md-3 col-sm-3">
						<span class="form-control" readonly>{$gl_celular}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Direcci&oacute;n</label>
                    <div class="col-md-7 col-sm-3">
						<span class="form-control" readonly>{$gl_direccion}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-spaced"></div>
		
		<!-- Alarmas -->
        <div class="panel panel-primary">
            <div class="panel-heading">Alarmas</div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-condensed table-hover table-bordered dataTable paginada" id="tabla-pap-alterado">
						<thead>
							<tr>
								<th>Tipo de Alarma</th>
								<th>Perfil</th>
								<th>Estado Alarma</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							{foreach $alarmas as $item}
								<tr>
									<td class="text-center">{$item->gl_tipo_alarma}</td>
									<td class="text-center">{$item->gl_nombre_perfil}</td>
									<td class="text-center">{$item->gl_estado_alarma}</td>
									<td class="text-center">
										<button type="button" 
												onClick="" 
												data-toggle="tooltip" 
												class="btn btn-xs btn-danger"
												data-title="Apagar Alarma">
											<i class="fa fa-bullhorn"></i>
										</button>
									</td>    
								</tr>
							{/foreach}
					</table>
				</div>
            </div>
        </div>
					
        <div class="top-spaced"></div>

				<!-- Agenda Especialista -->
		<div class="panel panel-primary">
			<div class="panel-heading">Agenda Paciente</div>
			<div class="panel-body">
			<div class="row">

				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#agendaespecialistas" aria-controls="agendaespecialistas" role="tab" data-toggle="tab">Agenda Especialista</a>
						</li>
						<li role="presentation">
							<a href="#agendaexamenes" aria-controls="agendaexamenes" role="tab" data-toggle="tab">Agenda Exámenes</a>
						</li>
						<li role="presentation">
							<a href="#mapa" aria-controls="mapa" role="tab" data-toggle="tab">Mapa</a>
						</li>
					</ul>
					
					
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="agendaespecialistas">

							<div class="col-xs-12">
								<legend>Agenda Especialista</legend>
								<div class="row">
									<div class="form-group">
										{include file='agenda/grillaHoraEspecialista.tpl'}
									</div>

									<div class="form-group">
										<input type="text" value="{$arrAgenda}" id="arrAgenda" name="arrAgenda" class="hidden" />
										<div class="panel-heading">
											Calendario
										</div>
									</div>

									<div class="form-group">
										<div id='calendarEspecialista'></div>
									</div>
								</div>
							</div>
						</div>

						<div role="tabpanel" class="tab-pane" id="agendaexamenes">

							<div class="col-xs-12">
								<legend>Agenda Exámenes</legend>
								<div class="row">
									<div class="form-group">
										{include file='agenda/grillaExamenLaboratorio.tpl'}
									</div>

									<div class="form-group">
										<input type="text" value="{$arrAgendaExamenes}" id="arrAgendaExamenes" name="arrAgendaExamenes" class="hidden" />
										<div class="panel-heading">
											Calendario
										</div>
									</div>

									<div class="form-group">
										<div id='calendarExamenes'></div>
									</div>
								</div>
							</div>
						</div>

						<div role="tabpanel" class="tab-pane" id="mapa">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<div class="col-sm-6 col-md-12">
									<div id="map" data-editable="0" style="width:100%;height:300px;"></div>
									<div class="col-sm-3">
										<input type="text" name="gl_latitud" id="gl_latitud" value="{$latitud}" placeholder="latitud" class="form-control hidden"/>
									</div>
									<div class="col-sm-3">
										<input type="text" name="gl_longitud"  id="gl_longitud" value="{$longitud}" placeholder="Longitud" class="form-control hidden"/>
									</div>					
								</div>

							</div>
						</div>

					</div>		
							
							
				</div>
		</div>

	</section>
</form>