<div class="modal-body">
	<div class="col-xs-12">
		<form class="form-horizontal">

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Padre </label>
				<div class="col-xs-3">
					<select id="id_padre" name="id_padre">
						<option value="0"> Seleccione </option>
						{foreach from=$arr_padre item=padre}
							<option value="{$padre->id_padre}" > {$padre->gl_nombre} </option>
						{/foreach}
					</select>
				</div>
			</div>
			
			<div class="form-group top-spaced">
				<label for="gl_nombre_opcion" class="col-xs-2 control-label clabel"> Nombre </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_nombre_opcion" name="gl_nombre_opcion" value="" />
				</div>
			</div>
			
			<div class="form-group top-spaced">
				<label for="gl_url" class="col-xs-2 control-label clabel"> URL </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_url" name="gl_url" value="" />
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

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Perfiles </label>
				<div class="col-sm-9">
					<div class="row col-sm-12">
						<div class="form-check">
							{foreach from=$arr_perfil item=perfil}
								<div class="col-xs-4">
									<input type="checkbox" name="arr_perfil[{$perfil->id_perfil}]" id="arr_perfil[{$perfil->id_perfil}]" value="{$perfil->id_perfil}" {if $perfil->activo == 1} checked {/if} >&nbsp; {$perfil->gl_nombre}
								</div>
							{/foreach}
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor.agregarMenuOpcionBD(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>