<div class="modal-body">
	<div class="col-xs-12">
		<form class="form-horizontal">

			<div class="form-group top-spaced">
				<label for="gl_rut" class="col-xs-2 control-label clabel"> RUT </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_rut" name="gl_rut" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Nombre </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_nombre" name="gl_nombre" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_apellido_paterno" class="col-xs-2 control-label clabel"> Apellido Paterno </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_apellido_paterno" name="gl_apellido_paterno" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_apellido_materno" class="col-xs-2 control-label clabel"> Apellido Materno </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_apellido_materno" name="gl_apellido_materno" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="id_region" class="col-xs-2 control-label clabel"> Región </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="id_region" name="id_region" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="id_comuna" class="col-xs-2 control-label clabel"> Comuna </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="id_comuna" name="id_comuna" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_direccion" class="col-xs-2 control-label clabel"> Dirección </label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="gl_direccion" name="gl_direccion" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_email" class="col-xs-2 control-label clabel"> Email </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_email" name="gl_email" value="">
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_fono" class="col-xs-2 control-label clabel"> Telefono </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_fono" name="gl_fono" value="">
				</div>
			</div>

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor.agregarUsuarioBD(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>