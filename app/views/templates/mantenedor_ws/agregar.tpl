<div class="modal-body">
	<div class="col-xs-12">
		<form class="form-horizontal">

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Nombre </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_nombre" name="gl_nombre" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_descripcion" class="col-xs-2 control-label clabel"> Descripción </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="gl_descripcion" name="gl_descripcion" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_ambiente" class="col-xs-2 control-label clabel"> Ambiente </label>
				<div class="col-xs-3">
					<select id="gl_ambiente" name="gl_ambiente">
						<option value=""> Seleccione </option>
						<option value="prod" > Producción </option>
						<option value="dev" > Desarrollo </option>
						<option value="test" > Test </option>
						<option value="qa" > QA </option>
					</select>
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="sistema_wsdl" class="col-xs-2 control-label clabel"> WSDL </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="sistema_wsdl" name="sistema_wsdl" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="sistema_url" class="col-xs-2 control-label clabel"> URL </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="sistema_url" name="sistema_url" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="key_public" class="col-xs-2 control-label clabel"> key Public </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="key_public" name="key_public" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="key_private" class="col-xs-2 control-label clabel"> key Private </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="key_private" name="key_private" value="">
				</div>
			</div>

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor.agregarWebServiceBD(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>