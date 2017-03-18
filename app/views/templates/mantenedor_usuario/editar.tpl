<div class="modal-body">
	<div class="col-xs-12">
		<form id="form" class="form-horizontal" action="{$base_url}/Mantenedor/editarUsuarioBD/" method="post" enctype="multipart/form-data"> 
			<input type="hidden" id="id_usuario" name="id_usuario" value="{$itm->id_usuario}" />
        
					<input type="hidden" id="id_usuario" name="id_usuario" value="{$itm->id_usuario}" />

					<div class="form-group top-spaced">
						<label for="gl_rut" class="col-xs-2 control-label clabel">RUT</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" id="gl_rut" name="gl_rut" value="{$itm->gl_rut}" readonly />
						</div>
					</div>

					<div class="form-group top-spaced">
						<label for="gl_nombre" class="col-xs-2 control-label clabel">Nombre Completo</label>
						<div class="col-xs-3">
							<input type="text" class="form-control" id="gl_nombre" name="gl_nombre" value="{$itm->gl_nombres} {$itm->gl_apellidos}" readonly />
						</div>
					</div>
					<div class="form-group top-spaced">
						<label for="gl_descripcion" class="col-xs-2 control-label clabel">Perfil</label>
						<div class="col-xs-3">
							<select id="id_perfil" name="id_perfil">
								<option value="0" > Seleccione </option>
								{foreach from=$perfiles item=perfil}
									<option value="{$perfil->id_perfil}" {if $perfil->id_perfil == $itm->id_perfil} selected {/if} >  {$perfil->gl_nombre_perfil} </option>
								{/foreach}
							</select>
						</div>
					</div>

					{*}
					<div class="form-group top-spaced">
						<label for="bo_estado" class="col-xs-2 control-label clabel">Estado Perfil</label>
						<div class="col-xs-3">
							<select id="bo_estado" name="bo_estado">
								<option value="0" {if $itm->bo_estado_perfil != 1} selected {/if} > Inactivo </option>
								<option value="1" {if $itm->bo_estado_perfil == 1} selected {/if} > Activo </option>
							</select>
						</div>
					</div>
					{*}

			

			<div class="modal-footer top-spaced">
				<div id="btn-terminar">
					<button class="btn btn-xs btn-danger"  type="button" onclick="xModal.close();" id="btn_cerrar" > Cerrar </button>
					<button class="btn btn-xs btn-success" type="button" onclick="Mantenedor_usuario.editarUsuario(this.form,this);"> Guardar </button>
				</div>
			</div>

		</form>
	</div>
</div>