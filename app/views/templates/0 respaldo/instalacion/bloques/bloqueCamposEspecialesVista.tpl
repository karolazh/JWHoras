{foreach $arrCamposTipo[$itemAdjuntoPestana->id_ambito][$itemAdjuntoPestana->id_tipo] as $itm_campo}
	<div class="row">
		<div class="form-group">								
			<label for="selectCDAType" class="col-xs-2 control-label clabel" id="txtNombre" name="txtNombre">{$itm_campo.nombre}</label>
			
				{if $itm_campo.tipo == "fecha"}
					<div class="col-xs-2">
						{$itemAdjuntoPestana->gl_valores_campos[$itm_campo.id]|fecha}
					</div>	
						
				{/if}	
				{if $itm_campo.tipo == "texto"}
					<div class="col-xs-5">
						{$itemAdjuntoPestana->gl_valores_campos[$itm_campo.id]}
					</div>	
				{/if}	
				{if $itm_campo.tipo == "glosa"}
					<div class="col-xs-10">
						{$itemAdjuntoPestana->gl_valores_campos[$itm_campo.id]}
					</div>	
				{/if}														
				{if $itm_campo.tipo == "combo_tipo_instalaci"}				
					<div class="col-xs-10">
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "1"} CARROS MOVILES{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "2"} LOCAL DE ALMACENAMIENTO TIPO BODEGA{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "3"} LOCAL DE DISTRIBUCION DE ALIMENTOS{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "4"} LOCAL DE ELABORACION DE ALIMENTOS{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "5"} LOCAL DE ELABORACION DE ALIMENTOS CON CONSUMO{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "6"} LOCAL DE ELABORACION DE ALIMENTOS CON CONSUMO AL PASO{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "7"} LOCAL DE ELABORACION TIPO ENVASADORA{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "8"} LOCAL DE EXPENDIO DE ALIMENTOS{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "9"} LOCAL DE EXPENDIO DE ALIMENTOS CON CONSUMO{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "10"} LOCAL DE EXPENDIO DE ALIMENTOS CON CONSUMO AL PASO{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "11"} LOCAL DE EXPENDIO DE ALIMENTOS Y ELABORACION{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "12"} LOCAL DE PRODUCCION TIPO MATADERO{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "14"} PUESTO DE ALIMENTOS{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "15"} VEHICULO DE TRANSPORTE DE ALIMENTOS{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "16"} VENDEDOR AMBULANTE{/if}
							{if $itemAdjuntoPestana->gl_valores_campos[$itm_campo.id] == "17"} LOCAL DE ELABORACION TIPO PROCESADORA{/if}
					</div>					
				{/if}
		</div>	
	</div>

{/foreach}
