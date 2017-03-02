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
            <i  class="fa fa-user fa-3x img-circle" alt="User Image"></i>
            <p>
                {*{$usuario} <br/> {$rut}*}
                <a href="{$smarty.const.BASE_URI}/Login/actualizar" class="h4">
                    {$usuario} <br/> {$rut}
                </a>
            </p>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
            {*<div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>*}
            <div class="pull-right">
                <a href="{$smarty.const.BASE_URI}/Login/logoutUsuario" class="btn btn-success btn-flat">Cerrar Sesión</a>
            </div>
        </li>
    </ul>
</li>