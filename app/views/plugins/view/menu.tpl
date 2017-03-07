<!--li>
    <a href="{$base_url}/Home/dashboard">
        <i class="fa fa-home"></i> <span>Inicio</span></a>
</li>
<li>
    <a href="{$base_url}/Paciente/nuevo">
        <i class="fa fa-book"></i> <span>Nuevo Registro</span></a>
</li>
<li>
    <a href="{$base_url}/Paciente/index">
        <i class="fa fa-th"></i> <span>Grilla Pacientes</span></a>
</li>
<li>
    <a href="{$base_url}/Empa/index">
        <i class="fa fa-medkit"></i> <span>Atención</span></a>
</li>
<li>
	<a href="">
		<i class="fa fa-plus-circle"></i> <span>Mantenedores</span></a>
		<ul class="treeview-menu">
			<li>
				<a href="">
					<i class="fa fa-plus-circle"></i> <span>Usuarios</span></a>
			</li>
		</ul>
</li>

<li>
    <a href="{$base_url}/Soporte/">
        <i class="fa fa-life-ring"></i> <span>Mesa de Ayuda</span></a>
</li> -->
{foreach $opciones as $opcion}    
	{if $opcion->id_opcion_padre == 0 AND !$opcion->bo_tiene_hijo}
	<li>
		<a href="{$base_url}{$opcion->gl_url}"><i class="{$opcion->gl_icono}"></i> <span>{$opcion->gl_nombre_opcion}</span></a>
	</li>
	{elseif}
	{/if}
	
{/foreach}