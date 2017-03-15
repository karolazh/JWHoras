<div class="modal-body">
	<div class="col-xs-12">
		<form class="form-horizontal">
			<input type="hidden" id="id_opcion" name="id_opcion" value="{$itm->id_opcion}" />

			<div class="form-group top-spaced">
				<label for="gl_nombre" class="col-xs-2 control-label clabel"> Padre </label>
				<div class="col-xs-3">
					<select id="id_padre" name="id_padre">
						<option value="0"> Seleccione </option>
						{foreach from=$arr_padre item=padre}
							<option value="{$padre->id_padre}" {if $itm->id_padre == $padre->id_padre} selected {/if} > {$padre->gl_nombre} </option>
						{/foreach}
					</select>
				</div>
			</div>

			<div class="form-group top-spaced">
				<label for="gl_nombre_opcion" class="col-xs-2 control-label clabel"> Nombre </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_nombre_opcion" name="gl_nombre_opcion" value="{$itm->gl_nombre_opcion}" />
				</div>
			</div>
			
			<div class="form-group top-spaced">
				<label for="gl_url" class="col-xs-2 control-label clabel"> URL </label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_url" name="gl_url" value="{$itm->gl_url}" />
				</div>
			</div>
			
			<div class="form-group top-spaced">
				<label for="gl_class" class="col-xs-2 control-label clabel"> Class (Icono)</label>
				<div class="col-xs-3">
					<input type="text" class="form-control" id="gl_class" name="gl_class" value="{$itm->gl_class}" onChange="$('#cambio').attr('class', this.value);" />
				</div>
				<div class="col-xs-1">
					<span id="cambio" class="{$itm->gl_class}"></span>
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
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor.editarMenuOpcionBD(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>