<!--li>
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
-->
{foreach $opciones as $opcion}    
	{if $opcion->id_opcion_padre == 0 AND !$opcion->bo_tiene_hijo}
	<li>
		<a href="{$base_url}{$opcion->gl_url}"><i class="{$opcion->gl_icono}"></i> <span>{$opcion->gl_nombre_opcion}</span></a>
	</li>
	{else}
	{/if}
	
{/foreach}