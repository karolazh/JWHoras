<div class="modal-body">
	<div class="col-xs-12">
		<form id="form" class="form-horizontal">

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
			{$n = 0}
			{foreach from=$arr_padre item=padre}
				<div class="form-group top-spaced">
					<label for="gl_nombre" class="col-xs-2 control-label clabel"> {$padre->gl_nombre_opcion} </label>
					<div class="col-sm-9 top-spaced">
						<div class="row col-sm-12">
							<div class="form-check">
								<div class="col-xs-3">
									<input type="checkbox" name="opcion_padre_{$padre->id_opcion}" id="opcion_padre_{$padre->id_opcion}" value="{$padre->id_opcion}" data="{$padre->id_opcion}" {if $padre->activo == 1} checked {/if} >
									&nbsp; <i class="{$padre->gl_class}"></i> {$padre->gl_nombre_opcion}
								</div>
								{foreach from=$arr_opcion item=opcion}
									{if $opcion->id_opcion_padre == $padre->id_opcion}
										<div class="col-xs-3">
											<input type="checkbox" name="opcion_{$opcion->id_opcion}" id="opcion_{$opcion->id_opcion}" value="{$opcion->id_opcion}" data="{$padre->id_opcion}" {if $opcion->activo == 1} checked {/if} >
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