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
				<label for="gl_url" class="col-xs-2 control-label clabel"> URL (opcional)</label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_url" name="gl_url" value="">
				</div>
			</div>
			
			<div class="form-group top-spaced">
				<label for="gl_class" class="col-xs-2 control-label clabel"> Class (Icono)</label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_class" name="gl_class" value="" onChange="$('#cambio').attr('class', this.value);" />
				</div>
				<div class="col-xs-1">
					<span id="cambio" class=""></span>
				</div>
			</div>

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor.agregarMenuPadreBD(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>