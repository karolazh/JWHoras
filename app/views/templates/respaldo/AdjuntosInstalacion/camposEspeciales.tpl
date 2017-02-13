{foreach $arrCamposTipo[$itm->id_adjunto] as $itm_campo}
	<div class="row">
		<div class="form-group">								
			<label for="selectCDAType" class="col-xs-2 control-label clabel" id="txtNombre" name="txtNombre">{$itm_campo.nombre}</label>
			
				{if $itm_campo.tipo == "fecha"}
					<div class="col-xs-2">
						<input type="text" id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control" value="">
					</div>	
						
				{/if}	
				{if $itm_campo.tipo == "texto"}
					<div class="col-xs-5">
						<input type="text" id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control" value="">
					</div>	
				{/if}	
				{if $itm_campo.tipo == "glosa"}
					<div class="col-xs-10">
						<textarea type="text" id="{$itm_campo.id}" name="{$itm_campo.id}" class="form-control" value=""></textarea>
					</div>	
				{/if}														
		</div>	
	</div>

{/foreach}
