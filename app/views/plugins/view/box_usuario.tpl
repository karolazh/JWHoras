<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <i class="fa fa-user" alt="User Image"></i>
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{$usuario}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <i  class="fa fa-user fa-3x img-circle"></i>
            <p>
                <a href="{$smarty.const.BASE_URI}/Login/actualizar" class="h4">
                    {$usuario} <br/> {$gl_nombre_perfil}
                </a>
            </p>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-right">
				{if $id_perfil == 1}
					{if $smarty.session.id_user_cambio == 0}
						<a onclick="xModal.open('{$smarty.const.BASE_URI}/mantenedor/cambiar_usuario/{$id_usuario}','Cambiar de Usuario','70');" class="btn btn-info btn-sm">
							<i class="fa fa-exchange"></i> Cambiar de Usuario
						</a>
					{else}					
						<a href="{$base_url}/mantenedor/volver_usuario/" class="btn btn-info btn-sm">
							<i class="fa fa-undo"></i> Volver a mi Usuario
						</a>
					{/if}
				{/if}
                <a href="{$smarty.const.BASE_URI}/Login/logoutUsuario" class="btn btn-danger btn-sm">
					<i class="fa fa-sign-out"></i> Cerrar Sesión
				</a>
            </div>
        </li>
    </ul>
</li>