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
stdClass Object ( 
	[row_0] => stdClass Object ( 
							[id_opcion] => 6 
							[id_opcion_padre] => 5 
							[bo_tiene_hijo] => 0 
							[gl_nombre_opcion] => 
							Usuarios [gl_icono] => fa fa-plus-circle [gl_url] => ) )
-->
{foreach $opciones as $opcion}    
	{if $opcion->id_opcion_padre == 0 AND !$opcion->bo_tiene_hijo}
	<li>
		<a href="{$base_url}{$opcion->gl_url}"><i class="{$opcion->gl_icono}"></i> <span>{$opcion->gl_nombre_opcion}</span></a>
	</li>
	{else}
		{if $opcion->id_opcion_padre == 0 AND $opcion->bo_tiene_hijo}
			<li>
				<a href="">
				<i class="{$opcion->gl_icono}"></i> <span>{$opcion->gl_nombre_opcion}</span></a>
				<ul class="treeview-menu">
					{foreach $subOpciones as $subOpcion}  
						{if $opcion->id_opcion == $subOpcion->id_opcion_padre}
							<li>
								<a href="{$base_url}{$subOpcion->gl_url}"><i class="{$subOpcion->gl_icono}"></i> <span>{$subOpcion->gl_nombre_opcion}</span></a>
							</li>
						{/if}
					{/foreach}
				</ul>
			</li>
		{/if}
	{/if}
	
{/foreach}