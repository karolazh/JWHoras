<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$smarty.const.STATIC_FILES}template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1><i class="fa fa-book"></i>&nbsp; Buscar Paciente </h1>
    <br/><br/>
</section>

<section class="content">
	<div class="panel panel-primary">
		<div class="panel-heading">
			
		</div>
		<div class="panel-body">
		
			<form id="form" action="#" method="post" class="form-horizontal">
				<input type="text" name="bool_region" id="bool_region" value="{$bool_region}" class="hidden"/>
				<input type="text" name="reg" id="reg" value="{$reg}" class="hidden"/>
				<div class="form-group">
					<label for="rut" class="control-label col-sm-2">Rut</label>
					<div class="col-sm-3">
						<input type="text" name="rut" id="rut" value="{$rut}" maxlength="12"
							   onkeyup="formateaRut(this), this.value = this.value.toUpperCase()" onkeypress ="return soloNumerosYK(event)"
							   onblur="Valida_Rut(this)"
							   placeholder="Rut" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
					<label for="pasaporte" class="control-label col-sm-1">Pasaporte</label>
					<div class="col-sm-3">
						<input type="text" name="pasaporte" id="pasaporte" value="{$pasaporte}" 
							   placeholder="Pasaporte (Extranjero)" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="nombres" class="control-label col-sm-2">Nombres</label>
					<div class="col-sm-3">
						<input type="text" name="nombres" id="nombres" value="{$nombres}"
							   placeholder="Nombres" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
					<label for="apellidos" class="control-label col-sm-1">Apellidos</label>
					<div class="col-sm-3">
						<input type="text" name="apellidos" id="apellidos" value="{$apellidos}" 
							   placeholder="Apellidos" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="cod_fonasa" class="control-label col-sm-2">Código Fonasa</label>
					<div class="col-sm-3">
						<input type="text" name="cod_fonasa" id="cod_fonasa" value="{$cod_fonasa}"
							   placeholder="Código Fonasa" class="form-control"/>
						<span class="help-block hidden"></span>
					</div>
					<label for="centro_salud" class="control-label col-sm-1">Centro de Salud</label>
					<div class="col-sm-3">
						<select for="centro_salud" class="form-control" id="centro_salud" name="centro_salud">
						<option value="0">Seleccione un Centro de Salud</option>
						{foreach $arrCentroSalud as $item}
							<option value="{$item->id_centro_salud}" >{$item->gl_nombre_establecimiento}</option>
						{/foreach}
						</select>
						<span class="help-block hidden"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="region" class="control-label col-sm-2">Región</label>
					<div class="col-sm-3">
						<select for="region" class="form-control" id="region" name="region" onchange="Region.cargarComunasPorRegion(this.value, 'comuna')">
							<option value="0">Seleccione una Región</option>
							{foreach $arrRegiones as $item}
								<option value="{$item->id_region}" >{$item->gl_nombre_region}</option>
							{/foreach}
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>

					<label for="comuna" class="control-label col-sm-1">Comuna</label>
					<div class="col-sm-3">
						<select for="comuna" class="form-control" id="comuna" name="comuna">
							<option value="0">Seleccione una Comuna</option>
						</select>
						<span class="help-block hidden fa fa-warning"></span>
					</div>

					<div class="col-sm-1">
						<button type="submit" id="buscar" class="btn btn-info">
							<i class="fa fa-search"></i>  Buscar
						</button>
					</div>
				</div>
			
			</form>
		</div>
	</div>

	<div class="top-spaced"></div>

	{if $mostrar==1}
		<div class="panel panel-primary">
			<div class="panel-heading">
				Resultado de la Búsqueda
			</div>
			<div class="panel-body">
				{if isset($errorWS)}
					<div class="alert alert-danger">Hubo un problema al obtener los Soportes.<br> Favor intentar nuevamente o contactarse con Administrador.</div>
				{else}
					{include file='grilla/pacientes.tpl'}
				{/if}
			</div>
		</div>
	{/if}	
</section>