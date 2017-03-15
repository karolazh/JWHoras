<div class="modal-body">
	<div class="col-xs-12">
		<form class="form-horizontal">
			<input type="hidden" id="id_sistema" name="id_sistema" value="{$itm->id_sistema}" />

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Nombre </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_nombre" name="gl_nombre" value="{$itm->gl_nombre}" />
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_descripcion" class="col-xs-2 control-label clabel"> Descripción </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="gl_descripcion" name="gl_descripcion" value="{$itm->gl_descripcion}" />
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_ambiente" class="col-xs-2 control-label clabel"> Ambiente </label>
				<div class="col-xs-3">
					<select id="gl_ambiente" name="gl_ambiente">
						<option value="prod" {if $itm->gl_ambiente == "prod"} selected {/if} > Producción </option>
						<option value="dev" {if $itm->gl_ambiente == "dev"} selected {/if} > Desarrollo </option>
						<option value="test" {if $itm->gl_ambiente == "test"} selected {/if} > Test </option>
						<option value="qa" {if $itm->gl_ambiente == "qa"} selected {/if} > QA </option>
					</select>
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="sistema_wsdl" class="col-xs-2 control-label clabel"> WSDL </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="sistema_wsdl" name="sistema_wsdl" value="{$itm->sistema_wsdl}">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="sistema_url" class="col-xs-2 control-label clabel"> URL </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="sistema_url" name="sistema_url" value="{$itm->sistema_url}">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="key_public" class="col-xs-2 control-label clabel"> key Public </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="key_public" name="key_public" value="{$itm->key_public}">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="key_private" class="col-xs-2 control-label clabel"> key Private </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="key_private" name="key_private" value="{$itm->key_private}">
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
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor.editarWebServiceBD(this.form,this);">Guardar</button>
				</div>
			</div>

		</form>
	</div>
</div>