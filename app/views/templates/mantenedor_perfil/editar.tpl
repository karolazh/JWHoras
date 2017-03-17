<div class="modal-body">
	<div class="col-xs-12">
		<form id="form" class="form-horizontal">
			<input type="hidden" id="id_perfil" name="id_perfil" value="{$itm->id_perfil}" />

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Nombre </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_nombre" name="gl_nombre" value="{$itm->gl_nombre_perfil}" />
				</div>
			</div>

			{*}
			<div class="form-group top-spaced">
				<label for="nr_orden" class="col-xs-2 control-label clabel"> Orden </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="nr_orden" name="nr_orden" value="{$itm->nr_orden}" />
				</div>
			</div>{*}

			<div class="form-group top-spaced">
				<label for="gl_descripcion" class="col-xs-2 control-label clabel"> Descripción </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="gl_descripcion" name="gl_descripcion" value="{$itm->gl_descripcion}" />
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="bo_estado" class="col-xs-2 control-label clabel"> Estado </label>
				<div class="col-xs-3">
					<select id="bo_estado" name="bo_estado">
						<option value="0" {if $itm->bo_estado != 1} selected {/if} > Inactivo </option>
						<option value="1" {if $itm->bo_estado == 1} selected {/if} > Activo </option>
					</select>
				</div>
			</div>

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor_perfil.editarPerfil(this.form,this);">Guardar</button>
				</div>
			</div>

		</form>
	</div>
</div>