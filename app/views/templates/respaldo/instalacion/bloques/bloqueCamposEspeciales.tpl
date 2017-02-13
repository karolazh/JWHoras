{foreach $arrCamposTipo[$itm->id_ambito][$itm->id_tipo] as $itm_campo}
	<div class="row">
		<div class="form-group">								
			<label for="selectCDAType" class="col-xs-2 control-label clabel" id="txtNombre" name="txtNombre">{$itm_campo.nombre}</label>
			
				{if $itm_campo.tipo == "fecha"}
					<div class="col-xs-2">
						<input type="text" id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control calendario" value="{$itm->gl_valores_campos[$itm_campo.id]}" onBlur="javascript: updateFileDataSilencio('frm_individual_{$itm->id_adjunto}');">
					</div>	
						
				{/if}	
				{if $itm_campo.tipo == "texto"}
					<div class="col-xs-5">
						<input type="text" id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control" value="{$itm->gl_valores_campos[$itm_campo.id]}" onBlur="javascript: updateFileDataSilencio('frm_individual_{$itm->id_adjunto}');">
					</div>	
				{/if}	
				{if $itm_campo.tipo == "glosa"}
					<div class="col-xs-10">
						<textarea onBlur="javascript: updateFileDataSilencio('frm_individual_{$itm->id_adjunto}');" type="text" id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control">{$itm->gl_valores_campos[$itm_campo.id]}</textarea>
					</div>	
				{/if}														
				
				{if $itm_campo.tipo == "combo_tipo_instalaci"}
					<div class="col-xs-10">
						<select id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control" onChange="javascript: updateFileDataSilencio('frm_individual_{$itm->id_adjunto}');">
							<option value="1" {if $itm->gl_valores_campos[$itm_campo.id] == "1"} selected {/if}>CARROS MOVILES</option>
							<option value="2" {if $itm->gl_valores_campos[$itm_campo.id] == "2"} selected {/if}>LOCAL DE ALMACENAMIENTO TIPO BODEGA</option>
							<option value="3" {if $itm->gl_valores_campos[$itm_campo.id] == "3"} selected {/if}>LOCAL DE DISTRIBUCION DE ALIMENTOS</option>
							<option value="4" {if $itm->gl_valores_campos[$itm_campo.id] == "4"} selected {/if}>LOCAL DE ELABORACION DE ALIMENTOS</option>
							<option value="5" {if $itm->gl_valores_campos[$itm_campo.id] == "5"} selected {/if}>LOCAL DE ELABORACION DE ALIMENTOS CON CONSUMO</option>
							<option value="6" {if $itm->gl_valores_campos[$itm_campo.id] == "6"} selected {/if}>LOCAL DE ELABORACION DE ALIMENTOS CON CONSUMO AL PASO</option>
							<option value="8" {if $itm->gl_valores_campos[$itm_campo.id] == "7"} selected {/if}>LOCAL DE ELABORACION TIPO ENVASADORA</option>
							<option value="9" {if $itm->gl_valores_campos[$itm_campo.id] == "8"} selected {/if}>LOCAL DE EXPENDIO DE ALIMENTOS</option>
							<option value="10" {if $itm->gl_valores_campos[$itm_campo.id] == "9"} selected {/if}>LOCAL DE EXPENDIO DE ALIMENTOS CON CONSUMO</option>
							<option value="11" {if $itm->gl_valores_campos[$itm_campo.id] == "10"} selected {/if}>LOCAL DE EXPENDIO DE ALIMENTOS CON CONSUMO AL PASO</option>
							<option value="12" {if $itm->gl_valores_campos[$itm_campo.id] == "11"} selected {/if}>LOCAL DE EXPENDIO DE ALIMENTOS Y ELABORACION</option>
							<option value="13" {if $itm->gl_valores_campos[$itm_campo.id] == "12"} selected {/if}>LOCAL DE PRODUCCION TIPO MATADERO</option>
							<option value="14" {if $itm->gl_valores_campos[$itm_campo.id] == "14"} selected {/if}>PUESTO DE ALIMENTOS</option>
							<option value="15" {if $itm->gl_valores_campos[$itm_campo.id] == "15"} selected {/if}>VEHICULO DE TRANSPORTE DE ALIMENTOS</option>
							<option value="16" {if $itm->gl_valores_campos[$itm_campo.id] == "16"} selected {/if}>VENDEDOR AMBULANTE</option>
							<option value="17" {if $itm->gl_valores_campos[$itm_campo.id] == "17"} selected {/if}>LOCAL DE ELABORACION TIPO PROCESADORA</option>
						</select>
					</div>	
				{/if}														
				
				
		</div>	
	</div>

{/foreach}
