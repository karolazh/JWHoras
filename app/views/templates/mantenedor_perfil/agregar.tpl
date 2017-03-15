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

			{foreach from=$arr_padre item=padre}
				<div class="form-group top-spaced">
					<label for="gl_nombre" class="col-xs-2 control-label clabel"> {$padre->gl_nombre} </label>
					<div class="col-sm-9 top-spaced">
						<div class="row col-sm-12">
							<div class="form-check">
								{foreach from=$arr_opcion item=opcion}
									{if $opcion->id_padre == $padre->id_padre}
										<div class="col-xs-3">
											<input type="checkbox" name="opcion" id="opcion" value="{$opcion->id_opcion}" {if $opcion->activo == 1} checked {/if} >
											&nbsp; <i class="{$opcion->gl_class}"></i> {$opcion->gl_nombre_opcion}
										</div>
									{/if}
								{/foreach}
							</div>
						</div>
					</div>
				</div>
			{/foreach}

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor_perfil.agregarPerfil(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>