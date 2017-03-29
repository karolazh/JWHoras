{*
<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
*}
{*
<section class="content-header">
    <h1><i class="fa fa-plus"></i> Plan de Tratamiento</h1>
	<ol class="breadcrumb">
		<li><a href="{$base_url}/Medico/">
				<i class="fa fa-folder-open"></i>&nbsp;Evaluación</a></li>
		<li class="active"> &nbsp;Plan de Tratamiento</li>
	</ol>
</section>
*}

<form id="formPlan" class="form-horizontal" enctype="multipart/form-data">

	<section class="content">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Plan de Tratamiento {$botonAyudaTratamiento}
				<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
			</div>
			<div class="panel-body">
				<div class="top-spaced"></div>

				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2 ">Observación (*)</label>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" rows="5" id="gl_observacion" name="gl_observacion"
							onblur="validarVacio(this, 'Por favor Ingrese una Observación')" 
							placeholder="Ingrese una Observación" style="resize: none"></textarea>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>
				
				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2 ">Profesional (*)</label>
					<div class="col-sm-4">
						<select for="region" class="form-control" id="id_tipo_especialidad" name="id_tipo_especialidad" onblur="validarVacio(this, 'Por favor Seleccione una Profesional')">
							<option value="0">Seleccione</option>
							{foreach $arrEspecialidad as $item}
								<option value="{$item->id_tipo_especialidad}" >{$item->gl_nombre_especialidad}</option>
							{/foreach}
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<div class="col-sm-1">
						<button type="button" id="verAgendaHipertension" class="btn btn-sm btn-success">
							<i class="fa fa-file-o"></i>Agenda
						</button>
					</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>
				
				<div class="form-group clearfix  text-right">
					<button type="button" id="guardarPlan" class="btn btn-success">
						<i class="fa fa-save"></i>  Guardar
					</button>
					<button type="button" id="guardarMotivo" class="btn btn-success" style="display: none">
						<i class="fa fa-save"></i>  Guardar
					</button>&nbsp;
					<button type="button" id="cancelar"  class="btn btn-default" 
							onclick="location.href = '{$base_url}/Medico/'">
						<i class="fa fa-remove"></i>  Cancelar
					</button>
					<br/><br/>
				</div>
			</div>
		</div>
	</section>
</form>



{if count($arr_plan) > 0}
<section class="content">
	<div class="panel panel-primary">
		<div class="panel-heading"> Agenda con Especialistas </div>
		<div class="panel-body">
			<div class="table-responsive col-lg-12" data-row="10">
				<table id="tablaPrincipal" class="table table-hover table-striped table-bordered  no-footer">
					<thead>
						<tr role="row">
							<th class="text-center" width="10%">Especialista</th>
							<th class="text-center" width="5%">Observación</th>
							<th class="text-center" width="25%">Fecha</th>
						</tr>
					</thead>
					<tbody>
						{foreach $arr_plan as $item}
							<tr>
								<td class="text-center" nowrap> {$item->gl_nombre_especialidad} </td>
								<td class="text-center" nowrap> {$item->gl_observacion} </td>
								<td class="text-center" nowrap> {$item->fc_crea} </td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>

	</div>  
</section>
{/if}