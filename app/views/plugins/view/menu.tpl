<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-home"></i> <span>Inicio</span></a>
</li>
<li>
    <a href="{$base_url}/Dau/index">
        <i class="fa fa-plus"></i> <span>DAU</span></a>
</li>
<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-medkit"></i> <span>EMPA</span></a>
</li>
<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-hospital-o"></i> <span>Ficha</span></a>
</li>
<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-bar-chart"></i> <span>Reportes</span></a>
</li>
<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa  fa-file-text-o"></i> <span>Exámenes</span></a>
</li>
{if $smarty.session.perfil == 1}
<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-cog"></i> <span>Administración</span></a>
        <ul class="treeview-menu">
            <li>
                <a href="{$base_url}/Home/dashboard">
                    <i class="fa fa-plus-circle"></i> <span>Mantenedores</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{$base_url}/Administracion/noticias">
                                <i class="fa fa-plus-circle"></i> <span>Noticias</span></a>
                        </li>
                    </ul>
            </li>
        </ul>
</li>
{/if}

{*<li class="treeview">
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-paw"></i> <span>Registro Animales Mordedores</span></a>
    <ul class="treeview-menu">
        <li>
            <a href="{$base_url}/RegistroMordedores/registrar">
                <i class="fa fa-plus-circle"></i> <span>Registrar Accidente</span></a>
        </li>
        <li>
            <a href="{$base_url}/RegistroMordedores/buscar">
                <i class="fa fa-plus-circle"></i> <span>Buscar</span></a>
        </li>
        <li>
            <a href="{$base_url}/RegistroMordedores/tareas">
                <i class="fa fa-plus-circle"></i> <span>Tareas</span></a>
        </li>
        <li>
            <a href="{$base_url}/Home/dashboard">
                <i class="fa fa-plus-circle"></i> <span>Reportes</span></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{$base_url}/RegistroMordedores/reportesMordedores">
                            <i class="fa fa-plus-circle"></i> <span>Animales Mordedores</span></a>
                    </li>
                    <li>
                        <a href="{$base_url}/RegistroMordedores/reportesVacunas">
                            <i class="fa fa-slack"></i> <span>Vacunas</span></a>
                    </li>
                </ul>
        </li>
    </ul>
</li>*}
{*<li>
    <a href="{$base_url}/OtrosRegistros/otrosRegistros">
        <i class="fa fa-pencil"></i> <span>Otros Registros</span></a>
</li>
<li>
    <a href="{$base_url}/Vigilancia/vigilancia">
        <i class="fa fa-eye"></i> <span>Vigilancia</span></a>
</li>
<li>
    <a href="{$base_url}/Vacunas/buscar">
        <i class="fa fa-plus"></i> <span>Vacunas</span></a>
</li>
<li>
    <a href="{$base_url}/Zoonosis/notificacion">
        <i class="fa fa-envelope"></i> <span>Notificaciones de Zoonosis</span></a>
</li>
<li>
    <a href="{$base_url}/MesaDeAyuda/Inicio">
        <i class="fa fa-life-ring"></i> <span>Mesa de Ayuda</span></a>
</li>*}
{*{if $smarty.session.perfil == 1}
<li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-cog"></i> <span>Administración</span></a>
        <ul class="treeview-menu">
            <li>
                <a href="{$base_url}/Home/dashboard">
                    <i class="fa fa-plus-circle"></i> <span>Mantenedores</span></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{$base_url}/Administracion/regiones">
                                <i class="fa fa-plus-circle"></i> <span>Regiones</span></a>
                        </li>
                        <li>
                            <a href="{$base_url}/Administracion/provincias">
                                <i class="fa fa-plus-circle"></i> <span>Provincias</span></a>
                        </li>
                        <li>
                            <a href="{$base_url}/Administracion/comunas">
                                <i class="fa fa-plus-circle"></i> <span>Comunas</span></a>
                        </li>
                        <li>
                            <a href="{$base_url}/Administracion/municipios">
                                <i class="fa fa-plus-circle"></i> <span>Municipios</span></a>
                        </li>
                        <li>
                            <a href="{$base_url}/Administracion/especies">
                                <i class="fa fa-plus-circle"></i> <span>Especies</span></a>
                        </li>
                        <li>
                            <a href="{$base_url}/Administracion/razas">
                                <i class="fa fa-plus-circle"></i> <span>Razas</span></a>
                        </li>
                    </ul>
            </li>
        </ul>
</li>
{/if}*}
<br/><br/><br/><br/>