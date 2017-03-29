{* 
<script type="text/javascript" src="{$static}js/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="{$static}js/plugins/select2/i18n/es.js"></script>
<link rel="stylesheet" href="{$static}js/plugins/select2/select2.min.css" />
*}
	
<form id="formCambioUsuario">

	<input type="text" value="{$id_usuario}" id="id_usuario" name="id_usuario" class="hidden" readonly>
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"> <i class="fa fa-exchange"></i> Cambiar de Usuario </h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<div class="col-lg-3 col-xs-5">
					<label class="control-label">Seleccione un Usuario : </label>
				</div>
				<div class="col-lg-6 col-xs-8">
					<select id="id_usuario_cambio" name="id_usuario_cambio" class="select22" style="width: 450px;">
						{foreach $arr_data as $data}
							<option value="{$data->id_usuario}">{$data->gl_nombres} {$data->gl_apellidos} [{$data->gl_nombre_perfil}]</option>
						{/foreach}
					</select>
				</div>
			</div>
		</div>
		<div class="top-spaced"></div>

		<div class="form-group col-sm-12" align="right">
			<button type="button" id="btnCambioUsuario" class="btn btn-success">
				<i class="fa fa-exchange"></i> Aceptar
			</button>&nbsp;
			<button type="button" id="cancelar" class="btn btn-default" onclick="xModal.close()">
				<i class="fa fa-remove"></i> Cancelar
			</button>
		</div>
	</div>

</form>