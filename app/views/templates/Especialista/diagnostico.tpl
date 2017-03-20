<link href="{$base_url}/template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$base_url}/template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-user-md"></i> Diagnóstico</h1>
	<ol class="breadcrumb">
		<li><a href="{$base_url}/Especialista/">
				<i class="fa fa-folder-open"></i>&nbsp;Especialista</a></li>
		<li class="active"> &nbsp;Diagnóstico</li>
	</ol>
</section>

<form id="form" class="form-horizontal" enctype="multipart/form-data">

	<section class="content">
		<div class="panel panel-primary">
			<div class="panel-heading">
				 {$botonAyudaTratamiento}
			</div>
				<input type="text" value="{$id_paciente}" id="id_paciente" name="id_paciente" class="hidden">
				<input type="text" value="{$id_empa}" id="id_empa" name="id_empa" class="hidden">
			<div class="panel-body">
				<div class="top-spaced"></div>
				
				<div class="form-group">
					<label for="cie10" class="control-label col-sm-2">CIE10 1(*)</label>
					<div class="col-sm-4">
						<select class="form-control" id="cie10" name="cie10">
							<option value="0">Seleccione CIE10</option>
							<option value="1">CIE10 L1</option>
							{*foreach $arrMes as $item}
								<option value="{$item->id_mes}" >{$item->gl_mes}</option>
							{/foreach*}
						</select>
					</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>
				
				<div class="form-group">
					<label for="cie102" class="control-label col-sm-2">CIE10 2(*)</label>
					<div class="col-sm-4">
						<select class="form-control" id="cie102" name="cie102">
							<option value="0">Seleccione CIE10</option>
							<option value="1">CIE10 L2</option>
							{*foreach $arrMes as $item}
								<option value="{$item->id_mes}" >{$item->gl_mes}</option>
							{/foreach*}
						</select>
					</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>
				
				<div class="form-group">
					<label for="cie103" class="control-label col-sm-2">CIE10 3(*)</label>
					<div class="col-sm-4">
						<select class="form-control" id="cie103" name="cie103">
							<option value="0">Seleccione CIE10</option>
							<option value="1">CIE10 L3</option>
							{*foreach $arrMes as $item}
								<option value="{$item->id_mes}" >{$item->gl_mes}</option>
							{/foreach*}
						</select>
					</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>

				<div class="form-group">
					<label for="gl_diagnostico" class="control-label col-sm-2 ">Diagnóstico (*)</label>
					<div class="col-sm-8">
						<textarea type="text" class="form-control" rows="5" id="gl_diagnostico" name="gl_diagnostico"
							onblur="validarVacio(this, 'Por favor Ingrese un Diagnóstico')" 
							placeholder="Ingrese un Diagnóstico" style="resize: none"></textarea>
						<span class="help-block hidden fa fa-warning"></span>
					</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>
				
				<div class="form-group">
					<label for="gl_observacion" class="control-label col-sm-2 ">Observación (*)</label>
						<div class="col-sm-8">
							<textarea type="text" class="form-control" rows="5" id="gl_observacion" name="gl_observacion"
								onblur="validarVacio(this, 'Por favor Ingrese una Observación')" 
								placeholder="Ingrese una Observación" style="resize: none"></textarea>
							<span class="help-block hidden fa fa-warning"></span>
						</div>
					<div class="col-sm-1"></div>
				</div>

				<div class="top-spaced"></div>
				
				<div class="form-group clearfix col-sm-10 text-right">
					<button type="button" id="guardar" class="btn btn-success">
						<i class="fa fa-save"></i>  Guardar
					</button>&nbsp;&nbsp; 
					<button type="button" id="reagendar" class="btn btn-warning">
						<i class="fa fa-calendar"></i>  Re Agendar
					</button>&nbsp;&nbsp;
					<button type="button" id="cancelar"  class="btn btn-default" 
							onclick="location.href = '{$base_url}/Especialista/'">
						<i class="fa fa-remove"></i>  Cancelar
					</button>
					<br/><br/>
				</div>
			</div>
		</div>
	</section>
</form>