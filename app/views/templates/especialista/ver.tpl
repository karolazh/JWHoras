<form class="form-horizontal" name="form-agendar" id="form-agendar" method="post">
    <input type="text" value="{$id_paciente_examen}" id="id_paciente_examen" name="id_paciente_examen" class="hidden">
    <input type="text" value="{$id_tipo_examen}" id="id_tipo_examen" name="id_tipo_examen" class="hidden">
    <input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
    <input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
    <div class="panel-body">
		
        <!-- DATOS HORA AGENDADA -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Datos de Hora Agendada</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label required col-sm-3">Nombre Especialista</label>
                    <div class="col-sm-2">
                        <input type="text" value="{$gl_nombre_toma}" class="form-control" name="gl_nombre_toma" id="gl_nombre_toma" readonly/>
                    </div>
                    <label class="control-label required col-sm-2">Especialidad</label>
                    <div class="col-sm-2">
                        <input type="text" value="{$gl_nombre_especialidad}" class="form-control" name="gl_nombre_especialidad" id="gl_nombre_especialidad" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha_agendada" class="control-label col-sm-3">Fecha Agendada</label>
                    <div class='col-sm-2'>
                        <div class="input-group">
                            <input type='text' class="form-control datepicker"
                                   id='fecha_agendada' 
                                   name='fecha_agendada'
                                   value="{$fecha_agendada|date_format:"%d/%m/%Y"}" 
                                   readonly/>
                            <span class="help-block hidden fa fa-warning"></span>
                            <span class="input-group-addon"><i class="fa fa-calendar" onClick="$('#fecha_agendada').focus();"></i></span>
                        </div>
                    </div>
					<label for="hora_agendada" class="control-label col-sm-2">Hora Agendada</label>
					<div class="col-sm-2">
                        <input type="time" class="form-control col-sm-2"                                
                               name="hora_agendada" id="hora_agendada" value="{$hora_agendada}" readonly/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Observacion Especialista -->
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title">
                    <i class="fa fa-sticky-note"></i> Descripci&oacute;n</h3></div>
            <div class="box-body">
				<div class="form-group">
					<label class="control-label required col-sm-3">Observación</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control col-sm-6" rows="5" 
                                  id="gl_agenda_observacion" name="gl_agenda_observacion"
                                  placeholder="Observación en toma de examen" style="resize: none"
                                  readonly>{$gl_agenda_observacion}</textarea>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
        
		<!-- BOTONERA -->
		<div class="form-group col-sm-11" align="right">
			<button type="button" id="cancelar"  class="btn btn-default" 
					onclick="xModal.close()">
				<i class="fa fa-remove"></i>  Salir
			</button>
		</div>
    </div>
</form>