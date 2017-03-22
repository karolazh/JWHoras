<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-cogs"></i> Seguimiento</h1>
    {*<div class="col-md-12 text-right">
	<button type="button"
	href='javascript:void(0)' 
	onClick="xModal.open('{$smarty.const.BASE_URI}/Bitacora/ver/{$id_paciente}', 'Registro número : {$id_paciente}', 85);" 
	data-toggle="tooltip" 
	title="Bitácora"
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
                
            </div>
        </div>

        <div class="top-spaced"></div>

				<!-- Agenda Especialista -->
		<div class="panel panel-primary">
			<div class="panel-heading">Agenda Especialista</div>
			<div class="panel-body">


				<div class="form-group col-sm-11" align="right">
					<button type="button" id="guardar" class="btn btn-success">
						<i class="fa fa-save"></i>  Guardar
					</button>&nbsp;
					<button type="button" id="cancelar"  class="btn btn-default" 
							onclick="location.href = history.back()">
						<i class="fa fa-remove"></i>  Cancelar
					</button>
				</div>
			</div>
		</div>

	</section>
</form>